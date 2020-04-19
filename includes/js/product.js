$(function () {
    $('.blue-btn').click(function () {
        let $this = $(this);

        $.ajax({
            url: '/shop/?load=Cart/add',
            type: 'post',
            data: {
                product_id: $this.data('product-id'),
            },
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    let icon = res.message == 'The product is already added to your cart!.' ? 'warning' : 'success';
                    Swal.fire({
                        icon: icon,
                        text: res.message,
                        showCloseButton: true,
                    });
                }
            },
            error: function (res) {
            }
        });
    });
});
