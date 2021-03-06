@extends('layouts.adminlte')
@section('css')
<!-- Toastr -->
<link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- FlexDataList -->
<link rel="stylesheet" href="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('js/daterangepicker-master')}}/daterangepicker.css" />
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif
<div class="row">
	<div class="col-xs-12">
		<div class="box">
            <div class="box-header">
             	<h3 class="box-title">Registros de entrada y salida en el Sistema</h3>
             	<div class="pull-right">
                <button class="btn btn-default" id="botonLibroAsistencias" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-user"></i> <strong>Generar Documento Asistencias</strong></button>
             		<button class="btn btn-primary" id="botonActualizar" ><i class="fa fa-refresh"></i> <strong>Actualizar</strong></button>
             		<button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" ><i class="fa fa-plus"></i> Registrar manualmente</button>
             	</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!--<th style="width:90px">Opciones</th>-->
                  <th>Entrada/Salida</th>
                  <th>Hora</th>
                  <th>Nombre Empleado</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
         </div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Registro de Hora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" id="formulario" method="POST" action="{{url('/registros_horas')}}">
      		@csrf
            <div class="box-body">
            	<div class="row">
                	<div class="col-lg-6">
		                <div class="input-group">
	                        <label >Empleado:</label><label><p style="color:red">*</p></label>
                  			<div class="input-group ">
			                  <div class="input-group-addon">
			                    <i class="fa fa-user"></i>
			                  </div>
			                  <input type="text" id="inputBusqueda" required name="empleado"class="form-control" placeholder="Ingrese un nombre o apellido">
			                </div>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="input-group">
	                        <label >Tipo:</label><label><p style="color:red">*</p></label>
                  			<div class="input-group ">
			                  <div class="input-group-addon">
			                    <i class="fa fa-exchange"></i>
			                  </div>
			                  <select class="form-control" required name="tipo">
			                  	<option>ENTRADA</option>
			                  	<option>SALIDA</option>
			                  </select>
			                </div>
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="row">
                	<div class="col-lg-6">
		                <div class="input-group">
	                        <label >Fecha:</label><label><p style="color:red">*</p></label>
                  			<div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" name="fecha" id="datepicker1" required>
			                </div>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="input-group bootstrap-timepicker">
	                        <label >Hora:</label><label><p style="color:red">*</p></label>
                  			<div class="input-group ">
			                  <div class="input-group-addon">
			                    <i class="fa fa-clock-o"></i>
			                  </div>
			                  <input type="text" name="hora" id="timepicker" required class="form-control timepicker">
			                </div>
		                </div>
		            </div>
		        </div>
		        <br>
                
		        <br>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit"  form="formulario" class="btn btn-success">Agregar</button>
        (<label><p style="color:red">*</p></label>) Campo obligatorio
      </div>
    </div>
  </div>
</div>
<!-- Modal 2 (Asistencias) -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Complete los siguientes campos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" >
          
            <div class="box-body">
              <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                          <label >Periodo:</label><label><p style="color:red">*</p></label>
                        <div class="input-group ">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" id="inputPeriodo" >
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="input-group">
                          <label >Empleado:</label><label><p style="color:red">*</p></label>
                        <div class="input-group ">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input type="text" id="inputBusqueda2" >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
        <button type="button" id="botonGenerarLibroAsistencias" class="btn btn-primary">Generar</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<!-- Toastr -->
<script src="{{asset('js/toastr-master/build')}}/toastr.min.js"></script>
<!-- DataTables -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="{{asset('templates/AdminLTE-master')}}/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- FlexDataList -->
<script src="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.js"></script>
<script type="text/javascript" src="{{asset('js/daterangepicker-master')}}/daterangepicker.js"></script>
<script>

$(document).ready(function(){
	$('#inputBusqueda').flexdatalist({
		requestType: 'GET',
		data: "{{url('/data/empleados/lista')}}",
		params: {
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		},
		minLength: 1,
		selectionRequired: true,
		searchByWord: true,
		searchIn: ['nombre','apellido_pat','apellido_mat'],
		visibleProperties: ["nombre","apellido_pat",'apellido_mat'],
		valueProperty: 'id'
	});
  $('#inputBusqueda2').flexdatalist({
    requestType: 'GET',
    data: "{{url('/data/empleados/lista')}}",
    params: {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    minLength: 1,
    selectionRequired: true,
    searchByWord: true,
    searchIn: ['nombre','apellido_pat','apellido_mat'],
    visibleProperties: ["nombre","apellido_pat",'apellido_mat'],
    valueProperty: 'id'
  });
	var tabla = $('#example1').DataTable({
      "language": { url: "{{url('js/esp.json')}}" },
		  "processing": true,
    	"ajax": "{{url('registros_horas/data')}}",
      "columns": [
            //{ "data": "opciones" },
            { "data": "tipo" },
            { "data": "hora" },
            { "data": "empleado" }
        ],
    });
    $('#botonActualizar').on('click',function(){
    	tabla.ajax.reload();
    });
    $('#datepicker1').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
	//Timepicker
    $('#timepicker').timepicker({
      showInputs: false,
      showMeridian: false
    });
    let fecha_inicio = moment().format('YYYY-MM-DD');
    let fecha_fin = moment().add(1, 'months').subtract(1, 'days').format('YYYY-MM-DD');
    $('#inputPeriodo').daterangepicker({
      opens: 'left',
      locale: { format: 'YYYY-MM-DD',
                daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                    'Diciembre'],
                applyLabel: 'Aplicar',
                cancelLabel: 'Limpiar',
                fromLabel: 'Desde',
                toLabel: 'Hasta',
              },
      
      
    },function(start, end, label){
      $('#hiddenStart').val(start.format('YYYY-MM-DD'));
      $('#hiddenEnd').val(end.format('YYYY-MM-DD'));
      console.log('CALL BACK');
      
    });
    //$('#inputPeriodo').daterangepicker({ minDate: fecha_inicio });
    $('#inputPeriodo').val(fecha_inicio+' - '+fecha_fin);

    $('#botonGenerarLibroAsistencias').click(function(){
      if($('#inputBusqueda2').val() != '' && $('#inputPeriodo').val() != ''){
        window.open('{{url("libro_asistencias_pdf")}}/'+$('#inputBusqueda2').val()+'/'+$('#inputPeriodo').val().substr(0,10)+'/'+$('#inputPeriodo').val().substr(13, $('#inputPeriodo').val().length-1));
      }
      
    });
});  
    
    /*
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })*/
  
		  

</script>
@endsection