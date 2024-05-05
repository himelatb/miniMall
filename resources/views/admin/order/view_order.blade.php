@extends('admin.layout.layout')
<!-- Use your layout file if you have one -->
@section('content')
<div class="card container-fluid justify-content-centers">
    <div class="card-header">
        <h3 class="card-title">Order List</h3>
        <!--<div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            <li class="page-item"><a class="page-link" href="#"></a></li>
          </ul>
        </div>-->
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card p-0 table-data">
        <div class="card-body">
            <table id="OrderViewTable" class="table table-bordered hover table-striped OrderViewTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Product Codes</th>
                        <th>Grand Total</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

    </div>



    <!-- /.card -->
    @endsection
