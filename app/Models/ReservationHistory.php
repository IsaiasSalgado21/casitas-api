<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationHistory extends Model
{
    use HasFactory;

    protected $primaryKey= 'history_id';
    protected $fillable = ['user_id', 'reservation_id', 'previous_status', 'new_status', 'event_date', 'details'];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class); }
    public function reservation() { return $this->belongsTo(Reservation::class); }
}
