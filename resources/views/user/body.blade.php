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
                    <form action="{{ route('hitung.imt') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label required" for="berat-badan">Berat Badan (KG)</label>
                                    <div class="input-group input-group-merge">
                                        <span id="berat-badan2" class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="number" step="any" class="form-control" id="berat-badan" placeholder="50 kg" aria-label="60 kg" aria-describedby="berat-badan2" name="berat_badan" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label required" for="tinggi-badan">Tinggi Badan (CM)</label>
                                    <div class="input-group input-group-merge">
                                        <span id="tinggi-badan2" class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="number" step="any" class="form-control" id="tinggi-badan" placeholder="160 cm" aria-label="170 cm" aria-describedby="tinggi-badan2" name="tinggi_badan" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Hitung</button>
                    </form>
                    @if(session('success'))
                        <div>{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Tampilkan card Informasi IMT hanya jika ada data tubuh yang sudah dihitung --}}
    @if(isset($latestBody))
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Informasi IMT</h5>
                <div class="card-body">
                    <p> Berat Badan : <strong>{{ $latestBody->berat_badan }}</strong> </p>
                    <p> Tinggi Badan : <strong>{{ $latestBody->tinggi_badan }}</strong> </p>
                    <p> Nilai IMT : <strong>{{ $latestBody->imt }}</strong> </p>
                    <p> Status Gizi : <strong>{{ $latestBody->status_gizi }}</strong> </p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
