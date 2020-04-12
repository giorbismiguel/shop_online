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
            $this->view->set('title', 'Products List');

            var_dump($_SESSION['shopping_cart']);

            return $this->view->output();

        } catch (Exception $e) {
            echo 'Application error:'.$e->getMessage();
        }
    }

    /**
     * @throws Exception
     */
    public function add()
    {
        if (!isset($_POST['product_id'])) {
            $this->view->output_json([
                'success' => false,
            ]);
        }

        $productId = $_POST['product_id'];

        $productModel = new ProductModel();
        $product = $productModel->getProductById($productId);

        $cartArray = [
            $product['id'] => [
                'id'       => $product['id'],
                'name'     => $product['name'],
                'price'    => $product['price'],
                'quantity' => 1,
                'weight'   => $product['weight'],
            ]
        ];

        if (empty($_SESSION['shopping_cart'])) {
            $_SESSION['shopping_cart'] = $cartArray;

            $this->view->output_json([
                'success' => true,
                'message' => 'The product has been added to your cart!.',
            ]);

            return;
        }

        $arrayKeys = array_keys($_SESSION['shopping_cart']);
        if (in_array($_POST['product_id'], $arrayKeys)) {
            $this->view->output_json([
                'success' => true,
                'message' => 'The product is already added to your cart!.',
            ]);

            return;
        }

        $_SESSION['shopping_cart'] = array_merge(
            $_SESSION['shopping_cart'],
            $cartArray
        );

        $this->view->output_json([
            'success' => true,
            'message' => 'The product has been added to your cart!.',
        ]);
    }

    public function delete()
    {
        
    }
}
