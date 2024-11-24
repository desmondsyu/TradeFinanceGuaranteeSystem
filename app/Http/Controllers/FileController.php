<?php
namespace App\Http\Controllers;

use App\Models\Guarantee;
use App\Models\UploadedFile;
use App\Services\ParsingService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private ParsingService $parsingService;

    public function __construct(ParsingService $parsingService)
    {
        $this->parsingService = $parsingService;
    }

    public function index()
    {
        $files = UploadedFile::all();
        return view('files.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xml,json',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $fileType = $file->getClientOriginalExtension();
        $data = file_get_contents($file);

        UploadedFile::create([
            'filename' => $filename,
            'file_type' => $fileType,
            'data' => $data,
        ]);

        $errors = [];

        try {
            $parsedData = $this->parsingService->parseFile($file);

            foreach ($parsedData as $lineNumber => $row) {
                $rowErrors = $this->parsingService->validateRow($row);

                if (empty($rowErrors)) {
                    Guarantee::create([
                        'corporate_reference_number' => $row['corporate_reference_number'],
                        'guarantee_type' => $row['guarantee_type'],
                        'nominal_amount' => $row['nominal_amount'],
                        'nominal_amount_currency' => $row['nominal_amount_currency'],
                        'expiry_date' => $row['expiry_date'],
                        'applicant_name' => $row['applicant_name'],
                        'applicant_address' => $row['applicant_address'],
                        'beneficiary_name' => $row['beneficiary_name'],
                        'beneficiary_address' => $row['beneficiary_address'],
                        'status' => $row['status'],
                    ]);
                } else {
                    $errors[] = [
                        'line' => $lineNumber + 1,
                        'errors' => $rowErrors,
                    ];
                }
            }
        } catch (\Exception $e) {

            return redirect()->route('files.index')
                ->with('error', 'File uploaded, but processing failed: ' . $e->getMessage());
        }

        if (!empty($errors)) {
            return redirect()->route('files.index')
                ->with('warning', 'File uploaded, but some rows have errors.')
                ->with('errors', $errors);
        }

        return redirect()->route('files.index')->with('success', 'File uploaded and processed successfully.');
    }

    public function delete($id)
    {
        $file = UploadedFile::findOrFail($id);
        $file->delete();
        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}
