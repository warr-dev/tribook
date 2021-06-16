<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tricycle extends Model
{
    use HasFactory;
    protected $table='tricycle';


    protected $fillable=[
        'user_id','name','license','plate_no','cpnum','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
