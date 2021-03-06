$(function () {
    /* Set rates + misc */
    let shippingRate = 0, initBalance = 0, balance = 0, balanceAfterPaying = 0, fadeTime = 300;

    /* Assign actions */
    $('.product-quantity input').change(function () {
        updateQuantity(this);
    });

    $('.product-removal button').click(function () {
        removeItem(this);
    });

    $('button.checkout').click(function () {
        if ($('#cart-shipping').val() === '') {
            Swal.fire({
                icon: 'warning',
                text: 'Please choose a shipping option',
                showCloseButton: true,
            });

            return;
        }

        $.ajax({
            url: '/shop/?load=Cart/pay',
            type: 'post',
            data: {
                cart_total: $('#cart-total').html(),
            },
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    window.location = '?load=Index/index';
                }
            },
            error: function (res) {
            }
        });
    });

    $('#cart-shipping').change(function () {
        recalculateCart();
        $(this).fadeIn(fadeTime);
    });

    /* Recalculate cart */
    function recalculateCart() {
        let subtotal = 0, shipping, total = 0;

        /* Sum up row totals */
        $('.product').each(function () {
            subtotal += parseFloat($(this).children('.product-line-price').text());
        });

        shippingRate = parseInt($('#cart-shipping').val() === '' ? 0 : $('#cart-shipping').val());

        initBalance = initBalance > 0 ? initBalance : parseFloat($('#current-balance').val());

        balance = initBalance;

        /* Calculate totals */
        shipping = subtotal > 0 ? shippingRate : 0;
        total = subtotal + shipping;

        balanceAfterPaying = balance - total;
        if (balanceAfterPaying < 0) {
            Swal.fire({
                icon: 'warning',
                text: 'Your balance not allow to pay that quantity of product.',
                showCloseButton: true,
            });

            $('#btn-pay').hide();
            return;
        }

        $('#btn-pay').show();

        /* Update totals display */
        $('.totals-value').fadeOut(fadeTime, function () {
            $('#cart-subtotal').html(subtotal.toFixed(2));
            $('#cart-total').html(total.toFixed(2));

            $('#balance-after-paying').html(balanceAfterPaying.toFixed(2));

            if (total === 0) {
                $('.checkout').fadeOut(fadeTime);
            } else {
                $('.checkout').fadeIn(fadeTime);
            }
            $('.totals-value').fadeIn(fadeTime);
        });
    }

    /* Update quantity */
    function updateQuantity(quantityInput) {
        let $quantityInput = $(quantityInput);
        /* Calculate line price */
        let productRow = $quantityInput.parent().parent(), price, quantity, linePrice;

        price = parseFloat(productRow.children('.product-price').text());
        quantity = $quantityInput.val();
        if (parseInt(quantity) <= 0) {
            Swal.fire({
                icon: 'warning',
                text: 'The quantity can not be negative.',
                showCloseButton: true,
            });

            $quantityInput.val(1);

            return;
        }

        linePrice = price * quantity;

        /* Update line price display and recalc cart totals */
        productRow.children('.product-line-price').each(function () {
            $(this).fadeOut(fadeTime, function () {
                $(this).text(linePrice.toFixed(2));

                $.ajax({
                    url: '/shop/?load=Cart/updateQuantity',
                    type: 'post',
                    data: {
                        cart_id: $quantityInput.data('cart-id'),
                        qty: quantity,
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            recalculateCart();
                        }
                    },
                    error: function (res) {
                    }
                });

                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        });
    }

    /* Remove item from cart */
    function removeItem(removeButton) {
        let $this = $(removeButton), productRow, cartId;

        /* Remove row from DOM and recalc cart total */
        productRow = $this.parent().parent();
        cartId = $this.data('cart-id');

        productRow.slideUp(fadeTime, function () {
            $.ajax({
                url: '/shop/?load=Cart/delete',
                type: 'post',
                data: {
                    cart_id: cartId,
                },
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        productRow.remove();
                        recalculateCart();

                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                text: res.message,
                                showCloseButton: true,
                            });
                        }
                    }
                },
                error: function (res) {
                }
            });
        });
    }
});
