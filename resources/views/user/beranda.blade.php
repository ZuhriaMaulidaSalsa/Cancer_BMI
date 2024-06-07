@extends('dashboard')
@section('page')
<h6 class="font-weight-bolder mb-0">Dashboard</h6> 
@endsection

@section('content')

<div class="col">
    <div class="row mb-4">
        <div class="card">
            <h5 class="card-header">Indeks Masa Tubuh</h5>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Tinggi Badan </th>
                                <th scope="col">Berat Badan</th>
                                <th scope="col">Status Gizi</th>
                                <th scope="col">IMT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bodies as $body)
                            @php
                            $statusColors = [
                                'underweight' => 'bg-warning',
                                'normal' => 'bg-success',
                                'overweight' => 'bg-warning',
                                'obese' => 'bg-danger',
                                // Anda dapat menambahkan status gizi lain dan warna yang sesuai di sini
                            ];
                            @endphp
                                <tr>
                                    <td style="padding-left: 25px">{{ $body->created_at->format('Y-m-d') }}</td>
                                    <td style="padding-left: 25px">{{ $body->tinggi_badan }} (CM)</td>
                                    <td style="padding-left: 25px">{{ $body->berat_badan }} (KG)</td>
                                    <td style="padding-left: 25px">
                                        <span class="badge {{ $statusColors[strtolower($body->status_gizi)] }}">
                                            {{ $body->status_gizi }}
                                        </span>                                      
                                    </td>
                                    <td style="padding-left: 25px">{{ $body->imt }}</td>
                                </tr>
                            @endforeach 
    
                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="card">
            <h5 class="card-header">Kalori Harian</h5>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kalori</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calory->sortByDesc('created_at') as $kalori)
                            <tr>
                                <td style="padding-left: 25px">{{ $kalori->created_at->format('Y-m-d') }}</td>
                                <?php 
                                    $totalKaloriHarian = $kalori->kalori_pagi + $kalori->kalori_siang + $kalori->kalori_malam
                                ?>
                                <td style="padding-left: 25px">{{ $totalKaloriHarian }} Kkal</td>
                                <td style="padding-left: 25px">
                                    <a href="#" title="Informasi" data-toggle="modal" data-target="#myModal_{{ $kalori->id }}"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                            {{-- Modal untuk setiap entri kalori --}}
                            <div class="modal fade" id="myModal_{{ $kalori->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Informasi Kalori</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Menu Pagi : {{$kalori->makan_pagi}} <br>
                                            Kalori : {{$kalori->kalori_pagi}} </p>
                                            
                                            <p>Menu siang : {{$kalori->makan_siang}} <br>
                                            Kalori : {{$kalori->kalori_siang}} </p>
                                            
                                            <p>Menu malam : {{$kalori->makan_malam}} <br>
                                            Kalori : {{$kalori->kalori_malam}} </p>
                                            
                                            
                                            Total Kalori {{ $kalori->created_at->format('Y-m-d')}}: {{ $totalKaloriHarian }} Kkal
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                                
                        </tbody>
                        
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        // Inisialisasi modal Bootstrap
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
</script>

    
@endsection