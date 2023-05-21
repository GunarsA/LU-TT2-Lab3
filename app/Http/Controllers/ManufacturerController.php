<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

// Add validation to ManufacturerController and CarmodelController. At minimum, set the following rules:

//     Manufacturer name may not be empty
//     Manufacturer name cannot exceed certain length
//     Manufactuer name has to be unique in the database
//     Website URL of the manufacturer has to be a valid URL
//     Foundation year has to be an integer value
//     Foundation year of the manufacturer cannot be in the future
//     Car model's minimal price has to be positive number
//     Start of car model's production has to be an integer value larger than 1900.


class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($countryslug)
    {
        //look up the country by its 2-letter code
        $country = Country::where('code', '=', $countryslug)->first();

        #use Eloquent relations to find all manufacturers in that country
        $manufacturers = $country->manufacturers()->get();

        return view('manufacturers', ['country' => $country, 'manufacturers' => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($countryslug)
    {
        $country = Country::where('code', '=', $countryslug)->first();
        return view('manufacturer_new', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:manufacturers,name',
            'founded' => 'required|integer|min:1900|max:' . date('Y'),
            'website' => 'required|url',
        ];
        $validated = $request->validate($rules);

        $manufacturer = new Manufacturer();
        $manufacturer->country_id = $request->country_id;
        $manufacturer->fill($validated);
        $manufacturer->save();

        #to perform a redirect back, we need country code from ID
        $country = Country::findOrFail($request->country_id);
        $action = action([ManufacturerController::class, 'index'], ['countryslug' => $country->code]);
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
        $manufacturer = Manufacturer::findOrFail($id);
        return view('manufacturer_edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $rules = [
            'name' => 'required|unique:manufacturers,name,' . $id,
            'founded' => 'required|integer|min:1900|max:' . date('Y'),
            'website' => 'required|url',
        ];
        $validated = $request->validate($rules);

        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->fill($validated);
        $manufacturer->save();

        return redirect(action([ManufacturerController::class, 'index'], ['countryslug' => $manufacturer->country->code]));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Manufacturer::findOrfail($id)->delete();
        return redirect()->back();
    }
}
