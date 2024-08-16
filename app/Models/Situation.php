<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
