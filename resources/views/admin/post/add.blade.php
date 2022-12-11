@extends('admin.layout')
@section('admin.content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Post Add</li>
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
                <h3 class="card-title">Post Add</h3>

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
              <form role="form" method="post" action="{{  route('post.save') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') {{ 'is-invalid' }} @enderror" id="name" placeholder="Abc">
                    
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>   
                    @enderror

                  </div>
                  {{-- <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" value="{{ old('slug') }}" name="slug" class="form-control @error('slug') {{ 'is-invalid' }} @enderror" id="slug" placeholder="Abc">
                    
                    @error('slug')
                    <small class="text-danger">
                        {{ $message }}
                    </small>   
                    @enderror

                  </div> --}}
                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Content</label>
                    <textarea name="content" class=" ckeditor form-control @error('content') {{ 'is-invalid' }} @enderror">{{ old('content') }}</textarea>
                    @error('content')
                    <small class="text-danger">
                        {{ $message }}
                    </small>   
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="form-group">
                    <label>Product Category</label>
                    <select name="category_id" class="form-control">
                      <option value="">--Please select---</option>
                      @foreach($productCategories as $productCategory)
                      <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                      @endforeach
                    </select>
                  </div> --}}
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
$('ckeditor').ckeditor();
</script>

@endsection