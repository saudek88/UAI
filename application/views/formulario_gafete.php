<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open(base_url() . 'gafetes/agregar_gafete', $atributos) ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos del Gafete</h2>
          </div>
          <div class="form-group col-md-4">
            </div>
          <div class="form-group col-md-4">
            
          </div>
        </div>
        
          <div class="form-group">
            <label for="edificio">Edificio</label>
            <input type="text" class="form-control text-uppercase" id="edificio" placeholder="Ingrese edificio" required name="edificio">
         
          <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" class="form-control text-uppercase" id="numero" placeholder="Ingrese numero" required name="numero">
          </div>
          <div class="form-group">
            <label for="puerta">Puerta</label>
            <input type="text" class="form-control text-uppercase" id="puerta" placeholder="Ingrese puerta" required name="puerta">
          </div>
        <div class="form-group">
          <label for="disponible">Disponible</label>
            <select id="disponible" class="form-control" required name="disponible">
              <option value="">SELECCIONA UN ESTATUS</option>
              
                <option value="SI"> SI</option>;
                <option value="NO"> NO</option>;   
            </select>

        </div>
        
    
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-danger btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>Gafetes'"></input>
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