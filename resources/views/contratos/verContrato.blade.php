@extends('layouts.adminlte')
@section('css')
@endsection

@section('content')

<!-- Main content -->
<section class="invoice " id="contrato">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="glyphicon glyphicon-briefcase"></i>  Contrato de Trabajo #{{$contrato->id}}
        <div class="pull-right " ><small>Fecha de Inicio:<label><p style="color:red">*</p></label> <input readonly style="width:100px" type="text" value="{{$contrato->fecha_inicio}}"></small></div>
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
        <strong>RUT:</strong> {{$empresa->rut}}<br>
        <strong>Representante:</strong> {{$empresa->representante_nombre}}<br>
        <strong>Direccion:</strong> {{$empresa->direccion.', '.$empresa->ciudad.', '.$empresa->region.'.'}}<br>
        <strong>Telefono:</strong> {{$empresa->telefono}}<br>
        <strong>Email:</strong> {{$empresa->email}}
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <strong>Datos Empleado</strong>
      <address id="datosEmpleado">
      		{{$empleado->nombre}} {{$empleado->apellido_pat}} {{$empleado->apelido_mat}}<br>
            <strong>Cargo:</strong> {{$empleado->cargo}}<br>
            <strong>Titulo:</strong> {{$empleado->titulo}}<br>
            <strong>Direccion:</strong> {{$empleado->direccion}}, {{$empleado->ciudad}}<br>
            <strong>Contacto:</strong> {{$empleado->telefono}} - {{$empleado->celular}}<br>
            <strong>Email:</strong> {{$empleado->email}}<br>
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
          <input type="text"  class="form-control" readonly value="$ {{number_format($contrato->sueldo_base,0,',','.')}}">
      </div>
      <br>
      <div class="input-group">
          <label >Horas Semanales:</label>
          <input type="text" readonly class="form-control" min="1"  max="168" value="{{$contrato->horas_semanales}}"  placeholder="" >
      </div>
      <br>
      <div class="input-group">
          <label >Dias Semanales:</label>
          <input type="text" readonly max="7" min="1"  class="form-control" value="{{$contrato->dias_semanales}}"  placeholder="" >
      </div>
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
            <th style="width:100px;">Duracion (Meses)</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="bodyTablaHaberes">
        	@foreach( $contrato->habers()->get() as $haber )
        		<tr>
                    <td id="id">{{$haber->id}}</td>
                    <td>{{$haber->nombre}}</td>
                    <td id="imp">@if($haber->imponible)Si @else No @endif</td>
                    <td id="tipo">{{$haber->tipo}}</td>
                    <td id="valor">{{$haber->valor}}</td>
                    <td id="factor">{{$haber->factor}}</td>
                    <td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input value="{{$haber->pivot->fecha_inicio}}" class="form-control inputFecha" type="text" readonly></div></td>
                    <td><input style="width:100px;" class="form-control" id="duracion" readonly value="{{$haber->pivot->duracion}}" min="1" value="1"type="number"></td>
                </tr>
            @endforeach
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
            <th>Factor</th>
            <th style="width:150px;">Fecha inicio</th>
            <th style="width:100px;">Duracion (Meses)</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="bodyTablaDescuentos">
        	@foreach( $contrato->dsctos()->get() as $dscto )
        		<tr>
                    <td id="id">{{$dscto->id}}</td>
                    <td>{{$dscto->nombre}}</td>
                    <td id="tipo">{{$dscto->tipo}}</td>
                    <td id="valor">{{$dscto->valor}}</td>
                    <td id="factor">{{$dscto->factor}}</td>
                    <td><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input value="{{$dscto->pivot->fecha_inicio}}" class="form-control inputFecha" type="text" readonly></div></td>
                    <td><input style="width:100px;" class="form-control" id="duracion" readonly value="{{$dscto->pivot->duracion}}" min="1" value="1"type="number"></td>
                </tr>
            @endforeach
        </tbody>
      </table>
      
    </div>

    <!-- /.col -->
    
  </div>
  <!-- /.row Detalles Pago-->
  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Detalles de Pago al Empleado:</p>
      <p class="text-muted well well-sm no-shadow" id="pTipoCuenta" style="margin-top: 10px;">Tipo de Cuenta: {{$empleado->cta_banco_tipo}}</p>
      <p class="text-muted well well-sm no-shadow" id="pBancoCuenta" style="margin-top: 10px;">Nombre Banco: {{$empleado->cta_banco_nombre}}</p>
      <p class="text-muted well well-sm no-shadow" id="pCuenta" style="margin-top: 10px;">Nro de Cuenta: {{$empleado->cta_banco_nro}}</p>
      <p class="text-muted well well-sm no-shadow" id="pRut" style="margin-top: 10px;">RUT: {{$empleado->rut}}</p>
    </div>
    <!-- /.col -->
    <!--
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
	-->
    <!-- /.col -->

  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="#" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>
      
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> Generar PDF
      </button>
    </div>
  </div>
</section>
<!-- /.content -->


@endsection
@section('js')
<script>
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
</script>
@endsection