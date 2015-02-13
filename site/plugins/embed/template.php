<div class="<?php echo $class ?> js-embed">
    <a class="<?php echo $class ?>-link" href="<?php echo $url ?>" rel="external">
        <?php if ($poster): ?>
        <img class="<?php echo $class ?>-poster" src="<?php echo $poster ?>" alt="<?php echo $alt ?>">
        <?php else: ?>
        <span class="<?php echo $class ?>-alt"><?php echo $alt ?></span>
        <?php endif ?>
    </a>
</div>
