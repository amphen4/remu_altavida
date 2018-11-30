<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<h3 align="center">Liquidación de Remuneraciones</h3>

<table style="width:100%;">
	<tr>
		<td align="left"><strong>Sucursal: </strong>  Corporación Altavida</td>
		<td></td>
		<td align="left"><strong>Mes: </strong>  {{$liquidacion->nombre_mes.', '.$ano}}</td>
	</tr>
	<tr>
		<td align="left"><strong>Empresa: </strong> Corporación Altavida</td>
		<td></td>
		<td align="left"><strong>RUT: </strong> 65.076.242-8</td>
	</tr>
	<tr>
		<td align="left"><strong>Trabajador Sr(a): </strong> {{$liquidacion->empleado()->first()->nombre.' '.$liquidacion->empleado()->first()->apellido_pat.' '.$liquidacion->empleado()->first()->apellido_mat}}</td>
		<td></td>
		<td align="left"><strong>Contrato: </strong> {{$liquidacion->contrato()->first()->id}}</td>
	</tr>
	<tr>
		<td align="left"><strong>RUT: </strong> {{$liquidacion->empleado()->first()->rut}}</td>
		<td align="left"><strong>Código: </strong> {{$liquidacion->empleado()->first()->id}}</td>
		<td align="left"><strong>Centro de costo: </strong> CASA MATRIZ</td>
	</tr>
	<tr>
		<td align="left"><strong>Fecha de contrato: </strong> {{$liquidacion->contrato()->first()->fecha_inicio}}</td>
		<td></td>
		<td align="left"><strong>Cargo: </strong> {{$liquidacion->empleado()->first()->cargo}}</td>
	</tr>
	<tr>
		<td align="left"><strong></strong> </td>
		<td></td>
		<td align="left"><strong>Valor U.F.:</strong> {{number_format($valor_uf, 0, ',', '.')}}</td>
	</tr>
	<tr>
		<td align="left"><strong>Dias Trabajados: </strong> {{$liquidacion->dias_trabajados}}</td>
		<td></td>
		<td align="left"><strong>Cotización Pactada: </strong> @if($liquidacion->empleado()->first()->afp()->first()->nombre != 'FONASA'){{$liquidacion->empleado()->first()->cotizacion_pactada}} U.F @endif</td>
	</tr>
	<tr>
		<td align="left"><strong></strong> </td>
		<td></td>
		<td align="left"><strong></strong> </td>
	</tr>
	
