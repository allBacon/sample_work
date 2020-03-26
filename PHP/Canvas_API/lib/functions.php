<?php
  date_default_timezone_set('America/Los_Angeles'); #set local timezone

	function APICall($method,$url,$data=false) { #function for canvas API requests
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	} # end APICall

	# set courseId session variable
	if (!isset($_SESSION['courseId'])) { 
		if (isset($_GET['course_id'])) {
			$_SESSION['courseId'] = '';
			$_SESSION['courseId'] = $_GET['course_id']; # set session variable: courseId
		} 
	} 
	# set courseId session variable
	if (!isset($_SESSION['id'])) { 
		$_SESSION['id'] = '4011687';
	} 


	
	# define token and set custom token if input
	function setToken() {
		if (isset($_GET['access_token'])) { # find if user input custom token in address bar
			$access_token = '?access_token=';
			$access_token .= $_GET['access_token'];
			if (!isset($_SESSION['token'])) {
				$_SESSION['token'] = $access_token;
			}
		} else { #default token
			$access_token = '?access_token=9~uxozlMLyUf0VSLrUuomIGM1bDW15WkQnAoLJBNSQy9V9rZ4EGVe6NMsDnazEIX6Y';
			$_SESSION['token'] = $access_token;
		}
		return $access_token;
	} # end setToken
	setToken(); # set token on page load

	# function to grab data from courses array
	function getData($set_url) {
		$access_token = $_SESSION['token'];
		$url = 'https://clarkcollege.instructure.com/api/v1';
		$url .= $set_url.$access_token;
		$result = APICall('GET',$url);
		$_SESSION['results'] = $result;
		// $session_data = json_decode($_SESSION['results']);
		if (isset($_SESSION['results'])) {
			$data = $result;
			// echo '<pre>';print_r($data);echo '</pre>';
			if (!isset($_SESSION['course_id'])) { 
				if (isset($_GET['course_id'])) {
					$_SESSION['course_id'] = $_GET['course_id']; # set session variable: course_id as courseId
					// echo $_SESSION['courseId'];
				} 
			} 
			// if (isset($_GET['display_course_data'])) {  
			// 	if (!isset($_GET['root_account_id'])) {  
			// 		$_SESSION['root_account_id'] = $data[0]['root_account_id']; # set session variable: user id as id
			// 	}
			// } 
		}

		# debug
		// echo '<pre>';print_r($result);echo '</pre>';
		// echo $_SESSION['id'];

		return $result;
	} # end getData

	#get user avatar image
	function getAvatar() {
		// $_SESSION['id'] = $userId;
		// set user id session var
		$userId = $_SESSION['id'];
		$url_avatar = '/users/'.$userId;
		$result = getData($url_avatar);
		$data = json_decode($result, true);
		
		# output start
		// echo '<pre>';print_r($data);echo '</pre>';
		echo "<img id=\"main_avatar_img\" src=\"".$data['avatar_url']."\">";
		# output end
	} # end getAvatar

	# get course information
	function getCourses() {
		$course_id = $_SESSION['course_id'];
		$url_course = '/courses';
		$result = getData($url_course);
		$data = json_decode($result, true);
		

		# output start
		echo '<option value="">-Select a Course-</option>';
		foreach ($data as $value) {
			if (isset($value['name'])) {
				if ($value['enrollments'][0]['type'] == 'student') {
					echo '<option ';
					if ($course_id==$value['id']) {
						echo 'selected="selected"';
					}
					echo ' value="'.$value['id'].'">'.$value['name']."</option>\n";
				}
			}
		}
		# output end
	} # end getCourses

	# get user information
	function getSelf() {
		$userId = $_SESSION['id'];
		$url_self = '/users/'.$userId;
		$result = getData($url_self);
		$data = json_decode($result, true);

		# output start
		// echo '<pre>';print_r($data);echo '</pre>';
		echo '<h2>'.$data['name'].'</h2>';
		# output end
	} # end getSelf

	# build sub menu
	function subMenu() {
		echo "<nav class=\"main\">\n";
		echo "<ul id=\"main-menu\" class=\"sm sm-ltl sm-blue\">\n";
		echo "<li id=\"ass\"><a>Assignments</a></li>\n";
		echo "<li id=\"quiz\"><a>Quizzes</a></li>\n";
		echo "<li id=\"disc\"><a>Discussion Topics</a></li>\n";
		echo "</ul>\n</nav>\n";
	}  # end subMenu

	#evaluate clicked menu element and display desired results
	if (isset($_GET['menu'])) {
		switch($_GET['menu']) {
		    case 'ass':
		    	if (isset($_GET['course_id'])) {
				  $course_id = $_GET['course_id'];
				  // echo $course_id;
				  getAssignments($course_id);
				}
		        break;
		    case 'quiz':
		    	if (isset($_GET['course_id'])) {
				  $course_id = $_GET['course_id'];
				  // echo $course_id;
				  getQuizzes($course_id);
				}
		        break;
		    case 'disc':
		    	if (isset($_GET['course_id'])) {
				  $course_id = $_GET['course_id'];
				  // echo $course_id;
				  getDiscussions($course_id);
				}
		        break;
		    default:
		        break;
		} # end switch
	} # end if

	function getAssignments($courseid) { # when page loads and when clicks menu item, load assignment data
		$access_token = $_SESSION['token'];
		$course = $courseid;

		function getUpcoming($token,$courseid) {
			$url = 'https://clarkcollege.instructure.com/api/v1/courses/'.$courseid.'/assignments'.$token.'&bucket=upcoming';
			$result = APICall('GET',$url);
			$data = json_decode($result, true);
			// echo '<pre>';print_r($data);echo '</pre>';
			for ($i=0; $i < count($data); $i++) { 
				if ($data[$i]['is_quiz_assignment'] == 1) { #do nothing with quiz assignment
				} elseif ($data[$i]['is_quiz_assignment'] == '' || $data[$i]['is_quiz_assignment'] == undefined) { #if not quiz, display assignment data
					echo "<td>";
					echo "<a href=\"".$data[$i]['html_url']."\">".$data[$i]['name']."</a><br />";
					echo "Due By: ".$data[$i]['due_at']."<br />";
					echo "</td>";
				} else {} #if not quiz and not assignment: do nothing
			}
		} # end getUpcoming
		function getPast($token,$courseid) { #/api/v1/courses/:course_id/assignments/:assignment_id/submissions
			$url = 'https://clarkcollege.instructure.com/api/v1/courses/'.$courseid.'/assignments/'.$token.'&bucket=past';
			$result = APICall('GET',$url);
			$data = json_decode($result, true);
			// echo 'data1: <pre>';print_r($data);echo '</pre>';

			for ($i=0; $i < count($data); $i++) { 
				if ($data[$i]['is_quiz_assignment'] == 1) {
				} else { 
					echo "<td>";
					echo "<a href=\"".$data[$i]['html_url']."\">".$data[$i]['name']."</a><br />";
					echo "Due By: ".$data[$i]['due_at']."<br />";
					// echo 'Grade '.$data2;
					echo "</td>";
				}
			}
			// echo 'data2: <pre>';print_r($data2);echo '</pre>';
		} # end getPast

		# output start
	  	echo "<div id=\"upcoming\">\n";
	  	echo "<h3>Upcoming:</h3>\n";
	  	echo "<table>\n<tr>\n";
	  	getUpcoming($access_token,$course);
	  	echo "</tr>\n</table>\n";
	  	echo "</div>\n";
	  	echo "<div id=\"past\">\n";
	  	echo "<h3>Past:</h3>\n";
	  	echo "<table>\n<tr>\n";
	  	getPast($access_token,$course);
	  	echo "</tr>\n</table>\n";
	  	echo "</div>\n";
	  	# output end
	}   # end getAssignments

	function getQuizzes($courseid) { # when user clicks menu item, load quiz data
		$access_token = $_SESSION['token'];
		$course = $courseid;
		function getUpcoming($token,$courseid) {
			$url = 'https://clarkcollege.instructure.com/api/v1/courses/'.$courseid.'/assignments'.$token.'&bucket=upcoming';
			$result = APICall('GET',$url);
			$data = json_decode($result, true);
			// echo '<pre>';print_r($data);echo '</pre>';
			for ($i=0; $i < count($data); $i++) { 
				if ($data[$i]['is_quiz_assignment'] == 1) { 
				  echo "<td>";
				  echo "<a href=\"".$data[$i]['html_url']."\">".$data[$i]['description']."</a><br />";
				  echo "Due By: ".$data[$i]['due_at']."<br />";
				  echo "</td>";
				} else {} #if not quiz and not assignment: do nothing
			}
		} # end getUpcoming
		function getPast($token,$courseid) {
			$url = 'https://clarkcollege.instructure.com/api/v1/courses/'.$courseid.'/assignments'.$token.'&bucket=past';
			$result = APICall('GET',$url);
			$data = json_decode($result, true);
			// echo '<pre>';print_r($data);echo '</pre>';
			for ($i=0; $i < count($data); $i++) { 
				if ($data[$i]['is_quiz_assignment'] == 1) { 
				  echo "<td>";
				  echo "<a href=\"".$data[$i]['html_url']."\">".$data[$i]['description']."</a><br />";
				  echo "Due By: ".$data[$i]['due_at']."<br />";
				  echo "</td>";
				} else {} #if not quiz and not assignment: do nothing
			}
		} # end getPast

		# output start
	  	echo "<div class=\"slide\" id=\"upcoming\">\n";
	  	echo "<h3>Upcoming Quizzes:</h3>\n";
	  	echo "<table>\n<tr>\n";
	  	getUpcoming($access_token,$course);
	  	echo "</tr>\n</table>\n";
	  	echo "</div>\n";
	  	echo "<div class=\"slide\" id=\"past\">\n";
	  	echo "<h3>Past Quizzes:</h3>\n";
	  	echo "<table>\n<tr>\n";
	  	getPast($access_token,$course);
	  	echo "</tr>\n</table>\n";
	  	echo "</div>\n";
	  	# output end
	}   # end getQuizzes

	function getDiscussions($courseid) { #display discussions when user clicks discussion menu item
		$access_token = $_SESSION['token'];
		$course = $courseid;
		function getUpcoming($token,$courseid) {
			$url = 'https://clarkcollege.instructure.com/api/v1/courses/'.$courseid.'/discussion_topics'.$token;
			$result = APICall('GET',$url);
			$data = json_decode($result, true);
			$quiz_array = array();
			// echo '<pre>';print_r($data);echo '</pre>';
			for ($i=0; $i < count($data); $i++) { 
				if ($data[$i]['published'] == 'true' && !$data[$i]['locked'] == 1) { 
					echo "<td>";
					echo "<a href=\"".$data[$i]['html_url']."\">".$data[$i]['title']."</a><br />";
					if (isset($data[$i]['lock_at'])) {
						echo "Due By: ".$data[$i]['lock_at']."<br />";
					} else {
						echo 'No Due Date Set!';
					}
					echo "</td>"; 
				} else {}
			}
		} # end getUpcoming
		function getPast($token,$courseid) {
			$url = 'https://clarkcollege.instructure.com/api/v1/courses/'.$courseid.'/discussion_topics'.$token.'&scope=locked';
			$result = APICall('GET',$url);
			$data = json_decode($result, true);
			// echo '<pre>';print_r($data);echo '</pre>';
			for ($i=0; $i < count($data); $i++) { 
				if (isset($data)) {
					echo "<td>";
					echo "<a href=\"".$data[$i]['html_url']."\">".$data[$i]['title']."</a><br />";
					if (isset($data[$i]['lock_at'])) {
						echo "Due By: ".$data[$i]['lock_at']."<br />";
					} else {
						echo 'No Due Date Set!';
					}
					echo "</td>"; 
				} else {}
			}
		} # end getPast

		# output start
	  	echo "<div id=\"upcoming\">\n";
	  	echo "<h3>Unlocked Discussions</h3>\n";
	  	echo "<table>\n<tr>\n";
	  	getUpcoming($access_token,$course);
	  	echo "</tr>\n</table>\n";
	  	echo "</div>\n";
	  	echo "<div id=\"past\">\n";
	  	echo "<h3>Locked Discussions:</h3>\n";
	  	echo "<table>\n<tr>\n";
	  	getPast($access_token,$course);
	  	echo "</tr>\n</table>\n";
	  	echo "</div>\n";
	  	# output end
	}   # end getDiscussions

	function getToken() {
		if (isset($_GET['access_token'])) {
			$access_token = '?access_token=';
			$access_token .= $_GET['access_token'];
		} else {
			$access_token = '?access_token=9~uxozlMLyUf0VSLrUuomIGM1bDW15WkQnAoLJBNSQy9V9rZ4EGVe6NMsDnazEIX6Y';
		}
		return $access_token;
	} # end getToken
	
	#default: display assignment data when user selects a course
	if (isset($_GET['course_id']) && isset($_GET['process_course'])) {
		$courseid = $_GET['course_id'];
		$_SESSION['course_id'] = $courseid;
		getAssignments($courseid);
	}

	function displayCourseInfo() {
		$url_course = '/courses';
		$course_result = getData($url_course);
		$course_array = json_decode($course_result, true);

		 // echo '<pre>';print_r($course_array);echo '</pre>';

		$courseId = $course_array[0]['id'];
		// $enrollmentId = $data[0]['id'];
		$rootId = $course_array[0]['root_account_id'];
		$userId = $course_array[0]['enrollments'][0]['user_id'];

		// user id should be set by data returned from getData() in a session variable
		function getEnrollments($userId,$courseId) {
		  $url_info = '/users/'.$userId.'/enrollments';
		  $result = getData($url_info);
		  $data = json_decode($result, true);

		  // echo 'CourseId: '.$data[0]['course_id'];

		    for ($i=0; $i < count($data); $i++) { 
			  if ($data[$i]['course_id'] == $courseId) {
			  	$_SESSION['enrollmentId'] = $data[$i]['id'];

			  	// echo 'Id: '.$data[$i]['id'].'<br />';
			    echo '<h4>Current Grade: '.$data[$i]['grades']['current_score'].'</h4>';
			  } else {} 
		    }
		    // echo 'enrollmentId: '.$_SESSION['enrollmentId'];
		  # output start
		  // echo 'Enrollments: <pre>';print_r($data);echo '</pre>';
		  // echo $data['grades']['current_grade'];
		  // echo $data[0]['grades']['current_grade'];
		  # output end
		} # end getEnrollments
		function getCourseName($userId,$courseId) {
		  $url_course = '/users/'.$userId.'/courses'; #'/users/'.$userId.
		  $result2 = getData($url_course);
		  $data2 = json_decode($result2, true);

 			// echo 'getCourseName data: <pre>';print_r($data2);echo '</pre>';
			// echo 'count: '.count($data2);

		    for ($i=0; $i < count($data2); $i++) { 
			  if ($data2[$i]['id'] == $courseId) {
			  	echo $data2[$i]['name'].'<br />';
			  	// echo '<pre>';print_r($data2);echo '</pre>';
			    // echo print_r($data2[$i]);
			  } else {} 
		    }
		
		  # output start
		  // echo $data[0]['name'];
		  # output end
		} # end getCourseName

		// function getEnrollmentId($courseId,$enrollmentId,$rootId) {
		//   $url_info = '/accounts/'.$rootId.'/enrollments/'.$enrollmentId;
		//   $result3 = getData($url_info);
		//   $data3 = json_decode($result3, true);

		//   // echo 'CourseId: '.$data3['id'];

		//     // for ($i=0; $i < count($data3); $i++) { 
		// 	  // if ($data3['id'] == $_SESSION['enrollmentId']) {
		// 	  	// echo 'CourseId: '.$data3['id'];
		// 	    echo 'Current Score: '.$data3['grades']['current_score'];
		// 	  // } else {} 
		//     // }

		//   # output start
		//   // echo 'data3: <pre>';print_r($data3);echo '</pre>';
		//   // echo $data3['grades']['current_grade'];
		//   // echo $data3[0]['grades']['current_grade'];
		//   # output end
		// }

	  if (isset($_GET['course_id'])) {
	  	$courseId = $_GET['course_id'];
	  	// echo 'courseid: '.$courseId;
	  	getCourseName($userId,$courseId);
		getEnrollments($userId,$courseId);
		// getEnrollmentId($courseId,$_SESSION['enrollmentId'],$rootId);
	  }
	} # end displayCourseInfo

	# handle get request when form is submitted and call displayCourseInfo when display_course_data isset
	if (isset($_GET['display_course_data'])) {
		# display course info and grades
  		displayCourseInfo();	    
	}
  

#debug session vars
// echo $_SESSION['results'];
// echo $_SESSION['id'];

// echo $_SESSION['course_id'];
// echo 'Root Acct ID: '.$_SESSION['root_account_id'];

// echo $_SESSION['token'];
?>