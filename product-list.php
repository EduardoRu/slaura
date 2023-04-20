<div class="container mt-5">
        <div class="row" >
            
      <!--  <div id="product-grid">
    <div class="">
        <div class="txt-heading-label"></div>
    </div> -->
    <?php
    $query = "SELECT * FROM tbl_product";
    
    $product_array = $shoppingCart->getAllProduct($query);
    if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
            <div class="col-md-4">
                    <div class="card mt-2">
       <div class="product-item"> 

        <form method="post"
            action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
            <div class="product-image" >
                <img class="rounded mx-auto d-block" src="<?php echo $product_array[$key]["image"]; ?>">
                <div class="product-title">
                    <?php echo $product_array[$key]["name"]; ?>
                </div>
            </div>
            <div class="product-footer">
                <div class="float-right">
                <div class="input-group mb-3">
                    <input type="text" name="quantity" value="1"
                        size="2" class="input-cart-quantity form-control" />
                        <input type="image"
                        src="add-to-cart.png" class="btnAddAction" width="15%" height="15%"/>
                </div>
                </div>
                <div class="product-price float-left" id="product-price-<?php echo $product_array[$key]["code"]; ?>"><?php echo "$".$product_array[$key]["price"]; ?></div>
                
            </div>
        </form>
    </div>
    </div>
    </div>
    <?php
        }
    }
    ?>



</div></div></div>
<?php require_once "ShoppingCart.php"; ?>
<?php require_once "index.php"; ?>