<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tracks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1>Tracks</h1>
            </div>
        </header>
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <table class="table-auto w-full border border-slate-400 text-sm shadow-sm bg-opacity-100">
                                <thead class="bg-slate-100" style="background-color: rgb(203 213 225);">
                                    <tr>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            ISRC
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Title
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Album
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Artists
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Cover
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Release Date
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Duration
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            External URL
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Enabled in BR
                                        </th>
                                        <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                            Preview
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tracks as $track)
                                        <tr class="border border-slate-100 p-4 text-slate-500 bg-slate-50">
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                {{ $track->isrc }}
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                {{ $track->title }}
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                {{ $track->album_title }}
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                {{ str_replace(',', ', ', $track->artists) }}
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                <img src="{{ $track->cover }}" alt="Album Cover" title="{{ $track->album_title }}"
                                                class="object-cover rounded w-128">
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                {{ date('d/m/Y', strtotime($track->release_date)) }}
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                {{ floor($track->duration / 1000 / 60) . ':' . str_pad(floor(($track->duration / 1000) % 60), 2, 0, STR_PAD_LEFT) }}
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                <a href="{{ $track->external_url }}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                @php
                                                    echo $track->br_enabled
                                                        ? '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg>'
                                                        : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>';
                                                @endphp
                                            </td>
                                            <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                                <button class="rounded play cursor-pointer" 
                                                    id="play_{{ $track->id }}" data-url="{{ $track->preview_url }}" data-id="{{ $track->id }}">
                                                  @if (!empty($track->preview_url))
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                                    </svg>
                                                  @endif
                                                </button>
                                                <button class="rounded hidden pause cursor-pointer" id="pause_{{ $track->id }}" data-id="{{ $track->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                      </svg>                                                      
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <audio id="audioPlayer" src="" class="mt-8 w-full" controls style="display: none"></audio>
        </main>
    </div>
</body>

</html>
