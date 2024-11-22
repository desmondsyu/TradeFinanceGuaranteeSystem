<?php

namespace App\Repositories;

interface GuaranteeRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function updateStatus($id, $status);
    public function delete($id);
}
