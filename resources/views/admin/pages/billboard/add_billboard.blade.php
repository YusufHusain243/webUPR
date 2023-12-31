@extends('admin/main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Billboard</h3>
                </div>
                <form method="POST" action="/add-billboard" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul_id">Judul (ID)</label>
                            <input type="text" class="form-control" id="judul_id" name="judul_id"
                                placeholder="Masukkan Judul Billboard (ID)">
                        </div>
                        <div class="form-group">
                            <label for="judul_en">Judul (EN)</label>
                            <input type="text" class="form-control" id="judul_en" name="judul_en"
                                placeholder="Masukkan Judul Billboard (EN)">
                        </div>
                        <div class="form-group">
                            <label for="content_id">Konten Billboard (ID)</label>
                            <textarea class="form-control" id="content_id" name="content_id"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="content_en">Konten Billboard (EN)</label>
                            <textarea class="form-control" id="content_en" name="content_en"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="selectImage" name="foto">
                                    <label class="custom-file-label" for="foto">Choose file</label>
                                </div>
                            </div>
                            <br>
                            <img id="preview" src="#" class="img-fluid" width="100" style="display:none;" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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

@push('summernote')
    <script>
        $(function() {
            $('#content_id').summernote()
            $('#content_en').summernote()
        })
    </script>
@endpush

