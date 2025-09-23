<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * COMMENT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['drug_id'] - int - contains the drug id associated to the comment
     * $this->attributes['user_id'] - int - contains the user id associated to the comment
     * $this->attributes['description'] - string - contains the comment description
     *
     * RELATIONSHIPS
     * $this->drug - Drug - contains the associated Drug
     * $this->user - User - contains the associated user
     */
    protected $fillable = ['description', 'drug_id', 'user_id'];

    public static array $rules = [
        'description' => 'required|max:500',
        'drug_id' => 'required|exists:drugs,id',
        'user_id' => 'required|exists:users,id',
    ];

    /** GETTERS */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getDrugId(): int
    {
        return $this->attributes['drug_id'];
    }

    public function getCreatedAtTimestamp(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtTimestamp(): string
    {
        return $this->attributes['updated_at'];
    }

    /**SETTERS */

    public function setDescription(string $desc): void
    {
        $this->attributes['description'] = $desc;
    }

    public function setDrugId(int $pId): void
    {
        $this->attributes['drug_id'] = $pId;
    }

    public function setUserId(int $pId): void
    {
        $this->attributes['user_id'] = $pId;
    }

    public function setCreatedAtTimestamp(string $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function setUpdatedAtTimestamp(string $updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    /** RELATIONSHIPS */
    public function drug(): BelongsTo
    {
        return $this->belongsTo(Drug::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /* VALIDATIONS */

    public static function validate(array $commentData): array
    {
        return validator($commentData, static::$rules)->validate();
    }
}
