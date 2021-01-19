<?php
// Incluyo mi archivo de funciones.
include './resources/functions.php';

// Esto aparecio solo, no se que es.
use phpDocumentor\Reflection\Types\Null_;

//Inserto el nombre en la base de datos
//IMPORTANTE: if post lo coloco para que no vuelva a 
//insertar en la base de datos cada vez que recargo la pagina.
if ($_POST['accion'] == 'insert') {
  $name = $_POST["name"];
  $style = $_POST["style"];
  
  //guardo una copia sin formatear
  $unformat_name = $name;
  
  //formateo el nombre
  $name = formatName($name, $style);
  insertName($name, $unformat_name, $pdo);
}

if ($_GET['accion'] == 'edit') {
  $style = $_GET['style'];
  $name = formatName($_GET['name'], $style);
  $unformat_name = $_GET['name'];
  $id = $_GET['id'];
  editName($id, $name, $unformat_name, $pdo);
}

if($_POST['accion'] == 'delete'){
  $id = $_POST['id'];
  deleteName($id, $pdo);
}

//Actualizo los datos en mi pagina
fetchAll($pdo, $resultado);





###################################################
#                                                 #
#                   Funciones                     #
#                                                 #
###################################################

// Borrar campo en la base de datos.
function deleteName($id, $pdo){
  
  $sql_query = "DELETE FROM names_app WHERE id=?";
  $gsent = $pdo->prepare($sql_query);
  $gsent->execute(array($id));

  //redirecciona a index.php
  header('location:index.php');
  
}

// Editar campo en la base de datos.
function editName($id, $name, $unformat_name, $pdo)
{
  $sql_query = "UPDATE names_app SET name=?, unformat_name=? WHERE id=?";
  $gsent = $pdo->prepare($sql_query);
  $gsent->execute(array($name, $unformat_name, $id));

  //redirecciona a index.php
  header('location:index.php');
}

// Insertar campo en la base de datos.
function insertName($name, $unformat_name, $pdo)
{
  $sql_query = "INSERT INTO names_app (id, name, unformat_name) VALUES (?,?,?)";
  $gsent = $pdo->prepare($sql_query);
  $gsent->execute(array(NULL, $name, $unformat_name));

  //redirecciona a index.php
  header('location:index.php');
}

// Traer todo de la base de datos.
function fetchAll($pdo, $resultado)
{
  try {
    $sql_query = 'SELECT * FROM names_app';
    $gsent = $pdo->prepare($sql_query);
    $gsent->execute();
    $resultado = $gsent->fetchAll();
  } catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
?>