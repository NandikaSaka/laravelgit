@extends('layout.template')

@section('konten')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    
    <div class="pb-3">
        <form class="d-flex" action="{{ url('mahasiswaData') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>

    <div class="pb-3">
        <a href="{{ url('mahasiswaData/create') }}" class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <th class="col-md-1">NO.</th>
            <th class="col-md-3">NIM</th>
            <th class="col-md-4">Nama</th>
            <th class="col-md-6">Alamat</th>
            <th class="col-md-4">Email</th>
            <th class="col-md-4">Jurusan</th>
            <th class="col-md-2">Aksi</th>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->jurusan }}</td>
                <td>
                    <a href="{{ url('mahasiswaData/'.$item->nim.'/edit') }}" class="btn btn-sm">Edit</a>
                    <form @confirm('Apakah Anda yakin ingin menghapus data?') class="d-inline" action="{{ url('mahasiswaData/'.$item->nim) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>                    
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>

@endsection