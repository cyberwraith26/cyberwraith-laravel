<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'type',
        'message',
        'status',
    ];

    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }
}
