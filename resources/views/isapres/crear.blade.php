@extends('layouts.adminlte')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Crear nueva isapre en el Sistema</h3>
                    <a href="{{asset('/isapres')}}" class="btn btn-primary" style="float:right">Volver</a>
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
                <form role="form" method="POST" action="{{ url('/isapres') }}">
                    @csrf
                    <div class="box-body">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h5 class="box-title">Complete el siguiente formulario</h5>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label> <label><p style="color:red">*</p></label>
                                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese un nombre. *máx. 190 caracteres" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Porcentaje</label> <label><p style="color:red">*</p></label>
                                    <input type="number" placeholder="1.0" step="0.01" min="0" max="100" class="form-control" name="porcentaje" placeholder="Ingrese un porcentaje de 0 a 100" required>
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