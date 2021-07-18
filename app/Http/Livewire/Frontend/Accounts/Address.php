<?php

namespace App\Http\Livewire\Frontend\Accounts;

use Livewire\Component;
use App\Models\User;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class Address extends Component
{

    public $user_id;
    public $address, $dataProvince, $dataDistrict, $namaProvince,  $namaDistrict; // Ditampilkan
    public $province, $district, $provinceId, $districtId;

    public function render()
    {
        $user = User::find(Auth()->id());
        $this->province = $user->province;
        $this->district = $user->district;

        $this->getProvince();
        $this->getDistrict();

        return view('livewire.frontend.accounts.address', [
            'user' => $user,
        ]);
    }

    private function resetField()
    {
        $this->user_id = '';
        $this->address = '';
    }

    public function cancel()
    {
        $this->resetField();
    }

    public function edit()
    {
        $user = User::find(Auth()->id());
        $this->user_id = $user->id;
        $this->address = $user->address;
    }

    public function getProvince()
    {
        if (empty($this->province)) {
            $this->dataProvince = RajaOngkir::provinsi()->all();
        } else {
            $this->dataProvince = RajaOngkir::provinsi()->all();
            $prov = RajaOngkir::provinsi()->find($this->province);
            $this->namaProvince = $prov['province'];
        }
    }

    public function getDistrict()
    {
        if ($this->provinceId) {
            $this->dataDistrict = RajaOngkir::kota()->dariProvinsi($this->provinceId)->get();
        } else {
            $this->dataDistrict = RajaOngkir::kota()->dariProvinsi($this->province)->get();
        }
        if (!empty($this->district)) {
            $dist = RajaOngkir::kota()->find($this->district);
            $this->namaDistrict = $dist['city_name'];
        }
    }

    public function updateAddress()
    {
        $this->validate([
            'address' => 'required'
        ]);
        // dd($this->user_id);
        User::where('id', $this->user_id)
            ->update([
                'address' => $this->address,
            ]);
        if ($this->provinceId && $this->districtId) {
            $this->validate([
                'provinceId' => 'required',
                'districtId' => 'required',
            ]);
            User::where('id', $this->user_id)
                ->update([
                    'province' => $this->provinceId,
                    'district' => $this->districtId,
                ]);
        } else if ($this->address) {
            $this->validate([
                'province' => 'required',
                'district' => 'required',
            ]);
            User::where('id', $this->user_id)
                ->update([
                    'province' => $this->province,
                    'district' => $this->district,
                ]);
        }
        $this->emit("swal:modal", [
            'type'    => 'success',
            'icon'    => 'success',
            'title'   => 'Berhasil menyimpan alamat',
            'timeout' => 3000,
        ]);
    }
}
