@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <messenger-component :user="{{Auth::user()}}"/>
</div>
@endsection
