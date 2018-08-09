@extends('layouts.adminlte')
@section('css')
<!-- Toastr -->
<link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                  <th style="width:90px">Opciones</th>
                  <th>#</th>
                  <th>Fecha Creacion</th>
                  <th>Nombre Empleado</th>
                  <th>Estado</th>
                  <th>Tipo</th>
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
<!-- DataTables -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        var tabla = $('#example1').DataTable({
            "ajax": "{{url('contratos/data')}}",
            "columns": [
                { "data": "opciones" },
                { "data": "id" },
                { "data": "fecha_inicio"},
                { "data": "empleado" },
                { "data": "estado" },
                { "data": "tipo" }
            ]
        });
        tabla.on( 'draw', function () {

            $('.botonEditar').each(function(){
                $(this).attr('href',"{{url('contratos')}}/"+$(this).attr('data-id')+"/edit");

            });

            $('.botonEliminar').one('click',function(){
                if(confirm('Está seguro? ')){
                    $.ajax({
                        url: "{{url('contratos/eliminar')}}"+"/"+$(this).attr('data-id'),
                        method: "POST",
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            '_method': 'DELETE'
                        },
                        success: function(data){
                            toastr.success('El contrato fue eliminado con exito');
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