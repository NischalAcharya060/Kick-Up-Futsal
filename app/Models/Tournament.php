<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'map_coordinates', 'start_date', 'end_date'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'tournament_team')->withTimestamps();
    }
}
