<?php
class Nodo {
    public $valor;
    public $izq;
    public $der;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->izq = null;
        $this->der = null;
    }
}

function construirArbolPreIn($preorden, $inorden) {
    if (empty($preorden) || empty($inorden)) {
        return null;
    }

    $raiz_val = $preorden[0];
    $raiz = new Nodo($raiz_val);

    $indice = array_search($raiz_val, $inorden);

    $izq_in = array_slice($inorden, 0, $indice);
    $der_in = array_slice($inorden, $indice + 1);

    $izq_pre = array_slice($preorden, 1, count($izq_in));
    $der_pre = array_slice($preorden, 1 + count($izq_in));

    $raiz->izq = construirArbolPreIn($izq_pre, $izq_in);
    $raiz->der = construirArbolPreIn($der_pre, $der_in);

    return $raiz;
}

function inordenTraversal($nodo) {
    if ($nodo == null) return [];
    return array_merge(inordenTraversal($nodo->izq), [$nodo->valor], inordenTraversal($nodo->der));
}

function preordenTraversal($nodo) {
    if ($nodo == null) return [];
    return array_merge([$nodo->valor], preordenTraversal($nodo->izq), preordenTraversal($nodo->der));
}

function postordenTraversal($nodo) {
    if ($nodo == null) return [];
    return array_merge(postordenTraversal($nodo->izq), postordenTraversal($nodo->der), [$nodo->valor]);
}

// Procesar formulario
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $preorden = array_map("trim", explode(",", strtoupper($_POST["preorden"])));
    $inorden = array_map("trim", explode(",", strtoupper($_POST["inorden"])));

    $arbol = construirArbolPreIn($preorden, $inorden);

    $resultado .= "<h3>Resultados:</h3>";
    $resultado .= "<p><b>Inorden:</b> " . implode(" → ", inordenTraversal($arbol)) . "</p>";
    $resultado .= "<p><b>Preorden:</b> " . implode(" → ", preordenTraversal($arbol)) . "</p>";
    $resultado .= "<p><b>Postorden:</b> " . implode(" → ", postordenTraversal($arbol)) . "</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Arbol Binario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        
        <form method="POST">
            <h2>Arbol Binario</h2>
            <label for="preorden">Recorrido Preorden:</label>
            <input type="text" name="preorden" id="preorden" placeholder="Ej: A,B,D,E,C" required>

            <label for="inorden">Recorrido Inorden:</label>
            <input type="text" name="inorden" id="inorden" placeholder="Ej: D,B,E,A,C" required>

            <button type="submit">Construir Árbol</button>
        </form>

        <?php if ($resultado): ?>
        <div class="resultado">
            <?= $resultado ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
