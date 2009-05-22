<?php
class sfCaptcha
{

  public $securityCode;
  private $codeLength=6;
  private $imageFile= 'captchaImg.jpg';
  public $fontSize  = 12;
  public $fontColor  = array("252525","8b8787","550707");
 
  public function simpleRandString($length, $list="23456789ABDEFGHJKLMNQRTYabdefghijkmnqrty") {
    /*
     * Generates a random string with the specified length
     * Chars are chosen from the provided [optional] list
    */
    mt_srand((double)microtime()*1000000);

    $newstring = "";

    if ($length > 0) {
        while (strlen($newstring) < $length) {
            $newstring .= $list[mt_rand(0, strlen($list)-1)];
        }
    }
    return $newstring;
  }

  public function generateImage()
  {

    $this->securityCode = $this->simpleRandString($this->codeLength);

    $img_path = dirname(__FILE__)."/../../web/uploads/";

    if(!is_writable($img_path) && !is_dir($img_path)){
      $error = "The image path $img_path does not appear to be writable or the folder does not exist. Please verify your settings";
      throw new Exception($error);
    }

    $this->img = imagecreatefromjpeg($img_path.$this->imageFile);

    $img_size = getimagesize($img_path.$this->imageFile);

    foreach($this->fontColor as $fcolor)
    {
        $color[] = imagecolorallocate($this->img,
                hexdec(substr($fcolor, 1, 2)),
                hexdec(substr($fcolor, 3, 2)),
                hexdec(substr($fcolor, 5, 2))
                );
    }
    $line = imagecolorallocate($this->img,255,255,255);
    $line2 = imagecolorallocate($this->img,200,200,200);

    $fw = imagefontwidth($this->fontSize)+3;
    $fh = imagefontheight($this->fontSize);

    // create a new string with a blank space between each letter so it looks better
    $newstr = "";
    for ($i = 0; $i < strlen($this->securityCode); $i++) {
        $newstr .= $this->securityCode[$i] ." ";
    }

    // remove the trailing blank
    $newstr = trim($newstr);

    // center the string
    $x = ($img_size[0] - strlen($newstr) * $fw ) / 2;

    $font[0] = '/usr/share/fonts/truetype/msttcorefonts/arial.ttf';
    $font[1] = '/usr/share/fonts/truetype/msttcorefonts/arial.ttf';
    $font[2] = '/usr/share/fonts/truetype/msttcorefonts/arial.ttf';

    // create random lines over text
    for($i=0; $i <3;$i++){
        $s_x = rand(40,180);
        $s_y = rand(5,35);
        $e_x = rand(($s_x-50), ($s_x+50));
        $e_y = rand(5,35);
        $c = rand(0, (count($color)-1));
      imageline($this->img, $s_x,$s_y, $e_x,$e_y, $color[$c]);
    }

    // random bg ellipses
    imageellipse($this->img, $s_x, $s_y, $e_x, $e_y, $line);
    imageellipse($this->img, $e_x, $e_y, $s_x, $s_y, $line2);

    // output each character at a random height and standard horizontal spacing
    for ($i = 0; $i < strlen($newstr); $i++) {
        $hz = mt_rand( 10, $img_size[1] - $fh - 5);

        // randomize rotation
        $rotate = rand(-35, 35);

        // randomize font size
        $this->fontSize =  rand(14, 18);

        // radomize color
        $c = rand(0, (count($color)-1));

        // imagechar( $this->img, $this->fontSize, $x + ($fw*$i), $hz, $newstr[$i], $color);
        imagettftext($this->img, $this->fontSize,$rotate , $x + ($fw*$i), $hz + 12, $color[0], $font[$c], $newstr[$i]);
    }
  }
}
