@extends('layout.master')
@section('navbar-sidebar')
@include('component._navbar')
@include('component._sidebar')
@endsection
@section('content')
@if (session('error'))
    <div class="alert alert-danger pb-0" role="alert">
        <h4 class="alert-heading">Terjadi Masalah</h4>
        <p>{{ session('error') }}</p>
    </div>
@endif
<form action="{{ route('rayon.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-lg-2">

                <div class="col">
                    <div class="mb-3">
                        <label for="rayon" class="form-label">rayon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('rayon') is-invalid @enderror" name="rayon"
                            id="rayon" placeholder="Masukkan rayon" value="{{ old('rayon') }}">
                        @error('rayon')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pembimbing Siswa<span
                                class="text-danger">*</span></label>
                        <select class="form-select form-control @error('user_id') is-invalid @enderror" name="user_id"
                            id="user_id">
                            <option value="" hidden>Pilih</option>
                            @foreach ($users as $user)
                                @if (old('user_id'))
                                    == $user->id()
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
