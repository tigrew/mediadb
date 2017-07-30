  

<div class="row">
   <form class="form " method="post" enctype="multipart/form-data" action="/mediadb/index.php?id=<?= $data->artist['id']?>&controller=ArtistDetail&action=update">  
    <div class="col-xs-12 col-sm-7">
        <div class="row">
            <legend>
             <input type="text" name="nickname" value ="<?= $data->artist['nickname'] ?>"  /> ' s biography
            </legend>
          
        </div>  
        
        
        <textarea class="biography-edit"  name="biography"><?= $data->artist['biography'] ?> </textarea>
       
       
    </div>
      
    <div class="col-xs-12 col-sm-5">
           
       
        <img class="img-responsive" src ="<?= !empty($data->artist['picture']) ? ImageUtil::getImage($data->artist['picture'],true) :  ImageUtil::getDefaultImage("artist",false)?>" />
        <input class = "form-control" type ="file" name = "fileToUpload" value ="change your picture" />
       
        <div class ="form-group">
       
        
        <div class="jumbotron">
           
            <label class = "control-label">Surname</label> 
            <input class = "form-control" type = "text" name ="surname" value ="<?=$data->artist['surname']?>" />
             <label class = "control-label">Name</label> 
            <input class = "form-control" type ="text" name="name" value ="<?=$data->artist['name'] ?>" />
           
            <label class ="control-label">Birth on </label>
            <input class ="form-control" type="date" name="birthdate" value="<?php echo $data->artist['birthdate'] ?>"/> 
            <label class="control-label" >in </label>
            <input class ="form-control" type ="text" name ="birthplace" value ="<?=$data->artist['birthplace']?>" /> 
            
            <label class = "control-label">Your website</label> 
            <input class ="form-control" type ="text" name ="website" value="<?=$data->artist['website']?>" />
            
            
        
       
        </div>
      
       </div>   
  </div>
      
       <div class="col-xs-7">
     
       <div class ="form-group">
         <input type="submit" name="submit" class="form-control" value="Save">
       </div>
      
       </div>
  </form>
  </div>