<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['drug_id'] - string - contains the ordered drug's id
     * $this->attributes['order_id'] - string - contains the order's id
     * $this->attributes['quantity'] - int - contains the ordered amount of an item
     * $this->attirbutes['total'] - int - contains the total of the order
    **/

    protected $fillable = ['quantity', 'total'];

    /* GETTERS */

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getDrugId(): int
    {
        return $this->attributes['drug_id'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    /* GETTERS */

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function setDrugId(int $drugId): void
    {
        $this->attributes['drug_id'] = $drugId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }
}
