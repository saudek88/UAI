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
               <h1 class="page-header text-align='center' "><?php echo $general ?></h1> 
          </div>
          <div class="form-group col-md-4">
               
          </div>
        </div>
        
      </form>
   <div class="table-responsive">
        <table class="table table-striped table-hover" id="lista_general">
          <thead>
            <tr>                 
              <th>Id</th>
              <th>Descripcion</th>
              <th>Cargo</th>
              <th>Imagen</th>
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
    var tabla  = $('#lista_general').DataTable({
       "processing": true,
        "serverSide": true,
        "ajax": {
            url : "<?php echo site_url("general/general_page") ?>",
            dataType: "json",
            type: "POST",

        },
        "responsive" : true,
        "language" : {url: 'http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'},
        "columns": [
              { "data": "Id"},
              { "data": "DESCRIPCION"},
              { "data": "CARGO"},
              { "data": "IMAGEN", render: function ( data, type, row ) {
                      if( Object.keys(data).length !== 0){
                        return '<img class="img-thumbnail" alt="Responsive image" src="data:image/jpeg;base64,'+ data + '" width="50px" height="50px">';
                      }
                      else{
                        return "Sin imagen";
                      }
                    }
                  }
           ]         

    });


    var Id = 0;
    $('#lista_general tbody').on( 'dblclick', 'tr', function () {
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
      location.href = "<?php echo site_url('general/modificar_general/"+ Idaux +"') ?>";
    }
});
</script>

  </html>