<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['facility_submission_id','user_id', 'message', 'is_read'];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_submission_id');
    }
}
