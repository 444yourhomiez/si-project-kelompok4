@extends('layouts.app')

@section('title', 'Daftar Cicilan Pribadi')

@section('menuPengawasCicilan', 'active')
@section('menuPengawasCicilanPribadi', 'active')
@section('menuPengawasCicilanOpen', 'menu-open')

@section('content')
    @livewire('pengawas.cicilan.pribadi')
@endsection