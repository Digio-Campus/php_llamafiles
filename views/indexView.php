<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <h1>Buscar producto</h1>
    <form method="POST" action="index.php?controlador=Reviews&accion=insertProduct">

        <!-- Si el producto se encuentra en la base de datos.. -->
        <?php if (isset($_POST['submit']) && $isAlreadyInDB) { ?>
            <input type="hidden" name="opcion" value="cargar">
            <input type="hidden" name="product" value="<?php echo $product ?>">
            <label for="asin">Insertar ASIN: </label>
            <input type="text" name="asin" value="<?php echo $asin ?>">

            <input type="submit" name="submit" id="cargar" value="Cargar" disabled>
            <input type="submit" name="submit" id="forzar" value="Forzar Carga">    
            <p style="color: red;">El producto ya está en la base de datos, forzar la insercción conllevara la perdida de los datos anteriores..</p>

            <!-- Si el producto NO se encuentra en la base de datos.. -->
        <?php } else { ?>
            <input type="hidden" name="opcion" value="cargar">
            <input type="hidden" name="product" value="<?php echo $product ?>">
            <label for="asin">Insertar ASIN: </label>
            <input type="text" name="asin" value="">
            <input type="submit" name="submit" id="cargar" value="Cargar">
            <input type="submit" name="submit" id="forzar" value="Forzar Carga" disabled>
        <?php } ?>

    </form>

    <hr>

    <h1>Productos guardados</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ASIN</th>
                <th>Título</th>
                <th>Reviews</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['asin'] ?></td>
                    <td><?php echo $value['title'] ?></td>
                    <td><?php echo $value['review_count'] ?></td>

                    <td>
                        <form method="POST" action="index.php?controlador=Reviews&accion=inspectProduct">
                            <input type="hidden" name="opcion" value="inspeccionar">
                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                            <input type="submit" name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" value="Inspeccionar">
                        </form>
                    </td>
                </tr>

            <?php } ?>

        </tbody>
    </table>

</body>

<hr>

</html>