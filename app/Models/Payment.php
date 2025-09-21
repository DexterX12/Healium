<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Payment extends Model
{
    /**
     * Payment ATTRIBUTES
     * $this->attributes['id'] - int - primary key
     * $this->attributes['user_id'] - int - customer who made the payment
     * $this->attributes['type']- string - payment type (credit card, cash, etc.)
     * $this->attributes['created_at'] - timestamp - payment creation date
     * $this->attributes['updated_at'] - timestamp - payment update date
     *
     * RELATIONSHIPS
     * $this->user - User - the customer who made the payment (N:1)
     * $this->order - Order - the orders asociated to the payment
     */

    protected $fillable = ['user_id', 'type'];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'type'    => 'required|string|max:50',
    ];

    /* GETTERS */

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function getCreatedAtTimestamp(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAtTimestamp(): Carbon
    {
        return $this->updated_at;
    }

    /* SETTERS */

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setType(string $type): void
    {
        $this->attributes['type'] = $type;
    }

    /* FUNCTIONS */

    public function validatePayment(): bool
    {
        
    }

    public function processPayment(Order $order): bool
    {
        
    }

    /* VALIDATIONS */

    public static function validate(array $paymentData): array
    {
        return validator($paymentData, static::$rules)->validate();
    }

    /* RELATIONSHIPS */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
