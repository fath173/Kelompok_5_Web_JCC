<main>
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding ">
        <div class="container mb-5 pb-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog_right_sidebar shadow-sm">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Foto Profile</h3>
                            <div class="media post_item">
                                <div class="media-body">
                                    <div class="card pb-5">
                                        <img src="{{ asset('storage/img-users/' . $user->image) }}"
                                            class="card-img-top" style="width:100%; height:200px">
                                        <div class="card-body pt-5">
                                            <b class="card-title">Pilih Foto :</b>
                                            <button data-toggle="modal" data-target="#updateImage" wire:click="edit()"
                                                class="genric-btn primary-border medium">Pilih
                                                File</button>
                                            @include('livewire.frontend.accounts.modal-image')
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="media post_item mt-5">
                                <div class="media-body">
                                    <div class="row">
                                        <button data-toggle="modal" data-target="#updatePassword" wire:click="edit()"
                                            class="genric-btn primary medium btn-block">Ganti Password</button>
                                        @include('livewire.frontend.accounts.modal-password')
                                    </div>

                                </div>
                            </div>

                        </aside>
                    </div>
                </div>
                <div class="col-lg-8 posts-list">

                    <div class="blog-author mt-3 shadow-sm">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3>Biodata</h3> <br>
                                <button data-toggle="modal" data-target="#updateBio" wire:click="edit()"
                                    class="genric-btn link radius small">Edit Biodata</button>
                                @include('livewire.frontend.accounts.modal-bio')

                                <ul class="list-group mt-2">
                                    <li class="list-group-item"><b>Nama : </b>{{ $user->name }}</li>
                                    <li class="list-group-item"><b>Gender : </b>{{ $user->gender }} </li>
                                    <li class="list-group-item"><b>Tanggal Lahir : </b>{{ $user->birthday }}</li>
                                    <li class="list-group-item"><b>Alamat Pengiriman : </b>{{ $user->address }}</li>
                                </ul>

                                <a href="/account-address" class="genric-btn link-border radius">
                                    Ubah Alamat
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author mt-3 shadow-sm">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3>Info Kontak</h3> <br>
                                <button data-toggle="modal" data-target="#updateKontak" wire:click="edit()"
                                    class="genric-btn link-border radius">Edit Kontak</button>
                                @include('livewire.frontend.accounts.modal-contact')
                                <ul class="list-group mt-2">
                                    <li class="list-group-item">E-mail : {{ $user->email }}</li>
                                    <li class="list-group-item">No Telepon : {{ $user->phone_number }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
</main>

@push('script-custom')
    <script>
        $(".modalBio").on('hide.bs.modal', function() {
            Livewire.emit('resetField')
        })
        $(".modalImage").on('hide.bs.modal', function() {
            Livewire.emit('resetField')
        })

    </script>
@endpush

{{-- <div class="container">
    <div class="row">
        <div class="col-4 bg-warning p-4">
            <h4>Foto</h4>
            Copy
            <div class="card">
                <img src="{{ asset('storage/img-users/' . $user->image) }}" class="card-img-top"
                    style="width:100%; height:200px">
                <div class="card-body">
                    <b class="card-title">Pilih Foto :</b>
                    <button data-toggle="modal" data-target="#updateImage" wire:click="edit()"
                        class="btn btn-danger btn-sm">Pilih File</button>
                    @include('livewire.frontend.accounts.modal-image')
                </div>
            </div>
            <button data-toggle="modal" data-target="#updatePassword" wire:click="edit()"
                class="btn btn-danger btn-sm btn-block mt-3">Ganti Password</button>
            @include('livewire.frontend.accounts.modal-password')
        </div>
        <div class="col-8 bg-info p-4">
            <div class="row">
                <div class="col">
                    <h4>Biodata Diri</h4>
                    <button data-toggle="modal" data-target="#updateBio" wire:click="edit()"
                        class="btn btn-danger btn-sm">Edit Biodata</button>
                    @include('livewire.frontend.accounts.modal-bio')

                    <ul class="list-group mt-2">
                        <li class="list-group-item"><b>Nama : </b>{{ $user->name }}</li>
                        <li class="list-group-item"><b>Username : </b>{{ $user->username }} </li>
                        <li class="list-group-item"><b>Tanggal Lahir : </b>{{ $user->birthday }}</li>
                        <li class="list-group-item"><b>Alamat Pengiriman : </b>{{ $user->address }}</li>
                    </ul>

                    <a href="/account-address" class="btn btn-danger btn-sm mt-2">Alamat</a>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <h4>Info Kontak</h4>
                    <button data-toggle="modal" data-target="#updateKontak" wire:click="edit()"
                        class="btn btn-danger btn-sm">Edit Kontak</button>
                    @include('livewire.frontend.accounts.modal-contact')
                    <ul class="list-group mt-2">
                        <li class="list-group-item">E-mail : {{ $user->email }}</li>
                        <li class="list-group-item">No Telepon : {{ $user->phone_number }} </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div> --}}
