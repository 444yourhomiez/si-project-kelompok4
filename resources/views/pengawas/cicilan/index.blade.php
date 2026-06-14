@extends('layouts.app')

@section('title', 'Daftar Cicilan')

@section('menuPengawasCicilanSemua', 'active')
@section('menuPengawasCicilanOpen', 'menu-open')
@section('menuPengawasCicilan', 'active')

@section('content')
    @livewire('pengawas.cicilan.index')
@endsection