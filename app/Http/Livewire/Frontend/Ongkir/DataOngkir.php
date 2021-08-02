<?php

namespace App\Http\Livewire\Frontend\Ongkir;

use Livewire\Component;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class DataOngkir extends Component
{
    public $result = [];
    // public $destination, $weight;

    public function render()
    {
        // $this->ongkir(369, 1600);
        return view('livewire.frontend.ongkir.data-ongkir', [
            'result' => $this->result
        ]);
    }

    public function ongkir(int $destination, int $weight)
    {
        // $this->destination = $destination;
        // $this->weight = $weight;
        $origin = 160;
        $jne = RajaOngkir::ongkosKirim([
            'origin'        => $origin,     // ID kota/kabupaten asal
            'destination'   => $destination,      // ID kota/kabupaten tujuan
            'weight'        => $weight,    // berat barang dalam gram
            'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        // $pos = RajaOngkir::ongkosKirim([
        //     'origin'        => $origin,     // ID kota/kabupaten asal
        //     'destination'   => $destination,      // ID kota/kabupaten tujuan
        //     'weight'        => $weight,    // berat barang dalam gram
        //     'courier'       => 'pos'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        // ])->get();
        // $tiki = RajaOngkir::ongkosKirim([
        //     'origin'        => $origin,
        //     'destination'   => $destination,
        //     'weight'        => $weight,
        //     'courier'       => 'tiki'
        // ])->get();
        foreach ($jne[0]['costs'] as $row) {
            $this->result[] = [
                'nama' => $jne[0]['code'],
                'servis' => $row['service'],
                'biaya' => $row['cost'][0]['value'],
                'etd' => $row['cost'][0]['etd']
            ];
        }
        // foreach ($pos[0]['costs'] as $row) {
        //     $this->result[] = [
        //         'nama' => $pos[0]['code'],
        //         'servis' => $row['service'],
        //         'biaya' => $row['cost'][0]['value'],
        //         'etd' => $row['cost'][0]['etd']
        //     ];
        // }
        // foreach ($tiki[0]['costs'] as $row) {
        //     $this->result[] = [
        //         'nama' => $tiki[0]['code'],
        //         'servis' => $row['service'],
        //         'biaya' => $row['cost'][0]['value'],
        //         'etd' => $row['cost'][0]['etd']
        //     ];
        // }
    }
}
