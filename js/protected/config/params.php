<?php
// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'Sigma Topic',
	// this is used in error pages
	'adminEmail'=>'noreply@wedialog.net',
	//'adminReplayEmail'=>'noreply@wedialog.net',//for notification replay to.
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',
    	
	//Absolute url for console in cronjob
	"full_path_topics"=>"http://wedialog.net/topics/Viewtopic",
	"full_path_rules"=>"http://wedialog.net/TypeTags/viewrule",	
	"full_path_teams"=>"http://wedialog.net/team/viewteam",

    
    // Facebook API KEY
    //'facebook_api_key'=>'348369371962620',
    //'facebook_api_secret'=>'5375530831edec7232b190d997d162cb',
	
    
    //=== START: DB EXECUTION MESSAGES =============================//
	'record_saved' => 'Record saved sucessfully.',
    'rule_saved' => 'Rule saved sucessfully.',
    'topic_saved' => 'Topic saved sucessfully.',
    'team_member_saved' => 'Member registration sucessfully.',
    'team_member_duplicate' => 'Sorry. You Are Already A Member...',
	'execution_error' => 'Oops!!! There was some problem while executing your request. Try again later.',
	'record_deleted' => 'Record(s) deleted successfully.',
	'status_changed' => 'Status has been changed successfully.',
	'provide_data' => 'Please provide valid data and try again.',
	'subscribe_success' => 'Thank you for subscription. We will notify you when we will be live.',
	'subscribe_fail' => 'Ooops!!! There was some problem in executing your request. Please try again.',
	'already_subscribed' => 'Ooops!!! You have already subscribed with us. Enjoy the site.',
    'hide_comment_sucess' => 'Comments hide sucessfully.',
    'block_user_sucess' => 'Uses Inactivated sucessfully.',
    'order_no_sucess' => 'Order Rules done sucessfully.',
    'posting'=>'Your ip block for for This Post.',
    'post_on_comment'=>'Your ip block for Post on comment.',
    'comment_green_flag'=>'Your ip block for greenflag.',
    'message'=>'Your ip block for post a message.',
    'comment_red_flag'=>'Your ip block for Redflag.',
    'create_team'=>'Your ip block for create New Team.',
    'create_rules'=>'Your ip block for create New Rules.',
    'create_topic'=>'Your ip block for create New Topic.',
    'ip_inactive'=>'Sorry! Your ip is block Please contact to admin',
    'remove_admin'=>'Sucess ! from Admin to User Role apply sucesfull.',
    'make_admin'=>'Sucess ! from User to Admin Role apply sucesfull.',
    
	//=== END: DB EXECUTION MESSAGES ===============================//
    //========================== Event Image ===========================//
     'profile_img' => 'files/profile_images/',
        
	'viewIsStatus'=>array(
		'Inactive'=>'In-Active',
		'Active'=>'Active',
	),
    
	'viewStatus'=>array(
		'0'=>'In-Active',
		'1'=>'Active',
	),
    
    'PostType'=>array(
		'1'=>'Topic',
        '2'=>'Rule',
        '3'=>'Team',
    ),    
    'meta_title'=>'wedialog.net',
    'meta_description'=>'Discuss what your are wedialog about',
    'meta_keyword'=>'wedialog Keyword',
    
    "facebookApiKey" => '463702543834620',
	"facebookAppSecret" => 'c4d3e8e2588adda245dc35440145374d',
);
