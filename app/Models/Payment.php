<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id', 'payment_method', 'amount', 'currency',
        'payment_type', 'payment_status', 'transaction_details', 'payment_date'
    ];
    public $timestamps = false;

    public function reservation() { return $this->belongsTo(Reservation::class); }
}