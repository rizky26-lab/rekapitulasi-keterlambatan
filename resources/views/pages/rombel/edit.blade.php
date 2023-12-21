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
<form action="{{ route('rombel.update',$rombel->id) }}" method="post">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-lg-2">
                                
                <div class="col">
                    <div class="mb-3">
                        <label for="rombel" class="form-label">Rombel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('rombel') is-invalid @enderror" name="rombel" id="rombel" placeholder="Masukkan rombel" value="{{ old('rombel') ? old('rombel') : $rombel->rombel }}">
                        @error('rombel')<span class="text-danger d-block">{{ $message }}</span>@enderror
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