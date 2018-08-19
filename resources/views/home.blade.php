@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <messenger-component :user-id="{{Auth::user()->id}}"></messenger-component>
</div>
@endsection
