<?php
    $variable = $_POST['modal']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/site/almacen/js/tablePersona.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
</head>
<body>
    <input name="varia" id="varia" class="btn btn-primary|secondary|success|danger|warning|info|light|dark|link" type="button" value=<?php echo $variable; ?>>
    <div class="container">
        <form id="Persona">
            <table id="tPersona" class="table" style="width:100%;">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre Completo</th>
                    </tr>
                </thead>
            </table>
        </form>
    </div>


</body>
</html>
