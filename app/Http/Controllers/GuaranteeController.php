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
        $guarantees = $this->guaranteeService->getAllGuarantees();
        return view('guarantees.index', compact('guarantees'));
    }

    public function create()
    {
        return view('guarantees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'corporate_reference_number' => 'required|unique:guarantees',
            'guarantee_type' => 'required|in:Bank,Bid Bond,Insurance,Surety',
            'nominal_amount' => 'required|numeric|min:0',
            'nominal_amount_currency' => 'required|string|size:3',
            'expiry_date' => 'required|date|after:today',
            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:500',
            'beneficiary_name' => 'required|string|max:255',
            'beneficiary_address' => 'required|string|max:500',
            'status' => 'required|in:New,Approved,Issued,Applied',
        ]);

        $this->guaranteeService->createGuarantee($validatedData);
        return redirect()->route('guarantees.index')->with('success', 'Created');
    }

    public function show($id)
    {
        $guarantee = $this->guaranteeService->getGuaranteeById($id);
        return view('guarantees.show', compact('guarantee'));
    }

    public function review($id)
    {
        $this->guaranteeService->updateGuaranteeStatus($id, 'Approved');
        return redirect()->route('guarantees.index')->with('success', 'Guarantee submitted for review.');
    }
    public function apply($id)
    {
        $this->guaranteeService->updateGuaranteeStatus($id, 'Applied');
        return redirect()->route('guarantees.index')->with('success', 'Guarantee application submitted.');
    }
    public function issue($id)
    {
        $this->guaranteeService->updateGuaranteeStatus($id, 'Issued');
        return redirect()->route('guarantees.index')->with('success', 'Guarantee issued.');
    }

    public function destroy($id)
    {
        $this->guaranteeService->deleteGuarantee($id);
        return redirect()->route('guarantees.index');
    }
}
