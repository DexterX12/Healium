<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * Order ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['user_id'] - int - contains the id of the user who created the order
     * $this->attirbutes['description'] - string - contains the order details, if applicable
     * $this->attirbutes['payment'] - string - contains the payment method used in the order
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     *
     * RELATIONSHIPS
     * $this->user - User - the user who created the order (N:1)
     * $this->items - Item[] - the list of items belonging to the order (1:N)
     **/
    protected $fillable = [
        'user_id',
        'description',
        'payment',
    ];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'description' => 'nullable|string|max:255',
        'payment' => 'required|string|in:cash,card',
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

    public function getCreatedAtTimestamp(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtTimestamp(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function getPayment(): string
    {
        return $this->attributes['payment'];
    }

    /* SETTERS */

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setPayment(string $payment): void
    {
        $this->attributes['payment'] = $payment;
    }

    /** OTHERS FUNCTIONS */

    /*
    VALIDATIONS
    */

    public static function validate(array $orderData): array
    {
        return validator($orderData, static::$rules)->validate();
    }

    /** RELATIONSHIPS*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
