jQuery(function ($) {
    'use strict';

    $(document).on('change', function () {

        /* ================== Simple buttons ================== */
        $(".main__closer").on("click", function () {
            $(".main__closer").fadeOut();
        });

        $(".header-block__cancel").on("click", function () {
            $(".main__closer").fadeOut();
        });

        $(".cart-button").on("click", function () {
            $(".main__closer").fadeIn();
        });

        $(".details__cart-button").on("click", function () {
            $(".main__closer").fadeIn();
        });

        $(".arrow-right").on("click", function () {
            $(".main__closer").fadeIn();
        });

        /* ================== Cart quantity ================== */

        var minValue = 1;
        var maxValue = 10;

        $(".decrease-button").on("click", function () {
            var value = $(".quantity__value").val();

            if (value > minValue) {
                value--;
            }

            $(".quantity__value").val(value);
        });

        $(".increase-button").on("click", function () {
            var value = $(".quantity__value").val();

            if (value < maxValue) {
                value++;
            }

            $(".quantity__value").val(value);
        });

        $('.quantity__value').on("blur", function () {
            var inputValue = $(this).val();

            if (inputValue < minValue || inputValue > maxValue) {
                $(".quantity__value").val(1);
            }
        });

    });

}(jQuery));
