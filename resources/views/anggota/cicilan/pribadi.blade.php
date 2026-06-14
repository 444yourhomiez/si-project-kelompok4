@extends('layouts.app')

@section('title', 'Daftar Cicilan Pribadi')

@section('menuAnggotaCicilan', 'active')
@section('menuAnggotaCicilanPribadi', 'active')
@section('menuAnggotaCicilanOpen', 'menu-open')

@section('content')
    @livewire('anggota.cicilan.pribadi')
@endsection