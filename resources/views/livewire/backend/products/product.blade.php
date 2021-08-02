<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Produk</strong>
                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#tambahProduk">
                    Tambah Produk
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
                                <form class="form-validate form-horizontal" id="produk_form" method="POST"
                                    enctype="multipart/form-data" action="{{ url('tambah-produk') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="cname" class="control-label col-lg-5">Nama Produk <span
                                                class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                                value="{{ old('nama_produk') }}" />
                                            @if ($errors->has('nama_produk'))
                                                <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="curl" class="control-label col-lg-5">Foto Produk Untuk Web <span
                                                class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" class="form-control" id="foto_produk" name="foto_produk"
                                                value="{{ old('foto_produk') }}">
                                            @if ($errors->has('foto_produk'))
                                                <span class="text-danger">{{ $errors->first('foto_produk') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="curl" class="control-label col-lg-5">Foto Produk Mobile <span
                                                class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="file" class="form-control" id="foto_mobile" name="foto_mobile"
                                                value="{{ old('foto_mobile') }}">
                                            @if ($errors->has('foto_mobile'))
                                                <span class="text-danger">{{ $errors->first('foto_mobile') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="curl" class="control-label col-lg-5">Deskripsi <span
                                                class="required">*</span></label>
                                        <div class="col-lg-10">
                                            <textarea name="deskripsi" id="deskripsi"
                                                class="form-control">{{ old('deskripsi') }}</textarea>
                                            @if ($errors->has('deskripsi'))
                                                <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                                            @endif
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="resetField()"
                                    data-dismiss="modal">Batal</button>
                                <button class="btn btn-success" type="submit">Simpan Produk</button>
                                </form>
                                {{-- <button type="button" wire:click="tambahProduk()" class="btn btn-success">Simpan
                                </button> --}}
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
                            <th>Nama Produk</th>
                            <th>Gambar</th>
                            <th>Gambar Mobile</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td><img src="{{ asset('files/product/' . $product->gambar) }}" style="width: 100px">
                                </td>
                                <td><img src="{{ asset('files/product/' . $product->gambar_mobile) }}"
                                        style="width: 100px">
                                </td>
                                <td>
                                    <a href="/admin-products/{{ $product->id }}/variation"
                                        class="btn btn-warning btn-sm">Variasi</a>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#detailProduk{{ $product->id }}"
                                        wire:click="edit('{{ $product->id }}')">
                                        Detail
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="removeProduk('{{ $product->id }}')">Hapus</button>
                                </td>
                            </tr>
                            <div wire:ignore.self class="modal fade modalProduk" id="detailProduk{{ $product->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-m" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="mediumModalLabel">Produk:
                                                <b>{{ $product->nama_produk }}</b>
                                            </h5>
                                        </div>
                                        <div class="modal-body">

                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        {{-- <form>
                                                            <div class="form-group">
                                                                <label for="cc-payment" class="control-label mb-1">Nama
                                                                    Produk</label>
                                                                <input type="text" class="form-control"
                                                                    aria-required="true" aria-invalid="false"
                                                                    wire:model="nama_produk">
                                                                @error('nama_produk')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" wire:model="photo" id="customFile"
                                                                    accept="image/*" class="custom-file-input"
                                                                    style="cursor: pointer">
                                                                <label for="customFile" class="custom-file-label">Pilih
                                                                    Gambar</label>
                                                                @error('photo')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>
                                                            @if ($photo)
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <label class="mt-2">Gambar Produk</label> <br>
                                                                        <img class="mt-2"
                                                                            src="{{ asset('storage/product/' . $product->gambar) }}"
                                                                            style="width: 100px" alt="Preview">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label class="mt-2">Preview</label> <br>
                                                                        <img class="mt-2"
                                                                            src="{{ $photo->temporaryUrl() }}"
                                                                            style="width: 100px" alt="Preview">
                                                                    </div>
                                                                </div>

                                                            @else
                                                                <label class="mt-2">Gambar Produk</label> <br>
                                                                <img class="mt-2"
                                                                    src="{{ asset('storage/product/' . $product->gambar) }}"
                                                                    style="width: 100px" alt="Preview">
                                                            @endif
                                                            <div class="custom-file mt-3">
                                                                <input type="file" wire:model="photo_mobile"
                                                                    id="customFile" accept="image/*"
                                                                    class="custom-file-input" style="cursor: pointer">
                                                                <label for="customFile" class="custom-file-label">Pilih
                                                                    Gambar Mobile</label>
                                                                @error('photo_mobile')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>
                                                            @if ($photo_mobile)
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <label class="mt-2">Gambar Mobile</label> <br>
                                                                        <img class="mt-2"
                                                                            src="{{ asset('storage/product/' . $product->gambar_mobile) }}"
                                                                            style="width: 100px" alt="Preview">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label class="mt-2">Preview</label> <br>
                                                                        <img class="mt-2"
                                                                            src="{{ $photo_mobile->temporaryUrl() }}"
                                                                            style="width: 100px" alt="Preview">
                                                                    </div>
                                                                </div>

                                                            @else
                                                                <label class="mt-2">Gambar Mobile</label> <br>
                                                                <img class="mt-2"
                                                                    src="{{ asset('storage/product/' . $product->gambar_mobile) }}"
                                                                    style="width: 100px" alt="Preview">
                                                            @endif
                                                            <div class="form-group mt-3">
                                                                <label for="cc-payment" class="control-label mb-1">
                                                                    Deskripsi</label>
                                                                <textarea class="form-control" aria-required="true"
                                                                    aria-invalid="false"
                                                                    wire:model.lazy="deskripsi"> </textarea>
                                                                @error('deskripsi')<small
                                                                    class="text-danger">{{ $message }}</small>@enderror
                                                            </div>

                                                        </form> --}}

                                                        <form class="form-validate form-horizontal" id="produk_form"
                                                            method="POST" enctype="multipart/form-data"
                                                            action="{{ url('edit-produk') }}/{{ $product->id }}">
                                                            @csrf

                                                            <div class="form-group">
                                                                <label for="cname" class="control-label col-lg-5">Nama
                                                                    Produk <span class="required">*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="text" class="form-control"
                                                                        id="nama_produk" name="nama_produk"
                                                                        value="{{ $product->nama_produk }}" />
                                                                    @if ($errors->has('nama_produk'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('nama_produk') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="curl" class="control-label col-lg-5">Foto
                                                                    Produk Untuk Web <span
                                                                        class="required">*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="file" class="form-control"
                                                                        id="foto_produk" name="foto_produk">
                                                                    @if ($errors->has('foto_produk'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('foto_produk') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="curl" class="control-label col-lg-5">Foto
                                                                    Produk Mobile <span
                                                                        class="required">*</span></label>
                                                                <div class="col-lg-10">
                                                                    <input type="file" class="form-control"
                                                                        id="foto_mobile" name="foto_mobile">
                                                                    @if ($errors->has('foto_mobile'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('foto_mobile') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="curl"
                                                                    class="control-label col-lg-5">Deskripsi <span
                                                                        class="required">*</span></label>
                                                                <div class="col-lg-10">
                                                                    <textarea name="deskripsi" id="deskripsi"
                                                                        class="form-control">{{ $product->deskripsi }}</textarea>
                                                                    @if ($errors->has('deskripsi'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('deskripsi') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Update</button>
                                            </form>
                                            {{-- <button type="button" wire:click="updateProduk('{{ $product->id }}')"
                                                class="btn btn-success">Simpan Perubahan</button> --}}

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
        $(".modalProduk").on('hide.bs.modal', function() {
            Livewire.emit('resetField')
        })
    </script>
@endpush
{{-- <form>
    <div class="form-group">
        <label for="cc-payment" class="control-label mb-1">Nama
            Produk</label>
        <input type="text" class="form-control" aria-required="true" aria-invalid="false" wire:model="nama_produk">
        @error('nama_produk')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="custom-file">
        <input type="file" wire:model="photo" id="customFile" accept="image/*" class="custom-file-input"
            style="cursor: pointer">
        <label for="customFile" class="custom-file-label">Pilih
            Gambar</label>
        @error('photo')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    @if ($photo)
        <div class="row ">
            <div class="col">
                <label class="mt-2">Preview</label> <br>
                <img class="mt-2" src="{{ $photo->temporaryUrl() }}" style="width: 100px" alt="Preview">
            </div>
        </div>
    @endif
    <div class="form-group mt-3">
        <label for="cc-payment" class="control-label mb-1">
            Deskripsi</label>
        <textarea class="form-control" aria-required="true" aria-invalid="false"
            wire:model.lazy="deskripsi"> </textarea>
        @error('deskripsi')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
</form> --}}
