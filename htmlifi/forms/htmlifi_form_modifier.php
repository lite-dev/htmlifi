<?php
echo "<select id=\"mod\">
	<option value=\"merge\">Merge</option>
	<option value=\"delete\">Delete</option>
	<option value=\"create\">Create</option>
</select>";

submit_button( 'Go', 'secondary', 'moderate', false );
?>