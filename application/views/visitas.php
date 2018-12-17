<div class="container">
  <div class="table-responsive">
  <br />
        <form>
          <div class="form-row">
            <div class="form-group  col-md-4">
                 <h1 class="page-header text-align='center' "><?php echo $visita ?></h1> 
            </div>
           
            <div class="form-group col-md-4">
                 
            </div>
            <div class="form-group col-md-4">
                 <a  href="<?php echo base_url('investigaciones/nuevo_registro'); ?>" class="btn btn-success btn-lg justify-content-end btn-block"><?php echo $btn_nuevo ?></a>
            </div>
          </div>

          <div class="form-row">

          <div class="form-group col-md-3">
            <p>Búsqueda por rango de fechas </p>
          </div>
           <div class="form-group col-md-3">
               
              <div class="input-group date" id="fecha_inicial" data-target-input="nearest" >
                <input type="text" class="form-control datetimepicker-input" id="fecha_inicial_input" data-target="#fecha_inicial" required name="fecha_inicial"/>
                  <div class="input-group-append" data-target="#fecha_inicial" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
   
            </div>

            <div class="form-group col-md-3">
               
              <div class="input-group date" id="fecha_final" data-target-input="nearest" >
                <input type="text" class="form-control datetimepicker-input" id="fecha_final_input"  data-target="#fecha_final" required name="fecha_final"/>
                  <div class="input-group-append" data-target="#fecha_final" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
   
            </div>
            <div class="form-group col-md-3">
                 <button type="submit"  id="btn_buscar_fechas"   class="btn btn-primary justify-content-end btn-block">BUSCAR FECHA</button>
            </div>
          </div>
        </form>
        
          <table class="table table-striped table-hover table-bordered nowrap" id="lista_visitas">
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
                <th>Fecha salida</th>
                <th>Gafete</th>
                <th>Estatus</th>
                <th>Vehículo Placa</th>
                <th>Vehículo Marca</th>
                <th>Vehículo Modelo</th>
                <th>Vehículo Tipo</th>
                <th>Relevante</th>
                <th>Opciones</th>

              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
    </div>

</div>  
<br /> <br />
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

<!-- Modal -->
<div class="modal fade" id="ingresarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Deseas ingresar un nuevo registro de visita?</h5>

        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Corrobora los datos antes de ingresar</p>
      </div>
      <div class="modal-footer">
      <button type="button" id="si_ingresar_visita" class="btn btn-primary">Si</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->



<form action="<?php echo base_url('investigaciones/nueva_visita_reingreso'); ?>" method=post name="formulario1"> 
<input id = "nombre" type="hidden" name="nombre" > 
<input id = "ap" type="hidden" name="ap" > 
</form>

<script>
$(document).ready(function() {

  var visitante;
  var visitante_programada;
  var conn = new Connection2(Broadcast.BROADCAST_URL+":"+Broadcast.BROADCAST_PORT);
//$('#lista_programadas').wrap('<div id="hide" style="display:none"/>');
    

 crearTablaVisitas();

$('#lista_visitas tbody').on( 'click', '#btn_reingresar', function () {
        var data = $('#lista_visitas').row( $(this).parents('tr') ).data();
        alert( 'es para reingresar' );
    });

/*--------------INICIA: SELECCINAR UN REGISTRO CON DOBLE CLICK--------------------*/
    var Id = 0;
    $('#lista_visitas tbody').on( 'dblclick', 'tr', function () {
        Id = $('td', this).eq(0).text();

        if(!isNaN(Id)){
            if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected'); 
              obtener_id_tabla(Id);
            }
            else {  
              $('#lista_visitas').DataTable.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              obtener_id_tabla(Id);
            }
        }        
    } );

    function obtener_id_tabla(Idaux){
      location.href = "<?php echo site_url('investigaciones/modificar_visita/"+ Idaux +"') ?>";
    }
/*--------------FIN: SELECCINAR UN REGISTRO CON DOBLE CLICK--------------------*/
});

/*--------------INICIA: BOTON CONFIRMAR INGRESAR PROGRAMADA COMO VISITA--------------------*/
  $('#si_ingresar_visita').click(function(e){
              let id_reingreso = visitante_programada['id_reingreso_programada'];

              if(!isNaN(id_reingreso)){
                location.href = "<?php echo site_url('visitas/programada_visita/"+ id_reingreso +"') ?>";
              }else{
                alert('¡Error al intentar instertar nuevo registro!');
              }      
        });
/*--------------FIN: BOTON CONFIRMAR INGRESAR PROGRAMADA COMO VISITA--------------------*/

