<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAlert extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reservation_id', 'event_type', 'alert_date', 'sent'];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class); }
    public function reservation() { return $this->belongsTo(Reservation::class); }
}
