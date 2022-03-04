var loadFile = function(event) {
    var output = document.getElementById('output-1');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};


var loadFile2 = function(event) {
    var output = document.getElementById('output-2');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
let camera_button = document.querySelector("#start-camera");
let click_button = document.querySelector("#click-photo");
let live_cam = document.querySelector(".live_cam");
let tool_kyc = document.querySelector('.tool-ekyc');
let block_front = document.querySelector(".verify_image_front");
let preview_front = document.querySelector("#preview-front");
let result_front = document.querySelector("#image-front");
let video = document.querySelector("#video");

let block_back = document.querySelector(".verify_image_back");
let preview_back = document.querySelector("#preview-back");
let result_back = document.querySelector("#image-back");

let block_portrait = document.querySelector(".verify_image_portrait");
let preview_portrait = document.querySelector("#preview-portrait");
let result_portrait = document.querySelector("#image-portrait");

let status_front = document.querySelector("#status-front");
let status_back = document.querySelector("#status-back");
let status_portrait = document.querySelector("#status-portrait");

let check_ekyc = document.querySelector('.check-ekyc');
camera_button.addEventListener('click', async function() {


});

$('select[name="type_cmnd"]').on('change', async function(e) {
    if ($(this).val() != 0) {
        if (window.matchMedia('screen and (min-width: 768px)').matches) {
            const options = {
                audio: false,
                video: true,
            };
            stream = await navigator.mediaDevices.getUserMedia(options);
            video.srcObject = stream;
        }


        (() => {
            // const videoElm = document.querySelector('#video');
            const btnFront = document.querySelector('#btn-front');
            const btnBack = document.querySelector('#btn-back');
            const supports = navigator.mediaDevices.getSupportedConstraints();
            if (!supports['facingMode']) {
                alert('Browser Not supported!');
                return;
            }

            let stream;


            const capture = async facingMode => {

                const options = {
                    audio: false,
                    video: {
                        facingMode,
                        width: { min: 1280 },
                        height: { min: 720 }
                    },
                };
                // let options = {
                //     audio: false,
                //     video: true,
                //     facingMode: shouldFaceUser ? 'user' : 'environment'

                // }
                try {
                    if (stream) {
                        const tracks = stream.getTracks();
                        tracks.forEach(track => track.stop());
                    }
                    stream = await navigator.mediaDevices.getUserMedia(options);
                    video.srcObject = stream;


                } catch (e) {
                    alert(e);
                    return;
                }
                video.srcObject = null;
                video.srcObject = stream;
                video.play();
            }

            btnBack.addEventListener('click', () => {

                capture('environment');

            });

            btnFront.addEventListener('click', () => {

                capture('user');

            });
        })();
        live_cam.style.display = 'block';
        camera_button.style.display = 'none';
        tool_kyc.style.display = 'block';
        block_front.style.display = 'block';

    }
});

click_button.addEventListener('click', function() {

    if (status_front.value == 0) {
        preview_front.getContext('2d').drawImage(video, 0, 0, preview_front.width, preview_front.height);
        preview_front.style.display = 'block';
        let image_data_url = preview_front.toDataURL('image/jpeg');
        console.log(image_data_url);
        result_front.value = image_data_url;
    } else if (status_back.value == 0) {
        preview_back.getContext('2d').drawImage(video, 0, 0, preview_back.width, preview_back.height);
        preview_back.style.display = 'block';
        let image_data_url = preview_back.toDataURL('image/jpeg');
        console.log(image_data_url);
        result_back.value = image_data_url;
    } else if (status_portrait.value == 0) {
        preview_portrait.getContext('2d').drawImage(video, 0, 0, preview_portrait.width, preview_portrait.height);
        preview_portrait.style.display = 'block';
        let image_data_url = preview_portrait.toDataURL('image/jpeg');
        console.log(image_data_url);
        result_portrait.value = image_data_url;
    }
});

function confirmImage() {
    // status_front = document.querySelector("#status-front");
    // status_back = document.querySelector("#status-back");
    // status_portrait = document.querySelector("#status-portrait");
    if (status_front.value == 0) {
        if (result_front.value == '') {
            alert('Bạn chưa chụp ảnh mặt trước hồ sơ');
        } else {
            status_front.value = 1;
            block_back.style.display = 'block';
        }
    } else if (status_back.value == 0) {
        if (result_back.value == '') {
            alert('Bạn chưa chụp ảnh mặt trước hồ sơ');
        } else {
            status_back.value = 1;
            block_portrait.style.display = 'block';
        }
    } else if (status_portrait.value == 0) {
        if (result_portrait.value == '') {
            alert('Bạn chưa chụp ảnh mặt trước hồ sơ');
        } else {
            status_portrait.value = 1;
            tool_kyc.style.display = 'none';
            check_ekyc.style.display = 'block';
            live_cam.style.display = 'none';

        }
    }
}