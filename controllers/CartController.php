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
            $this->view->set('sub_total', 0);
            $this->view->set('shipping', 0);
            $this->view->set('current_balance', $_SESSION['current_balance']);

            return $this->view->output();

        } catch (Exception $e) {
            echo 'Application error:'.$e->getMessage();
        }
    }

    public function add()
    {
        if (!isset($_POST['product_id'])) {
            $this->view->output_json([
                'success' => false,
            ]);
        }

        $productId = (int) $_POST['product_id'];

        $productModel = new ProductModel();
        $product = $productModel->getProductById($productId);

        if (!$product) {
            $this->view->output_json([
                'success' => true,
                'message' => 'The product don\'t exist!.',
            ]);

            return;
        }

        $key = $productId.'_'.strtolower($product['name']);
        $cartArray = [
            $key => [
                'id'       => $productId,
                'name'     => $product['name'],
                'price'    => $product['price'],
                'quantity' => 1,
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
        if (in_array($key, $arrayKeys)) {
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
        if (!empty($_SESSION['shopping_cart'])) {
            foreach ($_SESSION['shopping_cart'] as $key => $product) {
                if ((int) $_POST['cart_id'] === (int) $key) {
                    unset($_SESSION['shopping_cart'][$key]);
                    $this->view->output_json([
                        'success' => true,
                        'message' => 'Product is removed from your cart!.',
                    ]);
                }

                if (empty($_SESSION['shopping_cart'])) {
                    unset($_SESSION['shopping_cart']);
                }
            }
        }
    }

    public function updateQuantity()
    {
        if (!empty($_SESSION['shopping_cart'])) {
            $position = 1;

            foreach ($_SESSION['shopping_cart'] as $key => $product) {
                if (isset($_POST['cart_id']) &&
                    (int) $_POST['cart_id'] === (int) $key &&
                    isset($_POST['qty'])
                ) {
                    if ((int) $_POST['qty'] <= 0) {
                        $this->view->output_json([
                            'success' => true,
                            'message' => "The product {$product['name']} in the position: $position can not negative.",
                        ]);
                    }

                    if (isset($_SESSION['shopping_cart'][$key]['quantity'])) {
                        $_SESSION['shopping_cart'][$key]['quantity'] = $_POST['qty'];
                        $this->view->output_json([
                            'success' => true,
                            'message' => 'The quantity has been updated!.',
                        ]);

                        return;
                    }

                    $this->view->output_json([
                        'success' => false,
                    ]);
                }

                $position++;
            }
        }
    }

    public function pay()
    {
        if (!empty($_SESSION['shopping_cart'])) {
            $_SESSION['current_balance'] = $_SESSION['current_balance'] - $_POST['cart_total'];
            $this->view->output_json([
                'success' => true,
                'message' => 'The pay has been successfully!.',
            ]);

            unset($_SESSION['shopping_cart']);

            return;
        }

        $this->view->output_json([
            'success' => false,
        ]);
    }
}
