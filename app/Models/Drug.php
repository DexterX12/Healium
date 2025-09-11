<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Drug extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the drug primary key (id)
     * $this->attributes['description'] - string - contains the drug description
     * $this->attributes['creation_date'] - date - contains the drug creation date
     * $this->attributes['category'] - string - contains the drug category
     * $this->attributes['quimic_details'] - string - contains the drug quimic details
     * $this->attributes['keywords'] - string - contains the drug keywords
     * $this->attributes['price'] - int- contains the drug price
     * $this->attributes['supplier_id'] - int - contains the supplier associated to the drug
     */
    protected $fillable = [
        'description',
        'creation_date',
        'category',
        'quimic_details',
        'keywords',
        'price',
    ];

    public static array $rules = [
        'description' => 'required|string|max:255',
        'creation_date' => 'requited|date',
        'category' => 'required|string|max:60',
        'quimic_details' => 'required|string|max:255',
        'price' => 'required|integer|min:0',
    ];

    /*
     *GETTERS
    */
    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCreatedDate(): Date
    {
        return $this->creation_date;
    }

    public function getQuimicDetails(): string
    {
        return $this->quimic_details;
    }

    public function getKeywords(): string
    {
        return $this->keywords;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCreatedAt(): Date
    {
        return $this->created_at;
    }

    public function getUpdatedAtColumn(): Date
    {
        return $this->updated_at;
    }

    /*
     *SETTERS
    */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function setCreationDate(Date $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function setQuimicDetails(string $quimic_details): void
    {
        $this->quimic_details = $quimic_details;
    }

    public function setKeywords(string $keywords): void
    {
        $this->keywords = $keywords;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /*
     * VALIDATE
    */
    public static function validate(array $drugDataValidated): array
    {
        return validator($drugDataValidated, static::$rules)->validate();
    }
}
