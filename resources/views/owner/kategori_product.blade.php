@extends("layout/template")

@section("content")

<div class="mb-2 tambahKategori">
    <button class="btn btn-success" id="btnTambahKategori">Tambah Kategori</button>
</div>
<div class="card tambahKategori">
    <div class="card-body">
        <form action="{{route('kategori_product.store')}}" method="post" id="formKategori">
            @csrf
            <div class="form-group">
                <label for="nama_kategor">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{old('nama_kategori')}}">
                @error('nama_kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-flex justify-content-start mt-2">
                <button type="submit" class="btn btn-primary" id="btnSimpanKategori">Simpan</button>
                <div class="px-2">
                    <button type="button" class="btn btn-danger" id="btnBatalSimpanKategori">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card card-edit d-none">
    <div class="card-body">
        <form action="{{route('kategori_product.store')}}" method="post" id="formEditKategori">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_nama_kategor">Nama Kategori</label>
                <input type="text" name="edit_nama_kategori" id="edit_nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{old('nama_kategori')}}">
                @error('nama_kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="d-flex justify-content-start mt-2">
                <button type="submit" class="btn btn-primary" id="btnSimpanKategori">Simpan</button>
                <div class="px-2">
                    <button type="button" class="btn btn-danger" id="btnBatalSimpanKategori">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Basic DataTables</h4>
    </div>
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($kategori as $row)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$row->nama_kategori}}</td>
                    <td>
                        <button class="btn btn-sm btn-warning tombol-edit" onclick="edit({{$row->id}}, '{{$row->nama_kategori}}')"><i class="fas fa-pen"></i></button>
                        
                        <form action="{{route('kategori_product.destroy', $row->id)}}" method="POST" class="d-inline">
                           @csrf
                           @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
   // function tambahKategori() {
   //    const cardKategori = document.querySelector('.tambahKategori');
   //    cardKategori.classList.toggle('d-none');
   // }

   function edit(id, kategori) {
      console.log(id, kategori);

      const cardKategori = document.querySelectorAll('.tambahKategori');
      const tombolEdit = document.querySelectorAll('.tombol-edit');
      const cardEdit = document.querySelector('.card-edit');
      const formEdit = document.querySelector('#formEditKategori');
      const formInput = document.forms['formEditKategori']['edit_nama_kategori'];

      cardEdit.classList.toggle('d-none');

      for (let i = 0; i < cardKategori.length; i++) {
         cardKategori[i].classList.toggle('d-none');
      }
      formInput.value = kategori;
      formEdit.action = "{{route('kategori_product.update', 'id')}}".replace('id', id);
   }
</script>

@endsection
