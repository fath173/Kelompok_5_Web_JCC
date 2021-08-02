<ul id="progressbar" class="text-center">
    @if ($orders[0]->status == 'belum bayar')
        <li id="li1" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
        </li>
        <li id="li2" class=" step0">
            <p class="font-weight-bold ">
                <span id="li2i"> Pesanan<br>Belum Bayar </span>
            </p>
        </li>
        <li id="li3" class="step0">
            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
        </li>
        <li id="li4" class="step0">
            <p class="font-weight-bold">Pesanan<br>Diterima</p>
        </li>
    @elseif ($orders[0]->status == 'verifikasi')
        <li id="li1" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
        </li>
        <li id="li2" class=" step0">
            <p class="font-weight-bold ">
                <span id="li2i"> Proses<br>Verifikasi</span>
            </p>
        </li>
        <li id="li3" class="step0">
            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
        </li>
        <li id="li4" class="step0">
            <p class="font-weight-bold">Pesanan<br>Diterima</p>
        </li>
    @elseif ($orders[0]->status == 'sudah bayar')
        <li id="li1" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
        </li>
        <li id="li2" class="step0  active">
            <p class="font-weight-bold">
                <span id="li2i"> Pesanan<br>Sudah Dibayar</span>
            </p>
        </li>
        <li id="li3" class="step0">
            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
        </li>
        <li id="li4" class="step0">
            <p class="font-weight-bold">Pesanan<br>Diterima</p>
        </li>
    @elseif ($orders[0]->status == 'sedang dikirim')
        <li id="li1" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
        </li>
        <li id="li2" class="step0 active">
            <p class="font-weight-bold">
                <span id="li2i"> Pesanan<br>Sudah Dibayar</span>
            </p>
        </li>
        <li id="li3" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
        </li>
        <li id="li4" class="step0">
            <p class="font-weight-bold">Pesanan<br>Diterima</p>
        </li>
    @elseif ($orders[0]->status == 'selesai')
        <li id="li1" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
        </li>
        <li id="li2" class="step0 active">
            <p class="font-weight-bold">
                <span id="li2i"> Pesanan<br>Sudah Dibayar</span>
            </p>
        </li>
        <li id="li3" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
        </li>
        <li id="li4" class="step0 active">
            <p class="font-weight-bold">Pesanan<br>Diterima</p>
        </li>
    @else
        <li id="li1" class="step0 ">
            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
        </li>
        <li id="li2" class="step0 ">
            <p class="font-weight-bold">
                <span id="li2i" class="text-danger">
                    Pesanan<br>Dibatalkan</span>
            </p>
        </li>
        <li id="li3" class="step0 ">
            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
        </li>
        <li id="li4" class="step0 ">
            <p class="font-weight-bold">Pesanan<br>Diterima</p>
        </li>
    @endif


</ul>
