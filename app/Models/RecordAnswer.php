<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'question_type',
        'answer',
    ];

    protected $casts = [
        'answer' => 'array'
    ];
}
