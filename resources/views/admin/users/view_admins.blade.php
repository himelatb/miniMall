@extends('admin.layout.layout') <!-- Use your layout file if you have one -->
@section('content')
    <div class="card container-fluid justify-content-centers">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>
        <!--<div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            <li class="page-item"><a class="page-link" href="#"></a></li>
          </ul>
        </div>-->
      </div>
      @if(Auth::guard('admin')->user()->type ==1)
      <a style="width: 100px;margin-right: 15px;" class="btn btn-success ml-auto mb-2" data-toggle="modal" data-target="#adminModal" id="createNewAdmin">Add admin</a>
      @endif
      <div class="card p-0 table-data">
        <div class="card-body">
          <table id="AdminViewTable" class="table table-bordered table-striped AdminViewTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Type</th>
                <th>Status</th>
                <th style="width: 5px">Image</th>
                @if(Auth::guard('admin')->user()->type ==1)
                <th style="width: 2px">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($admins as $key=>$admin)
              <tr>
                <td>{{$key+1}}</td>
                  <td>{{$admin['name']}}</td>
                  <td>{{$admin['email']}}</td>
                  <td>{{$admin['mobile']}}</td>
                  <td>{{($admin['type'])==1 ? "Admin" : "Sub admin"}}</td>
                  <td>{{($admin['status'])==1 ? "Active" : "Inactive"}}</td>
                  <td><img 
                    @if(isset($admin['image'])&&!empty($admin['image']))
                    src="{{asset('admin/images/'.$admin['image'])}}"
                    @endif  alt="Not found"  width="50" height="50"></td>
                  @if(Auth::guard('admin')->user()->type ==1)
                  <td class="d-flex border-0">
      
                         <div data-toggle="modal" data-target="#updateModal" style="margin-right: 15px;" class="btn btn-primary editAdminBtn"
                         data-id="{{$admin->id}}"
                         data-name="{{$admin->name}}"
                         data-email="{{$admin->email}}"
                         data-mobile="{{$admin->mobile}}"
                         data-type="{{$admin->type}}"
                         data-status="{{$admin->status}}"
                         data-img="{{$admin->image}}"
                         >
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg>
                            </div> 
                          <div  class="btn btn-danger deleteAdminBtn" type="button" data-id="{{$admin->id}}">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                              </div>
                  </td>
                  @endif
              </tr>
              @endforeach
            
            </tbody>
          </table>
        </div>
        <!-- <div style="width: auto;" class="ml-auto m-1 d-flex justify-content-center"> </div> -->
      </div>
      <!-- /.card-body -->
      
    </div>
   
   

    <!-- /.card -->
@endsection