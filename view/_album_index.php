<div class="row">
    <div class="col-md-12">
        <h3> Albums </h3>



        <table  class="table table-responsive table-bordered">
            <thead>
                <tr>
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
                            <td><?= $bagline['title'] ?></td>
                            <td><?= $bagline['releasedate'] ?></td>
                            <td><?= $bagline['numbersong'] ?></td>
                            <td><?= $bagline['nickname'] ?></td>
                            <td><?= $bagline['price'] ?></td>
                            <td>
                                <?php if(Engine::isAuthorized("Album", "view")): ?>
                                <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline['id'] ?>&controller=Album&action=view"><span class="glyphicon glyphicon-search"></span></a>
                                <?php endif; ?>    
                                <?php if(Engine::isAuthorized("Album", "remove")): ?> 
                                    <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline['id'] ?>&controller=Album&action=remove"><span class="glyphicon glyphicon-remove-sign"></span></a>
                                <?php endif; ?>
                                
                                <?php if(Engine::isAuthorized("Album", "edit")): ?>
                                    <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline['id'] ?>&controller=Album&action=edit"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php endif; ?> 
                                    
                                <?php if(Engine::isAuthorized("Album", "addBasket")): ?> 
                                    <a class="btn btn-default" href="/mediadb/index.php?id=<?= $bagline['id'] ?>&controller=Album&action=addBasket"><span class="glyphicon glyphicon-download-alt"></span></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>