<style>
    .qty,
    .submit {
    }

    .cart-box {
        display: inline-block;
        border-radius: .8em;
        background: #fff;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .qty,
    .submit {
        position: relative;
        z-index: 1;
        display: inline-block;
        height: 3em;
        padding: 1em;
        line-height: 1em;
        text-align: center;
        border-radius: .6em;
        background: #ccc;
        cursor: pointer;
    }

    input.qty {
        z-index: 2;
        width: 3em;
        padding: 0;
        height: 3.28em;
        border: .15em solid #fff;
    }

    .qty-minus {
        margin-right: -1em;
        padding: 1em 1.2em 1em .8em;
    }

    .qty-plus {
        margin-left: -1em;
        padding: 1em .8em 1em 1.2em;
    }

    .submit {
        margin-left: 1em;
        border: none;
        background: #920202;
        color: #fff;
    }

    input::-webkit-inner-spin-button {
        display: none;
        margin: 0;
    }
</style>
<div class="cart-box">
    <div class="qty qty-minus" onclick="decreaseQty('cartQty')">-</div>
    <input id="cartQty" class="qty" type="number" name="quantity" value="1" min="1" size="1">
    <div class="qty qty-plus" onclick="increaseQty('cartQty')">+</div>
    <input class="submit" type="submit" value="Thêm vào giỏ hàng">
</div>
<script>
    function increaseQty(qtyId) {
        var location = document.getElementById(qtyId);
        var currentQty = location.value;
        var qty = Number(currentQty) + 1;
        location.value = qty;
    }

    function decreaseQty(qtyId) {
        var location = document.getElementById(qtyId);
        var currentQty = location.value;
        if (currentQty > 1) {
            var qty = Number(currentQty) - 1;
            location.value = qty;
        }
    }
</script>
