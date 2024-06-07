@extends('dashboard')

@section('page')
    <h6 class="font-weight-bolder mb-0">Cek Kebutuhan Kalori</h6>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">Hitung Kebutuhan Kalori</h5>
        <div class="card-body">
            <form action="{{ route('hitung.kalori.post') }}" method="post">
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
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label required" for="jenis-kelamin">Jenis Kelamin</label>
                            <select class="form-select" id="jenis-kelamin" name="jenis_kelamin">
                                <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label required" for="usia">Usia (Tahun)</label>
                            <input type="number" class="form-control" id="usia" name="usia">
                        </div>
                    </div>
                </div>

                <label for="" class="required">Aktivitas</label>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aktifitas" value="Ringan">
                        <label class="form-check-label" for="inlineRadio1">Hampir tidak pernah berolahraga</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aktifitas" value="Sedang">
                        <label class="form-check-label" for="inlineRadio2">Jarang berolahraga</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aktifitas" value="Berat">
                        <label class="form-check-label" for="inlineRadio2">Sering berolahraga atau beraktifitas fisik berat</label>
                    </div>
                </div>

                <button class="btn btn-primary w-100" type="submit">Hitung</button>
            </form>

        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card" id="info-kalori" @if(isset($kalori)) style="display: block;" @else style="display: none;" @endif>
                <h5 class="card-header">Informasi Kebutuhan Kalori</h5>
                <div class="card-body">
                    <p> Berat Badan : <strong>{{ $beratBadan }}</strong> </p>
                    <p> Tinggi Badan : <strong>{{ $tinggiBadan }}</strong> </p>
                    <p> Usia : <strong>{{ $usia }}</strong> </p>
                    <p> Jenis Kelamin : <strong>{{ $jenisKelamin }}</strong> </p>
                    <p> Kebutuhan Kalori : <strong>{{ $kalori }} kkal</strong> </p>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
    
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent form submission
    
                // Your form submission logic goes here
                // For simplicity, I'll just show the card when the form is submitted
                document.getElementById('info-kalori').style.display = 'block';
            });
        });
    </script> --}}
    
@endsection
