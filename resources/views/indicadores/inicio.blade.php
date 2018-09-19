@extends('layouts.adminlte')
@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
			<div class="row">
	            <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-purple">
	                <div class="inner">
	                  <h3>{{$uf}}<sup style="font-size: 20px">CLP</sup></h3>

	                  <p>U.F ({{$fecha}})</p> 
	                </div>
	                <div class="icon">
	                  <i class="fa fa-money"></i>
	                </div>
	                <a  data-valor="uf" class="small-box-footer btnGrafico">
	                  Ver Gráfico <i class="fa fa-arrow-circle-right"></i>
	                </a>
	              </div>
	            </div>
	            <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-green">
	                <div class="inner">
	                  <h3>{{$dolar}}<sup style="font-size: 20px">CLP</sup></h3>

	                  <p>Dolar ({{$fecha}})</p> 
	                </div>
	                <div class="icon">
	                  <i class="fa fa-dollar"></i>
	                </div>
	                <a   data-valor="dolar" class="small-box-footer btnGrafico">
	                  Ver Gráfico <i class="fa fa-arrow-circle-right"></i>
	                </a>
	              </div>
	            </div>
	            <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-blue">
	                <div class="inner">
	                  <h3>{{$utm}}<sup style="font-size: 20px">CLP</sup></h3>

	                  <p>UTM ({{$mes}})</p>
	                </div>
	                <div class="icon">
	                  <i class="fa fa-money"></i>
	                </div>
	                <a data-valor="utm" class="small-box-footer btnGrafico">
	                  Ver Gráfico <i class="fa fa-arrow-circle-right"></i>
	                </a>
	              </div>
	            </div>
	            <div class="col-lg-3 col-xs-6">
	              <!-- small box -->
	              <div class="small-box bg-yellow">
	                <div class="inner">
	                  <h3>{{$ipc}}<sup style="font-size: 20px"> % </sup></h3>

	                  <p>IPC ({{$mes_ipc}})</p>
	                </div>
	                <div class="icon">
	                  <i class="fa fa-cart-plus"></i>
	                </div>
	                <a data-valor="ipc" class="small-box-footer btnGrafico">
	                  Ver Gráfico <i class="fa fa-arrow-circle-right"></i>
	                </a>
	              </div>
	            </div>
	        </div>
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
			            <div class="box-header">
			              <h3 class="box-title">Registro de indicadores económicos en el Sistema</h3>
			              
			            </div>
			            <!-- /.box-header -->
			            <div class="box-body">
			              <table id="example2" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th style="width:15px">Fecha</th>
			                  <th>U.F</th>
			                  <th>Dólar</th>
			                  <th>Euro</th>
			                  <th>UTM</th>
			                  <th>IPC (Mes)</th>
			                </tr>
			                </thead>
			                <tbody>
			                <!--
			                <tr>
			                  <td></td>
			                  <td></td>
			                  <td></td>
			                  <td></td>
			                </tr>
			                -->
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Grafico</h4>
      </div>
      <div class="modal-body" >
	      <!-- LINE CHART -->
	      <div class="box box-info">
	        
	        <div class="box-body">
	          <div class="chart">
	            <canvas id="myChart" ></canvas>
	          </div>
	        </div>
	        <!-- /.box-body -->
	      </div>
	      <!-- /.box --> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- DataTables -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<script>
  $(function () {
    
    $('#example2').DataTable({
      "language": { url: "{{url('js/esp.json')}}" },
      'columns': [
        	{ 'data': 'fecha' },
        	{ 'data': 'uf' },
        	{ 'data': 'dolar' },
        	{ 'data': 'euro' },
        	{ 'data': 'utm' },
        	{ 'data': 'ipc' }
      ],
      'ajax': {
      	'url': "{{url('indicadores/data')}}",
      	'type': 'POST',
      	headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
      	
      },	
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    });

    $('.btnGrafico').on('click',function(){
    	
    	var dataGrafico;
    	var meses;
    	var recurso = $(this).attr("data-valor"); 
	    $.ajax({
	    	url: "{{url('data/graficos')}}"+"/"+recurso,
	    	method: "GET",
	    	success: function(data){
	    		console.log(data);
	    		dataGrafico = data.data;
	    		meses = data.meses;
	    	},
	    	error: function(jqXHR, textStatus){
	    		console.log(jqXHR.responseText);

	    	},
	    	async: false
	    });
    	var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',	
		    data: {
		        labels: meses,
		        datasets: [{
		            label: 'Valores '+recurso+' Promedio ultimos 12 Meses',
		            data: dataGrafico,
		        }]
		    },
		});
	    $('#myModal').modal('show');
	    $('#myModal').on('hide.bs.modal',function(){
	    	myChart.destroy();
	    })
    });
  });
</script>
@endsection