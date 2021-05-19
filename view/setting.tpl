<?php if (!empty($msg)): ?>
<div class="alert alert-<?php if($msg['success']): ?>success<?php else: ?>warning<?php endif; ?> alert-dismissible fade show" role="alert">
    <?=$msg['text']?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?php endif; ?>

<form action="/setting" method="post">
    <div class="form-row">
        <div class="form-group">
            <label for="itemPage">Количество записей истории на странице:</label>
            <input type="number" class="form-control" id="itemPage" name="itemPage" value="<?=$itemPage?>" placeholder="Количество"/>
        </div>
    </div>
    <div class="form-row mb-3">
        <?php foreach ($allCurrency as $currency): ?>
        <div class="form-check form-check-inline col-5">
            <input class="form-check-input" type="checkbox" id="currency<?=$currency['cc']?>" name="currencies[<?=$currency['cc']?>]" value="<?=$currency['txt']?>" <?php if(array_key_exists( $currency['cc'], $selectedCurrency )): ?>checked<?php endif; ?>>
            <label class="form-check-label" for="currency<?=$currency['cc']?>"><?=$currency['txt']?></label>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="form-row">
        <button type="submit" class="btn btn-success" name="submit">Сохранить</button>
    </div>
</form>