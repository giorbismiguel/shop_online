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

    /**
     * Show index view
     */
    public function index()
    {
        try {
            $_SESSION['current_balance'] = isset($_SESSION['current_balance']) ? $_SESSION['current_balance'] : 100;

            $this->view->set('title', 'Products List');
            $product = new ProductModel();

            $products = $product->getProducts();
            $this->view->set('products', $products);

            return $this->view->output();
        } catch (Exception $e) {
            echo 'An error has occurred, try again';
        }
    }

    /**
     * Rate product
     *
     * @throws Exception
     */
    public function rate()
    {
        $rate = isset($_POST['rate']) ? (int) $_POST['rate'] : 0;
        $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

        if (!$rate) {
            $this->view->output_json([
                'success' => false,
                'message' => 'An error has occurred when sending data, please try again',
            ]);

            return;
        }

        if (!$productId) {
            $this->view->output_json([
                'success' => false,
                'message' => 'An error has occurred when sending data, please try again',
            ]);

            return;
        }

        $rateModel = new RateModel();
        $sessionId = session_id();

        try {
            $rateMod = $rateModel->getRateBy($sessionId, $productId);
            if ($rateMod) {
                $this->view->output_json([
                    'success' => false,
                    'message' => 'You already rated this product.',
                ]);

                return;
            }

            $rateModel->setSessionId($sessionId);
            $rateModel->setProductId($productId);
            $rateModel->setScore($rate);
            $product = $rateModel->store();
            if ($product) {
                $this->view->output_json([
                    'success' => true,
                    'message' => "Thanks! You rated this $rate stars."
                ]);
            }
        } catch (Exception $e) {
            $this->view->output_json([
                'success' => false,
                'message' => 'An error has occurred, try again',
            ]);
        }
    }
}
