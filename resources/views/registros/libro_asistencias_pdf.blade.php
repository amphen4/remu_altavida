<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<h3 align="center">Registro de Asistencias </h3>

<table style="width:100%;">
	<tr>
		<td align="left"><strong>Nombre Empleado: </strong>  {{$empleado->nombre}}  {{$empleado->apellido_pat}}  {{$empleado->apellido_mat}}</td>
		<td></td>
		<td align="left"><strong>Periodo: </strong>  {{$desde}} - {{$hasta}}</td>
	</tr>
	
</table>
<br>
<table style="width:100%;">
	@foreach($asistencias as $asistencia)
	<tr>
		<td align="left"><strong>Entrada: </strong>  @if($asistencia['entrada']){{$asistencia['entrada']->hora}}@endif </td>
		<td></td>
		<td align="left"><strong>Salida: </strong>  @if($asistencia['salida']){{$asistencia['salida']->hora}}@endif</td>
	</tr>
	@endforeach
</table>


