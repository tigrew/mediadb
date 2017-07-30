<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ImageUtil {
    
    /*
     * 
     * return the default image path if image does not exist
     * 
     * @$entity : string litteral of the entity (artist,album,user....)
     * @$resized : boolean indicate the function should return the resized image
     */
    public static function getDefaultImage($entity,$resized){
        
        
      
            
         if($resized){
              
           return FileManager::GetFilePathForFront("images/resized/".$entity ."_default.jpg");
           
          }else{
              
             return FileManager::GetFilePathForFront("images/default/".$entity ."_default.jpg");
          }
                
        }
        
             
        public static function getImage($imgpath,$resized) {
        
         if(!empty($imgpath)){
             
         try{
             
            if($resized){
              
              return FileManager::GetFilePathForFront("images/resized/".$imgpath);
           
              }else{
              
              return FileManager::GetFilePathForFront("images/real/".$imgpath);
              }
          
          }catch(ErrorException $ex){
              
            throw new ErrorException("the image does not exist in the file system.".$ex->getMessage());
         }
             
        }else {
            
            throw new ErrorException("the image path can't be empty .");
        }
      
        }
        
        
        public static function resizeImage($imagepath,$newWith,$newHeight){
         
            $ext = FileManager::getExtension($imagepath);
         
            $image = null;
            switch ($ext){
                
                case "jpg" : $image = imagecreatefromjpeg($imagepath);break;
                case "jpeg" : $image = imagecreatefromjpeg($imagepath);break;
                case "png" : $image = imagecreatefrompng($imagepath);break;

                
            }
            
            if(is_null($image)){
                
                throw new ErrorException("could not create the image check extension");
            }
            
           $dimension = getimagesize($imagepath);
          
           $dst = imagecreatetruecolor($newWith, $newHeight);
           imagecopyresampled($dst, $image, 0, 0, 0, 0, $newWith, $newHeight, $dimension[0], $dimension[1]);
           return $dst;
        }
     
   }
    
    
 
    
