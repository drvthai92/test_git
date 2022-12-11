<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link  {{ (\Request::route()->getName()=='my-home')?'active':'' }}" aria-current="page" href="{{ route('my-home') }}">Home</a></li>
                
                <li class="nav-item"><a class="nav-link {{ (\Request::route()->getName()=='my-about')?'active':'' }}" href="{{ route('my-about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link {{ (\Request::route()->getName()=='my-contact')?'active':'' }}" href="{{ route('my-contact') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link {{ (\Request::route()->getName()=='my-blog')?'active':'' }}"  href="{{ route('my-blog') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link {{ (\Request::route()->getName()=='my-policy')?'active':'' }}"  href="{{ route('my-policy') }}">Policy</a></li>
                <li class="nav-item"><a class="nav-link {{ (\Request::route()->getName()=='my-products')?'active':'' }}"  href="{{ route('my-products') }}">Products</a></li>
                <li class="nav-item"><a class="nav-link {{ (\Request::route()->getName()=='my-categories')?'active':'' }}"  href="{{ route('my-categories') }}">Categories</a></li>
                @if (Auth::check())
                    <div class="container">
                    <form action="{{ route('login.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary logout">Logout</button>
                    </form>
                    </div>
                    @else
                    <li class="nav-login"><a class="nav-link {{ (\Request::route()->getName()=='login.index')?'active':'' }}"  href="{{ route('login.index') }}">Login</a></li>
                @endif  

                
                

            </ul>
        </div>
    </div>
</nav>
<style>
    .logout{
        border: 1px solid rgb(52, 58, 64);
        background:red;
        color: whitesmoke;
        border-radius: 10px;

    }
    .logout:hover{
        background: rgb(255, 0, 0);
    }
    .nav-login{
        background-color: blue;
        border: 1px solid rgb(52, 58, 64);
        border-radius: 10px;
        color: whitesmoke !important;
    }
    .nav-login:hover{
        background: rgb(0, 110, 255);
        border-radius: 10px;
        color:whitesmoke !important;
    }
</style>
