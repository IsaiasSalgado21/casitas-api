<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reservation_id'];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class); }
    public function reservation() { return $this->belongsTo(Reservation::class); }
    public function messages() { return $this->hasMany(ChatMessage::class); }
}
