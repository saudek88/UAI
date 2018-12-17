<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  
 <form class="was-validated" id="formulario_ajax_enviar" >
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos del visitante</h2>
          </div>
          <div class="form-group col-md-4">
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <label class="input-group-text bg-primary text-white" for="gafete">Número de Gafete</label>
              </div>
              <select class="custom-select" id="gafete" required name="gafete">
                <option value="">SELECCIONA UN GAFETE</option>
                  <?php
                    if($gafetes) {
                      foreach ($gafetes as $g) {
                        ?>
                         <option> <?php echo  $g->gafete?></option>;  
                         <?php      
                      }
                    }else{
                      echo "<option>No hay gafete disponible.</option>";
                    }
                    ?>
                </select>
              </div>
            </div>
          <div class="form-group col-md-4">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-dark text-white" for="folio">Folio</span>
              </div>

                <input readonly type="text" class="form-control text-center" id="folio" name="folio" value="<?php echo $ultimo_id + 1;?>"> 
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese Nombre" required name="nombre" value="<?php echo $visita->nombre_visitante?>">
          </div>
          <div class="form-group col-md-4">
            <label for="paterno">Apellido Paterno</label>
            <input type="text" class="form-control text-uppercase" id="paterno" placeholder="Ingrese Apellido Paterno" required name="paterno" value="<?php echo $visita->apellido_pat_visitante?>">
          </div>
          <div class="form-group col-md-4">
            <label for="materno">Apellido Materno</label>
            <input type="text" class="form-control text-uppercase" id="materno" placeholder="ngrese Apellido Materno" required name="materno" value="<?php echo $visita->apellido_mat_visitante?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="procedencia">Procedencia</label>
            <input type="text" class="form-control text-uppercase" id="procedencia" placeholder="Ingrese Procedencia" required name="procedencia" value="<?php echo $visita->procedencia?>">
          </div>
        <div class="form-group col-md-4">
            <label for="motivo">Motivo de visita</label>
            <input type="text" class="form-control text-uppercase" id="motivo" placeholder="Ingrese Motivo de la visita" required name="motivo">
        </div>
        <div class="form-group col-md-4">
            <label for="a_quien">A quien visita</label>
            <input list="browsers" type="text" class="form-control text-uppercase" id="a_quien" placeholder="Ingrese a quién visita" required name="a_quien">
            <datalist id="browsers">
                <?php
                    if($a_quien) {
                      foreach ($a_quien->result() as $a) {
                        ?>
                         <option value = "<?php echo $a -> nombre.' | '. $a -> cargo ?>">
                         <?php      
                      }
                    }else{
                      echo "<option>No hay lista disponible.</option>";
                    }
                    ?>
            </datalist>
        </div>
      </div>
      <div class="form-group">
        <label for="armamento">Armamento</label>
        <input type="text" class="form-control text-uppercase" id="armamento" placeholder="Ingrese arma larga, arma corta" name="armamento" value="<?php echo $visita->armamento?>">
      </div>
      <div class="form-group">
        <label for="pertenencias">Pertenencias</label>
        <input type="text" class="form-control text-uppercase" id="pertenencias" placeholder="Ingrese pertenencias personales" name="pertenencias" value="<?php echo $visita->pertenencias?>">
      </div>
      <div class="form-group">
        <label for="observaciones">Observaciones</label>
        <input type="text" class="form-control text-uppercase" id="observaciones" placeholder="Ingrese observaciones generales" name="observaciones">
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="fecha_entrada">Fecha de entrada</label>
            <div class="input-group date" id="fecha_entrada" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha_entrada" required name="fecha_entrada"/>
                <div class="input-group-append" data-target="#fecha_entrada" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
          <label for="estatus">Estatus</label>
            <select id="estatus" class="form-control" required name="estatus">
              <option value="">SELECCIONA UN ESTATUS</option>
              <?php
                if($estatus !== FALSE) 
                {
                  foreach ($estatus as $s) {
                ?>
                 <option> <?php echo  $s->status?></option>;  
                <?php      
                  }
                }else{
                  echo 'No hay datos';
                }
                ?>
            </select>

        </div>
        <div class="form-group col-md-4">
          <label for="telefono">Teléfono (opcinal)</label>
           <input type="text" class="form-control text-uppercase" id="telefono" placeholder="Ingrese teléfono" name="telefono" value="<?php echo $visita->telefono?>">
        </div>
      </div>
      <h4>Datos del vehiculo</h4>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="placa">No. Placa</label>
          <input type="text" class="form-control text-uppercase" id="placa" placeholder="Ingrese número de placa" name="placa" value="<?php echo $visita->vehiculo_placa?>">
        </div>
        <div class="form-group col-md-3">
          <label for="marca">Marca</label>
          <input type="text" class="form-control text-uppercase" id="marca" placeholder="Ingrese marca" name="marca" value="<?php echo $visita->vehiculo_marca?>">
        </div>
        <div class="form-group col-md-3">
          <label for="tipo">Tipo</label>
          <input type="text" class="form-control text-uppercase" id="tipo" placeholder="Ingrese tipo" name="tipo" value="<?php echo $visita->vehiculo_tipo?>">
        </div>
        <div class="form-group col-md-3">
          <label for="modelo">Modelo</label>
          <input type="text" class="form-control text-uppercase" id="modelo" placeholder="Ingrese modelo" name="modelo" value="<?php echo $visita->vehiculo_modelo?>">
        </div>
      </div>
      <div class="form-row">
         <div class="form-group col-md-12">
                <legend class="col-form-label"><h4>Relevancia</h4></legend>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" requided value="1" type="radio" name="relevante" id="relevante1" <?php if ($visita->relevante == '1') echo "checked"; ?>>
                  <label class="form-check-label" for="relevante1">SI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required value="0" type="radio" name="relevante" id="relevante2" <?php if ($visita->relevante == '0') echo "checked"; ?>>
                  <label class="form-check-label" for="relevante2">NO</label>
                </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-success btn-lg btn-block" id="submit">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>visitas'"></input>
        </div>
        
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <?php echo validation_errors(); ?>
        </div>
      </div>
  </form>
</div>
</body>
 <script type="text/javascript">
        var today = new Date(
                      new Date().getFullYear(),
                      new Date().getMonth(),  
                      new Date().getDate(), 
                      new Date().getHours(), 
                      new Date().getMinutes(), 
                      new Date().getSeconds()-0.1
                      );
            $(function () {
                $('#fecha_entrada').datetimepicker({
                    locale: 'es',
                    format:'DD/MM/YYYY HH:mm:ss',
                    maxDate : today,                  
                });
            });



var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);  
$("#formulario_ajax_enviar").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url()?>visitas/agregar_visita",
          type: "post",
          data: $(this).serialize(),
          success:function(response){
              var typeData = {broadType : 'visitas', data : true};
              conn.sendMsg(typeData); 
              location.href = "<?php echo base_url();?>visitas";

            }
        });

      });
  </script>



</html>