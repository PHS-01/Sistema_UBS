<?php

namespace App\Http\Controllers;

use App\Models\Service_Sheet;
use Illuminate\Http\Request;

class ServiceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  
        return view('service_sheet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $maxNumber = Service_Sheet::max('number'); 

        $sheet = Service_Sheet::create([
            'number' => $maxNumber+1,         
            'name' => $request->name,                                 
            'sus_card' => $request->sus_card, 
            'email' => $request->email, 
            'phone_number'=> $request->phone_number
        ]);

        return redirect('/sheet/'.$sheet->id);
    }

    
    public function show(Service_Sheet $service_sheet)
    {
        return view('service_sheet.show', compact('service_sheet'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service_Sheet $service_Sheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service_Sheet $service_Sheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service_Sheet $service_sheet)
    {
        //
        $service_sheet->delete();

        return redirect('/');
    }
}
