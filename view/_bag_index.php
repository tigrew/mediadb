<div class="row">
    <div class="col-md-12">
        <h3> My Album Basket </h3>



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
                <?php $empty = true; ?>
                <?php foreach ($data->BagLines as $bagline): ?>
                        <?php if ($bagline['id'] !== null) : ?>
                        <tr>
                            <td><?= $bagline['title'] ?></td>
                            <td><?= $bagline['releasedate'] ?></td>
                            <td><?= $bagline['numbersong'] ?></td>
                            <td><?= $bagline['nickname'] ?></td>
                            <td><?= $bagline['price'] ?></td>
                            <td>
                                <a href="/mediadb/index.php?id=<?= $bagline['Album_id'] ?>&controller=Bag&action=remove">Remove</a>
                            </td>
                        </tr>
                        <?php $empty = false; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($empty === true) : ?>
                     <?= $data->emptyResultMessage; ?>
                <?php endif; ?> 
            </tbody>
        </table>


    </div>
    <div class="col-md-12">
        <h3>Process My Basket</h3>
        <a class="btn btn-default" href="/mediadb/index.php?id=<?= $data->bag['id'] ?>&controller=Bag&action=process">Process</a>
    </div>
</div>