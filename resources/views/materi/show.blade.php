<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center relative">
            <!-- Logo / Title -->
            <div class="flex-shrink-0">
                <h1 class="text-xl font-bold">UKMF MCC</h1>
            </div>

            <!-- Kelas Name in the Center -->
            <div class="absolute left-1/2 transform -translate-x-1/2">
                <h2 class="text-lg font-semibold">{{ $kelasName }}</h2>
            </div>

            <!-- Spacer to maintain layout -->
            <div class="ml-auto"></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow py-12">
        <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg border border-gray-200">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-gray-300 pb-3">
                {{ $materi->title }}
            </h1>
            <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                {!! nl2br($materi->content) !!}
            </div>

            <!-- Pagination and Back Button -->
            <div class="text-center my-6">
                <a href="{{ url()->previous() }}" 
                   class="inline-block mb-4 text-blue-600 font-semibold underline hover:text-blue-800 transition duration-200">
                    &larr; Kembali ke Kelas
                </a>
                <div class="pagination mt-4">
                    {{ $materiList->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 UKMF MCC. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
