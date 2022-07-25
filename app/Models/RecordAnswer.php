<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class RecordAnswer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'record_answers';

    protected $fillable = [
        'user_id',
        'answer',
    ];

    protected $casts = [
        'answer' => 'array'
    ];
}