</table>
<hr>
<h4 align="center">Haberes</h4>
<table style="width: 100%;">
	<tr>
		<td align="left">Sueldo Base</td>
		<td align="right">$ {{number_format($liquidacion->contrato()->first()->sueldo_base, 0, ',', '.')}}</td>
	</tr>
	@foreach($haberes['haberes'] as $haber)
	@if($haber->imponible && ($haberes['agotados'][$loop->index] < $haber->pivot->duracion || !$haber->pivot->duracion) )
	<tr>
		<td align="left">{{$haber->nombre}}</td>
		@if($haber->tipo == 'MONTO')
		<td align="right">$ {{$haber->valor}}</td>
		@endif
		@if($haber->tipo == 'PORCENTAJE SUELDO BASE')
		<td align="right">$ {{number_format(($haber->valor_porcentaje/100)*$liquidacion->contrato()->first()->sueldo_base, 0, ',', '.')}}</td>
		@endif
		@if($haber->tipo == 'UF')
		<td align="right">$ {{number_format($haber->valor_porcentaje*$valor_uf, 0, ',', '.')}}</td>
		@endif
		@if($haber->tipo == 'UTM')
		<td align="right">$ {{number_format($haber->valor_porcentaje*$valor_utm, 0, ',', '.')}}</td>
		@endif
	</tr>
	@endif
	@endforeach
	<tr>
		<td></td>
		<td align="right"><strong>Total Imponible: </strong> $ {{number_format($liquidacion->total_imponible, 0, ',', '.')}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	@foreach($haberes['haberes'] as $haber)
	@if(!$haber->imponible && ($haberes['agotados'][$loop->index] < $haber->pivot->duracion || !$haber->pivot->duracion) && $haberes['despues'][$loop->index])
	<tr>
		<td align="left">{{$haber->nombre}}</td>
		@if($haber->tipo == 'MONTO')
		<td align="right">$ {{$haber->valor}}</td>
		@endif
		@if($haber->tipo == 'PORCENTAJE SUELDO BASE')
		<td align="right">$ {{number_format(($haber->valor_porcentaje/100)*$liquidacion->contrato()->first()->sueldo_base, 0, ',', '.')}}</td>
		@endif
		@if($haber->tipo == 'UF')
		<td align="right">$ {{number_format($haber->valor_porcentaje*$valor_uf, 0, ',', '.')}}</td>
		@endif
		@if($haber->tipo == 'UTM')
		<td align="right">$ {{number_format($haber->valor_porcentaje*$valor_utm, 0, ',', '.')}}</td>
		@endif
	</tr>
	@endif
	@endforeach
	<tr>
		<td></td>
		<td align="right"><strong>Total No Imponible: </strong> $ {{number_format($liquidacion->total_no_imponible, 0, ',', '.')}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><strong>Total Haberes: </strong> $ {{number_format($liquidacion->total_haberes, 0, ',', '.')}}</td>
	</tr>

</table>
<hr>
<h4 align="center">Descuentos</h4>
<table style="width: 100%;">
	<tr>
		<td align="left">Salud: {{$liquidacion->nombre_salud.''}}</td>
		<td align="right">$ {{number_format($liquidacion->total_salud, 0, ',', '.')}}</td>
	</tr>
	<tr>
		<td align="left">AFP: {{$liquidacion->nombre_afp.'('.number_format($liquidacion->tasa_afp, 2, ',', '.').'%)'}}</td>
		<td align="right">$ {{number_format($liquidacion->total_afp, 0, ',', '.')}}</td>
	</tr>
	<tr>
		<td align="left">Impuesto Unico 2da Cat. ()</td>
		<td align="right">$ {{number_format($liquidacion->impuesto_renta, 0, ',', '.')}}</td>
	</tr>
	@foreach($descuentos['descuentos'] as $haber)
	@if(($descuentos['agotados'][$loop->index] < $haber->pivot->duracion || !$haber->pivot->duracion) && $descuentos['despues'][$loop->index] )
	<tr>
		<td align="left">{{$haber->nombre}}</td>
		@if($haber->tipo == 'MONTO')
		<td align="right">$ {{$haber->valor}}</td>
		@endif
		@if($haber->tipo == 'PORCENTAJE SUELDO BASE')
		<td align="right">$ {{number_format(($haber->valor_porcentaje/100)*$liquidacion->contrato()->first()->sueldo_base, 0, ',', '.')}}</td>
		@endif
		@if($haber->tipo == 'UF')
		<td align="right">$ {{number_format($haber->valor_porcentaje*$valor_uf, 0, ',', '.')}}</td>
		@endif
		@if($haber->tipo == 'UTM')
		<td align="right">$ {{number_format($haber->valor_porcentaje*$valor_utm, 0, ',', '.')}}</td>
		@endif
	</tr>
	@endif
	@endforeach
	<tr>
		<td></td>
		<td align="right"><strong>Total Descuentos: </strong> $ {{number_format($liquidacion->total_descuentos, 0, ',', '.')}}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>

</table>
<hr>
<table style="width:100%;">
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><strong>Total Liquido: </strong> $ {{number_format($liquidacion->monto_liquido, 0, ',', '.')}}</td>
	</tr>
	<br>
	<tr>
		<td align="left"><strong>Son: </strong> {{$monto_palabras}}</td>
		<td></td>
	</tr>
</table>

Certifico que he recibido de CORPORACION ALTAVIDA, a mi entera satisfacción el saldo indicado en la presente liquidación y no tengo cargo ni cobros posteriores que hacer.
<br><br>
<table style="width:100%;">
	<tr>
		<td align="left">Fecha de emisión: {{$fecha}}</td>
		<td align="right"></td>
	</tr>
</table>
<table style="width:100%;">
	<tr>
		<td align="left"></td>
		<td align="right">___________________<br>He recibido conforme</td>
	</tr>
</table>
