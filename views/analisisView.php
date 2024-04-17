<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $product['title'] ?></title>
    </head>

    <body>
        <h1>Reviews analizadas: <?php echo $analized_reviews ?></h1>
        <p></p>

        <a href="/"><button>Volver a Inicio</button></a>
        <br>
        <hr>

        <h3>Reviews: <?php echo $product['review_count'] ?></h3>

        <hr>

        <?php foreach ($reviews as $review) { ?>


            <?php foreach ($analisis as $value) { ?>
                <?php if ($review['id'] == $value['review_id']) { ?>
                    <p>Usuario: <?php echo $review['user'] ?> </p>
                    <p>Rating: <?php echo $review['review_rating'] ?> / 5</p>
                    <p>Review: <?php echo $review['review'] ?> / 5</p>


                    <p>Analisis: <?php echo $value['analisis'] ?> </p>
                <?php } ?>
            <?php } ?>

            <hr>



        <?php } ?>

    </body>

    <hr>

    </html>