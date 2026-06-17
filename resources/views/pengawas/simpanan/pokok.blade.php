@extends('layouts.app')
@section('title', 'Simpanan Pokok')
@section('menuPengawasSimpanan', 'active')
@section('menuPengawasSimpananPokok', 'active')
@section('menuPengawasSimpananOpen', 'menu-open')
@section('content')
    @livewire('pengawas.simpanan.pokok')
@endsection