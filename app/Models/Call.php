<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Call extends Model
{
    protected $dates = [ 'created_at', 'deadline_date', 'resolved_at'];
    protected $fillable = ['title', 'description', 'category_id', 'situation_id'];
    public $timestamps = false; // Desativa os timestamps automáticos
    
    // Defina os valores dos campos current_date e future_date ao criar um novo registro
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = Carbon::now();
            $model->deadline_date = Carbon::now()->addDays(3);

            // Define a situação como 'novo' se não for especificada
            if (!$model->situation_id) {
                $model->situation_id = Situation::where('name', 'novo')->first()->id;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }
}
