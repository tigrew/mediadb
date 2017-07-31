<style>


  
  
</style>

<div class="row">
    <form class="form" method="post" enctype="multipart/form-data" action="/mediadb/index.php?<?= (isset($request['id']))?'id='.$request['id'].'&' : ''?>controller=Album&action=edit">
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
                    <input required class="form-control" value="<?= ($data->album['title']) ? $data->album['title'] : ''; ?>" id="title" name="title" placeholder="Title" type="text"/>
                </div>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="date">
                    Date
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input required class="form-control" id="date" value="<?= ($data->album['releasedate']) ? $data->album['releasedate'] : ''; ?>" name="releasedate" placeholder="DD/MM/YYYY" type="date"/>
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
                <input required class="form-control" value="<?= ($data->album['stock']) ? $data->album['stock'] : ''; ?>" id="number" name="stock" type="number"/>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="price">
                    Price
                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <input required class="form-control" value="<?= ($data->album['price']) ? $data->album['price'] : ''; ?>" id="price" name="price" placeholder="€" type="number"/>
            </div>

            <div class="form-group">
                <div>
                    <button class="btn btn-primary right" value="Add_Album" name="submit" type="submit">
                        Submit
                    </button>
                </div>
            </div>


        </div>
        <div class="col-md-3">


            <div class="form-group ">

                <label class="control-label requiredField" for="price">
                    Cover Upload

                    <span class="asteriskField">
                        *
                    </span>
                </label>
                <div class="input-group-addon">
                    <img src="<?= ($data->album['cover']) ? ImageUtil::getImage($data->album['cover'], false) : ''; ?>"  class="img-thumbnail grayscale"   width="200" height="150"> 
                </div>
                <input type="file" name="cover" id="fileToUpload">            
            </div>
            <?php if (isset($request['id'])): ?>
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
            <?php endif;?>
        </div>
        </form>
        <?php if (isset($request['id'])): ?>
        <div class="col-md-5">
            <h4>Song list</h4>
            <table class="table">
                <tr>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Action</th>
                </tr>
                <?php foreach($data->songs as $s):?>
                 <tr>
                    <td><?= $s['title']?></td>
                    <td><?= $s['duration']?></td>
                    <td><a class ="btn btn-primary" href="/mediadb/index.php?album_id=<?= $request['id']?>&id=<?=$s['idsong']?>&controller=Album&action=removeSong"><span class="glyphicon glyphicon-minus"></span></a></td>
                </tr> 
                <?php endforeach;?>
            </table>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Add a new song to album
            </button>
        </div>
    <?php endif; ?>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new song</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form form-inline" method="POST" action="/mediadb/index.php?id=<?= $request['id']?>&controller=Album&action=addSong">
            <div class="modal-body">
                <div class="form-group ">
                    <div class="input-group">
                        <div class="input-group-addon">
                            Title
                        </div>
                        <input class="form-control" id="title" name="title" placeholder="Title" type="text"/>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group">
                        <div class="input-group-addon">
                            Duration
                        </div>
                        <input class="form-control"  id="duration" name="duration" placeholder="Duration" type="number"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Add" name="Add" />
            </div>
        </form>
    </div>
  </div>
</div>
