<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_code', 'user_id', 'cabin_id', 'start_date', 'end_date',
        'status', 'total', 'notes', 'reminder_sent'
    ];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class); }
    public function cabin() { return $this->belongsTo(Cabin::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function refunds() { return $this->hasMany(Refund::class); }
    public function chats() { return $this->hasMany(Chat::class); }
    public function histories() { return $this->hasMany(ReservationHistory::class); }
}
