$(document).ready(function () {
    $(".btn-minus").click(function () {
        updateQuantity($(this), -0);
    });

    $(".btn-plus").click(function () {
        updateQuantity($(this), 0);
    });

    function updateQuantity(btn, change) {
        var input = btn.closest(".quantity").find("input");
        var currentQuantity = parseInt(input.val());
        var newQuantity = currentQuantity + change;

        if (newQuantity > 0) {
            input.val(newQuantity);

            var productId = btn.closest("tr").data("product-id");
            var productPrice = parseFloat(btn.closest("tr").data("product-price"));

            $.ajax({
                url: "/phpbanhang/product/updatecart",
                method: "POST",
                data: {
                    productId: productId,
                    quantity: newQuantity
                },
                success: function (response) {
                    updateTotalPrice(productId, newQuantity, productPrice);
                }
            });
        }
    }

    function updateTotalPrice(productId, quantity, productPrice) {
        var totalPrice = quantity * productPrice;
        $("tr[data-product-id='" + productId + "'] .total-price").text(formatCurrency(totalPrice));

        var total = 0;
        $(".total-price").each(function () {
            total += parseFloat($(this).text().replace(/[^\d-]/g, ''));
        });
        $("#cart-total").text(formatCurrency(total));
    }

    function formatCurrency(value) {
        return value.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        });
    }
});
$(document).ready(function () {
    // ... Các sự kiện khác

    // Thêm sự kiện xóa sản phẩm
    $(".btn-remove-product").click(function () {
        var productId = $(this).data("product-id");

        $.ajax({
            url: "/phpbanhang/product/removecart",
            method: "POST",
            data: {
                productId: productId
            },
            success: function (response) {
                // Xóa dòng sản phẩm khỏi bảng
                $("tr[data-product-id='" + productId + "']").remove();

                // Cập nhật tổng giá trị
                updateTotalPrice();
            }
        });
    });

    function updateTotalPrice(productId, quantity, productPrice) {
        var totalPrice = quantity * productPrice;
        $("tr[data-product-id='" + productId + "'] .total-price").text(formatCurrency(totalPrice));

        var total = 0;
        $(".total-price").each(function () {
            total += parseFloat($(this).text().replace(/[^\d-]/g, ''));
        });
        $("#cart-total").text(formatCurrency(total));
    }

    function formatCurrency(value) {
        return value.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        });
    }
});