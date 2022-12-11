//products list- filter

$(document).ready(function () {
    $('.product-filter-item').click(function () {
        const value = $(this).attr('data-filter')
        if (value == 'all-product') {
            $('.box-product').show('1000')
        }
        else {
            $('.box-product').not('.' + value).hide('1000')//ẩn các post-box ko phải class đã chọn
            $('.box-product').filter('.' + value).show('1000')//hiển thị các post-box có class đã chọn
        }
    });
    //add active to btn
    $('.product-filter-item').click(function () {
        $(this).addClass("product-active-filter").siblings().removeClass("product-active-filter");
    });
})
