$(function(){ 
  $('.loader_img').hide(); // when page loads, hide loading spinner until we make an ajax request
  $('#process_form').submit(function(e){ // prevent course select form from performing any action when user submits
	e.preventDefault();  
  });
  $('#submit').click(function(e) { // when user clicks 'get course' button, fetch course data in ajax request
	e.preventDefault();
    function processAssignments(course_id){
      $('#assignments').html(''); // clear div contents to prepare for displaying data
      $('#display_course_data').html('');
      $('.loader_img').show(); // show loading indicator when thinking
	  // AJAX for data requests
	  $.ajax({
		type: 'GET',
		url: 'lib/functions.php',
		data: {process_course: true, course_id: course_id},
	  }).done(function(data){
		console.log(data);
		// $('#display_course_data').append(name);
	  }).success(function(result){
		$('.loader_img').hide(); // hide loading indicator after data loads
		$('#assignments').append(result); // display returned data
	  }).fail(function(){
		alert("There was an eror processing your request.");
	  });
	  $.get(
		'lib/functions.php',
		{display_course_data: true, course_id: course_id},
	    function(result){
		  $('#display_course_data').append(result); // display returned data
	    } 
	  );
    
    }
    // Set course ID variable then call processAssignments
    var course_id = $('select :selected').val(); // evaluate dropdown select for course_id
    //console.log(courseId);
    if (course_id == undefined || course_id == '') {} else { // if course_id set, call processAssignments and pass course_id into function
	  processAssignments(course_id);
    }
  });

  $('nav li').click(function(){ // when user clicks menu item, load desired data
    $('#assignments').html(''); // hide loading indicator after data loads
  	$('.loader_img').show(); // display returned data
  	var courseId = $('select :selected').val(); // evaluate dropdown select for course_id
    $.get( // ajax request to refresh desired data to display
    	'lib/functions.php', 
    	{menu: this.id, course_id: courseId}, // pass menu and course_id parameters into URL
    	function(result){
    	  var resultsArray = []; // instantiate new empty array to prepare for data push/fill
    	  resultsArray.push(result); // push data results to array
    	  console.log(courseId); // debug courseId
    	  $('.loader_img').hide();  // hide loading spinner when data is loaded and ajax is success
          $('#assignments').append(resultsArray);  // append data to assignments element
    	}
    );
  });

  // $('#upcoming').click(function(){
  // 	$(this).css("display", "inline-block");
  // 	//$(this).slideToggle();

  // })
 //  $('#submit_custom_token').click(function(e) {
	// e.preventDefault();

 //    function processCustomToken(token){
	//   // AJAX for refreshing information requests
	//   $.ajax({
	// 	type: 'GET',
	// 	url: 'lib/getCustomToken.php',
	// 	data: {access_token: token},
	//   }).done(function(result){
	// 	console.log(result);
	//   }).success(function(result){
	//   	console.log('hello');
	//   }).fail(function(){
	// 	alert("There was an eror processing your request.");
	//   });
 //    }
 //    // Set course ID variable then call processAssignments
 //    var custom_token = $('#custom_access_token').val();
 //    //console.log(courseId);
 //    if (custom_token == undefined || custom_token == '') {} else {
	//   processCustomToken(custom_token);
 //    }
 //  });

  // $('#custom_token_form_box').hide();
  // $('#custom_token_slide').click(function(){
  // 	$('#custom_token_form_box').slideToggle();
  // 	$('#custom_token_slide').fadeOut();
  // });

  $('#main-menu').smartmenus({ // custom menu positioning values
    subMenusSubOffsetX: 1,
    subMenusSubOffsetY: -8
  });

  $('#error').hide(); // hide error element (not used)

});