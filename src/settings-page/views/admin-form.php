<div class="wrap cmb2-options-page <?php echo $this->option_name; ?>">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php cmb2_metabox_form( $this->metabox_id, $this->option_name ); ?>
</div>