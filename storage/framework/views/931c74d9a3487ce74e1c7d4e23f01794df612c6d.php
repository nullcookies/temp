<?php
// config
$link_limit = 15; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

<?php if($paginator->lastPage() > 1): ?>
    <ul class="pagination">
        <li class="page-item<?php echo e(($paginator->currentPage() == 1) ? ' disabled' : ''); ?>">
            <a href="<?php echo e($paginator->url(1)); ?>" class="page-link"><span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span></a>
         </li>
        <?php for($i = 1; $i <= $paginator->lastPage(); $i++): ?>
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            <?php if($from < $i && $i < $to): ?>
                <li class="page-item<?php echo e(($paginator->currentPage() == $i) ? ' active' : ''); ?>">
                    <a href="<?php echo e($paginator->url($i)); ?>" class="page-link"><?php echo e($i); ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <li class="page-item<?php echo e(($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : ''); ?>">
            <a href="<?php echo e($paginator->url($paginator->lastPage())); ?>" class="page-link"><span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span></a>
        </li>
    </ul>
<?php endif; ?>