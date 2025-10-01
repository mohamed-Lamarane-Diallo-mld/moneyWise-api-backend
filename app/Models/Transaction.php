<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'amount',
        'type',
        'description',
        'date',
    ];

    protected $casts = [
        'amount' => 'float',
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isIncome()
    {
        return $this->type === 'income';
    }

    public function isExpense()
    {
        return $this->type === 'expense';
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

  // date 
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value
                ? Carbon::parse($value)->locale('fr')->translatedFormat('d F Y')
                : null
        );
    }
}
