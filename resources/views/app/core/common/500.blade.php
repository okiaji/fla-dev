<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>404</title>
    <link href="{{asset('app/style/admin/css/admin.main.min.css')}}" rel="stylesheet">
</head>
<body class="app">
    <div class="pos-a t-0 l-0 bgc-white w-100 h-100 d-f fxd-r fxw-w ai-c jc-c pos-r p-30">
        <div class="mR-60"><img alt="#" src="{{asset('app/style/admin/images/500.png')}}"></div>
        <div class="d-f jc-c fxd-c">
            <h1 class="mB-30 fw-900 lh-1 c-red-500" style="font-size:60px">500</h1>
            <h3 class="mB-10 fsz-lg c-grey-900 tt-c">Internal server error</h3>
            <p class="mB-30 fsz-def c-grey-700">Something goes wrong with our servers, please try again later.</p>
            <div><a href="/" type="primary" class="btn btn-primary">Go to Home</a></div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('app/core/vendor.js')}}"></script>
    <script type="text/javascript" src="{{asset('app/core/bundle.js')}}"></script>
</body>

</html>