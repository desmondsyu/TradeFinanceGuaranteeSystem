<?php

namespace App\Services;

use App\Repositories\GuaranteeRepositoryInterface;

class GuaranteeService
{
    protected $guaranteeRepository;

    public function __construct(GuaranteeRepositoryInterface $guaranteeRepository)
    {
        $this->guaranteeRepository = $guaranteeRepository;
    }

    public function getAllGuarantees()
    {
        return $this->guaranteeRepository->all();
    }

    public function getGuaranteeById($id)
    {
        return $this->guaranteeRepository->find($id);
    }

    public function createGuarantee(array $data)
    {
        return $this->guaranteeRepository->create($data);
    }

    public function updateGuaranteeStatus($id, $status)
    {
        return $this->guaranteeRepository->updateStatus($id, $status);
    }

    public function deleteGuarantee($id)
    {
        return $this->guaranteeRepository->delete($id);
    }
}
