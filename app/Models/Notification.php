<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_id'; 
    protected $fillable = ['user_id', 'type', 'message', 'read', 'sent_at'];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class); }
}