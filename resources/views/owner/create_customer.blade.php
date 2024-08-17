@extends("layout/template")

@section("content")
<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
    }

    .preview-container img {
        margin: 10px;
        width: 120px;
        height: 120px;
        object-fit: cover;
    }
</style>
<div class="mb-2">
    <a href="{{route('customer.index')}}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card">
    <div class="card-header">
        <h4>Form Tambah Customer</h4>
    </div>
    <div class="card-body">
        <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama_customer">Nama Customer</label>
                        <input type="text" name="nama_customer" id="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" value="{{old('nama_customer')}}">
                        @error('nama_customer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="number" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{old('no_hp')}}">
                        @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="preview-container mb-1" id="imgPreviewContainer">
                        <img src="{{asset('/img/product/default.jpg')}}" alt="default img" width="120">
                    </div>
                    <div>
                        <small class="text-danger">( Max Size 2MB )</small>
                    </div>
                    <input type="file" name="gambar" id="inputImg" multiple accept="image/jpg, image/jpeg, image/png">
                    @error('gambar.*')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection