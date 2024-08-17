@extends("layout/template")

@section("content")



<div class="mb-2">
    <a href="{{route('customer.create')}}" class="btn btn-primary">Tambah Customer</a>
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
                    <td>Gambar</td>
                    <td>Nama Customer</td>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($customer as $row)
                <tr>
                    <td>{{$no++}}</td>
                    <td>
                        <div class="gallery gallery-md">
                            <div class="gallery-item" data-image="{{ asset('/img/customer/'. $row->gambar) }}" data-title="Img {{$row->nama_customer}}"></div>
                        </div>
                    </td>
                    <td>{{$row->nama_customer}}</td>
                    <td>{{$row->alamat}}</td>
                    <td>+62{{$row->no_hp}}</td>
                    <td>
                        <a href="{{route('customer.show', $row->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>

                        {{-- <button type="button" id="btndelete" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> --}}



                        <form action="{{ route('customer.destroy', $row->user_id)}}" method="post" class="d-inline">
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

{{-- 
   // popup delete
   <script>
  function confirmDelete(event, deleteUrl) {
    event.preventDefault(); // Mencegah aksi default dari tombol

    // Menampilkan dialog konfirmasi
    const userConfirmed = confirm("Apakah Anda yakin ingin menghapus item ini?");

    if (userConfirmed) {
      // Jika pengguna mengklik "OK", arahkan ke URL penghapusan
      window.location.href = deleteUrl;
    }
  }
</script> --}}


@endsection