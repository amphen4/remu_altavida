@extends('layouts.adminlte')
@section('css')
<link rel='stylesheet' href="{{ asset('js/fullcalendar-3.9.0/fullcalendar.min.css') }}" />
@endsection
@section('content')
    <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
          <div id='calendar' class="col-lg-10"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
@endsection
@section('js')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-sm-1 control-label">Nota</label>
          <div class="col-sm-11">
            <textarea id="nota" class="form-control" style="height:55px;"> </textarea>
          </div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!--<script src="{{ asset('js/moment.js-2.22.2/moment.min.js') }}"></script>-->
<!--<script src="{{ asset('js/fullcalendar-3.9.0/lib/jquery.min.js') }}"></script>-->
<script src="{{ asset('js/fullcalendar-3.9.0/lib/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar-3.9.0/fullcalendar.js') }}"></script>
<script src="{{ asset('js/fullcalendar-3.9.0/locale-all.js') }}"></script>
<script>
$(function() {
  calendar = 
  $('#calendar').fullCalendar({
    events: "{{url('data/eventos')}}",
    selectable: true,
    locale: 'es',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Deciembre'],
    firstDay: 1,
    themeSystem: 'bootstrap3',
    select: function(start, end, jsEvent, view){
      $('#myModal').modal('show');

      if(end.diff(start,'days') > 1){
        $('#myModalLabel').html('Nuevo evento ('+start.format('DD-MM-YYYY')+' - '+end.subtract(1, 'seconds').format('DD-MM-YYYY')+')');
      } else { $('#myModalLabel').html('Nuevo evento ('+start.format('DD-MM-YYYY')+')');  }
      $('#btnGuardar').on('click',function(){
        var nota = $("#nota").val();
        var inicio = moment(start).format("Y-MM-DD HH:mm:ss");
        var fin = moment(end).format("Y-MM-DD HH:mm:ss");
        $.ajax({
                url: '{{url("data/eventos/save")}}',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'evento='+ nota+'&start='+ inicio +'&end='+ fin,
                type: "POST",
                success: function(json){ }, 
                error: function(xhr, status, error) {
                  alert(error+' '+status+' '+xhr);
                  console.log(xhr.responseText);
                }
             });
        calendar.fullCalendar('renderEvent', {
          title: nota,
          start: start,
          end: end,
          },
          true // make the event "stick"
        );
        calendar.fullCalendar('unselect');
        $('#myModal').modal('hide');
        var nota = $("#nota").val('');
      })
    }
  });

});

</script>
@endsection