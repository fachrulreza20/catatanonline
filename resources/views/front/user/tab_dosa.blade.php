

<!-- Dosa page -->
         <div id="page-dosa" class="active">
           <br>

            <h5 class="text-center">Dosa User</h5>




            <div class="card-body grey lighten-5" id="rowitems_dosa">
              <div class="row">
              <?php $i=1; ?>
              @foreach ($items as $item )
              @if($item->categories->title == "Dosa" )
                  
               
                  @if($i<=3)
                        

                          <div class="col-4 p-1">
                            <div class="card grey lighten-2  text-center">
                              <div class="card-body pb-0">
                                <i class="fas fa-cloud fa-3x pb-4"></i>
                                <div class="text-center mb-2">
                                  <p class="mb-0 h6 text-center"> {{ $item->title }}  </p>                                  

                                </div>
                              </div>
                              <div class="card-body pt-0">
                                  {{-- <img src="https://cdn3.iconfinder.com/data/icons/education-209/64/board-math-class-school-64.png"> --}}
                                <p class="mb-0 h3 text-danger" id="nilaiItem{{ $item->id }}"> {{ $item->nilai }}</p>
                              </div>
                              {{-- <button class="btn btn-block btn-danger btn-sm" onclick="document.getElementById('oke{{ $item->id }}').innerHTML=parseInt(document.getElementById('oke{{ $item->id }}').innerHTML)+1">+</button>    --}}
                              <button class="btn btn-block btn-danger btn-sm" onclick="addButton({{ $item->id }})">+</button>   
                            </div>       
                          </div> <!-- Grid column -->
                  @else
                    </div> <!-- Grid row -->
                      <div class="row">
                        <?php $i = 1;  ?>

                        <div class="col-4 p-1">
                          <div class="card grey lighten-2  text-center">
                            <div class="card-body pb-0">
                              <i class="fas fa-cloud fa-3x pb-4"></i>
                              <div class="text-center mb-2">
                                <p class="mb-0 h6 text-center"> {{ $item->title }}  </p>                                  

                              </div>
                            </div>
                            <div class="card-body pt-0">
                                {{-- <img src="https://cdn3.iconfinder.com/data/icons/education-209/64/board-math-class-school-64.png"> --}}
                              <p class="mb-0 h3 text-danger" id="nilaiItem{{ $item->id }}"> {{ $item->nilai }}</p>
                            </div>
                            {{-- <button class="btn btn-block btn-danger btn-sm" onclick="document.getElementById('oke{{ $item->id }}').innerHTML=parseInt(document.getElementById('oke{{ $item->id }}').innerHTML)+1">+</button>    --}}
                            <button class="btn btn-block btn-danger btn-sm" onclick="addButton({{ $item->id }})">+</button>   
                          </div>       
                        </div> <!-- Grid column -->


                  @endif
               
              
                  <?php $i++;  ?>
              @endif
              @endforeach

              
               </div> <!-- Grid row --> 
         </div>





         </div> <!-- close page-dosa -->
         