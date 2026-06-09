@extends('layouts.app')

@section('title', 'Laporan')
@section('menuPengawasLaporan', 'active')

@section('content')
    @livewire('manajemen.laporan.index')
@endsection