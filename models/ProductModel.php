<?php

class ProductModel extends Model
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function getProducts()
    {
        $sql = 'select * from products';

        $this->setSql($sql);
        $products = $this->getAll();

        if (empty($products)) {
            return [];
        }

        return $products;
    }

    public function getProductById($id)
    {
        $sql = 'select * from products where id = ?';
        $this->setSql($sql);
        $articleDetails = $this->getRow([$id]);

        if (empty($articleDetails)) {
            return false;
        }

        return $articleDetails;
    }
}
