@extends('admin.layout')

@section('admin.content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product category Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Category Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Category Add</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{  route('product_category.save') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') {{ 'is-invalid' }} @enderror" id="category_name" placeholder="Abc">
                    
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>   
                    @enderror

                  </div>
                  <div class="form-group">
                    <label for="category_slug">Slug</label>
                    <input type="text" value="{{ old('slug') }}" name="slug" class="form-control @error('slug') {{ 'is-invalid' }} @enderror" id="category_slug" placeholder="Abc">
                    
                    @error('slug')
                    <small class="text-danger">
                        {{ $message }}
                    </small>   
                    @enderror

                  </div>
                 
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@section('my-script')
<script type="text/javascript">
  $(document).ready(function(){
    $('#category_name').keyup(function(){
      var title=$('#category_name').val();
      $.ajax({
        type:'POST',
        url:"{{ route('product_category.get_slug') }}",
        data:{title:title,_token:"{{ csrf_token() }}"},
        success:function(data){
        $('#category_slug').val(data.slug);
        },
      });
    });


    $('ckeditor').ckeditor();
  });
  </script>
@endsection