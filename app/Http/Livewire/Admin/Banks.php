<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithPagination;

class Banks extends Component
{
    public $nama, $pemilik, $bank_id, $nomor, $saldo;
    public $isModal = 0;
    public $search = '';
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.banks', [
            'banks' => Bank::latest()->where('nama', 'like', '%' . $this->search . '%')->paginate(3)
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
        $this->nama = '';
        $this->pemilik = '';
        $this->nomor = '';
        $this->saldo = '';
        $this->bank_id = '';
    }

    public function store()
    {
        $this->validate([
            'nomor' => 'required|numeric|min:7|unique:banks,nomor,' . $this->bank_id,
            'nama' => 'required|string|alpha|max:15',
            'pemilik' => 'required|string|min:4|max:20',
            'saldo' => 'required|numeric'
        ]);

        Bank::updateOrCreate(['id' => $this->bank_id], [
            'nama' => $this->nama,
            'nomor' => $this->nomor,
            'pemilik' => $this->pemilik,
            'saldo' => $this->saldo
        ]);

        session()->flash('message', $this->bank_id ? $this->nama . ' Diperbaharui' : $this->nama . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $bank = Bank::find($id);
        $this->bank_id = $id;
        $this->nama = $bank->nama;
        $this->nomor = $bank->nomor;
        $this->pemilik = $bank->pemilik;
        $this->saldo = $bank->saldo;

        $this->openModal();
    }

    public function delete($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        session()->flash('message', $bank->nama . ' Dihapus');
    }
}
