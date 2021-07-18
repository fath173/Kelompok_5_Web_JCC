<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Data Table</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Kesan</th>
                            <th>Tampilkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTestimoni as $testimoni)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $testimoni->name }}</td>
                                <td>{{ $testimoni->tgl_testi }}</td>
                                <td>{{ $testimoni->kesan }} </td>
                                <td>{{ $testimoni->status_baca }} </td>
                                <td><button type="button" class="btn btn-sm btn-info mb-1" data-toggle="modal"
                                        data-target="#mediumModal{{ $testimoni->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <div wire:ignore.self class="modal fade" id="mediumModal{{ $testimoni->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                            <h5 class="modal-title" id="mediumModalLabel">Status Baca:
                                                <b>{{ $testimoni->status_baca }}</b>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row border-top mb-3 mt-2">
                                                <div class="col-2">
                                                    Kesan:
                                                </div>
                                                <div class="col-3">
                                                    {{ $testimoni->kesan }}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            @if ($testimoni->status_baca == 'Yes')
                                                <button type="button" wire:click="blokir('{{ $testimoni->id }}')"
                                                    class="btn btn-danger">BLOKIR</button>
                                            @else
                                                <button type="button" wire:click="bukaBlokir('{{ $testimoni->id }}')"
                                                    class="btn btn-success">BUKA BLOKIR</button>
                                            @endif
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
