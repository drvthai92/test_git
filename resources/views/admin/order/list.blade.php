@extends('admin.layout')

@section('admin.content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div>
        </div>
  
      </div>
     
    </section>
    <!-- /.container-fluid -->
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order</h3>
                {{-- <div class="text-right">
                  <a class="btn btn-primary" href="#">Add</a>
                </div> --}}
              </div>
              
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>STT</th>
                      <th>Mã KH</th>
                      <th>Địa chỉ</th>
                      <th>Số điện thoại</th>
                      <th>Giá trị đơn hàng</th>
                      <th>Tình trạng đơn hàng</th>
                      <th>Ghi chú</th>
                    </tr>
                    </thead>
                    <tbody>
    
                     @foreach($datas as $data) 
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->user_id }}</td>
                        <td>
                            {{ $data->adress}},
                            {{ $data->city }},
                            {{ $data->state }},
                            {{ $data->country }}
                        </td>
                       <td>{{ $data->phone }}</td>
                       <th>{{ $data->total }} VNĐ</th>
                        <td>{{ $data->status }}</td>
                        
                      </tr>
                    @endforeach
                  </table>
                </div>
              
              <!-- /.card-header -->
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  <style >
   
  </style>
@endsection