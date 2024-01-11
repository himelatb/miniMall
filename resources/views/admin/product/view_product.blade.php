@extends('admin.layout.layout') <!-- Use your layout file if you have one -->
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
      <a style="width: 150px;margin-right: 15px;" class="btn btn-success ml-auto mb-2" data-toggle="modal" data-target="#addProductModal" id="createNewProduct">Add Product</a>
      <!-- /.card-header -->
      <div class="card p-0 table-data">
        <div class="card-body">
          <table id="ProductViewTable" class="table table-bordered table-striped ProductViewTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Code</th>
              <th>Name</th>
              <th>Color</th>
              <th>sub Category</th>
              <th>Category</th>
              <th style="width: 2px">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product['id']}}</td>
                <td>{{$product['product_code']}}</td>
                <td>{{$product['product_name']}}</td>
                <td>{{$product['product_color']}}</td>
                <td>
                  @if (!empty($product['category']))
                  {{$product['category']['category_name']}}
                @endif
                </td>

                <td>@if (isset($product['category']['parentcategory']) && !empty($product['category']['parentcategory']['category_name']))
                    {{$product['category']['parentcategory']['category_name']}}
                @endif
                </td>

                <td class="d-flex border-0">
    
                       <div data-toggle="modal" data-target="#updateProductModal" style="margin-right: 15px;" class="btn btn-primary editProductBtn">
                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                       </div> 
                        <div  class="btn btn-danger deleteProductBtn" data-id="{{$product['id']}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                              </svg>
                        </div>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      
    </div>
   
   

    <!-- /.card -->
@endsection