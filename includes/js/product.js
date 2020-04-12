$(function() {
    $('.blue-btn').click(function(){
        let $this = $(this);

        $.ajax({
            url: '/shop/?load=Cart/add',
            type: 'post',
            data: {
                product_id: $this.data('product-id'),
            },
            success: function (res) {
                if(res.success){
                    alert(res.message);
                }
            },
            error: function (res) {
            }
        });
    });
});
