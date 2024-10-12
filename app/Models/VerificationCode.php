<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'code'];

    public function isExpired()
    {
        return $this->created_at->addMinutes(15)->isPast();
    }
}
