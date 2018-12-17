<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url('assets/img/logo.jpg');?>">

  <title><?php echo $titulo ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/estilo.css'); ?>" rel="stylesheet">


  <link href="<?php echo base_url('assets/css/tempusdominus-bootstrap-4.min.css'); ?>" rel="stylesheet">
  
 <!-- <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" > -->
<link href="<?php echo base_url('assets/css/gijgo.min.css'); ?>" rel="stylesheet">

<!-- PARA LAS DATA TABLES -->

       <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css'); ?>"/>
       <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>-->
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.bootstrap4.min.css'); ?>"/>
        <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>-->

<!-- PARA LAS DATA TABLES -->


  <script>
      var BASE_URL = "<?php echo base_url(); ?>";
      var Broadcast = {
              POST : "<?php echo POST; ?>",
              BROADCAST_URL : "<?php echo BROADCAST_URL; ?>",
              BROADCAST_PORT : "<?php echo BROADCAST_PORT; ?>",
              };
    </script>
    <!-- Bootstrap core JavaScripts
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
   <!-- <script src="<?php //echo base_url('assets/js/umd/popper.min.js'); ?>"></script>-->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    
    <script src="<?php echo base_url('assets/js/gijgo.min.js'); ?>" ></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url('assets/js/messages.es-es.js'); ?>" ></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/messages/messages.es-es.js" type="text/javascript"></script>-->
    
    <script src=" <?php echo base_url('assets/js/moment-with-locales.min.js'); ?>" ></script>

      
    <script src=" <?php echo base_url('assets/js/tempusdominus-bootstrap-4.min.js'); ?>" ></script>
  
     <!-- DATATABLES core JavaScripts-->       

<script  src="<?php echo base_url('assets/js/datatables.min.js'); ?>"></script> 
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/r-2.2.1/sl-1.2.5/datatables.min.js"></script>-->

  <script src="<?php echo base_url(); ?>assets/app/Connection2.js"></script>


<script  src="<?php echo base_url('assets/js/dataTables.buttons.min.js'); ?>"></script> 
<script  src="<?php echo base_url('assets/js/buttons.bootstrap.min.js'); ?>"></script> 


</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
    <a class="navbar-brand" href="<?php echo base_url() ?>">
        <img src="<?php echo base_url('assets/img/ssp-veda.png');?>" width="200px" height = "50px">
    </a>

    <a class="navbar-brand" href="<?php echo base_url()?>">UAI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">INCIO</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" data-toggle="modal" data-target="#acercadeModal" href="">ACERCA DE</a>
            <a class="dropdown-item" href="<?php echo base_url('login/cerrar_sesion/');?>">CERRAR SESIÓN</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">INVESTIGACIONES</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url('investigaciones');?>">INVESTIGACIÓN</a>
            <a class="dropdown-item" href="<?php echo base_url('investigaciones');?>">ENTREVISTA</a>
            
            
          </div>
        </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">RESPONSABILIDADES</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url('responasabilidades');?>">RESPONSABILIDADES</a>
            
            
          </div>
        </li>

        <?php 
          if($this->session->userdata('permisos') == 'TODOS'){
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ADMINISTRADOR</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url('funcionarios');?>">FUNCIONARIOS</a>
            <a class="dropdown-item" href="<?php echo base_url('gafetes');?>">GAFETES</a>
            <a class="dropdown-item" href="<?php echo base_url('estatus');?>">ESTATUS</a>
            <a class="dropdown-item" href="<?php echo base_url('usuarios');?>">USUARIOS</a>
            <a class="dropdown-item" href="<?php echo base_url('general');?>">GENERAL</a>
            <a class="dropdown-item" href="#">HISTORIAL</a>
          </div>
        </li>
        <?php
          }
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">REPORTES</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" data-toggle="modal" data-target="#ReporteVisistasRangoFechasdeModal" href="">REPORTE VISITAS</a>
          </div>
        </li>
      </ul>
      <?php
      //echo '<a class="navbar-brand">CONTROL DE ACCESO</a>';
      echo '<p style="color: white; margin-right: 1px; margin: auto">Usuario: <b>'.$this->session->userdata('usuario').'</b></p>';
      $atributos = array('class' => 'form-inline');
      echo form_open(base_url() . 'login/cerrar_sesion/',$atributos);
      ?>
        <button type="submit" class="btn btn-danger">CERRAR SESIÓN</button>
      <?php 
      echo form_close();
      ?>
    </div>
  </nav>
  
  <!-- Modal -->
