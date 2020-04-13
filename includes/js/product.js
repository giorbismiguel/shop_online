$(function() {
    $('.blue-btn').click(function(){
        let $this = $(this);

        $.ajax({
            url: '/shop/?load=Cart/add',
            type: 'post',
            data: {
                product_id: $this.data('product-id'),
            },
            dataType: 'json',
            success: function (res) {
                if(res.success){
                    Swal.fire({
                        icon: 'success',
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
