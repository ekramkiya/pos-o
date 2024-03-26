<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = ['description','amount','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserFullName()
    {
        if ($this->user) {
            return $this->user->first_name . ' ' . $this->user->last_name;
        }
    }

    use HasFactory;
}
