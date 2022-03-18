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
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let live_cam = document.querySelector(".live_cam");
let tool_kyc = document.querySelector('.tool-ekyc');

let block_portrait = document.querySelector(".verify_image_portrait");
let preview_portrait = document.querySelector("#preview-portrait");
let result_portrait = document.querySelector("#image-portrait");


let status_portrait = document.querySelector("#status-portrait");

let check_ekyc = document.querySelector('.check-ekyc');
camera_button.addEventListener('click', async function() {
    let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
    video.srcObject = stream;
    live_cam.style.display = 'block';
    camera_button.style.display = 'none';
    tool_kyc.style.display = 'flex';
    block_portrait.style.display = 'block';


});
$(document).ready(function() {

    $('#start-camera').trigger('click');
});
click_button.addEventListener('click', function() {


    preview_portrait.getContext('2d').drawImage(video, 0, 0, preview_portrait.width, preview_portrait.height);
    preview_portrait.style.display = 'block';
    let image_data_url = preview_portrait.toDataURL('image/jpeg');
    console.log(image_data_url);
    result_portrait.value = image_data_url;
});

function confirmImage() {
    // status_front = document.querySelector("#status-front");
    // status_back = document.querySelector("#status-back");
    // status_portrait = document.querySelector("#status-portrait");
    if (status_portrait.value == 0) {
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