<!doctype html>
<html lang="en">
<head>
</head>

<body>
<br />
  <div class="container">
  <form class="was-validated" id="formulario_ajax_fun" >
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
            <label for="nombre">Nombre Funcionario</label>
            <input type="text" class="form-control text-uppercase" id="nombre" placeholder="Ingrese nombre funcionario" required name="nombre" value="<?php echo $funcionario->nombre?>">
         
          <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control text-uppercase" id="cargo" placeholder="Ingrese cargo" required name="cargo" value="<?php echo $funcionario->cargo?>">
          </div>
          <div class="form-group">
            <label for="dependencia">Dependencia</label>
            <input type="text" class="form-control text-uppercase" id="dependencia" placeholder="Ingrese dependencia" required name="dependencia" value="<?php echo $funcionario->dependencia?>">
          </div>
        <div class="form-group">
            <label for="area">Área</label>
            <input type="text" class="form-control text-uppercase" id="area" placeholder="Ingrese área" required name="area" value="<?php echo $funcionario->area?>">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control text-uppercase" id="telefono" placeholder="Ingrese teléfono" name="telefono" value="<?php echo $funcionario->telefono_celular?>">
        </div>
    
      
      <div class="form-row">
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
        </div>
        <div class="form-group col-md-3">
            <input type="button" class="btn btn-warning btn-lg btn-block" value="CANCELAR" onclick="location.href='<?php echo base_url();?>funcionarios'"></input>
        </div>
         <div class="form-group col-md-3">
           <!-- <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" onclick="location.href='<?php echo base_url();?>visitas/visita_eliminar/<?php echo $visita->Id;?>'"></input>-->
            <input type="button" class="btn btn-danger btn-lg btn-block" value="ELIMINAR" id="eliminar" data-toggle="modal" data-target="#exampleModal"></input>

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
</body>
 <script type="text/javascript">
var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT); 
    $(document).ready(function() {
      var Id = "<?php echo $funcionario->Id?>";
        $('#si_eliminar').click(function(e){
              e.preventDefault();
             $.ajax({
              url : "<?php echo base_url()?>funcionarios/funcionario_eliminar/"+Id,
              type : "post",
              success : function(response){
                var typeData = { broadType : 'funcionarios', data : true};
                conn.sendMsg(typeData); 
                location.href = "<?php echo base_url();?>funcionarios";
                }
            })
        });


        $("#formulario_ajax_fun").submit(function(e){
        e.preventDefault();
        $.ajax({
          url: "<?php echo base_url()?>funcionarios/actualizar_funcionario/"+Id,
          type: "post",
          data: $(this).serialize(),
          success:function(response){
              var typeData = {broadType : 'funcionarios', data : true};
              conn.sendMsg(typeData); 
              location.href = "<?php echo base_url();?>funcionarios";
            }
        });
    });
  });
 </script>
</html>