
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
                <form action="{{ route('store') }}" method="post">
                    @csrf
                    <label for="" class="required">Makan Pagi</label>
                    <div class="makan_pagi">
                        <!-- Bagian Makan Pagi -->
                        <div class="form-group makan_pagi_form">
                            <div class="row form-row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" id="kategori_makan_pagi" aria-label="Default select example" name="pilihan_kategori_mp[]">
                                            <option selected>Pilih kategori</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="pilihan_menu">Pilihan Menu</label>
                                        <select class="form-select pilihan-menu"  aria-label="Default select example" name="pilihan_menu_mp[]">
                                            <option selected="">Pilih Menu</option>
                                            <option value=""></option>                                            
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="Satuan">Satuan</label>
                                        <select class="form-select satuan"  aria-label="Default select example" name="satuan_mp[]">
                                            <option selected="">Pilih Satuan</option>
                                            <option value=""></option>                                            
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="" class="required mb-1" style="margin-top: 2px">Kuantitas</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kuantitas" aria-label="Kuantitas" name="kuantitas_urt_gram_mp[]" placeholder="kuantitas">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kuantitas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2 d-md-block" style="margin-top: 29px">
                                        
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
                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" id="kategori_makan_siang" aria-label="Default select example" name="pilihan_kategori_ms[]">
                                            <option selected="">Pilih kategori</option>
                                            
                                                {{-- <option value="{{ $category }}">{{ $category }}</option> --}}
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="pilihan_menu">Pilihan Menu</label>
                                        <select class="form-select pilihan-menu"  aria-label="Default select example" name="pilihan_menu_ms[]">
                                            <option selected="">Pilih Menu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="Satuan">Satuan</label>
                                        <select class="form-select satuan"  aria-label="Default select example" name="satuan_ms[]">
                                            <option selected="">Pilih Satuan</option>
                                            <option value=""></option>                                            
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="" class="required mb-1" style="margin-top: 2px">Kuantitas</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kuantitas" aria-label="Kuantitas" name="kuantitas_urt_gram_ms[]" placeholder="kuantitas">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kuantitas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2 d-md-block" style="margin-top: 29px">
                                      
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
                               
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="kategory">Kategori</label>
                                        <select class="form-select kategori" id="kategori_makan_malam" aria-label="Default select example" name="pilihan_kategori_mm[]">
                                            <option selected="">Pilih kategori</option>
                                            
                                                {{-- <option value="{{ $category }}">{{ $category }}</option> --}}
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="pilihan_menu">Pilihan Menu</label>
                                        <select class="form-select pilihan-menu"  aria-label="Default select example" name="pilihan_menu_mm[]">
                                            <option selected="">Pilih Menu</option>
                                        </select>
                                      
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label required" for="Satuan">Satuan</label>
                                        <select class="form-select satuan" aria-label="Default select example" name="satuan_mm[]">
                                            <option selected="">Pilih Satuan</option>
                                                                                       
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="" class="required mb-1" style="margin-top: 2px">Kuantitas</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kuantitas" aria-label="Kuantitas" name="kuantitas_urt_gram_mm[]" placeholder="kuantitas">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kuantitas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2 d-md-block" style="margin-top: 29px">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary add_makan_malam">+</button>
                    </div>
                    <!-- Tombol Submit -->
                    <button class="btn btn-success w-100 mt-4" type="submit">Hitung</button>
                    
                </form>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        
        
        <div class="card mb-4">                
            <div class="card-body">
                @if(isset($dbKalori))    
                    <div>
                        <p><h6>Total Kalori Makan Pagi : {{ $dbKalori->kalori_pagi }} Kkal</h6></p>
                        <p><h6>Total Kalori Makan Siang : {{ $dbKalori->kalori_siang }} Kkal</h6></p>
                        <p><h6>Total Kalori Makan Malam : {{ $dbKalori->kalori_malam }} Kkal</h6></p> 
                        <p><h4>Total Kalori Hari Ini adalah <b>{{ $sumKalori }} Kkal</b></h4></p>  
                    </div>
                @endif
            </div>
        </div>
        
        
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var categories = {!! json_encode($categories) !!};

    // Iterasi melalui array categories dan tambahkan opsi untuk setiap kategori
    categories.forEach(function(category) {
        // Tambahkan opsi untuk makan pagi
        var optionPagi = document.createElement('option');
        optionPagi.text = category;
        optionPagi.value = category;
        document.getElementById('kategori_makan_pagi').add(optionPagi);

        // Tambahkan opsi untuk makan siang
        var optionSiang = document.createElement('option');
        optionSiang.text = category;
        optionSiang.value = category;
        document.getElementById('kategori_makan_siang').add(optionSiang);

        // Tambahkan opsi untuk makan malam
        var optionMalam = document.createElement('option');
        optionMalam.text = category;
        optionMalam.value = category;
        document.getElementById('kategori_makan_malam').add(optionMalam);
    });


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
            var satuanDropdown = $(this).closest('.form-group').find('.satuan'); 

            satuanDropdown.empty();
            satuanDropdown.append('<option selected="">Pilih Satuan</option>');

            if (urt && berat) {
                satuanDropdown.append('<option value="urt">urt</option>');
                satuanDropdown.append('<option value="gram">gram</option>');
            } else if (urt) {
                satuanDropdown.append('<option value="urt">urt</option>');
            } else if (berat) {
                satuanDropdown.append('<option value="gram">gram</option>');
            }

            satuanDropdown.change(function() {
                var unit = urt ? urt : berat ? ' gram' : '';
                unitSpan.text(unit);
            });
            
        });
        
    });
</script>

@endsection
