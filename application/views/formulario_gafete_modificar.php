<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open(base_url() . 'gafetes/actualizar_gafete/'.$gafete->Id, $atributos) ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos del funcionario</h2>
          </div>
          <div class="form-group col-md-4">
            </div>
          <div class="form-group col-md-4">     
          </div>
        </div>
          <div class="form-group">
            <label for="edificio">Edificio</label>
            <input type="text" class="form-control text-uppercase" id="edificio" placeholder="Ingrese edificio" required name="edificio" value="<?php echo $gafete->edificio?>">
         
          <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" class="form-control text-uppercase" id="numero" placeholder="Ingrese numero" required name="numero" value="<?php echo $gafete->numero?>">
          </div>
          <div class="form-group">
            <label for="puerta">Puerta</label>
            <input type="text" class="form-control text-uppercase" id="puerta" placeholder="Ingrese puerta" required name="puerta" value="<?php echo $gafete->puerta?>">
          </div>
        <div class="form-group">
          <label for="disponible">Disponible</label>
            <select id="disponible" class="form-control" required name="disponible">
              <option value="">SELECCIONA UN ESTATUS</option>
                <?php 

                  if($gafete->disponible == 'SI')  {

                     echo  '<option selected value="SI"> SI</option>';
                     echo  '<option  value="NO"> NO</option>';

                  }elseif($gafete->disponible == 'NO'){
                      echo  '<option  value="SI"> SI</option>';
                     echo   '<option selected value="NO"> NO</option>';  
                  }

                ?>
               
            </select>

        </div>
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>gafetes'"></input>
        </div>
         <div class="form-group col-md-3">
           <!-- <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" onclick="location.href='<?php echo base_url();?>visitas/visita_eliminar/<?php echo $visita->Id;?>'"></input>-->
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#eliminargafeteModal"></input>

        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <?php echo validation_errors(); ?>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>


<div class="modal fade" id="eliminargafeteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar el gafete <?php echo $gafete->gafete?>?</h5>
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
    var Id = "<?php echo $gafete->Id?>";  

      $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>gafetes/gafete_eliminar/"+Id,
              type : "post",
              success : function(response){
                //var typeData = {broadType : 'usuario', data : true};
                //conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>gafetes";
                }
            })
        });

  });

</script>
</html>