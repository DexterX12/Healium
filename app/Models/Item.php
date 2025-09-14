<?php


use App\Models\Drug;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['drug_id'] - string - contains the ordered drug's id
     * $this->attributes['order_id'] - string - contains the order's id
     * $this->attributes['quantity'] - int - contains the ordered amount of an item
     * $this->attirbutes['total'] - int - contains the total of the order
     * this->drug - Drug - contains the associated drug
     * this->order - Order - contains the associated order
    **/

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

    public function getDrug(): Drug
    {
        return $this->drug;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    /* SETTERS */

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

    public function setDrug(Drug $drug): void
    {
        $this->drug = $drug;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }
}
