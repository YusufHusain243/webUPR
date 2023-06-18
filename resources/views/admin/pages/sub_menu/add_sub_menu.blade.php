@extends('admin/main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Sub Menu</h3>
                </div>
                <form method="POST" action="/add-sub-menu/{{$data->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="menu_id">Menu (ID)</label>
                            <input type="text" class="form-control" id="menu_id" name="menu_id"
                                placeholder="Masukkan Menu (ID)">
                        </div>
                        <div class="form-group">
                            <label for="menu_en">Menu (EN)</label>
                            <input type="text" class="form-control" id="menu_en" name="menu_en"
                                placeholder="Masukkan Menu (EN)">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url_id">URL (ID)</label>
                            <input type="text" class="form-control" id="url_id" name="url_id"
                                placeholder="Masukkan URL (ID)" value="/">
                        </div>
                        <div class="form-group">
                            <label for="url_en">URL (EN)</label>
                            <input type="text" class="form-control" id="url_en" name="url_en"
                                placeholder="Masukkan URL (EN)" value="/">
                        </div>

                        <div class="form-group">
                            <label>Jenis Menu</label>
                            <select class="form-control" id="jenis_menu" name="jenis_menu" onchange="val2()">
                                <option>Silahkan Pilih</option>
                                <option value="1">Menu Navbar</option>
                                <option value="2">Menu Kami</option>
                                <option value="3">Menu Navbar & Menu Kami</option>
                            </select>
                        </div>
                        <div class="form-group" id="logo" style="display: none;">
                            <label for="logo">Logo Menu</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="selectImage" name="logo">
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
                            <br>
                            <img id="preview" src="#" class="img-fluid" width="100" style="display:none;" />
                        </div>

                        <div class="form-group">
                            <label>Page</label>
                            <select class="form-control" id="page" name="page" onchange="val()">
                                <option>Silahkan Pilih</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group" id="input_page_id" style="display: none;">
                            <label for="page_id">Page (ID)</label>
                            <textarea class="form-control" id="page_id" name="page_id"></textarea>
                        </div>
                        <div class="form-group" id="input_page_en" style="display: none;">
                            <label for="page_en">Page (EN)</label>
                            <textarea class="form-control" id="page_en" name="page_en"></textarea>
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

    <script>
        function convertToSlug(Text) {
            return Text.toLowerCase()
                .replace(/ /g, "-")
                .replace(/[^\w-]+/g, "");
        }

        function val() {
            x = document.getElementById("page").value;
            if (x == "Ya") {
                document.getElementById("input_page_id").style.display = "block";
                document.getElementById("input_page_en").style.display = "block";

                var menu_id = convertToSlug(document.getElementById("menu_id").value);
                var menu_en = convertToSlug(document.getElementById("menu_en").value);
                document.getElementById("url_id").value = "http://127.0.0.1:8000/sub-menu/" + menu_id;
                document.getElementById("url_en").value = "http://127.0.0.1:8000/sub-menu/" + menu_en;
            } else {
                document.getElementById("input_page_id").style.display = "none";
                document.getElementById("input_page_en").style.display = "none";
                document.getElementById("url_id").value = "/";
                document.getElementById("url_en").value = "/";
            }
        }

        function val2() {
            x = document.getElementById("jenis_menu").value;
            if (x == "2" || x == "3") {
                document.getElementById("logo").style.display = "block";
            } else {
                document.getElementById("logo").style.display = "none";
            }
        }
    </script>
@endpush

@push('summernote')
    <script>
        $(function() {
            $('#page_id').summernote()
            $('#page_en').summernote()
        })
    </script>
@endpush
