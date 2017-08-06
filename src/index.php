<?php
namespace Captcha;

class Captcha{

    private $height;
    private $width;
    private $length;
    private $fontSize;
    private $code;
    private $fontFile = './vcode.ttf';

    public function __construct($height = 40, $width = 75, $length = 4, $fontSize = 16){

        $this->height   = $height;
        $this->width    = $width;
        $this->length   = $length;
        $this->fontSize = $fontSize;

    }

    private function getText(){

        $str  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for( $i = 0; $i < $this->length; $i++ ){
            $this->code .=  $str{mt_rand(0, strlen($str)-1)};
        }

    }

    private function getCanvas(){

        $im      = imagecreatetruecolor($this->width, $this->height);
        $bgColor = imagecolorallocate($im, mt_rand(120, 225), mt_rand(120, 225), mt_rand(120, 225));
        imagefilledrectangle ($im, 0, 0, $this->width, $this-> height, $bgColor);

        for( $i = 0; $i <= floor($this->width*$this->height/2); $i++ ){
            $color = imagecolorallocate($im, mt_rand(50, 150), mt_rand(50, 150), mt_rand(50, 150));
            imagesetpixel($im, mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }

        $gap   = mt_rand(0, 3);
        $width = 10;
        $x = floor(($this->width-$this->length*$width-$gap*($this->length-1))/2);
        $y = floor(mt_rand($this->fontSize, $this->height-$this->fontSize/2));

        for( $i = 0; $i < $this->length; $i++ ){

            $fontColor = imagecolorallocate($im, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
            imagettftext($im, $this->fontSize, mt_rand(0, 35), $x+($width+$gap)*$i, $y,
                $fontColor, $this->fontFile, $this->code{$i});
        }

        header('Content-Type:image/png');
        imagepng($im);
        imagedestroy($im);

    }

    public function run(){

        self::getText();
        self::getCanvas();

    }

}
$run = new Captcha();
$run ->run();


