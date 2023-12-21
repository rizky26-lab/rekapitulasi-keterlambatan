@extends('layout.master')
@section('navbar-sidebar')
@include('component._navbar')
@include('component._sidebar')
@endsection
@section('content')
@if (session('success'))
    <div class="alert alert-success pb-0" role="alert">
        <h4 class="alert-heading">Berhasil !</h4>
        <p>{{ session('success') }}</p>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-lg-end mb-3">
            <a class="btn btn-success" href="{{ route('student.create') }}">Tambah Student</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="my_table">
                <thead class="bg-light">
                    <tr>
                        <th class="text-nowrap" style="width:50px">No</th>
                        <th class="text-nowrap">NIS</th>
                        <th class="text-nowrap">Nama</th>
                        <th class="text-nowrap">Rayon</th>
                        <th class="text-nowrap">Rombel</th>
                        <th class="text-nowrap" style="width: 100px">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student as $item)
                        <tr>
                            <td class="text-nowrap">{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $item->nis }}</td>
                            <td class="text-nowrap">{{ $item->name }}</td>
                            <td class="text-nowrap">{{ $item->rayon->rayon }}</td>
                            <td class="text-nowrap">{{ $item->rombel->rombel }}</td>
                            <td class="text-nowrap">
                                <div class="d-flex">
                                    <a href="{{ route('student.edit',$item->id) }}" class="btn btn-warning me-2">Edit</a>
                                    <form action="{{ route('student.destroy',$item->id) }}" method="post" id="delete_form{{ $item->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger" onclick="delete_item('delete_form{{ $item->id }}')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function delete_item(form) {
        let cf = confirm('Yakin Menghapus Data ?')
        if (cf) {
            document.getElementById(form).submit();
        }
    }
</script>
@endsection