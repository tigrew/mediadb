<?php 

$nickname =  '<div class="form-group">
                <input type="text" name="nickname" class="form-control " placeholder="nickname" value="">
            </div>';


?>

<div class="row">
    <div class="col-md-12">
        <h3>User Edit</h3>
        <form class="form form-inline" method="post" action="/mediadb/index.php?id=<?= $data->user['id']?>&controller=User&action=edit">
            <div class="form-group">
                <input type="text" name="email" class="form-control " placeholder="Email" value="<?= $data->user['mail']?>">
            </div>
            <div class="form-group">
                <select class="role" name="role">
                    <?php foreach ($data->roles as $role): ?>
                        <?php if($data->user['Role_id'] === $role['id']):?>
                            <option selected="selected"value="<?= $role['id'] ?>"> <?= $role['roleName'] ?></option>
                        <?php else:?>
                            <option value="<?= $role['id'] ?>"> <?= $role['roleName'] ?></option>
                        <?php endif;?>
                    <?php endforeach; ?>
                </select>
            </div>
             <div class="form-group">
                 <input type="submit" name="submit" class="form-control" value="Edit">
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('role').change(function(){
            if($(this).val() === <?=UserDb::_Artist?>){
                $(this).append('<?=$nickname?>');
            }
        });
    });
</script>