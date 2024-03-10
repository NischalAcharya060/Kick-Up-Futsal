<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'facility_id',
        'payment_method',
        'amount',
        'user_name',
        'email',
        'contact_number',
        'booking_date',
        'booking_time',
        'receipt_file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
