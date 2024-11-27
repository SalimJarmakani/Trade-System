<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guarantee;
use App\Repositories\GuaranteeRepository;
use Illuminate\Validation\ValidationException;

class GuaranteeController extends Controller
{

    protected $guaranteeRepository;

    public function __construct(GuaranteeRepository $guaranteeRepository)
    {
        $this->guaranteeRepository = $guaranteeRepository;
    }

    public function index()
    {
        $guarantees = $this->guaranteeRepository->getAll();
        return view('guarantee.index', compact('guarantees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("guarantee.create");
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate(Guarantee::rules());

            $guarantee = $this->guaranteeRepository->create($validated);
            return redirect()->route('guarantee.index')->with('success', 'Guarantee created successfully!');
        } catch (ValidationException $e) {
            return redirect()->route("guarantee.create")
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $guarantee = $this->guaranteeRepository->getById($id);


        return view("guarantee.update", compact("guarantee"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $corporateReferenceNumber = $request->input('corporate_reference_number');

        // Validate the request data
        $validated = $request->validate([
            'guarantee_type' => 'required|string|max:255',
            'nominal_amount' => 'required|numeric|min:0',
            'nominal_amount_currency' => 'required|string|max:10',
            'expiry_date' => 'required|date|after:today',
            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:1000',
            'beneficiary_name' => 'required|string|max:255',
            'beneficiary_address' => 'required|string|max:1000',
        ]);

        // Call the repository to update the guarantee
        $this->guaranteeRepository->update($validated, $corporateReferenceNumber);

        $guarantee = $this->guaranteeRepository->getbyId($corporateReferenceNumber);

        // Redirect with success message
        return view('guarantee.update', compact('guarantee'))->with('success', 'Guarantee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->guaranteeRepository->delete($id);

        return redirect()->route("guarantee.index")->with("success", "Deleted guarantee successfully!");
    }
}
