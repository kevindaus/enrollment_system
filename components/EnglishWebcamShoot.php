<?php

namespace app\components;

use timurmelnikov\widgets\WebcamShootAsset;
use yii\bootstrap\Modal;
use yii\web\View;

class EnglishWebcamShoot extends \timurmelnikov\widgets\WebcamShoot {

    public $headerText = 'Profile Picture';
    public $videoText = 'Video';
    public $photoText = 'Photo';
    public $buttonModalText = 'Take Picture';
    public $buttonCaptureText = 'Capture';
    public $buttonOKText = 'OK';
    public $buttonCancelText = 'Cancel';
    public $errorHeader = 'Error';
    public $errorText = 'An error occured while loading webcam api.';
    public $targetInputID = null;
    public $targetImgClass = null;
    public $width = 380;
    private $height;
    private $imgPhoto;
    public function init() {
        $view = $this->getView();
        $bundle = WebcamShootAsset::register($view);

        $this->imgPhoto = $bundle->baseUrl . '/images/web-camera.png';
        $this->height = $this->width / 4 * 3;
        $jsScript = '';
        if($this->targetInputID !== null){
            $jsScript .= <<<SCRIPT
$("#{$this->targetInputID}").val($("#yii2-webcam-shoot-photo").attr("src"));
SCRIPT;
        }
        if($this->targetImgClass !== null){
          $jsScript .= <<<SCRIPT
        $(".{$this->targetImgClass}").attr('src', $("#yii2-webcam-shoot-photo").attr('src'));
SCRIPT;
        }
        $script = <<<JS
$("#yii2-webcam-shoot-ok").on('click', function () {
        {$jsScript}
});
JS;
        $view->registerJs($script);
    }


    /**
     * Выполнение виджета.
     */
    public function run() {

        //Блок диалогового окна
        $html = <<<HTML
    <div class="row">

        <div class="col-md-12 col-lg-12">
            <div id="yii2-webcam-shoot-error" class="alert alert-danger" style="display: none">
                <strong>{$this->errorHeader}</strong> {$this->errorText}
            </div>
        </div>
    </div>
    <div class="row">
        <div  class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-facetime-video"></span> {$this->videoText}</div>
                <div class="panel-body ">
                    <video class="img-rounded center-block" id="yii2-webcam-shoot-video" width="{$this->width}" height="$this->height" autoplay></video>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-picture"> </span> {$this->photoText}</div>
                <div class="panel-body">
                    <canvas  id="yii2-webcam-shoot-canvas" width="{$this->width}" height="{$this->height}" style="display: none"></canvas>
                    <img class="img-rounded center-block" src="{$this->imgPhoto}"  id="yii2-webcam-shoot-photo">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
                <button type="button" id="yii2-webcam-shoot-capture" class="btn btn-warning btn-block">{$this->buttonCaptureText}</button>
        </div>
    </div>
HTML;
        //Подвал диалогового окна (кнопки)
        $footer = <<<FOOTER
        <button id = "yii2-webcam-shoot-ok" type="button" class = "btn btn-primary" data-dismiss = "modal">{$this->buttonOKText}</button>
        <button id = "yii2-webcam-shoot-cancel" type="button" class = "btn btn-default" data-dismiss = "modal">{$this->buttonCancelText}</button >
FOOTER;

        //Вызов модального окна
        Modal::begin([
            'header' => $this->headerText,
            'toggleButton' => ['label' => $this->buttonModalText, 'id' => 'yii2-webcam-shoot-show', 'class' => 'btn btn-primary'],
            'size' => 'modal-lg',
            'footer' => $footer,
        ]);
        echo $html;
        Modal::end();
    }

}