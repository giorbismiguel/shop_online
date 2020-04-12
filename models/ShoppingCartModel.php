<?php


class ShoppingCartModel extends Model
{
    private $productId;

    private $quantity;

    public function setProduct($id)
    {
        $this->productId = $id;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
