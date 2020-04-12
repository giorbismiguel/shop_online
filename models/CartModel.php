<?php

class CartModel
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function getCart()
    {
        $sql = 'SELECT * from products';

        $this->_setSql($sql);
        $products = $this->getAll();

        if (empty($products)) {
            return [];
        }

        return $products;
    }
}