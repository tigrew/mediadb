<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileManager
 *
 * @author ginomazzola
 */
class FileManager {


    /**
     * @param type $path
     */
    Public static function SaveFile($name = "") {
       
        $target_dir = __DIR__.$target_dir;
        $message = "";
        $target_file = $target_dir . basename($_FILES[$name]["name"]);
        
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        
        $check = getimagesize($_FILES[$name]["tmp_name"]);
        
        if ($check !== false) {
            $message .= " File is an image - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            $message .= "File is not an image.";
            $uploadOk = 0;
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $message .= "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES[$name]["size"] > 500000) {
            $message .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message .= "Sorry, your file was not uploaded.";
            $target_file = false;
            
            
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
                $message .= "The file " . basename($_FILES[$name]["name"]) . " has been uploaded.";
                $target_file = basename($_FILES[$name]["name"]);
            } else {
                $message .= "Sorry, there was an error uploading your file.";
                $target_file = false;
            }
        }
        /** 
         * @var $target_file 
         * 
         * Filename on  success || False on error
         * 
         * @var message  upload error messages || upload success messages
         * 
         */
        return array( 'message' => $message , 'file' => $target_file) ;
    }
    
    public static function GetFilePath($file_name){
        return __DIR__.Config::getInstance()->get('file_directory').$file_name;
    }
            
     public static function GetFilePathForFront($file_name){
        return Config::getInstance()->get('file_directory').$file_name;
    }

}
