<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GuaranteeService;

class GuaranteeController extends Controller
{
    protected $guaranteeService;

    public function __construct(GuaranteeService $guaranteeService)
    {
        $this->guaranteeService = $guaranteeService;
    }

    public function index()
    {
        return response()->json($this->guaranteeService->getAllGuarantees());
    }

    public function store(Request $request)
    {
        return response()->json($this->guaranteeService->createGuarantee($request->validated()));
    }

    public function show($id)
    {
        return response()->json($this->guaranteeService->getGuaranteeById($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->guaranteeService->updateGuaranteeStatus($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->guaranteeService->deleteGuarantee($id));
    }
}