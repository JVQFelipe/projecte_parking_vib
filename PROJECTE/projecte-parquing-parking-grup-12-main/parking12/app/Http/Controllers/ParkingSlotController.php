<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Floor;
use App\Models\Ticket;
use App\Models\Rate;
use Carbon\Carbon;

use App\Models\ParkingSlot;

class ParkingSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parkingslots = ParkingSlot::paginate(5);

        return view("parkingslots.index")->with('parkingslots',$parkingslots);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $floor_id, string $parking_id)
    {
        $parking = Parking::findOrFail($parking_id);
        $floor = Floor::findOrFail($floor_id);

        return view("parkingslots.create")->with('parking',$parking)->with('floor',$floor);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $floor_id, string $parking_id)
    {
        $floor = Floor::findOrFail($floor_id);
        $parking = Parking::findOrFail($parking_id);

        $request->validate(['name' => 'required | unique:floors']); 
        $request->validate(['slotType' => 'required|in:motorbike,normal,big,adapted']);
        $request->validate(['slotStatus' => 'required|in:open,occupied,closed']);
        $request->validate(['x1' => 'required']);
        $request->validate(['y1' => 'required']);
        $request->validate(['x2' => 'required']);
        $request->validate(['y2' => 'required']);
        

        $parkingslot = new ParkingSlot();

        $parkingslot->name=$request->name;
        $parkingslot->slotType=$request->slotType;
        $parkingslot->slotStatus=$request->slotStatus;
        $parkingslot->x1=$request->x1;
        $parkingslot->y1=$request->y1;
        $parkingslot->x2=$request->x2;
        $parkingslot->y2=$request->y2;
        $parkingslot->floor_id = $floor->id;

        $parkingslot->save();
        return redirect()->route('floors.slotsfloor',$floor->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $parkingslot = ParkingSlot::findOrFail($id);
    $floor = $parkingslot->floor;
    $parking = $floor->parking;

    return view('parkingslots.show')->with('parkingslot', $parkingslot)->with('floor', $floor)->with('parking', $parking);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($parkingSlotId)
{
    $parkingslot = ParkingSlot::findOrFail($parkingSlotId);
    $floor = $parkingslot->floor;

    return view('parkingslots.edit')->with('parkingslot', $parkingslot)->with('floor', $floor);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $parkingslot = ParkingSlot::findOrFail($id);

    $request->validate([
        'name' => 'required|unique:parkingslots,name,' . $id,
        'slotType' => 'required',
        'slotStatus' => 'required',
        'x1' => 'required',
        'y1' => 'required',
        'x2' => 'required',
        'y2' => 'required'
    ]);

    $parkingslot->name = $request->name;
    $parkingslot->slotType = $request->slotType;
    $parkingslot->slotStatus = $request->slotStatus;
    $parkingslot->x1 = $request->x1;
    $parkingslot->y1 = $request->y1;
    $parkingslot->x2 = $request->x2;
    $parkingslot->y2 = $request->y2;

    $parkingslot->save();

    return redirect()->route('floors.slotsfloor', $parkingslot->floor_id)->with('success', 'Plaça actualitzada correctament!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parkingslot = ParkingSlot::findOrFail($id);
        try {
            $parkingslot->delete();
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('floors.slotsfloor', $parkingslot->floor_id)->with('success', 'Error esborrant la plaça');
        }
        return redirect()->route('floors.slotsfloor', $parkingslot->floor_id)->with('success', 'Plaça esborrada correctament');
    }

    //FUNCIO APARCAR

    public function showAparcarForm($id)
{
    $parkingslot = ParkingSlot::findOrFail($id);
    return view('parkingslots.aparcar', compact('parkingslot'));

}

/*public function aparcar(Request $request, string $id)
{
    $request->validate([
        'plate' => 'required|unique:parkingslots,plate,' . $id,
        'slotType' => 'required|in:motorbike,normal,big,adapted',  
    ]);

    //Hay que buscar el parking primero antes de colocar el plate en el parkingslot (tal y como estaba antes no filtraba por parking)
    $parking = Parking::findOrFail($id); 
    
    $parkingslot = ParkingSlot::where('slotType', $request->slotType)
    ->where('slotStatus', 'open')
    ->whereHas('floor', function ($query) use ($parking) {
        $query->where('parking_id', $parking->id);
    })
    ->first();
        if (!$parkingslot) {
        return back()->withErrors(['error' => 'No hi ha places disponibles del tipus seleccionat.']);
    }

    $parkingslot->plate = $request->plate;
    $parkingslot->slotStatus = 'occupied';  

    $parkingslot->save();

    $ticket = new Ticket();
    $ticket->parking_id = $parking->id;
    $ticket->parkingslot_id = $parkingslot->id;    
    $ticket->plate = $request->plate; 
    $ticket->entrytime = now(); 
    $ticket->exittime = null;
    $ticket->totaltime = null;
    $ticket->save();

    return redirect()->route('floors.slotsfloor', $parkingslot->floor_id)->with('success', 'Plaça ocupada correctament!');
}
    */

    public function aparcar(Request $request, string $id)
{
    $request->validate([
        'plate' => 'required',
        'slotType' => 'required|in:motorbike,normal,big,adapted',
    ]);

    $parking = Parking::findOrFail($id);

    // Si el parking es de tipo AssignedSlot
    if ($parking->parkingType === 'AssignedSlot') {
        // Buscar una plaza asignada con la matrícula indicada
        $parkingslot = ParkingSlot::where('slotType', $request->slotType)
            ->where('assigned', true) // Solo buscar plazas asignadas
            ->where('assignedPlate', $request->plate) // Comprobar que la matrícula está asignada
            ->whereHas('floor', function ($query) use ($parking) {
                $query->where('parking_id', $parking->id);
            })
            ->first();

        // Si no se encuentra la plaza asignada, devolver un error
        if (!$parkingslot) {
            return back()->withErrors(['error' => 'No hi ha places assignades per a aquesta matrícula.']);
        }

        // Si la plaza está asignada, se ocupa y se actualiza el estado
        $parkingslot->plate = $request->plate;
        $parkingslot->slotStatus = 'occupied'; // Cambiar a ocupado
        $parkingslot->save();
    } else {
        // Parking normal (sin asignación)
        $parkingslot = ParkingSlot::where('slotType', $request->slotType)
            ->where('slotStatus', 'open')
            ->whereHas('floor', function ($query) use ($parking) {
                $query->where('parking_id', $parking->id);
            })
            ->first();

        if (!$parkingslot) {
            return back()->withErrors(['error' => 'No hi ha places disponibles del tipus seleccionat.']);
        }

        // Asignar la matrícula y marcar como ocupada
        $parkingslot->plate = $request->plate;
        $parkingslot->slotStatus = 'occupied';
        $parkingslot->save();
    }

    // Crear el ticket
    $ticket = new Ticket();
    $ticket->parking_id = $parking->id;
    $ticket->parkingslot_id = $parkingslot->id;
    $ticket->plate = $request->plate;
    $ticket->entrytime = now();
    $ticket->exittime = null;
    $ticket->totaltime = null;
    $ticket->save();

    return redirect()->route('floors.slotsfloor', $parkingslot->floor_id)->with('success', 'Plaça ocupada correctament!');
}

    

public function desaparcar($id)
{
    $parkingslot = ParkingSlot::findOrFail($id);

    if ($parkingslot->slotStatus !== 'occupied') {
        return back()->withErrors(['error' => 'La plaça no està ocupada.']);
    }

    $ticket = Ticket::where('parkingslot_id', $parkingslot->id)
                    ->whereNull('exittime') 
                    ->first();

    if (!$ticket) {
        return back()->withErrors(['error' => 'No s\'ha trobat cap ticket actiu.']);
    }

    $entryTime = Carbon::parse($ticket->entryTime);
    $exitTime = Carbon::now();  
    $ticket->exittime = $exitTime;

    $totalTimeInMinutes = $entryTime->diffInMinutes($exitTime);
    $ticket->totalTime = $totalTimeInMinutes;

    $parking = Parking::findOrFail($ticket->parking_id);

    if ($parking->parkingType === 'AssignedSlot') {
        $rate = Rate::where('name', 'Abonat')->where('isActive', true)->first();
    } else {
        $rate = Rate::where('name', 'Normal')->where('isActive', true)->first();
    }

    if (!$rate) {
        return back()->withErrors(['error' => 'No s\'ha trobat cap tarifa activa.']);
    }

    $totalPay = $rate->ratePerMinute * $totalTimeInMinutes;
    $ticket->totalPay = $totalPay;

    $ticket->save();

    $parkingslot->plate = null;
    $parkingslot->slotStatus = 'open';
    $parkingslot->save();

    return redirect()->route('tickets.show', $ticket->id)->with('success', 'Vehicle desaparcat correctament. Ticket actualitzat.');
}
public function assignForm(ParkingSlot $slot)
    {
        return view('parkingslots.assign', compact('slot'));
    }
    
    public function updateStatus(Request $request, $id)
{
    $slot = ParkingSlot::findOrFail($id);
    $newStatus = $request->input('slotStatus');

    $slot->slotStatus = $newStatus;
    $slot->save();

    return redirect()->back()->with('success', 'L\'estat de la plaça s\'ha actualitzat correctament.');
}

}


