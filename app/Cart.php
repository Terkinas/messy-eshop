<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $quantity)
    {

        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $quantity;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $quantity;
        $this->totalPrice += $item->price * $quantity;
    }

    public function remove($item, $id)
    {
        if ($this->items) {
            if (!array_key_exists($id, $this->items)) {
                return redirect()->route('products.index');
            }
        }
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $item->price * $this->items[$id]['qty'];
        unset($this->items[$id]);
    }

    public function update($item, $id, $quantity)
    {
        $storedItem = ['qty' => $quantity, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $oldQty = $storedItem['qty'];

        if ($quantity > 0) {
            $storedItem['qty'] = $quantity;
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $this->items[$id] = $storedItem;
            $this->totalQty += $quantity - $oldQty;
            $this->totalPrice += ($item->price * $quantity) - ($item->price * $oldQty);
        } else {
            $storedItem['qty'] = $oldQty;
        }
    }
}
