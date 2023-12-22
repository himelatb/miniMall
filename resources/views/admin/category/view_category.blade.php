@extends('admin.layout.layout') <!-- Use your layout file if you have one -->
@section('content')
    <div class="card container-fluid justify-content-centers">
      <div class="card-header">
        <h3 class="card-title">Category List</h3>
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
      <a style="width: 150px;margin-right: 15px;" class="btn btn-success ml-auto mb-2" data-toggle="modal" data-target="#addcategoryModal" id="createNewCategory">Add Category</a>
      <!-- /.card-header -->
      <div class="card p-0 table-data">
        <div class="card-body">
          <table id="CategoryViewTable" class="table table-bordered table-striped CategoryViewTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Parent</th>
              <th>Name</th>
              <th>Discount</th>
              <th>Created on</th>
              <th>Status</th>
              <th style="width: 2px">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $key=>$category)
            <tr>
                <td>{{$category['cat_id']}}</td>
                <td>@if (isset($category['parentcategory']['category_name']))
                    {{$category['parentcategory']['category_name']}}
                @endif
                </td>
                <td>{{$category['category_name']}}</td>
                <td>{{$category['category_discount']}}</td>
                <td>{{date("d/m/Y H:i A", strtotime($category['updated_at']))}}</td>
                <td>{{($category['status'])==1 ? "Inactive" : "Active"}}</td>
                <td class="d-flex border-0">
    
                       <div data-toggle="modal" data-target="#updatecategoryModal" style="margin-right: 15px;" class="btn btn-primary editCategoryBtn"
                         data-id="{{$category['cat_id']}}"
                         data-parent_id="{{$category['parent_id']}}"
                         data-name="{{$category['category_name']}}"
                         data-image="{{$category['category_image']}}"
                         data-discount="{{$category['category_discount']}}"
                         data-description="{{$category['description']}}"
                         data-url="{{$category['url']}}"
                         data-meta_title="{{$category['meta_title']}}"
                         data-meta_description="{{$category['meta_description']}}"
                         data-meta_keywords="{{$category['meta_keywords']}}"
                         data-status="{{$category['status']}}">
                        <svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                       </div> 
                        <div  class="btn btn-danger deleteCategoryBtn" data-id="{{$category['cat_id']}}">
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