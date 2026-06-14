@extends('layouts.app')

@section('title', 'Daftar Cicilan Khusus')

@section('menuPengawasCicilan', 'active')
@section('menuPengawasCicilanKhusus', 'active')
@section('menuPengawasCicilanOpen', 'menu-open')

@section('content')
    @livewire('pengawas.cicilan.khusus')
@endsection