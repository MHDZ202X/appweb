<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'login_register_db',
) or die(mysqli_erro($mysqli));

?>
