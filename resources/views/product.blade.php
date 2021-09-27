@extends('layout.master')

@section('title', 'Chi tiết sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{asset('css/flickity.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
@endpush

    @section('content')
    <main>
        <section class="product__detail">
            <div class="container">
                <div class="row row-detail">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="row row_big">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="carousel carousel-main carousel_big" data-flickity>
                                    <div class="carousel-cell">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <img src="./image/collagen-1.jpg" alt="">
                                                <div class="sale">
                                                    <p>13%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-cell">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <img src="./image/collagen-2.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-cell">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <img src="./image/collagen-3.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-cell">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <img src="./image/collagen-4.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-cell">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <img src="./image/collagen-5.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row_small">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="carousel carousel-nav carousel_small"
                                data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                                        <div class="carousel-cell carousel-small col-sm-4 col-md-4 col-lg-4">
                                            <img src="./image/collagen-1.jpg" alt="">
                                        </div>
                                        <div class="carousel-cell carousel-small col-sm-4 col-md-4 col-lg-4">
                                            <img src="./image/collagen-2.jpg" alt="">
                                        </div>
                                        <div class="carousel-cell carousel-small col-sm-4 col-md-4 col-lg-4">
                                            <img src="./image/collagen-3.jpg" alt="">
                                        </div>
                                        <div class="carousel-cell carousel-small col-sm-4 col-md-4 col-lg-4">
                                            <img src="./image/collagen-4.jpg" alt="">
                                        </div>
                                        <div class="carousel-cell carousel-small col-sm-4 col-md-4 col-lg-4">
                                            <img src="./image/collagen-5.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="short-desc">
                            <div class="title">
                                <h2>Viên uống Collagen tươi chiết xuất tổ yến Nhật Bản 30 viên</h2>
                            </div>
                            <div class="code">
                                <p><span>SKU:</span>001AB1496</p>
                                <p><span>Quy cách:</span>Gói</p>
                            </div>
                            <div class="trademark">
                                <p><span>Thương hiệu:</span>Pasode</p>
                            </div>
                            <div class="origin">
                                <p><span>Xuất xứ:</span>Nhật Bản</p>
                            </div>
                            <div class="manufacture">
                                <p><span>Sản xuất tại:</span>Nhật Bản</p>
                            </div>
                            <div class="all-price">
                                <p class="new-price">349.000</p>
                                <p class="old-price">399.000</p>
                            </div>
                            <div class="promo-intro">
                                <p class="title-promo">Tiết kiệm 50,000 Ngay Hôm Nay !</p>
                            </div>
                            <div class="quantity">
                                <input type="number" class="card-quality-input" value="1">
                                <div class="quantity_btn add-cart">
                                    <p>Thêm vào giỏ</p>
                                </div>
                            </div>
                            <div class="product-bonus">
                                <input type="checkbox" name="vehicle1" value="Bike">
                                <img src="./image/product-small-1.jpg" alt="">
                                <p>Viên uống rau củ DHC Nhật Bản 240 Viên</p>
                                <p class="price">335.000</p>
                            </div>
                            <div class="product-bonus">
                                <input type="checkbox" name="vehicle1" value="Bike">
                                <img src="./image/product-small-1.jpg" alt="">
                                <p>Viên uống rau củ DHC Nhật Bản 240 Viên</p>
                                <p>335.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product__des">
            <div class="container">
                <div class="row row-des">
                    <div class="col-sm-12 col-md-10 col-lg-10">
                        <div class="product__des-content">
                            <div class="title">
                                <p>Chi tiết sản phẩm</p>
                            </div>
                            <hr>
                            <div class="text">
                                <div class="text_d">
                                    <p>Viên uống Collagen tươi Nhật Bản có sự kết hợp giữa chiết xuất yến sào, sụn vi cá mập giúp bồi bổ cơ thể và nuôi dưỡng làn da trẻ đẹp, mịn màng nhanh chóng.</p>
                                    <h2>Viên uống Collagen yến tươi – Giữ gìn nét đẹp thanh xuân</h2>
                                    <h3>Điểm nổi bật của Collagen tươi Nhật Bản</h3>
                                    <ul><li><a href="">Collagen tươi Nhật Bản ứng dụng công nghệ sản xuất đạt tiêu chuẩn ATTP cao nhất thế giới, từ đó các phân tử Collagen có kích thước siêu nhỏ và thẩm thấu vào cơ thể nhanh hơn.</a></li></ul>
                                    <ul><li><a href="">Sản phẩm chứa Collagen tươi chiết xuất sụn vi cá mập có lượng Collagen hòa tan cao gấp 43 lần so với Collagen thông thường, giúp mang lại hiệu quả cho làn da nhanh hơn.</a></li></ul>
                                    <ul><li><a href="">Chứa Acid sialic (chiết xuất yến sào) có độ đậm đặc gấp 200 lần so với sữa ong chúa, làm tăng khả năng làm đẹp và bồi bổ cho da.</a></li></ul>
                                    <h3>Công dụng của Collagen yến tươi Nhật</h3>
                                    <ul><li><a href="">Nuôi dưỡng làn da tươi trẻ, mịn màng và tràn đầy sức sống nhờ bổ sung đủ hàm lượng Collagen bị thiếu hụt.</a></li></ul>
                                    <ul><li><a href="">Cải thiện độ đàn hồi cho da, làm mờ các nếp nhăn cho da căng mịn trẻ trung.</a></li></ul>
                                    <ul><li><a href="">Bổ sung và gìn giữ độ ẩm tự nhiên cho da căng mướt, làm chậm sự xuất hiện của các dấu hiệu lão hóa da như nhăn, chùng nhão, chảy xệ…</a></li></ul></a></li></ul>
                                    <h3>Thành phần viên uống Collagen yến tươi</h3>
                                    <ul><li><a href="">Thành phần bao gồm: Dầu hoa hướng dương, Gelatin, Collagen Peptide mềm (bao gồm Gelatin), dầu ô liu, chiết xuất sụn cá mập, Dextrin, tổ yến (Dextrin, tổ yến đã qua xử lý bằng Enzyme), nhau thai heo (kể cả thịt heo)/Glycerin, sáp ong, Este Axit béo Glycerin, VE, Axit Hyaluronic…</a></li></ul>
                                    <h3>Hướng dẫn sử dụng viên uống Collagen yến tươi</h3>
                                    <ul><li><a href="">Uống 1 đến 2 viên mỗi ngày với nước hoặc nước ấm.</a></li></ul>
                                    <ul><li><a href="">Nên uống liên tục trong 3 tháng để có kết quả tốt nhất.</a></li></ul>
                                    <h3>Lưu ý</h3>
                                    <ul><li><a href="">Tùy theo cơ địa của người dùng mà có hiệu quả khác nhau.</a></li></ul>
                                    <ul><li><a href="">Sản phẩm này không phải là thuốc, không có tác dụng thay thế thuốc chữa bệnh.</a></li></ul>
                                    <h3>Cách bảo quản</h3>
                                    <ul><li><a href="">Để xa tầm tay trẻ em.</a></li></ul>
                                    <ul><li><a href="">Bảo quản nơi khô ráo, thoáng mát.</a></li></ul>
                                    <ul><li><a href="">Tránh ánh nắng chiếu trực tiếp, nơi có nhiệt độ cao.</a></li></ul>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="./image/chinhhang.png" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Chính hãng</p>
                                                        <p class="p2">100%</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="./image/doitra.png" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Miễn phí đổi trả</p>
                                                        <p class="p2">LÊN ĐẾN 90 NGÀY</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="./image/giaohanh.png" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Giao hàng</p>
                                                        <p class="p2">NHANH CHÓNG</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="note_list">
                                                    <ul><li><a href="#">* Bạn có thể mua hàng ngay tại website bằng cách nhấn vào nút Mua Ngay, hoặc liên hệ với chúng tôi qua các thông tin bên dưới.</a></li></ul>
                                                    <ul><li><a href="#">* JAPANA.VN cam kết bán hàng chính hãng từ Nhật Bản. Những thông tin bên trên được nhà sản xuất đưa ra, các sản phẩm làm đẹp và sức khỏe tùy vào cơ địa của mỗi khách hàng sẽ có hiệu quả tương thích.</a></li></ul>
                                                    <ul><li><a href="#">* Mẫu mã của sản phẩm có thể được thay đổi khi bạn mua hàng.</a></li></ul>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="contact">
                                                    <div class="contact_item fb">
                                                        <img src="./image/icon/facebook.png" alt="">
                                                        <a href="https://www.facebook.com/japana.sieuthinhat/"> https://www.facebook.com/japana.sieuthinhat/ </a>
                                                    </div>
                                                    <div class="contact_item phone">
                                                        <img src="./image/icon/telephone.png" alt="">
                                                        <p>(028) 7108 8889 - 0935 600 800</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="product product-1">
                                            <div class="product_img">
                                                <img src="./image/product-2.jpeg" alt="">
                                            </div>
                                            <div class="product_text">
                                                <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                                <h5>450.000 đ</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="evaluate">
                                    <div class="col-sm-12 col-md-12 col-lg-12 evaluate__title">
                                        <h3>Khách hàng đánh giá</h3>
                                        <hr>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 evaluate__star">
                                        <div class="evaluate__star-number">
                                            <span>5</span>
                                        </div>
                                        <div class="evaluate__star-icon">
                                            <img src="./image/icon/star.svg" alt="">
                                            <img src="./image/icon/star.svg" alt="">
                                            <img src="./image/icon/star.svg" alt="">
                                            <img src="./image/icon/star.svg" alt="">
                                            <img src="./image/icon/star.svg" alt="">
                                        </div>
                                        <div class="evaluate__star-text">
                                            <p>1 đánh giá</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 evaluate__number">
                                            <div class="evaluate__number-d">
                                                <p><span>5</span><img src="./image/icon/star.svg" alt=""></p>
                                                <span id="span-line"></span>
                                                <p class="number-small">1</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>4</span><img src="./image/icon/star.svg" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>3</span><img src="./image/icon/star.svg" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>2</span><img src="./image/icon/star.svg" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>1</span><img src="./image/icon/star.svg" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 evaluate__img">
                                            <div class="evaluate__img-content">
                                                <p>Tất cả hình ảnh (1)</p>
                                                <img src="./image/evaluate-img.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="row tab_navigation">
                                            <div class="col-sm-12 col-md-12 col-lg-12 evaluate__img">
                                                <div class="evaluate__img-tab">
                                                    <div class="title">
                                                        <p>Lọc xem theo:</p>
                                                    </div>
                                                    <ul>
                                                        <li class="active"><span>5</span><img src="./image/icon/star.svg" alt=""></li>
                                                        <li><span>4</span><img src="./image/icon/star.svg" alt=""></li>
                                                        <li><span>3</span><img src="./image/icon/star.svg" alt=""></li>
                                                        <li><span>2</span><img src="./image/icon/star.svg" alt=""></li>
                                                        <li><span>1</span><img src="./image/icon/star.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row tab_comment-area">
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="5-star">
                                                <hr>
                                                <div class="comment-item">
                                                    <div class="customer">
                                                        <div class="avar item">
                                                            <p>S</p>
                                                        </div>
                                                        <div class="sup item">
                                                            <p>Support</p>
                                                            <img src="./image/icon/star.svg" alt="">
                                                            <img src="./image/icon/star.svg" alt="">
                                                            <img src="./image/icon/star.svg" alt="">
                                                            <img src="./image/icon/star.svg" alt="">
                                                            <img src="./image/icon/star.svg" alt="">
                                                        </div>
                                                        <div class="date item">
                                                            <p>(08/09/2021)</p>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <p>Cảm ơn ac đã ủng hộ siêu thị nhật bản japana bên em ạ.
                                                                Dịch quá các shiper không đi giao đc bên em cố gắng dùng xe riêng đi giao cho khách yêu ạ.
                                                            Nhưng chỉ giao đc ít nơi k bị rào chắn, các nơi bị chắn rào xe không vào đc mong ac mình chờ thêm ạ.
                                                        </p>
                                                    </div>
                                                    <div class="image">
                                                        <img src="./image/evaluate-img.jpg" alt="">
                                                    </div>
                                                </div>
                                                <div class="comment-review">
                                                    <div class="btn">
                                                        <p>Viết đánh giá</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="4-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="./image/sad.png" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                                <div class="comment-review">
                                                    <div class="btn">
                                                        <p>Viết đánh giá</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="3-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="./image/sad.png" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                                <div class="comment-review">
                                                    <div class="btn">
                                                        <p>Viết đánh giá</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="2-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="./image/sad.png" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                                <div class="comment-review">
                                                    <div class="btn">
                                                        <p>Viết đánh giá</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="1-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="./image/sad.png" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                                <div class="comment-review">
                                                    <div class="btn">
                                                        <p>Viết đánh giá</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 category">
                        <div>
                            <div class="title">
                                <p>Sản phẩm cùng danh mục</p>
                            </div>
                            <hr>
                            <div class="product">
                                <div class="product_img">
                                    <img src="./image/product-1.png" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống đẹp da Fine Pure Collagen Q 375 viên</p>
                                    <h5>2.860.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="./image/product-2.jpeg" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                    <h5>450.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="./image/product-3.jpeg" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống Collagen DHC 2.05mg 360 viên (60 ngày)</p>
                                    <h5>325.000 đ</h5>
                                    <h5 id="h5">349.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="./image/product-4.jpeg" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên nhai bổ sung Collagen Orihiro Most Chewable 180 viên</p>
                                    <h5>389.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="./image/product-5.jpeg" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống Collagen DHC 2.050mg 540 viên (90 ngày)</p>
                                    <h5>750.000 đ</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slide_product">
            <div class="container">
                <div class="row row-slide">
                    <div class="col-sm-12 col-md-12 col-lg-12 product-seen">
                            <div class="title">
                                <p>Sản phẩm đã xem</p>
                                <div class="arrow">
                                    <img class="prev" src="./image/icon/arrow-prev.png" alt="">
                                    <img class="next" src="./image/icon/arrow-next.png" alt="">
                                </div>
                            </div>
                            <div class="carousel slide_product-carousel" data-flickity='{ "draggable": false }'>
                                <div class="carousel-cell" >
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3 col-lg-2">
                                            <div class="product">
                                                <div class="product_img">
                                                    <img src="./image/product-1.png" alt="">
                                                </div>
                                                <div class="product_text">
                                                    <p>Viên uống đẹp da Fine Pure Collagen Q 375 viên</p>
                                                    <h5>2.860.000 đ</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-2">
                                            <div class="product">
                                                <div class="product_img">
                                                    <img src="./image/product-2.jpeg" alt="">
                                                </div>
                                                <div class="product_text">
                                                    <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                                    <h5>450.000 đ</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-2">
                                            <div class="product">
                                                <div class="product_img">
                                                    <img src="./image/product-3.jpeg" alt="">
                                                </div>
                                                <div class="product_text">
                                                    <p>Viên uống Collagen DHC 2.05mg 360 viên (60 ngày)</p>
                                                    <h5>325.000 đ</h5>
                                                    <h5 id="h5">349.000 đ</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection


@push('javascript')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/flickity.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endpush
