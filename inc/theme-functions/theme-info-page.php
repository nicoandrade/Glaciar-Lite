<?php
add_action( 'admin_menu', 'quemalabs_getting_started_menu' );
function quemalabs_getting_started_menu() {
	add_theme_page( esc_attr__( 'Theme Info', 'glaciar-lite' ), esc_attr__( 'Theme Info', 'glaciar-lite' ), 'manage_options', 'glaciar_lite_theme-info', 'quemalabs_getting_started_page' );
}

/**
 * Theme Info Page
 */
function quemalabs_getting_started_page() {
	if ( ! current_user_can( 'manage_options' ) )  {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'glaciar-lite' ) );
	}
	echo '<div class="getting-started">';
	?>
	<div class="getting-started-header">
		<div class="header-wrap">
			<div class="theme-image">
				<span class="top-browser"><i></i><i></i><i></i></span>
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="">
			</div>
			<div class="theme-content">
				<div class="theme-content-wrap">
				<h4><?php esc_html_e( 'Getting Started', 'glaciar-lite' ); ?></h4>
				<h2 class="theme-name"><?php echo esc_html( GLACIAR_LITE_THEME_NAME ); ?> <span class="ver"><?php echo 'v' . esc_html( GLACIAR_LITE_THEME_VERSION ); ?></span></h2>
				<p><?php echo sprintf( esc_html__( 'Thanks for using %s, we appriciate that you create with our products.', 'glaciar-lite' ), esc_html( GLACIAR_LITE_THEME_NAME ) ); ?></p>
				<p><?php esc_html_e( 'Check the content below to get started with our theme.', 'glaciar-lite' ); ?></p>
				</div>

				<ul class="getting-started-menu">
					<?php
					if ( isset( $_GET['tab'] ) ){
						$tab = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
					}else{
						$tab = 'docs';
					}
					?>
					<li><a href="?page=glaciar_lite_theme-info&amp;tab=docs" class="<?php echo ( $tab == 'docs' ) ? ' active' : ''; ?>"><i class="fa fa-file-text-o"></i> <?php esc_html_e( 'Documentation', 'glaciar-lite' ); ?></a></li>
					<li><a href="https://www.quemalabs.com/theme/glaciar/" target="_blank"><i class="fa fa-star-o"></i> <?php esc_html_e( 'PRO Version', 'glaciar-lite' ); ?></a></li>
					<li><a href="https://www.quemalabs.com/" target="_blank" class="<?php echo ( $tab == 'more-themes' ) ? ' active' : ''; ?>"><i class="fa fa-wordpress"></i> <?php esc_html_e( 'More Themes', 'glaciar-lite' ); ?></a></li>
				</ul>

			</div><!-- .theme-content -->
		</div>
		<a href="https://www.quemalabs.com/" class="ql_logo" target="_blank"><img  src="<?php echo esc_url( get_template_directory_uri() ) . '/images/quemalabs.png'; ?>" alt="Quema Labs" /></a>
	</div><!-- .getting-started-header -->

	<div class="getting-started-content">

	<?php
	global $pagenow;
	global $updater;
	
	if ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && 'glaciar_lite_theme-info' == $_GET['page'] ){
		if ( isset( $_GET['tab'] ) ){
			$tab = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
		}else{
			$tab = 'docs';
		}

		switch ( $tab ){
			case 'docs' :
	?>

			<div class="theme-docuementation">
				<div class="help-msg-wrap">
					<div class="help-msg"><?php echo sprintf( esc_html__( 'You can find this documentation and more at our %1$sHelp Center%2$s.', 'glaciar-lite' ), '<a href="https://quemalabs.ticksy.com/articles/100007406/" target="_blank">', '</a>' ); ?></div>
				</div>

			</div><!-- .theme-docuementation -->
			<?php
	      	break;
     	}//switch
         ?>


	<?php }//if theme.php ?>

	</div><!-- .getting-started-content -->


	<?php
	echo '</div><!-- .getting-started -->';
}
?>