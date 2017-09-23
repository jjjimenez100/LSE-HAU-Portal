@extends('layouts.errorsLayout')

@section('errorTitle')
    403 Error
@endsection

@section('errorStatus')
    Forbidden
@endsection

@section('message')
    You don't have permission to access this page on the server.
@endsection