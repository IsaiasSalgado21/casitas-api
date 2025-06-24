<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'capacity', 'size_m2', 'price_per_night', 'latitude', 'longitude', 'active'
    ];

    public $timestamps = false;

    public function images() { return $this->hasMany(CabinImage::class); }
    public function calendars() { return $this->hasMany(Calendar::class); }
    public function reservations() { return $this->hasMany(Reservation::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}