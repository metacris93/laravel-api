<!DOCTYPE html>
<html lang="{{ str_replace('_', '-' , app()->getLocale()) }}">

<head>
    <metacharset="utf-8">
        <metaname="viewport"content="width=device-width, initial-scale=1">
            <title>Laravel</title>
            <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-700">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-3 my-10">
            @foreach ($posts as $post)
            <div class="bg-white hover:bg-blue-100 border border-gray-200 p-5">
                <h2 class="font-bold text-lg mb-4">{{ $post->title }}</h2>
                <p class="text-xs">{{$post->excerpt}}</p>
                <p class="text-xs text-right">{{$post->published_at}}</p>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mb-10">
        {{ $posts->links() }}
    </div>
</body>

</html>
