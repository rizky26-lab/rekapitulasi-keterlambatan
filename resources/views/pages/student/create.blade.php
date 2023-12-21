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
<form action="{{ route('student.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-lg-2">
                                
                <div class="col">
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis" placeholder="Masukkan nis" value="{{ old('nis') }}">
                        @error('nis')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
                
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan nama" value="{{ old('name') }}">
                        @error('name')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            
            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col">
                    <div class="mb-3">
                        <label for="rayon_id" class="form-label">Rayon <span class="text-danger">*</span></label>
                        <select class="form-select form-control @error('rayon_id') is-invalid @enderror" name="rayon_id" id="rayon_id">
                            <option value="" selected disabled>--Pilih--</option>
                            @foreach ($rayons as $rayon)
                                <option value="{{ $rayon->id }}" {{ old('rayon_id') == $rayon->id ? 'selected' : '' }}>{{ $rayon->rayon }}</option>
                            @endforeach
                        </select>                        
                        @error('rayon_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="rombel_id" class="form-label">Rombel <span class="text-danger">*</span></label>
                        <select class="form-select form-control @error('rombel_id') is-invalid @enderror" name="rombel_id" id="rombel_id">
                            <option value="" selected disabled>--Pilih--</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}" {{ old('rombel_id') == $rombel->id ? 'selected' : '' }}>{{ $rombel->rombel }}</option>
                            @endforeach
                        </select>
                        @error('rombel_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
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