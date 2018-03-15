//=== START: SET COMMONLY USED STRING VALUES =================================//
var error_select = "Please select atleast one record.";
//=== END: SET COMMONLY USED STRING VALUES ===================================//

//=== START: SET ACTION AND SUBMIT FORM TO CHANGE STATUS AND DELETE RECORDS ==//
function active_records(){ 
    var selected_ids = getSelectedItems();
    if(selected_ids!=""){
         var r=confirm("Do you want to Activate these items!");
         if (r==true){
               submit_form("active", selected_ids);
         }else{
               return false;
         }
    }else{
         alert(error_select);
         return false;
    }

}
function inactive_records(){
   var selected_ids = getSelectedItems();
   if(selected_ids!=""){
         var r=confirm("Do you want to Deactivate these items!");
         if (r==true){
              submit_form("inactive", selected_ids);
         }else{
              return false;
         }
  }else{
         alert(error_select);
         return false;
  }
}
function delete_records(){  
   var selected_ids = getSelectedItems();
   if(selected_ids!=""){
         var r=confirm("Do you want to Delete these items!");
         if (r==true){
             submit_form("delete", selected_ids);
         }else{
             return false;
         }
   }else{
           alert(error_select);
           return false;
   }
}
function hide_post(){ 
    var selected_ids = getSelectedItems();
    if(selected_ids!=""){
         var r=confirm("Do you want to Hide this Post!");
         if (r==true){
               submit_form("hide_post", selected_ids);
         }else{
               return false;
         }
    }else{
         alert(error_select);
         return false;
    }

}
function block_Users(){
   var selected_ids = getSelectedItems();
   if(selected_ids!=""){
         var r=confirm("Do you want to Block these Users!");
         if (r==true){
              submit_form("block_Users", selected_ids);
         }else{
              return false;
         }
  }else{
         alert(error_select);
         return false;
  }
}
function active_admins(){
   var selected_ids = getSelectedItems();
   if(selected_ids!=""){
         var r=confirm("Do you want to Add Admin these Users!");
         if (r==true){
              submit_form("active_admins", selected_ids);
         }else{
              return false;
         }
  }else{
         alert(error_select);
         return false;
  }
}
function inactive_admins(){
   var selected_ids = getSelectedItems();
   if(selected_ids!=""){
         var r=confirm("Do you want to Remove Admin these Users!");
         if (r==true){
              submit_form("inactive_admins", selected_ids);
         }else{
              return false;
         }
  }else{
         alert(error_select);
         return false;
  }
}

function submit_form(submit_action, selected_ids){
   document.getElementById('selected_ids').value = selected_ids;
	document.getElementById('action_type').value = submit_action;
	document.checked_items.submit();
}
//=== END: SET ACTION AND SUBMIT FORM TO CHANGE STATUS AND DELETE RECORDS ====//

//=== START: GET CHECKED RECORD IDS ================================//
function getSelectedItems(){
	var checkBoxArray = document.getElementsByName('id[]') ;

	var values = new Array() ;
	var i = 0 , j = 0 ;
	for ( i = 0 ; i < checkBoxArray.length ; i++ ){
		if ( checkBoxArray[i].checked ){
			values[j++] = checkBoxArray[i].value ;
		}
	}

	var comma_separated_list = "" ;
    for ( i = 0 ; i < values.length ; i++ ){
        if ( i != (values.length-1) ){
            comma_separated_list += (values[i] + ',') ;      
        }else{  /* Don't add comma after the last value in the list.*/
        	comma_separated_list += values[i] ;
        }
    }
	return comma_separated_list ;
}
//=== END: GET CHECKED RECORD IDS ==================================//

function getSelectedItemschecked(){
	var checkBoxArray = document.getElementsByName('id[]') ;
	var values = new Array() ;
	var i = 0 , j = 0 ;
	for ( i = 0 ; i < checkBoxArray.length ; i++ ){
		if ( checkBoxArray[i].checked ){
			values[j++] = checkBoxArray[i].value ;
		}
	}
    return values ;
}	

function deleteSelectedItems(){
    var selected_items = getSelectedItems() ;			
	var checkBoxArray = getSelectedItemschecked();
	if( selected_items != "" ){
		if(confirm('Are you sure want to delete selected '+checkBoxArray.length+' record')){
			document.getElementById("list_container").value = selected_items ;
			document.delete_items_form.submit() ;
	    }
    }else{
        alert('No record selected.');
    }       
}

function deActiveSelectedItems(){
	var selected_items = getSelectedItems() ;
	var checkBoxArray = getSelectedItemschecked();			
	if( selected_items != "" ){
		if(confirm('Are you sure want to de-active selected '+checkBoxArray.length+' record')){
	        document.getElementById("list_deactive_container").value = selected_items ;
			document.deactive_items_form.submit() ;
		}
    }else{
	  alert('Please Select at least one record');
      return false;
	}
}

function activeSelectedItems(){
	var selected_items = getSelectedItems() ;			
	var checkBoxArray = getSelectedItemschecked();
	if( selected_items != "" ){
		if(confirm('Are you sure want to Active selected '+checkBoxArray.length+' record')){
	        document.getElementById("list_active_container").value = selected_items ;       
			document.active_items_form.submit() ;
		}
    }else{
	  alert('Please Select at least one record');
      return false;
	}
}

function getSelectedItem(){
	/* Getting values for all the selected check-boxes in this page.*/
	var checkBoxArray = document.getElementsByName('id[]') ;
    var values = new Array() ;
	var i = 0 , j = 0 ;
	for( i = 0 ; i < checkBoxArray.length ; i++ ){
		if( checkBoxArray[i].checked ){
			values[j++] = checkBoxArray[i].value ;
		}
	}

	if(values.length>1){
    	alert('Please Select only one record');
    	return false;
    }else{
		var comma_separated_list = "" ;
        for( i = 0 ; i < values.length ; i++ ){
            if( i != (values.length-1) ){
                comma_separated_list += (values[i] + ',') ;      
            }else{  /* Don't add comma after the last value in the list.*/
            	comma_separated_list += values[i] ;
            }
        }
		return comma_separated_list ;
   }
}
