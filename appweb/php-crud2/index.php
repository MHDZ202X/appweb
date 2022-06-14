<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>
<a href="inicia.php" class="btn btn-danger">Salir</a>
<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php session_unset();
      } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <p>Nombre</p>
            <input type="text" name="nombre" class="form-control" placeholder="" autofocus>
          </div>
          <div class="form-group">
            <p>Descripcion</p>
            <textarea name="descripcion" rows="2" class="form-control" placeholder=""></textarea>
          </div>
          <div class="form-group">
            <p>Precio</p>
            <textarea name="precio" rows="2" class="form-control" placeholder=""></textarea>
          </div>
          <div class="form-group">
            <p>Categoria</p>
            <textarea name="categoria" rows="2" class="form-control" placeholder=""></textarea>
          </div>
          <div hidden class="form-group">
            <p>Estatus</p>
            <input name="estatus" type="number" max="1" min="0" rows="2" class="form-control" value="1" placeholder=""></input>
          </div>

          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table id="tblData" class="table table-bordered">
        <thead>
          <tr>
            <th>id</th>
            <th>nombre</th>
            <th>Description</th>
            <th>precio</th>
            <th>categoria</th>
            <th>estatus</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM producto";
          $result_tasks = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <tr>
              <td><?php echo $row['idProducto']; ?></td>
              <td><?php echo $row['nombre']; ?></td>
              <td><?php echo $row['descripcion']; ?></td>
              <td><?php echo $row['precio']; ?></td>
              <td><?php echo $row['categoria']; ?></td>
              <td><?php echo $row['estatus']; ?></td>
              <td>
                <a href="edit.php?id=<?php echo $row['idProducto'] ?>" class="btn btn-secondary">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="delete_task.php?id=<?php echo $row['idProducto'] ?>" class="btn btn-danger">
                  <i class="far fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <button class="btn btn-info" onclick="exportTableToExcel('tblData')">Export Table Data To Excel File</button>
    </div>

  </div>
</main>
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
<?php include('includes/footer.php'); ?>