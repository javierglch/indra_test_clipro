<!-- Modal <?= $modal_id ?> -->
<div class="modal fade" id="<?= $modal_id ?>" tabindex="-1" role="dialog" aria-labelledby="Modal_<?=$modal_id?>_Title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal_<?=$modal_id?>_Title"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= $body ?>
        </div>
    </div>
</div>