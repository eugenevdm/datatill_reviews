<div class="wrap">
    <h2>DataTill Reviews</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('datatill_reviews-group'); ?>
        <?php @do_settings_fields('datatill_reviews-group'); ?>
        <?php do_settings_sections('datatill_reviews'); ?>
        <?php @submit_button(); ?>
    </form>
</div>