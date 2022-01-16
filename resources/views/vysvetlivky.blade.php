@extends("layouts.master")
@section('obsah')
<div class="container" style="min-height: calc(100vh - 159px);">{{--https://blog.bitscry.com/2018/10/25/bootstrap-fixed-page-footer/--}}{{--132--}}
    <div class="row">
        <div class="col-12">
            <div id="explanations">
                <div id="explanations-buttons"></div>
                <div id="explanations-content"></div>
            </div>
        </div>
    </div>
</div>
<h6>Zdroj: https://kosmonautix.cz/vysvetlivky/</h6>
@endsection
@section('pagespecificscripts')
    <script src="{{ asset('js/explanations.js') }}"></script>
@stop