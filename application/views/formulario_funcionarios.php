<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
   <form class="was-validated" id="formulario_ajax_fun" >
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos del funcionario</h2>
          </div>
          <div class="form-group col-md-4">
            </div>
          <div class="form-group col-md-4">
            
          </div>
        </div>
        
          <div class="form-group">
            <label for="nombre">Nombre Funcionario</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese nombre funcionario" required name="nombre">
         
          <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control text-uppercase" id="cargo" placeholder="Ingrese cargo" required name="cargo">
          </div>
          <div class="form-group">
            <label for="dependencia">Dependencia</label>
            <input type="text" class="form-control text-uppercase" id="dependencia" placeholder="Ingrese dependencia" required name="dependencia">
          </div>
        <div class="form-group">
            <label for="area">Área</label>
            <input type="text" class="form-control text-uppercase" id="area" placeholder="Ingrese área" required name="area">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control text-uppercase" id="telefono" placeholder="Ingrese teléfono" name="telefono">
        </div>
    
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-danger btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>funcionarios'"></input>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <?php echo validation_errors(); ?>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>
</body>
<script type="text/javascript">
var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);  
$("#formulario_ajax_fun").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url()?>funcionarios/agregar_funcionario",
          type: "post",
          data: $(this).serialize(),
          success:function(response){
              var typeData = {broadType : 'funcionarios', data : true};
              conn.sendMsg(typeData); 
              location.href = "<?php echo base_url();?>funcionarios";
            }
        });

      });
 </script>
 
</html>