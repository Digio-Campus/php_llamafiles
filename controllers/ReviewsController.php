<?php
require 'models/Model.php';
require 'libs/API.php';
require 'libs/AI.php';

class ReviewsController
{
    public $view;
    private $db = 0;
    private $products;

    function __construct()
    {
        $this->db = new Model();
        $this->products = $this->db->getProducts();
        $this->view = new View();
    }

    public function getInicio()
    {
        // if (isset($_REQUEST['id']) && $_REQUEST['id'] !== null)
        //     $_SESSION['product'] = $_POST['id'];


        $this->view->show("indexView.php", array("products" => $this->products));
    }

    public function insertProduct()
    {
        $db_products = $this->db->getProducts();
        $isAlreadyInDB = false;

        if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Cargar") {

            if ($db_products !== null) {

                // Analizamos cada producto en la DB en busca de alguna coincidencia..
                foreach ($db_products as $product) {
                    if ($product['asin'] == $_POST['asin']) {
                        $isAlreadyInDB = true;

                        // Si ya existe el producto en la DB, no hacemos nada.
                        break;
                    }
                }
            }

            if ($isAlreadyInDB != true) {
                $product = fetchProduct($_POST['asin']);
                $reviews = fetchProductReviews($_POST['asin']);


                // Comprobamos que las solicitudes a la API nos han devuelto datos..
                if ($product !== null) {
                    if ($reviews !== null) {

                    $total_reviews = $reviews['data']['total_reviews'];
                    $this->db->setProduct($product, $total_reviews);

                    $product_id = $this->db->getProductIdByASIN($_POST['asin']);

                    $data = [
                        'products' => $db_products,
                        'product' => $this->db->getProduct($product_id),
                    ];

                    // echo 'ID DEL PRODUCTO INTRODUCIDO ' . $product_id;
                    // var_dump($product_id);

                    // var_dump($reviews);

                        foreach ($reviews['data'] as $key => $value) {

                            if ($key != 'reviews') {
                                echo 'KEY: ' . $key . ' VALUE: ' . $value . '<br>';
                            }

                            if ($key == 'reviews') {
                                if (is_array($value) && count($value) > 0) {
                                    foreach ($value as $review) {
                                        $this->db->setReview($review, $product_id['id']);
                                    }
                                }
                            }
                        }
                        header("Location: index.php");
                    }
                }
            }
        }
        $this->view->show("indexView.php", $data);
    }

    public function inspectProduct()
    {
        $data = [];

        if (isset($_POST['id']) && $_POST['id'] !== null) {
            $_SESSION['product_id'] = $_POST['id'];
            $reviews = $this->db->getReviews($_POST['id']);
            $product = $this->db->getProduct($_POST['id']);

            $product = $this->db->getProduct($_POST["id"]);

            $data = [
                'product' => $product,
                'product_id' => $_POST['id'],
                'reviews' => $reviews
            ];

            $this->view->show('inspectView.php', $data);
        } else {
            $reviews = $this->db->getReviews($_SESSION['product_id']);
            $product = $this->db->getProduct($_SESSION['product_id']);

            $data = [
                'product' => $product,
                'product_id' => $_SESSION['product_id'],
                'reviews' => $reviews
            ];

            $this->view->show('inspectView.php', $data);
        }
    }


    public function checkProductReviews()
    {
        // $results = [];

        $reviews = $this->db->getReviews($_SESSION['product_id']);
        $analisis = $this->db->getAnalisis($_SESSION['product_id']);

        // Comprobamos que existan reviews

        if ($reviews) {

            // Comprobamos si se han realizado analisis anteriormente sobre las reviews de este producto..
            if (!$analisis) {

                // Si no se han realizado analisis anteriormente, realizamos uno.
                if (isset($_POST["reviews_count"]) && $_POST["reviews_count"] !== null) {

                    // AI($reviews, $_POST["reviews_count"]);
                    // array_push($results, AI($reviews, $_POST["reviews_count"]));

                    $results = AI($reviews, $_POST["reviews_count"]);


                    foreach ($results as $value) {
                        $this->db->setAnalisis($value);
                    }

                    echo 'ANALISIS REALIZADO';
                    var_dump($results);                    
                }

                // $results[] = ['analisis' => 'No se han realizado analisis anteriormente.'];
                $this->view->show('analisisView.php', $results);
            }
        } else {
            echo 'NO HAY REVIEWS';
        }
    }
}
