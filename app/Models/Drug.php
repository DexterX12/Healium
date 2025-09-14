<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Drug extends Model
{

    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the drug primary key (id)
     * $this->attributes['supplier_id'] - int - contains the supplier associated to the drug
     * $this->attributes['name'] - string - contains the drug name
     * $this->attributes['description'] - string - contains the drug description
     * $this->attributes['category'] - string - contains the drug category
     * $this->attributes['chemical_details'] - string - contains the drug quimic details
     * $this->attributes['keywords'] - string - contains the drug keywords
     * $this->attributes['price'] - int- contains the drug price
     * $this->attributes['created_at'] - date - contains the drug creation date
     * $this->attributes['updated_at'] - date - contains the drug update date
     */

    protected $fillable = [
        'name',
        'description',
        'creation_date',
        'category',
        'chemical_details',
        'keywords',
        'price',
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'category' => 'required|string|max:60',
        'chemical_details' => 'required|string|max:255',
        'price' => 'required|integer|min:0',
    ];

    /*
     *GETTERS
    */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function getChemicalDetails(): string
    {
        return $this->attributes['chemical_details'];
    }

    public function getKeywords(): string
    {
        return $this->attributes['keywords'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getCreatedAtTimestamp(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAtTimestamp(): Carbon
    {
        return $this->attributes['updated_at'];
    }

    public function getSupplier(): int
    {
        return $this->attributes['supplier_id'];
    }
    /*
     *SETTERS
    */
    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setCategory(string $category): void
    {
        $this->attributes['category'] = $category;
    }

    public function setCreatedAtTimestamp(Carbon $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function setUpdatedAtTimestamp(Carbon $updatedAt): void
    {
        $this->attributes['created_at'] = $updatedAt;
    }

    public function setChemicalDetails(string $chemicalDetails): void
    {
        $this->attributes['chemical_details'] = $chemicalDetails;
    }

    public function setKeywords(string $keywords): void
    {
        $this->attributes['keywords'] = $keywords;
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setSupplier(int $id): void
    {
        $this->attributes['supplier_id'] = $id;
    }

    /*
     * VALIDATE
    */
    public static function validate(array $drugDataValidated): array
    {
        return validator($drugDataValidated, static::$rules)->validate();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}

