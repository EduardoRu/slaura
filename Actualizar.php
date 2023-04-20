<?php
session_start();
?>
<?php


if($_SESSION['user_id']){
    ?>
    <head>
    <meta charset="utf-8">
    <title>A|L</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i>AnaLaura@gmail.com</p>
                        <p class="text-body px-3">|</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+052 4581196393</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-facebook-f" style="color: black;"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"style="color: black;"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"style="color: black;"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"style="color: black;"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"style="color: black;" ></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                  
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="aindex.html" class="nav-item nav-link active">Nosotros</a>
                        <a href="aindex.php" class="nav-item nav-link">Catalago</a>
                        <a href="Addproduct.php" class="nav-item nav-link">Agregar articulos</a>
                        <a href="Actualizar.php" class="nav-item nav-link">Actualizar articulos</a>
                     
                        <a href="acrear.php" class="nav-item nav-link">Registro</a>
                        
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="car.png" alt="5%" srcset=""   id="botonocultamuestra" ></a>
                        </div>
                        <a href="logout.php" class="nav-item nav-link">Cerrar sesion</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';
try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';
    dbname=' . $config['db']['name'];
    $conexion = new PDO ($dsn, $config['db']['user'], $config
    ['db']['pass'], $config['db']['options']);
    if (isset($_POST['name'])) {
        $consultaSQL = "SELECT * FROM tbl_product WHERE name LIKE
        '%" . $_POST['name'] . "%'";


    } else {
        $consultaSQL = "SELECT * FROM tbl_product";

    }
   
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();
    $tbl_product = $sentencia->fetchAll();
    
    }

catch (PDOException $error){
    $error = $error->getMessage();

}
?>

<?php include "./templases/header.php" ?>


<doctype html>
<html lang="es">
    <?php include "./templases/header.php"?>
    <body>
        <div class="container mt-5">
        <div class="row" >
    <?php
    if ($tbl_product && $sentencia->rowCount() > 0){
        foreach ($tbl_product as $fila){
    ?>
            
                <div class="col-md-4">
                    <div class="card mt-2">
                    <img src="<?php echo $fila['image'] ?>" alt="...">
                      <center> <div class="card-body">
                        <?php echo escapar($fila["name"]); ?><br>
                        
                        <?php echo escapar($fila["code"]); ?><br>
                        <?php echo escapar($fila["price"]); ?><br>
                            <a class="btn btn-primary mt-4" href="<?='iborrar.php?id=' . escapar($fila["id"])?>"><i class="fa-solid fa-trash"></i><span>  Borrar</span></a>
                            <a class="btn btn-primary mt-4" href="<?='ieditar.php?id=' . escapar($fila["id"])?>"><i class="fa-solid fa-pen-to-square"></i><span>  Editar</span></a>
                        </div></center> 
                    </div>
                </div>
               
               
     <?php
        }
    } }

    ?>
    </div>
    </div>
   
    
    </body>
    

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">ANA</span>LAURA</h1>
                </a>
                <p>Modista Alta Costura</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Redes Sociales</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contacto</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+052 4581196393</p>
                <p><i class="fa fa-envelope mr-2"></i>AnaLaura@gmail.com</p>
               
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Sara Laura </a>. All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>


    <?php include "./templases/footer.php"?>
</html>
