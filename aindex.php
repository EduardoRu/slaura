<?php
session_start();

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
require_once "ShoppingCart.php";
$member_id = $_SESSION['user_id']; // 2 you can your integerate authentication module here to get logged in member

$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (! empty($_POST["quantity"])) {
                
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);
                
                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);
                
                $status = 'encarro';

                if (! empty($cartResult)) {
                    // Update cart item quantity in database
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    // Add to cart table
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id, $status);
                }
            }
            break;
        case "remove":
            // Delete single entry from the cart
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Empty cart
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>
<HTML>
<HEAD>
<TITLE>Catalogo</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="style.css" type="text/css" rel="stylesheet" />
<script src="jquery-3.2.1.min.js"></script>
<script>
function increment_quantity(cart_id, price) {
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    var newQuantity = parseInt($(inputQuantityElement).val())+1;
    var newPrice = newQuantity * price;
    save_to_db(cart_id, newQuantity, newPrice);
}

function decrement_quantity(cart_id, price) {
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    if($(inputQuantityElement).val() > 1) 
    {
    var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
    var newPrice = newQuantity * price;
    save_to_db(cart_id, newQuantity, newPrice);
    }
}

function save_to_db(cart_id, new_quantity, newPrice) {
	var inputQuantityElement = $("#input-quantity-"+cart_id);
	var priceElement = $("#cart-price-"+cart_id);
    $.ajax({
		url : "update_cart_quantity.php",
		data : "cart_id="+cart_id+"&new_quantity="+new_quantity,
		type : 'post',
		success : function(response) {
			$(inputQuantityElement).val(new_quantity);
            $(priceElement).text("$"+newPrice);
            var totalQuantity = 0;
            $("input[id*='input-quantity-']").each(function() {
                var cart_quantity = $(this).val();
                totalQuantity = parseInt(totalQuantity) + parseInt(cart_quantity);
            });
            $("#total-quantity").text(totalQuantity);
            var totalItemPrice = 0;
            $("div[id*='cart-price-']").each(function() {
                var cart_price = $(this).text().replace("$","");
                totalItemPrice = parseInt(totalItemPrice) + parseInt(cart_price);
            });
            $("#total-price").text(totalItemPrice);
		}
	});
}
</script>

</HEAD>
<BODY >
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
    $item_quantity = 0;
    $item_price = 0;
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
        }
    }
?>  <!-- boton
<input type="button"  id="botonocultamuestra" value="M" style="font-size:14px;cursor:pointer;margin:15px;padding:5px;"/>

--></div> 

		
<?php
if (! empty($cartItem)) {
    ?>


<link rel="stylesheet" href="http://www.miopiblog.com/2012/12/ocultar-y-mostrar-un-div-con-jquery.html">

<div id="divocultamuestra" style="display:none;width:100%;height:100%;">

<script>
    $(document).ready(function(){
    $("#botonocultamuestra").click(function(){
       $("#divocultamuestra").each(function() {
         displaying = $(this).css("display");
         if(displaying == "block") {
           $(this).fadeOut('slow',function() {
            $(this).css("display","none");
           });
         } else {
           $(this).fadeIn('slow',function() {
             $(this).css("display","block");
           });
         }
       });
     });
   });
</script><!-- boton-->
 <!-- imagen de carrittt-->
 <center>

<div id="shopping-cart"><br><br>
       <div class="">
           <div class="txt-heading-label"><h1></h1></div>

           <a id="btnEmpty" href="index.php?action=empty"><img
               src="empty-cart.png" alt="empty-cart" title="Empty Cart"
               class="float-right" /></a>
               
              
           <div class="cart-status">
               <div>Cantidad Total: <span id="total-quantity"><?php echo $item_quantity; ?></span></div>
               <div>Precio Total: <span id="total-price"><?php echo $item_price; ?></span></div>
           </div>
       </div>
       <div>  <br><br></center>
       <div>
            <form action="pago.php" class="float-right" >
                <input type="submit" value="Comprar" class="btn btn-outline-danger"    style=" border-radius: .5rem;" >
            </form>
        </div>
        <br>


       
       
         
      

<br>
 
<div class="shopping-cart-table" >
            <div class="cart-item-container header" >
           <br><br>
                <div class="cart-info title">Nombre</div>
                <div class="cart-info">Cantidad</div>
                <div class="cart-info price">Precio</div>
                <br><br>
               
            </div>
            </div>
		
<?php
    foreach ($cartItem as $item) {

        ?>

        <div>
				<div class="cart-item-container">
                <div class="cart-info title">
                    <?php echo $item["name"]; ?>
                </div>

                <div class="cart-info quantity">
                    <div class="btn-increment-decrement" onClick="decrement_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">-</div><input class="input-quantity" id="input-quantity-<?php echo $item["cart_id"]; ?>" value="<?php echo $item["quantity"]; ?>"><div class="btn-increment-decrement"onClick="increment_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">+</div>
                </div> 

                <div class="cart-info price" id="cart-price-<?php echo $item["cart_id"]; ?>">
                        <?php echo "$". ($item["price"] * $item["quantity"]); ?>
                    </div>


                <div class="cart-info action">
                    <a href="index.php?action=remove&id=<?php echo $item["cart_id"]; ?>"
                        class="btnRemoveAction"><img
                        src="icon-delete.png" alt="icon-delete"
                        title="Remove Item" /></a>
                </div>
            </div>
            </div>  
            
           

           
				<?php
    }
    ?>
</div>
	</div>
    

    
  <?php
}
?>

</div>
  

<?php require_once "product-list.php"; ?>
    
</BODY>


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

</HTML>

<?php
}else{
    header('Location: login.php');
}
?>
