<?php
namespace App\Services;

use League\Csv\Exception;
use League\Csv\UnavailableStream;
use SimpleXMLElement;
use League\Csv\Reader;

class ParsingService
{
    private array $requiredFields = [
        'corporate_reference_number' => 'string',
        'guarantee_type' => 'string',
        'nominal_amount' => 'numeric',
        'nominal_amount_currency' => 'string',
        'expiry_date' => 'date',
        'applicant_name' => 'string',
        'applicant_address' => 'string',
        'beneficiary_name' => 'string',
        'beneficiary_address' => 'string',
        'status' => 'status',
    ];

    /**
     * @throws UnavailableStream
     * @throws \Exception
     */
    public function parseFile($file)
    {
        $extension = $file->getClientOriginalExtension();

        switch ($extension) {
            case 'csv':
                return $this->parseCsv($file);
            case 'xml':
                return $this->parseXml($file);
            case 'json':
                return $this->parseJson($file);
            default:
                throw new \Exception('Unsupported file type.');
        }
    }

    /**
     * @throws UnavailableStream
     * @throws Exception
     */
    protected function parseCsv($file): array
    {
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);
        return iterator_to_array($csv->getRecords());
    }

    /**
     * @throws \Exception
     */
    protected function parseXml($file)
    {
        $xmlContent = file_get_contents($file->getPathname());

        try {
            $xml = new SimpleXMLElement($xmlContent);
            $parsedData = [];
            $lineNumber = 1;
            foreach ($xml->guarantee as $guarantee) {
                $parsedData[$lineNumber] = json_decode(json_encode($guarantee), true);
                $lineNumber++;
            }

            return $parsedData;
        } catch (\Exception $e) {
            throw new \Exception('Error parsing XML: ' . $e->getMessage());
        }
    }

    protected function parseJson($file)
    {
        $jsonContent = file_get_contents($file->getPathname());
        return json_decode($jsonContent, true);
    }

    public function validateRow(array $row): array
    {
        $errors = [];

        foreach ($this->requiredFields as $field => $type) {
            if (!isset($row[$field])) {
                $errors[] = "The field '$field' is required.";
                continue;
            }

            $value = $row[$field];

            switch ($type) {
                case 'string':
                    if (!is_string($value)) {
                        $errors[] = "The field '$field' must be a string.";
                    }
                    break;
                case 'numeric':
                    if (!is_numeric($value)) {
                        $errors[] = "The field '$field' must be numeric.";
                    }
                    break;
                case 'date':
                    if (!strtotime($value) || strtotime($value) <= time()) {
                        $errors[] = "The field '$field' must be a valid future date.";
                    }
                    break;
                case 'status':
                    $validStatuses = ['New', 'Submitted', 'Reviewed', 'Applied', 'Issued'];
                    if (!in_array($value, $validStatuses)) {
                        $errors[] = "The field 'status' must be one of the following: " . implode(', ', $validStatuses) . ".";
                    }
                    break;
                default:
                    $errors[] = "Unknown validation type for '$field'.";
            }
        }

        return $errors;
    }

}
