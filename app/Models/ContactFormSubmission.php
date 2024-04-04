<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'subject', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
