<?php if (!empty($msg)): ?>
<div class="alert alert-<?php if($msg['success']): ?>success<?php else: ?>warning<?php endif; ?> alert-dismissible fade show" role="alert">
    <?=$msg['text']?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?php endif; ?>

<?php if(isset($queries)): ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Запрос</th>
        <th scope="col">Дата</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($queries as $query): ?>
        <tr>
            <td><?=$query['result']?></td>
            <td><?=$query['date']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>