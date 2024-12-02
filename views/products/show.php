<body>
<?php
// views/products/show.php
if ($product) { // Verifica que el producto existe
    ?>
    <h1>Detalle del Producto: <?= htmlspecialchars($product->getName()) ?></h1>
    <p>Precio base: <?= htmlspecialchars($product->getBase_price()) ?></p>
    <p>Descripción: <?= htmlspecialchars($product->getDescription()) ?></p>
    <!-- Otros detalles del producto -->
    <?php
} else {
    echo "Producto no encontrado.";
}
?>
</body>