<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * $this->attributes['created_at'] - timestamp - contains the drug creation date
     * $this->attributes['updated_at'] - timestamp - contains the drug update date
     * $this->items - Item[] - contains the associated items
     * $this->supplier - Supplier - contains the associated supplier
     * $this->comments - Comment - contains the associated comments
     */
    protected $fillable = [
        'name',
        'supplier_id',
        'description',
        'category',
        'chemical_details',
        'keywords',
        'price',
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'supplier_id' => 'required|exists:suppliers,id',
        'description' => 'required|string|max:255',
        'category' => 'required|string|max:60',
        'chemical_details' => 'required|string|max:255',
        'keywords' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ];

    /*
     *GETTERS
    */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
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

    public function getSupplierId(): int
    {
        return $this->attributes['supplier_id'];
    }

    public function getImage(): string
    {
        return $this->attributes['img_path'];
    }

    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /*
     *SETTERS
    */

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

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

    public function setSupplierId(int $id): void
    {
        $this->attributes['supplier_id'] = $id;
    }

    public function setImage(string $img_path): void
    {
        $this->attributes['img_path'] = $img_path;
    }

    public function setSupplier(Supplier $supplier): void
    {
        $this->supplier = $supplier;
    }

    /*
     * VALIDATE
    */
    public static function validate(array $drugDataValidated): array
    {
        return validator($drugDataValidated, static::$rules)->validate();
    }

    /**RELATIONSHIPS */

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function comments(): HasMany
    {

        return $this->hasMany(Comment::class);

    }

    public static function searchByName(string $name): Collection
    {
        return Drug::where('name', 'LIKE', '%'.$name.'%')->get();
    }

    public static function filterBySales(string $salesFilter): Collection
    {
        if ($salesFilter === 'asc' || $salesFilter === 'desc') {
            return Drug::withSum('items as sales_amount', 'quantity')
                ->orderBy('sales_amount', $salesFilter)
                ->get();
        }

        return Drug::all();
    }
}
