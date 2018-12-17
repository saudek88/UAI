<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open(base_url() . 'usuarios/agregar_usuario', $atributos) ?>
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
            <input type="text" class="form-control text-uppercase" id="usuario" placeholder="Ingrese usuario" required name="usuario">
          </div>
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese nombre" required name="nombre">
          </div>
          <div class="form-group col-md-4">
            <label for="iniciales">Inciales</label>
            <input type="text" class="form-control text-uppercase" id="iniciales" placeholder="Ingrese iniciales" required name="iniciales">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control text-uppercase" id="cargo" placeholder="Ingrese cargo" required name="cargo">
          </div>
          <div class="form-group col-md-4">
            <label for="pass">Contraseña</label>
            <input type="password" class="form-control text-uppercase" id="pass" placeholder="Ingrese contraseña" required name="pass">
          </div>

        </div>
         <div class="form-row">
          <div class="form-group col-md-6">
            <label for="tipo">Tipo de Usuario</label>
            <select id="tipo" class="form-control" required name="tipo">
              <option value="">SELECCIONA UN TIPO DE USUARIO</option>
                <option value="ADMIN">ADMIN</option>;
                <option value="USUARIO">USUARIO</option>;
                <option value="SUPERUSUARIO">SUPERUSUARIO</option>;   

            </select>
        </div>

        <div class="form-group col-md-6">
          <label for="permisos">Tipo de Permisos</label>
            <select id="permisos" class="form-control" required name="permisos">
              <option value="">SELECCIONA UN TIPO DE PERMISOS</option>
                <option value="TODOS">TODOS</option>;
                <option value="PUERTA">PUERTA</option>;
                <option value="PROGRAMADAS">PROGRAMADAS</option>;
                <option value="NO BORRAR">NO BORRAR</option>;
            </select>
        </div>
         </div>
      
        
    <?php echo $this-> session->flashdata('msg'); ?>
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-danger btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>usuarios'"></input>
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
 
</html>