<?php
    include 'conexion_be.php';

    $nombre_usuario = $_POST['Nusuarioc'];
    $nombre_completo = $_POST['NCusuarioC'];
    $contraseña = $_POST['CusuarioC'];

    $query = "INSERT INTO usuario(Nombre_Usuario, Nombre_Completo, Pass)
    VALUES ('$nombre_usuario', '$nombre_completo', '$contraseña')";
    
    //verifica que no se repita en la bd  
    $verifica_Ncuenta = mysqli_query($conexion, "SELECT * FROM usuario WHERE Nombre_Usuario ='$nombre_usuario'");

    if(mysqli_num_rows($verifica_Ncuenta)> 0) {
        echo '
        <script>
            alert("Usuario Existente. Intente con otro");
            window.location="../crea.php";
        </script>
        ';
        exit();
    }
    

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo'
        <script>
            alert("registrado")
            window.location= "../inicia.php";
        </script>
        ';
    }else{
        echo'
        <script>
            alert("Intente De Nuevo")
            window.location= "../crea.php";
        </script>
        ';
    
    }
    mysqli_close($conexion);

?>