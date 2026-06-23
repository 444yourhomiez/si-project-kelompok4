@extends('layouts.app')
@section('title', 'Detail Cicilan')
@section('menuPengawasCicilan', 'active')
@section('content')
    @livewire('pengawas.cicilan.detail', ['id' => request()->route('id')])
@endsection
