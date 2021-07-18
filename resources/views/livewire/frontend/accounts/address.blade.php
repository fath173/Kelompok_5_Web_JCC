<div class="container">
    <div class="row">
        <div class="col">
            <button data-toggle="modal" data-target="#updateAlamat" wire:click="edit()" class="genric-btn danger">Edit
                Alamat</button>
            @include('livewire.frontend.accounts.modal-address')

            <ul class="list-group mt-2">
                <li class="list-group-item"><b>Alamat Pengiriman : </b>{{ $user->address }}</li>
            </ul>

        </div>
    </div>
</div>
