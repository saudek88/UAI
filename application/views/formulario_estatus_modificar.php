<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open(base_url() . 'estatus/actualizar_estatus/'. $estatus -> Id, $atributos) ?>
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
            <input type="text" class="form-control text-uppercase" id="estatus" placeholder="Ingrese estatus" required name="estatus" value="<?php echo $estatus->status ?>">
        <div class="form-group">
          <label for="tipo">Tipo</label>
            <select id="tipo" class="form-control" required name="tipo">

              <option value="">SELECCIONA UN TIPO</option>
              <?php 

                  if($estatus-> tipo == 1){
                    echo '<option selected value="1">VISITAS</option>;';
                    echo '<option value="0">PROGRAMADAS</option>';

                  }elseif($estatus-> tipo == 0) {
                    echo '<option  value="1">VISITAS</option>;';
                    echo '<option selected value="0">PROGRAMADAS</option>';
                  }
              ?>
               
            </select>

        </div>
        
    
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>estatus'"></input>
        </div>
        <div class="form-group col-md-3">
           <?php if($estatus->status == 'REGISTRO' || $estatus->status == 'ENTREGÓ GAFETE'){ ?>
            
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#eliminarstatusModal" disabled></input>
            <?php }else{ ?>
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#eliminarstatusModal"></input>

            <?php }  ?>

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
<div class="modal fade" id="eliminarstatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar el estatus <?php echo $estatus->status?>?</h5>
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
    var Id = "<?php echo $estatus->Id?>";  

      $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>estatus/estatus_eliminar/"+Id,
              type : "post",
              success : function(response){
                //var typeData = {broadType : 'usuario', data : true};
                //conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>estatus";
                }
            })
        });

     // var status = '<?php echo $estatus->status?>';
     // if(status == 'REGISTRO' || status == 'ENTREGÓ GAFETE'){
      //  document.getElementById("eliminar").setAttribute("disabled", true);
     // }


  });



</script>
 
</html>