<?php

namespace App;

use InvalidArgumentException;

class imgUploader
{
    private $width = 200;
    private $height = 200;

    private $uploadPath = "";

    private $imgName = "";

    private $imgThumName = "";

    public function __construct($data) {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
    }

    public function upload() {
        if(is_array($_FILES)) {
            $uploadedFile = $_FILES['file']['tmp_name'];
            if ($uploadedFile == '') {
                throw new InvalidArgumentException('Please select a file first');
            }
            $sourceProperties = getimagesize($uploadedFile);
            if (!$sourceProperties) {
                throw new InvalidArgumentException('Not valid image file');
            }
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $imageType = $sourceProperties[2];

            switch ($imageType) {
                case IMAGETYPE_PNG:
                    $imageSrc = imagecreatefrompng($uploadedFile);
                    $tmp = $this->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                    imagepng($tmp,$this->uploadPath . $this->imgThumName . "." . $ext);
                    break;

                case IMAGETYPE_JPEG:
                    $imageSrc = imagecreatefromjpeg($uploadedFile);
                    $tmp = $this->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($tmp,$this->uploadPath. $this->imgThumName . "." . $ext);
                    break;

                case IMAGETYPE_GIF:
                    $imageSrc = imagecreatefromgif($uploadedFile);
                    $tmp = $this->imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                    imagegif($tmp,$this->uploadPath . $this->imgThumName . "." . $ext);
                    break;

                default:
                    throw new InvalidArgumentException('Invalid Image type');
                    break;
            }

            move_uploaded_file($uploadedFile, $this->uploadPath . $this->imgName . "." . $ext);
            return [
                "ext" => $ext,
            ];
        }
    }

    private function imageResize($imageSrc,$imageWidth,$imageHeight) {

        $newImageLayer=imagecreatetruecolor($this->width,$this->height);
        imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$this->width,$this->height,$imageWidth,$imageHeight);

        return $newImageLayer;
    }
}