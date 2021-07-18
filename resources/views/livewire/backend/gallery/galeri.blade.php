<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Produk</strong>
                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#tambahFoto">
                    Tambah Foto
                </button>
                <div wire:ignore.self class="modal fade modalTambah" id="tambahFoto" tabindex="-1" role="dialog"
                    aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Foto</h5>
                            </div>
                            <div class="modal-body">

                                <form>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Judul Foto</label>
                                        <input type="text" class="form-control" aria-required="true"
                                            aria-invalid="false" wire:model="judul_gambar">
                                        @error('judul_gambar')<small
                                            class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" wire:model="photo" id="customFile" accept="image/*"
                                            class="custom-file-input" style="cursor: pointer">
                                        <label for="customFile" class="custom-file-label">Pilih
                                            Gambar</label>
                                        @error('photo')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    @if ($photo)
                                        <div class="row ">
                                            <div class="col">
                                                <label class="mt-2">Preview</label> <br>
                                                <img class="mt-2" src="{{ $photo->temporaryUrl() }}"
                                                    style="width: 100px" alt="Preview">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group mt-3">
                                        <label for="cc-payment" class="control-label mb-1">
                                            Tanggal Gambar</label>
                                        <input type="text" class="form-control" aria-required="true"
                                            aria-invalid="false" wire:model="tgl_gambar">
                                        @error('tgl_gambar')<small
                                            class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="cc-payment" class="control-label mb-1">
                                            Deskripsi</label>
                                        <textarea class="form-control" aria-required="true" aria-invalid="false"
                                            wire:model.lazy="deskripsi"> </textarea>
                                        @error('deskripsi')<small
                                            class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="resetField()"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" wire:click="tambahFoto()" class="btn btn-success">Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($gallery as $galeri)
                        <div class="col-md-4">
                            <div class="card">
                                <div style="height: 200px; width:100%; overflow: hidden;">
                                    <div
                                        style="background-image: url({{ asset('storage/gallery/' . $galeri->gambar) }}); background-repeat: no-repeat; background-size: cover; background-position: top center; height:200px;">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4 class="card-title mb-3">{{ $galeri->judul_gambar }}</h4>
                                            <span class="card-text"
                                                style="font-size: 14px;display: inline-block;overflow: hidden !important;width: 70%;white-space: nowrap;text-overflow: ellipsis;color: grey;">
                                                {{ $galeri->deskripsi }}</span>
                                        </div>
                                        <div class="col-4 ">
                                            <div class="row d-flex justify-content-center">

                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#detailGaleri{{ $galeri->id }}"
                                                    wire:click="edit('{{ $galeri->id }}')">
                                                    Detail
                                                </button>

                                            </div>
                                            <div class="row mt-1 d-flex justify-content-center">

                                                <button class="btn btn-danger btn-sm"
                                                    wire:click="removeFoto('{{ $galeri->id }}')">Hapus</button>

                                            </div>
                                        </div>
                                        <div wire:ignore.self class="modal fade modalFoto"
                                            id="detailGaleri{{ $galeri->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="mediumModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-m" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title" id="mediumModalLabel">Foto:
                                                            <b>{{ $galeri->judul_gambar }}</b>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <form>
                                                                        <div class="form-group">
                                                                            <label for="cc-payment"
                                                                                class="control-label mb-1">Judul
                                                                                Foto</label>
                                                                            <input type="text" class="form-control"
                                                                                aria-required="true"
                                                                                aria-invalid="false"
                                                                                wire:model="judul_gambar">
                                                                            @error('judul_gambar')<small
                                                                                class="text-danger">{{ $message }}</small>@enderror
                                                                        </div>
                                                                        <div class="custom-file">
                                                                            <input type="file" wire:model="photo"
                                                                                id="customFile" accept="image/*"
                                                                                class="custom-file-input"
                                                                                style="cursor: pointer">
                                                                            <label for="customFile"
                                                                                class="custom-file-label">Pilih
                                                                                Gambar</label>
                                                                            @error('photo')<small
                                                                                class="text-danger">{{ $message }}</small>@enderror
                                                                        </div>
                                                                        @if ($photo)
                                                                            <div class="row ">
                                                                                <div class="col">
                                                                                    <label class="mt-2">Gambar
                                                                                        Produk</label> <br>
                                                                                    <img class="mt-2"
                                                                                        src="{{ asset('storage/gallery/' . $galeri->gambar) }}"
                                                                                        style="width: 100px"
                                                                                        alt="Preview">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <label class="mt-2">Preview</label>
                                                                                    <br>
                                                                                    <img class="mt-2"
                                                                                        src="{{ $photo->temporaryUrl() }}"
                                                                                        style="width: 100px"
                                                                                        alt="Preview">
                                                                                </div>
                                                                            </div>

                                                                        @else
                                                                            <label class="mt-2">Gambar Produk</label>
                                                                            <br>
                                                                            <img class="mt-2"
                                                                                src="{{ asset('storage/gallery/' . $galeri->gambar) }}"
                                                                                style="width: 100px" alt="Preview">
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <label for="cc-payment"
                                                                                class="control-label mb-1">Tanggal Foto
                                                                                <b>Contoh: 2020-11-24</b></label>
                                                                            <input type="text" class="form-control"
                                                                                aria-required="true"
                                                                                aria-invalid="false"
                                                                                wire:model="tgl_gambar">
                                                                            @error('tgl_gambar')<small
                                                                                class="text-danger">{{ $message }}</small>@enderror
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <label for="cc-payment"
                                                                                class="control-label mb-1">
                                                                                Deskripsi</label>
                                                                            <textarea class="form-control"
                                                                                aria-required="true"
                                                                                aria-invalid="false"
                                                                                wire:model.lazy="deskripsi"> </textarea>
                                                                            @error('deskripsi')<small
                                                                                class="text-danger">{{ $message }}</small>@enderror
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            wire:click="updateFoto('{{ $galeri->id }}')"
                                                            class="btn btn-success">Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('script-custom')
    <script>
        $(".modalFoto").on('hide.bs.modal', function() {
            Livewire.emit('resetField')
        })

    </script>
@endpush
