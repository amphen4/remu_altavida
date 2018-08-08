@extends('layouts.adminlte')
@section('css')
<!-- Toastr -->
<link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/plugins/iCheck/flat/_all.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- FlexDataList -->
<link rel="stylesheet" href="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.css">
@endsection
@section('cabecera','Crear Contrato')
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
          <span class="input-group-addon"><strong>Seleccione un Empleado:</strong></span>
          <input type="text" id="inputBusqueda" class="form-control" placeholder="Ingrese un nombre o apellido">
          
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
<!-- Main content -->
<section class="invoice hidden" id="contrato">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="glyphicon glyphicon-briefcase"></i>  Contrato de Trabajo
        <small class="pull-right" id="hoy">Date: 2/10/2014 </small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <strong>Datos Empresa</strong>
      <address>
        {{$empresa->nombre}}<br>
        RUT: {{$empresa->rut}}<br>
        San Francisco, CA 94107<br>
        Phone: (804) 123-5432<br>
        Email: info@almasaeedstudio.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <strong>Datos Empleado</strong>
      <address>
        John Doe<br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        Phone: (555) 539-1037<br>
        Email: john.doe@example.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <!--
      <b>Invoice #007612</b><br>
      <br>
      <b>Order ID:</b> 4F3S8J<br>
      <b>Payment Due:</b> 2/22/2014<br>
      <b>Account:</b> 968-34567 -->
      <div class="input-group">
          <label >Sueldo Base:</label>
          <input type="text" id="inputSueldoBase" class="form-control" name="nombre" placeholder="" required>
      </div>
      <br>
      <b>AFP:</b> <b id="bAfp"></b><br>
      <b>Isapre:</b> <b id="bIsapre"></b><br>
    </div>
    <!-- /.col -->
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
            <th>Factor</th>
            <th style="width:150px;">Fecha inicio</th>
            <th style="width:100px;">Duracion</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="bodyTablaHaberes">
        </tbody>
      </table>
      <button data-toggle="modal" data-target="#exampleModalHaberes" class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Agregar Haberes</button>
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
            <th>Factor</th>
            <th style="width:150px;">Fecha inicio</th>
            <th style="width:100px;">Duracion</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="bodyTablaDescuentos">
        </tbody>
      </table>
      <button data-toggle="modal" data-target="#exampleModalDescuentos" class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Agregar Descuentos</button>
    </div>

    <!-- /.col -->
    
  </div>
  <!-- /.row Detalles Pago-->
  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Detalles de Pago al Empleado:</p>

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Aqui cargar datos del empleado.
      </p>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <p class="lead">Resumen Contable</p>

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
            <th>Descuento AFP:</th>
            <td id="descuentoAfp"></td>
          </tr>
          <tr>
            <th>Descuento Isapre:</th>
            <td id="descuentoIsapre"></td>
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
      <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>
      <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Guardar Contrato
      </button>
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> Generar PDF
      </button>
    </div>
  </div>
</section>
<!-- /.content -->
<!-- Modal Haberes-->
<div class="modal fade bd-example-modal-lg" id="exampleModalHaberes"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Haberes al Contrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Seleccione uno o mas haberes para agregar:</h3>
                      <div class="pull-right">
                        <button class="btn btn-primary" id="botonActualizarDataHaberes" ><i class="fa fa-refresh"></i> <strong>Actualizar</strong></button>
                        <button data-toggle="modal" data-target="#exampleModalCrearHaber" class="btn btn-success" ><i class="fa fa-plus"></i> Crear Haber</button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="tablaAgregarHaberes" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <!--<th style="width:90px">Opciones</th>-->
                            <th>Nombre Haber</th>
                            <th>Imponible?</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Factor (opcional)</th>
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
        <button type="button" id="botonCerrarHaberes" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="botonAgregarHaberes" class="btn btn-success">Agregar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal Descuentos-->
