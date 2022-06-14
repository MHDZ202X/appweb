<?php include('includes/header.php'); ?>

<div class="card card-body">
    <form action="php/registro_usuario_be.php" method="post" class="">
        <div class="form-group">
            <p>Nombre Usuario</p>
            <input type="text" name="Nusuarioc" id="Nusuarioc">
        </div>
        <div class="form-group">
            <p>Nombre Completo</p>
            <input type="text" name="NCusuarioC" id="NCusuarioC">
        </div>
        <div class="form-group">
            <p>Contraseña</p>
            <input type="password" name="CusuarioC" id="CusuarioC">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="" id="">
        </div>
        <a href="inicia.php">iniciac Secion</a>
    </form>
</div>

<?php include('includes/footer.php'); ?>