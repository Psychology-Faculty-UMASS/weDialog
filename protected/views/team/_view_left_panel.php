<div class="rules">
    <a href="javascript:void(0);" id="click_myteam" style="text-decoration: none;">
    	<input type="button" value="My Team" class="topic" id="selected"/>
    </a>
    <a href="javascript:void(0);" id="click_popular" style="text-decoration: none;">
    	<input type="button" value="Popular" class="topic" id="selected_popular"/>
    </a>
    <div id="myteam_left" style="display: block;padding-top: 10px;">
    <ul>
      <?php foreach($my_team_model as $my_team){?>
        <li> 
            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('team/viewteam',array('id'=>$my_team->id))?>">
        		<?php echo substr($my_team->name,0, 54) ?>
        	</a>        
        </li>
      <?php } ?>
    
    </ul>
    </div>
    <div id="team_popular_left" style="display:none ;padding-top: 10px;">
        <ul>
        <?php foreach($popular_team_model as $popular_team){?>            
        <li>
            <a style="vertical-align: top; font: bolder !important;font-size: small;text-decoration: none;color: #125D90;font-size: 12px; " href="<?php echo Yii::app()->createUrl('team/viewteam',array('id'=>$popular_team->id))?>">
             <?php echo substr($popular_team->name,0, 54) ?>
            </a>
        </li>
        <?php } ?>
        </ul>
    </div>
</div>
<script>
    $("#click_myteam,#click_popular").click(function() {
        var ID = $(this).attr("id");
        $("#myteam_left").hide();
        $("#team_popular_left").hide();

        if(ID=='click_myteam'){                                   
            $("#myteam_left").show();
            document.getElementById('selected').style.background= 'none repeat scroll 0 0 #097DD5';
            document.getElementById('selected_popular').style.background= 'none repeat scroll 0 0 #065A95';
        }else if(ID=='click_popular'){
            $("#team_popular_left").show();
            document.getElementById('selected_popular').style.background= 'none repeat scroll 0 0 #097DD5';
            document.getElementById('selected').style.background= 'none repeat scroll 0 0 #065A95';
        }
    });
</script>
