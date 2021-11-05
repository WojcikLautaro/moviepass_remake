<button type="button" class="<?php echo $buttonClass; ?>" data-bs-toggle="modal" data-bs-target="#<?php echo $modalId; ?>"><?php echo $buttonInner; ?></button>

<!-- Modal -->
<div class="modal" id="<?php echo $modalId; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php if (isset($modalHeader)) { ?>
                    <?php echo $modalHeader; ?>
                <?php } else if (isset($modalTitle)) { ?>
                    <h5 class="modal-title"><?php echo $modalTitle; ?></h5>
                <?php } ?>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php if (isset($modalBody)) { ?>
                <div class="modal-body">
                    <?php echo $modalBody; ?>
                </div>
            <?php } ?>

            <?php if (isset($modalFooter)) { ?>
                <div class="modal-footer">
                    <?php echo $modalFooter; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>