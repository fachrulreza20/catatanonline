<!DOCTYPE html>
<html>
<head>
    <title>Item Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

</head>
<body>
    
<div class="container">
    <br>    
    <a href="admin/home"> < Back to Home</a>
    <br><br>
    <h4>Item Management</h4>
    <br>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewItem"> Create New Item</a> 
    <br>
    <br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Nilai</th>
                <th>Categories</th>
                <th>Owner</th>
                <th>Created At</th>
                <th>Updated at</th>
                <th width="">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="itemForm" name="itemForm" class="form-horizontal">
                   <input type="hidden" name="item_id" id="item_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Item Title" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nilai</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Enter Values/Nilai" value="" maxlength="150" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Categories</label>
                        <div class="col-sm-12">
                            <select name="categories_id">
                                <option value="1">Dosa</option>
                                <option value="2">Pahala</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="owner_id" id="owner_id" value="{{ Auth::user()->id }}">

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
    
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('itemManagement.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'nilai', name: 'nilai'},
            {data: 'categories_id', name: 'categories_id'},
            {data: 'owner_id', name: 'owner_id'},
            {data: 'created_at', name: 'created_at', render : function (data,full ) { return moment(data).format('DD-MMM-YYYY H:m'); }},
            {data: 'updated_at', name: 'updated_at', render : function (data,full ) { return moment(data).format('DD-MMM-YYYY H:m'); }},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
    $('#createNewItem').click(function () {
        $('#saveBtn').val("create-item");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#modelHeading').html("Create New Item");
        $('#ajaxModel').modal('show');
       
    });
    
    $('body').on('click', '.editItem', function () {
      var item_id = $(this).data('id');
      $.get("{{ route('itemManagement.index') }}" +'/' + item_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Item");
          $('#saveBtn').val("edit-item");
          $('#ajaxModel').modal('show');
          $('#item_id').val(data.id);
          $('#title').val(data.title);
          $('#nilai').val(data.nilai);
          $('#categories_id').val(data.categories_id);
          $('#owner_id').val(data.owner_id);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        
    
        $.ajax({
          data: $('#itemForm').serialize(),
          url: "{{ route('itemManagement.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#itemForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteItem', function () {
     
        var item_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('itemManagement.store') }}"+'/'+item_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</html>