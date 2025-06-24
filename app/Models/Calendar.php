<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = ['cabin_id', 'date', 'status'];
    public $timestamps = false;

    public function cabin() { return $this->belongsTo(Cabin::class); }
}
