<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'url', 'type'];
    public $timestamps = false;

    public function user() { return $this->belongsTo(User::class); }
}
