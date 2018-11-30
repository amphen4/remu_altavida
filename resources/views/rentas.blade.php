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
             	<h3 class="box-title">Parámetros de Imp. Renta</h3>
             	<div class="pull-right">
             		<button class="btn btn-primary" id="botonActualizar" ><i class="fa fa-refresh"></i> <strong>Actualizar</strong></button>
             		<button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" ><i class="fa fa-plus"></i> Agregar Nuevos parámetros</button>
             	</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!--<th style="width:90px">Opciones</th>-->
                  <th>Monto Desde</th>
                  <th>Monto Hasta</th>
                  <th>Fecha Desde</th>
                  <th>Factor</th>
                  <th>Monto a rebajar</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevos parámetros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" id="formulario" method="POST" action="{{url('/rentas')}}">
      		@csrf
            <div class="box-body">
            	<div class="row">
              	<div class="col-lg-6">
	                <div class="input-group">
                        <label >Monto Desde:</label><label><p style="color:red">*</p></label>
                			<div class="input-group ">
		                  <div class="input-group-addon">
		                    <i class="fa fa-cog"></i>
		                  </div>
		                  <input type="number" id="monto_desde" min="0" required name="monto_desde" class="form-control" placeholder="Ingrese un valor entero positivo">
		                </div>
	                </div>
		            </div>
		            <div class="col-lg-6">
                  <div class="input-group">
                        <label >Monto Hasta:</label><label><p style="color:red">*</p></label>
                      <div class="input-group ">
                      <div class="input-group-addon">
                        <i class="fa fa-cog"></i>
                      </div>
                      <input type="number" id="monto_hasta" min="0" required name="monto_hasta" class="form-control" placeholder="Ingrese un valor entero positivo">
                    </div>
                  </div>
                </div>
		        </div>
		        <br>
            <div class="row">
              	<div class="col-lg-6">
                  <div class="input-group">
                        <label >Factor:</label><label><p style="color:red">*</p></label>
                      <div class="input-group ">
                      <div class="input-group-addon">
                        <i class="fa fa-cog"></i>
                      </div>
                      <input type="number" id="factor" min="0" step="0.001" required name="factor" class="form-control" placeholder="Ingrese un valor real positivo">
                    </div>
                  </div>
                </div>
		            <div class="col-lg-6">
                  <div class="input-group">
                        <label >Monto a rebajar:</label><label><p style="color:red">*</p></label>
                      <div class="input-group ">
                      <div class="input-group-addon">
                        <i class="fa fa-cog"></i>
                      </div>
                      <input type="number" id="monto_rebajar" min="0" required name="monto_rebajar" class="form-control" placeholder="Ingrese un valor entero positivo">
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
	var tabla = $('#example1').DataTable({
      "language": { url: "{{url('js/esp.json')}}" },
		  "processing": true,
    	"ajax": "{{url('rentas_data')}}",
      "columns": [
            //{ "data": "opciones" },
            { "data": "monto_desde" },
            { "data": "monto_hasta" },
            { "data": "fecha_desde" },
            { "data": "factor"},
            { "data": "cantidad_rebajar"}
        ],
    });
    $('#botonActualizar').on('click',function(){
    	tabla.ajax.reload();
    });
    $('#datepicker1').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
	//Timepicker
    $('#timepicker').timepicker({
      showInputs: false,
      showMeridian: false
    })
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