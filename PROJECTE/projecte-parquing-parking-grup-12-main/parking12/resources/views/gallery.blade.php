<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">Galeria d'Imatges</h2>

        <!-- Carrusel de imágenes -->
        <div class="mt-6">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/images/' . $image->name) }}" alt="Imatge del Parking" class="w-full h-64 object-cover">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <!-- Formulario para subir una nueva imagen -->
        <div class="mt-6">
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="parking_id" value="{{ $parking->id }}">

                <p>Parking ID: {{ $parking->id }}</p>

                <label for="image" class="block text-lg font-semibold text-gray-700">Selecciona una imatge:</label>
                <input type="file" name="image" id="image" accept="image/*" required class="mt-2 mb-4">

                <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg">Pujar Imatge</button>
            </form>
        </div>
    </div>

    <!-- Incluir Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</x-app-layout>
