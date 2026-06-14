@extends('layouts.app')

@section('title', 'Daftar DUM')

@section('menuPengawasRekap', 'active')
@section('menuPengawasRekapDum', 'active')
@section('menuPengawasRekapOpen', 'menu-open')

@section('content')
    @livewire('pengawas.rekap.dum')
@endsection