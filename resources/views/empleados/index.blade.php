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
<!-- la animacion loading -->
<link rel="stylesheet" href="{{asset('css')}}/loading.css">
@endsection
@section('cabecera','Gestionar Empleados')
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
<div class="box box-info">
    <div class="box-header with-border">
      
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal">
      <div class="box-body">
        <div class="input-group input-group-lg">
        	<span class="input-group-addon"><strong>Búsqueda:</strong></span>
        	<input type="text" id="inputBusqueda" class="form-control" placeholder="Ingrese un nombre o apellido">
        	<span class="input-group-btn">
              <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Nuevo Empleado</button>
            </span>
      	</div>
      	
      </div>
      <!-- /.box-footer -->
    </form>
    
</div>
<br>
<div id="divLoading" class="pre col-lg-12 col-md-12 col-md-xs-12">
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve" width="30" height="30">

		<rect fill="#FBBA44" width="15" height="15">
	  <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="1.7s" values="0,0;15,0;15,15;0,15;0,0;" repeatCount="indefinite"/>
		</rect>	

		<rect x="15" fill="#E84150" width="15" height="15">
	  <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="1.7s" values="0,0;0,15;-15,15;-15,0;0,0;" repeatCount="indefinite"/>
		</rect>	
	  
		<rect x="15" y="15" fill="#62B87B" width="15" height="15">
	  <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="1.7s" values="0,0;-15,0;-15,-15;0,-15;0,0;" repeatCount="indefinite"/>
		</rect>	

		<rect y="15" fill="#2F6FB6" width="15" height="15">
	  <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="1.7s" values="0,0;0,-15;15,-15;15,0;0,0;" repeatCount="indefinite"/>
		</rect>
	</svg>
