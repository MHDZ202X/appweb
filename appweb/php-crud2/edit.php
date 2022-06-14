<?php
include("db.php");
$nombre = '';
$descripcion = '';
$precio = '';
$categoria = '';
$estatus = '';

if (isset($_GET['idProducto'])) {
  $idProducto = $_GET['idProducto'];
  $query = "SELECT * FROM producto WHERE idProducto=$idProducto";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $estatus = $_POST['estatus'];
  }
}

if (isset($_POST['update'])) {
  $idProducto = $_GET['idProducto'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];
  $estatus = $_POST['estatus'];

  $query = "UPDATE producto set nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', categoria='$categoria', estatus='$estatus' WHERE idProducto=$idProducto";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
          <div class="form-group">
            <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Update Nombre">
          </div>
          <div class="form-group">
            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Descripcion"><?php echo $descripcion; ?></textarea>
          </div>
          <div class="form-group">
            <input name="precio" type="numeric" class="form-control" value="<?php echo $precio; ?>" placeholder="Update Precio">
          </div>
          <div class="form-group">
            <input name="categoria" type="text" class="form-control" value="<?php echo $categoria; ?>" placeholder="Update Categoria">
          </div>
          <div class="form-group">
            <input name="estatus" type="number" max="1" min="0" class="form-control" value="<?php echo $estatus; ?>" placeholder="Update Estatus">
          </div>
          <button class="btn-success" name="update">
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>