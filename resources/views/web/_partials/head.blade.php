<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$current->meta_desc}}">
    <meta name="robots" content="index, follow">
    <meta property="og:url" content="{{$url = web_url($current->slug, [], true)}}">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="{{$trans->get('title')}}">
    <meta property="og:title" content="{{$current->meta_title ?: $current->title}}">
    <meta property="og:description" content="{{$current->meta_desc}}"/>
    <meta property="og:image" content="{{$current->image}}">
    <title>{{$current->meta_title ?: $current->title}}</title>
    <link rel="canonical" href="{{$url}}">
    @if (count($languages = languages()) > 1)
        @foreach ($languages as $key => $value)
            <link rel="alternate" hreflang="{{$key}}" href="{{web_url($current->slug, [], $key)}}">
        @endforeach
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" media="all" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" media="all" href="{{asset('assets/css/' . language() . '.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script src="{{asset('assets/libs/js/jquery-2.2.5.min.js')}}"></script>

</head>
