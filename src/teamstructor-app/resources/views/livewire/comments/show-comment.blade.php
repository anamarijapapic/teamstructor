<div>
    <article class="p-6 mb-6 text-base bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                    <img class="mr-2 w-6 h-6 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}"
                        alt="{{ $comment->user->name }}">{{ $comment->user->name }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            <button id="dropdownComment{{ $comment->id }}Button"
                data-dropdown-toggle="dropdownComment{{ $comment->id }}"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                </svg>
                <span class="sr-only">{{ __('Comment Settings') }}</span>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownComment{{ $comment->id }}"
                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edit') }}</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Delete') }}</a>
                    </li>
                </ul>
            </div>
        </footer>
        <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
    </article>
</div>