</div>
<div class="row hidden" id="perfil">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" id="imgEmpleado" src="" alt="User profile picture">

              <h3 class="profile-username text-center" id="pNombreCompleto">Nina Mcintire</h3>

              <p class="text-muted text-center" id="pCargo">Software Engineer</p>

              <div class="box-body">
              	  <strong><i class="fa fa-file-text-o margin-r-5"></i> Contrato Activo:</strong>

	              <a href=""><p>Contrato No.2 24/07/2018</p></a>
	              <hr>
	              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

	              <p class="text-muted">
	                B.S. in Computer Science from the University of Tennessee at Knoxville
	              </p>

	              <hr>

	              <strong><i class="fa fa-map-marker margin-r-5"></i> Domicilio</strong>

	              <p class="text-muted">Malibu, California</p>

	              <hr>

	              <strong><i class="fa fa-pencil margin-r-5"></i> Afiliaciones</strong>

	              <p>
	                <span class="label label-danger">FONASA</span>
	                <span class="label label-success">AFP Cuprum</span>
	                <span class="label label-info">APV</span>
	              </p>

	              

	              
	          </div>

              <a href="#settings" id="botonEditar" data-toggle="tab" class="btn btn-primary btn-block"><b>Editar</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
          	<div class="pull-right"><button id="botonHide" class="btn btn-xs">X</button></div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Últimos Registros</a></li>
              <li><a href="#timeline" data-toggle="tab">Últimas Liquidaciones</a></li>
              <li><a href="#settings" id="tabEditarDatos" data-toggle="tab">Editar Datos</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="" alt="User Image">
                        <span class="username">
                          <a href="#">Entrada</a> 31/07/2018 08:58 Hrs
                        </span>
                    <span class="description"> Hace 13 Horas atrás</span>
                  </div>
                  <div class="user-block">
                    
                        <span class="username">
                          <a href="#">Salida</a> 31/07/2018 18:03 Hrs
                        </span>
                    <span class="description"> Hace 3 Horas atrás</span>
                  </div>
                  <!-- /.user-block -->
	                <div class="form-group margin-bottom-none">
	                  
	                  <div class="col-sm-3">
	                    <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Eliminar</button>
	                  </div>
	                </div>
                  
                </div>
                <!-- /.post -->
                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="" alt="User Image">
                        <span class="username">
                          <a href="#">Entrada</a> 30/07/2018 08:58 Hrs
                        </span>
                    <span class="description"> Hace 1 día</span>
                  </div>
                  <div class="user-block">
                    
                        <span class="username">
                          <a href="#">Salida</a> 30/07/2018 18:03 Hrs
                        </span>
                    <span class="description"> Hace 1 día</span>
                  </div>
                  <!-- /.user-block -->
	                <div class="form-group margin-bottom-none">
	                  
	                  <div class="col-sm-3">
	                    <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Eliminar</button>
	                  </div>
	                </div>
                  
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal"  method="POST" >
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
		                  			<input type="text" class="form-control" name="ciudad"  required>
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
					                  <input type="text" class="form-control pull-right" name="fecha_nacimiento"  required>
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
			                  <input type="text" class="form-control pull-right" name="fecha_ingreso"  required>
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
				                  <input type="text" class="form-control pull-right" name="fecha_retiro" >
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
				                  <input type="text" class="form-control pull-right" name="fecha_renovacion" >
				                </div>
			                </div>
			            </div>
		            </div>
                
				        <br>
		            </div>
		        </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
            <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                          <label >AFP:</label>
                        <select class="form-control " id="selectAfp" name="afp" >
                          
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                          <label >ISAPRE:</label>
                        <select class="form-control " id="selectIsapre" name="isapre" >
                         
                        </select>
                    </div>
                </div>
            </div>
		        
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
	$(document).ready(function(){
		$('#divLoading').hide();
		$('#perfil').hide();

    $.ajax({
      url: "{{url('afps/data')}}",
      method: "GET",
      success: function(data){
        var datos = JSON.parse(data).data;
        for(var i=0; i<datos.length; i++){
          if(i==0){
            $('#selectAfp').append(
                '<option selected value="'+datos[i].id+'">'+datos[i].nombre+' ('+datos[i].porcentaje+'%)</option>'
              );
          }else{
            $('#selectAfp').append(
                '<option value="'+datos[i].id+'">'+datos[i].nombre+' ('+datos[i].porcentaje+'%)</option>'
              );
          }
        }
            
      },
      error: function(jqXHR, textStatus){
        console.log(jqXHR.responseText);
        
      },
    });

    $.ajax({
      url: "{{url('isapres/data')}}",
      method: "GET",
      success: function(data){
        var datos = JSON.parse(data).data;
        for(var i=0; i<datos.length; i++){
          if(i==0){
            $('#selectIsapre').append(
                '<option selected value="'+datos[i].id+'">'+datos[i].nombre+' ('+datos[i].porcentaje+'%)</option>'
              );
          }else{
            $('#selectIsapre').append(
                '<option value="'+datos[i].id+'">'+datos[i].nombre+' ('+datos[i].porcentaje+'%)</option>'
              );
          }
        }
            
      },
      error: function(jqXHR, textStatus){
        console.log(jqXHR.responseText);
        
      },
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
    $('#inputBusqueda').on('select:flexdatalist',function(event,set,options){
      console.log('has elegido '+set.nombre);
      $('#perfil').removeClass('hidden');
      cargarPerfil(set.id);
    });
    
    $('#datepicker1').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
      $('#datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
      $('#datepicker3').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
      $('#datepicker4').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
      $('#botonHide').on('click',function(){$('#perfil').hide(); });
      $('#botonEditar').on('click',function(){$('#tabEditarDatos').click();});
      function cargarPerfil(id){

        $('#perfil').fadeOut();
        $('#perfil').hide();
        setTimeout(function(){1==1},100);
        $('#divLoading').show();
        $.ajax({
          url: "{{url('data/empleados')}}"+"/"+id,
          method: "GET",
          success: function(data){
            var datos = JSON.parse(data);
            $('#pNombreCompleto').html(datos.nombre+' '+datos.apellido_pat+' '+datos.apellido_mat);
            $('#pCargo').html(datos.cargo);
            $('#divLoading').hide();
            $('#perfil').fadeIn();
            $('#imgEmpleado').attr('src',"{{url('empleados/fotos')}}"+'/'+datos.id);
          },
          error: function(jqXHR, textStatus){
            console.log(jqXHR.responseText);
            $('#divLoading').hide();
          },
          async: false
        });

        
      }
	});
  	

</script>
@endsection