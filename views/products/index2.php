<h1>Listado Productos</h1>
<a href="<?= url ?>/product/create">Crear nuevo</a>
<table border='1'>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Ingredientes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($productos as $product) {
        ?>
            <tr>
            <td>
                <a href="<?= url ?>/product/show/<?= $product->getId() ?>"><?= $product->getName() ?>
                </a>
            </td>
                <td><?= $product->getBase_price() ?></td>
                <td style="display: flex; flex-direction: column;"><?php
                     $productIngredients = array_filter($ingredients, function($ingredient) use ($product) {
                        return IngredientsDAO::isIngredientInProduct($ingredient->getId(), $product->getId());
                    });
                    if (!empty($productIngredients)) {
                        foreach ($productIngredients as $ingredient) {?>
                            <!-- <a href="/ingredient/show&id=<?=$ingredient->getName()?>" ><?=$ingredient->getName()?></a><br> -->
                            <a href="<?= url ?>/ingredient/show/<?= $ingredient->getId() ?>"><?= $ingredient->getName() ?></a>

                        <?php }
                    } else {
                        echo "Sin ingredientes";
                    }
                    ?>
                </td>
                <td><td><a href="<?= url ?>/product/destroy/<?= $product->getId() ?>">Eliminar</a></td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>