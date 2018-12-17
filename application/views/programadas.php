<!doctype html>
<html lang="en">
<head>
</head>

<body>
  <div class="container">
    
      <form>

      <br />
        <div class="form-row">
          <div class="form-group  col-md-4">
               <h1 class="page-header text-align='center' "><?php echo $programada ?></h1> 
          </div>
          <div class="form-group col-md-4">
               
          </div>
          
          <div class="form-group col-md-4">
               <a  href="<?php echo base_url('programadas/nueva_programada'); ?>" class="btn btn-success btn-lg justify-content-end btn-block"><?php echo $btn_nuevo ?></a>
          </div>
        </div>
        
      </form>
      <div class="table-responsive">
        <table class="table table-striped table-bordered nowrap" id="lista_programadas">
          <thead>
            <tr>                 
              <th>Id</th>
              <th>Nombre Visitante</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Procedencia</th>
              <th>Motivio visita</th>
              <th>A quién visita</th>
              <th>Fecha entrada</th>
              <th>Teléfono</th>
              <th>Estatus</th>
              <th>Observaciones</th>
              <th>Relevante</th>


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

    
crearTablaProgramada();

    var Id = 0;
    $('#lista_programadas tbody').on( 'dblclick', 'tr', function () {
        Id = $('td', this).eq(0).text();


        if(!isNaN(Id)){
            if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected'); 
            obtener_id_tabla(Id);
        }
        else {
            
            $('#lista_programadas').DataTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            obtener_id_tabla(Id);
        }

        }
        
    } );

    function obtener_id_tabla(Idaux){
      location.href = "<?php echo site_url('programadas/modificar_programada/"+ Idaux +"') ?>";
    }
});

function crearTablaProgramada(){
  var tabla  = $('#lista_programadas').DataTable({
      "lengthChange": false,
                   "buttons": [
                      {
                          "text": 'Cargar tabla',
                          action: function ( e, dt, node, config ) {
                              tabla.clear().destroy();
                              crearTablaProgramada();
                          }
                      }
                  ],
      initComplete : function () {
              tabla.buttons().container().appendTo( $('#lista_programadas_wrapper .col-sm-12:eq(0)'));
               },
       "processing": true,
        "serverSide": true,
        "ajax": {
            url : "<?php echo site_url("programadas/programadas_page") ?>",
            dataType: "json",
            type: "POST",

        },
        "responsive" : true,
        "language" : {url: 'http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'},
        
      "order": [[ 0, "desc" ]],
      "columns": [
            { "data": "Id"},
            { "data": "nombre"},
            { "data": "apellido_pat"},
            { "data": "apellido_mat"},
            { "data": "procedencia"},
            { "data": "motivo"},
            { "data": "a_quien_visita"},
            { "data": "fecha_ingreso",
              render: function(d){
                return moment(d).format("DD/MM/YYYY HH:mm");
              }
            },
         
            { "data": "telefono"},
            { "data": "status"}, 
            { "data": "observaciones"},
            { "data": "relevante",

            render: function(r){
                if(r =='1'){
                  return 'SI';
                }else{
                   return 'NO';
                }
               
              }
          },   


         ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
     
        switch(aData['status']){
          case  'PROGRAMADA': $(nRow).css('background', '#007bff');  $(nRow).css('color', 'white'); break;
          case 'CANCELADO':  $(nRow).css('background', '#ffab91'); break;
          

          //case 'EN VISITA':  $(nRow).css('background', '#78909c'); $(nRow).css('color', 'white'); break;
          
        }
        switch(aData['relevante']){
          //case '1': $(nRow).css('background', '#FF5733');  $(nRow).css('color', 'white'); break;
          case '1': $(nRow).find('td:eq(0)').css('background', '#DF4015'); $(nRow).find('td:eq(0)').css('color', 'white'); break;
          
        }
        return nRow;
      },         

    });
}

</script>

<script type="text/javascript">

var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);

</script>


  </html>