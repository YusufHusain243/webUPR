@extends('admin/main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row ">
                        <div class="col d-flex justify-content-between align-items-center">
                            <h3 class="card-title">SUB MENU ({{ $menu->menu_id }})</h3>
                            <a href="/add-sub-menu/{{$menu->id}}" class="btn btn-primary">Tambah Sub Menu</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama (ID)</th>
                                <th>Nama (EN)</th>
                                <th>Status</th>
                                <th>URL (ID)</th>
                                <th>URL (EN)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->menu_id }}</td>
                                    <td>{{ $d->menu_en }}</td>
                                    <td>{!! $d->status !!}</td>
                                    <td>{!! $d->url_id !!}</td>
                                    <td>{!! $d->url_en !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div>
                                                <a href="/edit-sub-menu/{{ $d->id }}/{{$menu->id}}"
                                                    class="btn btn-warning">Edit</a>
                                            </div>
                                            <form action="/sub-menu/{{ $d->id }}/{{$menu->id}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin Hapus Menu Ini?');"
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
