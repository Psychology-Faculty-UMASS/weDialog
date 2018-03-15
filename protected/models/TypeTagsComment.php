<?php

/**
 * This is the model class for table "type_tags_comment".
 *
 * The followings are the available columns in table 'type_tags_comment':
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_tag_id
 * @property string $comment
 * @property integer $main_comment_id
 * @property integer $comment_id
 * @property integer $like
 * @property integer $dislike
 * @property string $likedislikeids
 * @property integer $status
 * @property string $created_date
 */
class TypeTagsComment extends CActiveRecord
{
      public $flag_type_main_id;
      public $green_flag;
      public $red_flag;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TypeTagsComment the static model class
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
		return 'type_tags_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, type_tag_id, comment', 'required'),
			array('user_id, type_tag_id, main_comment_id, comment_id, like, dislike, status', 'numerical', 'integerOnly'=>true),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
			array('comment_id, like, likedislikeids, created_date','safe'),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, type_tag_id, comment, main_comment_id, comment_id, like, dislike, likedislikeids, status, created_date', 'safe', 'on'=>'search'),
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
            'comment_to_tag_type_relation'=>array(self::BELONGS_TO,'TypeTags','type_tag_id'),
            'user_comment'=>array(self::BELONGS_TO,'Users','user_id'),
            'user_other_comment'=>array(self::BELONGS_TO,'TypeTagsComment','comment_id'),
            'user_main_comment'=>array(self::HAS_MANY,'TypeTagsComment','comment_id','condition'=>'comment_id != 0'),
            'user_main_comment_list'=>array(self::HAS_MANY,'TypeTagsComment','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'type_tags_green_comment'=>array(self::HAS_MANY,'TypeTagsCommentFlag','type_tags_comment_id', 'condition'=>'flag_type="Green" AND flag_status=1'),
            'type_tags_red_comment'=>array(self::HAS_MANY,'TypeTagsCommentFlag','type_tags_comment_id', 'condition'=>'flag_type="Red" AND flag_status=1'),
            'type_tags_block_comment'=>array(self::HAS_MANY,'TypeTagsCommentFlag','type_tags_comment_id', 'condition'=>'block_user=1 AND flag_status=1'),
            'type_tags_hide_comment'=>array(self::HAS_MANY,'TypeTagsCommentFlag','type_tags_comment_id', 'condition'=>'hide_post=1 AND flag_status=1'),
		
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
			'type_tag_id' => 'Type Tag',
			'comment' => 'Comment',
			'main_comment_id' => 'Main Comment',
			'comment_id' => 'Comment',
			'like' => 'Like',
			'dislike' => 'Dislike',
			'likedislikeids' => 'Likedislikeids',
			'status' => 'Status',
			'created_date' => 'Created Date',
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
		$criteria->compare('type_tag_id',$this->type_tag_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('main_comment_id',$this->main_comment_id);
		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('like',$this->like);
		$criteria->compare('dislike',$this->dislike);
		$criteria->compare('likedislikeids',$this->likedislikeids,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('main_comment_id',$this->main_comment_id);        
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('red_flag',$this->red_flag);
    
        if(isset($this->flag_type_main_id) && $this->flag_type_main_id > 0){
            $criteria->condition .= ' AND type_tag_id='.$this->flag_type_main_id;    
        }
        $sort = new CSort();
        //$sort->defaultOrder=array('green_flag'=>CSort::SORT_DESC,);
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(type_tags_comment_id) from type_tags_comment_flag
                        WHERE type_tags_comment_flag.type_tags_comment_id = t.id AND type_tags_comment_flag.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(type_tags_comment_id) from type_tags_comment_flag
                        WHERE type_tags_comment_flag.type_tags_comment_id = t.id AND type_tags_comment_flag.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(type_tags_comment_id) from type_tags_comment_flag
                        WHERE type_tags_comment_flag.type_tags_comment_id = t.id AND type_tags_comment_flag.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(type_tags_comment_id) from type_tags_comment_flag
                        WHERE type_tags_comment_flag.type_tags_comment_id = t.id AND type_tags_comment_flag.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            '*', // add all of the other columns as sortable
        );
        
		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}
}