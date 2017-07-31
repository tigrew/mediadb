<table class = "table table-striped table-hover">
    
    <th>Picture</th>
    <th>Nickname</th>
    <th>Action</th>
    


<?php foreach ($data->artists as $artist): ?>
    
   
     <tr>
     <td> <img src ="<?= !empty($artist['picture']) ? ImageUtil::getImage($artist['picture'],true) :  ImageUtil::getDefaultImage("artist",true)?>" /></td>
     <td><?= $artist['nickname'] ?></td>
     <td> <a href="/mediadb/index.php?id=<?= $artist['id'] ?>&controller=ArtistDetail&action=biography">Biographie</a>
     <?php if(Engine::isAuthorized("Artist", "delete")): ?> 
     <a href="/mediadb/index.php?id=<?= $artist['id'] ?>&controller=Artist&action=delete&offset=<?=$_GET['offset'] ?>&limit=25">Supprimer</a></td>
     <?php endif; ?>
     </tr>    
<?php endforeach; ?>
     
</table>

 <ul class="pagination">
  <?php 
 
  for($i=0 ;$i < $this->data->numberpage;$i++) :
      $active ="";
      
  if(($i) === intval($_GET['offset'])){ 
      $active = 'class = "active"';
  }    
  ?>    
      <li <?=$active?>><a href="/mediadb/index.php?controller=Artist&action=show&offset=<?= $i ?>&limit=25"><?= $i+1 ?></a></li>  
  <?php 
  endfor; ?>   
   
  </ul>