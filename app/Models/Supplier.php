<?php

/*
* Author: Miguel Salinas
*/

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Supplier extends Model
{
    /**
     * SUPPLIER ATTRIBUTES
     * $this->attributes['id'] - int - contains the supplier primary key (id)
     * $this->attributes['name'] - string - contains the supplier name
     * $this->attributes['email'] - string - contains the supplier email
     * $this->attributes['address'] - string - contains the supplier address
     * $this->attributes['created_at'] - timestamp - contains the supplier creation date
     * $this->attributes['updated_at'] - timestamp - contains the supplier update date
     * RELATIONSHIPS
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

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
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

    public function setDrugs(Collection $drugs): void
    {
        $this->attributes['drugs'] = $drugs;
    }

    /*
     * VALIDATE
    */
    public static function validate(array $supplierDataValidated): array
    {
        $rules = static::$rules;

        // ID is present only on updates
        if (array_key_exists("id", $supplierDataValidated)) {
            // Ignore email uniqueness validation.
            // It already exists because this supplier is the owner of that email.
            $rules['email'] = $rules['email'].','.$supplierDataValidated['id'].',id';
        }

        return validator($supplierDataValidated, $rules)->validate();
    }

    
    /*
     * RELATIONSHIPS
    */
    public function drugs(): HasMany
    {
        return $this->hasMany(Drug::class);
    }
}
