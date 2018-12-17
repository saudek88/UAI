<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
        <form class="was-validated" id="formulario_ajax" >
        <div class="form-row">
          <div class="form-group col-md-4">
          <h2>Modificar datos del visitante</h2>
          </div>
          <div class="form-group col-md-4">
         
          </div>
          <div class="form-group col-md-4">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-dark text-white" for="folio">Folio</span>
              </div>
                <input readonly type="text" class="form-control text-center" id="folio" name="folio" value="<?php echo $ultimo_id?>"> 
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese Nombre" required name="nombre" value="<?php echo $programada->nombre?>"  <?php echo $deshabilitar ?>>
          </div>
          <div class="form-group col-md-4">
            <label for="paterno">Apellido Paterno</label>
            <input type="text" class="form-control text-uppercase" id="paterno" placeholder="Ingrese Apellido Paterno" required name="paterno" value="<?php echo $programada->apellido_pat?>" <?php echo $deshabilitar ?>>
          </div>
          <div class="form-group col-md-4">
            <label for="materno">Apellido Materno</label>
            <input type="text" class="form-control text-uppercase" id="materno" placeholder="ngrese Apellido Materno" required name="materno" value="<?php echo $programada->apellido_mat?>" <?php echo $deshabilitar ?>>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="procedencia">Procedencia</label>
            <input type="text" class="form-control text-uppercase" id="procedencia" placeholder="Ingrese Procedencia" required name="procedencia" value="<?php echo $programada->procedencia?>" <?php echo $deshabilitar ?>>
          </div>
        <div class="form-group col-md-4">
            <label for="motivo">Motivo de visita</label>
            <input type="text" class="form-control text-uppercase" id="motivo" placeholder="Ingrese Motivo de la visita" required name="motivo" value="<?php echo $programada->motivo?>" <?php echo $deshabilitar ?>>
        </div>
        <div class="form-group col-md-4">
            <label for="a_quien">A quien visita</label>
            <input list="browsers" type="text" class="form-control text-uppercase" id="a_quien" placeholder="Ingrese a quién visita" required name="a_quien" value="<?php echo $programada->a_quien_visita?>" <?php echo $deshabilitar ?>>
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
        <input type="text" class="form-control text-uppercase" id="observaciones" placeholder="Ingrese observaciones generales" name="observaciones" value="<?php echo $programada->observaciones?>" <?php echo $deshabilitar ?>>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="fecha_entrada">Fecha de entrada</label>
            <div class="input-group date" id="fecha_entrada" data-target-input="nearest" >
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha_entrada" required name="fecha_entrada" <?php echo $deshabilitar ?>/>
                <div class="input-group-append" data-target="#fecha_entrada" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
          <label for="estatus">Estatus</label>
            <select id="estatus" class="form-control" required name="estatus" <?php echo $deshabilitar ?> onchange="cambio_esatatu(this.value)">
              <option value="">SELECCIONA UN ESTATUS</option>
              <?php
                if($estatus !== FALSE) 
                {
                  foreach ($estatus as $s) {

                    if( $programada->status == $s->status){
                ?>
                 <option selected="<?php echo  $programada-> status?>" > <?php echo  $s-> status?></option>;  
                <?php  
                    } 
                    else{
                      ?>
                      <option > <?php echo  $s-> status?></option>;  
                      <?php
                    }   
                  }
                }else{
                  echo 'No hay datos';
                }
                ?>
            </select>

        </div>
        <div class="form-group col-md-4">
          <label for="telefono">Teléfono</label>
           <input type="text" class="form-control text-uppercase" id="telefono" placeholder="Ingrese teléfono" name="telefono" value="<?php echo $programada->telefono?>" <?php echo $deshabilitar ?>>
        </div>
      </div>
