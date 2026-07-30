<div class="max-w-4xl mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 mt-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-1">Forum: {{ $project->name }}</h2>
    <p class="text-sm text-gray-500 mb-4">{{ $project->description }}</p>

    <form wire:submit="createDiscussion" class="mb-6 border-b pb-6">
        <input
            type="text"
            wire:model="title"
            placeholder="Judul topik"
            class="w-full border border-gray-300 rounded-md text-sm px-3 py-2 mb-2"
        >
        @error('title') <p class="text-xs text-red-600 mb-2">{{ $message }}</p> @enderror

        <textarea
            wire:model="body"
            placeholder="Tulis diskusi..."
            rows="3"
            class="w-full border border-gray-300 rounded-md text-sm px-3 py-2 mb-2"
        ></textarea>
        @error('body') <p class="text-xs text-red-600 mb-2">{{ $message }}</p> @enderror

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md">
            Buat Topik
        </button>
    </form>

    <div class="space-y-3">
        @forelse ($discussions as $discussion)
            
                <a href="{{ route('discussion.show', $discussion) }}"
                class="block border rounded-md p-3 hover:bg-gray-50"
            >
                <p class="font-medium text-gray-800">{{ $discussion->title }}</p>
                <p class="text-xs text-gray-500">
                    oleh {{ $discussion->user->name }} · {{ $discussion->created_at->diffForHumans() }}
                </p>
            </a>
        @empty
            <p class="text-sm text-gray-400 text-center py-4">Belum ada topik diskusi</p>
        @endforelse
    </div>
</div>