<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bank;
use App\Models\Kategori;
use Livewire\Component;
use App\Models\Transaksi;
use Livewire\WithPagination;

class Transaksis extends Component
{
    public $tanggal, $kategori_id, $jenis, $keterangan, $nominal, $bank_id, $nama, $transaksi_id;
    public $isModal = 0;
    public $paginate = 5;
    public $search = '';
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $banks = Bank::all();
        $kategoris = Kategori::all();
        return view('livewire.admin.transaksis', [
            'transaksis' => Transaksi::latest()->where('keterangan', 'like', '%' . $this->search . '%')->paginate($this->paginate), 'banks' => $banks, 'kategoris' => $kategoris
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function resetFields()
    {
        $this->tanggal = '';
        $this->kategori_id = '';
        $this->jenis = '';
        $this->keterangan = '';
        $this->nominal = '';
        $this->transaksi_id = '';
        $this->bank_id = '';
    }

    public function store()
    {
        $this->validate([
            'keterangan' => 'required|string|unique:transaksis,keterangan,' . $this->transaksi_id,
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'jenis' => 'required',
            'bank_id' => 'required'
        ]);

        Transaksi::updateOrCreate(['id' => $this->transaksi_id], [
            'tanggal' => $this->tanggal,
            'jenis' => $this->jenis,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan,
            'kategori_id' => $this->kategori_id,
            'bank_id' => $this->bank_id,
        ]);

        $this->updateBank($this->bank_id);

        session()->flash('message', $this->transaksi_id ? $this->keterangan . ' Diperbaharui' : $this->keterangan . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function updateBank()
    {
        $bank = Bank::find($this->bank_id);
        if ($this->jenis == 'pemasukan') {
            Bank::updateOrCreate(['id' => $this->bank_id], [
                'saldo' => ($bank->saldo + $this->nominal),
            ]);
        } else {
            Bank::updateOrCreate(['id' => $this->bank_id], [
                'saldo' => ($bank->saldo - $this->nominal),
            ]);
        }
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $this->transaksi_id = $id;
        $this->tanggal = $transaksi->tanggal;
        $this->keterangan = $transaksi->keterangan;
        $this->nominal = $transaksi->nominal;
        $this->jenis = $transaksi->jenis;
        $this->kategori_id = $transaksi->kategori_id;
        $this->bank_id = $transaksi->bank_id;

        $this->openModal();
    }

    public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        session()->flash('message', $transaksi->keterangan . ' Dihapus');
    }
}
