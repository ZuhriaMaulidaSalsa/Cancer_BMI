@extends('dashboard')

@section('page')
    <h6 class="font-weight-bolder mb-0">Cek Indeks Massa Tubuh</h6> 
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Hitung Indeks Masa Tubuh</h5>
                <div class="card-body">
                    <form id="imtForm" action="{{ route('hitung.imt') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label required" for="berat-badan">Berat Badan (KG)</label>
                                    <div class="input-group input-group-merge">
                                        <span id="berat-badan2" class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="number" step="any" class="form-control" id="berat-badan" placeholder="50 kg" aria-label="60 kg" aria-describedby="berat-badan2" name="berat_badan" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label required" for="tinggi-badan">Tinggi Badan (CM)</label>
                                    <div class="input-group input-group-merge">
                                        <span id="tinggi-badan2" class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="number" step="any" class="form-control" id="tinggi-badan" placeholder="160 cm" aria-label="170 cm" aria-describedby="tinggi-badan2" name="tinggi_badan" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="hitungButton" class="btn btn-primary w-100" type="submit">Hitung</button>
                    </form>
                    @if(session('success'))
                        <div>{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($bodies->isNotEmpty())
        @php
            $latestBody = $bodies->last(); // Ambil data tubuh terbaru
        @endphp
        <div class="row mt-3" id="cardContainer">
            <div class="col-md-12">
                <div class="card" id="imtCard">
                    <h5 class="card-header text-center">Informasi IMT</h5>
                    <div class="card-body text-center">
                        <div class="row">
                            {{-- <div class="col"> <h5>Berat :<strong> {{ $latestBody->berat_badan }} </strong>KG</h5> </div>
                            <div class="col"> <h5> Tinggi :<strong> {{ $latestBody->tinggi_badan }} </strong>CM</h5> </div> --}}
                            <div class="col"> <h5>Berat :<strong id="beratDisplay"> </strong>KG</h5> </div>
                            <div class="col"> <h5> Tinggi :<strong id="tinggiDisplay"> </strong>CM</h5> </div>
                        </div>
                        {{-- <h4 class="mt-1"> Nilai IMT Admin adalah : <strong>{{ $latestBody->imt }}</strong> </h4> --}}
                        <h4 class="mt-1"> Nilai IMT Anda adalah : <strong id="imtDisplay"></strong> </h4>
                        <h4 class="mb-1">
                            @php
                                $status_gizi = $latestBody->status_gizi;
                                $status_text = '';
                                $color_class = '';

                                // Assigning text and color based on the status gizi
                                switch($status_gizi) {
                                    case 'Underweight':
                                        $status_text = 'Underweight';
                                        $color_class = 'bg-warning'; // Yellow color for underweight
                                        break;
                                    case 'Normal':
                                        $status_text = 'Normal';
                                        $color_class = 'bg-success'; // Green color for normal
                                        break;
                                    case 'Overweight':
                                        $status_text = 'Overweight';
                                        $color_class = 'bg-danger'; // Red color for overweight
                                        break;
                                    case 'Obese':
                                        $status_text = 'Obese';
                                        $color_class = 'bg-danger'; // Red color for obese (same as overweight)
                                        break;
                                    default:
                                        $status_text = 'Unknown';
                                        $color_class = 'bg-secondary'; // Gray color for unknown
                                }
                            @endphp

                            <!-- Displaying status text with corresponding color -->
                            <button id="statusDisplay" class="btn {{ $color_class }} w-35 text-white" style="font-size: 1.2rem">{{ $status_text }}</button> 
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <script>
        // Ambil elemen-elemen yang dibutuhkan
        var cardContainer = document.getElementById('cardContainer');
        var imtCard = document.getElementById('imtCard');
    
        // Sembunyikan card saat halaman dimuat
        imtCard.style.display = 'none';
    
        // Fungsi untuk menampilkan card jika input diisi dan tombol hitung ditekan
        function tampilkanCard(event) {
            event.preventDefault();
            var beratBadanInput = document.getElementById('berat-badan').value;
            var tinggiBadanInput = document.getElementById('tinggi-badan').value;
    
            // Periksa apakah input berat dan tinggi sudah diisi
            if (beratBadanInput && tinggiBadanInput) {
                // Tampilkan card jika input sudah diisi
                imtCard.style.display = 'block';
            } else {
                // Sembunyikan card jika input belum diisi
                imtCard.style.display = 'none';
            }
        }
    
        // Panggil fungsi tampilkanCard() saat tombol hitung ditekan
        document.getElementById('hitungButton').addEventListener('click', function(event) {
            tampilkanCard(event);
        });
    </script> --}}

    <script>
        // Ambil elemen-elemen yang dibutuhkan
        var imtCard = document.getElementById('imtCard');
        var beratBadanDisplay = document.getElementById('beratDisplay');
        var tinggiBadanDisplay = document.getElementById('tinggiDisplay');
        var imtDisplay = document.getElementById('imtDisplay');
        var statusDisplay = document.getElementById('statusDisplay');
        
        // Sembunyikan card saat halaman dimuat
        imtCard.style.display = 'none';
    
        // Fungsi untuk menampilkan card informasi IMT
        function tampilkanInformasiIMT(berat, tinggi, imt) {
            beratBadanDisplay.textContent = berat;
            tinggiBadanDisplay.textContent = tinggi;
            imtDisplay.textContent = imt;
            imtCard.style.display = 'block';
        }
    
        // Fungsi untuk menampilkan status gizi berdasarkan IMT
        function setStatusGizi(bmi) {
            var status_text = '';
            var color_class = '';
            
            if (bmi < 18.5) {
                status_text = 'Underweight';
                color_class = 'btn-warning'; // Sesuaikan dengan kelas yang tepat
            } else if (bmi >= 18.5 && bmi < 24.9) {
                status_text = 'Normal';
                color_class = 'btn-success'; // Sesuaikan dengan kelas yang tepat
            } else if (bmi >= 24.9 && bmi < 29.9) {
                status_text = 'Overweight';
                color_class = 'btn-danger'; // Sesuaikan dengan kelas yang tepat
            } else {
                status_text = 'Obese';
                color_class = 'btn-danger'; // Sesuaikan dengan kelas yang tepat
            }
    
            statusDisplay.textContent = status_text;
            statusDisplay.classList.add('btn', color_class); // Tambahkan kelas 'btn' agar warna bekerja dengan baik
        }
    
        // Fungsi untuk menampilkan card jika input diisi dan tombol hitung ditekan
        function tampilkanCard(event) {
            event.preventDefault();
            var beratBadanInput = document.getElementById('berat-badan').value;
            var tinggiBadanInput = document.getElementById('tinggi-badan').value;
    
            // Periksa apakah input berat dan tinggi sudah diisi
            if (beratBadanInput && tinggiBadanInput) {
                var bmi = beratBadanInput / ((tinggiBadanInput / 100) ** 2);
                setStatusGizi(bmi);
                tampilkanInformasiIMT(beratBadanInput, tinggiBadanInput, bmi.toFixed(2));
            } else {
                // Sembunyikan card jika input belum diisi
                imtCard.style.display = 'none';
            }
        }
    
        // Panggil fungsi tampilkanCard() saat tombol hitung ditekan
        document.getElementById('imtForm').addEventListener('submit', function(event) {
            tampilkanCard(event);
        });
    </script>
    
@endsection
