@extends('layouts.adminlte')
@section('css')
<!-- Toastr -->
<link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>

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
             	<h3 class="box-title">Registros contratos en el sistema</h3>
             	<div class="pull-right">
             		
             		<a href="{{ url('contratos/crear') }}" class="btn btn-success" ><i class="fa fa-plus"></i> Crear Contrato</a>
             	</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!--<th style="width:90px">Opciones</th>-->
                  <th>Nombre contrato</th>
                  <th>Fecha Actualizacion</th>
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
@endsection
@section('js')

@endsection