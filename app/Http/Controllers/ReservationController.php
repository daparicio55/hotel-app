<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $reservations = Reservation::get();
        return view('reservations.index',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id'=>'required|integer',
            'dni'=>'required|string|min:8|max:8',
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
            'date'=>'required|date',
            'days'=>'required|integer',
            'rooms'=>'required|array',
        ]);
        try {
            //code...
            DB::beginTransaction();
            $values = [
                'dni'=>$request->dni,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ];  
            $atributes = [
                'id'=>$request->id,
            ];
            $client = Client::updateOrCreate($atributes, $values);
            //creamos la reserva
            $reservation = Reservation::create([
                'date'=>Carbon::now(),
                'client_id'=>$client->id,
                'start'=>$request->date,
                'end'=>date('Y-m-d', strtotime($request->date. ' + '.$request->days.' days')),
                'user_id'=>auth()->id(),
            ]);
            $reservation->rooms()->sync($request->rooms);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return Redirect::route('reservations.index')->with('error', 'Error al guardar la reserva');
        }
        return Redirect::route('reservations.index')->with('success', 'Reserva guardada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $pdf = Pdf::loadView('reservations.show', compact('reservation'));
        return $pdf->download('invoice.pdf');
        return view('reservations.show',compact('reservation'));
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
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
        } catch (\Throwable $th) {
            return Redirect::route('reservations.index')->with('error', 'Error al eliminar la reserva');
        }
        return Redirect::route('reservations.index')->with('success', 'Reserva eliminada correctamente');
    }
}
