<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['facility_submission_id', 'message', 'is_read'];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
