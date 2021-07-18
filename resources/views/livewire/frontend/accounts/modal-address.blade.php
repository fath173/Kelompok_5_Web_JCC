{{-- awal modal Alamat --}}
<div wire:ignore.self class="modal fade" id="updateAlamat" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Provinsi</label>
                        <select class="form-control text-capitalize" wire:model="provinceId" required>
                            <option value="{{ $province }}">{{ $namaProvince }}</option>
                            @forelse ($dataProvince as $p)
                                <option value="{{ $p['province_id'] }}">
                                    {{ $p['province'] }}
                                </option>
                            @empty
                                <option value="">Tidak Ada Provinsi</option>
                            @endforelse
                        </select>
                        @error('provinceId') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Kota/Kabupaten</label>
                        <select class="form-control text-capitalize" wire:model="districtId" required>
                            <option value="{{ $district }}">{{ $namaDistrict }}</option>
                            @forelse ($dataDistrict as $p)
                                <option value="{{ $p['city_id'] }}">
                                    {{ $p['city_name'] }}
                                </option>
                            @empty
                                <option value="">Tidak Ada kota</option>
                            @endforelse
                        </select>
                        @error('districtId') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" wire:model="user_id">
                        <label for="exampleFormControlInput1">Alamat Pengiriman</label>
                        <input type="text" class="form-control" wire:model="address" id="exampleFormControlInput1"
                            placeholder="Alamat Lengkap">
                        @error('address') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <h1>{{ $provinceId }}</h1>
            <h1>{{ $districtId }}</h1>
            <h1>{{ $address }}</h1>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="genric-btn primary"
                    data-dismiss="modal">Close</button>
                <button type="submit" wire:click="updateAddress()" class="genric-btn danger">Simpan
                    Alamat</button>
            </div>
        </div>
    </div>
</div>
{{-- akhir modal Alamat --}}
