@extends('layouts.app')

@section('title', 'Profile')
@section('menuAnggotaProfile', 'active')

@section('content')

    {{-- INDEX PROFILE --}}
    @livewire('anggota.profile.index')

    {{-- MODAL UBAH PASSWORD --}}
    @livewire('anggota.profile.ubah-password')

    {{-- CLOSE MODAL --}}
    <script>
        window.addEventListener(
            'closeUbahPasswordAnggotaModal',
            () => {

                bootstrap.Modal.getInstance(document.getElementById('ubahPasswordAnggotaModal'))?.hide();

                Swal.fire({

                    title: 'Berhasil',

                    text: 'Password berhasil diperbarui',

                    icon: 'success',

                    confirmButtonText: 'OK'

                });

            }
        );
    </script>

@endsection