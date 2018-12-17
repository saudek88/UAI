<!doctype html>
<html lang="en">
<?php
if (isset($this->session->userdata['logged_in'])) {

//
  header("location: ".base_url()."login/index");
}else{
 // header("location: ".base_url());
}
?>

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!--<link rel="icon" href="../../../../favicon.ico">-->

  <title><?php echo $titulo ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/dashboard.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">


  <link href="<?php echo base_url('assets/css/tempusdominus-bootstrap-4.min.css'); ?>" rel="stylesheet">
  
  <link href="<?php echo base_url('assets/css/gijgo.min.css'); ?>" rel="stylesheet">


<!-- PARA LAS DATA TABLES -->
<link href="<?php echo base_url('assets/css/signin.css'); ?>" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css'); ?>"/>
       <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>-->
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.bootstrap4.min.css'); ?>"/>
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>-->
<!-- PARA LAS DATA TABLES -->

</head>

<body>

     <div class="container">
      <?php
      if (isset($logout_message)) {
      echo "<div class='message'>";
      echo $logout_message;
      echo "</div>";
      }
      ?>
      <?php
      if (isset($message_display)) {
      echo "<div class='message'>";
      echo $message_display;
      echo "</div>";
      }
      ?>

     <?php $atributos = array('class' => 'form-signin');
     echo form_open(base_url() . 'login/logear_usuario', $atributos) ?>
        <div ><img src="<?php echo base_url('assets/img/ssp-veda.png');?>" class="img-fluid"></div>
        
        <br />
        <h2 align="center" class="form-signin-heading">SSP Michoacán</h2>
        <h4 align="center" class="form-signin-heading">Unidad de Asuntos Internos</h4>

        <label for="usuario" class="sr-only">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingresa usuario" required autofocus>
        <label for="password" class="sr-only">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese contraseña" required>
        <div class="checkbox">
          
        </div>
        <button id="btn_login" name="btn_login" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <?php echo form_close(); ?>

    </div> <!-- /container -->
    <?php echo $this-> session->flashdata('msg'); ?>


  </div>
</body> 
<footer>
  <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/gijgo.min.js'); ?>" type="text/javascript"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url('assets/js/messages.es-es.js'); ?>" type="text/javascript"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/messages/messages.es-es.js" type="text/javascript"></script>-->
    
    <script src=" <?php echo base_url('assets/js/moment-with-locales.min.js'); ?>" type="text/javascript"></script>

      
    <script src=" <?php echo base_url('assets/js/tempusdominus-bootstrap-4.min.js'); ?>" type="text/javascript"></script>
  
     <!-- DATATABLES core JavaScripts-->       

 
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables.min.js'); ?>"></script> 




</footer>
</html>