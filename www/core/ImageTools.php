<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 20.11.2017
 * Time: 17:02
 */

namespace core;
// this class will receive $_FILES from the uploading and will :
// 1- make a unique name for every image i upload
// 2- delete the image if the answer is deleted !


class ImageTools
{


    public function saveImageFromPost(){
        // give the image a unique name then save it in the directory i want.
        if(!empty($_FILES['images'])) {
            $imageData = $_FILES;
            $tmp_name = $imageData['images']['tmp_name'];
            $file_name = $this->getImageName();
            $upload_dir = DIR_IMAGES_DATA . "/" . $file_name;
            move_uploaded_file($tmp_name, $upload_dir);
            return $file_name;
        }else{
            return false;
        }
    }

    protected function getImageName(){
        $path = $_FILES['images']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $target_file_name = md5(uniqid()).".".$ext;
        return $target_file_name ;
    }


}