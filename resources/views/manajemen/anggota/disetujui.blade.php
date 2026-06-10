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

            bootstrap.Modal.getInstance(document.getElementById('editModalAnggota'))?.hide();

            Swal.fire({
                title: "Sukses",
                text: "Data Anggota Berhasil Diedit",
                icon: "success",
                confirmButtonText: "OK"
            });

        });

        // DELETE
        Livewire.on('closeDeleteModal', () => {

            bootstrap.Modal.getInstance(document.getElementById('deleteModalAnggota'))?.hide();

            Swal.fire({
                title: "Sukses",
                text: "Data Anggota Berhasil Dihapus",
                icon: "success",
                confirmButtonText: "OK"
            });

        });
    </script>
    
@endsection