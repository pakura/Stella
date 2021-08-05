<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

@if (Auth::guard('cms')->check())
    <script src="{{ asset('assets/libs/js/trans.js') }}"></script>
    <div id="translations" data-trans-url="{{cms_route('translations.popup')}}" data-token="{{csrf_token()}}"></div>
@endif
