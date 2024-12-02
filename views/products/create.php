<body>
    <h1>Crear producto</h1>
    <form action="?controller=product&action=store" method="POST">
        <label for="name">Nombre producto</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Descripción del producto</label>
        <input type="text" name="description" id="description">

        <label for="base_price">Precio base</label>
        <input type="number" name="base_price" id="base_price" step="0.1" required>

        <h3>Ingredientes:</h3>
        <?php foreach($ingredients as $ingredient) { ?>
            <div>
                <label>
                    <input type="checkbox" name="ingredientes[<?= $ingredient->getId() ?>][selected]" value="1">
                    <?= $ingredient->getName() ?> - Precio Extra: <?= $ingredient->getExtra_price() ?>
                </label>
                <label for="quantity_<?= $ingredient->getId() ?>">Cantidad:</label>
                <input type="number" name="ingredientes[<?= $ingredient->getId() ?>][quantity]" id="quantity_<?= $ingredient->getId() ?>" value="1" min="1">
                
                <label for="optional_<?= $ingredient->getId() ?>">Opcional:</label>
                <input type="checkbox" name="ingredientes[<?= $ingredient->getId() ?>][optional]" id="optional_<?= $ingredient->getId() ?>" value="1">
            </div>
        <?php } ?>

        <a href= "<?=url?>/ingredient/create">Crear nuevo ingrediente</a>
        <input type="submit" value="Agregar producto">
    </form>
</body>
