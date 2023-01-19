<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo"><a href="#"><img src="{{ asset('pullo/images/logo.png')}}"></a></div>
        </div>
        <div class="col-sm-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="{{ asset('/app/home')}}">Home</a> 
                        <a class="nav-item nav-link" href="{{ asset('/app/jurusan')}}">Jurusan</a>  
                        <a class="nav-item nav-link" href="{{ asset('#')}}">Tentang Kami</a> 
                        <a class="nav-item nav-link" href="{{ asset('#')}}">Kontak</a>  
                        @php
                            $count = 0;
                        @endphp
                        @if (Auth::check())
                            @php
                                $count = DB::table('cart')->where('user_id', Auth::user()->id)->count();
                            @endphp
                            <a class="nav-item nav-link last" href="{{ asset('/app/keranjang')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i> {{$count}}</a>
                        @else 
                            <a class="nav-item nav-link" href="{{ asset('/login')}}">Login</a>  
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>