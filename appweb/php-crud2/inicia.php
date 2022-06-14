<?php include('includes/header.php'); ?>

<body>
    <div class="card card-body">
        <form action="php/login_usuario_be.php" method="post">
            <div class="form-group">
                <p>Nombre</p>
                <input type="text" name="nombreU" id="nombreU">
            </div>
            <div class="form-group">
                <p>Contraseña</p>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="" id="">
            </div>
            <a href="crea.php">Crea Una Cuenta</a>
        </form>

    </div>
    <a href="crea.php">Crea</a>





</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<?php include('includes/footer.php'); ?>