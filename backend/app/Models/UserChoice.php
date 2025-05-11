<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChoice extends Model
{
    use HasFactory;

    // ON DÉSACTIVE LES TIMESTAMPS POUR CETTE TABLE
    public $timestamps = false;

    // on autorise juste ces deux clefs
    protected $fillable = ['user_id', 'choice_id'];

    public function choice()   { return $this->belongsTo(Choice::class); }
    public function user()     { return $this->belongsTo(User::class); }
}