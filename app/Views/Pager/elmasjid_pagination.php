<?php
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination pagination-lg m-0">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item disabled">
                <a class="page-link rounded-0" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                    <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach; ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link rounded-0" href="<?= $pager->getNext() ?>" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>