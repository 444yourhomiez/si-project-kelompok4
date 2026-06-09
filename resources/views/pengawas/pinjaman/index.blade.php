@extends('layouts.app')

@section('title', 'Pinjaman')
@section('menuPengawasPinjaman', 'active')

@section('content')
    @livewire('pengawas.pinjaman.index')
@endsection