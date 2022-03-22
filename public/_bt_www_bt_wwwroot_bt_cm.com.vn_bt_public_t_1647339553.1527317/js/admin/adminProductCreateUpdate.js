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
            product_weight: {
                min: 0,
                number: true,
            },
            product_length: {
                min: 0,
                number: true,
            },
            product_height: {
                min: 0,
                number: true,
            },
            product_width: {
                min: 0,
                number: true,
            },
            product_price: {
                min: 0,
                required: true,
                number: true,
            },
            product_regular_price: {
                min: 0,
                required: true,
                number: true,
            },
            product_wholesale_price: {
                min: 0,
                required: true,
                number: true,
            },
            product_shock_price: {
                min: 0,
                required: true,
                number: true,
            },
            cpoint: {
                min: 0,
                number: true,
            },
            mpoint: {
                min: 0,
                number: true,
            },
            tax: {
                required: true,
            },
            phi_xuly: {
                min: 0,
                number: true,
            },
            payments: {
                required: true
            }
        },
        messages: {
            feature_img: "Không được để trống",
            unitName: "Không được để trống",
            product_sku: "Không được để trống",
            product_name: "Không được để trống",
            category_parent: "Không được để trống",
            product_brand: "Không được để trống",
            product_weight: "Không được để trống",
            product_length: "Không được để trống",
            product_height: "Không được để trống",
            product_width: "Không được để trống",
            product_price: "Không được để trống",
            product_regular_price: "Không được để trống",
            product_wholesale_price: "Không được để trống",
            product_shock_price: "Không được để trống",
            payments: "Không được để trống",
            tax: "Không được để trống"
        }
    });
});
