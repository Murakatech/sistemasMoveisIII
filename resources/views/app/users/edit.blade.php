@extends('app.layouts.template')

@section('title', 'Editar Perfil')

@section('content')
    @component('app.components.form-user-edit', ['user' => $user])
    @endcomponent
@endsection
