<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testes</title>
</head>
<body>
    <h3>Clientes</h3>    
       
    <?php foreach($clientes as $cliente): ?>
        <div>
            <?= view_cell('\App\Libraries\Componentes::clientes',['cliente'=> $cliente])?>
        </div>
    <?php endforeach?>
</body>
</html>