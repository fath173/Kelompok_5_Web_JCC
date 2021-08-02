<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Petugas</strong>
                <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#tambahPetugas">
                    Tambah Petugas
                </button>
                <div wire:ignore.self class="modal fade modalTambah" id="tambahPetugas" tabindex="-1" role="dialog"
                    aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="mediumModalLabel">Tambah Petugas</h5>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Nama Pegawai</label>
                                                <input type="text" class="form-control" aria-required="true"
                                                    aria-invalid="false" wire:model="name">
                                                {{ $name }}
                                                @error('name')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">E-mail</label>
                                                <input type="text" class="form-control" aria-required="true"
                                                    aria-invalid="false" wire:model="email">
                                                {{ $email }}
                                                @error('email')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Password</label>
                                                <input type="text" class="form-control" aria-required="true"
                                                    aria-invalid="false" wire:model="password">
                                                {{ $password }}
                                                @error('password')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Tulis ulang
                                                    password</label>
                                                <input type="text" class="form-control" aria-required="true"
                                                    aria-invalid="false" wire:model="password_confirmation">
                                                {{ $password_confirmation }}
                                                @error('password_confirmation')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">No HP</label>
                                                <input type="text" class="form-control" aria-required="true"
                                                    aria-invalid="false" wire:model="phone_number">
                                                {{ $phone_number }}
                                                @error('phone_number')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Jenis Kelamin</label>
                                                <select name="select" wire:model="gender" id="select"
                                                    class="form-control">
                                                    <option value="pria">Pria</option>
                                                    <option value="wanita">Wanita</option>
                                                </select>
                                                @error('nama_produk')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="cc-payment" class="control-label mb-1">
                                                    Alamat</label>
                                                <textarea class="form-control" aria-required="true" aria-invalid="false"
                                                    wire:model.lazy="address"> </textarea>
                                                {{ $address }}
                                                @error('address')<small
                                                    class="text-danger">{{ $message }}</small>@enderror
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="resetField()"
                                    data-dismiss="modal">Batal</button>
                                <button type="button" wire:click="tambahPetugas()" class="btn btn-success">Simpan
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
                            <th>Nama Petugas</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPetugas as $key => $petugas)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $petugas->name }}</td>
                                <td>{{ $petugas->gender }}</td>
                                <td>{{ $petugas->phone_number }} </td>
                                <td><button type="button" class="btn btn-sm btn-info mb-1" data-toggle="modal"
                                        data-target="#mediumModal{{ $petugas->id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            <div wire:ignore.self class="modal fade" id="mediumModal{{ $petugas->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="modal-title" id="mediumModalLabel">Detail Pesanan:
                                                <b>{{ $petugas->name }} {{ $petugas->id }}</b>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row border-top mb-3 mt-2">
                                                Email :
                                                <div class="col-3">
                                                    {{ $petugas->email }}
                                                </div>
                                            </div>

                                            <div class="row border-top mb-3 mt-2">
                                                Alamat :
                                                <div class="col">
                                                    {{ $petugas->address }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" wire:click="cancelPelanggan('{{ $petugas->id }}')"
                                                class="btn btn-danger">Tolak</button>
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
