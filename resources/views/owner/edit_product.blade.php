@extends('layout/template')

@section('content')
    {{-- @dd($product); --}}
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

        .img-box {
            position: relative;
        }

        .delete {
            position: absolute;
            z-index: 10;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            display: none;
        }

        .img-box:hover .delete {
            display: block;
        }

        .img-box:hover img {
            filter: brightness(40%);
        }
    </style>
    <div class="mb-2">
        <a href="{{ route('data_product.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Produk</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('data_product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group d-flex">
                            <div class="mr-3">
                              <input type="radio" id="radio-active" name="status" value="aktif" {{ $product->status == 'aktif' ? 'checked' : '' }}>
                              <label for="radio-active">Aktif</label>
                            </div>

                            <div>
                              <input type="radio" id="radio-nonactive" name="status" value="non aktif" {{ $product->status == 'non aktif' ? 'checked' : '' }}>
                              <label for="radio-nonactive">Non Aktif</label>
                            </div>

                            {{-- <input type="text" name="nama_produk" id="nama_produk"
                                class="form-control @error('nama_produk') is-invalid @enderror"
                                value="{{ $product->nama_produk }}">
                            @error('nama_produk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk"
                                class="form-control @error('nama_produk') is-invalid @enderror"
                                value="{{ $product->nama_produk }}">
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
                            <select name="kategori_id" id="kategori_id"
                                class="form-control @error('kategori_id') is-invalid @enderror">
                                <option disabled selected>-- Pilih Kategori --</option>
                                @foreach ($kategori as $row)
                                    <option {{ $product->kategori_id == $row->id ? 'selected' : '' }}
                                        value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
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
                    <textarea class="summernote-simple" name="deskripsi">{{ $product->deskripsi }}</textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" id="stok"
                                class="form-control @error('stok') is-invalid @enderror" value="{{ $product->stok }}">
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
                                <input type="text" name="harga" id="rupiah"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ $product->harga }}">
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

                    @foreach ($images as $item)

                        @if ($imagesCount > 1)
                            
                            <div class="img-box">
                                <img src="{{ asset('/img/product/' . $item->gambar) }}" alt="default img" width="120">
                                <div class="delete">
                                    <a href="{{ route('data_product.destroy', $item->id) }}" class="btn btn-sm btn-danger"><i
                                            class="fas fa-trash"></i></a>
    
                                </div>
    
                            </div>
                        @else

                        <img src="{{ asset('/img/product/' . $item->gambar) }}" alt="default img" width="120">
                        @endif
                    @endforeach

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
