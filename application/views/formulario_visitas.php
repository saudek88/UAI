<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  
 <form class="was-validated" id="formulario_ajax_enviar" >
        <div class="form-row">
          <div class="form-group col-md-6">
            <h2>DATOS DE LA INVESTIGACIÓN</h2>
          </div>
           <div class="form-group col-md-3">
          <div class="input-group col-mb-3 input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text bg-dark text-white" for="id">ID</span>
              </div>

                <input readonly type="text" class="form-control text-center" id="id" name="id" value="<?php echo $ultimo_id + 1;?>"> 
            </div>
          </div>
          <div class="form-group col-md-3">
          <div class="input-group col-mb-3 input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text bg-info text-white" for="id">FECHA</span>
              </div>

                <input readonly type="text" class="form-control text-center" id="id" name="id" value="<?php echo date('d/m/Y H:i:s');?>"> 
            </div>
          </div>
       </div>

          <div class="form-row">
            <div class="form-group col-md-4 input-group-sm">
            <label for="asignado">Asigando a</label>
            <input type="text" class="form-control text-uppercase" id="asignado" placeholder="Ingrese Asignación" required name="asignado">
          </div>
          <div class="form-group col-md-4 input-group-sm">
            <label for="procedencia">Procedencia</label>
            <input type="text" class="form-control text-uppercase" id="procedencia" placeholder="Ingrese Procedencia" required name="procedencia">
          </div>
          <div class="form-group col-md-4 ">
          <label for="fecha_recibido">Fecha de recibido</label>
            <div class="input-group input-group-sm date" id="fecha_recibido" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha_recibido" required name="fecha_recibido"/>
                <div class="input-group-append" data-target="#fecha_recibido" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

          </div>

          <div class="form-row">
              <div class="form-group col-md-3 input-group-sm">
              <label for="no_folio">No. de Expediente</label>
              <input type="text" class="form-control text-uppercase" id="no_folio" placeholder="Ingrese No. de Expedeinte" required name="no_folio">
            </div>
             <div class="form-group col-md-3 input-group-sm">
              <label for="no_folio">No. de Oficio</label>
              <input type="text" class="form-control text-uppercase" id="no_folio" placeholder="Ingrese No. de Expedeinte" required name="no_folio">
            </div>
        <div class="form-group col-md-3 ">
          <label for="fecha_hechos">Fecha de hechos</label>
            <div class="input-group input-group-sm date" id="fecha_hechos" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha_hechos" required name="fecha_hechos"/>
                <div class="input-group-append" data-target="#fecha_hechos" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group col-md-3 input-group-sm">
              <label for="id_entrevista">Id Entevista Asociada</label>
              <input type="text" class="form-control text-uppercase" readonly="" id="id_entrevista" placeholder="ID ENTREVISTA" required name="id_entrevista">
            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-12 input-group-sm">
            <label for="asunto">Asunto</label>
            <input type="text" class="form-control text-uppercase" id="asunto" placeholder="Ingrese Asunto" required name="asunto">
          </div>

          </div>

           <div class="form-row">            
              <div class="form-group col-md-3 input-group-sm">
              <label for="municipio">Municipio</label>
              <input type="text" class="form-control text-uppercase" id="municipio" placeholder="Ingrese Municipio" required name="municipio">
            </div>
             <div class="form-group col-md-3 input-group-sm">
              <label for="no_caso">No. Caso</label>
              <input type="text" class="form-control text-uppercase" id="no_caso" placeholder="Ingrese No. Caso" required name="no_caso">
            </div>
            <div class="form-group col-md-3 input-group-sm">
              <label for="no_carpeta">No. Carpeta</label>
              <input type="text" class="form-control text-uppercase" id="no_carpeta" placeholder="Ingrese No. Carpeta" required name="no_carpeta">
            </div>
            <div class="form-group col-md-3 input-group-sm">
              <label for="carpeta">Carpeta</label>
              <input type="text" class="form-control text-uppercase" id="carpeta" placeholder="Ingrese Carpeta" required name="carpeta">
            </div>
          </div>

        <div class="form-row">
          <div class="form-group col-md-12 input-group-sm">
            <label for="asunto">Origen Remitente</label>
            <input type="text" class="form-control text-uppercase" id="asunto" placeholder="Ingrese Origen Remitente" required name="asunto">
          </div>
        </div>
                     
          
        <div class="form-row">
            <div class="form-group col-md-12">
                <legend class="col-form-label"><h3>Investigacíon derivada de</h3></legend>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required value="1" type="radio" name="relevante" id="relevante1" >
                  <label class="form-check-label" for="relevante1">Queja ciudadana</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" required value="0" type="radio" name="relevante" id="relevante2" >
                  <label class="form-check-label" for="relevante2">Expediente</label>
              </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
          <label for="exampleFormControlTextarea1">Antecedenta para tarjeta informativa</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Ingresa Antecedente" required rows="3"></textarea>
        </div>  
     </div>     
          <div class="form-row">            
              <div class="form-group col-md-4 input-group-sm">
              <label for="oficio_1">Oficio girado 1</label>
              <input type="text" class="form-control text-uppercase" readonly="" id="oficio_1" placeholder="Oficio girado 1" required name="oficio_1">
            </div><div class="form-row">
        
      </div>  

             <div class="form-group col-md-4 input-group-sm">
              <label for="oficio_2">Oficio girado 2</label>
              <input type="text" class="form-control text-uppercase" readonly="" id="oficio_2" placeholder="Oficio girado 2" required name="oficio_2">
            </div>
            <div class="form-group col-md-4 input-group-sm">
              <label for="oficio_3">Oficio Girado 3</label>
              <input type="text" class="form-control text-uppercase" readonly="" id="oficio_3" placeholder="Oficio girado 3" required name="oficio_3">
            </div>
            
          </div>

        <div class="form-row">
          <div class="form-group col-md-4 input-group-sm">
            <label for="of_contestacion">Oficio de contestación</label>
            <input type="text" class="form-control text-uppercase" readonly="" id="of_contestacion" placeholder="Oficio de contestación" required name="of_contestacion">
          </div>
          <div class="form-group col-md-4 input-group-sm">
            <label for="materno">Imagenes escaneadas</label>
            <input type="text" class="form-control text-uppercase" readonly="" id="materno" placeholder="" required name="materno">
          </div>
          <div class="form-group col-md-4 ">
          <label for="fecha_tarjeta">Fecha de Tarjeta Informativa</label>
            <div class="input-group input-group-sm date" id="fecha_tarjeta" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha_tarjeta" required name="fecha_tarjeta"/>
                <div class="input-group-append" data-target="#fecha_tarjeta" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
           
        </div>

