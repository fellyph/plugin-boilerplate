<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://blog.fellyph.com.br
 * @since      1.0.0
 *
 * @package    Fellyph_Test
 * @subpackage Fellyph_Test/Admin/views
 */

?>

<!-- Adding bootstrap to speed up the UI development. -->

<div class="jumbotron-fluid jumbotron">
	<section class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="display-4"><?php esc_html_e( 'First view', 'fellyph-test' ); ?></h1>
					<p class="lead"><?php esc_html_e( 'Adding the information to be listed at the users profile page', 'fellyph-test' ); ?></p>
					<form method="POST" action="options.php">
					<?php
						settings_fields( 'fellyph-test-keywords' );
						do_settings_sections( 'fellyph-test-keywords' );
					?>
						<div class="form-group">
							<label for="keywordInput"><?php esc_html_e( 'Keyword', 'fellyph-test' ); ?></label>
							<input type="text" class="form-control"
								id="keywordInput"
								name="user_keyword"
								value="<?php echo esc_attr( get_option( 'user_keyword' ) ); ?>"
								aria-describedby="keywordHelp"
								placeholder="<?php esc_html_e( 'Enter the keyword', 'fellyph-test' ); ?>">
							<small id="keywordHelp" class="form-text text-muted"><?php esc_html_e( 'Add a keyword to the users', 'fellyph-test' ); ?></small>
						</div>
						<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Submit', 'fellyph-test' ); ?></button>
					</form>
				</div>
			</div>
	</section>
</div>

<section class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="display-4"><?php esc_html_e( 'List of keywords', 'fellyph-test' ); ?></h1>
			<p class="lead">
				<?php esc_html_e( 'Adding the information to be listed at the users profile page', 'fellyph-test' ); ?>
			</p>
			<?php
			$user_keywords = get_option( 'user_keyword_list' );
			if ( is_array( $user_keywords ) ) :
				?>

				<ul class="list-group list-group-flush">
					<?php
					foreach ( $user_keywords as $user_keyword ) :
						?>
							<li class="list-group-item">
								<?php echoesc_html( $user_keyword ); ?>
							</li>
					<?php endforeach; ?>

					</ul>
			<?php	endif; ?>
		</div>
	</div>
</section>
