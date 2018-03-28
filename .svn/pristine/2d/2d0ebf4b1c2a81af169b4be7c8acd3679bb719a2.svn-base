<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><strong>搜索结果：<font color="#ff0000"><?php echo CHtml::encode($keyword);?></font></strong></h4>
</div>
<div class="modal-body">
    <ul class="list-group">

        <?php foreach($data as $row):?>
        <a class="list-group-item" href="/operation/test/CreateImport?postid=<?php echo $postid;?>&templateid=<?php echo $row['id']?>">
            <span class="badge">选择</span>
            <?php echo CHtml::encode($row['name']);?>
        </a>
        <?php endforeach;?>

    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
</div>