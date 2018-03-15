<?php
class MyHelpers extends CHtml{
	public static function getGreentotalCount($main_id, $user_id,$flag_type,$post_type){
        //return $green_comment_count = AllPostsFlags::model()->count(array('condition'=>'flag_status=1 AND commented_by='.$user_id.' AND flag_type="'.$flag_type.'" AND post_type='.$post_type));
        return $green_comment_count = AllPostsFlags::model()->count(array('condition'=>'flag_status=1 AND commented_by='.$user_id.' AND flag_type="'.$flag_type.'"'));
    
    }
    
    public static function getGreentotalCountPeople($user_id,$flag_type){
        return $green_comment_count = AllPostsFlags::model()->count(array('condition'=>'flag_status=1 AND commented_by='.$user_id.' AND flag_type="'.$flag_type.'"'));
    
    }
    
    public static function getGreentotalCountuser($user_id,$flag_type){
        //return $green_comment_count = AllPostsFlags::model()->count(array('condition'=>'flag_status=1 AND commented_by='.$user_id.' AND flag_type="'.$flag_type.'" AND post_type='.$post_type));
        return $green_comment_count = AllPostsFlags::model()->count(array('condition'=>'flag_status=1 AND commented_by='.$user_id.' AND flag_type="'.$flag_type.'"'));
    
    } 
    
    public static function getAgreeCount($user_id,$type){
        $count = 0;
        $i = 0;
        $user_like_dislike_model = AllPosts::model()->findAll(array('condition'=>'user_id ='.$user_id.' AND status=1'));
        if(count($user_like_dislike_model) > 0){
            foreach($user_like_dislike_model as $user_like_dislike){
                if($type == 'Agree'){
                    $count += $user_like_dislike->like;
                }else{
                    $count += $user_like_dislike->dislike;
                }                
              $i++;   
            }

        }
        return $count;
    }
    
    public static function getAgreeDisagreeavg($post_id){
        $sql = 'SELECT (SUM(all_posts.like) + SUM(all_posts.dislike) ) as total FROM all_posts WHERE all_posts.id='.$post_id;
        $user_like_dislike_model = AllPosts::model()->findBySql($sql);
        return $user_like_dislike_model->total;
    }    
    
    /*public static function getQuestionAnswerLikedDisLikedVotetotalCount($topic_id,$post_id,$question_no,$question,$option,$type){
        //return $count =TopicQuestionAnswer::model()->count(array('condition'=>'topic_id='.$topic_id.' AND post_id='.$post_id.' AND type="'.$type.'"'));
        $answer_no="";
        if($question_no=="question1"){
            $answer_no="answer1";
        }else if($question_no=="question2"){
            $answer_no="answer2";
        }else if($question_no=="question3"){
            $answer_no="answer3";
        }
        return $count =TopicQuestionAnswer::model()->count(array('condition'=>'topic_id='.$topic_id.' AND post_id='.$post_id.' AND '.$question_no.'= "'.$question.'" AND '.$answer_no.'= "'.$option.'" AND type="'.$type.'"'));
    }*/
    public static function getUserVoteCount($topic_id,$post_id,$filter_user_ids,$type){
        $count=0;
        if($filter_user_ids !=""){
            $filter_user_ids_array=explode(",",$filter_user_ids);
            $user_ids_query="";
            foreach($filter_user_ids_array as $filter_user_ids_array_arr){
                if($user_ids_query=="")
                    $user_ids_query="FIND_IN_SET(".$filter_user_ids_array_arr.",".$type.")";
                else
                    $user_ids_query.=" OR FIND_IN_SET(".$filter_user_ids_array_arr.",".$type.")";  
            }   
            
            return $count =AllPosts::model()->count(array('condition'=>'post_type=1 AND main_id='.$topic_id.' AND id='.$post_id.' AND ('.$user_ids_query.')'));
        }
        return $count;
    }
    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
 }
?>