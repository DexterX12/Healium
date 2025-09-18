<?php


use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class Order extends Model
{
    /**
     * Order ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['use_id'] - int - contains the id of the user who created the order
     * $this->attributes['date'] - timestamp - contains the date and the time of the order creation
     * $this->attirbutes['description'] - string - contains the order details, if applicable
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * 
     * RELATIONSHIPS
     * $this->user   - User   - the user who created the order (N:1)
     * $this->items  - Item[] - the list of items belonging to the order (1:N)
    **/


    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'description' => 'nullable|string|max:255',
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

    public function getCreatedAtTimestamp(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtTimestamp(): Carbon
    {
        return $this->attributes['updated_at'];
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
