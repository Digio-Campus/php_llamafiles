<?php
require_once("libs/SPDO.php");


class Model {

    protected $db;

    public function __construct()
    {
        $this->db = SPDO::singleton();
    }
    function getProducts()
    {
        $query = $this->db->prepare('SELECT * FROM products;');
        $query->execute();
        $data = $query->fetchAll();

        if (isset($data)) {
            return $data;
        } else {
            return null;
        }
    }

    function getProduct($product_id)
    {
        $query = $this->db->prepare('SELECT * FROM products WHERE ID = ?;');
        $query->bindParam(1, $product_id);
        $query->execute();
        $data = $query->fetch();

        if (isset($data))
            return $data;
        else
            return null;
    }

    function getProductIdByASIN($asin)
    {
        $query = $this->db->prepare('SELECT id FROM products WHERE asin = ?;');
        $query->bindParam(1, $asin);
        $query->execute();
        $data = $query->fetch();

        if (isset($data))
            return $data;
        else
            return null;
    }

    function getReviews($product_id)
    {
        $query = $this->db->prepare('SELECT * FROM reviews WHERE PRODUCT_ID = ?;');
        $query->bindParam(1, $product_id);
        $query->execute();
        $data = $query->fetchAll();

        if (isset($data))
            return $data;
        else
            return null;
    }
    function getReviewsCount($product_id)
    {
        $query = $this->db->prepare('SELECT COUNT(*) as review_count FROM reviews WHERE PRODUCT_ID = ?;');
        $query->bindParam(1, $product_id);
        $query->execute();
        $data = $query->fetch();

        if (isset($data))
            return $data['review_count'];
        else
            return null;
    }

    function getAnalisis($product_id)
    {
        $query = $this->db->prepare('SELECT * FROM analisis WHERE product_id = ?;');
        $query->bindParam(1, $product_id);
        $query->execute();
        $data = $query->fetchAll();

        if (isset($data))
            return $data;
        else
            return null;
    }

    function getDeepAnalisis($product_id)
    {
        $query = $this->db->prepare('SELECT * FROM DEEP_ANALISIS WHERE PRODUCT_ID = ?;');
        $query->bindParam(1, $product_id);
        $query->execute();
        $data = $query->fetchAll();

        if (isset($data))
            return $data;
        else
            return null;
    }

    function setProduct($product, $total_reviews)
    {
        // $review_count = fetchProductReviews($product['data']['asin']);
        // $test = 2;
        $query = $this->db->prepare('INSERT INTO `products` (`title`, `description`, `review_count`, `asin`) VALUES (?, ?, ?, ?)');
        $query->bindParam(1, $product['data']['product_title']);
        $query->bindParam(2, $product['data']['product_description']);
        $query->bindParam(3, $total_reviews);
        $query->bindParam(4, $product['data']['asin']);
        // $query->bindParam(4, $review_count['data']['total_reviews']);
        $query->execute();
    }
    function setReview($review, $product_id)
    {
        $query = $this->db->prepare('INSERT INTO `reviews` (`product_id`, `user`, `review`, `review_rating`) VALUES (?, ?, ?, ?)');
        $query->bindParam(1, $product_id);
        $query->bindParam(2, $review['review_author']);
        $review_comment = utf8_encode($review['review_comment']);
        $query->bindParam(3, $review_comment);
        $query->bindParam(4, $review['review_star_rating']);
        $query->execute();
    }
    function setAnalisis($analisis)
    {
        $query = $this->db->prepare('INSERT INTO `analisis` (`product_id`, `review_id`, `analisis`) VALUES (?, ?, ?)');
        $query->bindParam(1, $analisis['product_id']);
        $query->bindParam(2, $analisis['review']);
        $query->bindParam(3, $analisis['analisis']);
        $query->execute();
    }

    function setDeepAnalisis($analisis)
    {
        $query = $this->db->prepare('INSERT INTO `DEEP_ANALISIS` (`PRODUCT_ID`, `ANALISIS_ID`, `VEREDICT`) VALUES (?, ?, ?)');
        $query->bindParam(1, $analisis['product_id']);
        $query->bindParam(2, $analisis['review_id']);
        $query->bindParam(3, $analisis['analisis']);
        $query->execute();
    }
}
