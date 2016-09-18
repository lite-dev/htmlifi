<?php
$htmlifi_dbname = HTMLIFI::$GLOBALS->customdb->dbname;
$screen = get_current_screen();

ob_start();

echo "
	<html>
		<body>
			<h1>"; echo esc_html( get_admin_page_title() ) . "</h1>
			<form style=\"margin:30px 0\" id=\"initial\" method=\"post\" action=\"register_db\">
				Database: <input name=\"htmlifi_dbname\" type=\"text\" value=\"$htmlifi_dbname\" />
				<input name=\"action\" type=\"hidden\" value=\"register_db\" />
			</form>
			<div id=\"form_data\"></div>";
			
			submit_button();
			
	  echo "</body>
	</html>
";

$output = ob_get_clean();
echo $output;
?>