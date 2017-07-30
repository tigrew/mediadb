  <div class="row">
   
    <div class="col-xs-12 col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <h2><?= $data->artist['nickname'] ?> ' s biography</h2>
            </div>
          
        </div>  
        <?= $data->artist['biography'] ?> 
    </div>
      
    <div class="col-xs-12 col-sm-5">
           
          
        <img class="img-responsive" src ="<?= !empty($data->artist['picture']) ? ImageUtil::getImage($data->artist['picture'],true) :  ImageUtil::getDefaultImage("artist",false)?>" />
        
        <div class="jumbotron">
         
            <label>nom réel:</label> 
            <label><?=$data->artist['surname']. " " .$data->artist['name'] ?></label>
            <label>Birth on <?php $date = new DateTime($data->artist['birthdate']);
                                          echo $date->format("d/m/Y");?> 
                   in <?=$data->artist['birthplace']?> </label> 
            </br>
            <a href="<?=$data->artist['website']?>" target="_blank">Site web </a>
            
            
        
       
        </div>
      
   
  </div>
      
       <div class="col-xs-12">
           
       <?php  if(Engine::isLoggedUserWithId($data->artist['User_id'])) : ?>
       <form class="form form-inline" method="post" action="/mediadb/index.php?id=<?= $data->artist['id']?>&controller=ArtistDetail&action=edit">
       <div class ="form-group">
         <input type="submit" name="submit" class="form-control" value="Edit">
       </div>
       </form>
        <?php  endif; ?>
       </div>
 
  </div>