<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirRestaurant</title>
    <link rel="icon" href="<?=url?>img/logo.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?=url?>css/custom.css">
    <link rel="stylesheet" href="<?=url?>css/style.css">
</head>

<body>
    <?php include_once $view; ?>
    <script src="<?=url?>/js/dinamicMargin.js"></script>
    <?php if(isset($_GET["errorRegister"])){?>
        <script src="<?= url ?>js/openRegister.js"></script>
    <?php }?> 
    <?php if(isset($_GET["errorLogin"])){?>
        <script src="<?= url ?>js/openLogin.js"></script>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>