@extends('app.layouts.template')

@section('title', 'Visualizar Categorias')

@section('content')
    @include('app.components.table-category-index', ['categories' => $categories])
@endsection
