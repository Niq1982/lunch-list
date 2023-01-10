<?php
$lunchList = \LunchList\LunchList::getThisWeeksLunchList();
?>

<h2>Viikon <?php echo esc_html($lunchList->title); ?> lounaslista</h2>

<?php foreach ($lunchList->days as $day => $content) : ?>
    <h3><?php echo esc_html(ucfirst(wp_date('l d.m.Y', $content['date']))); ?></h3>
    <?php echo wp_kses_post($content['menu']); ?>
<?php endforeach; ?>