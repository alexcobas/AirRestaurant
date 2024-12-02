<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear ingrediente</h1>
    <form action="?controller=ingredient&action=store" method="POST">
        <label for="name">Nombre ingrediente</label>
        <input type="text" name="name" id="name" required>
        <label for="name">Precio extra</label>
        <input type="number" name="extra_price" id="extra_price" step="0.01" required>
        <input type="submit" value="Agregar ingrediente">
    </form>
</body>
</html>