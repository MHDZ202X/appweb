<?php

include('db.php');

if (isset($_POST['save_task'])) {
  //$idProducto = $_POST['idProducto'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];
  $estatus = $_POST['estatus'];
  $query = "INSERT INTO producto (nombre, descripcion, precio, categoria, estatus) VALUES ('$nombre', '$descripcion', '$precio', '$categoria', '$estatus')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>
