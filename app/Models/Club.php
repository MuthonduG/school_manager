<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'club_name',
        'club_leader',
        'founded_date',
        'member_count',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'club_user');
    }
}
