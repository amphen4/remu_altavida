@extends('layouts.adminlte')
@section('css')
<!-- Toastr -->
<link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
			            <div class="box-header">
			              <h3 class="box-title">Lista de Usuarios en el sistema</h3>
			              <a href="{{asset('/usuarios/create')}}" class="btn btn-success" style="float:right">Nuevo usuario</a>
			            </div>
			            <!-- /.box-header -->
			            <div class="box-body">
			              <table id="example1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th style="width:90px">Opciones</th>
			                  <th>Nombre</th>
			                  <th>Email</th>
			                  <th>Rol</th>
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
@endsection
@section('js')
<!-- Toastr -->
<script src="{{asset('js/toastr-master/build')}}/toastr.min.js"></script>
<!-- DataTables -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	var tabla = $('#example1').DataTable({
		"language": { url: "{{url('js/esp.json')}}" },
    	"ajax": "{{url('usuarios/data')}}",
        "columns": [
            { "data": "opciones" },
            { "data": "name" },
            { "data": "email" },
            { "data": "role_name_span" }
        ]
    });
    tabla.on( 'draw', function () {
	    
	    $('.botonEditar').each(function(){
	    	$(this).attr('href',"{{url('usuarios')}}/"+$(this).attr('data-id')+"/edit");

	    });	
	    
	    $('.botonEliminar').one('click',function(){
		  	if(confirm('Está seguro? ')){
		  		$.ajax({
			  		url: "{{url('usuarios/eliminar')}}"+"/"+$(this).attr('data-id'),
			    	method: "POST",
			    	headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			    	data: {
			    		'_method': 'DELETE'
			    	},
			    	success: function(data){
			    		toastr.success('El usuario fue eliminado con exito');
			    		tabla.ajax.reload();
			    	},
			    	error: function(jqXHR, textStatus){
			    		console.log(jqXHR.responseText);
			    		toastr.error('Ha ocurrido un error');
			    	},
			    	async: false
			  	});
		  	}
			  	
		  });
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