<div class="modal fade bd-example-modal-lg" id="exampleModalDescuentos"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Descuentos al Contrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Seleccione uno o mas descuentos para agregar:</h3>
                      <div class="pull-right">
                        <button class="btn btn-primary" id="botonActualizarDataDescuentos" ><i class="fa fa-refresh"></i> <strong>Actualizar</strong></button>
                        <button data-toggle="modal" data-target="#exampleModalCrearDescuento" class="btn btn-success" ><i class="fa fa-plus"></i> Crear Descuento</button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="tablaAgregarDescuentos" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <!--<th style="width:90px">Opciones</th>-->
                            <th>Nombre Descuento</th>
                            <!--<th>Imponible?</th>-->
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Factor (opcional)</th>
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
        <button type="button"  id="botonCerrarDescuentos" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="botonAgregarDescuentos" class="btn btn-success">Agregar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Crear haber-->
<div class="modal fade" id="exampleModalCrearHaber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Haber</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" class="form-horizontal" id="formularioHaber" method="POST" >
          @csrf
          <div class="box-body">
              <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                        <label >Nombre:</label><label><p style="color:red">*</p></label>
                        <input type="text" class="form-control" name="nombre" placeholder="" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <label >Tipo:</label><label><p style="color:red">*</p></label>
                        <select id="tipoHaber" class="form-control" name="tipo" required>
                          <option selected="selected">MONTO</option>
                          <option>PORCENTAJE</option>
                        </select>
                    </div>
                </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                        <label >Factor:</label><label><p style="color:red">*</p></label>
                        <select class="form-control" name="factor" required>
                          <option selected="selected">NINGUNO</option>
                          <option>SUELDO BASE</option>
                          <option>UF</option>
                          <option>UTM</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <label >Valor:</label><label><p style="color:red">*</p></label>
                        <input type="text" class="form-control " id="input-decimales-haberes" name="valor" placeholder="" required>
                    </div>
                </div>
              </div>
              <br>

              <div class="row">
                  <div class="col-lg-12">
                      <div class="input-group">
                        <label>
                        <input type="checkbox" name="imponible" class="flat-red" checked>
                        Imponible
                        </label>
                      </div>
                  </div>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="botonCancelarHaber" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="formularioHaber" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Crear descuento-->
<div class="modal fade" id="exampleModalCrearDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Descuento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" class="form-horizontal" id="formularioDescuento" method="POST" >
          @csrf
          <div class="box-body">
              <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                        <label >Nombre:</label><label><p style="color:red">*</p></label>
                        <input type="text" class="form-control" name="nombre" placeholder="" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <label >Tipo:</label><label><p style="color:red">*</p></label>
                        <select id="tipoDescuento" class="form-control" name="tipo" required>
                          <option selected="selected">MONTO</option>
                          <option>PORCENTAJE</option>
                        </select>
                    </div>
                </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                        <label >Factor:</label><label><p style="color:red">*</p></label>
                        <select class="form-control" name="factor" required>
                          <option selected="selected">NINGUNO</option>
                          <option>SUELDO BASE</option>
                          <option>UF</option>
                          <option>UTM</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <label >Valor:</label><label><p style="color:red">*</p></label>
                        <input type="text" class="form-control " id="input-decimales-descuentos" name="valor" placeholder="" required>
                    </div>
                </div>
              </div>
              <br>
              <!--
              <div class="row">
                  <div class="col-lg-12">
                      <div class="input-group">
                        <label>
                        <input type="checkbox" name="imponible" class="flat-red" checked>
                        Imponible
                        </label>
                      </div>
                  </div>
              </div>
              -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="botonCancelarDescuento" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="formularioDescuento" class="btn btn-primary">Guardar</button>
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
<script src="{{ asset('js/fullcalendar-3.9.0/lib/moment.min.js') }}"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('templates/AdminLTE-master')}}/plugins/iCheck/icheck.min.js"></script>
<!-- Cleave -->
<script src="{{ asset('js/cleave.js-master/dist/cleave.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- FlexDataList -->
<script src="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.js"></script>
<script>
  
