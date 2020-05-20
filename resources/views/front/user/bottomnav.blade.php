

<!-- Bottom Nav Bar -->

     @auth    

     <footer class="footer">
        <div id="buttonGroup" class="btn-group selectors" role="group" aria-label="Basic example">
          
           
           <button id="dosa" type="button" class="btn btn-secondary button-active">
              <div class="selector-holder">
                 <i class="material-icons">thumb_down_alt</i>
                 <span>Dosa</span>
              </div>
           </button>
           <button id="pahala" type="button" class="btn btn-secondary button-inactive">
              <div class="selector-holder">
                 <i class="material-icons">thumb_up_alt</i>
                 <span>Pahala</span>
              </div>
           </button>
           <button id="account" type="button" class="btn btn-secondary button-inactive">
              <div class="selector-holder">
                 <i class="material-icons">account_circle</i>
                 <span>Profile</span>
              </div>
           </button>
        </div>
     </footer>

     @else
     <br><br><br>
     <div style="margin: 0" class="" align="center">
       <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
       &nbsp; or  &nbsp;
       @if (Route::has('register'))
           <a class="btn btn-success" href="{{ route('register') }}">Register</a>
       @endif
   </div>
     @endauth

