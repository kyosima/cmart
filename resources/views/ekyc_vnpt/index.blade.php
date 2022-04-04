@extends('layout.master')

@section('title', 'Xác thực thông tin tài khoản')
@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script id="oval_custom" src="https://ekyc-web.icenter.ai/lib/VNPTBrowserSDKApp.js"></script>
    <script src="https://ekyc-web.icenter.ai/lib/jsQR.js"></script>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="sdk-ekyc-container">
                    <img src="https://ekyc-web.icenter.ai/images/ekyc_logo.png" alt="logo" style="margin-top: 20px">
                </div>
                <div id="ekyc_sdk_intergrated">
                </div>
                <script>
                    let vnpt_ekyc_sdk = document.createElement('script');
                    vnpt_ekyc_sdk.id = 'vnpt_ekyc_sdk';
                    vnpt_ekyc_sdk.src = "{{ asset('public/sdk_ekyc/ekyc-web-sdk-2.1.0.js') }}";
                    vnpt_ekyc_sdk.async = true;
                    vnpt_ekyc_sdk.defe = true;
                    document.head.appendChild(vnpt_ekyc_sdk);

                    let vnpt_ekyc_styles = document.createElement('link');
                    vnpt_ekyc_styles.id = 'vnpt_ekyc_styles';
                    vnpt_ekyc_styles.rel = 'stylesheet';
                    vnpt_ekyc_styles.href = "{{ asset('public/sdk_ekyc/ekyc-web-sdk-2.1.0.css') }}";
                    vnpt_ekyc_styles.async = true;
                    vnpt_ekyc_styles.defe = true;
                    document.head.appendChild(vnpt_ekyc_styles);
                    var token = ""

                    vnpt_ekyc_sdk.onload = async function() {
                        await FaceVNPTBrowserSDK.init();
                        var initObj = {
                            BACKEND_URL: "https://api.idg.vnpt.vn/",
                            TOKEN_KEY: "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAIJarNFosfnLKj1bkEs4J9E9QVEbnp4l797pLXizJymZiKock67sn54MyPH+js56ANZCp9pU/ftCr035Ei2T5icCAwEAAQ==",
                            TOKEN_ID: "db4b010e-bf87-7ab5-e053-62199f0a7ee7",
                            AUTHORIZION: "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkYjRhZmZlZC1hNjY5LTIyMmMtZTA1My02MjE5OWYwYTA4NDUiLCJhdWQiOlsicmVzdHNlcnZpY2UiXSwidXNlcl9uYW1lIjoiY2VudGVyQGNtLmNvbS52biIsInNjb3BlIjpbInJlYWQiXSwiaXNzIjoiaHR0cHM6Ly9sb2NhbGhvc3QiLCJuYW1lIjoiY2VudGVyQGNtLmNvbS52biIsInV1aWRfYWNjb3VudCI6ImRiNGFmZmVkLWE2NjktMjIyYy1lMDUzLTYyMTk5ZjBhMDg0NSIsImF1dGhvcml0aWVzIjpbIlVTRVIiXSwianRpIjoiNDIwN2I5ZGYtMjc0MS00ZWJiLTlhYzMtNWFiOWUwOWNmNjM0IiwiY2xpZW50X2lkIjoiYWRtaW5hcHAifQ.WN1cnZ8ymq65hEh5WenXQYD5EhNu_FIQBDQQ1kftTDmB5LKE_n2K2dsfmrQDw7j3KhkjehRezEdmQT38VfMVQgvWGupOqcpithejtge1-2qeFLl7bsZgU-QZTQAoA6zH4MIcXije5WO9M8HsfMfqL8XtUxt1wTHXt7oksxtRrHv0TuFBNfymFhhit69Kxr9BH9kTKQ41UsHXaDYrqm8sMg4zAiONVF8LQy2zKYagepvJp6rVu7btM4dYcwcpplh0Y6DkmY2Qla87WBB0YDKmtsWJo2Y__5TpShg_JC_YtXjlPJk7viRuf5bJGnIWR9jAOvzDkT04uxLhI5v8umodXg",
                            // PARRENT_ID: "ekyc_sdk_intergrated",
                            // FLOW_TYPE: "DOCUMENT", // DOCUMENT, FACE
                            // SHOW_HELP: true,
                            // CHECK_LIVENESS_CARD: true,
                            // CHECK_LIVENESS_FACE: true,
                            // CHECK_MASKED_FACE: true,
                            // COMPARE_FACE: true,
                            // LANGUAGE: 'vi',
                            // LIST_ITEM: [-1, 5, 6, 7, 9],
                            // TYPE_DOCUMENT: 99,
                            // USE_WEBCAM: true,
                            // USE_UPLOAD: false,
                            PARRENT_ID: "ekyc_sdk_intergrated",
                            FLOW_TYPE: "DOCUMENT", // DOCUMENT, FACE
                            SHOW_RESULT: true,
                            SHOW_HELP: true,
                            SHOW_TRADEMARK: false,
                            CHECK_LIVENESS_CARD: true,
                            CHECK_LIVENESS_FACE: true,
                            CHECK_MASKED_FACE: true,
                            COMPARE_FACE: true,
                            LANGUAGE: 'vi',
                            LIST_ITEM: [-1, 5, 6, 7, 9],
                            TYPE_DOCUMENT: 99,
                            USE_WEBCAM: true,
                            USE_UPLOAD: false,
                            ADVANCE_LIVENESS_FACE: true,
                            LIST_CHOOSE_STYLE: {
                                background: "#fff",
                                text_color: "black",
                                border_item: "",
                                item_active_color: "#18D696",
                                background_icon: "#18D696",
                                id_icon: "https://ekyc-web.icenter.ai/images/si/id_card.svg",
                                passport_icon: "https://ekyc-web.icenter.ai/images/si/passport.svg",
                                drivecard_icon: "https://ekyc-web.icenter.ai/images/si/drivecard.svg",
                                army_id_icon: "https://ekyc-web.icenter.ai/images/si/other_doc.svg",
                                id_chip_icon: "https://ekyc-web.icenter.ai/images/si/id_chip.svg",
                                start_button_background: "#18D696",
                                start_button_color: "#111127"

                            },
                            CAPTURE_IMAGE_STYLE: {
                                popup1_box_shadow: "0px 0px 2px rgba(0, 0, 0, 0.06), 0px 3px 8px rgba(0, 0, 0, 0.1)",
                                popup1_title_color: "#C8242D",
                                description1_color: "#fff",
                                capture_btn_background: "#18D696",
                                capture_btn_color: "#111127",
                                capture_btn_icon: "https://ekyc-web.icenter.ai/images/hdbank/capture.svg",
                                tutorial_btn_icon: "https://ekyc-web.icenter.ai/images/hdbank/help.gif",
                                recapture_btn_background: "linear-gradient(180deg, #FDFDFD 0%, #DEDEDE 100%)",
                                recapture_btn_color: "#111127",
                                recapture_btn_border: "2px solid #FEDC00",
                                recapture_btn_icon: "https://ekyc-web.icenter.ai/images/hdbank/capture.svg",
                                nextstep_btn_background: "#18D696",
                                nextstep_btn_color: "#111127",
                                nextstep_btn_icon: "https://ekyc-web.icenter.ai/images/hdbank/next_icon.svg",
                                popup2_box_shadow: "0px 0px 2px rgba(0, 0, 0, 0.06), 0px 3px 8px rgba(0, 0, 0, 0.1)",
                                popup2_title_header_color: "#C8242D",
                                popup2_icon_header: "https://ekyc-web.icenter.ai/images/hdbank/main_icon.svg",
                                popup2_icon_warning1: "",
                                popup2_icon_warning2: "",
                                popup2_icon_warning3: "",

                            },
                            RESULT_DEFAULT_STYLE: {
                                redemo_btn_background: "#18D696",
                                redemo_btn_icon: "https://ekyc-web.icenter.ai/images/hdbank/refresh.svg",
                                redemo_btn_color: "#111127"
                            },
                            MOBILE_STYLE: {
                                mobile_capture_btn: "https://ekyc-web.icenter.ai/images/capure_mobile.png",
                                mobile_capture_desc_color: "#18D696",
                                mobile_tutorial_color: "#C8242D",
                                mobile_recapture_btn_background: "linear-gradient(180deg, #FDFDFD 0%, #DEDEDE 100%)",
                                mobile_recapture_btn_border: "1px solid #18D696",
                                mobile_recapture_btn_icon: "https://ekyc-web.icenter.ai/images/hdbank/capture.svg",
                                mobile_recapture_btn_color: "#111127",
                                mobile_nextstep_btn_background: "#18D696",
                                mobile_nextstep_btn_color: "#111127",
                                mobile_nextstep_btn_icon: "https://ekyc-web.icenter.ai/images/next_icon_b.png",
                                mobile_popup2_icon_header: "https://ekyc-web.icenter.ai/images/hdbank/face_icon_popup.svg",

                            }
                        }
                        ekycsdk.init(initObj, (res) => {
                            //do some thing
                            console.log('res', res)
                            ekycsdk.viewResult(res.type_document, res)

                        }, call_after_end_flow);

                        function call_after_end_flow(data) {
                            var vnpt_ekyc = document.getElementById("vnpt_ekyc");
                            vnpt_ekyc.parentNode.removeChild(vnpt_ekyc);
                            ekycsdk.init({
                                ...initObj,
                                FLOW_TYPE: "FACE",
                                TYPE_DOCUMENT: data.type_document
                            }, (res2) => {
                                // console.log('res2', Object.assign({}, data, res2))
                                ekycsdk.viewResult(data.type_document, Object.assign({}, data, res2))
                            })

                        }

                    }
                </script>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
