<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open(base_url() . 'estatus/agregar_estatus', $atributos) ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos de Estatus</h2>
          </div>
          <div class="form-group col-md-4">
            </div>
          <div class="form-group col-md-4">
            
          </div>
        </div>
        
          <div class="form-group">
            <label for="estatus">Estatus</label>
            <input type="text" class="form-control text-uppercase" id="estatus" placeholder="Ingrese estatus" required name="estatus">
            </div>
        <div class="form-group">
          <label for="tipo">Tipo</label>
            <select id="tipo" class="form-control" required name="tipo">
              <option value="">SELECCIONA UN TIPO</option>
              
                <option value="1">VISITAS</option>;
                <option value="0">PROGRAMADAS</option>;   
            </select>

        </div>
        
    
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-danger btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>Estatus'"></input>
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