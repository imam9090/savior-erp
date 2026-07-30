<div class="max-w-md mx-auto bg-white shadow rounded-lg p-10 mt-10">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Tambah User Baru</h2>

    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Password</label>
            <input type="password" wire:model="password" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Role</label>
            <select wire:model="role" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
    <option value="admin_finance">Admin Finance</option>
    <option value="admin_client">Admin Client</option>
    <option value="superadmin">Superadmin</option>
    <option value="client">Client</option>
</select>
            @error('role') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-md">
            Simpan
        </button>
    </form>
</div>