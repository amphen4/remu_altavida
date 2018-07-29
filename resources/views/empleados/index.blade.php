@extends('layouts.adminlte')
@section('css')
<!-- FlexDataList -->
<link rel="stylesheet" href="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.css">
@endsection
@section('content')
		<div class="box box-info">
            <div class="box-header with-border">
              <h2 class="box-title">Gestionar Empleados</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="input-group input-group-lg">
                	<span class="input-group-addon"><strong>Búsqueda:</strong></span>
                	<input type="text" id="inputBusqueda" class="form-control" placeholder="Ingrese un nombre o apellido">
                	<span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-flat">Nuevo Empleado</button>
                    </span>
              	</div>
              	<br>
              </div>
              <!-- /.box-footer -->
            </form>
         </div>
@endsection
@section('js')
<!-- FlexDataList -->
<script src="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.js"></script>
<script>
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
		searchIn: 'nombre',
		visibleProperties: ["nombre"],
	});
	
</script>
@endsection