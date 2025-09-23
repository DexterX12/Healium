<?php

/*
* Author: Miguel Salinas
*/

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Supplier extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the supplier primary key (id)
     * $this->attributes['name'] - string - contains the supplier name
     * $this->attributes['email'] - string - contains the supplier email
     * $this->attributes['address'] - string - contains the supplier address
     * $this->drugs - drugs[] - contains a list of associated drugs
     */
    protected $fillable = [
        'name',
        'email',
        'address',
    ];

    protected static array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:suppliers,email',
        'address' => 'required|string|max:500',
    ];

    /*
     * GETTERS
    */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function getCreatedAtTimestamp(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtTimestamp(): string
    {
        return $this->attributes['updated_at'];
    }

    public function getDrugs(): Collection
    {
        return $this->attributes['drugs'];
    }

    /*
     * SETTERS
    */
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function setCreatedAtTimestamp(Carbon $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function setUpdatedAtTimestamp(Carbon $updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function setDrugs(Collection $drugs): void
    {
        $this->attributes['drugs'] = $drugs;
    }

    /*
     * VALIDATE
    */
    public static function validate(array $supplierDataValidated): array
    {
        return validator($supplierDataValidated, static::$rules)->validate();
    }

    public function drugs(): HasMany
    {
        return $this->hasMany(Drug::class);
    }
}