<div class="form-row">
         <div class="form-group col-md-12">
                <legend class="col-form-label"><h4>Relevancia</h4></legend>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" requided type="radio" value="1" name="relevante" id="relevante1" <?php echo $deshabilitar; echo ' '; if ($programada->relevante == '1') echo "checked"; ?>>
                  <label class="form-check-label" for="relevante1">SI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required type="radio" value="0" name="relevante" id="relevante2" <?php echo $deshabilitar; echo ' '; if (!$programada->relevante == '1') echo "checked"; ?>>
                  <label class="form-check-label" for="relevante2">NO</label>
                </div>
        </div>
      </div>


      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-success btn-lg btn-block" <?php echo $deshabilitar ?>>ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>programadas'"></input>
        </div>
        <div class="form-group col-md-3">
           <!-- <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" onclick="location.href='<?php echo base_url();?>visitas/visita_eliminar/<?php echo $visita->Id;?>'"></input>-->
           <?php
              if($this->session->userdata('permisos') == 'TODOS'){
            ?>
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#exampleModal"></input>
            <?php 
            }
            ?>
        </div>
        <?php if( $deshabilitar){
           //echo '<div class="form-group col-md-3">';
            //echo '<input type="button" class="btn btn-primary btn-lg btn-block" value="REINGRESO" id="reingreso" data-toggle="modal" data-target="#reingresoModal"></input>';
           // echo '</div>'; 
          } ?>
        
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <?php echo validation_errors(); ?>
        </div>
      </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar la visita programada?</h5>
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


<!-- Modal -->
<div class="modal fade" id="reingresoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas crear un nuevo registro de visita?</h5>

        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Corrobora los datos antes de ingresar</p>
      </div>
      <div class="modal-footer">
      <button type="button" id="si_reingresar" class="btn btn-primary">Si</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        
      </div>
    </div>
  </div>
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
                    date: '<?php echo $programada->fecha_ingreso ?>',
                    //maxDate : today,                  
                });
            });    
  </script>

  <script type="text/javascript">
  var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);   
$(document).ready(function() {
  var Id = "<?php echo $programada->Id?>";  
      $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>programadas/programada_eliminar/"+Id,
              type : "post",
              success : function(response){
                var typeData = {broadType : 'programadas', data : true};
                conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>programadas";
                }
            })
        });
      $("#formulario_ajax").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url()?>programadas/actualizar_programada",
          type: "post",
          data: $(this).serialize(),
          success:function(response){
              var typeData = {broadType : 'programadas', data : true};
              conn.sendMsg(typeData); 
              location.href = "<?php echo base_url();?>programadas";
            }
        });

      });

      $('#si_reingresar').click(function(e){
              e.preventDefault();

              var visitante = {
                  nombre : document.getElementById("nombre").value,
                  paterno : document.getElementById("paterno").value,
                  materno : document.getElementById("materno").value,
                  procedencia : document.getElementById("procedencia").value,
                  motivo : document.getElementById("motivo").value,
                  armamento : document.getElementById("armamento").value,
                  pertenencias : document.getElementById("pertenencias").value,
                  observaciones : document.getElementById("observaciones").value,
                  telefono : document.getElementById("telefono").value

              };
              var name = document.getElementById("nombre").value;

              console.log(visitante);
             $.post( "<?php echo base_url('visitas/agregar_visita');?>", {nombre: name}, function(){
                

                    location.href = "<?php echo base_url('visitas/nueva_visita'); ?>";
             } );
              //
            /* $.ajax({
              url : "<?php echo base_url('visitas/nueva_visita'); ?>",
              type : "post",
              success : function(response){
                  
                }
            })*/
        });
  
});

function cambio_esatatu(value)
    {
        //you can get the value from arguments itself
        if(value == 'ENTREGÓ GAFETE'){
          var hoy = new Date(
                  new Date().getFullYear(),
                      new Date().getMonth(),  
                      new Date().getDate(), 
                      new Date().getHours(), 
                      new Date().getMinutes(), 
                      new Date().getSeconds()
              );

              $(function () {
                $('#fecha_salida').datetimepicker({
                    locale: 'es',
                    format:'DD/MM/YYYY HH:mm:ss',
                    date: hoy             
                });
            });
              console.log(hoy);
        }
    }

  </script>
</html>