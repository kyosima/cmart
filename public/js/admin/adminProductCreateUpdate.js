$(document).ready(function() {
    if ($('input[name="is_ecard"]').is(':checked')) {
        $('input[name="product_price"]').rules('remove', 'required');
        $('input[name="product_regular_price"]').rules('remove', 'required');
        $('input[name="product_wholesale_price"]').rules('remove', 'required');
        $('input[name="product_shock_price"]').rules('remove', 'required');

    }
    if ($('input[name="is_shipping"]').is(':checked')) {
        $('input[name="c_ship_price_df0"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_price_weight0"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_df0"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_weight0"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_distance0"]').rules('add', {
            required: true
        });

        $('input[name="c_ship_price_df1"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_price_weight1"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_df1"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_weight1"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_distance1"]').rules('add', {
            required: true
        });

        $('input[name="c_ship_price_df2"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_price_weight2"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_df2"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_weight2"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_distance2"]').rules('add', {
            required: true
        });

        $('input[name="c_ship_price_df3"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_price_weight3"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_df3"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_weight3"]').rules('add', {
            required: true
        });
        $('input[name="c_ship_fast_price_distance3"]').rules('add', {
            required: true
        });
        $('input[name="product_price"]').rules('remove', 'required');
        $('input[name="product_regular_price"]').rules('remove', 'required');
        $('input[name="product_wholesale_price"]').rules('remove', 'required');
        $('input[name="product_shock_price"]').rules('remove', 'required');
        $('.block-spvc').css('display', 'block');


    } else {
        $('.block-spvc').css('display', 'none');
    }
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
            tax: "Không được để trống",
            price_weight: "Không được để trống",
            price_distance: "Không được để trống"
        }

    });
    $('input[name="is_ecard"]').on('change', function() {
        if ($('input[name="is_ecard"]').is(':checked')) {
            $('input[name="product_price"]').rules('remove', 'required');
            $('input[name="product_regular_price"]').rules('remove', 'required');
            $('input[name="product_wholesale_price"]').rules('remove', 'required');
            $('input[name="product_shock_price"]').rules('remove', 'required');

        } else {
            $('input[name="product_price"]').rules('add', {
                required: true
            });
            $('input[name="product_regular_price"]').rules('add', {
                required: true
            });
            $('input[name="product_wholesale_price"]').rules('add', {
                required: true
            });
            $('input[name="product_shock_price"]').rules('add', {
                required: true
            });


        }
    });
    $('input[name="is_shipping"]').on('change', function() {
        if ($('input[name="is_shipping"]').is(':checked')) {

            $('input[name="c_ship_price_df0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_price_weight0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_df0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_weight0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_distance0"]').rules('add', {
                required: true
            });

            $('input[name="c_ship_price_df0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_price_weight0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_df0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_weight0"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_distance0"]').rules('add', {
                required: true
            });

            $('input[name="c_ship_price_df1"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_price_weight1"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_df1"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_weight1"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_distance1"]').rules('add', {
                required: true
            });

            $('input[name="c_ship_price_df2"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_price_weight2"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_df2"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_weight2"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_distance2"]').rules('add', {
                required: true
            });

            $('input[name="c_ship_price_df3"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_price_weight3"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_df3"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_weight3"]').rules('add', {
                required: true
            });
            $('input[name="c_ship_fast_price_distance3"]').rules('add', {
                required: true
            });
            $('input[name="product_price"]').rules('remove', 'required');
            $('input[name="product_regular_price"]').rules('remove', 'required');
            $('input[name="product_wholesale_price"]').rules('remove', 'required');
            $('input[name="product_shock_price"]').rules('remove', 'required');

            $('.block-spvc').css('display', 'block');

        } else {
            $('input[name="c_ship_price_df0"]').rules('remove', 'required');
            $('input[name="c_ship_price_weight0"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_df0"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_weight0"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_distance0"]').rules('remove', 'required');

            $('input[name="c_ship_price_df1"]').rules('remove', 'required');
            $('input[name="c_ship_price_weight1"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_df1"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_weight1"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_distance1"]').rules('remove', 'required');

            $('input[name="c_ship_price_df2"]').rules('remove', 'required');
            $('input[name="c_ship_price_weight2"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_df2"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_weight2"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_distance2"]').rules('remove', 'required');

            $('input[name="c_ship_price_df3"]').rules('remove', 'required');
            $('input[name="c_ship_price_weight3"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_df3"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_weight3"]').rules('remove', 'required');
            $('input[name="c_ship_fast_price_distance3"]').rules('remove', 'required');

            $('input[name="product_price"]').rules('add', {
                required: true
            });
            $('input[name="product_regular_price"]').rules('add', {
                required: true
            });
            $('input[name="product_wholesale_price"]').rules('add', {
                required: true
            });
            $('input[name="product_shock_price"]').rules('add', {
                required: true
            });
            $('.block-spvc').css('display', 'none');
        }
    });
});