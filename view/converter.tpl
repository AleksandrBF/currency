<?php if (!empty($msg)): ?>
<div class="alert alert-<?php if($msg['success']): ?>success<?php else: ?>warning<?php endif; ?> alert-dismissible fade show" role="alert">
    <?=$msg['text']?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?php endif; ?>

<form class="form-inline" action="/" method="post">
    <div class="form-group">
        <input type="number" class="form-control" id="inputQuantity" name="quantity" placeholder="Количество"/>
    </div>
    <div class="form-group">
        <select class="form-control" id="inputFrom" name="currencyFrom">
            <?php foreach ($currencies as $k=>$v): ?>
            <option value="<?=$k?>"><?=$v?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
    </div>
    <div class="form-group">
        <select class="form-control" id="inputTo" name="currencyTo">
            <?php foreach ($currencies as $k=>$v): ?>
            <option value="<?=$k?>"><?=$v?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success form-control" name="submit">Конвертировать</button>
</form>

<?php if(isset($result)): ?>
<div class="alert alert-primary" role="alert">
    <?=$result['quantity']?> <?=$result['from']?> = <?=$result['sum']?> <?=$result['to']?>
</div>
<?php endif; ?>