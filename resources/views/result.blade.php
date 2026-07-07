<x-app-layout>
    <div class="flex min-h-screen bg-gray-900 text-gray-100">
        @include('layouts.sidebar')

        <main class="flex-1 p-8">
            <h1 class="text-2xl font-bold mb-6">Analysis Result</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <div class="bg-gray-800 p-6 rounded-lg shadow border border-gray-700">
                        <h3 class="text-lg font-semibold mb-4">Uploaded Image</h3>
                        <img src="{{ asset('storage/'.$image->file_name) }}" class="rounded w-full object-contain max-h-96" alt="Profile View">
                    </div>

                    <div class="bg-gray-800 p-6 rounded-lg shadow border border-gray-700">
                        <h3 class="text-indigo-400 font-bold uppercase text-sm mb-4">TBR (Text Based Retrieval)</h3>
                        <div class="space-y-4">
                            <div>
                                <span class="block text-gray-400 text-xs uppercase">Comment</span>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @forelse($image->tags as $tag)
                                        <span class="bg-indigo-900/50 text-indigo-300 px-3 py-1.5 rounded text-sm border border-indigo-700/30">
                                            {{ $tag->tag_name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-600 text-sm italic">No comment</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    @php
                        $features = $image->visualFeature; 
                        
                        // Unified Project Rule Processing Matrix
                        $hasFormalAttire = $features && in_array($features->clothing_type, ['Blazer', 'Kemeja', 'Baju Kurung']);
                        $hasPlainBackground = $features && str_contains(strtolower($features->background_type), 'plain');
                        $hasCorrectPosture = $features && $features->camera_posture === 'Facing Camera';
                        $hasCenteredFace = $features && ($features->face_position === 'Center' || $features->face_position === 'Processing...');
                        $hasCorrectComposition = $features && str_contains(strtolower($features->body_composition), 'half body');
                        
                        $isFormalImage = $hasFormalAttire && $hasPlainBackground && $hasCorrectPosture && $hasCenteredFace && $hasCorrectComposition;
                    @endphp

                    <div class="bg-gray-800 p-6 rounded-lg shadow border border-gray-700">
                        <h3 class="text-indigo-400 font-bold uppercase text-sm mb-4">ABR (Attribute Based Retrieval)</h3>
                        <div class="grid grid-cols-2 gap-4 text-base">
                            <div><span class="block text-gray-500 text-[11px] uppercase">File Size</span>{{ $image->file_size }} KB</div>
                            <div><span class="block text-gray-500 text-[11px] uppercase">Image Format</span>{{ $image->image_format }}</div>
                            <div class="col-span-2"><span class="block text-gray-500 text-[11px] uppercase">Upload Timestamp</span>{{ $image->upload_date }}</div>
                            
                            @if($features && $features->clothing_type !== 'Processing...')
                                <div class="col-span-2"><span class="block text-gray-500 text-[11px] uppercase">Detected Attire</span>{{ $features->clothing_type }}</div>
                                <div class="col-span-2"><span class="block text-gray-500 text-[11px] uppercase">Background Layout</span>{{ $features->background_type }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-800 p-6 rounded-lg shadow border border-gray-700">
                        <h3 class="text-indigo-400 font-bold uppercase text-sm mb-4">CBR (Content Based Retrieval)</h3>
                        @if($features && $features->clothing_type !== 'Processing...')
                            <div class="grid grid-cols-2 gap-4 text-base">
                                <div>
                                    <span class="block text-gray-500 text-[11px] uppercase">Background Color Hex</span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="w-4 h-4 rounded-full border border-gray-600" style="background-color: {{ $features->background_color }}"></div>
                                        {{ $features->background_color }}
                                    </div>
                                </div>
                                <div><span class="block text-gray-500 text-[11px] uppercase">Face Alignment</span>{{ $features->face_position }}</div>
                                <div><span class="block text-gray-500 text-[11px] uppercase">Camera Posture</span>{{ $features->camera_posture }}</div>
                                <div><span class="block text-gray-500 text-[11px] uppercase">Body Composition</span>{{ $features->body_composition }}</div>
                            </div>
                        @else
                            <div class="flex items-center gap-2 text-yellow-500 text-sm animate-pulse italic">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>GS01 AI classification worker active...</span>
                            </div>
                        @endif
                    </div>

                    @if($features && $features->clothing_type !== 'Processing...')
                        <div class="p-4 rounded-lg text-center font-bold text-lg shadow-md transition transform duration-150 {{ $isFormalImage ? 'bg-emerald-600 text-white border border-emerald-500' : 'bg-rose-600 text-white border border-rose-500' }}">
                            {{ $isFormalImage ? '✓ FORMAL PROFILE IMAGE APPROVED' : '✕ INFORMAL IMAGE DETECTED' }}
                        </div>
                    @endif

                    <a href="{{ route('dashboard') }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow transition duration-150 active:scale-[0.99]">
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>