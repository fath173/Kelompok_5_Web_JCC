@if ($orders->status == 'verifikasi' || $orders->status == 'belum bayar')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h4>Form Pembayaran</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            Silahkan melakukan pembayaran <b>Rp {{ $orders->total }}</b> ke <br>
                            <b>BANK MANDIRI 137-889900-753 AN. Fathor Rahman</b>
                        </div>
                        <form class="form-validate form-horizontal" method="POST" enctype="multipart/form-data"
                            action="{{ url('fotobukti') }}/{{ $orders->id }}">
                            {{-- {!! csrf_field() !!} --}}
                            @csrf
                            <div class="form-group">
                                <label for="curl" class="control-label col-lg-5">Upload Foto Bukti <span
                                        class="required">*</span></label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" id="imagePayment" name="imagePayment"
                                        value="{{ old('imagePayment') }}">
                                    @if ($errors->has('imagePayment'))
                                        <span class="text-danger">{{ $errors->first('imagePayment') }}</span>
                                    @endif
                                </div>
                            </div>
                            <b class="text-danger">Max 2Mb</b>
                    </div>
                    <div class="card-footer">
                        <button class="genric-btn danger" type="submit">Save Payment</button>
                        </form>
                        {{-- <button type="submit" wire:click.prevent="updateBayar()" class="genric-btn danger"
                            data-dismiss="modal">Save Payment</button> --}}

                    </div>
                </div>
            </div>
            <div class="col-6">
                <h4>Bukti Pembayaran</h4>
                <div class="card">
                    <div class="card-body">
                        @if (!empty($image))
                            <label class="mt-2">Upload Preview</label>
                            <img class="mt-2" src="{{ $image->temporaryUrl() }}" style="width: 100%" alt="Preview">
                        @else
                            <label class="mt-2">Upload Preview</label>
                            <img class="mt-2" src="{{ asset('files/payment/' . $orders->bukti_bayar) }}"
                                style="width: 100%" alt="Preview">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <h1>empty</h1>
@endif
