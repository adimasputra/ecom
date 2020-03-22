@extends('admin.template')
@section('title')
Tambak
@endsection

@section('breadcumb')
Form Tambak
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admin/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Data Tambak
                    </div>
                    <div class="card-tools">
                        <a href=" {{ route('tambak.create') }} " class="btn btn-primary btn-tambah">Tambah Data <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <br>
                    <div>
                      <table id="Table" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Tambak</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Pemilik</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($tambak as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama_tambak }}</td>
                                <td> {{ $row->alamat }} </td>
                                <td> {{ $row->no_telp }} </td>
                                <td> {{ $row->user->nama }} </td>
                                <td> 
                                    <form action=" {{ route('tambak.destroy', ['id' => $row->id]) }} " method="post">
                                    @csrf
                                    @method('delete')
                                        <a href=" {{ route('tambak.edit', ['id' => $row->id ]) }} " class="btn btn-warning btn-edit"><i class="fa fa-edit text-white"></i></a>
                                        
                                        <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Yakin akan hapus data?')"><i class="fa fa-trash text-white"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                       
                      </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')


@endsection