<?php
session_start();


?>

<div class=" alert-success" role="alert" id="liveAlertPlaceholder"></div>
<div>
<br>
<form action="index.php"  >
                <input type="submit" value="Atrás" class="btn  btn-primary" >
            </form>
</div>

   
<div id="wrapper">
  <div class="row">
    <div class="col-xs-5">
      <div id="cards">
        <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png">
        <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png">
      </div><!--#cards end-->
      <div class="form-check">
  <label class="form-check-label" for='card'>
    <input id="card" class="form-check-input" type="checkbox" value="">
    Pay with credit card
  </label>
</div>
    </div><!--col-xs-5 end-->
    <div class="col-xs-5">
      <div id="cards">
        <img src="http://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Paypal-icon.png">
      </div><!--#cards end-->
      <div class="form-check">
  <label class="form-check-label" for='paypal'>
    <input id="paypal" class="form-check-input" type="checkbox" value="">
    Pay with PayPal
  </label>
</div>
    </div><!--col-xs-5 end-->
  </div><!--row end-->
  <div class="row">
    <div class="col-xs-5">
      <i class="fa fa fa-user"></i>
      <label for="cardholder">Nombre del titular de la tarjeta</label>
      <input type="text" id="cardholder">
    </div><!--col-xs-5-->
    <div class="col-xs-5">
      <i class="fa fa-credit-card-alt"></i>
      <label for="cardnumber">Número de tarjeta</label>
      <input type="text" id="cardnumber">
    </div><!--col-xs-5-->
  </div><!--row end-->
  <div class="row row-three">
    <div class="col-xs-2">
      <i class="fa fa-calendar"></i>
      <label for="date">Válido hasta</label>
      <input type="text" placeholder="MM/YY" id="date">
    </div><!--col-xs-3-->
    <div class="col-xs-2">
      <i class="fa fa-lock"></i>
      <label for="date">CVV / CVC *</label>
      <input type="text">
    </div><!--col-xs-3-->
    <div class="col-xs-5">
      <span class="small">* CVV or CVC is the card security code, unique three digits number on the back of your card seperate from its number.</span>
       </div><!--col-xs-6 end-->
       <br><br>
       <div class="col-xs-2">

      <br>
  <button type="button" class="btn btn-primary" id="liveAlertBtn">Pagar</button>   <br><br><br>
  <br><br>
  </div> </div><!--row end-->
<link rel="stylesheet" href="pago.css">
  <script src="pago.js"></script>
  <footer>
   

 
<script>const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertTrigger = document.getElementById('liveAlertBtn')
if (alertTrigger) {
  alertTrigger.addEventListener('click', () => {
    appendAlert('El pago se realizo con exito!', 'success')
  })
}</script>
</footer>
</div><!--wrapper end-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>