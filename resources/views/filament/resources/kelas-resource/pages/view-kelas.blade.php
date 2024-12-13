<x-filament::page>
    <div class="p-6 bg-white shadow rounded-lg">
        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6 text-gray-900">{{ $record->title }}</h1>
        
        <!-- Description -->
        <p class="text-gray-700 mb-8 leading-relaxed">{!! nl2br($record->description) !!}</p>

        <!-- Materi Section -->
        @if ($record->materi->isNotEmpty())
            <h2 class="text-xl font-semibold mb-4">Materi:</h2>
            <ul class="space-y-4">
                @foreach ($record->materi as $materi)
                    <li class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div>
                            <p class="text-lg font-medium text-gray-800">{{ $materi->title }}</p>
                        </div>
                        <a href="{{ route('materi.show', ['id' => $materi->id]) }}" 
                           class="text-blue-500 font-medium underline hover:text-blue-700 transition duration-200">
                            Lihat
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 mt-6">Tidak ada materi.</p>
        @endif
    </div>
</x-filament::page>
