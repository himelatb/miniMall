@extends('admin.layout.layout')
<!-- Use your layout file if you have one -->
@section('content')
<div class="card container-fluid justify-content-centers">
    <div class="card-header">
        <h3 class="card-title">Product List</h3>
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
    <a style="width: 150px;margin-right: 15px;" class="btn btn-success ml-auto mb-2" data-toggle="modal"
        data-target="#addBrandModal" id="createNewBrand">Add Brand</a>
    <!-- /.card-header -->
    <div class="card p-0 table-data">
        <div class="card-body">
            <table id="BrandViewTable" class="table table-bordered table-striped BrandViewTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th style="width: 2px">Action</th>
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
