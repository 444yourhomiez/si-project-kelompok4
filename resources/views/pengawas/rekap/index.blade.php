@extends('layouts.app')

@section('title', 'Daftar Rekap')

@section('menuPengawasRekapSemua', 'active')
@section('menuPengawasRekapOpen', 'menu-open')
@section('menuPengawasRekap', 'active')

@section('content')
    @livewire('pengawas.rekap.index')
@endsection