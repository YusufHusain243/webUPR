@extends('admin/main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">SETTING</h3>
                </div>
                <form method="POST" action="/setting" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name_id">Nama Aplikasi (ID)</label>
                            <input type="text" class="form-control" id="name_id" name="name_id"
                                placeholder="Masukkan Nama Aplikasi (ID)"
                                value="{{ isset($data[0]) ? $data[0]->name_id : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name_en">Nama Aplikasi (EN)</label>
                            <input type="text" class="form-control" id="name_en" name="name_en"
                                placeholder="Masukkan Nama Aplikasi (EN)"
                                value="{{ isset($data[0]) ? $data[0]->name_en : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo Aplikasi</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="selectImage" name="logo">
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
                            <br>
                            <img id="preview" src="{{ isset($data[0]) ? url('') . '/images/' . $data[0]->logo : '#' }}"
                                class="img-fluid" width="100"
                                style="{{ isset($data[0]) ? 'display:block;' : 'display:none;' }}" />
                        </div>
                        <div class="form-group">
                            <div class="col-1">
                                <label for="color">Color</label>
                                <input type="color" class="form-control" id="color" name="color"
                                    placeholder="Masukkan Color" value="{{ isset($data[0]) ? $data[0]->color : '' }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" value="{{ isset($data[0]) ? $data[0]->email : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="wa">WA</label>
                            <input type="wa" class="form-control" id="wa" name="wa"
                                placeholder="Masukkan WA" value="{{ isset($data[0]) ? $data[0]->wa : '' }}" required>
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
