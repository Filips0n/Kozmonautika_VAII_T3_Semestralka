<nav class="navbar navbar-expand-lg navbar-light sticky-top justify-content-between" style="background-color: #d5e7fc;">
    <div class="container">
        <a class="navbar-brand" href="{{route("homePage")}}">
            <img src="assets/icon-crop.png" alt="logo" class="d-inline-block align-text-center"/>
            Kozmonautika
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                <li class="nav-item">
                    <a class="nav-link active {{Request::routeIs("vesmirneAgenturyPage")?"activePage":""}}" aria-current="page" href="{{route("vesmirneAgenturyPage")}}">Vesmírne agentúry</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active {{Request::routeIs("raketyPage")?"activePage":""}}" href="{{route("raketyPage")}}">Rakety</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active {{Request::routeIs("kozmodromyPage")?"activePage":""}}" href="{{route("kozmodromyPage")}}">Kozmodrómy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active {{Request::routeIs("vysvetlivkyPage")?"activePage":""}}" href="{{route("vysvetlivkyPage")}}">Vysvetlivky</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link active {{Request::routeIs("vyrobcoviaPage")?"activePage":""}}" href="{{route("vyrobcoviaPage")}}">Výrobcovia</a>
                </li>    
                <li class="nav-item">
                    <a class="nav-link active {{Request::routeIs("krajinyPage")?"activePage":""}}" href="{{route("krajinyPage")}}">Krajiny</a>
                </li>  
                @endauth
            </ul>

            
            @auth
                <form class="form-inline" action="{{route("logout")}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary mb-2">Odhlásiť</button>
                </form>
                @else

                <div class="d-lg-none">
                    <form class="form-inline" action="{{route("login")}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="dropdownCheck2">
                            <label class="form-check-label float-left" for="dropdownCheck2" style="color: black">
                              Zapamätaj si ma
                            </label>
                          </div>
                        <button type="submit" class="btn btn-primary mb-2">Prihlásiť</button>
                    </form>
                </div>
                <div class="d-none d-lg-block w-25">
                    <div class="dropdown">
                        <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person"></i>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row">
                            <div class="container-fluid">
                                <form class="p-4 form-inline" action="{{route("login")}}" method="post" aria-labelledby="dropdownMenuButton">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="input-xxlarge form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="input-xxlarge form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" class="form-check-input" id="dropdownCheck">
                                        <label class="form-check-label" for="dropdownCheck">
                                            Zapamätaj si ma
                                        </label>
                                      </div>
                                    <button type="submit" class="btn btn-primary">Prihlásiť</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth            
        </div>
    </div>
</nav>