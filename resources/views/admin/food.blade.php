

@extends('dashboard')

@section('page')
<h6 class="font-weight-bolder mb-0">Nutrisi</h6> 
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
            <h6>Nutrisi</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                        <div class="container-fluid" >
                            <form action="/foods" method="POST">
                                @method("DELETE")
                                @csrf
                                <input type="submit" value="Hapus Data" name="" id="deleteAllSelectedRecord" class="btn btn-danger" style="float: right;" >                   
                            </form>

                            <!-- Modal Konfirmasi Hapus Data -->
                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data terpilih?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            </div>

                            
                            <button type="button" class="btn btn-primary me-2" id="importDataButton" style="float: right; margin-right:10px;">
                                Import Data
                            </button>
                            
                            <!-- Modal Import Data -->
                            <div class="modal fade" id="importDataModal" tabindex="-1" aria-labelledby="importDataModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importDataModalLabel">Import Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/foods-import " method="post" enctype="multipart/form-data">
                                        @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label required">File</label>
                                                    <input class="form-control" type="file" name="file" mime-types=".xlsx,.xls,.csv" accept=".xlsx,.xls,.csv" required="">
                                                    <span class="text-muted">
                                                        Format file yang diterima adalah .xlsx, .xls, .csv
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="Import">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <script>
                                // Saat dokumen dimuat
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Ambil tombol Import Data
                                    var importDataButton = document.getElementById('importDataButton');
                            
                                    // Tambahkan event listener untuk klik tombol Import Data
                                    importDataButton.addEventListener('click', function () {
                                        // Tampilkan modal Import Data
                                        var importDataModal = new bootstrap.Modal(document.getElementById('importDataModal'));
                                        importDataModal.show();
                                    });
                                });
                            </script>
                            
                        </div>
                    
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="padding-left: 30px;"><input type="checkbox" name="" id="select_all_ids"></th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="padding: 10px;">Nama</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Berat</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kalori (gram)</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">URT</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kalori (urt)</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foods as $food)
                            <tr id="food_ids{{$food->id}}">
                                <td style="padding-left: 30px;"><input type="checkbox" name="ids" class="checkbox_ids" value="{{ $food->id }}"></td>
                                <td>{{ $food->nama }}</td>
                                <td>{{ $food->berat }}</td>
                                <td>{{ $food->kalorigram }}</td>
                                <td>{{ $food->urt }}</td>
                                <td>{{ $food->kaloriurt }}</td>
                                <td>{{ $food->kategori}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(function(e){
    $("#select_all_ids").click(function(){
        $('.checkbox_ids').prop('checked', $(this).prop('checked'));
    });

    $('#deleteAllSelectedRecord').click(function(e){
        e.preventDefault();
        var all_ids = [];
        $('input:checkbox[name=ids]:checked').each(function(){
            all_ids.push($(this).val());
        });

        // modal konfirmasi sebelum menghapus
        $('#confirmDeleteModal').modal('show');

        // tombol konfirmasi hapus
        $('#confirmDeleteBtn').click(function(){
            $.ajax({
                url:"{{ route('food.delete') }}",
                type:"DELETE",
                data:{
                    ids: all_ids,
                    _token:'{{ csrf_token()}}'
                },
                success:function(response){
                    $.each(all_ids, function(key, val){
                        $('#food_ids'+val).remove();
                    });
                    // setelah penghapusan selesai
                    $('#confirmDeleteModal').modal('hide');
                }
            });
        });
    });
});

</script>

@endsection
