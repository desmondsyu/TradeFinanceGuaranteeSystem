<?php

namespace App\Repositories;

use App\Models\Guarantee;

class GuaranteeRepository implements GuaranteeRepositoryInterface
{
    public function all()
    {
        return Guarantee::all();
    }

    public function find($id)
    {
        return Guarantee::findOrFail($id);
    }

    public function create(array $data)
    {
        return Guarantee::create($data);
    }

    public function updateStatus($id, $status)
    {
        $guarantee = $this->find($id);

        $guarantee->update([
            'status' => $status,
        ]);
        
        return $guarantee;
    }

    public function delete($id)
    {
        $guarantee = $this->find($id);
        return $guarantee->delete();
    }
}
