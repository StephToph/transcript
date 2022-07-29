 <?php

        $img1 = base_url('assets/qr11.png');
        $img2 = base_url('assets/res.png');
       
        ///////////////////////////////////PHP IMAGE TRANSPARENT///////////////////////
        //$img = imagecreatefrompng($img1);  //image obj from url
        //$bg_color = imagecolorat($img,1,1);  //get color of top-left pixel
        //imagecolortransparent($img, $bg_color);  //matching px => transparent
        //imagepng($img, 'assets/qr11.png');  //output png
        //imagedestroy($img);  //cleanup
        /////////////////////////////////////////////////////////////////////////////////

        ///////////////////PHP IMAGE RESIZE////////////////////////////////////////////
        $t = imagecreatefromjpeg(base_url('assets/img.jpg'));
        $x = imagesx($t);
        $y = imagesy($t);
        $new_width = '330';
        $new_height = '330';

        $s = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($s, $t, 0, 0, 0, 0, $new_width, $new_height,$x, $y);

        imagepng($s, 'assets/res.png');
        ////////////////////////////////////////////


       //print_r(getimagesize($img1));print_r(getimagesize($img2));


        $dest = imagecreatefrompng($img2);
        $src = imagecreatefrompng($img1);

        imagealphablending($dest, false);
        imagesavealpha($dest, true);

        imagecopymerge($dest, $src, 10, 10, 0, 0, 330, 330, 100); //have to play with these numbers for it to work for you, etc.

        //header('Content-Type: image/png');
        //imagepng($dest);
        imagepng($dest, 'assets/imagae111.png');

        imagedestroy($dest);
        imagedestroy($src);
      
