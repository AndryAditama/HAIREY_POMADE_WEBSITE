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
        <h4>Form Edit Customer</h4>
    </div>
    <div class="card-body">
        <form action="{{route('customer.update', $customer->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama_customer">Nama Customer</label>
                        <input type="text" name="nama_customer" id="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" value="{{$customer->nama_customer}}">
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
                        <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $customer->alamat}}">
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
                        <input type="number" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $customer->no_hp }}">
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
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $customer->email }}">
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
                        <input type="text" name="password" id="password" placeholder="Masukkan password baru jika ingin mengganti password" class="form-control @error('password') is-invalid @enderror" >
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="preview-container mb-1" id="imgPreviewContainer">
                     @if ($customer->gambar != 'default.jpg')
                         <img src="{{asset('/img/customer/'.$customer->gambar)}}" alt="default img" width="120">
                         @else
                         <img src="{{asset('/img/customer/default.jpg')}}" alt="default img" width="120">
                     @endif
                    </div>
                    <div>
                        <small class="text-danger">( Max Size 2MB )</small>
                    </div>
                    <input type="file" name="gambar" id="inputImg" accept="image/jpg, image/jpeg, image/png">
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