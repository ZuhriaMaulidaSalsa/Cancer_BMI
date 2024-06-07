
@extends('dashboard')

@section('page')
<h6 class="font-weight-bolder mb-0">Cek Kalori Hari Ini</h6> 
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Cek Kalori Hari Ini</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('simpan-data') }}" method="post">
                    @csrf
                    <label for="" class="required">Makan Pagi</label>
                    <div class="makan_pagi">
                        <!-- Bagian Makan Pagi -->
                        <div class="form-group makan_pagi_form">
                            <div class="row form-row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" id="kategori_makan_pagi" aria-label="Default select example" name="pilihan_kategori_mp">
                                            <option selected="">Pilih kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="pilihan_menu">Pilihan Menu</label>
                                        <select class="form-select pilihan-menu" menu-makan-pagi="2" aria-label="Default select example" name="pilihan_menu_mp">
                                            <option selected="">Pilih Menu</option>
                                        </select>
                                        {{-- <span class="info" info-makan-pagi="2"></span>
                                        <span class="berat-info"></span>
                                        <span class="kalori-info"></span>
                                        <span class="urt-info"></span>
                                        <span class="kaloriurt-info"></span> --}}
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="satuan">Satuan</label>
                                        <select class="form-select satuan-menu" satuan-makan-pagi="2" name="satuan_makan_pagi[]">
                                            <option selected="">Pilih Satuan</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col">
                                    <label for="" class="required mb-1" style="margin-top: 2px">Kuantitas</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kuantitas" aria-label="Kuantitas" name="kuantitas_urt_gram_mp" placeholder="kuantitas">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kuantitas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2 d-md-block" style="margin-top: 29px">
                                        {{-- <button type="button" class="btn btn-primary add_makan_pagi">+</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_makan_pagi">+</button>
                    </div>
                    <label for="" class="required">Makan siang</label>
                    <div class="makan_siang">
                        <!-- Bagian Makan siang -->
                        <div class="form-group makan_siang_form">
                            <div class="row form-row">
                                {{-- <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" kategori-makan-siang="2" aria-label="Default select example" name="kategori[]">
                                            <option selected="">Pilih kategori</option>
                                            
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" id="kategori_makan_siang" aria-label="Default select example" name="pilihan_kategori_ms">
                                            <option selected="">Pilih kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="pilihan_menu">Pilihan Menu</label>
                                        <select class="form-select pilihan-menu" menu-makan-siang="2" aria-label="Default select example" name="pilihan_menu_ms">
                                            <option selected="">Pilih Menu</option>
                                        </select>
                                        {{-- <span class="info" info-makan-siang="2"></span>
                                        <span class="berat-info"></span>
                                        <span class="kalori-info"></span>
                                        <span class="urt-info"></span>
                                        <span class="kaloriurt-info"></span> --}}
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="satuan">Satuan</label>
                                        <select class="form-select satuan-menu" satuan-makan-siang="2" name="satuan_makan_siang[]">
                                            <option selected="">Pilih Satuan</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col">
                                    <label for="" class="required mb-1" style="margin-top: 2px">Kuantitas</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kuantitas" aria-label="Kuantitas" name="kuantitas_urt_gram_ms" placeholder="kuantitas">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kuantitas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2 d-md-block" style="margin-top: 29px">
                                        {{-- <button type="button" class="btn btn-primary add_makan_siang">+</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_makan_siang">+</button>
                    </div>
                    <label for="" class="required">Makan malam</label>
                    <div class="makan_malam">
                        <!-- Bagian Makan malam -->
                        <div class="form-group makan_malam_form">
                            <div class="row form-row">
                                {{-- <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" kategori-makan-malam="2" aria-label="Default select example" name="kategori[]">
                                            <option selected="">Pilih kategori</option>
                                            
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" id="kategori_makan_malam" aria-label="Default select example" name="pilihan_kategori_mm">
                                            <option selected="">Pilih kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="pilihan_menu">Pilihan Menu</label>
                                        <select class="form-select pilihan-menu" menu-makan-malam="2" aria-label="Default select example" name="pilihan_menu_mm">
                                            <option selected="">Pilih Menu</option>
                                        </select>
                                        {{-- <span class="info" info-makan-malam="2"></span>
                                        <span class="berat-info"></span>
                                        <span class="kalori-info"></span>
                                        <span class="urt-info"></span>
                                        <span class="kaloriurt-info"></span> --}}
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="satuan">Satuan</label>
                                        <select class="form-select satuan-menu" satuan-makan-malam="2" name="satuan_makan_malam[]">
                                            <option selected="">Pilih Satuan</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col">
                                    <label for="" class="required mb-1" style="margin-top: 2px">Kuantitas</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kuantitas" aria-label="Kuantitas" name="kuantitas_urt_gram_mm" placeholder="kuantitas">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kuantitas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2 d-md-block" style="margin-top: 29px">
                                        {{-- <button type="button" class="btn btn-primary add_makan_malam">+</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_makan_malam">+</button>
                    </div>
                    <!-- Tombol Submit -->
                    <button class="btn btn-success w-100 mt-4" type="submit">Hitung</button>
                    
                </form>
            </div>
            <!-- Modal -->
            {{-- <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    
                    </div>
                    <div class="modal-body">
                        <p><h6>Total Kalori Makan Pagi : {{ $lastBreakfast->total_kalori }}</h6></p>
                        <p><h6>Total Kalori Makan Siang : {{ $lastLunch->total_kalori }}</h6></p>
                        <p><h6>Total Kalori Makan Malam : {{ $lastDinner->total_kalori }}</h6></p>  

                        <?php 
                        // $total_kalori_mpmsmm = $lastBreakfast->total_kalori + $lastLunch->total_kalori + $lastDinner->total_kalori; 
                        ?>
                        
                        <h5 class="modal-title" id="exampleModalLabel">Total Kalori Anda Hari Ini adalah <b>{{ $total_kalori_mpmsmm }}</b> Kkal </h5>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
                </div>
            </div> --}}
        </div>

        
        
        <div class="card mb-4">                
            <div class="card-body">
                <div>
                    <p><h6>Total Kalori Makan Pagi : {{ $lastBreakfast->total_kalori }}</h6></p>
                    <p><h6>Total Kalori Makan Siang : {{ $lastLunch->total_kalori }}</h6></p>
                    <p><h6>Total Kalori Makan Malam : {{ $lastDinner->total_kalori }}</h6></p>
                            
                    <?php
                        $total_kalori_mpmsmm = $lastBreakfast->total_kalori + $lastLunch->total_kalori + $lastDinner->total_kalori
                    ?>
                            
                    <p><h4>Total Kalori Hari Ini adalah <b>{{ $total_kalori_mpmsmm }}</b> Kkal </h4></p>  
                </div>
                
            </div>
        </div>
        
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
    $(document).ready(function () {
        // Tambah Makan pagi
        $(".add_makan_pagi").click(function () {
            var makanPagi = $(".makan_pagi_form:first").clone();
            makanPagi.find('input, select').val('');
            $(".makan_pagi").append(makanPagi);
            makanPagi.append('<button type="button" class="btn btn-danger remove_makan_pagi mt-2">-</button>');
        });

        // Hapus Makan Pagi
        $(document).on("click", ".remove_makan_pagi", function () {
            $(this).closest('.makan_pagi_form').remove();
        });

        // Tambah Makan siang
        $(".add_makan_siang").click(function () {
            var makansiang = $(".makan_siang_form:first").clone();
            makansiang.find('input, select').val('');
            $(".makan_siang").append(makansiang);
            makansiang.append('<button type="button" class="btn btn-danger remove_makan_siang mt-2">-</button>');
        });

        // Hapus Makan siang
        $(document).on("click", ".remove_makan_siang", function () {
            $(this).closest('.makan_siang_form').remove();
        });

        // Tambah Makan malam
        $(".add_makan_malam").click(function () {
            var makanmalam = $(".makan_malam_form:first").clone();
            makanmalam.find('input, select').val('');
            $(".makan_malam").append(makanmalam);
            makanmalam.append('<button type="button" class="btn btn-danger remove_makan_malam mt-2">-</button>');
        });

        // Hapus Makan malam
        $(document).on("click", ".remove_makan_malam", function () {
            $(this).closest('.makan_malam_form').remove();
        });
    });

    // ==================================== nampilin kategori -> menu -> urt/gram
    $(document).ready(function () {
        // listener untuk perubahan kategori makanan
        $(document).on('change', '.kategori', function () {
            var kategoriId = $(this).val();
            var selectMenu = $(this).closest('.form-group').find('.pilihan-menu');
            var selectSatuan = $(this).closest('.form-group').find('.satuan');

            // permintaan AJAX ke server untuk mendapatkan menu berdasarkan kategori yang dipilih
            $.ajax({
                url: '/get-foods-by-category/' + kategoriId, 
                type: 'GET',
                success: function (response) {
                
                    selectMenu.empty();
                    selectSatuan.empty();

                
                    selectMenu.append('<option selected="">Pilih Menu</option>');

                
                    $.each(response, function (index, food) {
                        // selectMenu.append('<option value="' + food.id + '">' + food.nama + '</option>');
                        selectMenu.append('<option value="' + food.id + '" data-urt="' + food.urt + '" data-berat="' + food.berat + '">' + food.nama + '</option>');
                    });
                },
            });
        });

        $(document).on('change', '.pilihan-menu', function () {
            var selectedOption = $(this).find('option:selected'); 
            var kuantitasInput = $(this).closest('.form-group').find('.kuantitas'); 
            var unitSpan = $(this).closest('.form-group').find('.input-group-text'); 
            var urt = selectedOption.data('urt'); 
            var berat = selectedOption.data('berat'); 
            var unit = urt ? urt : berat ? 'Gram' : ''; 
            kuantitasInput.attr('placeholder');
            unitSpan.text(unit); 
            
        });


        // listener untuk perubahan menu makanan
        $(document).on('change', '.pilihan-menu', function () {
            var foodId = $(this).val(); 
            var selectSatuan = $(this).closest('.form-group').find('.satuan'); 

            
            $.ajax({
                url: '/get-food-details/' + foodId, 
                type: 'GET',
                success: function (response) {
                    selectSatuan.empty(); 

                    
                    if (response.berat == null || response.kalorigram == null) {
                        if (response.kaloriurt == null) {
                            selectSatuan.append('<option value="gram">Gram</option>');
                        } else if (response.kalorigram == null) {
                            selectSatuan.append('<option value="urt">Urt</option>');
                        }
                    } else {
                        selectSatuan.append('<option value="urt">Urt</option>');
                        selectSatuan.append('<option value="gram">Gram</option>');                        
                    }
                },
            });
    
            });

    });

    //  ========================================
    // $(document).ready(function () {
    //     // Tangani pengiriman formulir saat tombol "Hitung" diklik
    //     $('form').submit(function (event) {
    //         event.preventDefault(); // Hindari pengiriman formulir standar

    //         // Lakukan pengiriman formulir melalui AJAX
    //         $.ajax({
    //             type: $(this).attr('method'),
    //             url: $(this).attr('action'),
    //             data: $(this).serialize(),
    //             success: function (response) {
    //                 // Tampilkan total kalori di dalam modal
    //                 $('#totalKalori').text(response.total_kalori);

    //                 // Tampilkan modal
    //                 $('#myModal').modal('show');
    //             }
    //         });
    //     });

    //     // $('#myModal').on('hidden.bs.modal', function () {
    //     //     window.location.href = "{{ route('cekKalori') }}";
    //     // });

    //     $('#myModal').on('click', '.btn-primary', function () {
    //         $('#myModal').modal('hide');
    //     });

    // });
</script>

@endsection
