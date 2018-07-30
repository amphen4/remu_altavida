@extends('layouts.adminlte')
@section('css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/plugins/iCheck/all.css">
<!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- FlexDataList -->
<link rel="stylesheet" href="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.css">
<!-- Select2 -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/select2/dist/css/select2.min.css">
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
@endif
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
                      <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-flat">Nuevo Empleado</button>
                    </span>
              	</div>
              	<br>
              </div>
              <!-- /.box-footer -->
            </form>
         </div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal" id="formulario" method="POST" action="{{url('/empleados/create')}}">
      		@csrf
            <div class="box-body">
            	<div class="row">
                	<div class="col-lg-6">
		                <div class="input-group">
	                        <label >RUN:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="rut" placeholder="Formato: XXXXXXXX-X" required>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="input-group">
	                        <label >Nombre:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="nombre" required>
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="row">
                	<div class="col-lg-6">
		                <div class="input-group">
	                        <label >Apellido Paterno:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="apellido_pat" required>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="input-group">
	                        <label >Apellido Materno:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="apellido_mat" required>
		                </div>
		            </div>
		        </div>
		        <br>
	                
                <div class="row">
                	<div class="col-lg-4">
		                <div class="input-group">
	                        <label >Direccion:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="direccion" required>
		                </div>
		            </div>
                	<div class="col-lg-4">
		                <div class="input-group">
	                        <label >Comuna:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="comuna" required>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="input-group">
	                        <label >Ciudad:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="ciudad" id="inputCiudad" required>
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="row">
                	<div class="col-lg-4">
		                <div class="input-group">
	                        <label >Email:</label><label><p style="color:red">*</p></label>
                  			<input type="email" class="form-control" name="email" required>
		                </div>
		            </div>
                	<div class="col-lg-4">
		                <div class="input-group">
	                        <label >Telefono:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="telefono" required>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="input-group">
	                        <label >Celular:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="celular">
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="row">
                	<div class="col-lg-4">
		                <div class="input-group">
	                        <label >Sexo:</label><label><p style="color:red">*</p></label>
                  			<label>
			                  <input type="radio" name="sexo" value="Masculino" class="minimal"> Masculino
			                  <input type="radio" name="sexo" value="Femenino" class="minimal"> Femenino
			                </label>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="input-group">
	                        <label >Estado Civil:</label><label><p style="color:red">*</p></label>
                  			<select class="form-control " name="estado_civil" required>
                  				<option selected="selected">Soltero(a)</option>
                  				<option>Casado(a)</option>
                  				<option>Viudo(a)</option>
                  			</select>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="input-group">
	                        <label >Fecha Nacimiento:</label><label><p style="color:red">*</p></label>
                  			<div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" name="fecha_nacimiento" id="datepicker1" required>
			                </div>
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="row">
                	<div class="col-lg-6">
		                <div class="input-group">
	                        <label >Cargo:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="cargo" required>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="input-group">
	                        <label >Titulo:</label><label><p style="color:red">*</p></label>
                  			<input type="text" class="form-control" name="titulo" required>
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Pais:</label><label><p style="color:red">*</p></label>
                  <div class="col-sm-10">
                    <select class="form-control " name="pais" required>
          				<option selected="selected" >Chile</option>
          				<option>Venezuela</option>
          			</select>
                  </div>
                </div>
                <div class="row">
                	<div class="col-lg-6">
		                <div class="input-group">
	                        <label >Banco:</label>
                  			<select class="form-control " name="nombre_banco" >
                  				<option >Banco BBVA</option>
                  				<option>Banco BCI</option>
                  				<option>Banco de Chlile</option>
                  				<option>Banco Falabella</option>
                  				<option selected="selected">Banco Estado</option>
                  			</select>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="input-group">
	                        <label >Tipo Cuenta:</label>
                  			<select class="form-control " name="tipo_cuenta" >
                  				<option selected="selected">Cuenta Corriente</option>
                  				<option>Cuenta Vista</option>
                  			</select>
		                </div>
		            </div>
		        </div>
		        <br>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nro. Cuenta:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nro_cuenta">
                  </div>
                </div>
                <div class="row">
                	<div class="col-lg-4">
		                <div class="input-group">
	                        <label >Fecha Ingreso:</label><label><p style="color:red">*</p></label>
                  			<div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" name="fecha_ingreso" id="datepicker2" required>
			                </div>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="input-group">
	                        <label >Fecha Retiro:</label>
                  			<div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" name="fecha_retiro" id="datepicker3">
			                </div>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="input-group">
	                        <label >Fecha Renovacion:</label>
                  			<div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                  <input type="text" class="form-control pull-right" name="fecha_renovacion" id="datepicker4">
			                </div>
		                </div>
		            </div>
		        </div>
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
<!-- iCheck 1.0.1 -->
<script src="{{asset('templates/AdminLTE-master')}}/plugins/iCheck/icheck.min.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- FlexDataList -->
<script src="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.js"></script>
<!-- Select2 -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
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
		searchIn: ['nombre','apellido_pat','apellido_mat'],
		visibleProperties: ["nombre","apellido_pat",'apellido_mat'],
	});
	$('#inputCiudad').flexdatalist({
		data: "{{asset('json/comunas.json')}}",
		minLength: 1,
     	searchIn: 'name',
     	groupBy: 'region',
	    visibleProperties: ["name"],
	    textProperty: '{name}',
	    searchByWord: true,
	    valueProperty: 'name'
	});
	$('#datepicker1').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('#datepicker2').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('#datepicker3').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('#datepicker4').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    

</script>
@endsection