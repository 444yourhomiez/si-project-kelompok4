@extends('layouts.app')

@section('title', 'Simpanan Sukarela')

@section('menuPengawasSimpanan', 'active')
@section('menuPengawasSimpananSukarela', 'active')
@section('menuPengawasSimpananOpen', 'menu-open')

@section('content')
    @livewire('pengawas.simpanan.sukarela')
@endsection