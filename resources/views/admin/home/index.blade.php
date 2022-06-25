@extends('layouts.base')
@section('title', 'Home')
@section('content')
<div class="jumbotron">
  <h1 class="display-4">Hallo, {{Auth::user()->namalengkap}}!</h1>
  <p class="lead">Selamat datang kembali</p>
  <hr class="my-4">
</div>
@endsection
