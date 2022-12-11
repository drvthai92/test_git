<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
   <h1>{{ $data['content'] }}</h1>
   <div>Name:{{ $data['name'] }}</div>
   <div>Email:{{ $data['email'] }}</div>
   <div>Order Total:{{ $data['order_total'] }} VNĐ</div>
   <table style="border:1px solid rgb(112, 112, 112)">
<tr>
    <th>STT</th>
    <th>Tên sản phẩm</th>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
</tr>
    @php $total=0; @endphp
    @foreach ($data['order_product'] as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $product['name'] }}</td>
        <td>{{ $product['qty'] }}</td>
        <td>{{ $product['price'] }}</td>
    @php
        $totalRow=$product['qty']* $product['price'];
        $total+=$totalRow;
    @endphp
        <td>{{ $totalRow }}</td>
    </tr>
    @endforeach
<tr>
    <td>Tổng giá trị đơn hàng:</td>
    <td colspan="4">
        {{number_format($total ,2)}} VNĐ
    </td>
</tr>
   </table>
   
</body>
</html>

