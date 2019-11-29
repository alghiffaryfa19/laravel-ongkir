<!DOCTYPE html>
<html lang="">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cek Resi Anda</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
 </head>
 <body>
  <div class="container">
   <h2 align="center">Cek Nomor Resi (JNE, TIKI, & POS INDONESIA)</h2>
   <hr>
   <div class="col-lg-4">
    <div class="panel panel-success">
     <div class="panel-heading">Cek Resi Anda</div>
     <div class="panel-body">
      <form action="" method="POST">
       <div class="form-group"> 
        <label for="" class="control-label">Nomor Resi</label>
        <input type="text" class="form-control" name="resi" required>
       </div>
       <div class="form-group">
        <label for="" class="control-label" >Jasa Pengiriman</label>
        <select name="jasa" id="" class="form-control" required>
         <option value="">-- Pilih Jasa Pengiriman -- </option>
         <option value="jne">JNE</option>
         <option value="tiki">TIKI</option>
         <option value="wahana">POS INDONESIA</option>
        </select>
       </div>
     </div>
     <div class="panel-footer">
     <button type="button" class="button cart_button_clear"><a href="{{ url('keranjang/remove') }}" class="cek-ongkir" style="color:black;">Cek Ongkir</a></button>
     </div>
     </form>
    </div>
   </div>
   <div class="col-lg-8">
    <?php  
     if (isset($_POST['cek'])) 
     {
      $resi = isset($_POST['resi'])?$_POST['resi']:"";
      $jasa = isset($_POST['jasa'])?$_POST['jasa']:"";

      $ambil_content = file_get_contents("http://api.shipping.esoftplay.com/waybill/".$resi."/".$jasa."");

      $result = json_decode($ambil_content, true);
      print_r($result);
      //ambil data

      //date

      
     }
    ?>
   </div>
  </div>
  <p align="center">Code by <a href="http://ibacor.com/forum_fb/php-indonesia/35688476100_10154071765821101/share-update-cek-resi-pos-indonesia-sob-thanks-ibacor-dcek-resi-s" target="_BLANK">Pandu</a></p>
  <!-- jQuery -->
  <script src="//code.jquery.com/jquery.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <script src="Hello World"></script>
 </body></html>

