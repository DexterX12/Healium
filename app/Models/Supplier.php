<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the supplier primary key (id)
     * $this->attributes['name'] - string - contains the supplier name
     * $this->attributes['email'] - string - contains the supplier email
     * $this->attributes['address'] - string - contains the supplier address
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
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCreatedAt(): Date
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Date
    {
        return $this->updated_at;
    }

    public function getDrugs(): Drug
    {
        return $this->drugs;
    }
    /*
     * SETTERS
    */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setDrugs(Drug $drugs): void
    {
        $this->drugs = $drugs;
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
