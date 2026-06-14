@extends('layouts.app')

@section('title', 'Daftar Cicilan')

@section('menuManajemenCicilanSemua', 'active')
@section('menuManajemenCicilanOpen', 'menu-open')
@section('menuManajemenCicilan', 'active')

@section('content')
    @livewire('manajemen.cicilan.index')
@endsection