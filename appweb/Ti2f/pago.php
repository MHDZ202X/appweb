<?php
require 'php/config.php';
require 'php/conexion_producto.php';

$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();
if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {


        $sql = $con->prepare("SELECT idProducto, nombre, precio, categoria, $cantidad AS cantidad FROM producto WHERE idProducto=? AND estatus=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("lcoation: index.php");
    exit;
}
//session_destroy();
//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <form action="https://www.sandbox.paypal.com/" method="post" id="form_pay">
</head>

<body>

    <input type="hidden" name="business" value="vendedor@business.example.com">

    <input type="hidden" name="cmd" value="_xclick">




    <header>
        <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="index.php" class="navbar-brand ">
                    <strong>Tienda</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <!--a href="#" class="nav-link active">Productos</-a-->

                        </li>
                    </ul>
                    <a href="carrito.php" class="btn btn-primary">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a>

                </div>

            </div>
        </div>
    </header>
    <!--Productos-->
    <main>
        <div class="container">

            <div class="row">
                <div class="col-6">
                    <h4>Detalles de pago</h4>

                </div>
                <div class="col-6">


                    <div class="table-responsive">
                        <table id="tblData" class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($lista_carrito == null) {
                                    echo '<tr><td colspan="5"class="text-center"><b>Lista vacia</b></td></tr>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_carrito as $producto) {
                                        $_id = $producto['idProducto'];
                                        $nombre = $producto['nombre'];
                                        $precio = $producto['precio'];
                                        $cantidad = $producto['cantidad'];
                                        //$descuento=$producto['descuento'];
                                        //$precio_desc=$precio-(($precio*$descuento)/100);I
                                        $subtotal = $cantidad * $precio;
                                        $total += $subtotal;
                                ?>
                                        <tr>
                                            <td> <?php echo $nombre ?></td>
                                            <td>
                                                <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>
                                                </div>
                                            </td>


                                        </tr>
                                    <?php } ?>
                            </tbody>
                            <tr>
                                <td>
                                    <h3>Total</h3>
                                </td>
                                <td colspan="3"></td>

                                <td colspan="2">
                                    <p class="h3" id="total"> <?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                                </td>

                            </tr>
                        <?php } ?>
                        </table>
                    </div>
                    <?php if ($lista_carrito != null) { ?>
                        <div class="row">
                            <input type="submit" class="btn btn-primary btn-lg" value="Pagar"></input>


                        </div>
                    <?php } ?>
                    
                </div>
                <div>
                        <a class="btn btn-secondary" onclick="exportTableToExcel('tblData')">Export Table Data To Excel File</a>
                    </div>
            </div>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>

</body>

</html>