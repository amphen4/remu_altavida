<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Registro de entrada y salida</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Toastr -->
        <link href="{{asset('js/toastr-master/build')}}/toastr.css" rel="stylesheet"/>
        <style type="text/css">
      
            @import url(https://fonts.googleapis.com/css?family=Roboto:300);
            input[type='number'] {
                  -moz-appearance:textfield;
              }

              input::-webkit-outer-spin-button,
              input::-webkit-inner-spin-button {
                  -webkit-appearance: none;
              }
            .login-page {
              width: 360px;
              padding: 8% 0 0;
              margin: auto;
            }
            .form {
              position: relative;
              z-index: 1;
              background: #FFFFFF;
              max-width: 360px;
              margin: 0 auto 100px;
              padding: 45px;
              text-align: center;
              box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            }
            .form input {
              font-family: "Roboto", sans-serif;
              outline: 0;
              background: #f2f2f2;
              width: 100%;
              border: 0;
              margin: 0 0 15px;
              padding: 15px;
              box-sizing: border-box;
              font-size: 14px;
            }
            .form button {
              font-family: "Roboto", sans-serif;
              text-transform: uppercase;
              outline: 0;
              background: #4CAF50;
              width: 100%;
              border: 0;
              padding: 15px;
              color: #FFFFFF;
              font-size: 14px;
              -webkit-transition: all 0.3 ease;
              transition: all 0.3 ease;
              cursor: pointer;
            }
            .form button:hover,.form button:active,.form button:focus {
              background: #43A047;
            }
            .form .message {
              margin: 15px 0 0;
              color: #b3b3b3;
              font-size: 12px;
            }
            .form .message a {
              color: #4CAF50;
              text-decoration: none;
            }
            .form .register-form {
              display: none;
            }
            .container {
              position: relative;
              z-index: 1;
              max-width: 300px;
              margin: 0 auto;
            }
            .container:before, .container:after {
              content: "";
              display: block;
              clear: both;
            }
            .container .info {
              margin: 50px auto;
              text-align: center;
            }
            .container .info h1 {
              margin: 0 0 15px;
              padding: 0;
              font-size: 36px;
              font-weight: 300;
              color: #1a1a1a;
            }
            .container .info span {
              color: #4d4d4d;
              font-size: 12px;
            }
            .container .info span a {
              color: #000000;
              text-decoration: none;
            }
            .container .info span .fa {
              color: #EF3B3A;
            }
            body {
              background: #0000FF; /* fallback for old browsers */
              background: -webkit-linear-gradient(right, #0000FF, #9A2EFE);
              background: -moz-linear-gradient(right, #0000FF, #5858FA);
              background: -o-linear-gradient(right, #0000FF, #9A2EFE);
              background: linear-gradient(to left, #0000FF, #9A2EFE);
              font-family: "Roboto", sans-serif;
              -webkit-font-smoothing: antialiased;
              -moz-osx-font-smoothing: grayscale;      
            }
        </style>
    </head>


    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand">
                        Corporación Altavida
                     
                    <h3>Registro de Ingresos</h3>
                    </a>
                </div>
            </nav>
        </div>
        <div class="login-page">
          <div class="form">
         
            
              <input type="number"  id="rut" pattern="[0-9]*"  autocomplete="new-password" class="form-control" placeholder="Ingrese su RUN (Sin puntos ni guión)."/>
              <input type="password"  pattern="[0-9]*" autocomplete="new-password" inputmode="numeric" minlength="4" maxlength="4" autocomplete="new-password" class="form-control" id="entradaPin" placeholder="Ingrese su PIN (Número de 4 dígitos)."/>
              <small id="passwordHelpBlock" class="form-text text-muted">
                Poner "Entrada" en el caso de no haber tenido un ingreso previo.
                Poner "Salida" Habiendo ingresado previamente al recinto.
              </small> 
              <br>
              <button onclick="enviarFormulario('entrada')" style="background:#00BFFF;margin-bottom: 30px;">Entrada</button>
              <br>
              <button onclick="enviarFormulario('salida')" style="background:#DF013A;">Salida</button>

            
          </div>
        </div>
    </body>

    
     

        
     
     
    <!-- Scripts -->

    <!-- jQuery 3 -->
    <script src="{{asset('templates/AdminLTE-master')}}/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="{{asset('templates/AdminLTE-master')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{asset('templates/AdminLTE-master')}}/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('templates/AdminLTE-master')}}/plugins/iCheck/icheck.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('templates/AdminLTE-master')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- FlexDataList -->
    <script src="{{asset('js/jquery-flexdatalist-2.2.4')}}/jquery.flexdatalist.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('templates/AdminLTE-master')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- Toastr -->
    <script src="{{asset('js/toastr-master/build')}}/toastr.min.js"></script>

    <script>
      function enviarFormulario(tipo)
      {
        if( $('#entradaPin').val() == '') { toastr.warning('Ingrese un pin');return; }
        if( $('#rut').val() == '') { toastr.warning('Ingrese un rut');return; }
        if(tipo == 'entrada'){
          $.ajax({
            method: 'POST',
            url: "{{url('ingreso')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} ,
            data: {
              'rut' : $('#rut').val(),
              'pin' : $('#entradaPin').val(),
              'tipo': tipo ,
            },
            success: function(data){
                if(JSON.parse(data).tipo == 'error'){
                  toastr.error( JSON.parse(data).mensaje );
                }else{
                  toastr.success( JSON.parse(data).mensaje );
                }
                //toastr.success('Se acaba de registrar con exito a las: '+JSON.parse(data).hora);
            },
            error: function(jqXHR, textStatus){
                console.log(jqXHR.responseText);
                toastr.error('Ha ocurrido un error');
            },
            async: false

          });
        }
        if(tipo == 'salida'){
          $.ajax({
            method: 'POST',
            url: "{{url('ingreso')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} ,
            data: {
              'rut' : $('#rut').val(),
              'pin' : $('#entradaPin').val(),
              'tipo': tipo ,
            },
            success: function(data){
                if(JSON.parse(data).tipo == 'error'){
                  toastr.error( JSON.parse(data).mensaje );
                }else{
                  toastr.success( JSON.parse(data).mensaje );
                }
                //toastr.success('Se acaba de registrar con exito a las: '+JSON.parse(data).hora);
            },
            error: function(jqXHR, textStatus){
                console.log(jqXHR.responseText);
                toastr.error('Ha ocurrido un error');
            },
            async: false

          });
        }
      }
      $(function() {
          /*
          $("#rut").rut().on('rutValido', function(e, rut, dv) {
              alert("El rut " + rut + "-" + dv + " es correcto");
          }, { minimumLength: 7} );
          */
      })
    </script>



    <script type="text/javascript">
    /* CONSULTA POR EMPLEADO CON PIN E ID 
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
          searchIn: ['rut','pin'],
          visibleProperties: ["nombre","apellido_pat",'apellido_mat'],
        });
    */ 

    </script>
    
     
     
    
</html>