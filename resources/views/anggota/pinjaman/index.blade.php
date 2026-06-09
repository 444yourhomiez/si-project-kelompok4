@extends('layouts.app')

@section('title', 'Pinjaman')
@section('menuAnggotaPinjaman', 'active')

@section('content')
    @livewire('anggota.pinjaman.index')
@endsection