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
                    let icon = res.message === 'The product is already added to your cart!.' ? 'warning' : 'success';
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

    $('.stars li').on('mouseover', function () {
        let onStar = parseInt($(this).data('value'), 10);

        $(this).parent().children('li.star').each(function (e) {
            if (e < onStar) {
                $(this).addClass('hover');

                return;
            }

            $(this).removeClass('hover');
        });

    }).on('mouseout', function () {
        $(this).parent().children('li.star').each(function (e) {
            $(this).removeClass('hover');
        });
    });

    $('.stars li').on('click', function () {
        let onStar = parseInt($(this).data('value'), 10),
            stars = $(this).parent().children('li.star'),
            productId = $(this).closest('.stars').data('product-id'),
            ratingValue;

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        ratingValue = parseInt($('.stars li.selected').last().data('value'), 10);
        if (ratingValue > 1) {
            $.ajax({
                url: '/shop/?load=Index/rate',
                type: 'post',
                data: {
                    rate: ratingValue,
                    product_id: productId,
                },
                dataType: 'json',
                success: function (res) {
                    let icon = 'warning';
                    if (res.success) {
                        icon = 'success';
                    }

                    Swal.fire({
                        icon: icon,
                        text: res.message,
                        showCloseButton: true,
                    }).then(() => {
                        if (res.success) {
                            window.location = '?load=Index/index';
                        }
                    })
                },
                error: function (res) {
                }
            });
        }
    });
});
