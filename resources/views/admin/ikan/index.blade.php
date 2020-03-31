@extends('admin.template')
@section('title')
Ikan
@endsection

@section('breadcumb')
Ikan
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
                        Data Ikan
                    </div>
                    <div class="card-tools">
                        <a  href="{{route('ikan.create')}}" class="btn btn-primary btn-tambah">Tambah Data <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <br>
                    <div>
                      <table id="Table" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <!-- <th>Foto</th> -->
                            <th>Kode</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Tambak</th>
                            <th>Harga</th>
                            <th>Berat</th>
                           
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
      
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
<script src="{{asset('admin/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>

    $(document).ready(function(){
        $('.liikan').addClass('active');
      
       @if(session()->has('success'))
            toastr.success("{{session('success')}}")
            
       @endif
       
    })
   
    var Table =  $('#Table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                ajax: '{!! route('ikan.datatable') !!}',
                columns:[
                  {'data': 'kode'},
                  {
                    data:"foto",
                    
                    render: function(data, type, row){
                      
                        
                        return '<img src="{!!url("storage/foto/'+data+'")!!}" width="80px" height="80px"/>';
                    }
                  },
                  {'data': 'nama_ikan'},
                  {'data': 'nama_tambak'},
                  {'data': 'harga'},
                  {'data': 'berat'},
                  
                  {
                    data:"id",
                    
                    render: function(data, type, row){
                      
                        var button = `<a href="{{ route('ikan.edit', ['id' => ':id' ]) }}" class="btn btn-warning btn-edit"><i class="fa fa-edit text-white"></i></a>
                                      <a href="#" data-id=":idhapus" class="btn btn-danger btn-delete"><i class="fa fa-trash text-white"></i></a>
                        `
                                button = button.replace(':id',data);
                                button = button.replace(':idhapus',data);
                        return button;
                    }
                  }
                  
                ],
                "order": [[1,'asc']],
    
                rowId: 'id',
               
            });

            $(document).on('click', '.btn-delete', function(){
                var id = this.attributes['data-id'].value;
                var urlsnya = '{{ route("ikan.destroy", ":id") }}';
                    urlsnya = urlsnya.replace(':id', id);
                $.confirm({
                    theme: 'material',
                    title: 'Warning!',
                    content: 'Apakah anda yakin ingin menghapus data ?',
                    buttons: {
                        Yes: function () {
                            $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: id,
                                "_token": "{{ csrf_token() }}",
                                _method: 'DELETE'
                            },
                            url: urlsnya,
                            })
                            .done(function(response) {
                                if(response == 1) {
                                    toastr.error('Data berhasil dihapus')
                                    Table.ajax.reload();
                                }
                            })
                            .fail(function() {
                                $.alert('Delete process fail');
                            })
                            .always(function() {
                                console.log("complete");
                            });
                        },
                        No: function () {
                        return;
                        }
                    }
                });
            });
   

  
</script>
@endsection