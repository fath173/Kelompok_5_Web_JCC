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
                                <td>
                                    @if ($order->status == 'dibatalkan')
                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                    @elseif ($order->status == 'selesai')
                                        <span class="badge badge-success">{{ $order->status }}</span>
                                    @else
                                        {{ $order->status }}
                                    @endif

                                </td>
                                <td>{{ $order->user->name }} {{ $order->id }}</td>
                                <td><button type="button" class="btn btn-sm btn-info mb-1" data-toggle="modal"
                                        data-target="#mediumModal{{ $order->id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            <div wire:ignore.self class="modal fade" id="mediumModal{{ $order->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="mediumModalLabel">Detail Pesanan:
                                                <b>{{ $order->user->name }} {{ $order->id }}</b>
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
                                                                        src="{{ asset('storage/product/' . $detail->gambar) }}"
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
                                                                <img src="{{ asset('storage/payment/' . $order->bukti_bayar) }}"
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
                                                                @if (empty($order->alasan) && $order->status == 'verifikasi')
                                                                    Alasan menolak pesanan.
                                                                    <textarea name="textarea-input"
                                                                        wire:model="alasan_tolak" rows="2"
                                                                        placeholder="Tulis Disini..."
                                                                        class="form-control"
                                                                        value="HAH HIHI"></textarea>
                                                                    @error('alasan_tolak')
                                                                        <small class="text-danger">
                                                                            {{ $message }}</small>
                                                                    @enderror
                                                                @else
                                                                    <br><b class="bg-danger text-light">
                                                                        {{ $order->alasan }}</b>
                                                                @endif
                                                            </div>
                                                            {{-- <h4>{{ $alasan_tolak }}</h4> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            @if ($order->status == 'verifikasi')
                                                <button type="button" wire:click="cancelOrder('{{ $order->id }}')"
                                                    class="btn btn-danger">Tolak</button>
                                                <button type="button" wire:click="verifikasi('{{ $order->id }}')"
                                                    class="btn btn-primary">Verifikasi</button>
                                            @elseif ($order->status == 'sudah bayar')
                                                {{-- <button type="button" class="btn btn-danger">Tolak</button> --}}
                                                <button type="button" wire:click="sendOrder('{{ $order->id }}')"
                                                    class="btn btn-success">Kirim Pesanan</button>
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
