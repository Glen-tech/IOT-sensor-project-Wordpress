<?php /* Template Name: custom show data*/ ?>

<?php
	require_once('custom-classes/tables_sensors.php'); // check if file is included, if not it will included the file
	
	$object = new create_tables_sensors();
	$object->create_sensor_id();
	$object->create_sensor_data();
?>

<html>
	<body>
		
		<!--<div class= "latest-post">
			<script>
					const url = 'https://localhost/wordpress/wp-json/'; // was fun to try it out
					const postsContainer= document.querySelector('.latest-post')
					fetch(url)
					.then(response => response.json())
					.then(data => console.log(data));
					
			</script>
		</div>-->
		
		<?php 		
			global $wp_filesystem;
			
			if (empty($wp_filesystem)) {
						require_once (ABSPATH . '/wp-admin/includes/file.php');
						WP_Filesystem();
					}
			$raw_post_data =  $wp_filesystem->get_contents('php://input');
			
			if(!empty ($raw_post_data))
			{
				echo "Post detected";
				require_once('custom-classes/sensor_data_handeling.php'); // check if file is included, if not it will included the file
				$object = new handeling_data_from_sensors($data_from_post = "",$CO2 = "",$tVTOC ="",$humidity = "",$temperature = "",$light = "");
				$object->get_post_data_esp32($raw_post_data);
				$object->check_api_key();
				$object->seperate_json();
				$object->insert_data_table();
			}
		
		?>
		
	</body>
</html>