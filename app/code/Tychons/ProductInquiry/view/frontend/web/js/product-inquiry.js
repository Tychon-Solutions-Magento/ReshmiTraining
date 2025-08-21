define([
    'jquery',
    'mage/url',
    'loader'
], function ($, urlBuilder) {
    'use strict';

    return function (config, element) {
        $(element).on('click', function () {
            var $button = $(this);
            var $message = $('#inquiry-message');
            var productId = $button.data('product-id');
            var sendUrl = $button.data('send-url');

            $button.prop('disabled', true);
            $('body').loader('show');

            $.ajax({
                url: sendUrl,
                type: 'POST',
                data: {
                    product_id: productId,
                    form_key: $('[name="form_key"]').val()
                },
                dataType: 'json',
                success: function (response) {
                    $message.removeClass('message-error message-success');
                    
                    if (response.success) {
                        $message.addClass('message message-success success')
                                .text(response.message)
                                .show();
                    } else {
                        $message.addClass('message message-error error')
                                .text(response.message)
                                .show();
                    }
                },
                error: function () {
                    $message.removeClass('message-success')
                            .addClass('message message-error error')
                            .text('An error occurred. Please try again.')
                            .show();
                },
                complete: function () {
                    $button.prop('disabled', false);
                    $('body').loader('hide');
                    
                    // Hide message after 5 seconds
                    setTimeout(function() {
                        $message.fadeOut();
                    }, 5000);
                }
            });
        });
    };
});