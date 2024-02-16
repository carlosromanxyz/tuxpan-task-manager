<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = ['title', 'description', 'user_id'];

    /**
     * Get the user who created the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
