{{-- awal modal Kontak --}}
<div wire:ignore.self class="modal fade mt-5 pt-5" id="updateOngkir" tabindex="-1" role="dialog"
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
                <h2>Ongkos Kirim </h2>
                @foreach ($ongkirs as $ongki)
                        <input type="radio" onclick="coba()" name="pengiriman" id="p{{ $loop->iteration }}"
                        jasa="{{ $ongki['nama'] }} {{ $ongki['servis'] }} {{ $ongki['biaya'] }}"
                        harga="{{ $ongki['biaya'] }}">
                        <label for="p{{ $loop->iteration }}">{{ $ongki['nama'] }}
                        {{ $ongki['servis'] }}
                        {{ $ongki['biaya'] }}
                        {{ $ongki['etd'] }}</label><br>
                @endforeach
            </div>
            <div class="modal-footer">
                {{-- <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="updateContact()" class="btn btn-primary"
                    data-dismiss="modal">Save Contact</button> --}}
            </div>
        </div>
    </div>
</div>
{{-- akhir modal Kontak --}}
