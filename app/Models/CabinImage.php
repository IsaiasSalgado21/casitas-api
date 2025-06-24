<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinImage extends Model
{
    use HasFactory;

    protected $fillable = ['cabin_id', 'url', 'description'];
    public $timestamps = false;

    public function cabin() { return $this->belongsTo(Cabin::class); }
}
