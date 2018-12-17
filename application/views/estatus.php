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
               <h1 class="page-header text-align='center' "><?php echo $estatus ?></h1> 
          </div>
          <div class="form-group col-md-4">
               
          </div>
          
          <div class="form-group col-md-4">
               <a  href="<?php echo base_url('estatus/nuevo_estatus'); ?>" class="btn btn-success btn-lg justify-content-end btn-block"><?php echo $btn_nuevo ?></a>
          </div>
        </div>
        
      </form>
   <div class="table-responsive">
        <table class="table table-striped table-hover" id="lista_estatus">
          <thead>
            <tr>                 
              <th>Id</th>
              <th>Estatus</th>
              <th>Tipo</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
        
      </div>
  </div>   
</body> 
<script type="text/javascript">
$(document).ready(function() {
    var tabla  = $('#lista_estatus').DataTable({
        "ajax": {
            url : "<?php echo site_url("estatus/estatus_page") ?>",
            type : 'GET'

        },
        'responsive' : true,
        "language" : {
            url: 'http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
        }
    });


    var Id = 0;
    $('#lista_estatus tbody').on( 'dblclick', 'tr', function () {
        Id = $('td', this).eq(0).text();

        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            
            obtener_id_tabla(Id);
        }
        else {
            
            tabla.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            obtener_id_tabla(Id);
        }
    } );

    function obtener_id_tabla(Idaux){
      location.href = "<?php echo site_url('estatus/modificar_estatus/"+ Idaux +"') ?>";
    }
});
</script>

  </html>