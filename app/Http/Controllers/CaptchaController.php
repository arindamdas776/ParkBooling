<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    //
    public function create()
    {
        return view('captchacreate');
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function genCaptcha() {
        $text='test@example.com';
        $text = substr(str_shuffle('4683594565605811089035041901452779234366'), 3, 5);
        $string = $text;
        $font   = 5;
        // $width  = ImageFontWidth($font) * strlen($string);
        // $height = ImageFontHeight($font);
        $width  = 100;
        $height = 40;
        $textColor = '#162453';
        $textColor=$this->hexToRGB($textColor);

        $im = @imagecreate ($width,$height);
        $background_color = imagecolorallocate ($im, 255, 255, 255); //white background
        // $text_color = imagecolorallocate ($im, 0, 0,0);//black text
        $text_color = imagecolorallocate($im, $textColor['r'],$textColor['g'],$textColor['b']);

        imagestring ($im, $font, 20, 6, $string, $text_color);
        /* generating lines randomly in background of image */
        $noiceLines = 3;
        $noiceDots = 10;
        $noiceColor='#162453';
        if($noiceLines>0){
            $noiceColor=$this->hexToRGB($noiceColor);
            $noiceColor = imagecolorallocate($im, $noiceColor['r'],$noiceColor['g'],$noiceColor['b']);
            for( $i=0; $i<$noiceLines; $i++ ) {
                imageline($im, mt_rand(0,$width), mt_rand(0,$height),
                mt_rand(0,$width), mt_rand(0,$height), $noiceColor);
            }
        }
        /* generating the dots randomly in background */
        if($noiceDots>0){
            for( $i=0; $i<$noiceDots; $i++ ) {
                imagefilledellipse($im, mt_rand(0,$width),
                mt_rand(0,$height), 3, 3, $text_color);
            }
        }
        ob_start();
        imagepng($im);
        $imstr = base64_encode(ob_get_clean());
        imagedestroy($im);
        // session(['captcha_text' => $text]);
        session()->put('captcha_text', $text);
        session()->save();
        return '<img src="data:image/png;base64,'.$imstr.'"/>';
    }
    private function hexToRGB($colour) {
        if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
            return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'r' => $r, 'g' => $g, 'b' => $b );
    }
}
