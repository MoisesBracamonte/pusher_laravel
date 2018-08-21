@extends('layouts.app')
@section('content')
<div class="container-fluid">
  @if(session('edit_user'))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
      <strong>{{session('edit_user')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif
<profile-component 
  :action-form="'{{route('update_profile')}}'"
  :user="{{Auth::user()}}"
  :token="'{{csrf_token()}}'"
  :errors="{{$errors}}"
></profile-component>
</div>
@endsection