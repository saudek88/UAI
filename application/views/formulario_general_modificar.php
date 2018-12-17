<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <?php $atributos = array('class' => 'was-validated');
         echo form_open_multipart(base_url() . 'general/actualizar_general/'.$general->Id, $atributos) ?>
        <div class="form-row">
          <div class="form-group col-md-4">
            <h2>Datos Genarales</h2>
          </div>
          <div class="form-group col-md-4">
            </div>
          <div class="form-group col-md-4">     
          </div>
        </div>
          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" class="form-control text-uppercase" id="descripcion" placeholder="Ingrese descripcion" name="descripcion" value="<?php echo $general->DESCRIPCION?>">
         </div>
          <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control text-uppercase" id="cargo" placeholder="Ingrese cargo" required name="cargo" value="<?php echo $general->CARGO?>">
          </div>
          
        <div class="form-row">
          <div class="form-group col-md-4">
           <label for="imagen">Imagen</label>
          <input type="file" class="form-control-file" id="imagen" name="imagen">
          </div>
         <div class="form-group col-md-4">
            <?php
                if(!empty($general->IMAGEN)){

                  
                    echo '<img class="img-thumbnail" alt="Responsive image" src="data:image/jpeg;base64,'.base64_encode( $general->IMAGEN ).'" width="150px" height="150px"/>'; 
                  
                     
                }else{
                  echo "No hay imagen que mostrar.";
                }
            ?>
            
         </div>
        </div>
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>general'"></input>
        </div>
        <div class="form-group col-md-3">    
            <!--<input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#eliminargeneralModal"></input>-->
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
<div class="modal fade" id="eliminargeneralModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas eliminar el campo general <?php echo $general->DESCRIPCION?>?</h5>
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
    var Id = "<?php echo $general->Id?>";  

      $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>general/general_eliminar/"+Id,
              type : "post",
              success : function(response){
                //var typeData = {broadType : 'usuario', data : true};
                //conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>general";
                }
            })
        });

  });



</script>
</html>