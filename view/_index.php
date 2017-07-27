<div class="row">
    <div class="col-md-12">
        <h3> Albums </h3>
        
        
        <?php if(!empty($data->BagLines)): ?>
        <?php var_dump($data->BagLines); ?>
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
               <?php foreach($data->BagLines as $bagline):?>
                <tr>
                    <td><?= $bagline['title']?></td>
                    <td><?= $bagline['releasedate']?></td>
                    <td><?= $bagline['numbersong']?></td>
                    <td><?= $bagline['nickname']?></td>
                    <td><?= $bagline['price']?></td>
                    <td>
                        <a href="/mediadb/index.php?id=<?= $bagline['Album_id']?>&controller=Bag&action=remove">Remove</a>
                    </td>
                </tr>
               <?php endforeach;?>
            </tbody>
        </table>
        <?php endif;?>
        
        
        
        
        
    </div>
</div>