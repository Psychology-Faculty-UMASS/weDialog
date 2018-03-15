<?php

/**
 * This is the model class for table "team_comment".
 *
 * The followings are the available columns in table 'team_comment':
 * @property integer $id
 * @property integer $user_id
 * @property integer $team_id
 * @property string $comment
 * @property integer $main_comment_id
 * @property integer $comment_id
 * @property integer $like
 * @property integer $dislike
 * @property integer $status
 * @property string $created_date
 */
class TeamComment extends CActiveRecord
{
    public $team_main_id;
      public $green_flag;
      public $red_flag;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TeamComment the static model class
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
		return 'team_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('team_id, comment, comment_id', 'required'),
			array('user_id, team_id, main_comment_id, comment_id, like, dislike, status', 'numerical', 'integerOnly'=>true),
			array('created_date','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false),
			array('likedislikeids,user_id,created_date','safe'),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,likedislikeids, user_id, team_id, comment, main_comment_id, comment_id, like, dislike, status, created_date', 'safe', 'on'=>'search'),
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
            'comment_to_team_relation'=>array(self::BELONGS_TO,'Team','team_id'),
            'comment_to_user_relation'=>array(self::BELONGS_TO,'Users','user_id'),
            'user_comment'=>array(self::BELONGS_TO,'Users','user_id'),
            'user_other_comment'=>array(self::BELONGS_TO,'TeamComment','comment_id'),            
            'team_main_comment'=>array(self::HAS_MANY,'TeamComment','comment_id','condition'=>'comment_id != 0'),
            'team_main_comment_list'=>array(self::HAS_MANY,'TeamComment','main_comment_id','condition'=>'comment_id != 0 AND main_comment_id!=0'),
            'team_green_comment'=>array(self::HAS_MANY,'TeamCommentFlag','team_comment_id', 'condition'=>'flag_type="Green" AND flag_status=1'),
            'team_red_comment'=>array(self::HAS_MANY,'TeamCommentFlag','team_comment_id', 'condition'=>'flag_type="Red" AND flag_status=1'),
            'team_block_comment'=>array(self::HAS_MANY,'TeamCommentFlag','team_comment_id', 'condition'=>'block_user=1 AND flag_status=1'),
            'team_hide_comment'=>array(self::HAS_MANY,'TeamCommentFlag','team_comment_id', 'condition'=>'hide_post=1 AND flag_status=1'),
		
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
			'team_id' => 'Team',
			'comment' => 'Comment',
			'main_comment_id' => 'Main Comment',
			'comment_id' => 'Comment',
			'like' => 'Like',
			'dislike' => 'Dislike',
            'likedislikeids'=>'likedislikeids',
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
		$criteria->compare('team_id',$this->team_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('main_comment_id',$this->main_comment_id);
		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('like',$this->like);
		$criteria->compare('dislike',$this->dislike);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
              
        $criteria->compare('green_flag',$this->green_flag);
        $criteria->compare('red_flag',$this->red_flag);
        
        if(isset($this->team_main_id) && $this->team_main_id > 0){
            $criteria->condition .= ' AND team_id='.$this->team_main_id;    
        }
        $sort = new CSort();
        //$sort->defaultOrder=array('green_flag'=>CSort::SORT_DESC,);
        $sort->attributes = array(
            'green_flag'=>array(
                'asc'=>'(SELECT COUNT(team_comment_id) from team_comment_flag
                        WHERE team_comment_flag.team_comment_id = t.id AND team_comment_flag.flag_type="Green" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(team_comment_id) from team_comment_flag
                        WHERE team_comment_flag.team_comment_id = t.id AND team_comment_flag.flag_type="Green" LIMIT 0,1) DESC',
            ),
            'red_flag'=>array(
                'asc'=>'(SELECT COUNT(team_comment_id) from team_comment_flag
                        WHERE team_comment_flag.team_comment_id = t.id AND team_comment_flag.flag_type="Red" LIMIT 0,1) ASC',
                'desc'=>'(SELECT COUNT(team_comment_id) from team_comment_flag
                        WHERE team_comment_flag.team_comment_id = t.id AND team_comment_flag.flag_type="Red" LIMIT 0,1) DESC',
            ),
            
            '*',
        );
        
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}
}