/*--------------INICIA: BOTON CONFIRMAR RE-INGRESAR PROGRAMADA COMO VISITA--------------------*/
  $('#si_reingresar').click(function(e){
              let id_reingreso = visitante['id_reingreso'];

              if(!isNaN(id_reingreso)){
                location.href = "<?php echo site_url('visitas/nueva_visita_reingreso/"+ id_reingreso +"') ?>";
              }else{
                alert('¡Error al intentar instertar nuevo registro!');
              }     
        });



  
function crearTablaVisitas(){
          var tabla  = $('#lista_visitas').DataTable({
                  "lengthChange": false,
                   "buttons": [
                      {
                          "text": 'Cargar tabla',
                          action: function ( e, dt, node, config ) {
                              tabla.clear().destroy();
                              crearTablaVisitas();
                          }
                      }
                  ],
                  
                 "processing": true,
                  "serverSide": true,
                  initComplete : function () {
                          tabla.buttons().container().appendTo( $('#lista_visitas_wrapper .col-sm-12:eq(0)'));
                           },

                  "ajax": {
                      url : "<?php echo site_url("investigaciones/visitas_page") ?>",
                      dataType: "json",
                      type: "POST",

                        },
                  "responsive" : true,
                  "language" : {url: "<?php echo base_url('assets/js/Spanish.json'); ?>"},
                  
                "order": [[ 0, "desc" ]],
                "columns": [
                      { "data": "Id"},
                      { "data": "nombre_visitante"},
                      { "data": "apellido_pat_visitante"},
                      { "data": "apellido_mat_visitante"},
                      { "data": "procedencia"},
                      { "data": "motivo_visita"},
                      { "data": "a_quien_visita"},
                      { "data": "fecha_ingreso",

                        render: function(d){
                          return moment(d).format("DD/MM/YYYY HH:mm:ss");
                        }
                      },
                      { "data": "fecha_egreso",
                        render: function(d){
                          if(moment(d).isValid()){
                            return moment(d).format("DD/MM/YYYY HH:mm:ss");
                          }else{
                             return 'Sin fecha';
                          }
                         
                        }
                      },
                      { "data": "gafete"},
                      { "data": "status"},
                      { "data": "vehiculo_placa"},
                      { "data": "vehiculo_marca"},
                      { "data": "vehiculo_modelo"},
                      { "data": "vehiculo_tipo"},
                      { "data": "relevante",
                      render: function(r){
                          if(r =='1'){
                            return 'SI';
                          }else{
                             return 'NO';
                          }
                         
                        }
                      }, 
                      {
                        data: null,
                        render: function ( data, type, row ) {
                           
                            visitante = {
                                id_reingreso: data['Id']
                               
                            };  
                            if(data['status'] == 'ENTREGÓ GAFETE'){
                              return '<input type="button" class="btn btn-primary" value="REINGRESO" id="reingreso" data-toggle="modal" data-target="#reingresoModal"></input>';                  
                            }else
                              return 'S/N';
                      }
                    }
                   ],
                  "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
               
                  switch(aData['status']){
                    case 'REGISTRO': $(nRow).css('background', '#00C851');  $(nRow).css('color', 'white'); break;
                    case 'ENTRÓ AL EDIFICIO':  $(nRow).css('background', '#ffbb33'); break;
                    case 'ENTRÓ A 3ER PISO':  $(nRow).css('background', '#4285F4'); $(nRow).css('color', 'white'); break;
                    
                  }

                  switch(aData['relevante']){
                    //case '1': $(nRow).css('background', '#FF5733');  $(nRow).css('color', 'white'); break;
                    case '1': $(nRow).find('td:eq(0)').css('background', '#DF4015'); $(nRow).find('td:eq(0)').css('color', 'white'); break;
                  }
                  return nRow;
                },         

              });
    }
    



   $('#btn_buscar_fechas').click(function(e){

        e.preventDefault();
         if(document.getElementById("fecha_inicial_input").value == '' && document.getElementById("fecha_final_input").value == '')
            {
              alert('fechas vacias');
        }else{
              
              $('#lista_visitas').DataTable().clear().destroy();



    var tabla_fechas =   $('#lista_visitas').DataTable({
        "lengthChange": false,
        initComplete : function () {
                tabla_fechas.buttons().container().appendTo( $('#lista_visitas_wrapper .col-sm-12:eq(0)'));
        },
        "buttons": [
            {
                "text": 'Cargar tabla',
                action: function ( e, dt, node, config ) {
                    $('#lista_visitas').DataTable().clear().destroy();
                    crearTablaVisitas();
                }
            }
        ],
       "processing": true,
        "serverSide": true,
        "ajax": {
            "url" : "<?php echo site_url("visitas/visitas_page") ?>",
            "data": function( datos ) {
                  datos.fecha_inicial = $('#fecha_inicial_input').val();
                  datos.fecha_final = $('#fecha_final_input').val();
            },
            "dataType": "json",
            "type": "POST",

        },
        "responsive" : true,
        "language" : {url: "<?php echo base_url('assets/js/Spanish.json'); ?>"},
        
      "order": [[ 0, "desc" ]],
      "columns": [
            { "data": "Id"},
            { "data": "nombre_visitante"},
            { "data": "apellido_pat_visitante"},
            { "data": "apellido_mat_visitante"},
            { "data": "procedencia"},
            { "data": "motivo_visita"},
            { "data": "a_quien_visita"},
            { "data": "fecha_ingreso",

              render: function(d){
                return moment(d).format("DD/MM/YYYY HH:mm");
              }
            },
            { "data": "fecha_egreso",
              render: function(d){
                if(moment(d).isValid()){
                  return moment(d).format("DD/MM/YYYY HH:mm");
                }else{
                   return 'Sin fecha';
                }
               
              }
            },
            { "data": "gafete"},
            { "data": "status"},
            { "data": "vehiculo_placa"},
            { "data": "vehiculo_marca"},
            { "data": "vehiculo_modelo"},
            { "data": "vehiculo_tipo"},
            { "data": "relevante",
            render: function(r){
                if(r =='1'){
                  return 'SI';
                }else{
                   return 'NO';
                }
               
              }
            },
            {
              data: null,
              render: function ( data, type, row ) {
                 
                  visitante = {
                      id_reingreso: data['Id']
                      
                  };  
                  if(data['status'] == 'ENTREGÓ GAFETE'){
                    return '<input type="button" class="btn btn-primary" value="REINGRESO" id="reingreso" data-toggle="modal" data-target="#reingresoModal"></input>';                  
                  }else
                    return 'S/N';
            }
          }
         ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
     
        switch(aData['status']){
          case 'REGISTRO': $(nRow).css('background', '#00C851');  $(nRow).css('color', 'white'); break;
          case 'ENTRÓ AL EDIFICIO':  $(nRow).css('background', '#ffbb33'); break;
          case 'ENTRÓ A 3ER PISO':  $(nRow).css('background', '#4285F4'); $(nRow).css('color', 'white'); break;
          
        }

        switch(aData['relevante']){
          //case '1': $(nRow).css('background', '#FF5733');  $(nRow).css('color', 'white'); break;
          case '1': $(nRow).find('td:eq(0)').css('background', '#DF4015'); $(nRow).find('td:eq(0)').css('color', 'white'); break;
          
        }
        
        return nRow;
      },         

    });
              
            }
    });



 $(function () {
           var today = new Date(
                      new Date().getFullYear(),
                      new Date().getMonth(),  
                      new Date().getDate(), 
                      );
                today.setHours(23);
                today.setMinutes(59);
                today.setSeconds(59);


                var f_inicial = $('#fecha_inicial').datetimepicker({
                  locale: 'es',
                  format:'DD/MM/YYYY HH:mm:ss',
                  maxDate : today,
                  autoclose: true
                });

               var f_final =  $('#fecha_final').datetimepicker({
                    locale: 'es',
                    format:'DD/MM/YYYY HH:mm:ss',
                    //date: fecha_inicial,
                    maxDate : today,  
                    autoclose: true                
                });
                
                
               let f_i;


              

                $('#fecha_inicial').on("change.datetimepicker", function (e) {
                 f_i = document.getElementById("fecha_inicial_input").value;
                
                                          //fecha_inicial = moment(f_i);
                                          
                                          //alert(fecha_inicial.format('DD/MM/YYYY HH:mm:ss'));
                                              
                                             // if(document.getElementById("fecha_inicial_input").value == fecha_inicial.format('DD/MM/YYYY HH:mm:ss')){
                                                  //alert('si es igual');
                                             // }
                                             //alert(document.getElementById("fecha_inicial_input").value);
                                             //alert(fecha_inicial.format('DD/MM/YYYY HH:mm:ss'));
                     

                   //$('#fecha_final').datetimepicker('date',moment(f_i, "DD/MM/YYYY HH:mm:ss") );
                   //$('#fecha_final').datetimepicker('maxDate',today );
                   $('#fecha_final').datetimepicker('minDate',moment(f_i, "DD/MM/YYYY HH:mm:ss") );
                  
                    /*if(f_i != document.getElementById("fecha_final_input").value){
                      $('#fecha_final').datetimepicker('date',moment(f_i, "DD/MM/YYYY HH:mm:ss") );
                     }*/
                    
                     });
                
                                       /* $('#fecha_final').on("change.datetimepicker", function (e) {
                                             f_f = $('#fecha_final').datetimepicker('viewDate');
                                              fecha_final = moment(f_f);
                                                if(document.getElementById("fecha_inicial_input").value > fecha_final){
                                                    alert('es mayor fecha inicial');
                                                }
                                        });*/
                
            });

</script>



  