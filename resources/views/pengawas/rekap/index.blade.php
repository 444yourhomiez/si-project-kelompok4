@extends('layouts.app')

@section('title', 'Rekapitulasi Harian')
@section('menuPengawasRekap', 'active')

@section('content')
    @livewire('pengawas.rekap.index')
@endsection