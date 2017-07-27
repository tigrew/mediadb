<table class = "table table-striped table-hover">
    
    <th>Picture</th>
    <th>Nickname</th>
    <th>Action</th>
    


<?php foreach ($data->artists as $artist): ?>
     <tr>
     <td>TODO PICTURE</td>
     <td><?= $artist['nickname'] ?></td>
     <td> <a href="/mediadb/index.php?id=<?= $artist['id'] ?>&controller=Artist&action=biography">Biographie</a></td>
     </tr>    
<?php endforeach; ?>

</table>