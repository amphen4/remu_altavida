@extends('layouts.adminlte')
@section('css')
<!-- Toastr -->
<link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('js/daterangepicker-master')}}/daterangepicker.css" />
<style>
input[readonly]{
  background-color:transparent !important;
  border: 1 !important;
  font-size: 1em !important;
}

</style>
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reporte Mensual de Liquidaciones</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Promedio Liquidaciones Últimos 12 Meses</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 250px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Próximas Liquidaciones</strong>
                  </p>

                  <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="{{asset('templates/AdminLTE-master')}}/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Juanito Perez
                      <span class="label label-warning pull-right">Educador Diferencial</span></a>
                    <span class="product-description">
                          Fecha Pago: 20 de Agosto
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="{{asset('templates/AdminLTE-master')}}/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Rosita Muñoz
                      <span class="label label-info pull-right">Administracion</span></a>
                    <span class="product-description">
                          Fecha Pago: 23 de Agosto
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="{{asset('templates/AdminLTE-master')}}/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Juanito Vidal <span
                        class="label label-danger pull-right">Trabajador a Honorarios</span></a>
                    <span class="product-description">
                          Fecha Pago: 1 de Septiembre
                        </span>
                  </div>
                </li>
                
                  <span class="product-description text-center"  ><a href="#" >Ver más</a></span>
                
              </ul>
            </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$4.670.830 Pesos</h5>
                    <span class="description-text">Total Liquidado</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">843 Hrs.</h5>
                    <span class="description-text">Total Horas Registradas</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Liqudaciones en el Sistema</h3>
                <div class="pull-right">
                  <button  class="btn btn-success"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Generar Liquidacion Manualmente</button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width:90px">Opciones</th>
                        <th>Empleado</th>
                        <th>Fecha desde</th>
                        <th>Fecha hasta</th>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Liquidacion Manualmente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Seleccione un empleado:</h3>
                <div class="pull-right">
                  <button class="btn btn-primary" id="botonActualizarDataEmpleados" ><i class="fa fa-refresh"></i> <strong>Actualizar</strong></button>
                  
                </div>
              </div>
              
              <!-- /.box-header -->
              <div class="box-body ">
                <table id="tablaContratos" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <!--<th style="width:90px">Opciones</th>-->
                      <th># Contrato</th>
                      <th>Empleado</th>
                      <th>Tipo</th>
                      <th>Periodo Proxima Liquidacion</th>
                      <!--<th>Factor (opcional)</th>-->
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
           </div>
          </div>
        </div>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" disabled id="botonSiguiente" class="btn btn-primary">Siguiente</button>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal Detalle -->
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles de la liquidacion a generar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="bodyModaLiquidacion">
        <section class="invoice " id="contrato">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                  Liquidación de Remuneraciones
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          
           
          <div class="row ">
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputEmpresa" class="col-sm-2 control-label">Empresa:</label>

                    <div class="col-sm-10">
                      <input type="text"  readonly class="form-control" value="CORPORACION ALTAVIDA" id="inputEmpresa" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputMes" class="col-sm-2 control-label">Mes:</label>

                    <div class="col-sm-10">
                      <input type="text"   class="form-control" id="inputMes" >
                    </div>
                  </div>
                
              </form>
            </div>
          </div>
          <div class="row ">
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputSucursal" class="col-sm-2 control-label">Sucursal:</label>

                    <div class="col-sm-10">
                      <input type="text"  readonly class="form-control" value="CORPORACION ALTAVIDA" id="inputSucursal" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputPeriodo" class="col-sm-2 control-label">Periodo:</label>

                    <div class="col-sm-10">
                      <input type="text"   class="form-control" id="inputPeriodo" >
                    </div>
                  </div>
                
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputRutEmpresa" class="col-sm-2 control-label">RUT:</label>

                    <div class="col-sm-10">
                      <input type="text"  readonly class="form-control" id="inputRutEmpresa" value="65.076.242-8" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-6">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="horasTrabajadas" class="col-sm-3 control-label">Horas Registradas</label>
                  <div class="col-sm-9">
                    <input type="number" readonly class="form-control" value="0" id="horasTrabajadas" style="input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none !important; margin: 0 !important; }">
                    <input type="hidden" id="hiddenStart">
                    <input type="hidden" id="hiddenEnd">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputNombreEmpleado" class="col-sm-5 control-label">Trabajador Sr(a):</label>

                    <div class="col-sm-7">
                      <input type="text"  readonly class="form-control" value="" id="inputNombreEmpleado" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputIdContrato" class="col-sm-2 control-label">Contrato:</label>

                    <div class="col-sm-10">
                      <input type="text"  readonly class="form-control" id="inputIdContrato" >
                    </div>
                  </div>
                
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputRutEmpleado" class="col-sm-2 control-label">RUT:</label>

                    <div class="col-sm-10">
                      <input type="text"  readonly class="form-control" value="" id="inputRutEmpleado" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-4">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputIdEmpleado" class="col-sm-3 control-label">Codigo:</label>

                    <div class="col-sm-9">
                      <input type="text"  readonly class="form-control" id="inputIdEmpleado" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-4">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputCentroDeCosto" class="col-sm-6 control-label">Centro de costo:</label>

                    <div class="col-sm-6">
                      <input type="text"  readonly class="form-control" value="CASA MATRIZ" id="inputCentroDeCosto" >
                    </div>
                  </div>
                
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputFechaContrato" class="col-sm-4 control-label">Fecha contrato:</label>

                    <div class="col-sm-8">
                      <input type="text"  readonly class="form-control" value="" id="inputFechaContrato" >
                    </div>
                  </div>
                
              </form>
            </div>
            <div class="col-sm-6">
              <form class="form-horizontal">
                
                  <div class="form-group">
                    <label for="inputCargo" class="col-sm-2 control-label">Cargo:</label>

                    <div class="col-sm-10">
                      <input type="text"  readonly class="form-control" id="inputCargo" >
                    </div>
                  </div>
                
              </form>
            </div>
          </div>
          <br>

          <!-- /.row -->
          <div class="row">

          </div>
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <p class="lead">Haberes Incluidos:</p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imponible</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th style="width:150px;">Fecha inicio</th>
                    <th style="width:100px;">Duracion (Meses)</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="bodyTablaHaberes">
                </tbody>
              </table>
              
            </div>

            <!-- /.col -->
            
          </div>
          
          <!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <p class="lead">Otros Descuentos Incluidos:</p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <!--<th>Imponible</th>-->
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th style="width:150px;">Fecha inicio</th>
                    <th style="width:100px;">Duracion (Meses)</th>
                  </tr>
                </thead>
                <tbody id="bodyTablaDescuentos">
                  
                    
                    
                </tbody>
              </table>
              
            </div>

            <!-- /.col -->
            
          </div>
          <!-- /.row Detalles Pago-->
          <div class="row">
              <!-- accepted payments column -->
              <div class="col-xs-6">
                <p class="lead">Trabajador Sr(a):</p>
                <p class="text-muted well well-sm no-shadow" id="nombreEmpleado" style="margin-top: 10px;"></p>
                <!--
                <p class="text-muted well well-sm no-shadow" id="pBancoCuenta" style="margin-top: 10px;"></p>
                <p class="text-muted well well-sm no-shadow" id="pCuenta" style="margin-top: 10px;"></p>
                -->
                <p class="text-muted well well-sm no-shadow" id="rutEmpleado" style="margin-top: 10px;"></p>
              </div>
              <!-- /.col -->
              <div class="col-xs-6">
                <p class="lead">Resumen Liquidación</p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Total Haberes Imponibles:</th>
                      <td id="totalHaberesImponibles"></td>
                    </tr>
                    <tr>
                      <th>Total Haberes No Imponibles:</th>
                      <td id="totalHaberesNoImponibles"></td>
                    </tr>
                    <tr>
                      <th>Total Haberes:</th>
                      <td id="totalHaberes"></td>
                    </tr>
                    <tr>
                      <th id="bAfp"></th>
                      <td id="descuentoAfp"></td>
                    </tr>
                    <tr>
                      <th id="bIsapre"></th>
                      <td id="descuentoIsapre"></td>
                    </tr>
                    <tr>
                      <th>Impuesto Renta:</th>
                      <td id="imp_renta"></td>
                    </tr>
                    <tr>
                      <th>Total Otros Descuentos:</th>
                      <td id="totalOtrosDescuentos"></td>
                    </tr>
                    <tr>
                      <th>Total Descuentos:</th>
                      <td id="totalDescuentos"></td>
                    </tr>
                    <tr>
                      <th>Total Liquido:</th>
                      <td id="totalAPagar"></td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <!--<a href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>-->
              
              
            </div>
          </div>
        </section>
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary "   id="botonGenerarPdf">
                <i class="fa fa-file-pdf-o" style="margin-right: 5px;"></i> Generar PDF
              </button>
        <button type="button" id="botonAceptar" class="btn btn-primary">Registrar en el Sistema</button>
      </div>
      
    </div>
  </div>
