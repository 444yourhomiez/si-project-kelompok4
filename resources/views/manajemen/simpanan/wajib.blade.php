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
        document.addEventListener('livewire:init', () => {

            // CREATE
            Livewire.on('closeCreateModal', () => {

                $('#createModalSimpanan').modal('hide');

                Swal.fire({
                    title: "Sukses",
                    text: "Simpanan Berhasil Ditambah",
                    icon: "success",
                    confirmButtonText: "OK"
                });

            });

            // EDIT
            Livewire.on('closeEditModal', () => {

                $('#editModalSimpanan').modal('hide');

                Swal.fire({
                    title: "Sukses",
                    text: "Simpanan Berhasil Diperbarui",
                    icon: "success",
                    confirmButtonText: "OK"
                });

            });

            // DELETE
            Livewire.on('closeDeleteModal', () => {

                $('#deleteModalSimpanan').modal('hide');

                Swal.fire({
                    title: "Sukses",
                    text: "Simpanan Berhasil Dihapus",
                    icon: "success",
                    confirmButtonText: "OK"
                });

            });

        });
    </script>
    
@endsection