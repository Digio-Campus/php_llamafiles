<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $product['title'] ?></title>
    </head>

    <body>
        <h1>Analizar reviews:</h1>
        <p></p>

        <form method="POST" action="index.php?controlador=Reviews&accion=checkProductReviews">
            <input type="hidden" name="opcion" value="analizar">
            <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
            <label for="reviews_count">Cantidad de reviews a analizar: </label>
            <input type="number" id="reviews_count" name="reviews_count" min="1" max="50">

            <input type="submit" name="ejecutar" id="ejecutar" value="Ejecutar">
            <input type="submit" name="anteriores" id="anteriores" value="anteriores">
        </form>


        <div style="display: inline-block;">
            
        
        
    </div>
    <!--<p>Reviews analizadas (nº): </p>
        <button>Ver analisis</button> -->
        <button><a href="index.php?controlador=Reviews&accion=showAnalisis">Ver analisis anteriores</a></button> 
        <a href="/"><button>Volver a Inicio</button></a>
        <br>
        <hr>

        <h1>Información del producto</h1>

        <h3>Titulo:</h3>
        <h3><?php echo isset($product['title']) ? $product['title'] : 'Título no disponible'; ?></h3>
        <img src="" alt="">

        <h3>Descripcion:</h3>

        <?php if ($product['description']) { ?>
            <p><?php echo $product['description'] ?></p>
        <?php } else { ?>
            <p>El producto no dispone de descripción.</p>
        <?php } ?>

        <h3>Reviews: <?php echo $product['review_count'] ?></h3>

        <hr>

        <?php foreach ($reviews as $value) { ?>
            <p>Usuario: <?php echo $value['user'] ?> </p>
            <p>Rating: <?php echo $value['review_rating'] ?> / 5</p>
            <p>Review: <?php echo $value['review'] ?> </p>
            <hr>
        <?php } ?>

    </body>

    <hr>

    </html>