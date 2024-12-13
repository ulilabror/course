<div>
    @if ($materiContent)
        <div class="mt-6 p-4 bg-gray-100 rounded shadow">
            <h3 class="text-xl font-semibold mb-2">{{ $materiContent['title'] }}</h3>
            <p>{{ $materiContent['content'] }}</p>
        </div>
    @else
        <p class="text-gray-600">Pilih materi untuk melihat detail.</p>
    @endif
</div>
