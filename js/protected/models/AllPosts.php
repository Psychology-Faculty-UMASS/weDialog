<?php

/**
 * This is the model class for table "all_posts".
 *
 * The followings are the available columns in table 'all_posts':
 * @property integer $id
 * @property integer $post_type
 * @property integer $main_id
 * @property integer $user_id
 * @property string $comment
 * @property integer $main_comment_id
 * @property integer $comment_id
 * @property integer $like
 * @property integer $dislike
 * @property string $like_ids
 * @property string $dislike_ids
 * @property integer $status
 * @property string $created_date
 */
class AllPosts extends CActiveRecord
{
    public $green_flag;
    public $red_flag;
    public $block_flag;
    public $hide_post;
    public $red_flag_avg;
    public $total;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AllPosts the static model class
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
		return 'all_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('main_id, user_id, comment', 'required'),
			array('post_type, main_id, user_id, main_comment_id, comment_id, like, dislike, status', 'numerical', 'integerOnly'=>true),
			array('created_date','default','value'=>new CDbExpression('NOW()'), 'on'=>'create','setOnEmpty'=>false),
			array('created_date, dislike_ids, like_ids, post_type,ip_address','safe'),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('red_flag_avg,green_flag, red_flag, hide_post, block_flag, id, post_type, main_id, user_id, comment, main_comment_id, comment_id, like, dislike, like_ids, dislike_ids, status, created_date', 'safe', 'on'=>'search'),
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
            
            'topic_table_relation'=>array(self::BELONGS_TO,'Topics','main_id'),
            'topic_main_comment'=>array(self::HAS_MANY,'AllPosts','comment_id','condition'=>'comment_id != 0'),
            'topic_main_comment_list'=>array(self::HAS_MANY,'AllPosts','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'topic_other_comment'=>array(self::BELONGS_TO,'AllPosts','comment_id'),
            'topic_green_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Green" AND flag_status=1 AND post_type=1'),
            'topic_red_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Red" AND flag_status=1 AND post_type=1'),
            'topic_block_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'block_user=1 AND flag_status=1 AND post_type=1'),
            'topic_hide_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'hide_post=1 AND flag_status=1 AND post_type=1'),
            
            'rule_table_relation'=>array(self::BELONGS_TO,'TypeTags','main_id'),
            'rule_main_comment'=>array(self::HAS_MANY,'AllPosts','comment_id','condition'=>'comment_id != 0'),
            'rule_main_comment_list'=>array(self::HAS_MANY,'AllPosts','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'rule_other_comment'=>array(self::BELONGS_TO,'AllPosts','comment_id'),
            'rule_green_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Green" AND flag_status=1 AND post_type=2'),
            'rule_red_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Red" AND flag_status=1 AND post_type=2'),
            'rule_block_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'block_user=1 AND flag_status=1 AND post_type=2'),
            'rule_hide_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'hide_post=1 AND flag_status=1 AND post_type=2'),

            'team_table_relation'=>array(self::BELONGS_TO,'Team','main_id'),
            'team_main_comment'=>array(self::HAS_MANY,'AllPosts','comment_id','condition'=>'comment_id != 0'),
            'team_main_comment_list'=>array(self::HAS_MANY,'AllPosts','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'team_other_comment'=>array(self::BELONGS_TO,'AllPosts','comment_id'),
            'team_green_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Green" AND flag_status=1 AND post_type=3'),
            'team_red_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Red" AND flag_status=1 AND post_type=3'),
            'team_block_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'block_user=1 AND flag_status=1 AND post_type=3'),
            'team_hide_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'hide_post=1 AND flag_status=1 AND post_type=3'),
        
		    'post_to_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id'), 
            'post_to_green_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id','condition'=>'flag_type="Green" AND flag_status=1'), 
            'post_to_red_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id','condition'=>'flag_type="Red" AND flag_status=1'),
            'post_to_block_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id','condition'=>'block_user=1 AND flag_status=1'),
            'post_to_hide_flag_relation'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id','condition'=>'hide_post=1 AND flag_status=1'),
            
            
            'user_main_comment'=>array(self::HAS_MANY,'AllPosts','comment_id','condition'=>'comment_id != 0'),
            'user_main_comment_list'=>array(self::HAS_MANY,'AllPosts','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'user_other_comment'=>array(self::BELONGS_TO,'AllPosts','comment_id'),
            'user_green_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Green" AND flag_status=1'),
            'user_red_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'flag_type="Red" AND flag_status=1'),
            'user_block_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'block_user=1 AND flag_status=1'),
            'user_hide_comment'=>array(self::HAS_MANY,'AllPostsFlags','all_posts_id', 'condition'=>'hide_post=1 AND flag_status=1'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_type' => 'Post Type',
			'main_id' => 'Main',
			'user_id' => 'User',
			'comment' => 'Post',
			'main_comment_id' => 'Main Comment',
			'comment_id' => 'Comment',
			'like' => 'Like',
			'dislike' => 'Dislike',
			'like_ids' => 'Like Ids',
			'dislike_ids' => 'Dislike Ids',
			'status' => 'Status',
			'created_date' => 'Created Date',
            'green_flag'=>'Green Flag',
            'red_flag' =>'Red Flag',
            'red_flag_avg'=>'RF/V',
            'block_flag'=>'Blocks',
            'hide_post' =>'Hide Post',
            'ip_address'=>'Ip Address',
            
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

		$criteria->compare('id',$this->id);
		$criteria->compare('post_type',$this->post_type);
		$criteria->compare('main_id',$this->main_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('main_comment_id',$this->main_comment_id);
		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('like',$this->like);
		$criteria->compare('dislike',$this->dislike);
		$criteria->compare('like_ids',$this->like_ids,true);
		$criteria->compare('dislike_ids',$this->dislike_ids,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('red_flag',$this->red_flag);
        $criteria->compare('block_flag',$this->block_flag);
        $criteria->compare('hide_post',$this->hide_post);
        $criteria->compare('red_flag_avg',$this->red_flag_avg);
        $criteria->compare('ip_address',$this->ip_address,true);
        
        $sort = new CSort();
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) DESC',
            ),
            'block_flag'=>array(
                'asc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.block_user=1 LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.block_user=1 LIMIT 0,1) DESC',
            ),
            'hide_post'=>array(
                'asc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.hide_post=1 LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(all_posts_id) from all_posts_flags
                        WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.hide_post=1 LIMIT 0,1) DESC',
            ),
            'red_flag_avg'=>array(
                'asc'=>'((SELECT COUNT(all_posts_id) from all_posts_flags WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1)  * 100/(SELECT (SUM(all_posts.like) + SUM(all_posts.dislike) ) as total FROM all_posts WHERE all_posts.id=t.id)) ASC',
                'desc'=>'((SELECT COUNT(all_posts_id) from all_posts_flags WHERE all_posts_flags.all_posts_id = t.id AND all_posts_flags.flag_type="Red" LIMIT 0,1) * 100/(SELECT (SUM(all_posts.like) + SUM(all_posts.dislike) ) as total FROM all_posts WHERE all_posts.id=t.id)) DESC',
            ),            
            
            '*', // add all of the other columns as sortable
        );        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' =>$sort,
		));
	}
}