@extends('layouts.adminlte')
@section('css')

@endsection
@section('content')
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
			            <div class="box-header">
			              <h3 class="box-title">Editar AFP: {{$afp->nombre}}</h3>
			              <a href="{{route('afps.index')}}" class="btn btn-primary" style="float:right">Volver/Cancelar</a>
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
			            <form role="form" method="POST" action="{{route('afps.update',['afp' => $afp->id])}}">
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
				                  <input type="text" class="form-control" name="Nombre" value="{{$afp->nombre}}" placeholder="Ingrese el Nombre de la AFP. *máx. 190 caracteres" required>
				                </div>

												<div class="box-body">
				            	<div class="form-group">
				                  <label for="exampleInputEmail1">Nombre</label> <label><p style="color:red">*</p></label>
				                  <input type="unsignedDecimal" class="form-control" name="Porcentaje" value="{{$afp->porcentaje}}" placeholder="Ingrese el porcentaje correspondiente a la AFP. *Dos decimales máximo." required>
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