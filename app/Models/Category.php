<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'user_id',
    ];
    protected $casts = [
    'type' => 'string',
    ];

    protected $with = ['transactions'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function isIncome(): bool {
    return $this->type === 'income';
    }

    public function isExpense(): bool {
        return $this->type === 'expense';
    }

}
