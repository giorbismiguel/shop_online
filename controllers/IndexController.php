<?php

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     *
     * @param $model
     * @param $action
     */
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {
            $this->view->set('title', 'Products List');
            $product = new ProductModel();

            $products = $product->getProducts();
            $this->view->set('products', $products);

            return $this->view->output();

        } catch (Exception $e) {
            echo "Application error:".$e->getMessage();
        }
    }
}
