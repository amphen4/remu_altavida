@extends('layouts.adminlte')
@section('css')
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
			                  <th style="width:15px">Opciones</th>
			                  <th>Nombre</th>
			                  <th>Email</th>
			                  <th>Rol</th>
			                </tr>
			                </thead>
			                <tbody>
			                @foreach($users as $user)
			                <tr>
			                  <td><button class="btn btn-xs">Editar</button></td>
			                  <td>{{$user->name}}</td>
			                  <td>{{$user->email}}</td>
			                  <td><span class="badge badge-primary">{{$user->roles()->first()->description}}</span></td>
			                </tr>
			                @endforeach
			                
			                </tfoot>
			              </table>
			            </div>
			            <!-- /.box-body -->
			         </div>
				</div>
			</div>
@endsection
@section('js')
<!-- DataTables -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection