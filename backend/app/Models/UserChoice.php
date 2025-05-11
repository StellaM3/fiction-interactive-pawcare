<?php

// app/Models/UserChoice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChoice extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'choice_id'];

    public function choice() { return $this->belongsTo(Choice::class); }
    public function user()   { return $this->belongsTo(User::class);   }
}
