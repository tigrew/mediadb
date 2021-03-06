<div class="row">
    <div class="col-md-12">
        <h3> Albums </h3>



        <table  class="table table-responsive">
            <thead>
                <tr>
                    <th>cover</th>
                    <th>Title</th>
                    <th>Release Date</th>
                    <th>Number of songs</th>
                    <th>Artist</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($data->albums as $bagline): ?>
                        <tr>
                            <td><img src="<?= ($bagline['cover'])? ImageUtil::getImage($bagline['cover']):'' ; ?>"  class="img-thumbnail zoom"   width="100" height="75"> </td>
                            <td><?= $bagline['title'] ?></td>
                            <td><?= $bagline['releasedate'] ?></td>
                            <td><?= $bagline['numbersong'] ?></td>
                            <td><?= $bagline['nickname'] ?></td>
                            <td><?= $bagline['price'] ?></td>
                            <td>
                                <?php if(Engine::isAuthorized("Album", "view")): ?>
                                <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline[0] ?>&controller=Album&action=view"><span class="glyphicon glyphicon-search"></span></a>
                                <?php endif; ?>
                                
                                <?php if(Engine::isAuthorized("Album", "edit") && IsArtistAlbum::Helper($bagline[0])) : ?>
                                    <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline[0] ?>&controller=Album&action=edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline[0] ?>&controller=Album&action=remove"><span class="glyphicon glyphicon-remove"></span></a>
                                <?php endif; ?> 
                             
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>