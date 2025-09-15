@extends('templates.app')

@section('container-content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="flex justify-between px-6 py-5 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-2xl font-bold text-gray-800">Pengaturan Akun</h2>
                    <p class="mt-1 text-sm text-gray-500">Kelola informasi profil dan keamanan akun Anda</p>
                </div>

                <form action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo Section -->
                    <div class="flex flex-col items-center text-center space-y-2">
                        <div class="relative">
                            <img id="profile-photo-preview"
                                src="{{ auth()->user()->profile_photo ?? 'https://ui-avatars.com/api/?name=' . auth()->user()->name }}"
                                alt="Profile photo"
                                class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-sm"
                            />
                            <label for="profile-photo"
                                class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 cursor-pointer hover:bg-blue-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                <input type="file" id="profile-photo" name="profile_photo" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 gap-6 mt-8">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ auth()->user()->phone }}"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Masukkan nomor telepon">
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea id="address" name="address" rows="3"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Masukkan alamat lengkap">{{ auth()->user()->address }}</textarea>
                        </div>
                    </div>

                    <!-- Password Update Section -->
                    <div class="border-t pt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Ubah Password</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="current-password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                                <input type="password" id="current-password" name="current_password"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="new-password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <input type="password" id="new-password" name="new_password"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="password-confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                <input type="password" id="password-confirmation" name="password_confirmation"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('profile-photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-photo-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush
@endsection
