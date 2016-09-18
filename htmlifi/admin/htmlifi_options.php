<?php 

$htmlifi_dbuser = HTMLIFI::$GLOBALS->customdb->dbuser;
$htmlifi_dbpass = HTMLIFI::$GLOBALS->customdb->dbpassword;
$htmlifi_dbhost = HTMLIFI::$GLOBALS->customdb->dbhost;
$htmlifi_dbname = HTMLIFI::$GLOBALS->customdb->dbname;

$htmlifi_pagination = get_option( 'htmlifi_pagination', 20 );

ob_start();

echo "
<html>
	<body>
		<h1>"; echo esc_html( get_admin_page_title() ) . "</h1>
		<form method=\"post\" action=\"\">
			<fieldset>
				<legend>Database Information</legend>
				<div><span>Username: </span><input name=\"htmlifi_dbuser\" type=\"text\" value=\"$htmlifi_dbuser\" /></div>
				<div><span>Password: </span><input name=\"htmlifi_dbpass\" type=\"password\" value=\"$htmlifi_dbpass\" /></div>
				<div><span>Hostname: </span><input name=\"htmlifi_dbhost\" type=\"text\" value=\"$htmlifi_dbhost\" /></div>
				<div><span>Database: </span><input name=\"htmlifi_dbname\" type=\"text\" value=\"$htmlifi_dbname\" /></div>
			</fieldset>
			<fieldset>
				<legend>Other Options</legend>
				<div>Number of Rows: <input name=\"htmlifi_pagination\" type=\"number\" value=\"$htmlifi_pagination\" /></div>
			</fieldset>";
			submit_button(); ?>
		</form>
	</body>
</html>

<?php
	$output = ob_get_clean();
	echo $output;
?>

<?php
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) :
		$htmlifi_dbuser = sanitize_text_field( $_POST['htmlifi_dbuser'] );
		$htmlifi_dbpass = sanitize_text_field( $_POST['htmlifi_dbpass'] );
		$htmlifi_dbhost = sanitize_text_field( $_POST['htmlifi_dbhost'] );
		$htmlifi_dbname = sanitize_text_field( $_POST['htmlifi_dbname'] );
		
		$htmlifi_pagination = sanitize_text_field( $_POST['htmlifi_pagination'] );

		update_option( 'htmlifi_dbuser', $htmlifi_dbuser );
		update_option( 'htmlifi_dbpass', $htmlifi_dbpass );
		update_option( 'htmlifi_dbhost', $htmlifi_dbhost );
		update_option( 'htmlifi_dbname', $htmlifi_dbname );
		
		update_option( 'htmlifi_pagination', $htmlifi_pagination );
	endif;
?>