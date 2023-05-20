<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Carmodel;
use Illuminate\Http\Request;

class CarmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($manufacturerslug)
    {
        //look up the manufacturer by its id
        $manufacturer = Manufacturer::where('id', '=', $manufacturerslug)->first();

        #use Eloquent relations to find all models of that manufacturer
        $carmodels = $manufacturer->carmodels()->get();

        return view('carmodels', ['manufacturer' => $manufacturer, 'carmodels' => $carmodels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($manufacturerslug)
    {
        $manufacturer = Manufacturer::where('id', '=', $manufacturerslug)->first();
        return view('carmodel_new', compact('manufacturer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carmodel = new Carmodel();
        $carmodel->name = $request->carmodel_name;
        $carmodel->manufacturer_id = $request->manufacturer_id;
        $carmodel->production_started = $request->carmodel_production_started;
        $carmodel->min_price = $request->carmodel_min_price;
        $carmodel->save();

        #to perform a redirect back, we need manufacturer ID
        $manufacturer = manufacturer::findOrFail($request->manufacturer_id);
        $action = action([CarmodelController::class, 'index'], ['manufacturerslug' => $manufacturer->id]);
        return redirect($action);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
