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

            </div>
          <div class="form-group col-md-4">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-dark text-white" for="folio">Folio</span>
              </div>

                <input readonly type="text" class="form-control text-center" id="folio" name="folio" value="<?php echo $ultimo_id+1;?>"> 
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese Nombre" required name="nombre" >
          </div>
          <div class="form-group col-md-4">
            <label for="paterno">Apellido Paterno</label>
            <input type="text" class="form-control text-uppercase" id="paterno" placeholder="Ingrese Apellido Paterno" required name="paterno">
          </div>
          <div class="form-group col-md-4">
            <label for="materno">Apellido Materno</label>
            <input type="text" class="form-control text-uppercase" id="materno" placeholder="ngrese Apellido Materno" required name="materno">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="procedencia">Procedencia</label>
            <input type="text" class="form-control text-uppercase" id="procedencia" placeholder="Ingrese Procedencia" required name="procedencia">
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
          <label for="telefono">Teléfono</label>
           <input type="text" class="form-control text-uppercase" id="telefono" placeholder="Ingrese teléfono" name="telefono" >
        </div>
      </div>
      <div class="form-row">
         <div class="form-group col-md-12">
                <legend class="col-form-label"><h4>Relevancia</h4></legend>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" requided value="1" type="radio" name="relevante" id="relevante1" >
                  <label class="form-check-label" for="relevante1">SI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required value="0" type="radio" name="relevante" id="relevante2" >
                  <label class="form-check-label" for="relevante2">NO</label>
                </div>
        </div>
      </div>
    
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-success btn-lg btn-block" id="submit">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>programadas'"></input>
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
                    date : today,                  
                });
            });



var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);  
$("#formulario_ajax_enviar").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url()?>programadas/agregar_programada",
          type: "post",
          data: $(this).serialize(),
          success:function(response){
           // alert('entre al success');
              //var typeData = { data : true};
             // conn.sendMsg(typeData); 
              var typeData = {broadType : 'programadas', data : true};
              conn.sendMsg(typeData); 
              location.href = "<?php echo base_url();?>programadas";

            }
        });

      });
  </script>



</html>