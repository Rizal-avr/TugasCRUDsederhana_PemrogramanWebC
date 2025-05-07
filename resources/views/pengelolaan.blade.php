@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-amber-400">Pengelolaan Penjualan</h1><br>
    <button onclick="openAddModal()" class="bg-blue-800 hover:bg-blue-900 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200">
        <i class="fas fa-plus mr-2"></i>Tambah Data Penjualan
    </button>
    <button onclick="openDeleteModal()" class="bg-red-700 hover:bg-red-800 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200">
        <i class="fas fa-trash mr-2"></i>Hapus Data Penjualan
    </button>
</div>

<div class="bg-blue-900 text-white p-6 rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-cyan-400">
            <thead class="bg-blue-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Sayur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Pembeli</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kuantitas (kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Harga Jual (per kg)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Penghasilan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-blue-900 divide-y divide-cyan-400">
                @foreach($salesData as $sale)
                <tr class="hover:bg-blue-800 transition duration-200" data-id="{{ $sale->id }}" onclick="openEditModal({{ $sale->id }})" style="cursor: pointer;">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sale->tanggal }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sale->nama_sayur }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sale->nama_pembeli }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sale->kuantitas }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($sale->harga_jual, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($sale->penghasilan, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="event.stopPropagation(); openEditModal({{ $sale->id }})" class="text-yellow-400 hover:text-yellow-300 mr-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="event.stopPropagation(); confirmDelete({{ $sale->id }})" class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Data -->
<div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-blue-900 text-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium mb-4">Tambah Data Penjualan</h3>
            <form id="addForm" action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="nama_sayur">Nama Sayur</label>
                    <input type="text" name="nama_sayur" id="nama_sayur" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="nama_pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="kuantitas">Kuantitas (kg)</label>
                    <input type="number" step="0.1" name="kuantitas" id="kuantitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="harga_jual">Harga Jual (per kg)</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="items-center px-4 py-3">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-blue-900 text-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium mb-4">Edit Data Penjualan</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="edit_tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="edit_tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="edit_nama_sayur">Nama Sayur</label>
                    <input type="text" name="nama_sayur" id="edit_nama_sayur" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="edit_nama_pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="edit_nama_pembeli" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="edit_kuantitas">Kuantitas (kg)</label>
                    <input type="number" step="0.1" name="kuantitas" id="edit_kuantitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="edit_harga_jual">Harga Jual (per kg)</label>
                    <input type="number" name="harga_jual" id="edit_harga_jual" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="items-center px-4 py-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Data -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-blue-900 text-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium mb-4">Hapus Data Penjualan</h3>
            <div class="mb-4 max-h-60 overflow-y-auto">
                <table class="min-w-full">
                    <tbody>
                        @foreach($salesData as $sale)
                        <tr class="border-b border-cyan-400 hover:bg-blue-800">
                            <td class="px-4 py-2">{{ $sale->tanggal }}</td>
                            <td class="px-4 py-2">
                                <button onclick="confirmDelete({{ $sale->id }})" class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="items-center px-4 py-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }

    function openEditModal(id) {
        fetch(`/penjualan/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('edit_tanggal').value = data.tanggal;
                document.getElementById('edit_nama_sayur').value = data.nama_sayur;
                document.getElementById('edit_nama_pembeli').value = data.nama_pembeli;
                document.getElementById('edit_kuantitas').value = data.kuantitas;
                document.getElementById('edit_harga_jual').value = data.harga_jual;
                
                const form = document.getElementById('editForm');
                form.action = `/penjualan/update/${id}`;
                
                document.getElementById('editModal').classList.remove('hidden');
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            fetch(`/penjualan/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus baris dari tabel tanpa reload
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.remove();
                    }
                    
                    // Tampilkan notifikasi
                    showNotification(data.message, 'success');
                    
                    // Tutup modal delete jika terbuka
                    closeDeleteModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Gagal menghapus data', 'error');
            });
        }
    }
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
@endsection