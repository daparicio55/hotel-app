<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'start',
        'end',
        'client_id',
        'user_id'
    ];
    public function rooms(){
        return $this->belongsToMany(Room::class, 'reservation_room');
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function pay(){
        return $this->belongsTo(Pay::class);
    }
}
