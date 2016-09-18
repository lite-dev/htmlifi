<?php

echo "<form class=\"post_init\" method=\"post\" action=\"\">
	<input name=\"action\" type=\"hidden\" value=\"post_init\" />
	<div class=\"htmlifi_post_editor\">
		<div class=\"htmlifi_page_content\">
			<input class=\"page_selector\" type=\"checkbox\" />";
			if( $screen->base == 'htmlifi/admin/htmlifi_editor' ) :
				echo "<input name=\"ID[]\" type=\"hidden\" value=\"$post_id\" />";
			endif;
			echo "<input name=\"title[]\" type=\"text\" value=\"$post_title\" />
			<textarea name=\"content[]\">$post_content</textarea>
		</div>";
?>