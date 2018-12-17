<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open(base_url() . 'usuarios/actualizar_usuario/'. $usuarios -> Id, $atributos) ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos de Usuario</h2>
          </div>
          <div class="form-group col-md-4">
            </div>
          <div class="form-group col-md-4">
            
          </div>
        </div>
        
<div class="form-row">
          <div class="form-group col-md-4">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control text-uppercase" id="usuario" placeholder="Ingrese usuario" required name="usuario" value="<?php echo $usuarios->USUARIO?>">
          </div>
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese nombre" required name="nombre" value="<?php echo $usuarios->NOMBRE?>">
          </div>
          <div class="form-group col-md-4">
            <label for="iniciales">Inciales</label>
            <input type="text" class="form-control text-uppercase" id="iniciales" placeholder="Ingrese iniciales" required name="iniciales" value="<?php echo $usuarios->INICIALES?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control text-uppercase" id="cargo" placeholder="Ingrese cargo" required name="cargo" value="<?php echo $usuarios->CARGO?>">
          </div>
          <div class="form-group col-md-4">
            <label for="pass">Contraseña</label>
            <input type="password" class="form-control text-uppercase" id="pass" readonly="true" placeholder="Ingrese contraseña" required name="pass" value="<?php echo $usuarios->CONTRASENA?>">
          </div>

          <div class="form-group col-md-2">
              <label for="pass">Reset Password</label>
          <button type="button" class="btn btn-success  btn-block" id="reset_pass">Reset pass</button>
         
        </div>

        </div>
         <div class="form-row">
          <div class="form-group col-md-6">
            <label for="tipo">Tipo de Usuario</label>
            <select id="tipo" class="form-control" required name="tipo">
              <option value="">SELECCIONA UN TIPO DE USUARIO</option>
              <?php
              switch ($usuarios->TIPO) {
                case 'ADMIN':
                 echo "<option selected value='ADMIN'>ADMIN</option>";
                 echo "<option value='USUARIO'>USUARIO</option>";
                 echo "<option value='SUPERUSUARIO'>SUPERUSUARIO</option>";
                  break;
                
                case 'USUARIO':
                 echo "<option value='ADMIN'>ADMIN</option>";
                 echo "<option selected value='USUARIO'>USUARIO</option>";
                 echo "<option value='SUPERUSUARIO'>SUPERUSUARIO</option>";
                  break;

                  case 'SUPERUSUARIO':
                 echo "<option value='ADMIN'>ADMIN</option>";
                 echo "<option value='USUARIO'>USUARIO</option>";
                 echo "<option selected value='SUPERUSUARIO'>SUPERUSUARIO</option>";
                  break;
              }

              ?>

            </select>
        </div>

        <div class="form-group col-md-6">
          <label for="permisos">Tipo de Permisos</label>
            <select id="permisos" class="form-control" required name="permisos">
              <option value="">SELECCIONA UN TIPO DE PERMISOS</option>
              <?php
                switch ($usuarios->PERMISOS) {
                  case 'TODOS':
                    echo "<option selected value='TODOS'>TODOS</option>";
                    echo "<option value='PUERTA'>PUERTA</option>";
                    echo "<option value='PROGRAMADAS'>PROGRAMADAS</option>";
                    echo "<option value='NO BORRAR'>NO BORRAR</option>";
                    break;
                  case 'PUERTA':
                    echo "<option value='TODOS'>TODOS</option>";
                    echo "<option selected value='PUERTA'>PUERTA</option>";
                    echo "<option value='PROGRAMADAS'>PROGRAMADAS</option>";
                    echo "<option value='NO BORRAR'>NO BORRAR</option>";
                    break;                  
                  case 'PROGRAMADAS':
                    echo "<option value='TODOS'>TODOS</option>";
                    echo "<option value='PUERTA'>PUERTA</option>";
                    echo "<option selected value='PROGRAMADAS'>PROGRAMADAS</option>";
                    echo "<option value='NO BORRAR'>NO BORRAR</option>";
                    break;
                  case 'NO BORRAR':
                    echo "<option value='TODOS'>TODOS</option>";
                    echo "<option value='PUERTA'>PUERTA</option>";
                    echo "<option value='PROGRAMADAS'>PROGRAMADAS</option>";
                    echo "<option selected value='NO BORRAR'>NO BORRAR</option>";
                    break;
                }
              ?>
            </select>
        </div>
         </div>
        
    
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>usuarios'"></input>
        </div>
         <div class="form-group col-md-3">
           <!-- <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" onclick="location.href='<?php echo base_url();?>visitas/visita_eliminar/<?php echo $visita->Id;?>'"></input>-->
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#eliminarusuarioModal"></input>

        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <?php echo validation_errors(); ?>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>


<!-- Modal -->
<div class="modal fade" id="eliminarusuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar el usuario <?php echo $usuarios->USUARIO?>?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
      <button type="button" id="si_eliminar" class="btn btn-success">Si</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        
      </div>
    </div>
  </div>
</div>
</body>
 
<script type="text/javascript">
  $(document).ready(function() {
    var Id = "<?php echo $usuarios->Id?>";  

      $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>usuarios/usuario_eliminar/"+Id,
              type : "post",
              success : function(response){
                //var typeData = {broadType : 'usuario', data : true};
                //conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>usuarios";
                }
            })
        });



    var Idaux = "<?php echo $usuarios->Id?>";
      
      $('#reset_pass').click(function(){

          var parametros = {"password" : $("#pass").val()}
         

      $.ajax({
              data : parametros,
              url : "<?php echo site_url('usuarios/reset_password/"+ Idaux +"') ?>",
              type : "post",
              success : function(response){
                document.getElementById("pass").value = '1234';
                alert('La contraseña se reseteo');
                     //response contiene la respuesta al llamado de tu archivo
                     //aqui actualizas los valores de inmediato llamando a sus respectivas id.
              }
       })
      })

  });

</script>

</html>