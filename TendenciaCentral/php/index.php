<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENDENCIA CENTRAL</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="contenedor">
        <header>
            Calculadora de Tendencia Central
        </header>
        <main>
            <section class="panel-derecho">
                <h2>Ingreso de Datos</h2>
                <form method="POST" action="">
                        <div class="input-group">
                        <label for="cantidad">Cantidad de datos (máx. 10)</label>
                        <input type="number" id="cantidad" name="cantidad" min="1" max="10" 
                               value="<?php
                                    echo isset($_POST['cantidad']) ? $_POST['cantidad'] : '3'; 
                                    ?>" required>
                        </div>
                    
                    <button type="submit" name="generar">Generar Campos</button>
                   
                    <div id="contenedor-campos">
                        <?php
                        // Procesar la cantidad de datos
                        $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 3;
                        if ($cantidad < 1) $cantidad = 1;
                        if ($cantidad > 10) $cantidad = 10;
                        
                        // Generar campos de entrada
                        if (isset($_POST['generar']) || isset($_POST['calcular'])) {
                            for ($i = 0; $i < $cantidad; $i++) {
                                echo '<div class="campo-numero">';
                                echo '<label for="num'.$i.'">Número '.($i+1).':</label>';
                                $valor = isset($_POST['numeros'][$i]) ? $_POST['numeros'][$i] : '';
                                echo '<input type="number" step="any" name="numeros[]" id="num'.$i.'" value="'.$valor.'" required>';
                                echo '</div>';
                            }   
                            echo '<button type="submit" name="calcular">Calcular</button>';
                            echo '<button type="submit">Limpiar</button>';
                        }
                        ?>
                    </div>
                                </form>
                            </section>        
                            <section class="panel-izquierdo">
                                <h2>Resultados</h2>
                                <div id="contenedor-datos">
                                    <?php
                                    // Mostrar datos ingresados y calcular resultados
                                    if (isset($_POST['calcular']) && isset($_POST['numeros'])) {
                    $numeros = $_POST['numeros'];
                    $valores_numericos = array();
                    $datos_validos = true;
                    
                    // Validar y convertir datos
                    foreach ($numeros as $numero) {
                        if (is_numeric($numero)) {
                            $valores_numericos[] = floatval($numero);
                        } else {
                            $datos_validos = false;
                            break;
                        }
                    }
                    
                    if ($datos_validos && count($valores_numericos) > 0) {
                        echo '<p><strong>Datos ingresados:</strong> ['.implode(', ', $valores_numericos).']</p>';
                        
                        // Calcular medidas de tendencia central
                        $media = array_sum($valores_numericos) / count($valores_numericos);
                        
                        sort($valores_numericos);
                        $n = count($valores_numericos);
                        $mediana = ($n % 2 == 0) 
                            ? ($valores_numericos[$n/2 - 1] + $valores_numericos[$n/2]) / 2 
                            : $valores_numericos[($n-1)/2];
                        
                        // Corregir el cálculo de la moda
                        // 1. Contar frecuencias de los valores
                        $frecuencias = array();
                        foreach ($valores_numericos as $valor) {
                            if (isset($frecuencias[$valor])) {
                                $frecuencias[$valor]++;
                            } else {
                                $frecuencias[$valor] = 1;
                            }
                        }
                        
                        // 2. Verificar si el array de frecuencias no está vacío antes de usar max()
                        $moda = array();
                        if (!empty($frecuencias)) {
                            $max_frecuencia = max($frecuencias);
                            foreach ($frecuencias as $valor => $frecuencia) {
                                if ($frecuencia == $max_frecuencia) {
                                    $moda[] = $valor;
                                }
                            }
                        }
                            
                            // Mostrar resultados
                            echo '<div id="resultado">';
                            echo '<div class="resultado-item"><strong>Media (Promedio):</strong> '.number_format($media, 2).'</div>';
                            echo '<div class="resultado-item"><strong>Mediana:</strong> '.number_format($mediana, 2).'</div>';
                            
                            if (count($moda) === count($valores_numericos)) {
                                echo '<div class="resultado-item"><strong>Moda:</strong> No hay moda </div>';
                            } else {
                                echo '<div class="resultado-item"><strong>Moda:</strong> '.implode(', ', $moda).'</div>';
                            }
                            
                            echo '<div class="resultado-item"><strong>Cantidad de datos:</strong> '.count($valores_numericos).'</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                   
                </div>
            </section>
        </main>
    </div>
</body>
</html>