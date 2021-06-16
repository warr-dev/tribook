<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table='profile';

    protected $fillable=[
        'name','address','user_id'
    ];

    public function profile()
    {
        return $this->BelongsTo(User::class);
    }
}
