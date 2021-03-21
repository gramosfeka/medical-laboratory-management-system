<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Test;
use App\Models\User;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'date_of_birth',
        'phone_number',
        'email',
        'date',
        'time',
        'status',
        'user_id',
        'employee_id',
        'file'
    ];

    protected $cast = [
        'times' => 'array'
    ];


    public function tests(){
        return $this->belongsToMany(Test::class);
     }

     public function users()
    {
        return $this->belongsTo(User::class);
    }
}
