<?php
$lunchList = \LunchList\LunchList::getThisWeeksLunchList();
?>

<h2>Viikon <?php echo esc_html($lunchList->title); ?> lounaslista</h2>

<?php foreach ($lunchList->days as $day) : ?>
    <h3><?php echo esc_html(ucfirst($day->formattedDate('l d.m.Y'))); ?></h3>
    <?php echo wp_kses_post($day->menu); ?>
<?php endforeach; ?>