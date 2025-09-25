<?php
    $union_a_b = [];
    $interc_a_b = [];
    $diferencia_a_b = [];
    $diferencia_b_a = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $input_a = $_POST['conjunto_a'];
    $input_b = $_POST['conjunto_b'];

    $conjunto_a = explode(',', $input_a);
    $conjunto_a = array_map('trim', $conjunto_a);
    $conjunto_a = array_map('intval', $conjunto_a);
    $conjunto_a = array_filter($conjunto_a, 'is_numeric');

    $conjunto_b = explode (',', $input_b);
    $conjunto_b = array_map('trim', $conjunto_b);
    $conjunto_b = array_filter($conjunto_b, 'is_numeric');
    $conjunto_b = array_map('intval', $conjunto_b);

    $unionConjuntos = array_merge($conjunto_a, $conjunto_b);
    $union_a_b = array_unique($unionConjuntos);
    $interc_a_b = array_intersect($conjunto_a, $conjunto_b);
    $diferencia_a_b = array_diff($conjunto_a, $conjunto_b);
    $diferencia_b_a = array_diff($conjunto_b, $conjunto_a);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operacion entre conjuntos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>CONJUNTOS</h1>
    <form method="post">
        <label for="conjunto_a">Conjunto a: </label>
        <input type="text" name="conjunto_a" id="conjunto_a" placeholder="Ingrese elementos">
        <label for="conjunto_b">Conjunto b: </label>
        <input type="text" name="conjunto_b" id="conjunto_b" placeholder="Ingrese elementos"> 
        <button type="submit">Calcular</button>
        <button type="submit">Limpiar</button>
    </form>
    <div class="resultado">

        <?php if($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>
            <strong><?php echo "La union del conjunto a y b es: ". implode(', ',$union_a_b ) ?></strong>
        </p>
        <p>
            <strong><?php echo "La intercesion del conjunto a y b es: ". implode(', ', $interc_a_b)?></strong>
        </p>
        <p>
            <strong><?php echo "(a-b) = ". implode(', ', $diferencia_a_b)?></strong>
        </p>
        <p>
            <strong><?php echo "(b-a) = ". implode(', ', $diferencia_b_a)?></strong>
        </p>

        <?php endif; ?>
    </div>

</body>
</html>