<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aparcar</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.24/dist/tailwind.min.js"></script>

    <!-- SimpleKeyboard CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/css/index.css">
</head>
<body class="bg-gray-100">

    <x-app-layout>
        <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
            <h1 class="text-3xl font-bold text-center mb-6">Aparcar</h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-md mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="parking-form" action="{{ route('parkingslots.aparcar.store', $parkingslot->id) }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="plate" class="block text-sm font-medium text-gray-700">Matrícula:</label>
                    <input type="text" name="plate" id="plate" 
                        class="mt-1 block w-full px-4 py-3 text-2xl border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400 placeholder-opacity-50" 
                        placeholder="1234XYZ" maxlength="7" required>
                    <small id="plateError" class="text-red-500 hidden">4 dígits + 3 consonants que no siguin 'Q' o 'Ñ'</small>
                </div>
                

                <!--TECLAT VIRTUAL-->
                <div class="simple-keyboard bg-gray-200 p-4 rounded-md shadow-md"></div>
            
                <div class="mb-6 mt-6">
                    <label for="slotType" class="block text-sm font-medium text-gray-700">Quin tipus de plaça necessites?</label>
                    <select name="slotType" id="slotType" 
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="normal">Normal</option>
                        <option value="motorbike">Moto</option>
                        <option value="big">Gran</option>
                        <option value="adapted">Adaptat</option>
                    </select>
                </div>

                <div id="vehicle-images" class="mt-4 flex justify-center">
                    <img src="{{ asset('static/images/normal.png') }}" alt="Normal" id="image-normal" class="w-32 h-32 hidden">
                    <img src="{{ asset('static/images/moto.png') }}" alt="Moto" id="image-motorbike" class="w-32 h-32 hidden">
                    <img src="{{ asset('static/images/gran.png') }}" alt="Gran" id="image-big" class="w-32 h-32 hidden">
                    <img src="{{ asset('static/images/adaptada.png') }}" alt="Adaptat" id="image-adapted" class="w-32 h-32 hidden">
                </div>

                <div class="mt-6 flex gap-4">
                    <button type="submit" 
                        class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Aparcar
                    </button>
                </div>
            </form>
        </div>

        <!-- SimpleKeyboard Script -->
        <script src="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/index.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const plateInput = document.getElementById("plate");
                const plateError = document.getElementById("plateError");

                // Instància de simple-keyboard
                const Keyboard = window.SimpleKeyboard.default;
                const myKeyboard = new Keyboard({
                    onChange: input => {
                        // teclat -> canvia input
                        plateInput.value = input;
                    },
                    onKeyPress: button => {
                        console.log("Button pressed", button);
                    },
                    

                    layout: {
                        default: [
                            "1 2 3 4 5 6 7 8 9 0",
                            "Q W E R T Y U I O P",
                            "A S D F G H J K L",
                            "Z X C V B N M {bksp}"
                        ]
                    },
                    display: {
                        "{bksp}": "←"
                    },
                    maxLength: 7, // 7 caracters input
                    theme: "hg-theme-default hg-layout-numeric" // Tema
                });

                // Sincro teclat i text
                plateInput.addEventListener("input", (e) => {
                    myKeyboard.setInput(e.target.value);
                });

                // Validació
                document.getElementById("parking-form").addEventListener("submit", function (e) {
                    const plate = plateInput.value;
                    const regex = /^\d{4}[BCDFGHJKLMNPRSTVWXYZ]{3}$/i;  // 4 dígits + 3 consonants que no siguin 'Q' o 'Ñ'
                    const isValid = regex.test(plate);

                    if (!isValid) {
                        e.preventDefault(); // evita el submit
                        plateError.classList.remove("hidden"); // mostra el error
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const slotTypeSelect = document.getElementById("slotType");
                const images = {
                    normal: document.getElementById("image-normal"),
                    motorbike: document.getElementById("image-motorbike"),
                    big: document.getElementById("image-big"),
                    adapted: document.getElementById("image-adapted"),
                };

                // Función para mostrar/ocultar imágenes
                const updateImage = (selectedType) => {
                    Object.keys(images).forEach((type) => {
                        images[type].classList.add("hidden"); // Oculta todas
                    });
                    if (images[selectedType]) {
                        images[selectedType].classList.remove("hidden"); // Muestra la seleccionada
                    }
                };

                // Escucha cambios en el select
                slotTypeSelect.addEventListener("change", (e) => {
                    updateImage(e.target.value);
                });

                // Inicialización: muestra la imagen por defecto según el valor inicial
                updateImage(slotTypeSelect.value);
            });
        </script>


    </x-app-layout>

</body>
</html>

