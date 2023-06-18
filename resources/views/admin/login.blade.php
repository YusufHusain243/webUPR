@extends('main');

@section('content')
    <main id="main">
        <section class="single-post-content">
            <div class="container d-flex justify-content-center">
                <form method="POST" action='/login'>
                    @csrf
                    <h1>Login Admin</h1>
                    
                    @if (session()->has('Error'))
                        <strong class="text-danger">Gagal!</strong> {{ session('Error') }}
                    @endif

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control w-100" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">password</label>
                        <input type="text" class="form-control w-100" id="password" name="password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
