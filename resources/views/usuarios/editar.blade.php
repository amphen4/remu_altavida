@extends('layouts.adminlte')
@section('css')

@endsection
@section('content')
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
			            <div class="box-header">
			              <h3 class="box-title">Editar usuario: {{$user->name}}</h3>
			              <a href="{{route('usuarios.index')}}" class="btn btn-primary" style="float:right">Volver/Cancelar</a>
			            </div>
			            @if ($errors->any())
					    <div class="alert alert-warning alert-dismissible">
			                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			                <h4><i class="icon fa fa-warning"></i> Atencion!</h4>
			                <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
			            </div>
						@endif
			            <!-- /.box-header -->
			            <form role="form" method="POST" action="{{route('usuarios.update',['usuario' => $user->id])}}">
			            @csrf
			            {{ method_field('put') }}
			            <div class="box-body">
			              <div class="box box-success">
				            <div class="box-header with-border">
				              <h5 class="box-title">Complete el siguiente formulario</h5>
				            </div>
				            <div class="box-body">
				            	<div class="form-group">
				                  <label for="exampleInputEmail1">Nombre</label> <label><p style="color:red">*</p></label>
				                  <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Ingrese un nombre. *máx. 190 caracteres" required>
				                </div>
				                <div class="form-group">
				                  <label>Rol</label> <label><p style="color:red">*</p></label>
				                  <select name="role" class="form-control" required>
				                    <option  disabled>Seleccione opcion...</option>
				                    <option @if($user->role()->first()->name == 'admin') selected @endif value="1">Administrador</option>
				                    <option @if($quedaUnAdmin) disabled @endif @if($user->role()->first()->name == 'secretary') selected @endif value="2">Usuario Secretaria</option>
				                  </select>
				                </div>
				              	<div class="form-group">
				                  <label for="exampleInputEmail1">Correo electrónico</label> <label><p style="color:red">*</p></label>
				                  <input type="email" class="form-control" name="email" placeholder="Ingrese un correo electrónico con que se logueará el usuario. *máx. 190 caracteres" value="{{$user->email}}" required>
				                </div>
				                <div class="form-group">
				                  <label for="exampleInputPassword1">Contraseña</label>   <label><p style="font-style:italic;font-size:small">(Dejar en blanco si no desea modificar)</p></label>
				                  <input type="password" class="form-control" name="password"  placeholder="Ingrese una contraseña. *mín. 6 caracteres, máx. 190 caracteres " >
				                </div>
				                <div class="form-group">
				                  <label for="exampleInputPassword1">Repita Contraseña</label>   <label><p style="font-style:italic;font-size:small">(Dejar en blanco si no desea modificar)</p></label>
				                  <input type="password" class="form-control" name="password_confirmation" placeholder="Ingrese la misma contraseña anterior. *mín. 6 caracteres, máx. 190 caracteres" >
				                </div>
				            </div>
				            <!-- /.box-body -->
				          </div>
			            </div>

			            <div class="box-footer">

			                <button type="submit" class="btn btn-success">Enviar</button>
			                (<label><p style="color:red">*</p></label>) Campo obligatorio
			            </div>
			        	</form>
			            <!-- /.box-body -->
			         </div>
				</div>
			</div>
@endsection
@section('js')
<!-- DataTables -->

@endsection