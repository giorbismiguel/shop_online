<?php


class CartController extends Controller
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

    public function cart()
    {
        try {
            $this->_view->set('title', 'Products List');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:".$e->getMessage();
        }
    }

}