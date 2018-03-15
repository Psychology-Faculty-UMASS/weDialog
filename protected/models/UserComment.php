<?php

/**
 * This is the model class for table "user_comment".
 *
 * The followings are the available columns in table 'user_comment':
 * @property integer $id
 * @property integer $user_id
 * @property integer $topic_id
 * @property string $comment
 */
class UserComment extends CActiveRecord
{
	public $user_comments;
	public $user_comments_trply;
	public $comment_tmp;
	public $like_difference;
    public $topic_main_id;
    public $green_flag;
    public $red_flag;
    public $block_flag;
    public $hide_post;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, topic_id, comment', 'required'),
			array('user_id, topic_id', 'numerical', 'integerOnly'=>true),
			//array('comment', 'length', 'max'=>255),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
            array('main_comment_id, comment_id,created_date,status','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('green_flag,red_flag, main_comment_id, comment_id,id, user_id, topic_id, comment', 'safe', 'on'=>'search'),
			array('hide_post,block_flag,green_flag,red_flag, main_comment_id, comment_id,id, user_id, topic_id, comment', 'safe', 'on'=>'searchallposts'),
		
        
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'user_comment'=>array(self::BELONGS_TO,'Users','user_id'),
            'comment_reply'=>array(self::HAS_MANY,'CommentReply','comment_id','order'=>'id ASC'),
            'comment_reply_date'=>array(self::HAS_MANY,'CommentReply','comment_id','order'=>'created_date DESC'),
            
            'user_main_comment'=>array(self::HAS_MANY,'UserComment','comment_id','condition'=>'comment_id != 0'),
            'user_main_comment_list'=>array(self::HAS_MANY,'UserComment','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'user_other_comment'=>array(self::BELONGS_TO,'UserComment','comment_id'),
            
            'user_green_comment'=>array(self::HAS_MANY,'UserCommentFlag','user_comment_id', 'condition'=>'flag_type="Green" AND flag_status=1'),
            'user_red_comment'=>array(self::HAS_MANY,'UserCommentFlag','user_comment_id', 'condition'=>'flag_type="Red" AND flag_status=1'),
            'user_block_comment'=>array(self::HAS_MANY,'UserCommentFlag','user_comment_id', 'condition'=>'block_user=1 AND flag_status=1'),
            'user_hide_comment'=>array(self::HAS_MANY,'UserCommentFlag','user_comment_id', 'condition'=>'hide_post=1 AND flag_status=1'),
        
        
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'topic_id' => 'Topic',
			'comment' => 'Comment',
            'comment_id' => 'Comment',
            'status'=>'Status',
            'main_comment_id'=>'Main Comment ID',
            'green_flag'=>'Green Flag',
            'red_flag' =>'Red Flag',
            'block_flag'=>'blocks',
            'hide_post' =>'Hide Post',
		);
	}

    
    
