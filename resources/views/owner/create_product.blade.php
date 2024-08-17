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
    <a href="{{route('data_product.index')}}" class="btn btn-secondary">Kembali</a>
</div>
<div class="card">
    <div class="card-header">
        <h4>Form Tambah Produk</h4>
    </div>
    <div class="card-body">
        <form action="{{route('data_product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{old('nama_produk')}}">
                        @error('nama_produk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                            <option disabled selected>-- Pilih Kategori --</option>
                            @foreach($kategori as $row)
                            <option {{(old('kategori_id') == $row->id ? 'selected' : '')}} value="{{$row->id}}">{{$row->nama_kategori}}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="summernote-simple" name="deskripsi"></textarea>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{old('stok')}}">
                        @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="validatedInputGroupPrepend">Rp.</span>
                            </div>
                            <input type="text" name="harga" id="rupiah" class="form-control @error('harga') is-invalid @enderror" value="{{old('harga')}}">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-info alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Mendukung multiple insert image
                </div>
            </div>
            <div class="preview-container mb-1" id="imgPreviewContainer">
                <img src="{{asset('/img/product/default.jpg')}}" alt="default img" width="120">
            </div>
            <div>
                <small class="text-danger">( Max Size 2MB )</small>
            </div>
            <input type="file" name="gambar[]" id="inputImg" multiple accept="image/jpg, image/jpeg, image/png">
            @error('gambar.*')
            <small class="text-danger">
                {{ $message }}
            </small>
            @enderror
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection