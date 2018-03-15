<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $facebook_id
 * @property string $twitter_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $user_description
 * @property string $facebook_link
 * @property string $twitter_link
 * @property string $website_link
 * @property string $created_date
 * @property string $status
 * @property string $token
 */
class Users extends CActiveRecord
{
    public $Totalcount;
    public $Totalcommentscount;
    public $Totalpostscount;
    public $Peoplescore;
    public $posts;
    public $red_flag;
    public $user_total_comments;
    public $red_flag_avg;
    public $block_flag;
    public $block_flag_avg;
    public $green_flag;
    public $green_flag_avg;
    public $agree;
    public $disagree;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
            array('email', 'unique','message'=>"Email already exists."),
            array('email','email'),
			array('group_id,facebook_id, twitter_id, special_id, username,profile_image, password, email, facebook_link, twitter_link, website_link', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('ip_address','safe'),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('disagree,agree,green_flag_avg,green_flag,block_flag_avg,block_flag,red_flag_avg,red_flag,posts,id,group_id, facebook_id, twitter_id, username,profile_image, password, email, user_description, facebook_link, twitter_link, website_link, created_date, status,token,aiia_discriptor,favorite_rule,category_groups_id,category_groups_id_hide,special_id', 'safe', 'on'=>'search'),
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
            'user_topics_relation'=>array(self::HAS_MANY,'Topics','user_id'),
            'user_all_post_relation'=>array(self::HAS_MANY,'AllPosts','user_id','condition'=>'status=1','order'=>'created_date DESC'),
            //'user_all_post_relation'=>array(self::HAS_MANY,'AllPosts','user_id'),
            
            'user_all_post_green_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','commented_by','condition'=>'flag_type="Green"'),
            'user_all_post_red_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','commented_by','condition'=>'flag_type="Red"'),
            'user_all_post_block_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','commented_by','condition'=>'block_user=1'),
            'user_all_post_hide_post_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','commented_by','condition'=>'hide_post=1'),
        
            
            /*
            'user_topic_comment_flag_relation'=>array(self::HAS_MANY,'UserCommentFlag','user_id'),
            'user_rule_comment_flag_relation'=>array(self::HAS_MANY,'TypeTagsCommentFlag','user_id'),
            'user_team_comment_flag_relation'=>array(self::HAS_MANY,'TeamCommentFlag','user_id'),
            
            'topic_green_flag_for_user_relation'=>array(self::HAS_MANY,'UserCommentFlag','commented_by','condition'=>'flag_type="Green"'),
            'topic_red_flag_for_user_relation'=>array(self::HAS_MANY,'UserCommentFlag','commented_by','condition'=>'flag_type="Red"'),
            'topic_red_flag_for_block_user_relation'=>array(self::HAS_MANY,'UserCommentFlag','commented_by','condition'=>'block_user=1'),
            'topic_red_flag_for_hide_user_relation'=>array(self::HAS_MANY,'UserCommentFlag','commented_by','condition'=>'hide_post=1'),
            
            'rule_green_flag_for_user_relation'=>array(self::HAS_MANY,'TypeTagsCommentFlag','commented_by','condition'=>'flag_type="Green"'),
            'rule_red_flag_for_user_relation'=>array(self::HAS_MANY,'TypeTagsCommentFlag','commented_by','condition'=>'flag_type="Red"'),
            'rule_red_flag_for_block_user_relation'=>array(self::HAS_MANY,'TypeTagsCommentFlag','commented_by','condition'=>'block_user=1'),
            'rule_red_flag_for_hide_user_relation'=>array(self::HAS_MANY,'TypeTagsCommentFlag','commented_by','condition'=>'hide_post=1'),
            
            'team_green_flag_for_user_relation'=>array(self::HAS_MANY,'TeamCommentFlag','commented_by','condition'=>'flag_type="Green"'),
            'team_red_flag_for_user_relation'=>array(self::HAS_MANY,'TeamCommentFlag','commented_by','condition'=>'flag_type="Red"'),
            'team_red_flag_for_block_user_relation'=>array(self::HAS_MANY,'TeamCommentFlag','commented_by','condition'=>'block_user=1'),
            'team_red_flag_for_hide_user_relation'=>array(self::HAS_MANY,'TeamCommentFlag','commented_by','condition'=>'hide_post=1'),
            */
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'group_id' => 'Group',
			'facebook_id' => 'Facebook',
			'twitter_id' => 'Twitter',
			'username' => 'Username',
            'profile_image' => 'Profile Image',
			'password' => 'Password',
			'email' => 'Email',
			'user_description' => 'User Description',
			'facebook_link' => 'Facebook Link',
			'twitter_link' => 'Twitter Link',
			'website_link' => 'Website Link',
			'created_date' => 'Created Date',
			'status' => 'Status',
            'token' => 'Token',
            'posts' => 'Posts',
            'red_flag'=>'Red Flags',
            'red_flag_avg'=>'RF/P',
            'block_flag' =>'Blocks',
            'block_flag_avg'=>'B/RF',
            'green_flag' => 'Green Flag',
            'green_flag_avg'=>'GF/P',
            'agree'=>'Agree',
            'disagree'=>'Disagree',
            'aiia_discriptor'=>'AIIA Discriptor',
            'favorite_rule'=>'Favorite Rule',
            'category_groups_id'=>'Category Groups',
            'category_groups_id_hide'=>'Category Groups Hide',
            'ip_address'=>'IpAddress',
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
        //$posts = (count($this->user_topic_comment_relation) + count($this->user_rule_comment_relation) + count($this->user_team_comment_relation));
        //$model = new Users;
        //$posts = count($model->user_topic_comment_relation);
		
        $criteria = new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
                $criteria->compare('special_id',$this->special_id,true);
		$criteria->compare('username',$this->username,true);
        $criteria->compare('profile_image',$this->profile_image,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_description',$this->user_description,true);
		$criteria->compare('facebook_link',$this->facebook_link,true);
		$criteria->compare('twitter_link',$this->twitter_link,true);
		$criteria->compare('website_link',$this->website_link,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('posts',$this->posts);
        $criteria->compare('red_flag',$this->red_flag);
        $criteria->compare('red_flag_avg',$this->red_flag_avg);
        $criteria->compare('block_flag',$this->block_flag);
        $criteria->compare('block_flag_avg',$this->block_flag_avg);
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('green_flag_avg',$this->green_flag_avg);
        $criteria->compare('agree',$this->agree);
        $criteria->compare('disagree',$this->disagree);
        $criteria->compare('aiia_discriptor',$this->aiia_discriptor,true);
        $criteria->compare('favorite_rule',$this->favorite_rule,true);
		$criteria->compare('category_groups_id',$this->category_groups_id,true);
        $criteria->compare('category_groups_id_hide',$this->category_groups_id_hide,true);
		
        $sort = new CSort();
        $sort->defaultOrder='created_date DESC'; 
        //$sort->defaultOrder=array('green_flag'=>CSort::SORT_DESC,);
        $sort->attributes = array( 
            // =========== STRAT :: ALL POSTS ASC - DESC SHORTING ============ //
            'posts'=>array(
                'asc'=>'(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1) DESC',
            ),
            
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            'red_flag_avg'=>array(
                'asc'=>'((SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) * 100/(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1)) ASC',
                'desc'=>'((SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) * 100/(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1)) DESC',
            ),
                        
            'block_flag'=>array(
                'asc'=>'(SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.block_user=1 LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.block_user=1 LIMIT 0,1) DESC',
            ),
            
            'block_flag_avg'=>array(
                'asc'=>'((SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.block_user=1 LIMIT 0,1)  * 100/(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1)) ASC',
                'desc'=>'((SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.block_user=1 LIMIT 0,1)  * 100/(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1)) DESC',
            ),
            
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Green" LIMIT 0,1) DESC',
            ),
            
            'green_flag_avg'=>array(
                'asc'=>'((SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Green" LIMIT 0,1) * 100/(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1)) ASC',
                'desc'=>'((SELECT COUNT(commented_by) from all_posts_flags WHERE all_posts_flags.commented_by = t.id AND all_posts_flags.flag_type="Green" LIMIT 0,1) * 100/(SELECT COUNT(user_id) from all_posts WHERE all_posts.user_id = t.id LIMIT 0,1)) DESC',
            ),
            'agree'=>array(
                'asc'=>'(SELECT SUM(all_posts.like) FROM all_posts WHERE all_posts.user_id=t.id) ASC',
                'desc'=>'(SELECT SUM(all_posts.like) FROM all_posts WHERE all_posts.user_id=t.id) DESC',
            ),
            'disagree'=>array(
                'asc'=>'(SELECT SUM(all_posts.dislike) FROM all_posts WHERE all_posts.user_id=t.id) ASC',
                'desc'=>'(SELECT SUM(all_posts.dislike) FROM all_posts WHERE all_posts.user_id=t.id) DESC',
            ),
            
            // =========== END :: ALL POSTS ASC - DESC SHORTING ============ //
            '*', // add all of the other columns as sortable
        );        
        
        
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'sort'=>$sort,
		));
	}
    
    public function searchadmin(){
        
        
        $criteria = new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
        $criteria->compare('special_id',$this->special_id,true);
		$criteria->compare('username',$this->username,true);
        $criteria->compare('profile_image',$this->profile_image,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_description',$this->user_description,true);
		$criteria->compare('facebook_link',$this->facebook_link,true);
		$criteria->compare('twitter_link',$this->twitter_link,true);
		$criteria->compare('website_link',$this->website_link,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('posts',$this->posts);
        $criteria->compare('red_flag',$this->red_flag);
        $criteria->compare('red_flag_avg',$this->red_flag_avg);
        $criteria->compare('block_flag',$this->block_flag);
        $criteria->compare('block_flag_avg',$this->block_flag_avg);
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('green_flag_avg',$this->green_flag_avg);
        $criteria->compare('agree',$this->agree);
        $criteria->compare('disagree',$this->disagree);
        $criteria->compare('aiia_discriptor',$this->aiia_discriptor,true);
        $criteria->compare('favorite_rule',$this->favorite_rule,true);
		$criteria->compare('category_groups_id',$this->category_groups_id,true);
        $criteria->compare('category_groups_id_hide',$this->category_groups_id_hide,true);
		
        
        $criteria->condition = "1=1 AND group_id=3";
        
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function IsUniqueUsername()
    {
        if ( Users::model()->exists('username = :username',array(':username'=>$this->username)) ) {
            $this->addError('username','Username already exists.Please try a different username.');
            return false;
        } else {
            return true;
        }
    }

    protected function beforeSave()
    {
        if(parent::beforeSave() && $this->isNewRecord){
            $this->password = md5($this->password);   
        }
        return true;
        // return parent::afterValidate();
    }
}