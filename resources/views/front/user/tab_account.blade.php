         <!-- account page -->
         <div id="page-account" class="inactive" style="margin-top:-50px; background-color:#fff;position:absolute;z-index:1000; width:100%;">
            <h4>Your Profile </h4>
            <div class="block">
              <br>
              <h5>Dosa</h5>
              <table class="table table-hover table-condensed table-striped table-bordered">
                <tr class="bg-danger text-light">
                  <th>Item</th>
                  <th>Score</th>
                  <th>Last Update</th>
                </tr>

                @foreach ($items as $item)                
                  @if ($item->categories_id == "1")
                    <tr>
                      <td style="padding:2px">{{$item->title}}</td>
                      <td style="padding:2px">{{$item->nilai}}</td>
                      <td style="padding:2px">{{$item->updated_at->diffForHumans()}}</td>
                    </tr>
                  @endif                
                @endforeach             
              </table>

             

              <br>
              <h5>Pahala</h5>
              <table class="table table-hover table-condensed table-striped table-bordered">
                <tr class="bg-success text-light">
                  <th>Item</th>
                  <th>Score</th>
                  <th>Last Update</th>
                </tr>

                @foreach ($items as $item)                
                  @if ($item->categories_id == "2")
                    <tr>
                      <td style="padding:2px">{{$item->title}}</td>
                      <td style="padding:2px">{{$item->nilai}}</td>
                      <td style="padding:2px">{{$item->updated_at->diffForHumans()}}</td>
                    </tr>
                  @endif                
                @endforeach             
              </table>

            
              Support us with Follow Our IG
              <a href="https://instagram.com/catatan.onl">@catatan.onl</a>
              
            

            </div>
         </div>