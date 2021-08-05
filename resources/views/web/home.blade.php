@extends('web.app')
@section('content')
    <div class="container">
        @if(!empty($slides))
            <div class="slick-slider">
                @foreach($slides as $slide)
                <div class="slide-item">
                    <img src="{{$slide->file}}" alt="{{$slide->title}}" style="width: 100%; max-height: 300px; object-fit: cover">
                </div>
                @endforeach
            </div>
            @push('body.bottom')
                <script>
                    $(function (){
                        $('.slick-slider').slick();
                    });
                </script>
            @endpush
        @endif
        <div class="jumbotron text-center">
            <h1 data-trans="homePage" >{{$trans->get('homePage', 'Home Page')}}</h1>
        </div>
        <!-- .jumbotron -->
    </div>
    <!-- .container -->

@endsection
