@extends('layouts.app')

@section('title', 'Simpanan Wajib')

@section('menuManajemenSimpanan', 'active')
@section('menuManajemenSimpananWajib', 'active')
@section('menuManajemenSimpananOpen', 'menu-open')

@section('content')

    {{-- INDEX WAJIB --}}
    @livewire('manajemen.simpanan.wajib')

    {{-- CREATE --}}
    @livewire('manajemen.simpanan.create')

    {{-- EDIT --}}
    @livewire('manajemen.simpanan.edit')

    {{-- DELETE --}}
    @livewire('manajemen.simpanan.delete')

    <script>
        // CREATE
        Livewire.on('closeCreateModal', () => {

            bootstrap.Modal.getInstance(document.getElementById('createModalSimpanan'))?.hide();

            Swal.fire({
                title: "Sukses",
                text: "Simpanan Berhasil Ditambah",
                icon: "success",
                confirmButtonText: "OK"
            });

        });

        // EDIT
        Livewire.on('closeEditModal', () => {

            bootstrap.Modal.getInstance(document.getElementById('editModalSimpanan'))?.hide();

            Swal.fire({
                title: "Sukses",
                text: "Simpanan Berhasil Diperbarui",
                icon: "success",
                confirmButtonText: "OK"
            });

        });

        // DELETE
        Livewire.on('closeDeleteModal', () => {

            bootstrap.Modal.getInstance(document.getElementById('deleteModalSimpanan'))?.hide();

            Swal.fire({
                title: "Sukses",
                text: "Simpanan Berhasil Dihapus",
                icon: "success",
                confirmButtonText: "OK"
            });

        });
    </script>
    
@endsection