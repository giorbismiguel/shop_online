<?php

class ProductModel extends Model
{
    /**
     * @return array|bool
     * @throws Exception
     */
    public function getProducts()
    {
        $sql = 'select p.id, p.name, p.price, p.image, ceil(avg(r.score)) as average_score from products as p';
        $sql .= ' left join ratings as r on p.id = r.product_id group by p.id';

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
        $product = $this->getRow([$id]);

        if (empty($product)) {
            return false;
        }

        return $product;
    }
}