<div class="modal fade" id="acercadeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACERCA DE</h5>

        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Desarrollado en el Departamento de Soporte Técnico e Infromatica.</p>
        <p>Versión 1.0</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal RANGO DE FECHAS DE REPORTE -->
<div class="modal fade" id="ReporteVisistasRangoFechasdeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte Visitas, Rango de Fechas</h5>

        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  class="was-validated" id="formulario_ajax_generar_pdf_visitas" action="<?php echo base_url('reportes/generate_pdf')?>" method="post">
      <!--<form  class="was-validated" id="formulario_ajax_generar_pdf_visitas">-->
      <div class="modal-body">      
        <p>FECHA INCIAL</p>
          <div class="input-group date" id="fecha_inicial_reporte_visitas" data-target-input="nearest" >
            <input type="text" class="form-control datetimepicker-input" id="fecha_inicial_reporte_visitas_input" required data-target="#fecha_inicial_reporte_visitas" required name="fecha_inicial_reporte_visitas"/>
            <div class="input-group-append" data-target="#fecha_inicial_reporte_visitas" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        <br />
        <p>FECHA INCIAL</p>
        <div class="input-group date" id="fecha_final_reporte_visitas" data-target-input="nearest" >
          <input type="text" class="form-control datetimepicker-input" id="fecha_final_reporte_visitas_input" required data-target="#fecha_final_reporte_visitas" required name="fecha_final_reporte_visitas"/>
            <div class="input-group-append" data-target="#fecha_final_reporte_visitas" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="form-row">
          <div class="form-group col-md-6">
          <button type="submit" id="submit" formtarget="_blank" class="btn btn-primary">BUSCAR</button>
          </div>
          <div class="form-group col-md-6">
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANELAR</button>
          </div>
        </div>
          
      </div>
      </form>
    </div>
    
  </div>
</div>

  
  </body>
    

<script>
/*$('#formulario_ajax_generar_pdf_visitas').submit(function(e){
   e.preventDefault();
        var url = "<?php echo base_url('reportes/generate_pdf'); ?>";
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: $(this).serialize(), 
           success: function(data)             
           {
           
                $('#modal').modal('toggle');
               // location.href = "<?php echo base_url('reportes/generate_pdf'); ?>";        
           }
       });
             
        
    });*/
       

  $(function () {
    var today = new Date(
            new Date().getFullYear(),
            new Date().getMonth(),  
            new Date().getDate(), 
            );
      today.setHours(23);
      today.setMinutes(59);
      today.setSeconds(59);


      var f_inicial = $('#fecha_inicial_reporte_visitas').datetimepicker({
        locale: 'es',
        format:'DD/MM/YYYY HH:mm:ss',
        maxDate : today,
       
        
      });

     var f_final =  $('#fecha_final_reporte_visitas').datetimepicker({
          locale: 'es',
          format:'DD/MM/YYYY HH:mm:ss',
          //date: fecha_inicial,
          maxDate : today,
                         
      });
      
      
     let f_i;

       $('#fecha_inicial_reporte_visitas').on("change.datetimepicker", function (e) {
       f_i = document.getElementById("fecha_inicial_reporte_visitas_input").value;
                    //fecha_inicial = moment(f_i);
                    
                    //alert(fecha_inicial.format('DD/MM/YYYY HH:mm:ss'));
                        
                       // if(document.getElementById("fecha_inicial_input").value == fecha_inicial.format('DD/MM/YYYY HH:mm:ss')){
                            //alert('si es igual');
                       // }
                       //alert(document.getElementById("fecha_inicial_input").value);
                       //alert(fecha_inicial.format('DD/MM/YYYY HH:mm:ss'));
           

         /*$('#fecha_final_reporte_visitas').datetimepicker('date',moment(f_i, "DD/MM/YYYY HH:mm:ss") );
         $('#fecha_final_reporte_visitas').datetimepicker('maxDate',today );*/
         $('#fecha_final_reporte_visitas').datetimepicker('minDate',moment(f_i, "DD/MM/YYYY HH:mm:ss") );
        
         /* if(f_i != document.getElementById("fecha_final_reporte_visitas_input").value){
            $('#fecha_final_reporte_visitas').datetimepicker('date',moment(f_i, "DD/MM/YYYY HH:mm:ss") );
           }*/
          
      
                             /* $('#fecha_final').on("change.datetimepicker", function (e) {
                                   f_f = $('#fecha_final').datetimepicker('viewDate');
                                    fecha_final = moment(f_f);
                                      if(document.getElementById("fecha_inicial_input").value > fecha_final){
                                          alert('es mayor fecha inicial');
                                      }*/
                              });
                
            });
  
</script>


  </html>
