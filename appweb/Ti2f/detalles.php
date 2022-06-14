<?php
require 'php/config.php';
require 'php/conexion_producto.php';
$db=new Database();
$con=$db->conectar();

$id=isset($_GET['idProducto'])?$_GET['idProducto']:'';
$token=isset($_GET['token'])?$_GET['token']:'';
   
if($id ==''|| $token ==''){
    echo 'Error';
    exit;
}else{

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token==$token_tmp){

        $sql = $con->prepare("SELECT count(idProducto) FROM producto WHERE idProducto=? AND estatus=1");
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0 ){

            $sql = $con->prepare("SELECT idProducto, nombre , precio, descripcion, categoria FROM producto WHERE idProducto=? AND estatus=1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            //$idprod = ['idProducto'];
            $nombre=$row['nombre'];
            $descripcion=$row[ 'descripcion'];
            $precio=$row['precio'];
            $categoria=$row['categoria'];
            //$dir_imagen= 'imagenes/productos/'. $categoria .'/';
            //$rutaimagen =$dir_imagen .$nombre .'.jpg' ;
            $img = "imagenes/productos/$categoria/prot$id.jpg";
            //"imagenes/productos/$cat/prot$id.jpg";
            //if(file_exists($rutaimagen)){
            //    $rutaimagen = 'imagenes/otra/noimagen.jpg';
            //}

            //$imagenes=array();
            //$dir=dir($dir_imagen);
            //while(($archivo=$dir->read())!=false){
            //    if($archivo!= $nombre.'.jpg'&&(strpos($archivo,'jpg')|| strpos($archivo,'jpeg'))){
            //         $imagenes[]=$dir_imagen.$archivo;
            //    }
            //}
            //$dir->close();
        }
    }else{
        echo 'Error 2';
        exit;
    }
}



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
</head>
<body>

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
                <div class="col-md-6 order-md-1">
                    <img src="<?php echo $img  ?>" class="d-block w-80">
                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre; ?></h2>
                    <h2><?php echo MONEDA.number_format ($row['precio'],2,'.',','); ?></h2>
                    <p class="lead">
                        <?php echo $descripcion; ?>
                    </p>
                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-primary" type="button">Comprar ahora</button>
                        <button class="btn btn-outline-primary" type="button" onclick ="addProducto(<?php echo $id;?>,'<?php echo $token_tmp;?>')"> Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </div>  
    </main>
    
    <script>
    function addProducto(id,token){
        let url = 'php/carritoConfig.php';
        let formData=new FormData()
        formData.append('id',id)
        formData.append('token',token)

        fetch(url, {
            method:'POST',
            body:formData,
            mode:'cors'
        }).then(response => response.json())
        .then(data=>{
            if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
            }
        })
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
