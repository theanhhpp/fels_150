<div class="container">
    <h2><?= lang('title_categories'); ?></h2>
    <div class="row">
        <div class ="col-sm-4">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= lang('number'); ?></th>
                            <th><?= lang('category_name'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    if(isset($list_category) && count($list_category)) {
                        foreach ($list_category as $key => $value) { ?>
                            <tr>
                                <td><?= $i; ?></a></td>
                                <td><a href = "category/show/<?= $value['id'];?>"> <?php echo $value['name'];?></a></td>
                            </tr>
                            <?php $i ++;
                        }
                    } else {
                       echo '<tr><td colspan="3">' .lang('no_data_message'). ' </td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>  
            <div>
                <?php echo isset($list_pagination) ? $list_pagination : ''; ?>    
            </div>
        </div>
    </div>
</div>
