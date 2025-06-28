<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';
    protected $fillable = ['user_id', 'cabin_id', 'rating', 'comment', 'review_date', 'status'];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class, 'user_id', 'user_id'); }
    public function cabin() { return $this->belongsTo(Cabin::class); }
}
