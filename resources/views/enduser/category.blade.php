@extends('template')
@section('content')
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Categories!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next categories homepage</p>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
     
        <div class="col-lg-8">
            
            <div class="row">


                @if (count($categories)>0)
                
                    @foreach ($categories as $category)
                        @if($category->active==1)
                        <h3>{{ $category->name }}</h3>
                            {{-- <table style="border: 1.5px solid rgb(38, 0, 255); width:300px;margin-bottom:10px;text-align:center;color:gray">
                            <td><h3>{{ $category->name }}</h3></td>
                            </table> --}}
                        @else
                            {{-- <table style="border: 1.5px solid rgb(38, 0, 255); width:300px;margin-bottom:10px;text-align:center;color:gray">
                            <td><h3>Danh mục trống </h3></td>
                            </table> --}}
                            <h3>Danh mục không hiển thị</h3>
                        @endif  
                    @endforeach

                    @else <h1>No data</h1>
                    
                @endif
               
            </div>
            {{ $categories->links('pagination::bootstrap-4') }}
           
        </div>
   
       
    </div>
</div>
@endsection