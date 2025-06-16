<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\Floor;
use App\Models\Ticket;
use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parkings = Parking::with('reports')->get(); 
    
        return view('reports.index', compact('parkings')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear un nuevo reporte
        $parkings = Parking::all();
        return view('reports.create', compact('parkings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'parking_id' => 'required|exists:parkings,id', 
        'title' => 'required|string|max:255',
    ]);

    $totalIngressos = Ticket::where('parking_id', $request->parking_id)
        ->where('isPaid', true)
        ->sum('totalPay');

    $totalTickets = Ticket::where('parking_id', $request->parking_id)->count();

    $avgTime = Ticket::where('parking_id', $request->parking_id)
    ->whereNotNull('entryTime')
    ->whereNotNull('exitTime')
    ->get()
    ->avg(function ($ticket) {
        $entryTime = Carbon::parse($ticket->entryTime);
        $exitTime = Carbon::parse($ticket->exitTime);

        return $entryTime->diffInMinutes($exitTime);
    });

    $avgTime = round($avgTime, 2);

    $report = new Report();
    $report->title = $request->title;
    $report->total_ingressos = $totalIngressos;
    $report->total_tickets = $totalTickets;
    $report->avg_time = $avgTime;
    $report->created_at = now();
    $report->parking_id = $request->parking_id; // Asociar el parking al informe

    $report->save();

    return redirect()->route('reports.index')
        ->with('success', 'Informe creado correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $report = Report::with('parking')->findOrFail($id);
    $parking = $report->parking;

    $floors = $parking->floors;

    $occupied = 0;
    $available = 0;

    foreach ($floors as $floor) {
        $occupied += $floor->parkingslots()->where('slotStatus', 'occupied')->count();
        $available += $floor->parkingslots()->where('slotStatus', 'open')->count();
    }

    return view('reports.show', compact('report', 'occupied', 'available'));
}

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $report = Report::findOrFail($id);

    $parkings = Parking::all();

    return view('reports.edit', compact('report', 'parkings'));
}

public function update(Request $request, string $id)
{
    // Validar datos de entrada
    $request->validate([
        'title' => 'required|string|max:255',
        'parking_id' => 'required|exists:parkings,id',
    ]);

    // Actualizar el reporte
    $report = Report::findOrFail($id);
    $report->title = $request->title;
    $report->parking_id = $request->parking_id; 
    $report->updated_at = now();
    $report->save();

    return redirect()->route('reports.index')
        ->with('success', 'Informe actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar un reporte
        $report = Report::findOrFail($id);

        try {
            $report->delete();
            return redirect()->route('reports.index')
                ->with('success', 'Informe eliminat correctament.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('reports.index')
                ->with('error', 'Error al eliminar el informe.');
        }
    }

    public function downloadReport(Request $request, $id)
{
    $report = Report::findOrFail($id);
    $parking = $report->parking;

    $totalIngressos = Ticket::where('parking_id', $parking->id)
        ->where('isPaid', true)
        ->sum('totalPay');

    $totalTickets = Ticket::where('parking_id', $parking->id)->count();

    $avgTime = Ticket::where('parking_id', $parking->id)
        ->whereNotNull('entryTime')
        ->whereNotNull('exitTime')
        ->get()
        ->avg(function ($ticket) {
            $entryTime = Carbon::parse($ticket->entryTime);
            $exitTime = Carbon::parse($ticket->exitTime);

            return $entryTime->diffInMinutes($exitTime);
        });

    $avgTime = round($avgTime, 2);

    $format = $request->input('format', 'txt'); // Predeterminado a txt

    if ($format == 'csv') {
        $content = "Títol,Data de creació,Data d'actualització,Ingressos totals,Total de tiquets,Temps mitjà de permanència,Nom del parking,Ubicació,Plantes disponibles\n";
        $content .= "{$report->title},{$report->created_at->format('d/m/Y H:i')},{$report->updated_at->format('d/m/Y H:i')},{$totalIngressos},{$totalTickets},{$avgTime},{$parking->name},{$parking->location},{$parking->floors->count()}\n";

        $fileName = 'informe_' . $report->id . '.csv';

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    } else {
        $content = "Títol: " . $report->title . "\n";
        $content .= "Data de creació: " . $report->created_at->format('d/m/Y H:i') . "\n";
        $content .= "Data d'actualització: " . $report->updated_at->format('d/m/Y H:i') . "\n";
        $content .= "Ingressos totals: " . $totalIngressos . "\n";
        $content .= "Total de tiquets: " . $totalTickets . "\n";
        $content .= "Temps mitjà de permanència: " . $avgTime . " minuts\n";
        $content .= "Nom del parking: " . $parking->name . "\n";
        $content .= "Ubicació: " . $parking->location . "\n";
        $content .= "Plantes disponibles: " . $parking->floors->count() . "\n";

        $fileName = 'informe_' . $report->id . '.txt';

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}



}
