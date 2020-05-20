

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="CatatanDosa">
      <meta name="author" content="CatatanDosa">
      <title>CatatanDosa</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="{{ asset('img/logocatol_kecil.png') }}" type="image/x-icon" />
      <script src="{{ asset('front/css/jquery.min.js') }}"></script>
      <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
      <!-- Google Icons -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
      <style>
          .smalltext{
              font-size: 14px;
          }
          
      </style>
   </head>
   <body>
      <!-- As a heading -->
      <nav class="navbar fixed-top navbar-white bg-white">
         <h2 class="navbar-brand mb-0"><a href="/">CatatanDosa</a></h2>
         <a href="/user">
            <span class="material-icons">
                update
            </span>
          </a>         

            @if (Route::has('login'))
                <div class="top-right links smalltext">
                    @auth
                        
                        <a class="badge badge-primary text-white"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ strtoupper(Auth::user()->name) }}
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
        <br>


        <?php

             $itemCount = count($items);
         
         ?>   


       
            <form class="form-inline">
                <input type="text" id="title" value="" class="form-control" placeholder="Contoh:Sedekah">  &nbsp;
                <input type="button" name="submit" value="Tambah" onclick="createNewItem(currentPageId == 'page-dosa' ? 1 : 2)" class="btn btn-light">  
            </form>
        



         @include('front/user/tab_dosa') 
         @include('front/user/tab_pahala') 
         @include('front/user/tab_account') 

      </div>


      {{-- <form>
        @csrf
        <input type="hidden" name="_method" value="PUT">
          <button id="wokeoke" onclick="addButton(35)">SAVE</button>
      </form> --}}



      @include('front/user/bottomnav') 

      <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="{{ asset('front/js/bootstrap.min.js') }}" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <!-- JS needed for this page -->
      <script src="{{ asset('front/js/main.js') }}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

      <script>
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });          

            function addButton(itemid){
                
                event.preventDefault();
                var $post = {};
                var nilaiItem = "nilaiItem"+itemid;
                $post.nilai = parseInt(document.getElementById(nilaiItem).innerHTML)+1;

                $.ajax({
                    url: '/user/'+itemid,
                    type: 'PUT',
                    data: $post,
                    cache: false,
                    success: function (data) {
                    //alert('Your data updated');
                        document.getElementById(nilaiItem).innerHTML = $post.nilai;
                        return data;
                    },
                    error: function () {
                        alert('error handing here');
                    }

                });
            }

            function createNewItem(catid){

                event.preventDefault();
                var $post = {};
                $post.title = document.getElementById("title").value;
                $post.categories_id = catid;

                $.ajax({
                    url: '{{ url("/user/") }}',
                    type: 'POST',
                    data: $post,
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        
                       var styleclass = currentPageId == 'page-dosa' ? "danger" : "success";

                        if(data.status == 'success'){
                            var newElement = ' <div class="col-4 p-1">'+
                            '<div class="card grey lighten-2  text-center">'+
                              '<div class="card-body pb-0">'+
                                '<i class="fas fa-cloud fa-3x pb-4"></i>'+
                                '<div class="text-center mb-2">'+
                                  '<p class="mb-0 h4 text-center"> '+$post.title+' </p> '+                           
                                '</div>'+
                              '</div>'+
                              '<div class="card-body pt-0">'+                                  
                                '<p class="mb-0 h3 text-'+styleclass+'" id="nilaiItem'+data.data_lastid+'"> 0 </p>'+
                              '</div>'+
                              '<button class="btn btn-block btn-'+styleclass+' btn-sm" onclick="addButton('+data.data_lastid+')">+</button>'+   
                            '</div>'+       
                          '</div> <!-- Grid column -->';
                        if(catid==1){
                            document.getElementById('rowitems_dosa').innerHTML = newElement + document.getElementById('rowitems_dosa').innerHTML;                        
                        }
                        else if(catid==2){
                            document.getElementById('rowitems_pahala').innerHTML = newElement + document.getElementById('rowitems_pahala').innerHTML;                        
                        }

                        }
                        else{
                            alert(data.status+" >> "+data.message);
                        }
                        //location.reload();                   
                        return data;
                    },
                    error: function () {
                        alert('Error!');
                    }

                });
               document.getElementById('title').value = "";
            }

            function refreshPage() {
               location.reload(true);
            }
        
    </script>

   </body>
</html>

