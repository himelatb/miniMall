@extends('front.layout.layout')
@section('content')
<div class="col-md-12">
@if (isset($message))
  <div class="row pb-3">
    <h6 class="text-center col-lg-center col-12" style="color: green;">{{$message != null ? $message: 'No notification found!!' }}</h6>
  </div>
@endif
<div class="d-flex justify-content-center mb-3">
  <a href="{{url('/miniMall')}}"> 
      <button class="btn btn-block btn-outline-primary font-weight-bold py-3">HomePage</button>
  </a>
</div>
</div>
@endsection