@extends('admin/main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Sub Menu</h3>
                </div>
                <form method="POST" action="/edit-sub-menu/{{ $data->id }}/{{ $menu->id }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="menu_id">Menu (ID)</label>
                            <input type="text" class="form-control" id="menu_id" name="menu_id"
                                placeholder="Masukkan Menu (ID)" value="{{ $data->menu_id }}">
                        </div>
                        <div class="form-group">
                            <label for="menu_en">Menu (EN)</label>
                            <input type="text" class="form-control" id="menu_en" name="menu_en"
                                placeholder="Masukkan Menu (EN)" value="{{ $data->menu_en }}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ $data->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                    Aktif
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url_id">URL (ID)</label>
                            <input type="text" class="form-control" id="url_id" name="url_id"
                                placeholder="Masukkan URL (ID)" value="{{ $data->url_id }}">
                        </div>
                        <div class="form-group">
                            <label for="url_en">URL (EN)</label>
                            <input type="text" class="form-control" id="url_en" name="url_en"
                                placeholder="Masukkan URL (EN)" value="{{ $data->url_en }}">
                        </div>

                        <div class="form-group">
                            <label>Jenis Menu</label>
                            <select class="form-control" id="jenis_menu" name="jenis_menu" onchange="val2()">
                                <option>Silahkan Pilih</option>
                                <option value="1" {{ $data->jenis_menu == '1' ? 'selected' : '' }}>Menu Navbar</option>
                                <option value="2" {{ $data->jenis_menu == '2' ? 'selected' : '' }}>Menu Kami</option>
                                <option value="3" {{ $data->jenis_menu == '3' ? 'selected' : '' }}>Menu Navbar & Menu
                                    Kami
                                </option>
                            </select>
                        </div>
                        <div class="form-group" id="logo"
                            style="{{ isset($data->logo) ? 'display: block;' : 'display: none;' }}">
                            <label for="logo">Logo Menu</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="selectImage" name="logo">
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
                            <br>
                            <img id="preview"
                                src="{{ isset($data->logo) ? asset('storage/images/' . $data->logo) : '#' }}"
                                class="img-fluid" width="100"
                                style="{{ isset($data->logo) ? 'display:block;' : 'display:none;' }}" />
                        </div>

                        <div class="form-group">
                            <label>Page</label>
                            <select class="form-control" id="page" name="page" onchange="val()">
                                <option>Silahkan Pilih</option>
                                <option value="Ya" {{ $data->page == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ $data->page == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                        <div class="form-group" id="input_page_id"
                            style="{{ $data->page == 'Ya' ? 'display: block;' : 'display: none;' }}">
                            <label for="page_id">Page (ID)</label>
                            <textarea class="form-control" id="page_id" name="page_id">
                                 @if (isset($data->subMenuToContent))
{!! $data->subMenuToContent->page_id !!}
@endif
                            </textarea>
                        </div>
                        <div class="form-group" id="input_page_en"
                            style="{{ $data->page == 'Ya' ? 'display: block;' : 'display: none;' }}">
                            <label for="page_en">Page (EN)</label>
                            <textarea class="form-control" id="page_en" name="page_en">
                                 @if (isset($data->subMenuToContent))
{!! $data->subMenuToContent->page_en !!}
@endif
                            </textarea>
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
