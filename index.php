<?php
function printForm(): void
{
    echo <<<END
    <form action="#" method="post">
    <p>
        Nombre: <input type="text" name="nombre" id="nombre" value="">
    </p>
    <p>
        Apellidos: <input type="text" name="apellidos" id="apellidos" value="">
    </p>
    <p>
        Edad: <input type="text" name="edad" id="edad" value="">
    </p>
    <p>
        Altura: <input type="text" name="altura" id="altura" value="">
    </p>
    <p>
        <input type="submit" value="Enviar">
    </p>
    </form>
    END;
}
function validarNombre($dato)
{
    $palabras = explode(" ", $dato);

    if (count($palabras) == 2) {
        $allCharacters = ctype_alpha($palabras[0]);
        if ($allCharacters == false) {
            return false;
        }
        $allCharacters = ctype_alpha($palabras[1]);
        if ($allCharacters == false) {
            return false;
        }
    } elseif (count($palabras) == 1) {
        $allCharacters = ctype_alpha($dato);
        if ($allCharacters == false) {
            return false;
        }
    }
    return  $dato;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (!$_POST) {
        printForm();
    } else {
        echo '<form action="#" method="post"><p>Nombre: <input type="text" name="nombre" id="nombre" value=""></p>';
        $options = array('options' => 'validarNombre');
        $nombresano = htmlspecialchars(trim($_POST['nombre']));
        $resultado = filter_var($nombresano, FILTER_CALLBACK, $options);
        if ($resultado === false) {
            echo "<p>Error: el nombre debe ser todo letras, como máximo dos palabras.</p>";
        } else {
            echo "<p>El nombre introducido es {$_POST['nombre']}.</p>";
        }

        echo '<p>Apellidos: <input type="text" name="apellidos" id="apellidos" value=""></p>';
        $options = array('options' => 'validarNombre');
        $apellidosano = htmlspecialchars(trim($_POST['apellidos']));
        $resultado = filter_var($apellidosano, FILTER_CALLBACK, $options);
        if ($resultado === false) {
            echo "<p>Error: el apellidos debe ser todo letras, como máximo dos palabras.</p>";
        } else {
            echo "<p>El apellidos introducido es {$_POST['apellidos']}.</p>";
        }

        echo '<p>Edad: <input type="text" name="edad" id="edad" value=""></p>';
        $options = array('options' => "'min_range' => 0");
        $edad = isset($_POST['edad']) ? $_POST['edad'] : false;
        $edadsana = htmlspecialchars(trim($edad));
        $resultado = filter_var($edadsana, FILTER_VALIDATE_INT, $options);
        if ($resultado === false) {
            echo "<p>Error: el edad no es válida.</p>";
        } else {
            echo "<p>El edad introducida es {$_POST['edad']}.</p>";
        }

        echo '<p>Altura: <input type="text" name="altura" id="altura" value=""></p>';
        $options = array('options' => array('min_range' => 0.5, 'max_range' => 2.5));
        $altura = isset($_POST['altura']) ? $_POST['altura'] : false;
        $alturasana = htmlspecialchars(trim($altura));
        $resultado = filter_var($alturasana, FILTER_VALIDATE_FLOAT, $options);
        if ($resultado === false) {
            echo "<p>Error: la altura no es valida, debe ser un decimal entre 0.5 y 2.5.</p>";
        } else {
            echo "<p>La altura introducida es de {$_POST['altura']} metros.</p>";
        }

        echo '<p><input type="submit" value="Enviar"></p></form>';
    }
    ?>
</body>

</html>