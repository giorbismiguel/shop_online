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

    public function products()
    {
        try {
            $this->_view->set('title', 'Products List');

            $products = $this->_model->getProducts();
            $this->_view->set('products', $products);

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:".$e->getMessage();
        }
    }
}
