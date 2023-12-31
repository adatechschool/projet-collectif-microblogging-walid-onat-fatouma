<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-around">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Post') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        @foreach ($posts as $post)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-post :post="$post"/>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>