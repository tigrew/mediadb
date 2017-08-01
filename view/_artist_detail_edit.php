  


   <form class="form " method="post" enctype="multipart/form-data" action="/mediadb/index.php?id=<?= $data->artist['id']?>&controller=ArtistDetail&action=update">  
   <div class="row">
    <div class="col-xs-7 col-sm-7">
     
         <legend>
    
          <h2><input class = "form-control" style="width:50%;" type="text" name="nickname" value ="<?= $data->artist['nickname'] ?>"  />' s biography</h2>
    
         </legend>
      
        <textarea class="biography-edit"  name="biography"><?= $data->artist['biography'] ?> </textarea>
            
    </div>
      
    <div class="col-xs-5 col-sm-5">
           
       <div class="thumbnail">
        <img class="img-responsive" src ="<?= !empty($data->artist['picture']) ? ImageUtil::getImage($data->artist['picture'],true) :  ImageUtil::getDefaultImage("artist",false)?>" />
        <input class = "form-control" type ="file" name = "fileToUpload" value ="change your picture" />
        <?php if(!empty($data->artist['picture'])) : ?>
        <a href="/mediadb/index.php?id=<?= $data->artist['id']?>&controller=ArtistDetail&action=deleteImage">Supprimer l'image</a>
        <?php endif;?>
       </div>
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
 
      
      
       
   
    </div> 
       
     <div class ="row">   
      <div class="col-xs-12 col-sm-12">
        <div class="jumbotron">
           
            <table id ="awards-table" class = "table table-striped table-hover">
                  <th>Price</th>
                  <th>Win in</th>
                  <th>On</th>
                  <th>Action</th>
                
                
              <?php  foreach($data->awards as $key => $award) : ?>
             
                <tr>
                    <td><label class ="control-label award-name"><?=$award['name']?> </label></td>
                    <td><label class ="control-label award-place"><?= $award['place'] ?></label></td>
                    <td><label class ="control-label award-dateDelivery"><?= (new DateTime($award['dateDelivery']))->format("d-m-Y") ?></label></td> 
                    <td><a class="btn btn-primary" href="/mediadb/index.php?id=<?= $data->artist['id']?>&awardid=<?=$award['id']?>&controller=ArtistDetail&action=deleteAward#add-award">Delete</a></td>
                </tr>
                
               <?php endforeach; ?> 
              

            </table>  
            
            <button id="add-award" class="btn btn-primary" data-toggle="modal" data-target="#choseAwardModal" >Add</button>
            
        </div>
       </div>
      </div>
       
      <div class="col-xs-7">
     
       <div class ="form-group">
           <button type="submit" name="submit" class="btn btn-primary">Save</button>
       </div>
      
       </div>
       
  </form>

 <div class="modal awards-modal" id ="choseAwardModal" data-artistid = "<?=$data->artist['id']?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Choose an Award</h4>
      </div>
      <div class="modal-body">
  <div class="panel panel-default">
  <div class="panel-heading">Choose and edit informations about a new won award</div>
  <div class="panel-body">
      <label>Filter</label>
      <input id="filter-award" type ="text" name="filter-award" />
  </div>
  <div id="search-arwards">
  <table class="table table-striped table-hover" id="award-filtered-table">
      

    <th>Name</th> 
 
  
    <?php  foreach($data->awardsNotWon as $award) : ?>
    <tr class ="award-row" data-id="<?=$award['id']?>">
    <td><label class ="control-label"><?=$award['name']?></label></td>
    </tr>
  
    <?php endforeach; ?> 
    
</table>
  </div>
  </div>
      </div>
       <div id="editnewaward" class ="form-inline">
            
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="addaward-modal-ok" type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>


