<div class="container">
    <h2 class=""><?= lang('title_word'); ?></h2>
    <div class="row">
        <div class="col-sm-6" style="margin-bottom: 20px;">
            <form method="post" action="" class="form-inline">
                <div class="col-sm-5">
                    <select class="form-control" name="" onchange="showCustomer(this.value, 'word/filter')">
                        <option value="none"><?= lang('choose_catrgory')?></option>
                        <?php if (isset($list_categories) && count($list_categories)) {
                            foreach ($list_categories as $key => $value) { ?>
                                <option value="<?= $value['name']?>"><?= $value['name']?></option>        
                            <?php }              
                        } ?>
                    </select>
                </div>
                <div class="col-sm-7">
                    <input class="form-control" type="text" id="txt1" onkeyup="showCustomer(this.value, 'word/search')">
                    <button type="submit" class="btn btn-default"><?= lang('search'); ?></button>
                </div>
            </form> 
        </div>
        <form method="post" action="">
            <div class="col-sm-3">
                <label class="radio-inline">
                    <input type="radio" name="a" value="learned" onchange="showCustomer(this.value, 'word/filter')"> Learned
                </label>
                <label class="radio-inline">
                    <input type="radio" name="a" value="learn" onchange="showCustomer(this.value, 'word/filter')"> Learn
                </label>
            </div>
        </form>
    </div>    
    <div class = "row col-sm-5" id = "index">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?= lang('number'); ?></th>
                        <th><?= lang('word'); ?></th>
                        <th><?= lang('category'); ?></th>
                        <th><?= lang('learn'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($list_word) && count($list_word)) {
                        $i = 1;
                        foreach ($list_word as $key => $value) { ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><a href="word/show/<?= $value['word_id']; ?>"><?= $value['content']; ?></a></td>
                                <td><a href= "category/show/<?= $value['category_id'];?>"><?= $value['category_name']; ?></td>
                                <?php if($this->Learned_Word_Model->total(['word_id' => $value['word_id'],'user_id' => $this->authentication['id']]) == 0) { ?>
                                <td><a href="learned_word/learn/<?= $value['word_id']; ?>?redirect= <?= current_url(); ?>"><?= lang('unlearn'); ?></a></td>
                                <?php } else { ?>
                                <td><?= lang('learned'); ?></td>
                                <?php } ?>
                            </tr>
                            <?php $i ++; 
                        }
                    } else {
                        echo '<tr><td colspan="4">' . lang('no_data') . '</td></tr>';    
                    } ?>
                </tbody>
            </table>
        </div> 
        <div>
            <?= isset($list_pagination) ? $list_pagination : ''; ?>    
        </div>
    </div>	
</div>
