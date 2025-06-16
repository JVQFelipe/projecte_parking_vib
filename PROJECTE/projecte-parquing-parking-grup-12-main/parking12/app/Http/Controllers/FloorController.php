<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Parking;
use App\Models\ParkingSlot;


class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $floors = Floor::paginate(5);

        return view("floors.index")->with('floors',$floors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $parking_id)
{
    $parking = Parking::findOrFail($parking_id);
    return view("floors.create")->with('parking', $parking);
}

    public function store(Request $request, string $parking_id)
{
    $parking = Parking::findOrFail($parking_id);

    $request->validate([
        'name' => 'required|unique:floors',
        'latitude' => 'required',
        'longitude' => 'required',
        'capacity' => 'required|integer|min:1',
        'isOpen' => 'nullable|boolean',
    ]);

    $floor = new Floor();
    $floor->name = $request->name;
    $floor->latitude = $request->latitude;
    $floor->longitude = $request->longitude;
    $floor->capacity = $request->capacity;
    $floor->isOpen = $request->input('isOpen', false);
    $floor->parking_id = $parking->id;

    $floor->save();

    return redirect()->route('parkings.floorsparking', $parking->id)
                     ->with('success', 'Planta creada exitosament.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $floors = Floor::findOrFail($id);
        $parking = Parking::all();

        return view("floors.show")->with('floors',$floors)->with('parking',$parking);;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $floor = Floor::findOrFail($id);
        $parkings = Parking::all();

        return view("floors.edit")->with('floor',$floor)->with('parkings',$parkings);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required|unique:floors,name,' . $id]); //comprovar que funciona!!!
        $request->validate(['latitude' => 'required']);
        $request->validate(['longitude' => 'required']);
        $request->validate(['capacity' => 'required']);
        $request->validate(['isOpen' => 'nullable|boolean']);

        $floor = Floor::findOrFail($id);

        $floor->name=$request->name;
        $floor->latitude=$request->latitude;
        $floor->longitude=$request->longitude;
        $floor->capacity=$request->capacity;
        $floor->isOpen = $request->input('isOpen', 0);

        $floor->save();

        return redirect()->route('parkings.floorsparking', $floor->parking_id)
        ->with('success', 'Planta editada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $floor = Floor::findOrFail($id);
        $parking_id = $floor->parking_id;

        try {
            $floor->delete();
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('parkings.floorsparking', ['parking' => $parking_id])
                            ->with('error', 'Error esborrant la planta');
        }

        //return redirect("/parkings")->with('success','Parking esborrat');  RETURN ORIGINAL

        return redirect()->route('parkings.floorsparking', ['parking' => $parking_id])
        ->with('success', 'Planta esborrada correctament');
    }

    public function slotsFloor(String $id) 
    {
        $floor = Floor::findOrFail($id);

        $parking = $floor->parking;

        $arrayId = $floor->parkingslots->pluck('id');
        
        $slots = ParkingSlot::whereIn('id',$arrayId)->get();
       
        
        return view('floors.slotsFloor')->with('floor',$floor)->with('slots',$slots)->with('parking', $parking);
    }
public function assignPlateForm($floorId, $slotId)
{
    $slot = ParkingSlot::findOrFail($slotId);

    return view('floors.assignPlate', compact('slot', 'floorId'));
}

public function assignPlate(Request $request, $floorId, $slotId)
{
    $slot = ParkingSlot::findOrFail($slotId);

    $slot->assignedPlate = $request->input('assignedPlate');
    $slot->slotStatus = 'open';
    $slot->assigned = true; 
    $slot->save();

    return redirect()->route('floors.slotsfloor', ['floor' => $floorId])->with('success', 'Matricula assignada correctament');
}


}
