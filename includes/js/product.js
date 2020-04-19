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
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });

        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });
});
