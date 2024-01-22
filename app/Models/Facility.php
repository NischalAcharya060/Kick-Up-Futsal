<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'map_coordinates',
        'rating',
        'image_path',
        'status',
    ];

    public static function findOrFail($id)
    {
        $model = static::find($id);

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(get_class($model));
        }

        return $model;
    }

    public function notification()
    {
        return $this->hasOne(Notification::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
