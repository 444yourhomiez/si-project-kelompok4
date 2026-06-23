@extends('layouts.app')
@section('title', 'Rekapitulasi Harian')
@section('menuManajemenRekap', 'active')
@section('content')
    @livewire('manajemen.rekap.index')
    @livewire('manajemen.rekap.create')
    @livewire('manajemen.rekap.edit')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeCreateRekapModal', () => {
                $('#createRekapModal').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Rekapitulasi berhasil ditambahkan",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
            Livewire.on('openEditRekapModal', () => {
                $('#editRekapModal').modal('show');
            });
            Livewire.on('closeEditRekapModal', () => {
                $('#editRekapModal').modal('hide');
                Swal.fire({
                    title: "Sukses",
                    text: "Rekapitulasi berhasil diperbarui",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            });
        });
    </script>
@endsection
