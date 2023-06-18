@extends('admin/main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row ">
                        <div class="col d-flex justify-content-between align-items-center">
                            <h3 class="card-title">KONTEN</h3>
                            <a href="/add-konten" class="btn btn-primary">Tambah Konten</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul (ID)</th>
                                <th>Judul (EN)</th>
                                <th>Konten (ID)</th>
                                <th>Konten (EN)</th>
                                <th>Jenis</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->judul_id }}</td>
                                    <td>{{ $d->judul_en }}</td>
                                    <td>{!! $d->content_id !!}</td>
                                    <td>{!! $d->content_en !!}</td>
                                    <td>{{ $d->jenis }}</td>
                                    <td>
                                        <img src="storage/images/{{ $d->foto }}" width="50" class="img-fluid">
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <div>
                                                <a href="/edit-konten/{{$d->id}}"
                                                    class="btn btn-warning">Edit</a>
                                            </div>
                                            <form action="/konten/{{ $d->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin Hapus Konten Ini?');"
                                                    class="btn btn-danger">
                                                    Hapus
                                                </button>
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
    </section>
@endsection

@push('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush

@push('datatables')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
