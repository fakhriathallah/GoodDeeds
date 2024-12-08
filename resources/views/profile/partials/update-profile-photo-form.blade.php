<section class="flex flex-col items-center">
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900 text-center">
            {{ __('Profile Photo') }}
        </h2>
    </header> --}}

    <div class="mt-4 flex flex-col items-center">
        <div class="w-40 h-40 rounded-full overflow-hidden border-4 border-gray-300 shadow-md bg-gray-100">
            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/placeholder.svg') }}"
                alt="Profile Photo"
                class="w-full h-full object-cover">
        </div>

        <button id="editPhotoButton" onclick="togglePhotoForm()" class="mt-3 text-blue-600 hover:text-blue-800 focus:outline-none transition duration-200">
            {{ __('Edit Photo') }}
        </button>
    </div>

    <div id="photoForm" class="mt-4 hidden">
        <form method="POST" action="{{ route('profile.update.photo') }}" enctype="multipart/form-data" class="flex flex-col items-center space-y-3">
            @csrf
            @method('PUT')

            <div class="file-input-container border border-gray-300 rounded-lg p-2">
                <input type="file" name="photo" id="photo" onchange="toggleUploadButton()"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-gray-300 file:text-sm file:font-semibold file:bg-gray-50 hover:file:bg-gray-100" />
                <x-input-error class="mt-2 text-center" :messages="$errors->get('photo')" />
            </div>

            <div id="uploadButtonContainer" class="hidden">
                <x-primary-button class="mt-3 hover:bg-blue-700 focus:outline-none transition duration-200">{{ __('Save Changes') }}</x-primary-button>
            </div>

            @if (auth()->user()->photo)
                <div class="mt-3 flex justify-center w-full">
                    <form method="POST" action="{{ route('profile.delete.photo') }}" class="w-full flex justify-center">
                        @csrf
                        @method('DELETE')
                        <x-danger-button class="mx-auto hover:bg-red-700 focus:outline-none transition duration-200">{{ __('Delete Photo') }}</x-danger-button>
                    </form>
                </div>
            @endif

            <div class="mt-3 text-center w-full">
                <button type="button" id="cancelButton" class="text-red-600 hover:text-red-800 focus:outline-none transition duration-200 hidden"
                    onclick="cancelEdit()">
                    {{ __('Cancel') }}
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    // Fungsi untuk toggle form upload foto dan tombol-tombolnya
    function togglePhotoForm() {
        const photoForm = document.getElementById('photoForm');
        const editButton = document.getElementById('editPhotoButton');
        const cancelButton = document.getElementById('cancelButton');
        const uploadButtonContainer = document.getElementById('uploadButtonContainer');

        // Jika form foto tersembunyi, tampilkan dan sembunyikan tombol edit
        if (photoForm.classList.contains('hidden')) {
            photoForm.classList.remove('hidden');
            editButton.classList.add('hidden');
            cancelButton.classList.remove('hidden');

            // Jika foto belum diupload, sembunyikan tombol upload
            if (!document.getElementById('photo').files.length) {
                uploadButtonContainer.classList.add('hidden');
            }
        } else {
            photoForm.classList.add('hidden');
            editButton.classList.remove('hidden');
        }
    }

    // Fungsi untuk menampilkan tombol upload ketika file dipilih
    function toggleUploadButton() {
        const fileInput = document.getElementById('photo');
        const uploadButtonContainer = document.getElementById('uploadButtonContainer');

        // Jika file dipilih, tampilkan tombol upload
        if (fileInput.files.length > 0) {
            uploadButtonContainer.classList.remove('hidden');
        } else {
            uploadButtonContainer.classList.add('hidden');
        }
    }

    // Fungsi untuk membatalkan edit foto
    function cancelEdit() {
        const photoForm = document.getElementById('photoForm');
        const editButton = document.getElementById('editPhotoButton');
        const cancelButton = document.getElementById('cancelButton');
        const uploadButtonContainer = document.getElementById('uploadButtonContainer');

        // Sembunyikan form dan tampilkan tombol Edit Photo
        photoForm.classList.add('hidden');
        editButton.classList.remove('hidden');
        cancelButton.classList.add('hidden');
        uploadButtonContainer.classList.add('hidden');
    }
</script>
