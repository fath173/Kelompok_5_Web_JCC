{{-- awal modal Kontak --}}
<div wire:ignore.self class="modal fade" id="updatePassword" tabindex="-1" role="dialog"
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
                        <label for="exampleFormControlInput1">Old Password</label>
                        <input type="password" class="form-control" wire:model="password_old"
                            placeholder="Enter Old Password">
                        @error('password_old') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">New Password</label>
                        <input type="password" class="form-control" wire:model="password_new"
                            placeholder="Enter New Password">
                        @error('password_new') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Retype New Password</label>
                        <input type="password" class="form-control" wire:model="confirm_password"
                            placeholder="Retype New Password">
                        @error('confirm_password') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="genric-btn primary"
                    data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="updatePassword()" class="genric-btn danger">Save
                    Password</button>
            </div>
        </div>
    </div>
</div>
{{-- akhir modal Kontak --}}
