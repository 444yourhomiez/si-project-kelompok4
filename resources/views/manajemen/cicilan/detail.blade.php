@extends('layouts.app')
@section('title', 'Detail Cicilan')
@section('menuManajemenCicilan', 'active')
@section('content')
    @livewire('manajemen.cicilan.detail', ['id' => request()->route('id')])
@endsection
