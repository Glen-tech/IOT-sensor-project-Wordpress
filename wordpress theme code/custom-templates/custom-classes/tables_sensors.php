<?php
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

class create_tables_sensors
{
		/*
		*@abstract = initialize the object's properties
		*/
	public function __construct()
	{
	}
	
		/*
		*@abstract = creates the table wp_sensors_id, insert of the sensor name value happens here in the code
		*@global: $wpdb = used to interact with a database without needing to use raw SQL statements
		*@param:$query_tablename_id = stores the name of the table
		*@param:$query_count = Holds the counted element of the table
		*/
		
	public function create_sensor_id()
	{
		global $wpdb;
		$query_tablename_id= "wp_sensors_id";
		$query_column = "sensor_id";
	
		$wpdb->query('CREATE TABLE IF NOT EXISTS ' .$query_tablename_id. '(sensor_id INT,sensor_name_value VARCHAR(50));');
		$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like($query_tablename_id) );
		
		$query_count = $wpdb->get_var('SELECT COUNT("sensor_id") FROM '.$query_tablename_id.';'); // get result in variable of the query
	    	
		
		if($query_count == 0) // insert when empty table
			{
				$wpdb->query("INSERT INTO $query_tablename_id(sensor_id,sensor_name_value) VALUES(1 , 'CO2')"); 
				$wpdb->query("INSERT INTO $query_tablename_id(sensor_id,sensor_name_value) VALUES(20 , 'tVTOC')"); 
				$wpdb->query("INSERT INTO $query_tablename_id(sensor_id,sensor_name_value) VALUES(75 , 'Humidity')"); 
				$wpdb->query("INSERT INTO $query_tablename_id(sensor_id,sensor_name_value) VALUES(88 , 'Temperature')"); 
				$wpdb->query("INSERT INTO $query_tablename_id(sensor_id,sensor_name_value) VALUES(120 , 'Light')"); 
			}		
	}
	
		/*
		*@abstract = creates the table wp_sensors_data, 
	    *@global: $wpdb = used to interact with a database without needing to use raw SQL statements
		*@param:$query_tablename_id = stores the name of the table we want to create
		*/
	
	public function create_sensor_data()
	{
		global $wpdb;
		$query_tablename_id= "wp_sensors_data";
		$wpdb->query('CREATE TABLE IF NOT EXISTS ' .$query_tablename_id. '(sensor_name_value VARCHAR(50),sensor_value FLOAT, reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP);'); // no user input
	}
	
	//Is called when the script is ended or exit , does deallocate memory and other cleanup for a class object and its class members when the object is destroyed.
		
	public function __destruct()
	{
		
	}
	
}

?>