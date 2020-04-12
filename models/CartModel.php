<?php

class CartModel extends Model
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function getCart()
    {
        $sql = 'SELECT * from products';

        $this->setSql($sql);
        $products = $this->getAll();

        if (empty($products)) {
            return [];
        }

        return $products;
    }
}