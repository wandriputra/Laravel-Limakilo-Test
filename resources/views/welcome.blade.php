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
                            <th>userId</th>
                            <th>id</th>
                            <th>title</th>
                            <th>body</th>
                        </tr>
                    </thead>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
	</script>
<script>

var url = "http://jsonplaceholder.typicode.com/posts";

var table = $('#example').DataTable({
                   "processing": true,
                  //  "serverSide": true,
                   "ajax": {
                       "url": url,
                       "dataSrc": ""
                   },
                   "columns": [
                       { "data": "userId" },
                       { "data": "id" },
                       { "data": "title" },
                       { "data": "body" },
                   ],
                   "pagingType": "simple_numbers"
               });
</script>
@endsection
