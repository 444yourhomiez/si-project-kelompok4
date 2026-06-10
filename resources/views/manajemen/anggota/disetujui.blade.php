@extends('layouts.app')

@section('title', 'Anggota Disetujui')

@section('menuManajemenAnggota', 'active')
@section('menuManajemenAnggotaDisetujui', 'active')
@section('menuManajemenAnggotaOpen', 'menu-open')

@section('content')

    {{-- INDEX DISETUJUI --}}
    @livewire('manajemen.anggota.disetujui')

    {{-- EDIT MODAL --}}
    @livewire('manajemen.anggota.edit')

    {{-- DELETE MODAL --}}
    @livewire('manajemen.anggota.delete')

    {{-- CLOSE MODAL --}}
    <script>
        // EDIT
        Livewire.on('closeEditModal', () => {

            $('#editModalAnggota').modal('hide');

            Swal.fire({
                title: "Sukses",
                text: "Data Anggota Berhasil Diedit",
                icon: "success",
                confirmButtonText: "OK"
            });

        });

        // DELETE
        Livewire.on('closeDeleteModal', () => {

            $('#deleteModalAnggota').modal('hide');

            Swal.fire({
                title: "Sukses",
                text: "Data Anggota Berhasil Dihapus",
                icon: "success",
                confirmButtonText: "OK"
            });

        });
    </script>
    
@endsection