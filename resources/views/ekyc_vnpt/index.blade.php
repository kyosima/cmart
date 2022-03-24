@extends('layout.master')

@section('title', 'Xác thực thông tin tài khoản')
@push('css')
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div id="ekyc_sdk_intergrated"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script id="oval_custom" src="https://ekyc-web.icenter.ai/lib/VNPTBrowserSDKApp.js"></script>
    <script src="https://ekyc-web.icenter.ai/lib/jsQR.js"></script>
    <script>
        let vnpt_ekyc_sdk = document.createElement('script');
        vnpt_ekyc_sdk.id = 'vnpt_ekyc_sdk';
        vnpt_ekyc_sdk.src = "{{ asset('public/sdk_ekyc/ekyc-web-sdk-1.0.3.js') }}";
        vnpt_ekyc_sdk.async = true;
        vnpt_ekyc_sdk.defe = true;
        document.head.appendChild(vnpt_ekyc_sdk);

        let vnpt_ekyc_styles = document.createElement('link');
        vnpt_ekyc_styles.id = 'vnpt_ekyc_styles';
        vnpt_ekyc_styles.rel = 'stylesheet';
        vnpt_ekyc_styles.href = "{{ asset('public/sdk_ekyc/ekyc-web-sdk-1.0.3.css') }}";
        vnpt_ekyc_styles.async = true;
        vnpt_ekyc_styles.defe = true;
        document.head.appendChild(vnpt_ekyc_styles);
        var token =
            "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJkYWYwYTEzZS1kOTNjLTg5ZWEtZTA1My02YzFiOWYwYTNjOWYiLCJhdWQiOlsicmVzdHNlcnZpY2UiXSwidXNlcl9uYW1lIjoia2lyYWJib3l0dEBnbWFpbC5jb20iLCJzY29wZSI6WyJyZWFkIl0sImlzcyI6Imh0dHBzOi8vbG9jYWxob3N0IiwibmFtZSI6ImtpcmFiYm95dHRAZ21haWwuY29tIiwidXVpZF9hY2NvdW50IjoiZGFmMGExM2UtZDkzYy04OWVhLWUwNTMtNmMxYjlmMGEzYzlmIiwiYXV0aG9yaXRpZXMiOlsiVVNFUiJdLCJqdGkiOiJjNTM1MDM1NC01MTM3LTQ2MzgtYWJiYi1hMzc5ZDk2OWU5M2QiLCJjbGllbnRfaWQiOiJhZG1pbmFwcCJ9.IXe7bvqdfTL8z6zRUwn62xSrDjshe4Czwn1BpxjrWvzSS_3etu3EpWmno2Znw9JxKWmiPr8jc9f2TkaIzYxR0RkNs7oXI3FWAku9EPBbzJ2az9YdoBXJTrWLL_G7GYXmZ3lv72krZ8O9cIEY5GhEB3anJGKkeJqh16OPf0MQh2T8Kw_QCt2TB4R9ZIvkrcps7iodV7XFTQ0q5RxvR4JH8GcyOVCWh80c8ExvdJ2ANQMUFvcWPFKGjFUoz8kDRrjnYL2YZc1SowMHg6GFYnAz87ru7bvDl_d8LKqABlk9jPU7vxSOkcfthXDujkRvoOrT475RYxheVjoPndQE6STJJw"

        vnpt_ekyc_sdk.onload = async function() {
            await FaceVNPTBrowserSDK.init();
            var initObj = {
                BACKEND_URL: "",
                TOKEN_KEY: "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAKCIgQdDzGiEHLfNYAAlAV0l37EyoZhl6Pe+aqSyMmo/rYbT6vHcJ0QzpPo6s1f1sbK2mPdgu0DMsnvF8WCxF/0CAwEAAQ==",
                TOKEN_ID: "daf0bb6e-a545-ae1c-e053-6c1b9f0a0f2b",
                AUTHORIZION: token,
                ENABLE_GGCAPCHAR: false,
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
                // ekycsdk.viewResult(res.type_document, res)

            });

            function call_after_end_flow(data) {
                console.log('data', data)
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
@endpush
