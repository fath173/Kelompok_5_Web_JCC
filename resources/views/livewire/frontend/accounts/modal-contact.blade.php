{{-- awal modal Kontak --}}
<div wire:ignore.self class="modal fade" id="updateKontak" tabindex="-1" role="dialog"
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
                        <input type="hidden" wire:model="user_id">
                        <label for="exampleFormControlInput1">E-mail</label>
                        <input type="text" class="form-control" wire:model="email" id="exampleFormControlInput1"
                            placeholder="Enter Email">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">No Telepon</label>
                        <input type="email" class="form-control" wire:model="phone_number" id="exampleFormControlInput2"
                            placeholder="Enter Phone Number">
                        @error('phone_number') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="cancel()" class="genric-btn primary"
                    data-dismiss="modal">Close</button>
                <button type="button" wire:click="updateContact()" class="genric-btn danger">Simpan</button>
            </div>
        </div>
    </div>
</div>
{{-- akhir modal Kontak --}}
