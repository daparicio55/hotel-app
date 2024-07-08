<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
class PayController extends Controller
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
        $pays = Pay::get();
        return view('pays.index',compact('pays'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $reservations = Reservation::doesntHave('pay')->get();
        return view('pays.create',compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $number = $this->new_number($request->type);
            $pay = new Pay();
            $pay->number = $number;
            $pay->date = $request->date;
            $pay->reservation_id = $request->reservation;
            $pay->type = $request->type;
            $pay->pago = $request->pago;
            $pay->user_id = auth()->id();
            $pay->save();
        } catch (\Throwable $th) {
            return Redirect::route('pays.index')->with('error','Error al registrar el pago');
        }
        return Redirect::route('pays.index')->with('success','Pago registrado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pay = Pay::find($id);
        /* $pdf = Pdf::loadView('reservations.show', compact('reservation'));
        return $pdf->download('invoice.pdf'); */  
        $pdf = PDF::loadView('pays.show', compact('pay'));
        return $pdf->download('invoice.pdf');
        return view('pays.show',compact('pay'));
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
    protected function new_number($type)
    {
        $last = Pay::where('type','=',$type)->latest()->first();
        if($last){
            return $last->number + 1;
        }
        return 1;
    }
}
