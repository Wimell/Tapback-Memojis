<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapback Memoji's - Open Source Memojis for your apps, designs, and websites.</title>
    <meta name="description" content="Open source memojis for your apps, designs, and websites.">
    <meta name="keywords" content="memoji, avatar, api, open source, webp, svg, image, design, website">
    <meta name="author" content="Wes Wimell">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@wes_wim">
    <meta name="twitter:creator" content="@wes_wim">
    <meta name="twitter:title" content="Tapback Memoji's - Open Source Memojis">
    <meta name="twitter:description" content="Open source memojis for your apps, designs, and websites.">
    <meta name="twitter:image" content="{{ env('APP_URL') }}/images/og-image.png">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white text-black font-mono dark:bg-black dark:text-white">
    <div class="px-4 py-12  mx-auto max-w-max">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smile"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
            </div>
            <h1 class="text-2xl font-semibold mb-2">Tapback Memoji's</h1>
            <p class="text-gray-600 dark:text-gray-400 text-base">API for Apple Memoji avatars.</p>
            <div class="flex items-center justify-center scale-125 mt-4 hover:scale-[1.27] transition-transform duration-50">
                <a href="https://github.com/wimell/tapback-memojis" target="_blank">
                    <img alt="GitHub Repo stars" src="https://img.shields.io/github/stars/wimell/tapback-memojis?style=social&label=Star on Github">
                </a>
            </div>

        </header>

        <!-- Main Content Section -->
        <main class="space-y-12">

            <div class="grid grid-cols-5 md:grid-cols-10 gap-3 max-w-max mx-auto md:hidden">
                @for ($i = 0; $i < 15; $i++)
                        <div class="w-16 h-16  rounded-full bg-white overflow-hidden dark:bg-black">
                            <img src="{{ route('avatar.generate', ['name' => 'user' . ($i), 'color' => $i]) }}"
                                 class="w-full h-auto"
                                 loading="lazy"
                                 alt="Memoji Avatar">
                        </div>
                @endfor
            </div>


            <!-- API Usage Section -->
            <div>
                <h2 class="text-lg font-semibold mb-4">🔗 Usage</h2>
            <section class="bg-neutral-100 p-6 rounded-lg dark:bg-neutral-950">

                <p class="text-gray-600 text-sm dark:text-gray-400 mb-3">To get a specific avatar:</p>
                <code class="block bg-white p-3 rounded-md text-xs mb-3 dark:bg-neutral-900">
                    {{ env('APP_URL') }}/api/avatar/{name}.webp
                </code>
                <p class="text-gray-600 text-sm dark:text-gray-400 mb-3">If you want a random avatar:</p>
                <code class="block bg-white p-3 rounded-md text-xs dark:bg-neutral-900">
                    {{ env('APP_URL') }}/api/avatar.webp
                </code>
            </section>
            </div>

            <!-- Preview Avatars Section -->
            <section>
                @php
                // Keeping the existing color pattern
                $colorPattern = [
                    [7, 7, 7, 7, 10, 10, 11, 12, 12, 2],
                    [7, 7, 7, 10, 10, 11, 12, 12, 2, 3],
                    [7, 7, 10, 10, 11, 11, 12, 2, 3, 1],
                    [7, 10, 10, 11, 11, 12, 2, 3, 1, 4],
                    [10, 10, 11, 12, 12, 2, 3, 1, 4, 5],
                    [10, 11, 12, 12, 2, 3, 1, 4, 5, 6],
                    [11, 12, 12, 2, 3, 1, 4, 5, 6, 17],
                    [12, 12, 2, 3, 1, 4, 5, 6, 17, 12],
                    [12, 2, 3, 1, 4, 5, 6, 17, 12, 12],
                    [2, 3, 1, 4, 5, 6, 17, 12, 12, 12],
                ];
                @endphp

                <div class="grid-cols-5 md:grid-cols-10 gap-3 max-w-max mx-auto hidden md:grid">
                    @foreach($colorPattern as $rowIndex => $row)
                        @foreach($row as $colIndex => $colorIndex)
                            <div class="w-16 h-16  rounded-full bg-white overflow-hidden dark:bg-black">
                                <img src="{{ route('avatar.generate', ['name' => 'user' . ($rowIndex * 10 + $colIndex), 'color' => $colorIndex]) }}"
                                     class="w-full h-auto"
                                     loading="lazy"
                                     alt="Memoji Avatar">
                            </div>
                        @endforeach
                    @endforeach
                </div>


            </section>
            <!-- Example Usage Section -->
            <section class="bg-neutral-100 p-6 rounded-lg dark:bg-neutral-950">
                <h2 class="text-lg font-semibold mb-4">🔗 Example Usage</h2>
                <p class="text-gray-600 text-sm dark:text-gray-400 mb-3">HTML Implementation</p>
                <code class="block bg-white p-3 rounded-md text-xs text-green-500 dark:bg-neutral-900">
                    &lt;img src="{{ env('APP_URL') }}/api/avatar/johndoe" alt="User Avatar"&gt;
                </code>
            </section>

            <!-- Features Section -->
            <section>
                <h2 class="text-lg font-semibold mb-4">Features</h2>
                <ul class="list-disc list-inside text-gray-600 text-sm dark:text-gray-400 space-y-2">
                    <li>Unique avatars based on input string</li>
                    <li>Consistent generation for the same input</li>
                    <li>No authentication required</li>
                    <li>Fast response times</li>
                    <li>Suitable for various applications</li>
                </ul>
            </section>
        </main>

        <!-- Footer Section -->
        <footer class="border-t border-gray-200 dark:border-gray-800 pt-6 text-center text-gray-500 text-xs mt-12">
            <p>&copy; {{ date('Y') }} Memoji Avatar API. All rights reserved.</p>
        </footer>
    </div>

    @if (app()->environment('production'))
    <script data-goatcounter="https://tapback.goatcounter.com/count"
        async src="//gc.zgo.at/count.js"></script>
    @endif

</body>
</html>
