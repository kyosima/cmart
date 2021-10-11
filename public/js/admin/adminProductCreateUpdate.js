$(document).ready(function () {
    $("form").validate({
        ignore: [],
        rules: {
            feature_img: {
                required: true,
            },
            product_sku: {
                required: true,
            },
            product_name: {
                required: true,
            },
            category_parent: {
                required: true,
            },
            product_brand: {
                required: true,
            },
            product_calculation_unit: {
                required: true,
            },
            product_weight: {
                required: true,
                min: 0.1,
                number: true,
            },
            product_quantity: {
                required: true,
                min: 1,
                number: true,
            },
            product_length: {
                required: true,
                min: 0.1,
                number: true,
            },
            product_height: {
                required: true,
                min: 0.1,
                number: true,
            },
            product_width: {
                required: true,
                min: 0.1,
                number: true,
            },
            product_regular_price: {
                min: 1,
                required: true,
                number: true,
            },
            product_vpoint: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_2: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_1: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_platinum: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_diamond: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_gold: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_silver: {
                min: 0.1,
                required: true,
                number: true,
            },
            product_discount_member: {
                min: 0.1,
                required: true,
                number: true,
            },
        },
        messages: {
            feature_img: "Không được để trống",
            unitName: "Không được để trống",
            product_sku: "Không được để trống",
            product_name: "Không được để trống",
            category_parent: "Không được để trống",
            product_brand: "Không được để trống",
            product_calculation_unit: "Không được để trống",
            product_quantity: "Không được để trống",
            product_weight: "Không được để trống",
            product_length: "Không được để trống",
            product_height: "Không được để trống",
            product_width: "Không được để trống",
            product_regular_price: "Không được để trống",
            product_vpoint: "Không được để trống",
            product_discount_2: "Không được để trống",
            product_discount_1: "Không được để trống",
            product_discount_platinum: "Không được để trống",
            product_discount_diamond: "Không được để trống",
            product_discount_gold: "Không được để trống",
            product_discount_silver: "Không được để trống",
            product_discount_member: "Không được để trống",
        }
    });
});