<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Parking;
use App\Models\ParkingSlot;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::paginate(5);

        return view("tickets.index")->with('tickets',$tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $parking_id)
{
    $parking = Parking::findOrFail($parking_id);
    return view("tickets.create")->with('parking', $parking);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $parking_id)
{
    $parking = Parking::findOrFail($parking_id);

    $request->validate([
        'plate' => 'required',
        'entryTime' => 'required',
        'exitTime' => 'required',
        'totalTime' => 'nullable',
        'totalPay' => 'nullable',
        'isPaid' => 'nullable|boolean',
    ]);

    $ticket = new Ticket();
    $ticket->plate = $request->plate;
    $ticket->entryTime = $request->entryTime;
    $ticket->exitTime = $request->exitTime;
    $ticket->totalTime = $request->totalTime;
    $ticket->isPaid = $request->input('isPaid', false);
    $ticket->totalPay = round($request->totalPay, 2);  
    $ticket->parking_id = $parking->id;

    $ticket->save();

    return redirect()->route('parkings.ticketsparking', $parking->id)
                     ->with('success', 'Ticket creat correctament.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tickets = Ticket::findOrFail($id);
        $parking = Parking::all();

        return view("tickets.show")->with('tickets',$tickets)->with('parking',$parking);;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $parkings = Parking::all();

        return view("tickets.edit")->with('ticket',$ticket)->with('parkings',$parkings);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $ticket = Ticket::findOrFail($id);
    $parking = $ticket->parking;

    $request->validate([
        'plate' => 'required',
        'entryTime' => 'required',
        'exitTime' => 'required',
        'totalTime' => 'nullable',
        'totalPay' => 'nullable',
        'isPaid' => 'nullable|boolean',
        'paymentOption' => 'nullable|string|in:card,cash,paypal,bitcoin,coupon',
    ]);

    $ticket->plate = $request->plate;
    $ticket->entryTime = $request->entryTime;
    $ticket->exitTime = $request->exitTime;
    $ticket->totalTime = $request->totalTime;
    $ticket->isPaid = $request->input('isPaid', false);
    $ticket->totalPay = round($request->totalPay, 2);
    $ticket->parking_id = $parking->id;
    $ticket->paymentOption = $request->paymentOption;

    $ticket->save();

    return redirect()->route('parkings.ticketsparking', $parking->id)
                     ->with('success', 'Ticket actualitzat.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $parking_id = $ticket->parking_id;

        try {
            $ticket->delete();
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('parkings.ticketsparking', ['parking' => $parking_id])
                            ->with('error', 'Error esborrant el ticket');
        }

        //return redirect("/parkings")->with('success','Parking esborrat');  RETURN ORIGINAL

        return redirect()->route('parkings.ticketsparking', ['parking' => $parking_id])
        ->with('success', 'Ticket esborrat correctament');
    }

    //Funció per sumar tots els tickets -> stats
        public function totalEarnings($parking_id)
    {
        $totalEarnings = Ticket::where('parking_id', $parking_id)
            ->where('isPaid', true) // Solo considerar tickets pagados
            ->sum('totalPay');

        $parking = Parking::findOrFail($parking_id);

        return view('stats.earnings', compact('totalEarnings', 'parking'));
    }

}
