<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 text-center p-4 bg-light">
                <?= $this->renderSection('seccao1')  ?>
            </div>
        </div>
    </div>

    
    <hr>
    <?= $this->renderSection('seccao2')  ?>

</body>
</html>