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

      const resized = "images/resized/";
      const real = "images/real/";
    
    public static function DeleteImage($name =""){
        
        $target_dir = getcwd().DIRECTORY_SEPARATOR.Config::getInstance()->get('file_directory');
      
        $target_dir_resized = $target_dir.self::resized;
   
        $target_dir_real = $target_dir.self::real;
        
        $message ="images supprimées";
        
        try{
        if(file_exists($target_dir_real.$name)){
            
             if (!unlink ($target_dir_real.$name)){
                 
                      throw new ErrorException("Unable to delete the real image ".$name);
                   }
            
        }
        
          if(file_exists($target_dir_resized.$name)){
            
             if (!unlink ($target_dir_resized.$name)){
                      throw new ErrorException("Unable to delete the resized image ".$name);
                   }
            
        }
        
        }catch(ErrorException $ex){
            
            $message ="un problème est survenu lors de la suppression des images";
        }
        
        
        return array( 'message' => $message , 'file' => $name) ;
        
    }
    
      
    /**
     * @param type $path
     */
    public static function SaveImage($name = "",$newidth,$newheight) {
        
       
       
        $target_dir = getcwd().DIRECTORY_SEPARATOR.Config::getInstance()->get('file_directory');
    
     
        $target_dir_resized = $target_dir.self::resized;
   
        $target_dir_real = $target_dir.self::real;
 
        $message = "";
     
        if(!isset($_FILES[$name])){
            
            return array( 'message' => "Image not uploaded" , 'file' => false) ;
        }
        
        $basename = uniqid() . basename($_FILES[$name]["name"]);
          
        $uploadOk = 1;
        $imageFileType = pathinfo($basename, PATHINFO_EXTENSION);
        
        
        $check = getimagesize($_FILES[$name]["tmp_name"]);
        
        if ($check !== false) {
            $message .= " File is an image - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            $message .= "File is not an image.";
            return array( 'message' => $message , 'file' => false) ;
        }
        
        // Check if file already exists
        if (file_exists($target_dir.$basename)) {
            
           
            $message .= "Sorry, file already exists.";
            return array( 'message' => $message , 'file' => false) ;
          
        }
        // Check file size
        if ($_FILES[$name]["size"] > 500000) {
            $message .= "Sorry, your file is too large.";
            return array( 'message' => $message , 'file' => false) ;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return array( 'message' => $message , 'file' => false) ;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message .= "Sorry, your file was not uploaded.";
            return array( 'message' => $message , 'file' => false) ;
            
            
            // if everything is ok, try to upload file
        } else {
            
            
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_dir_real.$basename)) {
                
                 $message .= "The file " . $basename . " has been uploaded ";
               // if we want a  resized copy of the image 
              if($newidth > 0 && $newheight > 0){
                  
                 $dst = ImageUtil::resizeImage($target_dir_real.$basename,$newidth,$newheight);
                 // if fail try to delete real image
                 if(!imagepng($dst,$target_dir_resized.$basename)){
                     
                      if (!unlink ($target_dir_real.$basename)){
                          throw new ErrorException("Unable to delete the real image after image resize operation failed.");
                      }
                 }
                  
              }
                
               
       
            } else {
                $message .= "Sorry, there was an error uploading your file.";
                return array( 'message' => $message , 'file' => $basename) ;
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
        return array( 'message' => $message , 'file' => $basename) ;
    }
    
    public static function GetFilePath($file_name){
        return getcwd().DIRECTORY_SEPARATOR.Config::getInstance()->get('file_directory').$file_name;
    }
            
     public static function GetFilePathForFront($file_name){
         
         
        return Config::getInstance()->get('file_directory').$file_name;
        
        
    }
    
    public static function isRequestHasFile($inputName = ""){
        if($_FILES[$inputName]['name'] !== ""){
            return true;
        }
        return false;
    }
    
    public static function removeExtension($file_name){
        
        
        return substr($file_name,0,strrpos("."));
        
    }
    
    public static function getExtension($file_name){
        
        return substr($file_name,strrpos($file_name,".")+1,strlen($file_name));
    }

}
