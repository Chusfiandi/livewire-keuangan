<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Transaksi</h2>
        </div>
        <div class="my-2 flex sm:flex-row flex-col">
            <div class="flex flex-row mb-1 sm:mb-0">
                <div class="relative">
                    <button wire:click="create()"
                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-red border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">Tambah
                        Kategori</button>
                </div>
                <div class="relative">
                    <select wire:model='paginate'
                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                <div class="relative">
                    <select
                        class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                        <option>All</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input placeholder="Search" wire:model="search"
                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>
        @if($isModal)
        @include('livewire.admin.modal.createTransaksi')
        @endif
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
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
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Keterangan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jenis
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nominal
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Bank
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $row)
                        <tr>
                            <td scope="px-5 border-b border-gray-200 bg-white text-sm">{{ $loop->iteration }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row->keterangan }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row->tanggal }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row->kategori->nama }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{!! $row->jenis_label !!}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row->nominal }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row->bank->nama }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><button
                                    wire:click="delete({{ $row->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">
                                    Hapus
                                </button>
                                <button wire:click="edit({{ $row->id }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">
                                    Edit
                                </button></td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="8">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                    <span class="text-xs xs:text-sm text-gray-900">
                        Showing 1 to 4 of 50 Entries
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <button
                            class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
