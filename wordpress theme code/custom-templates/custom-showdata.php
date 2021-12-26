<?php /* Template Name: custom show data*/ ?>

<?php
global $session;
session_start();
echo $session;
?>

<?php
	require_once('custom-classes/tables_sensors.php'); // check if file is included, if not it will included the file
	
	$object = new create_tables_sensors();
	$object->create_sensor_id();
	$object->create_sensor_data();
?>

<html>

	<style>
	
	.styled-table {
    border-collapse: collapse;
    margin: auto;
    font-size: 0.9em;
    font-family: sans-serif;
    width: 80%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
	border: 1px;
	}
	
	.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: center;
	}
	
	.styled-table th,
	.styled-table td {
    padding: 12px 15px;
	text-align:center;
	}
	
	.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
	}

	.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
	}

	.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
	}
	
	.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
	}
	
	<!-- code from https://dev.to/dcodeyt/creating-beautiful-html-tables-with-css-428l -->


	</style>
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
		
		<table>
			
			<?php
						//show table of database
			global $wpdb;
			$query_tablename_id= "wp_sensors_data";
			$print_test = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."sensors_data",ARRAY_A);
			
			echo "<table class='styled-table'>
			<tr>
			<th>Sensor name value</th>
			<th>Value</th>
			<th>Time </th>
			</tr>";
		
			foreach( $print_test as $print)
			{
				
				$print_name = $print["sensor_name_value"];
				$print_value = $print["sensor_value"];
				$print_time = $print["reading_time"];
				
				echo "<tr>";
				echo "<td>$print_name </td>";
				echo "<td>$print_value</td>";
				echo "<td>$print_time </td>";
				echo "</tr>";
				
			}
			
			?>
		</table>

		
	</body>
</html>