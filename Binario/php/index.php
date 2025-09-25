<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor a binario</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="contenedor">
        <header>
            Conversor a Binario
        </header>
        <main>
            <h2>Ingreso de Datos</h2>
            <form method="POST" action="">
                <div class="salida">
                    <label for="numero">Número Decimal (0-255)</label>
                    <input type="number" id="numero" name="numero" min="0" max="255" 
                            value="<?php
                                echo isset($_POST['numero']) ? $_POST['numero'] : '0'; 
                                ?>" required>
                </div>
                <button type="submit" name="convertir">Convertir a Binario</button>
                <button type="submit">Limpiar</button>
            </form>
            <h2>Resultados</h2>
            <div id="contenedor-datos">
                <?php
                if (isset($_POST['convertir']) && isset($_POST['numero'])) {
                    $numero = (int)$_POST['numero'];
                    if ($numero < 0 || $numero > 255) {
                        echo "<p class='error'>Por favor, ingrese un número entre 0 y 255.</p>";
                    } else {
                        $binario = decbin($numero);
                        echo "<p>El número decimal <strong>$numero</strong> en binario es: <strong>$binario</strong></p>";
                    }
                }
                ?>
            </div>
        
        </main>

    </div>
    
</body>
</html>