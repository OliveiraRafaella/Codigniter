<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    
    <?php 
        helper('form');
        echo form_open('public/main/submeter43');
    ?>

    <input type="text" name= "nome" value="<?= old('nome')?>"> <br>
    <input type="text" name = "apelido" value="<?= old('apelido')?>"> <br>
    <input type="submit" value = "Gravar">
    <?= form_close()?>

    <?php if (isset($erro)):?>
        <p><?= $erro->listErrors() ?></p>
    <?php endif;?>
</body>
</html>