@extends("layouts.master")
@section('obsah')
<div class="container">
    <div class="row">
        <div class="col-lg-11">
            @foreach ($rockets as $prefix => $rocketGroup)
                <a class="anchor" id="{{$rocketGroup->first()->manufacturer->country->agency_name}}"></a>
                <h1>{{$prefix}} rakety</h1>
                <section class="rocket-section">
                    @if (count($rocketGroup) < 4)
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                    @elseif (count($rocketGroup) < 13)
                        <div class="row row-cols-2 row-cols-md-4 g-4">
                    @else
                        <div class="row row-cols-2 row-cols-md-6 g-4">
                    @endif
                        @foreach ($rocketGroup as $rocket)
                            <div class="col">
                                <div class="card h-100 bg-dark mb-3">
                                    <img src="{{asset("storage/".$rocket->image)}}"
                                            class="card-img-top @if(count($rocketGroup) < 4)other-rockets @endif"
                                            alt="{{ $rocket->name }} rocket">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $rocket->name }}
                                            @if ($rocket->human_rated == 1)
                                            <i class="bi bi-people" title="Ľudská posádka"></i>
                                            @endif
                                        </h5>    
                                        <p class="card-text">
                                            Výrobca: {{ $rocket->manufacturer->name }}<br>
                                            Nosnosť LEO: {{ $rocket->payload }}t<br>
                                            Výška: {{ $rocket->height }}m<br>
                                        </p>
                                    </div>
                                    @auth
                                        <div class="row">
                                        <div class="col-xs-4">
                                            <a style="color: inherit;text-decoration: none;">
                                                <button type="button" class="bg-danger text-white delete-rocket-btn" data-bs-toggle="modal" data-bs-target="#delete-rocket-modal" data-rocketdelete='{{$rocket->id}}'>
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </a>
                                            {{--<a href='destroy/{{ $rocket->id }}' style="color: inherit;text-decoration: none;"><button type="button" class="bg-danger text-white"><i class="bi bi-trash"></i></button></a>--}}
                                            <a>
                                                <button type="button" class="bg-warning text-black rocket-edit-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-rocket='{{$rocket->toJson()}}'
                                                        data-url='{{route("updateRocket",0)}}'>
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
                                                                data-bs-toggle="modal" data-bs-target="#ModalCreate-{{$rocketGroup->first()->manufacturer->country->id}}">
                            <i class="bi bi-plus d-flex align-items-center"></i>
                            </button> 
                        @endauth
                                          
                    </div>
                </section>
            @endforeach
        </div>
        <!--    Right panel menu    -->
        <div class="col-lg-1 d-none d-lg-block">
            <nav id="side-vertical-nav">
                <ul class="nav nav-stacked flex-sm-column">
                    @foreach ($rockets as $prefix => $rocketGroup)
                    <li class="nav-item">
                        <a class="nav-link" href="#{{$rocketGroup->first()->manufacturer->country->agency_name}}">{{$rocketGroup->first()->manufacturer->country->prefix_rockets}} rakety</a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</div>

@foreach ($rockets as $prefix => $rocketGroup)
    @include('modal.new-rocket',["country" => $countries->where("id", $rocketGroup->first()->manufacturer->country->id)->first()])
@endforeach
@include('modal.edit-rocket',["manufacturers" => $manufacturers])
@include('modal.delete-rocket')
@endsection
@section('pagespecificscripts')
    <script src="{{ asset('js/rocket/deleteRocket.js') }}"></script>
@stop