    public function searchallposts(){
        
		// ============ START :: TOPIC COMMENTS =================== //
       
        $criteria=new CDbCriteria;
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
        
        
		/*$criteria->compare('id',$this->id);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('comment_id',$this->comment_id);
        $criteria->compare('main_comment_id',$this->main_comment_id);        
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('red_flag',$this->red_flag);
        $criteria->compare('block_flag',$this->block_flag);
        $criteria->compare('hide_post',$this->hide_post);
        //$criteria->with = array('user_hide_post_comment');*/
        /*
        $sort = new CSort();
        //$sort->defaultOrder=array('green_flag'=>CSort::SORT_DESC,);
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            '*', // add all of the other columns as sortable
        );
        */
         
		$topics_comments = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>false,
            //'pagination'=>array('pageSize'=>15),
            'sort'=>$sort,
		));
        //echo "ddddq";exit;
        // ============ END :: TOPIC COMMENTS =================== //
        
        // ============ START :: RULE COMMENTS =================== //
        
        $rulecriteria=new CDbCriteria;
        $rulecriteria->compare('comment',$this->comment,true);
        $rulecriteria->compare('user_id',$this->user_id);
		$rulecriteria->compare('status',$this->status);
        
		/*$rulecriteria->compare('id',$this->id);
		//$rulecriteria->compare('topic_id',$this->topic_id);
		$rulecriteria->compare('comment_id',$this->comment_id);
        $rulecriteria->compare('main_comment_id',$this->main_comment_id);        
        $rulecriteria->compare('green_flag',$this->green_flag);
        $rulecriteria->compare('red_flag',$this->red_flag);
        $rulecriteria->compare('block_flag',$this->block_flag);
        $rulecriteria->compare('hide_post',$this->hide_post);		//$rulecriteria->compare('type_tag_id',$this->topic_id);
        //$rulecriteria->with = array('user_hide_post_comment');*/
        /*$sort = new CSort();
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            '*', // add all of the other columns as sortable
        );*/
        
		$rule_comments = new CActiveDataProvider('TypeTagsComment', array(
			'criteria'=>$rulecriteria,
            'pagination'=>false,
		));
               
        // ============ END :: RULE COMMENTS =================== //
        

        // ============ START :: TEAM COMMENTS =================== //
        
        $teamcriteria=new CDbCriteria;
        $teamcriteria->compare('comment',$this->comment,true);
        $teamcriteria->compare('user_id',$this->user_id);
		$teamcriteria->compare('status',$this->status);
        
        /*$teamcriteria->compare('id',$this->id);
		//$teamcriteria->compare('topic_id',$this->topic_id);
		$teamcriteria->compare('comment_id',$this->comment_id);
        $teamcriteria->compare('main_comment_id',$this->main_comment_id);        
        $teamcriteria->compare('green_flag',$this->green_flag);
        $teamcriteria->compare('red_flag',$this->red_flag);
        $teamcriteria->compare('block_flag',$this->block_flag);
        $teamcriteria->compare('hide_post',$this->hide_post);		//$rulecriteria->compare('type_tag_id',$this->topic_id);
        //$teamcriteria->with = array('user_hide_post_comment');*/
        /*$sort = new CSort();
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            '*', // add all of the other columns as sortable
        );*/
        
		$team_comments = new CActiveDataProvider('TeamComment', array(
			'criteria'=>$teamcriteria,
            'pagination'=>false,
            
		));
        //echo "<pre>";
        //print_r($team_comments);exit;       
        // ============ END :: TEAM COMMENTS =================== //




        //echo "<pre>";
        //print_r($rule_comments);exit;

        //echo $topics_comments->totalItemCount;
        $records = array();
        for ($i = 0; $i < $topics_comments->totalItemCount; $i++) {
            $data = $topics_comments->data[$i];
            array_push($records, $data);
        }
        for ($i = 0; $i < $rule_comments->totalItemCount; $i++) {
            $data = $rule_comments->data[$i];
            array_push($records, $data);
        }
        
        //echo $team_comments->totalItemCount;
        for ($i = 0; $i < $team_comments->totalItemCount; $i++) {
            $data = $team_comments->data[$i];
            array_push($records, $data);
        }        

        //echo "<pre>";
        //print_r($records);exit; 
        //or you could use $records=array_merge($prov1->data , $prov2->data);
        //echo "<pre>";
        //print_r($records);exit;
        /*$sort = new CSort();
        $sort->defaultOrder=array('red_flag'=>CSort::SORT_DESC,);
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'green_flag ASC',
                'desc'=>'green_flag DESC',
            ),
            'red_flag'=>array(
                'asc'=>'red_flag ASC',
                'desc'=>'red_flag DESC',
            ),
            
            '*', // add all of the other columns as sortable
        );*/
        
        return new CArrayDataProvider($records,
                array(
                    //'sort' =>$sort,
                    //'pagination'=>array('pageSize'=>10),
                )
        );
    }
    
    
    
    
    
    
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->condition = '1=1';
		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('topic_id',$this->topic_id);
        $criteria->compare('comment',$this->comment,true);
		$criteria->compare('comment_id',$this->comment_id);
        $criteria->compare('main_comment_id',$this->main_comment_id);        
        $criteria->compare('status',$this->status);
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('red_flag',$this->red_flag);
        //$criteria->with = array('user_green_comment');
        if(isset($this->topic_main_id) && $this->topic_main_id > 0){
            $criteria->condition .= ' AND topic_id='.$this->topic_main_id;    
        }
        $sort = new CSort();
        //$sort->defaultOrder=array('green_flag'=>CSort::SORT_DESC,);
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_comment_id) from user_comment_flag
                        WHERE user_comment_flag.user_comment_id = t.id AND user_comment_flag.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            '*', // add all of the other columns as sortable
        );
        
        
        
        
        //$criteria->order = 'id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}    
    
    
}