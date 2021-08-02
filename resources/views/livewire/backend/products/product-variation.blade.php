<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Variasi</strong>
                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#tambahProduk">
                    Tambah Variasi
                </button>
                <div wire:ignore.self class="modal fade modalTambah" id="tambahProduk" tabindex="-1" role="dialog"
                    aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Produk</h5>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Nama
                                            Produk</label>
                                        <input type="text" class="form-control" aria-required="true"
                                            aria-invalid="false" wire:model="nama_variasi">
                                        @error('nama_produk')<small
                                            class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Berat</label>
                                        <input type="text" class="form-control" aria-required="true"
                                            aria-invalid="false" wire:model="berat">
                                        @error('berat')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Stok</label>
                                        <input type="text" class="form-control" aria-required="true"
                                            aria-invalid="false" wire:model="stok">
                                        @error('stok')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Harga</label>
                                        <input type="text" class="form-control" aria-required="true"
                                            aria-invalid="false" wire:model="harga">
                                        @error('harga')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>

                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="resetField()"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" wire:click="tambahVariasi()" class="btn btn-success">Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Variasi</th>
                            <th>Berat</th>
                            <th>stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details[0]->variasi as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->nama_variasi }}</td>
                                <td> {{ $detail->berat }}</td>
                                <td> {{ $detail->stok }}</td>
                                <td> {{ $detail->harga }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#variasi{{ $detail->id }}"
                                        wire:click="edit('{{ $detail->id }}')">
                                        Detail
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="removeVariasi('{{ $detail->id }}')">Hapus</button>
                                </td>
                            </tr>
                            <div wire:ignore.self class="modal fade modalVariasi" id="variasi{{ $detail->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-m" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="mediumModalLabel">Produk:
                                                <b>{{ $detail->nama_produk }}</b> {{ $detail->id }}
                                            </h5>
                                        </div>
                                        <div class="modal-body">

                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1">Nama
                                                                    Produk</label>
                                                                <input type="text" class="form-control"
                                                                    aria-required="true" aria-invalid="false"
                                                                    wire:model="nama_variasi">
                                                                @error('nama_produk')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cc-payment"
                                                                    class="control-label mb-1">Berat</label>
                                                                <input type="text" class="form-control"
                                                                    aria-required="true" aria-invalid="false"
                                                                    wire:model="berat">
                                                                @error('berat')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cc-payment"
                                                                    class="control-label mb-1">Stok</label>
                                                                <input type="text" class="form-control"
                                                                    aria-required="true" aria-invalid="false"
                                                                    wire:model="stok">
                                                                @error('stok')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cc-payment"
                                                                    class="control-label mb-1">Harga</label>
                                                                <input type="text" class="form-control"
                                                                    aria-required="true" aria-invalid="false"
                                                                    wire:model="harga">
                                                                @error('harga')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" wire:click="updateVariasi('{{ $detail->id }}')"
                                                class="btn btn-success">Simpan Perubahan</button>
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

@push('script-custom')
    <script>
        $(".modalVariasi").on('hide.bs.modal', function() {
            Livewire.emit('resetField')
        })

    </script>
@endpush
