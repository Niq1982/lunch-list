<?php
$days = [
    'monday' => 'Maanantai',
    'tuesday' => 'Tiistai',
    'wednesday' => 'Keskiviikko',
    'thursday' => 'Torstai',
    'friday' => 'Perjantai',
    'saturday' => 'Lauantai',
    'sunday' => 'Sunnuntai',
];

$lunchList = \LunchList\LunchList::getThisWeeksLunchList();

?>
<h2>Viikon <?php echo esc_html($lunchList->title); ?> lounaslista</h2>


<?php foreach ($days as $day => $title) : ?>
    <h3><?php echo esc_html($title); ?></h3>
    <?php echo wp_kses_post($lunchList->$day); ?>
<?php endforeach; ?>