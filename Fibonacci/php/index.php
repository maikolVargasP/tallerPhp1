<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secuencia de Fibonacci</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
        <div class="contenedor">
            <form method="POST">
                <h1>FIBONACCI</h1>
                <label for="cantidad">Ingrese la cantidad de datos que quiera conocer</label>
                <br>
                <input type="number" name="cantidad" id="cantidad" placeholder="Ingrese un número" min="1" max="100">
                <br>
                <button type="submit" name="consultar">Consultar</button>
                <button type="reset">Limpiar</button>
                <div id="resultado">
                <?php
                if (isset($_POST["cantidad"])) {
                    $limite = intval($_POST["cantidad"]);
                    $fibonacci = [0, 1];
                    
                    if ($limite >= 1 && $limite <= 100) { 
                        for ($i = 0; $i < $limite; $i++) {
                            echo $fibonacci[$i] . " ";
                            $fibonacci[] = $fibonacci[$i] + $fibonacci[$i+1];
                        }
                    } else {
                        echo "Por favor ingrese un número entre 1 y 100";
                    }
                }
                ?>
                </div>
            </form>
        </div>   
</body>
</html>