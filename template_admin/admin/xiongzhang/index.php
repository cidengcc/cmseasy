<form name="frm1" id="frm1" action="" method="post">
    <div class="form-group">
        <label for="appid">appid</label>
        <input class="form-control" name="appid" type="text" id="appid"
               value="<?php echo config::get('xiongzhang_appid'); ?>">
    </div>
    <div class="form-group">
        <label for="token">token</label>
        <input class="form-control" name="token" type="text" id="token"
               value="<?php echo config::get('xiongzhang_token'); ?>">
    </div>
    <div class="form-group">
        <label for="token">URLs</label>
        <textarea class="form-control" style="height: 400px;" id="urls" name="urls"><?php echo $urls; ?></textarea>
    </div>
    <div class="form-group">
        <input name="dosubmit" class="btn btn-primary" type="submit" value="推送到熊掌号"
               onclick="return confirm('确定要推送到熊掌号吗?')">
    </div>
</form>
