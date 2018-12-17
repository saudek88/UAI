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
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <label class="input-group-text bg-primary text-white" for="gafete">Número de Gafete</label>
              </div>
              <select class="custom-select" id="gafete" required name="gafete" <?php echo $deshabilitar ?>>
                <option value="">SELECCIONA UN GAFETE</option>
                <option selected > <?php echo $visita-> gafete ?></option>;  
                  <?php
                    if($gafetes !== FALSE) {
                      foreach ($gafetes as $g) {
                        ?>
                         <option > <?php echo  $g->gafete?></option>;
                         <?php                                                      
                      }
                    }
                    else{
                      echo 'No hay datos';
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
                <input readonly type="text" class="form-control text-center" id="folio" name="folio" value="<?php echo $ultimo_id?>"> 
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese Nombre" required name="nombre" value="<?php echo $visita->nombre_visitante?>"  <?php echo $deshabilitar ?>>
          </div>
          <div class="form-group col-md-4">
            <label for="paterno">Apellido Paterno</label>
            <input type="text" class="form-control text-uppercase" id="paterno" placeholder="Ingrese Apellido Paterno" required name="paterno" value="<?php echo $visita->apellido_pat_visitante?>" <?php echo $deshabilitar ?>>
          </div>
          <div class="form-group col-md-4">
            <label for="materno">Apellido Materno</label>
            <input type="text" class="form-control text-uppercase" id="materno" placeholder="ngrese Apellido Materno" required name="materno" value="<?php echo $visita->apellido_mat_visitante?>" <?php echo $deshabilitar ?>>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="procedencia">Procedencia</label>
            <input type="text" class="form-control text-uppercase" id="procedencia" placeholder="Ingrese Procedencia" required name="procedencia" value="<?php echo $visita->procedencia?>" <?php echo $deshabilitar ?>>
          </div>
        <div class="form-group col-md-4">
            <label for="motivo">Motivo de visita</label>
            <input type="text" class="form-control text-uppercase" id="motivo" placeholder="Ingrese Motivo de la visita" required name="motivo" value="<?php echo $visita->motivo_visita?>" <?php echo $deshabilitar ?>>
        </div>
        <div class="form-group col-md-4">
            <label for="a_quien">A quien visita</label>
            <input list="browsers" type="text" class="form-control text-uppercase" id="a_quien" placeholder="Ingrese a quién visita" required name="a_quien" value="<?php echo $visita->a_quien_visita?>" <?php echo $deshabilitar ?>>
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
        <input type="text" class="form-control text-uppercase" id="armamento" placeholder="Ingrese arma larga, arma corta" name="armamento" value="<?php echo $visita->armamento?>" <?php echo $deshabilitar ?>>
      </div>
      <div class="form-group">
        <label for="pertenencias">Pertenencias</label>
        <input type="text" class="form-control text-uppercase" id="pertenencias" placeholder="Ingrese pertenencias personales" name="pertenencias" value="<?php echo $visita->pertenencias?>" <?php echo $deshabilitar ?>>
      </div>
      <div class="form-group">
        <label for="observaciones">Observaciones</label>
        <input type="text" class="form-control text-uppercase" id="observaciones" placeholder="Ingrese observaciones generales" name="observaciones" value="<?php echo $visita->observaciones?>" <?php echo $deshabilitar ?>>
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


            <div class="input-group date" id="fecha_salida" data-target-input="nearest" >
              <input type="hidden" class="form-control datetimepicker-input" data-target="#fecha_salida" required name="fecha_salida" />
                <div class="input-group-append" data-target="#fecha_salida" data-toggle="datetimepicker">
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

                    if( $visita->status == $s->status){
                ?>
                 <option selected="<?php echo  $visita-> status?>" > <?php echo  $s-> status?></option>;  
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
          <label for="telefono">Teléfono (opcinal)</label>
           <input type="text" class="form-control text-uppercase" id="telefono" placeholder="Ingrese teléfono" name="telefono" value="<?php echo $visita->telefono?>" <?php echo $deshabilitar ?>>
        </div>
      </div>
      <h4>Datos del vehiculo</h4>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="placa">No. Placa</label>
          <input type="text" class="form-control text-uppercase" id="placa" placeholder="Ingrese número de placa" name="placa" value="<?php echo $visita->vehiculo_placa?>" <?php echo $deshabilitar ?>>
        </div>
        <div class="form-group col-md-3">
          <label for="marca">Marca</label>
          <input type="text" class="form-control text-uppercase" id="marca" placeholder="Ingrese marca" name="marca" value="<?php echo $visita->vehiculo_marca?>" <?php echo $deshabilitar ?>>
        </div>
        <div class="form-group col-md-3">
          <label for="tipo">Tipo</label>
          <input type="text" class="form-control text-uppercase" id="tipo" placeholder="Ingrese tipo" name="tipo" value="<?php echo $visita->vehiculo_tipo?>" <?php echo $deshabilitar ?>>
        </div>
        <div class="form-group col-md-3">
          <label for="modelo">Modelo</label>
          <input type="text" class="form-control text-uppercase" id="modelo" placeholder="Ingrese modelo" name="modelo" value="<?php echo $visita->vehiculo_modelo?>" <?php echo $deshabilitar ?>>
        </div>
      </div>
      <div class="form-row">
         <div class="form-group col-md-12">
                <legend class="col-form-label"><h4>Relevancia</h4></legend>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" requided value="1" type="radio" name="relevante" id="relevante1" <?php echo $deshabilitar; echo' '; if ($visita->relevante == '1') echo "checked"; ?>>
                  <label class="form-check-label" for="relevante1">SI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required value="0" type="radio" name="relevante" id="relevante2" <?php echo $deshabilitar; echo ' '; if ($visita->relevante == '0') echo "checked"; ?>>
                  <label class="form-check-label" for="relevante2">NO</label>
                </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-success btn-lg btn-block" <?php echo $deshabilitar ?>>ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>investigaciones'"></input>
        </div>

        <?php if( $deshabilitar){
            echo '<div class="form-group col-md-3">';
            echo '<input type="button" class="btn btn-primary btn-lg btn-block" value="REINGRESO" id="reingreso" data-toggle="modal" data-target="#reingresoModal"></input>';
            echo '</div>'; 
          } ?>
        <div class="form-group col-md-3">
            <?php
              if($this->session->userdata('permisos') == 'TODOS'){
            ?>
           <!-- <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" onclick="location.href='<?php echo base_url();?>visitas/visita_eliminar/<?php echo $visita->Id;?>'"></input>-->
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#exampleModal"></input>
            <?php
              }
            ?>
        </div>
        
        
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
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar la visita?</h5>
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
<!-- Modal -->
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
                    date: '<?php echo $visita->fecha_ingreso ?>',
                    maxDate : today,                  
                });
            });    
  </script>

  <script type="text/javascript">
  var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);   
$(document).ready(function() {
  var Id = "<?php echo $visita->Id?>";  
      $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>visitas/visita_eliminar/"+Id,
              type : "post",
              success : function(response){
                var typeData = {broadType : 'visitas', data : true};
                conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>visitas";
                }
            })
        });
      $("#formulario_ajax").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url()?>visitas/actualizar_visita",
          type: "post",
          data: $(this).serialize(),
          success:function(response){
              var typeData = {broadType : 'visitas', data : true};
              conn.sendMsg(typeData); 
              location.href = "<?php echo base_url();?>visitas";
            }
        });

      });

      $('#si_reingresar').click(function(e){
              e.preventDefault();
            let id_reingreso = document.getElementById("folio").value;

              if(!isNaN(id_reingreso)){
                location.href = "<?php echo site_url('visitas/nueva_visita_reingreso/"+ id_reingreso +"') ?>";
              }else{
                alert('¡Error al intentar instertar nuevo registro!');
              }

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