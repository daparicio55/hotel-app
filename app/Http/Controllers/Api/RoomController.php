<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function free_rooms(Request $request){        
        $request->validate([
            'date' => 'required|date',
            'days' => 'required|integer',
        ]);
        try {
            $startDate = Carbon::parse($request->date);
            $endDate = Carbon::parse($request->date)->addDays($request->days);
            // Realiza la consulta de las reservas que esten en el rango de fechas
            $reservations = Reservation::whereBetween('start', [$startDate, $endDate])
            ->orWhereBetween('end', [$startDate, $endDate])
            ->get();
            $ar_ocuped_rooms = [];
            foreach ($reservations as $reservation) {
                foreach ($reservation->rooms as $room) {
                    $ar_ocuped_rooms[] = [
                        $room->id,
                    ];
                }
            }
            $free_rooms = Room::whereNotIn('id', $ar_ocuped_rooms)->get();
            return response()->json([
                'message' => 'Bien',
                'data'=>[
                    'free_rooms'=>$free_rooms,
                ]
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Error',
                'data'=>[
                    'error'=>$th->getMessage(),
                ]
            ]);
        }      
    }
}
