@extends('layouts.app')

@section('title', 'Daftar')
@section('menuPengawasAnggota', 'active')

@section('content')
    @livewire('pengawas.anggota.index')
@endsection