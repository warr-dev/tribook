<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table='booking';

    protected $fillable=[
        'passengers','user_id','pickup','destination','book_date','book_time','status','remarks','type'
    ];

    protected $dates=[
        'book_date'
    ];

    public function dateformatted()
    {
        return date('m/d/Y', strtotime($this->book_date));
    }
    public function drivers()
    {
        return $this->belongsToMany(Tricycle::class,'booking_drivers','booking_id','driver_id');
    }
}
