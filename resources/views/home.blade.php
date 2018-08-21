@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <messenger-component 
        :user-id="{{Auth::user()->id}}"
        :image-user="'{{Auth::user()->image_perfil}}'"></messenger-component>
</div>
@endsection
