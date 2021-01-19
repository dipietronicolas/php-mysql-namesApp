<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <title>Checkboxes</title>
</head>

<body>
  <?php include "./Navbar/navbar.html" ?>
  <?php include "./dbConnection/db.connection.php" ?>
  <div class='container'>
    <div class="app-container">
      <form action="index.php" method="post" class='form-control'>
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class='form-input' maxlength="18" autofocus />
        <input type="hidden" name="accion" value="insert">
        <div class="checkboxes-container">
          <p><b>Bold</b> <input type="checkbox" name="style[]" value="bold" class="form-checkbox" /></p>
          <p><i>Italic</i> <input type="checkbox" name="style[]" value="italic" class="form-checkbox" /></p>
          <p><u>Underline</u> <input type="checkbox" name="style[]" value="underline" class="form-checkbox" /></p>
        </div>
        <button type="submit" class="btn">Enviar</button>
      </form>

      <?php
      #php php -S localhost:3000
      error_reporting(E_ALL ^ E_NOTICE);
      include_once "./controller/db.controller.php";

      ?>
    </div>

    <div class="result-container">
      <div class="result-header">
        <p class="result-title">Resultado</p>
      </div>
      <div class="result-body">
        <?php $count = 0; ?>
        <?php foreach ($resultado as $name) : ?>
          <div class="result">
            <p>Hola <?php echo $name['name'] . " - id: " . $name['id'] ?></p>
            <div class="edit-delete-container">
              <a class="edit-delete-button" href="index.php?id=<?php echo $name['id'] ?>&pos=<?php echo $count ?>&action=<?php echo 'render_edit_form' ?>"><i class="fas fa-edit"></i></a>
              <a class="edit-delete-button" href="index.php?id=<?php echo $name['id'] ?>&pos=<?php echo $count ?>&action=<?php echo 'render_delete_form' ?>"><i class="fas fa-trash"></i></a>
            </div>
          </div>
          <?php $count += 1; ?>
        <?php endforeach ?>
      </div>
    </div>

    <?php if($_GET['action'] == 'render_edit_form'): ?>
    <div class="edit-form-blur">
      <div class="edit-form-container">
        <div class="close-container">
          <button class="close-button" onclick="closeEditForm()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <form action="index.php" method="get" class='form-control'>
          <label for="name" class="form-label">Name</label>
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
          <input type="hidden" name="accion" value="edit" id="id-receptor">
          <input 
            value="<?php echo $resultado[$_GET['pos']]['unformat_name'] ?>" type="text" name="name" class='form-input' maxlength="18" id="edit-input" />
          <div class="checkboxes-container">
            <p><b>Bold</b> <input type="checkbox" name="style[]" value="bold" class="form-checkbox" /></p>
            <p><i>Italic</i> <input type="checkbox" name="style[]" value="italic" class="form-checkbox" /></p>
            <p><u>Underline</u> <input type="checkbox" name="style[]" value="underline" class="form-checkbox" /></p>
          </div>
          <button type="submit" class="btn">Enviar</button>
        </form>
      </div>
    </div>
    <?php endif ?>

    <?php if($_GET['action'] == 'render_delete_form'): ?>
    <div class="edit-form-blur">
      <div class="edit-form-container">
        <div class="close-container">
          <button class="close-button" onclick="closeEditForm()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <form action="index.php" method="post" class='form-control'>
          <label for="name" class="form-label">¿Seguro que desea borrar este nombre?</label>
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
          <input type="hidden" name="accion" value="delete" id="id-receptor">
          
          <button type="submit" class="btn-danger">Delete</button>
        </form>
      </div>
    </div>
    <?php endif ?>
  </div>


  <script src="script.js"></script>
</body>

</html>