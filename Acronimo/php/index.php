<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acronimo</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Acronimo</h1>
    <form method="post">
        <label for="frase">Ingresar frase</label>
        <input type="text" id="frase" name="frase_ingresada">
        <button type="submit">Generar acronimo</button>
    </form>
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $frase = trim($_POST['frase_ingresada']);

    if (!empty($frase)) {
        $palabras = explode(" ", $frase);
        $acronimo = '';
        foreach ($palabras as $palabra_individual) {
            if (!empty($palabra_individual)) {
                $acronimo .= strtoupper($palabra_individual[0]);
            }
        }
        echo "El acronimo de la palabra ingresada fue: " . $acronimo;
    } else {
        echo "No se ha ingresado ninguna frase";
    }
}
?>
</body>
</html>