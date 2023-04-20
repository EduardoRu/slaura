<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <title>A|L</title>
</head>
<body> 
    <br>
    <br>
    <br>
    <br>
<div class="card text-center"  style="max-width: 60%; align-items: center;">
    <form action="validar.php" method="post">
      <h1>LOGIN</h1>
      

        <label for="exampleInput" class="form-label">USUARIO </label>

        <div class="mb-4">
        <input type="text"  class="form-control" placeholder="Nombre usuario" name="usuario">
        </div>

        <label for="exampleInput" class="form-label">     CONTRASEÑA </label>

    <div class="mb-4">
     <input type="text"  class="form-control" placeholder="Contraseña" name="password">
    </div>
        <input type="submit"   class="btn btn-primary" value="Ingresar">
       
    </form> <br><br><br>
</div>
</body>

</html>