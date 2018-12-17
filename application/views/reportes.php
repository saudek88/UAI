<!doctype html>
<html lang="en">
<head>
</head>

<body>
  <div class="container">
    <div class="col-md-12">
      <form>

<br />
        <div class="form-row">
          <div class="form-group  col-md-4">
               <h1 class="page-header text-align='center' "><?php echo $vista ?></h1> 
          </div>
          <div class="form-group col-md-4">
               
          </div>
          
          <div class="form-group col-md-4">
               <a  href="<?php echo base_url('reportes/generate_pdf'); ?>" class="btn btn-success btn-lg justify-content-end btn-block" target="_blank"><?php echo $btn_nuevo ?></a>
          </div>
        </div>
        
      </form>
   <div class="table-responsive">
        <table class="table table-striped table-hover" id="lista_funcionarios">
          <thead>
            <tr>                 
              <th>Id</th>
              <th>Nombre</th>
              <th>Cargo</th>
              <th>Dependencia</th>
              <th>Área</th>
              <th>Teléfono</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
        
      </div>
  </div>   
</body> 
<script type="text/javascript">
var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);
$(document).ready(function() {
    var tabla  = $('#lista_funcionarios').DataTable({
        "ajax": {
            url : "<?php echo site_url("funcionarios/funcionarios_page") ?>",
            type : 'GET'

        },
        'responsive' : true,
        "language" : {
            url: 'http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        }
    });


    var Id = 0;
    $('#lista_funcionarios tbody').on( 'dblclick', 'tr', function () {
        Id = $('td', this).eq(0).text();
        if(!isNaN(Id)){
             if ( $(this).hasClass('selected') ) {
                  $(this).removeClass('selected');    
                     obtener_id_tabla(Id);
            }else{   
                  tabla.$('tr.selected').removeClass('selected');
                  $(this).addClass('selected');
                  obtener_id_tabla(Id);
            }
        }
       
    } );

    function obtener_id_tabla(Idaux){
      location.href = "<?php echo site_url('funcionarios/modificar_funcionario/"+ Idaux +"') ?>";
    }
});
</script>

  </html>