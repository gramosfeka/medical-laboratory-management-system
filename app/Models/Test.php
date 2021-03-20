<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'interpretation',
        'price',
    ];

    public function appointments(){
        return $this->belongsToMany(Appointment::class);
     }
}