</div>
@endsection
@section('js')
<!-- Toastr -->
<script src="{{asset('js/toastr-master/build')}}/toastr.min.js"></script>
<!-- DataTables -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="{{asset('js/daterangepicker-master')}}/daterangepicker.js"></script>
<script>
        
    $(document).ready(function(){
        
        
        function capitalize (str1){
          console.log('capitalising');
          return str1.charAt(0).toUpperCase() + str1.slice(1);
        };
        var afp_porcentaje;
        var isapre_porcentaje;
        function reCalcular(){
            console.log('se invoco la funcion reCalcular()');
            var totalHaberesImponibles = 0;
            var valorUf = 27000;
            var valorUtm = 50000;
            var sueldoBaseCalcular = 0;
            $('#bodyTablaHaberes > tr').each(function(){
              if( $(this).find('#id').html() == '0' ){
                sueldoBaseCalcular = parseInt( $(this).find('#valor').html().replace('.','') );
              }
            }); //parseInt( (sueldo_base.getRawValue().slice(2)=='')?'0':sueldo_base.getRawValue().slice(2) );
            var total = 0;
            var total_imponible = 0;
            //total_imponible += sueldoBaseCalcular;
            var total_no_imponible = 0;
            $('#bodyTablaHaberes > tr').each(function(){
              //var totalHaberesImponibles +=  sueldo_base.getRawValue();
              if( $(this).find('#imp').html() == 'Si' ){
                if($(this).find('#tipo').html() == 'MONTO'){
                  total_imponible += parseInt( $(this).find('#valor').html().replace('.','') );
                }else{
                  if( $(this).find('#tipo').html() == 'PORCENTAJE SUELDO BASE'){
                    total_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * sueldoBaseCalcular;
                  }
                  if( $(this).find('#tipo').html() == 'UF'){
                    total_imponible += parseInt( $(this).find('#valor').html().replace('.','') ) * valorUf;
                  }
                  if( $(this).find('#tipo').html() == 'UTM'){
                    total_imponible += parseInt( $(this).find('#valor').html().replace('.','') ) * valorUtm;
                  }
                }
              }
              
            });
            $('#bodyTablaHaberes > tr').each(function(){
              //var totalHaberesImponibles +=  sueldo_base.getRawValue();
              if( $(this).find('#imp').html() == 'No' ){
                if($(this).find('#tipo').html() == 'MONTO'){
                  total_no_imponible += parseInt( $(this).find('#valor').html().replace('.','') );
                }else{
                  if( $(this).find('#factor').html() == 'PORCENTAJE SUELDO BASE'){
                    total_no_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * sueldoBaseCalcular;
                  }
                  if( $(this).find('#factor').html() == 'UF'){
                    total_no_imponible += parseInt( $(this).find('#valor').html().replace('.','') ) * valorUf;
                  }
                  if( $(this).find('#factor').html() == 'UTM'){
                    total_no_imponible += parseInt( $(this).find('#valor').html().replace('.','') ) * valorUtm;
                  }
                }
              }
              
            });
            var impuesto_renta = 0;
              $.ajax({
                method: 'GET',
                url: "{{url('')}}/imp_renta/"+total_imponible,
                async: false,
                success: function(data){
                  let valor = JSON.parse(data);
                  impuesto_renta = valor;
                  $('#imp_renta').html('$ '+valor.toLocaleString('de-DE'));
                },
                error: function(jqXHR, textStatus){
                  console.log(jqXHR.responseText);
                  alert('Ocurrio un error al utilizar ajax, favor ver consola para mas detalles');
                },
              });
            //console.log('total imponible: '+total_imponible);
            //console.log('total no imponible: '+total_no_imponible);
            var total_haberes = total_imponible + total_no_imponible;
            $('#totalHaberesImponibles').html( '$ '+total_imponible.toLocaleString('de-DE') );
            $('#totalHaberesNoImponibles').html( '$ '+total_no_imponible.toLocaleString('de-DE') );
            $('#totalHaberes').html( '$ '+total_haberes.toLocaleString('de-DE') );
            var total_descuentos = 0;

            $('#bodyTablaDescuentos > tr').each(function(){
              //var totalHaberesImponibles +=  sueldo_base.getRawValue();
              if($(this).find('#tipo').html() == 'MONTO'){
                total_descuentos += parseInt( $(this).find('#valor').html().replace('.','') );
              }else{
                if( $(this).find('#factor').html() == 'PORCENTAJE SUELDO BASE'){
                  total_descuentos += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * sueldoBaseCalcular;
                }
                if( $(this).find('#tipo').html() == 'UF'){
                    total_descuentos += parseInt( $(this).find('#valor').html().replace('.','') ) * valorUf;
                  }
                  if( $(this).find('#tipo').html() == 'UTM'){
                    total_descuentos += parseInt( $(this).find('#valor').html().replace('.','') ) * valorUtm;
                  }
              }
            });

            $('#totalOtrosDescuentos').html( '$ '+ total_descuentos.toLocaleString('de-DE'));
            var total_descuento_afp = total_imponible * (afp_porcentaje/100);
            var total_descuento_isapre = total_imponible * (isapre_porcentaje/100);
            total_descuentos += total_descuento_afp;
            total_descuentos += total_descuento_isapre;
            total_descuentos += impuesto_renta;
            $('#descuentoAfp').html( '$ '+total_descuento_afp.toLocaleString('de-DE') );
            $('#descuentoIsapre').html( '$ '+total_descuento_isapre.toLocaleString('de-DE') );
            $('#totalDescuentos').html( '$ '+ total_descuentos.toLocaleString('de-DE'));
            var totalAPagar = total_haberes - total_descuentos;
            $('#totalAPagar').html( '$ '+ totalAPagar.toLocaleString('de-DE'));
            //console.log(valor);
        }

        moment.locale('en');
        
        var tabla = $('#example1').DataTable({
            "language": { url: "{{url('js/esp.json')}}" },
            processing: true,
            "ajax": "{{url('liquidaciones/data')}}",
            "columns": [
                { "data": "opciones" },
                { "data": "empleado" },
                { "data": "fecha_inicio" },
                { "data": "fecha_fin"},
            ]
        });
        $('#botonActualizarDataHaberes').on('click',function(){
          tabla.ajax.reload();
        })
        
        var tabla2 = $('#tablaContratos').DataTable({
            "language": { url: "{{url('js/esp.json')}}" },
            "ajax": "{{url('contratos/data_l')}}",
            processing: true,
            "columns": [
                { "data": "id" },
                { "data": "empleado" },
                { "data": "tipo"},
                { "data": "proxima_liquidacion"},
            ],
            "select": {
                style: 'single'
            }
        });
        $('#botonActualizarDataEmpleados').on('click',function(){
          tabla2.ajax.reload();
        })
        $('#tablaContratos tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                tabla2.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        var idEmpleado;

        var sueldoBase = 99;
        console.log(sueldoBase);
        $('#tablaContratos').on( 'select.dt', function ( e, dt, type, indexes ) {
              var fila = dt.rows(indexes).data();
              console.log(fila[0].id);
              idEmpleado = fila[0].id;
              $.ajax({
                url: "{{ url('liquidaciones/data/detalleProxLiquidacion') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                },
                data: {
                  'id': fila[0].id
                },
                success: function(data){
                  datos = JSON.parse(data);
                  sueldoBase = datos['contrato'].sueldo_base;
                  afp_porcentaje = parseFloat(datos['empleado'].afp_porcentaje);
                  isapre_porcentaje = parseFloat(datos['empleado'].isapre_porcentaje);
                  $('#nombreEmpleado').html('Nombre: '+datos['empleado'].nombre+' '+datos['empleado'].apellido_pat+' '+datos['empleado'].apellido_mat);
                  $('#rutEmpleado').html('Rut: '+datos['empleado'].rut);
                  $('#bAfp').html('AFP: '+datos['empleado'].afp_nombre+' ('+datos['empleado'].afp_porcentaje+'%)');
                  $('#bIsapre').html('Salud: '+datos['empleado'].isapre_nombre+' ('+datos['empleado'].isapre_porcentaje+'%)');
                  //$('.filaSelect').prop('hidden', false);
                  //$('#selectPeriodo').empty();
                  moment.locale('es'); 
                  $('#inputMes').val( capitalize(moment(datos['contrato'].fecha_inicio).format('MMMM')) );
                  $('#inputNombreEmpleado').val( datos['empleado'].nombre+' '+datos['empleado'].apellido_pat+' '+datos['empleado'].apellido_mat );
                  $('#inputRutEmpleado').val( datos['empleado'].rut );
                  $('#inputIdContrato').val( datos['contrato'].id );
                  $('#inputFechaContrato').val( moment(datos['contrato'].fecha_inicio).format('DD/MM/YYYY') );
                  $('#inputCargo').val( datos['empleado'].cargo );
                  $('#botonSiguiente').prop('disabled', false);
                  let fecha_inicio = moment(datos['fecha_inicio']).subtract(1, 'months').add(1, 'days').format('DD/MM/YYYY');
                  let fecha_fin = moment(datos['fecha_inicio']).format('DD/MM/YYYY');
                  $('#inputPeriodo').daterangepicker({ minDate: fecha_inicio });
                  $('#inputPeriodo').val(fecha_inicio+' - '+fecha_fin);
                  $('#hiddenStart').val(moment(datos['fecha_inicio']).subtract(1, 'months').add(1, 'days').format('YYYY-MM-DD'));
                  $('#hiddenEnd').val(moment(datos['fecha_inicio']).format('YYYY-MM-DD'));
                  $('#bodyTablaHaberes').empty();
                  $('#bodyTablaDescuentos').empty();
                  let wow = '<tr>'+
                                    '<td id="id">'+0+'</td>'+
                                    '<td >'+'Sueldo Base'+'</td>'+
                                    '<td id="imp">'+'Si'+'</td>'+
                                    '<td id="tipo">'+'MONTO'+'</td>'+
                                    '<td id="valor">'+sueldoBase.toLocaleString('de-DE')+'</td>'+
                                    '<td>'+''+'</td>'+
                                    '<td>'+'</td>'+
                                '</tr>';
                  $('#bodyTablaHaberes').append(wow);
                  if(datos['haberes']){
                    for(var i=0; i < datos['haberes'].length; i++){
                      let wow = '';
                      let agotados;
                      if( datos['haberes'][i].pivot.duracion ){
                        $.ajax({
                              url: "{{ url('liquidaciones/haber_a') }}",
                              method: 'POST',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                              },
                              data: {
                                'idContrato': datos['contrato'].id,
                                'idHaber': datos['haberes'][0].id,
                              },
                              success: function(data){
                                agotados = JSON.parse(data) +1 ;
                                if(agotados <= datos['haberes'][i].pivot.duracion){
                                  wow = '<tr>'+
                                            '<td id="id">'+datos['haberes'][i].id+'</td>'+
                                            '<td >'+datos['haberes'][i].nombre+' ('+agotados+'/'+datos['haberes'][i].pivot.duracion+')</td>'+
                                            '<td id="imp">'+datos['haberes'][i].imp+'</td>'+
                                            '<td id="tipo">'+datos['haberes'][i].tipo+'</td>'+
                                            '<td id="valor">'+datos['haberes'][i].valor+'</td>'+
                                            '<td>'+'<input class="form-control inputFecha" type="text" readonly value="'+moment( datos['haberes'][i].pivot.fecha_inicio ).format('DD/MM/YYYY')+'" >'+'</td>'+
                                            '<td>'+'<input style="width:100px;" class="form-control" id="duracion" readonly min="1" value="'+datos['haberes'][i].pivot.duracion+'"type="text">'+'</td>'+
                                        '</tr>';
                                }
                              },
                              error: function(jqXHR, textStatus){
                                  console.log(jqXHR.responseText);
                                  toastr.error('Ha ocurrido un error');
                              },
                              async: false

                        });
                        
                      } else{
                        if( moment(datos['fecha_inicio']).isAfter( datos['haberes'][i].pivot.fecha_inicio ) ){
                          wow = '<tr>'+
                                      '<td id="id">'+datos['haberes'][i].id+'</td>'+
                                      '<td >'+datos['haberes'][i].nombre+'</td>'+
                                      '<td id="imp">'+datos['haberes'][i].imp+'</td>'+
                                      '<td id="tipo">'+datos['haberes'][i].tipo+'</td>'+
                                      '<td id="valor">'+datos['haberes'][i].valor+'</td>'+
                                      '<td>'+'<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control inputFecha" type="text" ></div>'+'</td>'+
                                      '<td>'+'</td>'+
                                  '</tr>';
                        }
                          
                      }
                      $('#bodyTablaHaberes').append(wow);
                    }
                  }
                    
                  
                  if(datos['descuentos']){
                    for(var i=0; i < datos['descuentos'].length; i++){
                      let wow = '';
                      let agotados;
                      if( datos['descuentos'][i].pivot.duracion ){
                        $.ajax({
                              url: "{{ url('liquidaciones/dscto_a') }}",
                              method: 'POST',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                              },
                              data: {
                                'idContrato': datos['contrato'].id,
                                'idDscto': datos['descuentos'][0].id,
                              },
                              success: function(data){
                                agotados = JSON.parse(data) +1 ;
                                if(agotados <= datos['descuentos'][i].pivot.duracion){
                                  wow = '<tr>'+
                                            '<td id="id">'+datos['descuentos'][i].id+'</td>'+
                                            '<td >'+datos['descuentos'][i].nombre+' ('+agotados+'/'+datos['descuentos'][i].pivot.duracion+')</td>'+
                                            '<td id="tipo">'+datos['descuentos'][i].tipo+'</td>'+
                                            '<td id="valor">'+datos['descuentos'][i].valor+'</td>'+
                                            '<td>'+'<input class="form-control inputFecha" type="text" readonly value="'+moment( datos['descuentos'][i].pivot.fecha_inicio ).format('DD/MM/YYYY')+'" >'+'</td>'+
                                            '<td>'+'<input style="width:100px;" class="form-control" id="duracion" readonly min="1" value="'+datos['descuentos'][i].pivot.duracion+'"type="text">'+'</td>'+
                                        '</tr>';
                                }
                              },
                              error: function(jqXHR, textStatus){
                                  console.log(jqXHR.responseText);
                                  toastr.error('Ha ocurrido un error');
                              },
                              async: false

                        });
                        
                      } else{
                        if( moment(datos['fecha_inicio']).isAfter( datos['descuentos'][i].pivot.fecha_inicio ) ){
                          wow = '<tr>'+
                                      '<td id="id">'+datos['descuentos'][i].id+'</td>'+
                                      '<td >'+datos['descuentos'][i].nombre+'</td>'+
                                      '<td id="imp">'+datos['descuentos'][i].imp+'</td>'+
                                      '<td id="tipo">'+datos['descuentos'][i].tipo+'</td>'+
                                      '<td id="valor">'+datos['descuentos'][i].valor+'</td>'+
                                      '<td>'+'<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control inputFecha" type="text" ></div>'+'</td>'+
                                      '<td>'+'</td>'+
                                  '</tr>';
                        }
                          
                      }
                      $('#bodyTablaDescuentos').append(wow);
                    }
                  }
                    
                  reCalcular();
                },
                error: function(jqXHR, textStatus){
                    console.log(jqXHR.responseText);
                    toastr.error('Ha ocurrido un error');
                },
                async: false
              });
              $('#inputPeriodo').daterangepicker({
                opens: 'left',
                locale: { format: 'DD/MM/YYYY',
                          daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                              'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                              'Diciembre'],
                          applyLabel: 'Aplicar',
                          cancelLabel: 'Limpiar',
                          fromLabel: 'Desde',
                          toLabel: 'Hasta',
                        },
                
              },function(start, end, label){
                $('#hiddenStart').val(start.format('YYYY-MM-DD'));
                $('#hiddenEnd').val(end.format('YYYY-MM-DD'));
                $.ajax({
                    method: 'POST',
                    url: '{{url("horas_trabajadas")}}',
                    //url: '{{url("liquidaciones/generar")}}',
                    data: {
                      'idEmpleado': idEmpleado,
                      'inicio': start.format('YYYY-MM-DD'),
                      'fin': end.format('YYYY-MM-DD')
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
                    success: function(data){
                      $('#horasTrabajadas').val(JSON.parse(data));
                    },
                    error: function(jqXHR, textStatus){
                        console.log(jqXHR.responseText);
                        toastr.error('Ha ocurrido un error el llamar a metodo Horas Trabajadas');
                    },
                });
              });
        } );
        $('#tablaContratos').on( 'deselect.dt', function ( e, dt, type, indexes ) {
              $('#botonSiguiente').prop('disabled', true);
              $('.filaSelect').prop('hidden', true);
              
        } );
        $('#botonSiguiente').click(function(){
          console.log('El idEmpleado que se quiere enviar es: '+idEmpleado);
          $('#inputIdEmpleado').val(idEmpleado);

          $('#modalDetalle').modal();
          /*
          $.ajax({
                url: "{{ url('liquidaciones/data/detalles') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                },
                data: {
                  'periodo': fila[0].id,
                  'idEmpleado': ,
                },
                success: function(data){
                  datos = JSON.parse(data);

                },
                error: function(jqXHR, textStatus){
                    console.log(jqXHR.responseText);
                    toastr.error('Ha ocurrido un error');
                },
                async: false

          });
          */
          //$('#formLiquidacionManual').submit();
        });
        $('#botonAceptar').on('click', function(){
          console.log(idEmpleado);
          $.ajax({
                url: "{{ url('liquidaciones/generar') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                },
                data: {
                  'periodo': $('#hiddenStart').val()+' - '+$('#hiddenEnd').val(),
                  'idEmpleado': idEmpleado,
                  'mes': $('#inputMes').val(),
                },
                success: function(data){
                  datos = JSON.parse(data);

                },
                error: function(jqXHR, textStatus){
                    console.log(jqXHR.responseText);
                    toastr.error('Ha ocurrido un error');
                },
                async: false

          });
        });
        $('#botonGenerarPdf').on('click', funcionPDF);

    });
    

        function funcionPDF(){
          console.log('kaka');
        }
</script>
<!-- ChartJS -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('templates/AdminLTE-master')}}/dist/js/pages/dashboard2.js"></script>

@endsection