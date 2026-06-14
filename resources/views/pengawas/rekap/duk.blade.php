@extends('layouts.app')

@section('title', 'Daftar DUK')

@section('menuPengawasRekap', 'active')
@section('menuPengawasRekapDuk', 'active')
@section('menuPengawasRekapOpen', 'menu-open')

@section('content')
    @livewire('pengawas.rekap.duk')
@endsection