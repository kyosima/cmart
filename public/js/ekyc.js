    var loadFile = function (event) {
        var output = document.getElementById('output-1');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    $('select[name="type_cmnd"]').on('change', function(e){
        if($(this).val() != 0){
            $('#start-camera').css('display', 'block');
        }
    });

    var loadFile2 = function (event) {
        var output = document.getElementById('output-2');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let click_button = document.querySelector("#click-photo");
    let live_cam = document.querySelector(".live_cam");
    let tool_kyc = document.querySelector('.tool-ekyc');

    let block_front = document.querySelector(".verify_image_front");
    let preview_front = document.querySelector("#preview-front");
    let result_front = document.querySelector("#image-front");

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
    camera_button.addEventListener('click', async function () {
        let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        video.srcObject = stream;
        live_cam.style.display = 'block';
        camera_button.style.display = 'none';
        tool_kyc.style.display = 'flex';
        block_front.style.display = 'block';


    });

    click_button.addEventListener('click', function () {
      
        if(status_front.value == 0){
            preview_front.getContext('2d').drawImage(video, 0, 0, preview_front.width, preview_front.height);
            preview_front.style.display = 'block';
            let image_data_url = preview_front.toDataURL('image/jpeg');
            console.log(image_data_url);
            result_front.value = image_data_url;
        }else if(status_back.value == 0){
            preview_back.getContext('2d').drawImage(video, 0, 0, preview_back.width, preview_back.height);
            preview_back.style.display = 'block';
            let image_data_url = preview_back.toDataURL('image/jpeg');
            console.log(image_data_url);
            result_back.value = image_data_url;
        }else if(status_portrait.value == 0){
            preview_portrait.getContext('2d').drawImage(video, 0, 0, preview_portrait.width, preview_portrait.height);
            preview_portrait.style.display = 'block';
            let image_data_url = preview_portrait.toDataURL('image/jpeg');
            console.log(image_data_url);
            result_portrait.value = image_data_url;
        }
    });
    function confirmImage(){
        // status_front = document.querySelector("#status-front");
        // status_back = document.querySelector("#status-back");
        // status_portrait = document.querySelector("#status-portrait");
        if(status_front.value == 0){
            if(result_front.value == ''){
                alert('Bạn chưa chụp ảnh mặt trước hồ sơ');
            }else{
                status_front.value = 1;
                block_back.style.display = 'block';
            }
        }else if(status_back.value == 0){
            if(result_back.value == ''){
                alert('Bạn chưa chụp ảnh mặt trước hồ sơ');
            }else{
                status_back.value = 1;
                block_portrait.style.display = 'block';
            }
        }else if(status_portrait.value == 0){
            if(result_portrait.value == ''){
                alert('Bạn chưa chụp ảnh mặt trước hồ sơ');
            }else{
                status_portrait.value = 1;
                tool_kyc.style.display = 'none';
                check_ekyc.style.display = 'block';
                live_cam.style.display = 'none';

            }
        }
    }