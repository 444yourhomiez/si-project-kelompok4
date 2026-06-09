@extends('layouts.app')

@section('title', 'Rekapitulasi Harian')
@section('menuManajemenRekap', 'active')

@section('content')
    @livewire('manajemen.rekap.index')
@endsection