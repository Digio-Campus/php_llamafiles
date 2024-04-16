CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description VARCHAR(255),
    product_price DECIMAL(10, 2),
    product_photo VARCHAR(255),
    review_count INT,
    asin VARCHAR(50)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user VARCHAR(255),
    review TEXT,
    review_rating INT,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
CREATE TABLE analisis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    review_id INT,
    analisis TEXT,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (review_id) REFERENCES reviews(id)
);