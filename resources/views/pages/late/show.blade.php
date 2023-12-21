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
           
            
    @if ($late->count())
    <div class="container">
      <div class="row">
          @foreach ($late as $item)
          <div class="col-md-4 mb-3">
              <div class="card">
                  <div class="position-absolute bg-dark px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a href="/student" class="text-white text-decoration-none">{{ $item->student->nis }}</a></div>
                  @if ($item->bukti)
                  <img src="{{ asset('images/bukti_images/'. $item->bukti) }}" class="card-img-top" alt="{{ $item->student->name }}"  style="min-height: 300px">
                  @else
                  <img src="https://source.unsplash.com/500x400?{{ $item->student->name }}" class="card-img-top" alt="{{ $item->student->name }}">
                  @endif
                  <div class="card-body">
                    <h5 class="card-title text-decoration-none text-dark">Keterlambatan Ke-{{ $loop->iteration  }}</h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $item->date_time_late }}</li>
                  </ul>
                  <div class="card-body">
                    <p href="#" class="card-link text-primary">{{ $item->information }}</p>
                  </div>
                </div>
          </div>
          @endforeach
      </div>
    </div>
  
    @else
      <p class="text-center fs-4">No item found.</p>
    @endif
        
    <script>
        function delete_item(form) {
            let cf = confirm('Yakin Menghapus Data ?')
            if (cf) {
                document.getElementById(form).submit();
            }
        }
    </script>
@endsection
