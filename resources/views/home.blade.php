@extends('layouts.app')

@section('titulo')
    Descubre
@endsection

@section('contenido')
    <x-list-post :posts="$posts" />
@endsection