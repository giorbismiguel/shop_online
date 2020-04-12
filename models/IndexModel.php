<?php

class IndexModel extends Model
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function getProducts()
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
