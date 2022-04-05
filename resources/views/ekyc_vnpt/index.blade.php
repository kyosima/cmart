@extends('layout.master')

@section('title', 'Xác thực thông tin tài khoản')
@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script async id="oval_model" src="https://ekyc-web.vnpt.vn/lib/VNPTBrowserSDKAppV2.3.3.js"></script>
    <script src="https://ekyc-web.vnpt.vn/lib/jsQR.js"></script>
    <link rel="stylesheet" href="{{ asset('public/sdk_ekyc/ekyc-web-sdk-2.1.4.4.css') }}">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div id="ekyc-url-post" class="sdk-ekyc-container" data-url="{{ route('vnpt.postResult') }}">
                    <img src="https://ekyc-web.vnpt.vn/images/ekyc_logo.png" alt="logo" style="margin-top: 20px" />
                </div>
                <div id="ekyc_sdk_intergrated" style="background: #112e40"></div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let vnpt_ekyc_sdk = document.createElement("script");
        vnpt_ekyc_sdk.id = "vnpt_ekyc_sdk";
        vnpt_ekyc_sdk.src = "{{ asset('public/sdk_ekyc/ekyc-web-sdk-2.1.4.4.js') }}";
        vnpt_ekyc_sdk.async = true;
        vnpt_ekyc_sdk.defe = true;
        document.head.appendChild(vnpt_ekyc_sdk);

        let vnpt_ekyc_styles = document.createElement("link");
        vnpt_ekyc_styles.id = "vnpt_ekyc_styles";
        vnpt_ekyc_styles.rel = "stylesheet";
        vnpt_ekyc_sdk.src = "{{ asset('public/sdk_ekyc/ekyc-web-sdk-2.1.4.4.css') }}";
        vnpt_ekyc_styles.async = true;
        vnpt_ekyc_styles.defe = true;
        document.head.appendChild(vnpt_ekyc_styles);
        const VNPT_CDN = "https://ekyc-web.vnpt.vn";

        vnpt_ekyc_sdk.onload = async function() {
            var initObj = {
                VERSION: "2.1.4.4",
                BASE_CDN: VNPT_CDN,
                BACKEND_URL: "https://api.idg.vnpt.vn/",
                TOKEN_KEY: "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAIJarNFosfnLKj1bkEs4J9E9QVEbnp4l797pLXizJymZiKock67sn54MyPH+js56ANZCp9pU/ftCr035Ei2T5icCAwEAAQ==",
                TOKEN_ID: "db4b010e-bf87-7ab5-e053-62199f0a7ee7",
                AUTHORIZION: "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkYjRhZmZlZC1hNjY5LTIyMmMtZTA1My02MjE5OWYwYTA4NDUiLCJhdWQiOlsicmVzdHNlcnZpY2UiXSwidXNlcl9uYW1lIjoiY2VudGVyQGNtLmNvbS52biIsInNjb3BlIjpbInJlYWQiXSwiaXNzIjoiaHR0cHM6Ly9sb2NhbGhvc3QiLCJuYW1lIjoiY2VudGVyQGNtLmNvbS52biIsInV1aWRfYWNjb3VudCI6ImRiNGFmZmVkLWE2NjktMjIyYy1lMDUzLTYyMTk5ZjBhMDg0NSIsImF1dGhvcml0aWVzIjpbIlVTRVIiXSwianRpIjoiNDIwN2I5ZGYtMjc0MS00ZWJiLTlhYzMtNWFiOWUwOWNmNjM0IiwiY2xpZW50X2lkIjoiYWRtaW5hcHAifQ.WN1cnZ8ymq65hEh5WenXQYD5EhNu_FIQBDQQ1kftTDmB5LKE_n2K2dsfmrQDw7j3KhkjehRezEdmQT38VfMVQgvWGupOqcpithejtge1-2qeFLl7bsZgU-QZTQAoA6zH4MIcXije5WO9M8HsfMfqL8XtUxt1wTHXt7oksxtRrHv0TuFBNfymFhhit69Kxr9BH9kTKQ41UsHXaDYrqm8sMg4zAiONVF8LQy2zKYagepvJp6rVu7btM4dYcwcpplh0Y6DkmY2Qla87WBB0YDKmtsWJo2Y__5TpShg_JC_YtXjlPJk7viRuf5bJGnIWR9jAOvzDkT04uxLhI5v8umodXg",
                PARRENT_ID: "ekyc_sdk_intergrated",
                FLOW_TYPE: "DOCUMENT", // DOCUMENT, FACE
                SHOW_HELP: true,
                SHOW_TRADEMARK: false,
                CHECK_LIVENESS_CARD: true,
                CHECK_LIVENESS_FACE: true,
                CHECK_MASKED_FACE: true,
                COMPARE_FACE: true,
                LANGUAGE: "vi",
                LIST_ITEM: [-1, 5, 6, 7, 9],
                TYPE_DOCUMENT: 99,
                USE_WEBCAM: true,
                USE_UPLOAD: false,
                ADVANCE_LIVENESS_FACE: true,
                LIST_CHOOSE_STYLE: {
                    item_active_color: "#18D696",
                    background_icon: "#18D696",
                    id_icon: VNPT_CDN + "/images/si/id_card.svg",
                    passport_icon: VNPT_CDN + "/images/si/passport.svg",
                    drivecard_icon: VNPT_CDN + "/images/si/drivecard.svg",
                    army_id_icon: VNPT_CDN + "/images/si/other_doc.svg",
                    id_chip_icon: VNPT_CDN + "/images/si/id_chip.svg",
                    start_button_background: "#18D696",
                    start_button_color: "#111127",
                },
                CAPTURE_IMAGE_STYLE: {
                    big_title_color: "white",
                    description1_color: "white",
                    capture_btn_background: "#18D696",
                    capture_btn_color: "#000000",
                    capture_btn_icon: VNPT_CDN + "/images/hdbank2/capture.svg",
                    tutorial_btn_icon: VNPT_CDN + "/images/hdbank/help.gif",
                    upload_btn_background: "white",
                    upload_btn_color: "#000000",
                    upload_btn_boder: "2px solid #18d696",
                    upload_btn_icon: VNPT_CDN + "/images/altiss/upload.svg",
                    recapture_btn_background: "#18D696",
                    recapture_btn_color: "#fff",
                    recapture_btn_border: "2px solid #18D696",
                    recapture_btn_icon: VNPT_CDN + "/images/hdbank2/capture.svg",
                    nextstep_btn_background: "#18D696",
                    nextstep_btn_color: "black",
                    nextstep_btn_icon: VNPT_CDN + "/images/hdbank2/next_icon.svg",
                    capture_and_upload_wrapper_bg: "rgba(23, 24, 28, 0.7);",
                    capture_and_upload_wrapper_bg_img: VNPT_CDN + "/altiss/bg-img.svg",
                },
                MODAL_DOC_STYLE: {
                    touch_icon: VNPT_CDN + "/altiss/touch_cmt.svg",
                    close_icon: VNPT_CDN + "/altiss/close_icon.svg",
                    notice1_icon: VNPT_CDN + "/altiss/cmt_notice1.svg",
                    notice2_icon: VNPT_CDN + "/altiss/cmt_notice2.svg",
                    notice3_icon: VNPT_CDN + "/altiss/cmt_notice3.svg",
                },
                MODAL_FACE_STYLE: {
                    face_icon: VNPT_CDN + "/altiss/face_icon.svg",
                    close_icon: VNPT_CDN + "/altiss/close_icon.svg",
                    notice1_icon: VNPT_CDN + "/altiss/cmt_notice1.svg",
                    notice2_icon: VNPT_CDN + "/altiss/cmt_notice2.svg",
                    notice3_icon: VNPT_CDN + "/altiss/cmt_notice3.svg",
                },
                OTHER_CONFIG: {
                    loading_icon: VNPT_CDN + "/images/hdbank2/loading.gif",
                    loading_styles: "background-color: #000000; opacity: 0.7",
                    oval_web: VNPT_CDN + "/animation/web_oval.json",
                    oval_mobile: VNPT_CDN + "/kbsv/mobile_border.json",
                    notice_ani: VNPT_CDN + "/animation/caution.json",
                    oval_title_color: "white",
                    description_oval_content: "Vui lòng tháo kính để xác thực chính xác hơn!",
                    description_oval: "text-align: center; color: white; font-weight: bold",
                    video_tutorial_oval: VNPT_CDN + "/animation/video_tutorial_oval_dark.mp4",
                },
            };
            ekycsdk.init(
                initObj,
                (res) => {
                    //do some thing
                    console.log("resssss1", res);
                    // ekycsdk.viewResult(res.type_document, res)
                },
                call_after_end_flow
            );

            function call_after_end_flow(data) {
                console.log("data", data);
                var vnpt_ekyc = document.getElementById("vnpt_ekyc");
                vnpt_ekyc.parentNode.removeChild(vnpt_ekyc);
                ekycsdk.init({
                        ...initObj,
                        FLOW_TYPE: "FACE",
                        TYPE_DOCUMENT: data.type_document,
                        client_session: data.client_session,
                    },
                    (res2) => {
                        let merged = {
                            ...data,
                            ...res2
                        };
                        console.log(merged);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                                url: $('#ekyc-url-post').data('url'),
                                type: 'POST',
                                data: JSON.stringify({
                                    result: merged
                                }),
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",

                            })
                            .fail(function(data) {
                                console.log(data);

                            })
                            .done(function(response) {
                                console.log('ket qua: ');
                                console.log(response);
                                $('#btn-redemo').after(response[0]);
                            });

                        ekycsdk.viewResult(data.type_document, merged);
                    }
                );
            }
        };
    </script>
@endpush
