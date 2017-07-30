<div class="row">
    <form class="form" method="post" action="/mediadb/index.php?id=<?= $request['id']?>&controller=Album&action=edit">
        <h3>Album</h3>    
        <div class="col-md-4">

            <?php if (isset($request['id'])): ?>
                <input type="hidden" name="id" value="<?= $request['id'] ?>">
            <?php endif; ?>

            <div class="form-group ">
                <label class="control-label requiredField" for="title">
                    Title
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <div class="input-group">
                    <div class="input-group-addon">
                        Album title
                    </div>
                    <input class="form-control" value="<?= ($data->album['title']) ? $data->album['title'] : ''; ?>" id="title" name="title" placeholder="Title" type="text"/>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="date">
                    Date
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input class="form-control" id="date" value="<?= ($data->album['releasedate']) ? $data->album['releasedate'] : ''; ?>" name="releasedate" placeholder="DD/MM/YYYY" type="date"/>
            </div>
            <div class="form-group ">
                <label class="control-label " for="text">
                    Number of songs
                </label>
                <input class="form-control" id="text" value="<?= ($data->album['numbersong']) ? $data->album['numbersong'] : ''; ?>" name="numbersong" placeholder="For example : 1 - 10" type="number"/>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="number">
                    Stock
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input class="form-control" value="<?= ($data->album['stock']) ? $data->album['stock'] : ''; ?>" id="number" name="stock" type="number"/>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="price">
                    Price
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input class="form-control" value="<?= ($data->album['price']) ? $data->album['price'] : ''; ?>" id="price" name="price" placeholder="€" type="number"/>
            </div>

        </div>
        <div class="col-md-3">


            <div class="form-group ">

                <label class="control-label requiredField" for="price">
                    Cover 

                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <div class="input-group-addon">
                    <img src="public/<?= ($data->album['cover']) ? $data->album['cover'] : ''; ?>"  class="img-thumbnail"   width="200" height="150"> 
                </div>
                       
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"> Categories</div>
                <div class="panel-body"> 
                <select id="categories" name="categories[]" multiple>
                    <?php foreach($data->categories as $key =>  $c): ?>
                        <?php $equals = false;?>
                        <?php foreach($data->selectedCategories as $key =>  $sc):?>
                            <?php if($sc['Category_id'] === $c['id']): ?>
                                <?php $equals = true;?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <option <?= ($equals === true )? 'selected="selected"': '' ?>value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                    <?php endforeach; ?>
                </select></div>
            </div>
        </div>
       
        <div class="col-md-5">
            <h4>Song list</h4>
            <table class="table">
                <tr>
                    <th>Title</th>
                    <th>Duration</th>
                </tr>
                <?php foreach($data->songs as $s):?>
                 <tr>
                    <td><?= $s['title']?></td>
                    <td><?= $s['duration']?></td>
                </tr> 
                <?php endforeach;?>
            </table>
            <a class="btn btn-default" href="/mediadb/index.php?id=<?= $request['id']?>&controller=Bag&action=addBasket">Add to Basket</a>
        </div>
         </form>
</div>



  </div>
</div>

<script type="text/javascript">
    
$(document).ready(function(){
    $(".form :input").attr("disabled", true);
});
</script>


