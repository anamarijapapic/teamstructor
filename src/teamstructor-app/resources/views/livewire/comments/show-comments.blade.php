<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">
            {{ __('Comments') }} ({{ $post->comments->count() }})</h2>
    </div>

    @livewire('comments.create-comment-form', ['post' => $post], key($post->id))

    @forelse($comments as $comment)
        @livewire('comments.show-comment', ['comment' => $comment], key($comment->id))
    @empty
        <p class="p-6 mt-6 text-center text-gray-500 border-b border-gray-200">
            {{ __('There are no comments on this post yet. Be the first to comment!') }}</p>
    @endforelse
</div>
