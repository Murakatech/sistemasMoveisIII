@extends('app.layouts.template')

@section('title', 'Cadastrar Categoria')

@section('content')
    @component('app.components.form-category-create')
    @endcomponent
@endsection
