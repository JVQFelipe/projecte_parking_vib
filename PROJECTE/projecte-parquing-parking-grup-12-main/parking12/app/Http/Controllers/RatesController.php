<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;


class RatesController extends Controller
{
    public function index()
    {
        $rates = Rate::paginate(5);

        return view("rates.index")->with('rates',$rates);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $rate = Rate::all();
        return view("rates.create")->with('rate',$rate);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'isActive' => 'boolean',
        'ratePerMinute' => 'required|numeric',
    ]);

    $rate = new Rate();
    $rate->name = $request->name;
    $rate->isActive = $request->has('isActive') ? true : false;
    $rate->ratePerMinute = $request->ratePerMinute;
    $rate->save();

    return redirect()->route('rates.index')->with('success', 'Tarifa creada correctament.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rates = Rate::findOrFail($id);

        return view("rates.show")->with('rates',$rates);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rate = Rate::findOrFail($id);
        return view("rates.edit")->with('rate',$rate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parking = Parking::findOrFail($id);

        $parking = Parking::findOrFail($parking_id);

        $request->validate([
            'name' => 'required',
            'isActive' => 'required',
            'ratePerMinute' => 'required',
        ]);
    
        $rate->name = $request->name;
        $rate->isActive = $request->isActive;
        $rate->ratePerMinute = $request->ratePerMinute;


    $ticket->save();

    return redirect("/rates");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    {
        $rate = Rate::findOrFail($id);
        try {
            $rate->delete();
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect('/rates')->with('error','Error esborrant la tarifa');
        }
        return redirect("/rates")->with('success','Tarifa esborrada');
    }
    
}
}