<div class="form-row">
        <div class="form-group col-md-12">
          <label for="detalle_tarjeta">Detallar Investigación Realizada para reporte de Tarjeta Informativa</label>
          <textarea class="form-control" id="detalle_tarjeta" placeholder="Ingresa DEtalles de la Investigación" required rows="3"></textarea>
        </div>
      </div>  


    <div class="form-row">
        <div class="form-group col-md-12">
          <label for="observaciones">Observaciones adicionales</label>
          <textarea class="form-control" id="observaciones" placeholder="Ingresa Observaciones" required rows="3"></textarea>
        </div>
    </div>

     <div class="form-row">
        <div class="form-group col-md-12">
          <label for="acciones">Acciones</label>
          <textarea class="form-control" id="acciones" placeholder="Ingresa Acciones" required rows="3"></textarea>
        </div>
    </div>

     <div class="form-row">
        <div class="form-group col-md-12">
          <label for="observaciones">Desgloce de Actividades para Reporte</label>
          <textarea class="form-control" id="observaciones" placeholder="Ingresa DEsgloce de Actividades" required rows="3"></textarea>
        </div>
    </div>

     <div class="form-row">
        <div class="form-group col-md-12">
          <label for="observaciones">Historial de actividades</label>
          <textarea readonly="" class="form-control" id="observaciones" rows="3"></textarea>
        </div>
    </div>  
        
      <div class="form-row">
        <div class="form-group col-md-3 input-group-sm">
          <button type="submit" class="btn btn-success btn-sm btn-block" id="submit">ENVIAR</button>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <input type="button" class="btn btn-warning btn-sm btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>visitas'"></input>
        </div>
        
      </div>
      <div class="form-row">
        <div class="form-group col-md-12 input-group-sm">
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