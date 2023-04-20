<div>
    @role('admin')
    <livewire:news.create class="float-right" />
    @endrole

    <div class="flex flex-col space-y-10 items-center justify-center 2xl:w-3/4 mx-auto" x-data="{ selected: null }">
        @foreach ($news as $newsArticle)
        <div class="w-full">
            <div class="">
                <h1 class="py-2 px-4 w-fit bg-gray-700 rounded-t-lg"
                    :class="selected == {{ $newsArticle->id }} ? 'text-indigo-600' : ''">{{ $newsArticle->name }}</h1>
            </div>
            <p class="bg-gray-600 p-10 rounded-lg rounded-ss-none cursor-pointer"
                :class="selected == {{ $newsArticle->id }} ? 'rounded-b-none transition-all duration-300' : 'transition-all duration-[2000ms]'"
                @click="selected !== {{ $newsArticle->id }} ? selected = {{ $newsArticle->id }} : selected = null">
                {{ $newsArticle->body }}
            </p>
            <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                x-ref="container{{ $newsArticle->id }}"
                x-bind:style="selected == {{ $newsArticle->id }} ? 'max-height: ' + $refs . container{{ $newsArticle->id }} . scrollHeight + 'px' : ''">
                <div
                    class="text-left bg-gray-700 p-4 rounded-lg rounded-t-none transition-all duration-500 flex justify-between">

                    <h1 class="py-2 px-4 w-fit">Posted: {{ $newsArticle->created_at->diffForHumans() }}</h1>

                    @role('admin')
                    <div class="flex justify-between items-center gap-2">
                        {{-- Edit News Article Button --}}
                        <livewire:news.update :newsArticle="$newsArticle"
                            :wire:key="'edit-news-article-' . now() . $newsArticle->id" />
                        {{-- Delete News Article Button --}}
                        <livewire:news.delete :newsArticle="$newsArticle"
                            :wire:key="'delete-news-article-' . $newsArticle->id" />
                    </div>
                    @endrole
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-10 w-11/12 mx-auto bg-gray-900 py-8 px-10 rounded-lg">
        {{ $news->onEachSide(1)->links() }}
    </div>
</div>