<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Rekening Bank
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <button wire:click="create()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Rekening
                Bank</button>
            <input type="text"
                class="shadow appearance-none border rounded float-right placeholder-orange-600 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                wire:model="search" placeholder="Searching...">
            @if($isModal)
            @include('livewire.admin.modal.createBank')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-orange-400">
                        <th class="px-4 py-2">Nama Bank</th>
                        <th class="px-4 py-2">Pemilik Rekening</th>
                        <th class="px-4 py-2">Nomor Rekening</th>
                        <th class="px-4 py-2">Saldo</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banks as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row->nama }}</td>
                        <td class="border px-4 py-2">{{ $row->pemilik }}</td>
                        <td class="border px-4 py-2">{{ $row->nomor }}</td>
                        <td class="border px-4 py-2">{{ $row->saldo }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="delete({{ $row->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                                Hapus
                            </button>
                            <button wire:click="edit({{ $row->id }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                Edit
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $banks->links() }}
        </div>
    </div>
</div>
