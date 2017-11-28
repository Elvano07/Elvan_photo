<?php

    function blurImage($srcimg,$blur)
    {
        $blur = $blur*$blur;
        $blur = max(0,min(1,$blur));
    
        $srcw = imagesx($srcimg);
        $srch = imagesy($srcimg);
        
        $dstimg = imagecreatetruecolor($srcw,$srch);
    
        $f1a = $blur;
        $f1b = 1.0 - $blur;

    
        $cr = 0; $cg = 0; $cb = 0;
        $nr = 0; $ng = 0; $nb = 0;

        $rgb = imagecolorat($srcimg,0,0);
        $or = ($rgb >> 16) & 0xFF;
        $og = ($rgb >> 8) & 0xFF;
        $ob = ($rgb) & 0xFF;

        //-------------------------------------------------
        // first line is a special case
        //-------------------------------------------------
        $x = $srcw;
        $y = $srch-1;
        while ($x--)
        {
            //horizontal blurren
            $rgb = imagecolorat($srcimg,$x,$y);
            $cr = ($rgb >> 16) & 0xFF;
            $cg = ($rgb >> 8) & 0xFF;
            $cb = ($rgb) & 0xFF;
    
            $nr = ($cr * $f1a) + ($or * $f1b);
            $ng = ($cg * $f1a) + ($og * $f1b);
            $nb = ($cb * $f1a) + ($ob * $f1b);    

            $or = $nr;
            $og = $ng;
            $ob = $nb;
            
            imagesetpixel($dstimg,$x,$y,($nr << 16) | ($ng << 8) | ($nb));
        }
        //-------------------------------------------------

        //-------------------------------------------------
        // now process the entire picture
        //-------------------------------------------------
        $y = $srch-1;
        while ($y--)
        {

            $rgb = imagecolorat($srcimg,0,$y);
            $or = ($rgb >> 16) & 0xFF;
            $og = ($rgb >> 8) & 0xFF;
            $ob = ($rgb) & 0xFF;

            $x = $srcw;
            while ($x--)
            {
                //horizontal 
                $rgb = imagecolorat($srcimg,$x,$y);
                $cr = ($rgb >> 16) & 0xFF;
                $cg = ($rgb >> 8) & 0xFF;
                $cb = ($rgb) & 0xFF;
                
                $nr = ($cr * $f1a) + ($or * $f1b);
                $ng = ($cg * $f1a) + ($og * $f1b);
                $nb = ($cb * $f1a) + ($ob * $f1b);    
    
                $or = $nr;
                $og = $ng;
                $ob = $nb;
                
                
                //vertical 
                $rgb = imagecolorat($dstimg,$x,$y+1);
                $vr = ($rgb >> 16) & 0xFF;
                $vg = ($rgb >> 8) & 0xFF;
                $vb = ($rgb) & 0xFF;
                
                $nr = ($nr * $f1a) + ($vr * $f1b);
                $ng = ($ng * $f1a) + ($vg * $f1b);
                $nb = ($nb * $f1a) + ($vb * $f1b);    
    
                $vr = $nr;
                $vg = $ng;
                $vb = $nb;
                
                imagesetpixel($dstimg,$x,$y,($nr << 16) | ($ng << 8) | ($nb));
            }
        
        }
        //-------------------------------------------------
        return $dstimg;        

    }

    
    $srcimg = imagecreatefromjpeg("photo.jpeg");
    $dstimg = blurImage($srcimg,0.2);

    header('Content-type: image/jpeg');
    echo( imagejpeg($dstimg) );
    exit();
    
    
?>