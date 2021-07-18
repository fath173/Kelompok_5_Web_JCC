@extends('layouts.backend.main')
@section('content-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Table</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pesan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Atas Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ date('d - m - Y', strtotime($order->tgl_pesan)) }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->status }} {{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td><button type="button" class="btn btn-info mb-1" data-toggle="modal"
                                            data-target="#mediumModal{{ $order->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="mediumModal{{ $order->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="mediumModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="mediumModalLabel">Detail Pesanan:
                                                    <b>{{ $order->user->name }}</b>
                                                </h5>
                                            </div>
                                            <div class="modal-body">

                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col">
                                                            @foreach ($orderz[$key][0] as $detail)
                                                                <div class="row mb-2">
                                                                    <div class="col-3">
                                                                        <img class="rounded-circle"
                                                                            src="{{ asset('storage/images/' . $detail->gambar) }}"
                                                                            width="65px" alt="">
                                                                    </div>
                                                                    <div class="col">
                                                                        {{ $detail->nama_produk }}
                                                                        <span>
                                                                            {{ $detail->berat }}gr <br> <span
                                                                                class="text-lowercase">x</span>
                                                                            {{ $detail->qty }} <br>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <b>Bukti Pembayaran</b>
                                                                    <img src="{{ asset('storage/payment/' . $orders[0]->bukti_bayar) }}"
                                                                        class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="row border-top mt-2">
                                                                <div class="col">
                                                                    <b>Total Pembayaran</b> <br>
                                                                    Rp {{ $order->total }}
                                                                </div>
                                                            </div>
                                                            <div class="row border-top mt-2">
                                                                <div class="col">
                                                                    Alasan menolak pesanan.
                                                                    <textarea name="textarea-input" id="textarea-input"
                                                                        rows="2" placeholder="Content..."
                                                                        class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                @if ($order->status == 'verifikasi')
                                                    <button type="button" class="btn btn-danger">Tolak</button>
                                                    <button type="button" class="btn btn-primary">Verifikasi</button>
                                                @elseif ($order->status == 'sudah bayar')
                                                    <button type="button" class="btn btn-danger">Tolak</button>
                                                    <button type="button" class="btn btn-success">Kirim Pesanan</button>
                                                @endif
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
@endsection
