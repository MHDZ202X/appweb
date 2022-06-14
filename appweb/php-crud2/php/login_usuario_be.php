<?php
    include 'conexion_be.php';

    $nombreU = $_POST['nombreU'];
    $pass = $_POST['password'];

    $valida_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE Nombre_Usuario='$nombreU' and pass='$pass'");
    
    if(mysqli_num_rows($valida_login)> 0) {
        header("location: ../index.php");
        exit;
    }else{  
        echo '
            <script>
                alert("Usuario No Existente. Intente con otro");
                window.location="../inicia.php";
            </script>
        '; 
        exit;
    }
?>