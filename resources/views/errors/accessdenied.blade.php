@extends('layouts.app')

@section('content')

<div class="container">
  @if(session('msg'))
      <div class="alert alert-{!! session('msgclass') !!}">
          {!! session('msg') !!}
      </div>
  @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Information</div>
                <div class="panel-body">
                  <center>
                    <font color="red">ACCESS DENIED! PLEASE GO TO HOME!</font><br><br><br>
                    <a href="{{url('/')}}"> Home </a>
                  </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
