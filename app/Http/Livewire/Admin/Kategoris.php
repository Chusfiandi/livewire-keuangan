<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;


class Kategoris extends Component
{
    public $nama, $jenis, $kategori_id;
    public $isModal = 0;
    public $search = '';
    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.kategori', [
            'kategoris' => Kategori::latest()->where('nama', 'like', '%' . $this->search . '%')->paginate(3)
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
        $this->jenis = '';
        $this->kategori_id = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|unique:kategoris,nama,' . $this->kategori_id,
            'jenis' => 'required|string'
        ]);

        Kategori::updateOrCreate(['id' => $this->kategori_id], [
            'nama' => $this->nama,
            'jenis' => $this->jenis,
        ]);

        session()->flash('message', $this->kategori_id ? $this->nama . ' Diperbaharui' : $this->nama . ' Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $this->kategori_id = $id;
        $this->nama = $kategori->nama;
        $this->jenis = $kategori->jenis;

        $this->openModal();
    }

    public function delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        session()->flash('message', $kategori->nama . ' Dihapus');
    }
}