$(document).ready(function(){
  $('#divLoading').hide();
  $('#perfil').hide();

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
    $('#contrato').removeClass('hidden');
    cargarContrato(set.id);
    reCalcular();
  });
  var afp_porcentaje = 0;
  var isapre_porcentaje = 0;
  function cargarContrato(id){
    $('#contrato').fadeOut();
    $('#contrato').hide();
    setTimeout(function(){1==1},100);
    $('#divLoading').show();
    $.ajax({
      url: "{{url('data/empleados')}}"+"/"+id,
      method: "GET",
      success: function(data){
        var datos = JSON.parse(data);
        $('#bAfp').html(datos.afp_nombre+' ('+datos.afp_porcentaje+'%)');
        $('#bIsapre').html(datos.isapre_nombre+' ('+datos.isapre_porcentaje+'%)');
        afp_porcentaje = parseFloat(datos.afp_porcentaje);
        isapre_porcentaje = parseFloat(datos.isapre_porcentaje);
        $('#divLoading').hide();
        $('#contrato').fadeIn();
        
      },
      error: function(jqXHR, textStatus){
        console.log(jqXHR.responseText);
        $('#divLoading').hide();
      },
      async: false
    });
  }

  var contador = 0;
  $('#inputSueldoBase').on('change',function(){
    reCalcular();
  });
  $('#hoy').html('Fecha: '+moment().format('YYYY-MM-DD'));
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  });
  var algo_haber = new Cleave('#input-decimales-haberes', {
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralDecimalScale: 0
      });
  var algo_descuento = new Cleave('#input-decimales-descuentos', {
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralDecimalScale: 0
      });
  var sueldo_base = new Cleave('#inputSueldoBase', {
          prefix: '$ ',
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralDecimalScale: 0

      });
  function reCalcular(){
      console.log('se invoco la funcion reCalcular()');
      var totalHaberesImponibles = 0;
      var valorUf = 27000;
      var valorUtm = 50000;
      var sueldoBase = parseInt( (sueldo_base.getRawValue().slice(2)=='')?'0':sueldo_base.getRawValue().slice(2) );
      var total = 0;
      var total_imponible = 0;
      total_imponible += sueldoBase;
      var total_no_imponible = 0;
      $('#bodyTablaHaberes > tr').each(function(){
        //var totalHaberesImponibles +=  sueldo_base.getRawValue();
        if( $(this).find('#imp').html() == 'Si' ){
          if($(this).find('#tipo').html() == 'MONTO'){
            total_imponible += parseInt( $(this).find('#valor').html().replace('.','') );
          }else{
            if( $(this).find('#factor').html() == 'SUELDO BASE'){
              total_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * sueldoBase;
            }
            if( $(this).find('#factor').html() == 'UF'){
              total_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * valorUf;
            }
            if( $(this).find('#factor').html() == 'UTM'){
              total_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * valorUtm;
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
            if( $(this).find('#factor').html() == 'SUELDO BASE'){
              total_no_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * sueldoBase;
            }
            if( $(this).find('#factor').html() == 'UF'){
              total_no_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * valorUf;
            }
            if( $(this).find('#factor').html() == 'UTM'){
              total_no_imponible += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * valorUtm;
            }
          }
        }
        
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
          if( $(this).find('#factor').html() == 'SUELDO BASE'){
            total_descuentos += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * sueldoBase;
          }
          if( $(this).find('#factor').html() == 'UF'){
            total_descuentos += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * valorUf;
          }
          if( $(this).find('#factor').html() == 'UTM'){
            total_descuentos += (parseFloat( $(this).find('#valor').html().replace(',','.') )/100) * valorUtm;
          }
        }
      });

      $('#totalOtrosDescuentos').html( '$ '+ total_descuentos.toLocaleString('de-DE'));
      var total_descuento_afp = total_imponible * (afp_porcentaje/100);
      var total_descuento_isapre = total_imponible * (isapre_porcentaje/100);
      total_descuentos += total_descuento_afp;
      total_descuentos += total_descuento_isapre;
      $('#descuentoAfp').html( '$ '+total_descuento_afp.toLocaleString('de-DE') );
      $('#descuentoIsapre').html( '$ '+total_descuento_isapre.toLocaleString('de-DE') );
      $('#totalDescuentos').html( '$ '+ total_descuentos.toLocaleString('de-DE'));
      var totalAPagar = total_haberes - total_descuentos;
      $('#totalAPagar').html( '$ '+ totalAPagar.toLocaleString('de-DE'));
      //console.log(valor);
  }

  $('#tipoHaber').change(function(){
    console.log($(this).val());
    if( $(this).val() == 'MONTO' ){
      //document.getElementById("formularioHaber").elements.namedItem("valor").value = '';
      $('#input-decimales-haberes').val('');
      algo_haber.destroy();
      algo_haber = new Cleave('#input-decimales-haberes', {
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralDecimalScale: 0
      });
    }else{
      //document.getElementById("formularioHaber").elements.namedItem("valor").value = '';
      $('#input-decimales-haberes').val('');
      algo_haber.destroy();
      algo_haber = new Cleave('#input-decimales-haberes', {
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralIntegerScale: 2,
          numeralDecimalScale: 3,
          numeralPositiveOnly: true
      });
    }
  })
  
  $('#tipoDescuento').change(function(){
    console.log($(this).val());
    if( $(this).val() == 'MONTO' ){
      //("#formularioDescuento").find('input[name="valor"]').val('');
      $('#input-decimales-descuentos').val('');
      algo_descuento.destroy();
      algo_descuento = new Cleave('#input-decimales-descuentos', {
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralDecimalScale: 0
      });
    }else{
      //document.getElementById("formularioDescuento").elements.namedItem("valor").value = '';
      $('#input-decimales-descuentos').val('');
      algo_descuento.destroy();
      algo_descuento = new Cleave('#input-decimales-descuentos', {
          numeral: true,
          numeralDecimalMark: ',',
          delimiter: '.',
          numeralIntegerScale: 2,
          numeralDecimalScale: 3,
          numeralPositiveOnly: true
      });
    }
  })

  var tablaAgregarHaberes = $('#tablaAgregarHaberes').DataTable({
    select: true,
    processing: true,
    "ajax": "{{url('haberes/data')}}",
    "columns": [
          { "data": "nombre" },
          { "data": "imp" },
          { "data": "tipo" },
          { "data": "valor" },
          { "data": "factor" }
      ],
  });

  var tablaAgregarDescuentos = $('#tablaAgregarDescuentos').DataTable({
    select: true,
    processing: true,
    "ajax": "{{url('descuentos/data')}}",
    "columns": [
          { "data": "nombre" },
          //{ "data": "imp" },
          { "data": "tipo" },
          { "data": "valor" },
          { "data": "factor" }
      ],
  });

  $('#botonAgregarHaberes').on('click',function(){
    var arreglo = tablaAgregarHaberes.rows( { selected: true } ).data();
    for(var i=0; i<arreglo.length; i++){
      var wow = '<tr>'+
                    '<td id="id">'+arreglo[i].id+'</td>'+
                    '<td >'+arreglo[i].nombre+'</td>'+
                    '<td id="imp">'+arreglo[i].imp+'</td>'+
                    '<td id="tipo">'+arreglo[i].tipo+'</td>'+
                    '<td id="valor">'+arreglo[i].valor+'</td>'+
                    '<td id="factor">'+ ((arreglo[i].factor == null)? '':arreglo[i].factor) +'</td>'+
                    '<td>'+'<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" type="text" id="datepickerHaber'+(contador)+'"></div>'+'</td>'+
                    '<td>'+'<input style="width:100px;" class="form-control" disabled min="1" value="1"type="number">'+'</td>'+
                    '<td>'+'<div class="input-group"><input type="checkbox" class="flat-red checkboxDuracion"  unchecked></label></div>'+'</td>'+
                    '<td>'+'<button class="btn btn-xs btn-danger botonEliminarFila" >X</button>'+'</td>'+
                '</tr>';
      $('#bodyTablaHaberes').append(wow);
      var cake = $('#datepickerHaber'+(contador)).datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
      cake.val(moment().format('YYYY-MM-DD'));
      contador++;
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      });
    }
    tablaAgregarHaberes.rows( { selected: true } ).deselect();
    $('#botonCerrarHaberes').click();
    $('.checkboxDuracion').on('ifChecked', function(event){
      $(this).parent().parent().parent().parent().find('td > input[type="number"]').prop("disabled", false);
    });
    $('.checkboxDuracion').on('ifUnchecked', function(event){
      $(this).parent().parent().parent().parent().find('td > input[type="number"]').prop("disabled", true);
    });
    $('.botonEliminarFila').on('click', function(){
      $(this).parent().parent().remove();
      reCalcular();
    });
    reCalcular();
  });
  $('#botonAgregarDescuentos').on('click',function(){
    var arreglo = tablaAgregarDescuentos.rows( { selected: true } ).data();
    for(var i=0; i<arreglo.length; i++){
      var wow = '<tr>'+
                    '<td id="id">'+arreglo[i].id+'</td>'+
                    '<td>'+arreglo[i].nombre+'</td>'+
                    //'<td>'+arreglo[i].imp+'</td>'+
                    '<td id="tipo">'+arreglo[i].tipo+'</td>'+
                    '<td id="valor">'+arreglo[i].valor+'</td>'+
                    '<td id="factor">'+ ((arreglo[i].factor == null)? '':arreglo[i].factor) +'</td>'+
                    '<td>'+'<div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input class="form-control" type="text" id="datepickerDescuento'+(contador)+'"></div>'+'</td>'+
                    '<td>'+'<input style="width:100px;" class="form-control" disabled min="1" value="1"type="number">'+'</td>'+
                    '<td>'+'<div class="input-group"><input type="checkbox" class="flat-red checkboxDuracion"  unchecked></label></div>'+'</td>'+
                    '<td>'+'<button class="btn btn-xs btn-danger botonEliminarFila" >X</button>'+'</td>'+
                '</tr>';
      $('#bodyTablaDescuentos').append(wow);
      var cake = $('#datepickerDescuento'+(contador)).datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
      cake.val(moment().format('YYYY-MM-DD'));
      contador++;
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      });
    }
    tablaAgregarDescuentos.rows( { selected: true } ).deselect();
    $('#botonCerrarDescuentos').click();
    $('.checkboxDuracion').on('ifChecked', function(event){
      $(this).parent().parent().parent().parent().find('td > input[type="number"]').prop("disabled", false);
    });
    $('.checkboxDuracion').on('ifUnchecked', function(event){
      $(this).parent().parent().parent().parent().find('td > input[type="number"]').prop("disabled", true);
    });
    $('.botonEliminarFila').on('click', function(){
      $(this).parent().parent().remove();
      reCalcular();
    });
  reCalcular();
  });
  $('#botonActualizarDataHaberes').on('click',function(){
    tablaAgregarHaberes.ajax.reload();
  })
  $('#botonActualizarDataDescuentos').on('click',function(){
    tablaAgregarDescuentos.ajax.reload();
  })
  $('#formularioHaber').on('submit',function(event){
    event.preventDefault();
    $.ajax({
      url: "{{url('/haberes/')}}",
      method: "POST",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
          'nombre': document.getElementById("formularioHaber").elements.namedItem("nombre").value,
          'tipo': document.getElementById("formularioHaber").elements.namedItem("tipo").value,
          'factor': document.getElementById("formularioHaber").elements.namedItem("factor").value,
          'valor': document.getElementById("formularioHaber").elements.namedItem("valor").value,
          'imponible': document.getElementById("formularioHaber").elements.namedItem("imponible").checked
      },
      success: function(data){
        toastr.success('El haber ha sido agregado con exito');
        $('#botonCancelarHaber').click();
        tablaAgregarHaberes.ajax.reload();
      },
      error: function(jqXHR, textStatus){
        console.log(jqXHR.responseText);
      },
      async: false
    });
  });
  $('#formularioDescuento').on('submit',function(event){
    event.preventDefault();
    $.ajax({
      url: "{{url('/descuentos/')}}",
      method: "POST",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
          'nombre': document.getElementById("formularioDescuento").elements.namedItem("nombre").value,
          'tipo': document.getElementById("formularioDescuento").elements.namedItem("tipo").value,
          'factor': document.getElementById("formularioDescuento").elements.namedItem("factor").value,
          'valor': document.getElementById("formularioDescuento").elements.namedItem("valor").value,
          //'imponible': document.getElementById("formularioDescuento").elements.namedItem("imponible").checked
          'imponible': 'false'
      },
      success: function(data){
        toastr.success('El haber ha sido agregado con exito');
        $('#botonCancelarDescuento').click();
        tablaAgregarDescuentos.ajax.reload();
      },
      error: function(jqXHR, textStatus){
        console.log(jqXHR.responseText);
      },
      async: false
    });
  });

});
</script>
@endsection