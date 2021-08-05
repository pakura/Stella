<ul class="nav navbar-nav">
    <li>
        <a href="{{web_url('/')}}" data-trans="home" >{{$trans->get('home', 'Home')}}</a>
    </li>
    @if (($pages = app_instance('pagesTree')) instanceof \Illuminate\Support\Collection)
        @foreach ($pages as $item)
            <li{!!$current->slug == $item->slug ? ' class="active"' : ''!!}>
                <a href="{{web_url($item->slug)}}">{{$item->short_title}}</a>
                @include('web._partials.sub_menu')
            </li>
        @endforeach
    @endif
</ul>
