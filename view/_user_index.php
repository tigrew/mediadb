<?php 

$nickname =  '<div class="form-group"><input type="text" name="nickname" class="form-control nickname" placeholder="nickname" value=""></div>';


?>

<div class="row">
    <div class="col-md-12">
        <h3>User Search</h3>
        <div class="col-md-6">
            <form class="form form-inline" method="post" action="/mediadb/index.php?controller=User&action=search">

                <div class="form-group">
                    <label>Search By Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="form-control" value="Search">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form class="form form-inline" method="post" action="/mediadb/index.php?controller=User&action=search">

                <div class="form-group">
                    <label>Search By Role</label>   
                    <select name="role">
                        <?php foreach ($data->roles as $role): ?>
                            <option value="<?= $role['id'] ?>"> <?= $role['roleName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-control" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <h3>User list</h3>
        <table class="table table-responsive table-bordered ">
            <tr>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data->users as $user): ?>
                <tr>
                    <td><?= $user['mail'] ?></td>
                    <td><a href="/mediadb/index.php?id=<?= $user['id'] ?>&controller=User&action=edit">Edit</a>
                        <a href="/mediadb/index.php?id=<?= $user['id'] ?>&controller=User&action=delete">Delete</a></td>
                </tr>    
            <?php endforeach; ?>
        </table>
    </div>
    <div class="col-md-12">
        <h3>User Add</h3>
        <form class="form form-inline" method="post" action="/mediadb/index.php?controller=User&action=add">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <select class="role" name="role">
                    <?php foreach ($data->roles as $role): ?>
                        <option value="<?= $role['id'] ?>"> <?= $role['roleName'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="form-control" value="Add">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.role').change(function(){
            if($(this).val() == '<?=UserDb::_Artist?>'){
                $(this).parent().append('<?=$nickname?>');
            }else{
                $('.nickname').remove();
            }
        });
    });
</script>