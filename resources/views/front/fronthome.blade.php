

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="CatatanDosa">
      <meta name="author" content="CatatanDosa">
      <link rel="icon" href="{{ asset('img/logocatol_kecil.png') }}" type="image/x-icon" />
      <title>CatatanDosa</title>
      <link rel="manifest" href="{{ asset('manifest.json') }}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
      <!-- Google Icons -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
      @stack('styles')
   </head>
   <body>
      <!-- As a heading -->
      <nav class="navbar fixed-top navbar-white bg-white">
         <h2 class="navbar-brand mb-0">
             Catatan Dosa
             
        </h2>
            @if (Route::has('login'))
                <div class="top-right links" style="font-size:12px;">
                    @auth
                        You Logged as 
                        <a class="badge badge-primary text-white"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           {{ strtoupper(Auth::user()->name) }} <span class="caret"></span>
                        </a>
                        &nbsp;
                        
                            <a class="badge badge-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        

                            

                    @else
                        <a href="{{ route('login') }}">Login</a>
                        
                        &nbsp; or &nbsp; 

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
      </nav>
     
      <!-- Begin page content -->
      <div class="container-fluid">





       @include('front/frontcontent')
       @include('front/frontbottom') 





      </div>



      <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
     
   </body>
</html>

