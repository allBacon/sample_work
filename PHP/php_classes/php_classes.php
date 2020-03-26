<?php

	class Student {
		function __construct($first_name,$last_name,$student_id,$gpa){
			$this->$first_name = $first_name;
			$this->$last_name = $last_name;
			$this->$student_id = $student_id;
			$this->$gpa = $gpa;
		}
		function enrollClass($class) {
			echo $this->first_name . " is currently Enrolled in ". $class."<br />";
		}

		function status($value) {
			if ($value === 'Active') {
				echo $this->first_name . " is an active student.<br />";
			} else {
				echo $this->first_name . " is not an active student.<br />";
			}
		}

		function test($property){
			return $this->$property;
		}
	}


	$andrey = new Student();
	$andrey->first_name = "Andrey";
	$andrey->last_name = "Harpy";
	echo "The student in this class is ". $andrey->first_name ." ". $andrey->last_name.".<br />";
	echo $andrey->status('');

	$dan = new Student();
	$dan->first_name = "Dan";
	$dan->enrollClass('CTEC 227');
	$dan->status('Active');

	$monkey = $dan->test("bastard");
	

?>