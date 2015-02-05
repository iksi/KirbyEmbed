<div class="<?php echo $class ?> js-embed">
    <a class="<?php echo $class ?>-link" href="<?php echo $url ?>" rel="external">
        <?php if ($image !== false): ?>
        <img class="<?php echo $class ?>-image" src="<?php echo $image ?>" alt="<?php echo $text ?>">
        <?php else: ?>
        <span class="<?php echo $class ?>-text"><?php echo $text ?></span>
        <?php endif ?>
    </a>
</div>
