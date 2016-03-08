@extends('menu')

@section('content')
    {!! $dataTable->table() !!}
@endsection

@section('javascript')
    {!! $dataTable->scripts() !!}
@endsection


