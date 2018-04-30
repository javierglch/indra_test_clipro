<?php if (count($aData) > 0): ?>
    <table class="table datatable">
        <thead>
            <tr>
                <?php foreach (current($aData) as $key => $value): ?>
                    <th><?= $key ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aData as $row): ?>
                <tr>
                    <?php foreach ($row as $key => $value): ?>
                        <td><?= $value ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <?= alert_html('No hay datos', 'info mt-4') ?>
<?php endif; ?>