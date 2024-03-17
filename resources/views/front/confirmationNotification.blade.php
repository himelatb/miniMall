@extends('front.layout.layout')
@section('content')
<div class="col-lg-9 col-md-8">
    <div class="row pb-3">
      <h6 class="text-center col-lg-center col-12" style="color: green;">{{isset($message) && $message != null ? $message: 'No notification found!!' }}</h6>
    </div>
</div>
@endsection