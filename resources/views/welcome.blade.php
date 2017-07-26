@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                  <table id="example" class="display table table-responsive table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>Post ID</th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Body</th>
                            <th></th>
                        </tr>
                    </thead>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
      <div id="modal-data" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="fill-title-modal">Syafruddin</h4>
            </div>
            <div class="modal-body" id="fill-body-modal">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Yakin untuk delete data?
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" id="okButton">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
	</script>
<script>

var datatableJson = $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url("/auth/datatables-data")}}',
        columns: [
          {data: "postId", name: "postId"},
          {data: "id", name: "id"},
          {data: "email", name: "email"},
          {data: "name", name: "name"},
          {data: "body", name: "body"},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });

      function showData(obj, e){
           e.preventDefault();
           $('#fill-title-modal').html("");
           $('#fill-body-modal').html("");
           id = obj.getAttribute('data-id');
           $.ajax({
                url: "{{url('auth/detail-data/')}}/"+id,
                cache: false
              })
                .done(function( html ) {
                  console.log(html);
                  $("#fill-title-modal").html("Edit Data "+html[0].email);
                  $('#fill-body-modal').html("<p>UserID :"+html[0].userId+"</p><p>ID :"+html[0].id+"</p><p>Email : "+html[0].email+"</p><p>Body : "+html[0].body+"</p>");
                  $('#modal-data').modal('show');
                });


         }


       function deleteData(obj, e){
            e.preventDefault();
            confirmModal = $('#confirm-delete').modal('show');
            confirmModal.find('#okButton').click(function(event) {
              // console.log($(obj).parents('tr') );
              id = obj.getAttribute('data-id');
              datatableJson.ajax.url("{{url('/auth/datatables-data/true')}}/"+id).load();
              confirmModal.modal('hide');
            });
          }


</script>
@endsection
