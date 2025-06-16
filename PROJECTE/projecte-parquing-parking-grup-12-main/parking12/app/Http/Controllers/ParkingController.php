<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Floor;
use App\Models\Ticket;
use App\Models\Rate;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // admins = tots els parkings

        if ($user->role === 'admin') {
            $parkings = Parking::paginate(5);
        }

        // managers = només parking associat

        elseif ($user->role === 'manager') {
            $parkings = Parking::where('id', $user->parking_id)->paginate(5);

        } else {
            abort(403, 'Accés no autoritzat');
        }

        return view("parkings.index")->with('parkings',$parkings);
    }

    public function create() {
        $parking = Parking::all();
        return view("parkings.create")->with('parking',$parking);
    }

    public function store(Request $request)
    {

        $request->validate(['parkingType' => 'required|in:OpenAccess,PlateRecognition,AssignedSlot,AutomatedRobot',]);        
        $request->validate(['name' => 'required | unique:parkings']); 
        $request->validate(['address' => 'required']);
        $request->validate(['city' => 'required']);
        $request->validate(['openTime' => 'required']);
        $request->validate(['closingTime' => 'required']);
        $request->validate(['latitude' => 'required']);
        $request->validate(['longitude' => 'required']);
        $request->validate(['availableSlots' => 'required']);

        $parking = new Parking();
        $parking->name=$request->name;
        $parking->address=$request->address;
        $parking->city=$request->city;
        $parking->openTime=$request->openTime;
        $parking->closingTime=$request->closingTime;
        $parking->latitude=$request->latitude;
        $parking->longitude=$request->longitude;
        $parking->isOpen = $request->has('isOpen') ? $request->isOpen : false;
        $parking->availableSlots=$request->availableSlots;
        $parking->parkingType=$request->parkingType;

        $parking->save();
        return redirect("/parkings");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parking = Parking::findOrFail($id);
        return view("parkings.show")->with('parking',$parking);
    }

    public function edit($id) {
        $parking = Parking::findOrFail($id);

        return view("parkings.edit")->with('parking',$parking)->with('id',$id);
    }

    public function update(Request $request, string $id)
    {
        $parking = Parking::findOrFail($id);

        $request->validate(['parkingType' => 'required|in:OpenAccess,PlateRecognition,AssignedSlot,AutomatedRobot',]);        
        $request->validate(['name' => 'required | unique:parkings']); 
        $request->validate(['address' => 'required']);
        $request->validate(['city' => 'required']);
        $request->validate(['openTime' => 'required']);
        $request->validate(['closingTime' => 'required']);
        $request->validate(['latitude' => 'required']);
        $request->validate(['longitude' => 'required']);
        $request->validate(['availableSlots' => 'required']);

        $parking->name=$request->name;
        $parking->address=$request->address;
        $parking->city=$request->city;
        $parking->openTime=$request->openTime;
        $parking->closingTime=$request->closingTime;
        $parking->latitude=$request->latitude;
        $parking->longitude=$request->longitude;
        $parking->isOpen = $request->has('isOpen') ? $request->isOpen : false;
        $parking->availableSlots=$request->availableSlots;
        $parking->parkingType=$request->parkingType;

        $parking->save();
        return redirect("/parkings");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parking = Parking::findOrFail($id);
        try {
            $parking->delete();
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect('/parkings')->with('error','Error esborrant el Parking');
        }
        return redirect("/parkings")->with('success','Parking esborrat');
    }
    public function floorsParking(String $id) 
    {
        
        $parking = Parking::findOrFail($id);

        $arrayId = $parking->floors->pluck('id');
        
        $floors = Floor::whereIn('id',$arrayId)->get();
       
        
        return view('parkings.floorsParking')->with('parking',$parking)->with('floors',$floors);
    }
    public function ticketsParking(String $id) 
    {
        
        $parking = Parking::findOrFail($id);

        $arrayId = $parking->tickets->pluck('id');
        
        $tickets = Ticket::whereIn('id',$arrayId)->get();
       
        
        return view('parkings.ticketsParking')->with('parking',$parking)->with('tickets',$tickets);
    }

    public function editRates(String $id) 
{
    $parking = Parking::findOrFail($id);

    $arrayId = $parking->rates->pluck('id');

    $rates = Rate::whereNotIn('id', $arrayId)
                 ->where('isActive', true)
                 ->get();

    return view('parkings.showRates')->with('parking', $parking)->with('rates', $rates);
}


public function assignRate(Request $request, String $id) 
{
    $parking = Parking::findOrFail($id);

    $request->validate([
        'parking_rates' => 'exists:rates,id'
    ]);

    $activeRates = Rate::whereIn('id', $request->parking_rates)
                       ->where('isActive', true)
                       ->pluck('id')
                       ->toArray();

    if (!empty($activeRates)) {
        $parking->rates()->attach($activeRates);
        return redirect()->route('parkings.editrates', $parking->id)
                        ->with('success', 'Tarifes assignades correctament');
    }

    return redirect()->route('parkings.editrates', $parking->id)
                    ->with('error', 'No es poden assignar tarifes inactives.');
}


    
public function detachRate(Request $request, String $id) 
{
    $parking = Parking::findOrFail($id);

    $request->validate([
        'parking_rates' => 'exists:rates,id',
    ]);

    $parking->rates()->detach($request->parking_rates);

    return redirect()->route('parkings.editrates', $parking->id)
                    ->with('success', 'Tarifes extretes correctament');
}
}
