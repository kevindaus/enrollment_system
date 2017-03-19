$(document).ready(function () {
    var attrPhoto = $("#yii2-webcam-shoot-photo").attr('src');
    $("#yii2-webcam-shoot-show").on('click', function () {
        $("#yii2-webcam-shoot-photo").height($("#yii2-webcam-shoot-video").height());
        $('#yii2-webcam-shoot-ok').attr('disabled', 'disabled');
        $("#yii2-webcam-shoot-video").attr('src', '');
        $("#yii2-webcam-shoot-photo").attr('src', attrPhoto);
        //Работа с WEB камерой
        (function () {
            var video = document.getElementById('yii2-webcam-shoot-video'),
                    canvas = document.getElementById('yii2-webcam-shoot-canvas'),
                    context = canvas.getContext('2d'),
                    photo = document.getElementById('yii2-webcam-shoot-photo'),
                    vendorUrl = window.URL || window.webkitURL;
            navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.
                    mozGetUserMedia || navigator.msGetUserMedia;
            navigator.getMedia({
                video: true,
                audio: false
            },
                    function (stream) { //Если все ОК
                        video.src = vendorUrl.createObjectURL(stream);
                        video.play();
                        $('#yii2-webcam-shoot-capture').removeAttr('disabled');
                        $('#yii2-webcam-shoot-error').hide();
                        $('#yii2-webcam-shoot-capture').on('click', function () {
                            context.drawImage(video, 0, 0, $("#yii2-webcam-shoot-video").width(), $("#yii2-webcam-shoot-video").height());
                            photo.setAttribute('src', canvas.toDataURL('image/png'));
                            $('#yii2-webcam-shoot-ok').removeAttr('disabled');
                        });
                    },
                    function (error) { //Если ошибка
                        $('#yii2-webcam-shoot-capture').attr('disabled', 'disabled');
                        $('#yii2-webcam-shoot-error').show();
                    }
            );
        })();
    });
});
