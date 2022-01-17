@extends("layouts.master")
@section('obsah')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="d-none d-lg-block text-center">Mapa kozmodrómov</h1>
            <img class="d-none d-lg-block w-100" src="{{asset("storage/1920px-Active_spaceports.png")}}" alt="Spaceport map">
            
            @foreach ($spaceports as $spaceportGroup)
            <a class="anchor" id="{{$spaceportGroup->first()->country->agency_name}}"></a>
            <h1>{{$spaceportGroup->first()->country->prefix_rockets}} kozmodrómy</h1>
                @foreach ($spaceportGroup as $item)
                    <div class="card bg-dark mb-3">
                        <div class="row no-gutters">
                            <div class="col-xxl-6 col-md-12">
                                <a class="anchor" id="{{$item->id}}"></a>
                                <div id="myCarousel-{{$item->id}}" class="carousel slide carousel-fade" data-interval="false">
                                    <div class="carousel-inner">
                                        @if(($item->spaceportImages->isEmpty()))
                                            <div class="carousel-item active">
                                                <img class="d-block h-100" src="{{asset("storage/spaceportImages/noImage.png")}}" alt="No image" style="margin-left: 50%;transform: translateX(-50%);">
                                            </div>
                                        @endif 
                                        @php $i = 0 @endphp
                                        @foreach ($item->spaceportImages as $itemImage)
                                            <div class="carousel-item @if($i < 1)active @endif">
                                                <img class="d-block h-100" src="{{asset("storage/".$itemImage->image)}}" alt="{{$itemImage->name}}" style="margin-left: 50%;transform: translateX(-50%);">
                                            </div>
                                            @php $i++ @endphp   
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel-{{$item->id}}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel-{{$item->id}}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        <div class="col-xxl-6 col-md-12">
                            <div class="card-body">
                                <h3 class="card-title">{{$item->name}}</h3>
                                <p class="card-text">Počet štartov: {{$item->launches}}</p>
                                <p class="card-text">Začatie prevádzky: {{$item->active_from}}</p>
                                <img width="100%" height="100%"src="https://maps.googleapis.com/maps/api/staticmap?center={{$item->latitude}},{{$item->longitude}}&zoom=14&scale=1&size=600x300&maptype=hybrid&key=AIzaSyAOvhuj2Znvzpr5klPlUwIgxMy1xTi3uGc&format=png&visual_refresh=true" alt="{{$item->name}}">
                            </div>
                        </div>
                            @auth
                                <div class="row">
                                    <div class="col-xs-4">
                                        <a style="color: inherit;text-decoration: none;">
                                            <button type="button" class="bg-danger text-white delete-spaceport-btn" data-bs-toggle="modal" data-bs-target="#delete-spaceport-modal" data-spaceportdelete='{{$item->id}}'>
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </a>
                                        {{--<a href='destroySpaceport/{{ $item->id }}' style="color: inherit;text-decoration: none;">
                                            <button type="button" class="bg-danger text-white">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </a>--}}
                                        <a>
                                            <button type="button" class="bg-warning text-black spaceport-edit-btn"
                                            data-bs-toggle="modal" data-bs-target="#editModalSpaceport"
                                            data-spaceport='{{$item->toJson()}}'
                                            data-url='{{route("updateSpaceport",0)}}'>
                                                <i class="bi bi-pen"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforeach   
                @auth
                    <button action="#" type="button" class="btn btn-primary d-flex align-items-center justify-content-center"
                                                        data-bs-toggle="modal" data-bs-target="#ModalCreate-{{$spaceportGroup->first()->country->id}}" style="width: 100%">
                    <i class="bi bi-plus d-flex align-items-center"></i>
                    </button> 
                @endauth
            @endforeach  
        </div>
        <!--    Right panel menu    -->
        <div class="col-lg-1 d-none d-lg-block">
            <nav id="side-vertical-nav">
                <ul class="nav nav-stacked flex-sm-column">
                    @foreach ($spaceports as $spaceport)
                        <li class="nav-item">
                            <a class="nav-link" href="#{{$spaceport->first()->country->agency_name}}">{{$spaceport->first()->country->prefix_rockets}} kozmodrómy</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</div>
@foreach ($spaceports as $spaceport)
    @include('modal.new-spaceport',["country" => $countries->where("id", $spaceport->first()->country->id)->first()])
@endforeach
@include('modal.edit-spaceport',["countries" => $countries])
@include('modal.delete-spaceport')
@endsection
@section('pagespecificscripts')
    <script src="{{ asset('js/spaceport/deleteSpaceport.js') }}"></script>  
    <script src="{{ asset('js/spaceport/editSpaceport.js') }}"></script>
@stop