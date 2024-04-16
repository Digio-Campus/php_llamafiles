<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <h1>Buscar producto</h1>
    <form method="POST" action="index.php?controlador=Reviews&accion=insertProduct">
        <input type="hidden" name="opcion" value="cargar">
        <input type="hidden" name="product" value="<?php echo $product ?>">
        <label for="asin">Insertar ASIN: </label>
        <input type="text" name="asin">

        <input type="submit" name="submit" id="cargar" value="Cargar">
        <input type="submit" name="submit" id="forzar" value="Forzar Carga" disabled>
    </form>

    <hr>

    <h1>Productos guardados</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Reviews</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
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

    <!--<form method="POST" action="">
                                <input type="hidden" name="opcion" value="inspeccionar">
                                <input type="hidden" name="test" value="Cargar">
                                <input type="hidden" name="id" value="tt">
                                <input type="submit" name="tt" id="tt" value="Inspeccionar">
                            </form>-->
</body>

<hr>

</html>