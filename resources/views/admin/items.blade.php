<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel Ajax CRUD Example Tutorial with - CodingDriver</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

</head>
  <style>
  .alert-message {
    color: red;
  }
</style>
<body>
  <div class="container">
    <br>
    <h3>Item Manager</h3>
    <br>
    <a href="{{ url('admin/home') }}"> < Back to Home</a>
    <br><br>
    <div class="row">
       <div class="col-12 text-right">
         <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-item" onclick="addItem()">Add Item</a>
       </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12">
          <table id="laravel_crud" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Nilai</th>
                    <th>Categories</th>
                    <th>Owner</th>
                    <th>Edit</th>
                    <th>Add Nilai</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item) 
                <tr id="row_{{$item->id}}">
                   <td>{{ $item->id  }}</td>
                   <td>{{ $item->title }}</td>
                   <td>{{ $item->nilai }}</td>  
                   <td>{{ $item->categories->title }}</td>
                   <td>{{ $item->users->name }}</td>
                   <td><a href="javascript:void(0)" data-id="{{ $item->id }}" onclick="editItem(event.target)" class="btn btn-info">Edit</a></td>
                   <td><a href="javascript:void(0)" data-id="{{ $item->id }}" onclick="tambahNilai(event.target)" class="btn btn-info">Add Nilai</a></td>
                   <td>
                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-danger" onclick="deleteItem(event.target)">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
       </div>
    </div>
</div>


<div class="modal fade" id="item-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
              <form name="userForm" class="form-horizontal">
                 <input type="hidden" name="item_id" id="item_id">
                  <div class="form-group">
                      <label for="name" class="col-sm-2">title</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"><br>
                          <b>Category</b>
                          <select name="categories_id" id="categories_id" class="form-control">

                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->title}}</option>                             
                            @endforeach
 
                          </select>
                          <input type="hidden" class="form-control" id="owner_id" name="owner_id" placeholder="Enter title" value="1"><br>
                          <span id="titleError" class="alert-message"></span>
                      </div>
                  </div>
  
                  <div class="form-group">
                      <label class="col-sm-2">nilai</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Enter title">
                          <span id="nilaiError" class="alert-message"></span>
                      </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="createItem()">Save</button>
          </div>
      </div>
    </div>
  </div>



  <script>
    $('#laravel_crud').DataTable();
  
    function addItem() {
      $('#item-modal').modal('show');
    }
  
    function editItem(event) {
      var id  = $(event).data("id");
      let _url = "/admin/items/"+id+"";
      $('#titleError').text('');
      $('#nilaiError').text('');
      
      $.ajax({
        url: _url,
        type: "GET",
        success: function(response) {
            if(response) {
              $("#item_id").val(response.id);
              $("#title").val(response.title);
              $("#nilai").val(response.nilai);
              $("#categories_id").val(response.categories_id);
              $("#owner_id").val(response.owner_id);
              $('#item-modal').modal('show');
            }
        }
      });
    }

    function tambahNilai(event){

      var id  = $(event).data("id");
      let _url = "/admin/items/"+id+"";
      $('#titleError').text('');
      $('#nilaiError').text('');
      
      $.ajax({
        url: _url,
        type: "GET",
        success: function(response) {
            if(response) {
              $("#item_id").val(response.id);
              $("#title").val(response.title);
              $("#nilai").val(response.nilai);
              $("#categories_id").val(response.categories_id);
              $("#owner_id").val(response.owner_id);

              var title = $('#title').val();
              var nilai = $('#nilai').val();
              var categories_id = $('#categories_id').val();
              var owner_id = $('#owner_id').val();
              var id = $('#item_id').val();

              let _url     = '/admin/items';
              let _token   = $('meta[name="csrf-token"]').attr('content');
          
                $.ajax({
                  url: _url,
                  type: "POST",
                  data: {
                    id: id,
                    title: title,
                    nilai: parseInt(nilai)+1,
                    categories_id: categories_id,
                    owner_id: owner_id,
                    _token: _token
                  },
                  success: function(response) {
                    console.log(response)
                      if(response.code == 200) {
                        if(id != ""){
                          $("#row_"+id+" td:nth-child(2)").html(response.data.title);
                          $("#row_"+id+" td:nth-child(3)").html(response.data.nilai);
                          $("#row_"+id+" td:nth-child(4)").html(response.data.categories_id);
                          $("#row_"+id+" td:nth-child(5)").html(response.data.owner_id);
                        } else {
                          $('table tbody').prepend(
                            '<tr id="row_'+response.data.id+'">\
                            <td>'+response.data.id+'</td><td>'+response.data.title+'</td><td>'+response.data.nilai+'</td><td>'+response.data.categories_id+'</td><td>'+response.data.owner_id+'</td>\
                            <td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editItem(event.target)" class="btn btn-info">Edit</a></td>\
                            <td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="tambahNilai(event.target)" class="btn btn-info">Add Nilai</a></td>\
                            <td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteItem(event.target)">Delete</a></td>\
                            </tr>');
                        }
                        $('#title').val('');
                        $('#nilai').val('');
                      }
                  },
                  error: function(response) {
                    $('#titleError').text(response.responseJSON.errors.title);
                    $('#nilaiError').text(response.responseJSON.errors.nilai);
                  }
                });

            }
        }
      });

      
    }











  
    function createItem() {
      var title = $('#title').val();
      var nilai = $('#nilai').val();
      var categories_id = $('#categories_id').val();
      var owner_id = $('#owner_id').val();
      var id = $('#item_id').val();
  
      let _url     = '/admin/items';
      let _token   = $('meta[name="csrf-token"]').attr('content');
  
        $.ajax({
          url: _url,
          type: "POST",
          data: {
            id: id,
            title: title,
            nilai: nilai,
            categories_id: categories_id,
            owner_id: owner_id,
            _token: _token
          },
          success: function(response) {
              if(response.code == 200) {
                if(id != ""){
                  $("#row_"+id+" td:nth-child(2)").html(response.data.title);
                  $("#row_"+id+" td:nth-child(3)").html(response.data.nilai);
                  $("#row_"+id+" td:nth-child(4)").html(response.data.categories_id);
                  $("#row_"+id+" td:nth-child(5)").html(response.data.owner_id);
                } else {
                  $('table tbody').prepend(
                            '<tr id="row_'+response.data.id+'">\
                            <td>'+response.data.id+'</td><td>'+response.data.title+'</td><td>'+response.data.nilai+'</td><td>'+response.data.categories_id+'</td><td>'+response.data.owner_id+'</td>\
                            <td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editItem(event.target)" class="btn btn-info">Edit</a></td>\
                            <td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="tambahNilai(event.target)" class="btn btn-info">Add Nilai</a></td>\
                            <td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteItem(event.target)">Delete</a></td>\
                            </tr>');
                }
                $('#title').val('');
                $('#nilai').val('');
  
                $('#item-modal').modal('hide');
              }
          },
          error: function(response) {
            $('#titleError').text(response.responseJSON.errors.title);
            $('#nilaiError').text(response.responseJSON.errors.nilai);
          }
        });
    }
  
    function deleteItem(event) {

      
      
      var r = confirm("Sure want to Delete ?");
      if (r == true) {
        var id  = $(event).data("id");
        let _url = "/admin/items/"+id+"";
        let _token   = $('meta[name="csrf-token"]').attr('content');
    
          $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
              _token: _token
            },
            success: function(response) {
              $("#row_"+id).remove();
            }
          });
        
      } else {
       
      }      
    }
  
  </script>
</body>
</html>