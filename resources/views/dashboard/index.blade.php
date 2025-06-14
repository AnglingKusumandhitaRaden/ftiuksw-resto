
@extends('layouts.index')
@section('content')
  <h1>Selamat datang {{ auth()->user()->username }}</h1>
@endsection