<?php

namespace Thumbimg;

/**
 * Create image thumbnail
 */
class Thumbimg {

    /**
     * 
     * @param type $srcImages
     * @param type $outputDir
     * @param type $outputURL
     * @param type $width
     * @param type $height
     * @param type $quality
     * @return URL
     */
    public static function img($srcImages, $outputDir, $outputURL, $width = 100, $height = 100, $quality = 95) {

        $extension = self::setExtension($srcImages);
        $fileName = self::setFilename($srcImages);
        $outputFileName = $width . 'x' . $height . '_' . $quality . '_' . $fileName;
        $outputFilePath = $outputDir . $outputFileName;

        if (!file_exists($outputFilePath) AND file_exists($srcImages)) {
            self::createThumbnail($srcImages, $width, $height, $quality, $outputFilePath, $extension);
        }

        return $outputURL.$outputFileName;
    }

    /**
     * 
     * @param type $imgSrc
     * @param type $thumbnail_width
     * @param type $thumbnail_height
     * @param type $jakosc
     * @param type $outputFilePath
     * @param type $extension
     */
    private static function createThumbnail($imgSrc, $thumbnail_width, $thumbnail_height, $jakosc, $outputFilePath, $extension) {
        list($width_orig, $height_orig) = getimagesize($imgSrc);

        $ratio_orig = $width_orig / $height_orig;
        if ($thumbnail_width / $thumbnail_height > $ratio_orig) {
            $new_height = $thumbnail_width / $ratio_orig;
            $new_width  = $thumbnail_width;
        } else {
            $new_width  = $thumbnail_height * $ratio_orig;
            $new_height = $thumbnail_height;
        }
        $x_mid   = $new_width / 2;  //horizontal middle
        $y_mid   = $new_height / 2; //vertical middle
        $process = imagecreatetruecolor(round($new_width), round($new_height));

        switch ($extension) {
            case 'jpg' :
            case 'jpeg':
                $myImage = imagecreatefromjpeg($imgSrc);
                break;
            case 'png' :
                $myImage = imagecreatefrompng($imgSrc);
                $background = imagecolorallocate($process, 0, 0, 0);
                imagecolortransparent($process, $background);
                imagealphablending($process, false);
                imagesavealpha($process, true);
                break;
            case 'gif' :
                $myImage = imagecreatefromgif($imgSrc);
                break;
        }

        imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
        $thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

        if($extension == 'png'){
            $background = imagecolorallocate($thumb, 0, 0, 0);
            imagecolortransparent($thumb, $background);
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
        }
        
        imagecopyresampled($thumb, $process, 0, 0, ($x_mid - ($thumbnail_width / 2)), ($y_mid - ($thumbnail_height / 2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);
        imagedestroy($process);
        imagedestroy($myImage);

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($thumb, $outputFilePath, $jakosc);
                break;
            case 'png':
                imagepng($thumb, $outputFilePath);
                break;
            case 'gif':
                imagegif($thumb, $outputFilePath);
                break;
        }
    }

    /**
     * Extract a file extension
     */
    private static function setExtension($srcImages) {
        return pathinfo($srcImages, PATHINFO_EXTENSION);
    }

    /**
     * Extract a file name
     */
    private static function setFilename($srcImages) {
        return basename($srcImages);
    }



}
