<?php

class handeling_data_from_sensors
{
		/*
		* @var string $data_from_post Data_from_post
		* @var string $CO2 CO2
		* @var string $tVTOC tVTOC
		* @var string $humidity humidity
		* @var string $temperature Temperature
		* @var string $light Light
		*/
		
	private $data_from_post;
	private $CO2;
	private $tVTOC;
	private $humidity;
	private $temperature;
	private $light;
	
		/*
		* @abstract = initialize the object's properties
		* @param:$this->data_from_post = used as placeholder for storing the JSON data from the HTTP post,this makes multiple function usage possible
		* @param:$this->CO2 = stores the CO2 value from the JSON data
		* @param:$this->tVTOC = stores the tVTOC value from the JSON data
		* @param:$this->humidity  = stores the humidity value from the JSON data
		* @param:$this->temperature = stores the temperature value from the JSON data
		* @param:$this->ligth = stores the ligth value from the JSON data
		*/
	
	public function __construct($data_from_post,$CO2,$tVTOC,$humidity,$temperature,$light)
	{
		$this->data_from_post = $data_from_post;
		$this->CO2 = $CO2;
		$this->tVTOC= $tVTOC;
		$this->humidity = $humidity;
		$this->temperature = $temperature;
		$this->light= $light;
	}
	
		/*
		* @abstract = decodes the HTTP JSON post data from $raw_post_data and place it in a plcaholder what can be used in multiple functions, also print it
		* @param: $raw_post_data  = holds the arrived JSON data from the script custom-showdata.php
		* @param: $this->data_from_post = used as placeholder for storing the JSON data from the HTTP post, ,this makes multiple function usage possible
		*/
	
	public function get_post_data_esp32($raw_post_data)
	{
		$this->data_from_post =  json_decode($raw_post_data); // decode json 
		print_r($this->data_from_post);
	}
	
		/*
		* @abstract = check if the API key is correct, if not then there is a unwanted post. The script will end then.
		* @param: $api_key = used as storage for holding the API key from the JSON data
		*/
		
	public function check_api_key()
	{
		$api_key = ($this->data_from_post)->api_key[0]; 
		echo $api_key;
		
		if($api_key === "enterHere123456789") // === meens identical to eachother == is equal
		{
			echo "Proceed";
		}
			else
			{
				exit("Destroy class");
			}
	}
		/*
		* @abstract = when the API key is correct, the sensor data will be seperated and stored in different variables. 
		* @param: $api_key = used as storage for holding the API key from the JSON data
		* @param:$this->CO2 = stores the CO2 value from the JSON data
		* @param:$this->tVTOC = stores the tVTOC value from the JSON data
		* @param:$this->humidity  = stores the humidity value from the JSON data
		* @param:$this->temperature = stores the temperature value from the JSON data
		* @param:$this->ligth = stores the ligth value from the JSON data
		*/
	
	public function seperate_json()
	{
		// the visialisation of the JSON data was done in Wireshark
		
		$this->CO2   =($this->data_from_post)->CSS811_sensor[1]; // from the data there is a pointer to the CSS811_sensor array. The value of CO2 is in the first index
		$this->tVTOC =($this->data_from_post)->CSS811_sensor[3]; 
		$this->humidity = ($this->data_from_post)->DHT11_sensor[1]; // same principle as the CSS811 sensor array 
		$this->temperature= ($this->data_from_post)->DHT11_sensor[3];
		$this->light = ($this->data_from_post)->Groove_light_sensor[1];
	}
		/*
		* @abstract = this function stores the seperated sensor values in the wp_sensor_data
		* @global:$wpdb = used to interact with a database without needing to use raw SQL statements
		* @param :$query_tablename_id = stores the name of the table where the sensordata will be insert
		*/
	
	public function insert_data_table()
	{
		global $wpdb;
		$query_tablename_id= "wp_sensors_data";
		
		$wpdb->query("INSERT INTO $query_tablename_id(sensor_name_value,sensor_value) VALUES('CO2' , ".(float)$this->CO2.")");  // convert to float
		$wpdb->query("INSERT INTO $query_tablename_id(sensor_name_value,sensor_value) VALUES('tVTOC', ".(float)$this->tVTOC.")"); 
		$wpdb->query("INSERT INTO $query_tablename_id(sensor_name_value,sensor_value) VALUES('Humidity', ".(float)$this->humidity.")"); 
		$wpdb->query("INSERT INTO $query_tablename_id(sensor_name_value,sensor_value) VALUES('Temperature' , ".(float)$this->temperature.")"); 
		$wpdb->query("INSERT INTO $query_tablename_id(sensor_name_value,sensor_value) VALUES('Light' , ".(float)$this->light.")"); 	
	}
	
		/*
		* @abstract = this function shows the table of the sensor data
		* @global:$wpdb = used to interact with a database without needing to use raw SQL statements
		*/
	
	//Is called when the script is ended or exit , does deallocate memory and other cleanup for a class object and its class members when the object is destroyed.
		
	public function __destruct()
	{
		
	}
}