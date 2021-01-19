<?php 

    $link = "mysql:host=localhost;dbname=php_test";
    $usuario = "";
    $contraseña = "";

    try {

        $pdo = new PDO($link,$usuario,$contraseña);

        $sql_query = 'SELECT * FROM names_app';
        $gsent = $pdo->prepare($sql_query);
        $gsent->execute();

        $resultado = $gsent->fetchAll();
        /*
        foreach ($resultado as $name) {
            echo $name['name'];
        }
        */
        /*
        foreach($pdo->query('SELECT * from users') as $fila) {
            print_r($fila);
        }
        */
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>