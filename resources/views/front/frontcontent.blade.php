         <!-- Home page -->
         <div id="page-home" class="active">

            <br>
            <div align="center">

                @include('front/frontStatistik')
                <br>
                <br>
                <br>
                  @auth

                        

                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                        
                        &nbsp; or &nbsp; 

                        @if (Route::has('register'))
                            <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        @endif
                  @endauth
            </div>

          </div>