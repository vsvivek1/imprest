
	<?php
 include_once("imprest.class.php");
 include_once("./../class/DBAccess.class.php");

session_start();
//print_r($_SESSION);
//and $_SESSION[previlege_id]==3
//if($_SESSION[aquired]==1  or $_SESSION[user_name]==1064767 or $_SESSION[user_name]==1049921 or $_SESSION[user_name]==1036605 or !($_SESSION[office_code]==$_SESSION[aru_code]  ) )
//if($_SESSION[aquired]==1 or $_SESSION[location_code]==411)

if(1)
//if($_SESSION[aquired]==1  or !($_SESSION[user_name]==1045145) // maintanance

//if($_SESSION[aquired]==1 or $_SESSION[user_name]==1064767 ) //maintanace
 {

//print_r($_SESSION);
	?>
	

	
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- <meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'> -->
<link href="../bootstrap/google-fonts.css" rel="stylesheet">

	<style>
	.mybut2:hover{
 width:125px;
	
	border-radius:85px;
 
  width: 100px;
  
  
  /* Add extra 52px to normal height. Then, 1/2 of that is for top and the other half is for bottom. */
  //height: 452px;
  
  height:120px;
  margin-right:50px;
  
  /* Below we are using -26px ( 1/2 of total "extra' used for height). */
  margin-top: -26px;
  
  /* Make the border color lighter/brighter than non-hover color */
  border: 3px solid #fffff;
 
  /* Add drop shadow effect */
  /*   http://www.webestools.com/css3-box-shadow-generator-css-property-easy-shadows-div-html5-drop-shadow-moz-webkit-shadow-maker.html   */
  -moz-box-shadow:0px 0px 50px 0px #000000;
  -webkit-box-shadow:0px 0px 50px 0px #000000;
  box-shadow:0px 0px 50px 0px #000000;
  
  /* Add curved corners via CSS3 Border radius to popped item that mimic original website effect */
  /*   http://border-radius.com/    */
  -webkit-border-top-left-radius: 10px;
  -webkit-border-top-right-radius: 10px;
  -moz-border-radius-topleft: 10px;
  -moz-border-radius-topright: 10px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  
  /* Give it a higher z-index to it's on top of adjacent items near it. */
  z-index: 10;
}
	
</style>
<style>

.list-inline-item{
	padding:5px;
	
	margin-left:5px;
	margin-bottom:5px;
	
}


.list-group-item{
	font-family: 'Song Myung', serif;
font-size: 5px; 
	}
td{
font-family: 'Song Myung', serif;
font-size: 15px;
}

th{
	
	font-family: 'Open Sans', sans-serif;
	font-size: 16px;
}
caption{
	font-family: 'Open Sans', sans-serif;
	font-size: 16px;
	
}


.tooltip
{
	font-family: 'Jua', sans-serif;
	font-size: 20px;
	
	}
</style>

<style>

@media 
{

#table_cash_book
	{

		border-collapse: collapse;

	}
  
}

</style>
<script src=\"../bootstrap/bootstrap-datepicker.js\"></script>
	 <link href=\"../bootstrap/bootstrap-datepicker.css\" rel=\"stylesheet\" type=\"text/css\">
	 <script src="../bootstrap/Chart.min.js"></script>
	 <script src=\"../bootstrap/bootstrap-datepicker.js\"></script>
	 <link href=\"../bootstrap/bootstrap-datepicker.css\" rel=\"stylesheet\" type=\"text/css\">
	 <script src="../bootstrap/jquery.js"></script>
	 <script src="../bootstrap/Chart.min.js"></script>
</head>




<?php

if($_GET['frombtn']<>'1') { include_once("dbase.php"); 
	
	$navbar_fixed_top='navbar-default';
	
	}else{$navbar_fixed_top='navbar-fixed-top navbar-inverse';
		}
	
include_once("imp_head.php");
include_once("common.class_imp.php");

//chown('imprest_files','saras');

//$str = 'This is an encoded string';
//echo base64_encode($str);


//echo $_SESSION[location_code];
//echo $loccode;


//ini_set('session.gc_maxlifetime', 360000);


?>




<!-- <link rel="stylesheet" href="../bootstrap1/bs4.css"> -->

<!-- <script src="../bootstrap1/bs4-popper.js"></script>
<script src="../bootstrap1/bs4.js"></script> -->

<style>
	
.talktext{
	font-size=15px;
	}	
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>


<style>
#id_ajax_loading{
	
	position:fixed;
	margin:auto;
	text-align:center;
	vertical-align:middle;
	
			       width: 100%;
			        height:100%;
			        margin-top:20%;
			         opacity: 1;
			          z-index:100;
			          display:none;"
	
	
	
	}	
	
	
	
#sideButton li
{
	/*padding:10px;*/
	
	}
.myBut{
	background:none;
	display:block;
	//padding:10px;
	border:none;
	width:75px;
	height:75px;
	border-radius:25px;

	color:#365899;
	//background-color:#4B0082;
	//background-color:violet;
	background-color:#191970;
	//background-color:black;
	//margin
	
	
	
	}


.more{
	//background-image:url("more.png");
	width:100px;
	height:100px;
	
	}

.btn-circle {
  width: 20px;
  height: 20px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
</style>


<style>

.frmSearch {
	border: 1px solid #80F0F0;
	background-color: #88FFFF;
	margin: 2px 0px;
	padding: 30px;
}

.rmu {
	border: 1px solid #A0B0C0;
	background-color: #DDFFFF;
	margin: 2px 0px;
	padding: 40px;
}

country-list {
	float: left;
	list-style: none;
	margin: 0;
	padding: 0;
	width: 190px;
}

country-list li {
	padding: 10px;
	background: #FAFAFA;
	border-bottom: #F0F0F0 1px solid;
}

country-list li:hover {
	background: #F0F0F0;
}

search-box {
	padding: 10px;
	border: #F0F0F0 1px solid;
}

.frmSearch {border: 1px solid #F0F0F0;background-color:#CCFFFF;margin: 2px 0px;padding:40px;}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#suggesstion-box1{padding: 10px;border: #F0F0F0 1px solid;}
</style>


<script>




$(document).on("change","#sel_return_to_office", function(){

	if(branch!=0){
		var branch=$(this).val().split('-')[1];
	// alert(branch);
	var imprest_operation;
switch (branch){
case 1:
	imprest_operation =91;
	break;
case branch>2300 && branch<2341:
	imprest_operation =91; // aee
	break;
case branch>2129 && branch<2347:
	imprest_operation =91; // ae
	break;

	case branch>1100 && branch <1115:
	imprest_operation =191;
	break;

	case branch==2401: 
	case branch==2402: 
	case branch==2403: 
	case branch==2404: 

	// passing offficers
	imprest_operation =193;
	break;

	default :
	imprest_operation =192;
	break;
}
// alert(imprest_operation);

imprest_operation==666;
$("#btn_transfer_imprest").data('imp_operation',imprest_operation);
$("#btn_transfer_imprest").css("display","block");

// alert($("#btn_transfer_imprest").data('imp_operation'));


	}
	
});



$(document).on("click","#btn_transfer_imprest", function(){
	
	// removing has error set if any
		$("#sel_branch").parents("td").removeClass("has-error");
	
	
var ofc_branch=$("#sel_return_to_office").val();
var to_office=ofc_branch.split('-')[0];
var branch_code=ofc_branch.split('-')[1];

// alert(ofc_branch);
// alert(branch_code);
// alert(to_office);

// return false;

	var inReceiversInBox=1;
	
	var imp_op_id=$(this).data('imp_op_id');
	var result_target=$(this).parents(".result_target").attr("id");
	
    var msg=$("#txt_area_voucher_note").val();
    var imprest_ref_id=$("#txt_area_voucher_note").data("imp_ref_id");
    var vouchers=[];
    var vouchers_json = JSON.stringify(vouchers);

	

	
	// alert(imp_operation);  return false;

	
	

	var branch_id=branch_code;	
	
	if($("#txt_area_voucher_note").val()=="")
{
alert("Please write Remarks ");
$("#txt_area_voucher_note").parents("td").addClass("has-error");
 return false;	
}





var imp_operation=$("#btn_transfer_imprest").data('imp_operation');

var aru_code=<?php echo $_SESSION[aru_code];?>

if(to_office==aru_code){

var branch=branch_code;
	switch (branch_code){
case 1:
	imp_operation =91;
	break;
case branch>2300 && branch<2341:
	imp_operation =91; // aee
	break;
case branch>2129 && branch<2347:
	imp_operation =91; // ae
	break;

	case branch>1100 && branch <1115:
	// imprest_operation =191;
	imp_operation =777;
	break;

	case branch==2401: 
	case branch==2402: 
	case branch==2403: 
	case branch==2404: 

	// passing offficers
	// imprest_operation =193;
	imp_operation =777;
	break;

	default :
	// imprest_operation =192;
	imp_operation =777;
	break;
}


}else{
	// var imp_operation=$("#btn_transfer_imprest").data('imp_operation');
	var imp_operation=91;

}




// alert(imp_operation); return false;

//////////////////////////////return to feild new end////////////////////////////////////////////

			
			
			$.ajax({
			url: "imprest_ajax.php",
			cache: false,
			type:'POST',
			data:{option:"btn_fwd_voucher",inReceiversInBox:inReceiversInBox,imp_op_id:imp_op_id,
                imp_operation:imp_operation,to_office:to_office,msg:msg,imprest_ref_id:imprest_ref_id,
                branch_id:branch_id,vouchers_json:vouchers_json},
			beforeSend: show_ajax_loading_image(),
		
			success: function(html){ 
			
			
				$('#div_ajax_out').html(html); 
				stop_ajax_loading_image();
				
				
				
				}
			
			
		});	


		}






//stop_ajax_loading_image();
	



);


</script>



<script>

// $(window).load(function(){
 
//  $("#tbl_remitance_details_final_closing").hide();
//  });

$(document).ready(function(){
//	$("#tbl_remitance_details_final_closing").hide();
 }); 


</script>

<script>
$(document).on("change","#ofc_fil",function(){

var type=$("option:selected",this).text();



if(type!="Select"){

	$("#sel_office option").each(function(){

if($(this).text().includes(type)){

if(type=="Division"){

	//alert(type);
	if($(this).text().includes("Sub")){
		$(this).hide();

	}else{
		$(this).show();

	}

}

	$(this).show();

}
else{
	$(this).hide();

}
}





);
}

});

</script>

<script>

$(document).on("click",".btn_make_live",function () {

var imp_op_id=$(this).data('imp_op_id');
var option="btn_make_live";
$(this).text("Make sleep");
$(this).removeClass("btn btn-success btn_make_live");
var ele=$(this);

$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,imp_op_id:imp_op_id},
				   			   
				    success: function(html){
								ele.addClass("btn btn-warning btn_make_live");
					//	$('#div_ajax_out').html(html); 
						
						  }
				        
    }
);

});
$(document).on("click",".btn_make_sleep",function () {

var imp_op_id=$(this).data('imp_op_id');
var option="btn_make_sleep";
$(this).text("Make Live");
$(this).removeClass("btn btn-warning btn_make_sleep");
var ele=$(this);

$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,imp_op_id:imp_op_id},
				   			   
				    success: function(html){
								ele.addClass("btn btn-success btn_make_live");
					//	$('#div_ajax_out').html(html); 
						
						  }
				        
    }
);

});
</script>





<script>
$(document).on("keyup",".item_amount1",function () {
	var balance=$(this).parent("td").next("td").find(".div_budget_alert").attr('name');
var amount=$(this).val();
	var new_balance=balance-amount;
	//var new_balance=balance;
if(new_balance<0){
	$(this).parent("td").next("td").find(".div_budget_alert").html("<span class='fa fa-warning' style='color:red' >&nbsp;Balance in this head :"+new_balance +" </span>");


}else{

	$(this).parent("td").next("td").find(".div_budget_alert").html("<span class='fa fa-check' style='color:green' >&nbsp;Balance in this head :"+new_balance +" </span>");

}


});
</script>


<script>

	/// script for budget check
$(document).on("change",".item_acc_code1",function () {

	

// alert("");

var sel=$(this);

//alert(sel);
var item_acc_code=$(this).val();
// $("#text_empcode").val($(this).val());
				var option="check_budget_provision_of_item_acc_code";
	var office_id=$(this).data("offfice_id");
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,office_id:office_id,item_acc_code:item_acc_code},
				    
					
				    success: function(response){
					//	alert(html);
						
						var new_amount=sel.parent("td").prev("td").find("input").val();
						var out=JSON.parse(response);
						//var out=JSON.parse(response);

						var balance=out.balance;
						var stop=out.stop;
						var new_balance=balance-new_amount;
						//sel.next(".div_budget_alert").attr('name',balance);
						sel.next(".div_budget_alert").attr('name',balance);
						if(stop==1){

							sel.next(".div_budget_alert").data("stop_error",1);
						}else if(stop==0)
						{
							sel.next(".div_budget_alert").data("stop_error",0);

						}
						sel.next(".div_budget_alert").data("stop_error",1);
						sel.next(".div_budget_alert").attr("id",1);
					//	alert(stop);
						if(new_balance<0){
							sel.next(".div_budget_alert").html("<span class='fa fa-warning' style='color:red' >&nbsp;Balance in this head :"+new_balance +" </span>");

						}else{
							sel.next(".div_budget_alert").html("<span class='fa fa-check' style='color:green' >&nbsp;Balance in this head :"+new_balance +" </span>");

						}
					

//console.log(response);
						
						 //$('.div_budget_alert').html(html); 
						 
						 
						 
						 
						  }
				
    
    
    }
);
}
);



</script>




<script>



$(document).on("click",".del_sup",function (){


	$(this).closest("tr").remove();
var len=$(".tr_sup_doc").length;
//alert(len);
	if(len==0){


		$("#btn_submit_supporting_doc").css("display","none");
		
	}
}

);



$(document).on("click","#btn_add_supporting_documents",function (){

	$("#tbody_supporting_list").append(

`<tr class="tr_sup_doc">
<td>
<span class='fa fa-file ' style='color:red'; >&nbsp;Document type</span>
<select class=form-control required=required name=doctype[]>

<option value="">Select</option>
<option value=po>Purchase Order</option>
<option value=e>Estimate</option>
<option value=er>Estimate Report</option>
<option value=es>Estimate Sanction</option>
<option value=wo>Work Order</option>
<option value=ag>Agreement</option>
<option value=wt>Written UnderTaking</option>
<option value=dn>Demand Notice</option>
<option value=o>Others</option>
</select>

</td>
<td>



<input required=required class=sup_file type=file name=supporting_file[]>
</td>
<td>

<button type="button" class="btn del_sup btn-danger">Delete</button>

</td>
</tr>`
	);


	$("#btn_submit_supporting_doc").css("display","block");
	

});

</script>




<script>

///////////////////////////////////show send vouchers

$(document).on("click","#btn_send_alert_sms",function (){



					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"alert_pending_sms"},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						$('#div_ajax_out').html(html); 
						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						//carosal_load();
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);

}
);

$(document).on("click","#btn_alert_pending_sms_to_feild",function (){



					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"alert_pending_sms_to_feild"},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						$('#div_ajax_out').html(html); 
						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						//carosal_load();
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);
$(document).on("click","#btn_show_pending_action",function (){



					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"btn_show_pending_action"},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						$('#div_ajax_out').html(html); 
						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						//carosal_load();
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);

///////////////////////edit vouchers///////////////

</script>
<script>

// $(document).on("click","#btn_edit_landing",function(){

// $("#sel_branch_landing").prop("disabled",false);

// $(this).removeClass("btn-danger").addClass("btn-success");
// $(this).text("Save");
// $(this).attr("id","btn_save_landing");
// });


$(document).on("click","#btn_add_landing_rule",function (){

var $this_table=$("#tbl_landing");
	var $row=$this_table.find(".clone_landing:first");

var $newRow=$row.clone();
//$row.html("<p>ttt</p>");
var row_last=$this_table.find(".clone_landing:last");


row_last.after($newRow);
var row_num=$this_table.find(".clone_landing:last").index()+1;

//alert(row_num);
$this_table.find(".clone_landing:last").find("td:first").html(row_num);

});
$(document).on("click","#btn_create_landing_rule",function (){



$.ajax({
	url: "imprest_ajax.php",
	cache: false,
	 type:'POST',
	data:{option:"btn_create_landing_rule"},
	beforeSend: show_ajax_loading_image(),
 
	success: function(html){
	
	
	$('#div_landing_super_div').html(html); 
	//$('#ajax_modal').html(html);
	///$('#ajax_modal').modal('show'); 
	//carosal_load();
	 stop_ajax_loading_image();  
	 
	 
	 
		}



}
);}
);




$(document).on("click",".btn_edit_landing",function (){

	
	$(this).parents('tr').find('.from_office_landing').prop("disabled",false);
	$(this).parents('tr').find('.imp_type').prop("disabled",false);
	$(this).parents('tr').find('.to_branch_landing').prop("disabled",false);
	$(this).removeClass("btn_edit_landing").addClass("btn_save_imprest_landing");
	$(this).removeClass("btn-warning").addClass("btn-success");
	$(this).text("Save");
});

$(document).on("click",".btn_save_imprest_landing",function (){

var from_office=$(this).parents('tr').find('.from_office_landing').val();
var imp_type=$(this).parents('tr').find('.imp_type').val();
var to_branch=$(this).parents('tr').find('.to_branch_landing').val();
var to_office=$(this).data('office_code');

//alert(to_branch);

//return false;

$.ajax({
	url: "imprest_ajax.php",
	cache: false,
	 type:'POST',
	data:{option:"btn_save_imprest_landing",
		from_office:from_office,
		imp_type:imp_type,
		to_branch:to_branch,
		to_office:to_office
	},
	beforeSend: show_ajax_loading_image(),
 
	success: function(html){
	
	
	//$('#div_landing_super_div').html(html); 
	//$('#ajax_modal').html(html);
	///$('#ajax_modal').modal('show'); 
	//carosal_load();
	 stop_ajax_loading_image();  
	 
	 
	 
		}



}
);}
);




</script>


<script>
var deg1=90;
$(document).on("click","#btn_rotate_image",function(){

deg1=deg1+90;

///var tot=deg1+'deg';
//alert("");


$("div.active").find("img").css({'transform': 'rotate('+deg1 + 'deg)'});
});

</script>



<script>
$(document).on("click","#btn_close_first",function(){

	//alert("");
$("#up").css("display","none");
});


</script>


<script>



function printData()
{
   var divToPrint=document.getElementById("table_cash_book");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$(document).on('click',"#i_print_cash_book",function(){
printData();
})

</script>

<script>
////////////////auto fill description //////////////////////


function fill_description_fresh()
{
	
	var paid_to=$("#txt_paid_to").val();
	var date_of_payment=$("#txt_date_of_payement").val();
	var amount=$("#txt_amount_imprest").val();
	var purpose=$("input[name=purpose]").val();
	var desc="Paid Rupees "+amount+" to "+ paid_to+ " on "+ date_of_payment+ " for " + purpose;
	
	$("#txt_description_imprest").val(desc);
	}
function fill_description()
{
	
	var paid_to=$("#txt_paid_to").val();
	var date_of_payment=$("#txt_date_of_payement").val();
	var amount=$("#txt_amount_imprest").val();
	var purpose=$("input[name=purpose]").val();
	var desc="Paid Rupees "+amount+" to "+ paid_to+ " on "+ date_of_payment+ " for " + purpose;
	
	$("#txt_description_imprest").val(desc);
	}
function fill_description_edit()
{
	
	var paid_to=$("#txt_paid_to1").val();
	var date_of_payment=$("#txt_date_of_payement2").val();
	var amount=$("#txt_amount_imprest1").val();
	var purpose=$("#txt_purpose").val();
	var desc="Paid Rupees "+amount+" to "+ paid_to+ " on "+ date_of_payment+ " for " + purpose;
	
	$("#txt_description_imprest1").val(desc);
	}


function fill_description1()
{
	
	var paid_to=$("#txt_paid_to1").val();
	var date_of_payment=$("#txt_date_of_payement2").val();
	var amount=$("#txt_amount_imprest1").val();
	var purpose=$("#txt_purpose").val();
	var desc="Paid Rupees "+amount+" to "+ paid_to+ " on "+ date_of_payment+ " for " + purpose;
	
	$("#txt_description_imprest1").val(desc);
	}


$(document).on("keyup","#txt_paid_to,#txt_date_of_payement,#txt_amount_imprest,input[name=purpose]",function()

{
	
	if( $("#chk_auto_description").is(':checked'))
	{
	fill_description();
	
}
	});


$(document).on("keyup","#txt_voucher_num1,#txt_paid_to1,#txt_date_of_payement2,#txt_date_of_voucher1,#txt_amount_imprest1,#txt_purpose",function()

{
	
	fill_description_edit();
	

	});
$(document).on("change","#txt_date_of_payement2",function()

{
	//alert($("#txt_date_of_payement2").val());x
	fill_description_edit();
	

	});



// var purpose1=document.getElementsByName("purpose");
// var purpose=purpose1[0];
// purpose.onpaste=function(e){
//     e.preventDefault();
//     console.log('Paste Event triggered');
// 		fill_description();
// };

$(document).on("keyup","#txt_date_of_payement, #txt_date_of_voucher",function(){

	// $(this).attr('val', '');
	$(this).val('');

});


$(document).on("keyup","#txt_paid_to1,#txt_date_of_payement1,#txt_amount_imprest1,#txt_purpose",function()

{
	
	if( $("#chk_auto_description").is(':checked'))
	{
	fill_description1();
	
}
	});

$(document).on("blur","#txt_amount_imprest",function()

{

	var rounded=Math.round($(this).val());
	
		$(this).val(rounded);

	});


$(document).on("change","#chk_auto_description",function(){
	
	if( $("#chk_auto_description").is(':checked'))
	{
	fill_description();
}else


{
$("#txt_description_imprest").val("");	
}
	
	
	});


</script>

<script>

function save_setting(object,attrib,value){


var option="save_imp_setting";
				
				$.ajax({
				url: "imprest_ajax.php",
				cache: false,
				 type:'POST',
				data:{option:option,attrib:attrib,object:object,value:value},
				beforeSend: show_ajax_loading_image(),
			   
				success: function(html){
					
					alert(html);
					//$('#div_ajax_out').html(html); 
					$('#ajax_modal').html(html);
					$('#ajax_modal').modal('show'); 
					
					 stop_ajax_loading_image();  					 
								  
					  }			


}
);




}


/////////////////////////////////// save landing

$(document).on("click","#btn_save_landing",function () {

var branch_id=$("#sel_branch_landing").val();
var office_id=$(this).data('office_id');
var attrib=1;
var object=office_id;
var value=office_id;



		save_setting(object,attrib,value);

}
);




///////////////////////////////////show related correspondences for fresh request

$(document).on("click",".show_related_correspondences",function () {


var imprest_id_ref=$(this).data("imprest_id_ref");
				var option="show_related_correspondences";
				var voucher_id=$(this).attr('name');
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,imprest_id_ref:imprest_id_ref},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						$('#div_ajax_out').html(html); 
						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						//carosal_load();
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);
///////////////////////////////////show send vouchers

$(document).on("click",".show_send_voucher",function () {


var imprest_id_ref=$(this).data("imprest_id_ref");
				var option="show_send_voucher";
				var voucher_id=$(this).attr('name');
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,imprest_id_ref:imprest_id_ref},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						$('#div_ajax_out').html(html); 
						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						carosal_load();
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);

///////////////////////edit vouchers///////////////

$(document).on("click","#btn_edit_voucher",function () {

				var option="btn_edit_voucher";
				var voucher_id=$(this).attr('name');
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,voucher_id:voucher_id},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_adjustment_sheet1').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);




$(document).on("click","#btn_update_voucher",function () {

				var option="btn_update_voucher";
				var voucher_id=$(this).attr('name');
				var voucher_num=$("#txt_voucher_num1").val();
				var paid_to=$("#txt_paid_to1").val();
				var txt_date_of_payment=$("#txt_date_of_payement2").val();
				var txt_date_of_voucher=$("#txt_date_of_voucher1").val();
				var txt_amount_imprest=$("#txt_amount_imprest1").val();
				var item_acc_head=$("#item_acc_head1").val();
				
				var txt_description_imprest=$("#txt_description_imprest1").val();
				var purpose=$("#txt_purpose").val();
				
				
				var msg="";var error=0;
				
				
				
				if(voucher_num==""){ error=error+1; msg=msg+"\n"+error +". Please Enter The Voucher Number";}
				if(paid_to==""){ error=error+1; msg=msg+"\n"+error +". Please Enter The Payee Name";}
				if(txt_date_of_payment==""){ error=error+1; msg=msg+"\n"+error +". Please Enter The Date of Payment";}
				if(txt_date_of_voucher==""){ error=error+1; msg=msg+"\n"+error +". Please Enter The Date of Voucher";}
				if(txt_amount_imprest==""){ error=error+1; msg=msg+"\n"+error +". Please Enter The Amount";}
				if(item_acc_head==0){ error=error+1; msg=msg+"\n"+error +". Please Enter The Account head";}
				if(txt_description_imprest==""){ error=error+1; msg=msg+"\n"+error +". Please Enter Description";}
				if(purpose==""){ error=error+1; msg=msg+"\n"+error +". Please Enter Purpose";}
				
				if(error>0){ alert(msg); return false;}
				
				
				
				//alert(txt_description_imprest);
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{
						option:option,
						voucher_id:voucher_id,
						voucher_num:voucher_num,
						paid_to:paid_to,
						txt_date_of_payment:txt_date_of_payment,
						txt_date_of_voucher:txt_date_of_voucher,
						txt_amount_imprest:txt_amount_imprest,
						item_acc_head:item_acc_head,
						txt_description_imprest:txt_description_imprest,
						purpose:purpose
						
						
						
						
						
						
						},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_adjustment_sheet1').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);

</script>


<script>


/////////////////////////////////// reports ////////////////////////////

$(document).on("click","#btn_show_reports",function () {

				var option="btn_show_reports";
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);
/////////////////////////////////// super admin////////////////////////////

$(document).on("click","#btn_show_super_admin",function () {


// alert("");
				var option="btn_show_super_admin";
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);

$(document).on("click",".span_aquire_session",function () {


// alert("");
var id=$(this).attr('id');
				var option="span_aquire_session";
	var empcode=$("#text_empcode").val();
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,id:id},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);
$(document).on("change","#sel_empcode",function () {


// alert("");
$("#text_empcode").val($(this).val());
	// 			var option="span_list_sessions_for_aquiring";
	// var empcode=$(this).val();
	// 				$.ajax({
	// 			    url: "imprest_ajax.php",
	// 			    cache: false,
	// 			     type:'POST',
	// 			    data:{option:option,empcode:empcode},
	// 			    beforeSend: show_ajax_loading_image(),
				   
	// 			    success: function(html){
						
						
	// 					 $('#div_ajax_out').html(html); 
	// 					 stop_ajax_loading_image();  
						 
						 
						 
	// 					  }
				
    
    
    }
);
$(document).on("change","#sel_office",function () {


// alert("");
// $("#text_empcode").val($(this).val());
				var option="sel_office";
	var office_code=$(this).val();
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,office_code:office_code},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);
}
);




$(document).on("click","#span_list_sessions_for_aquiring",function () {


// alert("");

				var option="span_list_sessions_for_aquiring";
	var empcode=$("#text_empcode").val();
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,empcode:empcode},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html); 
						 stop_ajax_loading_image();  
						 
						 
						 
						  }
				
    
    
    }
);}
);




/////////////function for report of abstract of ARU
$(document).on("click","#btn_report_total_aru",function () {

				var option="btn_report_total_aru";
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: show_ajax_loading_image(),
				    
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html);   
						 stop_ajax_loading_image();
						 
						 
						  }
				
    
    
    }
);}
);




/////////////////////////////////key up  for suggestion of office/////////////////////////

$(document).on("keyup","#txt_search_office",function(){
		
		if($(this).val().length>3){

			var option="txt_search_office";
			
		
		$.ajax({
			
		type: "POST",
		url: "imprest_ajax.php",
		data:{ keyword : $(this).val(), option :option, name:$(this).val(),inp:$(this).attr('id'),sugBox:"suggesstion-box1" },
		beforeSend: function(){
			$("#txt_search_office").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box1").css({"background":"#FFF", "height": "200px","width":"200px","overflow":"auto"});
			$("#suggesstion-box1").show();
			$("#suggesstion-box1").html(data);
			$("#txt_addr_ofc_sale_form").css("background","#FFF");
		}
		});
		
	}	
		
	});



/////////////////////////////////end key up  for suggestion of office/////////////////////////



























//////show cheques issued
$(document).on("click","#btn_show_my_cheque",function () {

				var option="btn_show_my_cheque";
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: show_ajax_loading_image(),
				    
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html);   
						 stop_ajax_loading_image();
						 
						 
						 
						 

						  }
				
    
    
    }
);}
);


/////////////////////////////////////////////////////////////////////////

///////////////////function to show modal for passed amount/////////////////////////

$(document).on("click",".show_voucher",function () {

var option="show_voucher";


var id=$(this).attr("id");


/// pointing carosal to required
var slid="x";
	var voucher_id=id;
	var slid=$("[data-voucher-id='"+voucher_id+"']").index();
	
	//alert(slid);
	
	$(".carousel").carousel(slid);
	//var adjust=$("#div_adjustment_sheet1").html();
//////////////////////////////////////////

	$.ajax({
	url: "imprest_ajax.php",
	cache: false,
	 type:'POST',
	data:{option:option,id:id},
	beforeSend: show_ajax_loading_image(),
	
	success: function(html){
		
		
		 $('#div_modal_voucher').html(html); 
		 stop_ajax_loading_image();

//$('#adj_details').html(adjust); 
		 $('#modal_show_voucher').modal('show');

		
		 
		 
		  }



}
);}
);



// /////////////////////////////////



/////////////function for report of show passed amount

function show_passed_amount(user_name,office_code){

{

var option="btn_report_show_passed_amount";


	$.ajax({
	url: "imprest_ajax.php",
	cache: false,
	 type:'POST',
	data:{option:option,user_name:user_name,office_code:office_code},
	beforeSend: show_ajax_loading_image(),
	
	success: function(html){
		
		
		 $('#div_ajax_out').html(html);   
		 stop_ajax_loading_image();
		 
		 
		  }



}
);}


}



$(document).on("click","#btn_report_show_passed_amount",function (){
	var user_name=$(this).val();
	var office_code=$(this).data('office_code');
show_passed_amount(user_name,office_code);

} 
);
$(document).on("change","#sel_imp_holder_for_passed_amount",function (){
	var user_name=$(this).val();
	var office_code=$(this).find(':selected').attr('data-office_code');
show_passed_amount(user_name,office_code);

} 
);


/////////////////////////////////////////////////////////////////////////
/////////////function for report of abstract of ARU
$(document).on("click","#btn_search_request",function () {

				var option="btn_search_request";
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: show_ajax_loading_image(),
				    
				    success: function(html){
						
						
						 $('#div_ajax_out').html(html);   
						 stop_ajax_loading_image();
						 
						 
						  }
				
    
    
    }
);}
);


/////////////////////////////////////////////////////////////////////////
/////////////function for key up for imprest holder searchf ARU
$(document).on("keyup","#txt_emp_name",function () {

$('#div_report_out').html("");
				var option="txt_emp_name";
	var empname=$(this).val();
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,empname:empname},
				   
				    success: function(html){
						
						
						 $('#div_report_out').html(html);   
						 
						 
						 
						  }
				
    
    
    }
);}
);


//////////////////////////////////////////////////////////////////////////////////////function for key up for imprest holder searchf ARU
/////////////function for click take emp name and return expense report for fy
$(document).on("click",".li_emp_name_exp",function () {

 $('#div_report_out_res').html(""); 
				var option="li_emp_name_exp";
	var entity_id=$(this).attr('id');
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,entity_id:entity_id},
				   
				    success: function(html){
						
						
						  $('#div_report_out_res').html(html);   
						 
						 
						 
						  }
				
    
    
    }
);}
);


//////////////////////////////////////////////////////////////////////////////////////function for key up for imprest holder searchf ARU



$(document).on("keyup",".list_emp",function () {




				
				var empname=$(this).val();
				
	list_employees(empname);

}
);

$(document).on("change","#chk_all_emp",function () {




				if($(this).is(':checked'))
				{
				var empname='ALL';
			}else {var empname=$(this).val();  }
	list_employees(empname);

}
);

$(document).on("change",".auto_text_check_box",function () {




				if($(this).is(':checked'))
				{


var old_val=$("#txt_area_request_temp_imprest").val();
		var new_val=old_val+($(this).val());


		$("#txt_area_request_temp_imprest").val(new_val);
					//alert("checked"+$(this).val());
				
			}else {
				$("#txt_area_request_temp_imprest").val($("#txt_area_request_temp_imprest").val().replace($(this).val(),""));
			//	alert("NOT checked"+$(this).val());
				
				  }


}
);
</script>

<script>
$(document).on("change",".auto_text_check_box_v",function () {

var amount;
var amount=$("#td_total_passed_amount").text();

				if($(this).is(':checked'))
				{


var old_val=$("#txt_area_voucher_note").val();
		var new_val1=old_val+($(this).val());

var new_val=new_val1.replace("Rs","Rs "+ amount+"/-");
		$("#txt_area_voucher_note").val(new_val);
					//alert("checked"+$(this).val());
				
			}else {
				$("#txt_area_voucher_note").val($("#txt_area_voucher_note").val().replace($(this).val(),""));
			//	alert("NOT checked"+$(this).val());
				
				  }


}
);
</script>

<script>


function list_employees(empname){
	
	$('#div_report_out').html("");
	var option="txt_emp_expense_report";
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,empname:empname},
				   
				    success: function(html){
						
						
						 $('#div_report_out').html(html);   
						 
						 
						 
						  }
				
    
    
    }
);
	
	}
	
	
	
	

/////////////////////////////////////////////////////////////////////////

/////////////function botton click to list my  up for imprest for all aru
$(document).on("click","#btn_show_my_imprest",function () {

$('#div_report_out').html("");
				var option="btn_show_my_imprest";
	var empname=$(this).val();
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,empname:empname},
				   
				    success: function(html){
						
						
						 $('#div_report_out').html(html);   
						 
						 
						 
						  }
				
    
    
    }
);}
);


/////////////////////////////////////////////////////////////////////////



/////////////function for key up for imprest holder searchf ARU
$(document).on("click",".li_emp_name",function () {

				var option="li_emp_name";
	var imprest_id_ref=$(this).attr('id');
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option,imprest_id_ref:imprest_id_ref},
				   
				    success: function(html){
						
						
						 $('#div_report_out_res').html(html);   
						 
						 
						 
						  }
				
    
    
    }
);}
);


/////////////////////////////////////////////////////////////////////////



</script>



<SCRIPT>
//CASH BOOK BULK EDITING

/*

$(document).on("click","#btn_save_cashbook_editing",function(){
	
	var ar=[];
		
		var imp_num=$(this).parents(".message").find(".accord_link").data("imprest_id_ref");
		var from_office_code=$(".item.active").data("from_office_code");
		
		$(".voucher").each( function()  {
		
		var voucher_id=$(this).attr("id");
		
		
		
		//alert(imp_num);
		$(this).find(".tr_template").each(function(){
			
		var ar1=
		[
		$(this).index(),
		$(this).find(".item_name").val(),
		$(this).find(".item_amount").val(),
		$(this).find("[name=item_acc_head]").val(),
		$(this).find(".text_area_voucher_remark").val()
		];
		
			ar.push(ar1);
		
		//alert($(this).find("[name=item_acc_head]").val());
		
		});
		
		var json=JSON.stringify(ar);
		
		
		
	var btn=$(this);

if(btn.data("inprogres1")){ return;}
	
	btn.data("inprogres1",true);
	
	//var impType=$("#sel_imprest_type").val();
	//var msg=$("#txt_area_request_perm_imprest").val();
	//var amt=$("#txt_perm_imp_amnt").val();
	
	
	$(".item_name,.item_amount,[name=item_acc_head],.text_area_voucher_remark,.del,#add_item").prop('disabled', true);
	
	$(this).text("Edit");
	
	$(this).removeClass("btn-primary audit_bill");
	$(this).addClass("btn-info edit_audit");
	
	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"audit_bill",json:json,imp_num:imp_num,voucher_id:voucher_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
			
			
			alert("Success");
		//$('#div_ajax_out').html(html); 
		$('#out_put').html(html);
		
		$("#ajax_loading").modal('hide');btn.data("inprogres1",false); 
		 
		
			}
        
});	
	
		
		
		
		
		
	}
	
	
	);
	
	);
	
	
	});

*/

</SCRIPT>


<script>
	
	//function to add new imprest holder in entities
$(document).on("click","#add_imprest_holder",function () {
	
	$(this).prop('disabled', true);
	
	var btn=$(this);

				var option="add_imprest_holder";
	var empcode=$(this).data('empcode');
	var office_code=$(this).data('office-code');
					
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				     beforeSend:show_ajax_loading_image(),
				    data:{option:option,emp_code:empcode,office_code:office_code},
				   
				    success: function(html){
						
						//#000000console.log()
						//alert(html); 
						console.log(html);
						//return;
						var out = JSON.parse(html);
						console.log(out);
						var result=out.result;
						if(result=="ok")
						{
						//var html=out.html;
						var cmbpayee=out.entity_id;
						var cmboffice=out.office_id;
						var eeid=out.eeid;
						//var txtnetAcc=out.txtnetAcc;
						
						
						
						var txtpayee=cmbpayee+"-"+cmboffice;
						var txtnetAcc="24210."+eeid;
						
						//alert(txtpayee);
						$("[name=cmbpayee]").val(cmbpayee);
						$("[name=cmboffice]").val(cmboffice);
						$("[name=txtpayee]").val(txtpayee);
						$("[name=txtnetAcc]").val(txtnetAcc);
						
						$("#div_not_added_as_imp_holder").html("");
						
						stop_ajax_loading_image();
						$("#sub_to_expac").prop("disabled",false);
						
						
					}
					else if(result=="notok")
					
					{

						var a=out.data['err'];
						alert(a);
						alert("Failed to add as  Imprest Holder");
					}

					stop_ajax_loading_image();
						
						 //$('#div_report_out_res').html(html);   
						 
						 
						 
						  }
				
    
    
    }
);}
);


</script>





















<script>
	
function show_in_box(){
	
	
		
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_show_inbox"},
    beforeSend: show_ajax_loading_image(),
  
    success: function(html){ 
	
		
		$('#div_ajax_out').html(html); 
		
		stop_ajax_loading_image();  
		//$('#vivek').html(html);   
		//alert("hi"+ html);
		
		}
    
    
});	
	
	
	
}	
	
$(document).on("click",".btn_remove_sup_doc",function(){

var ele=$(this);
var imp_file_id=$(this).data('imp_file_id');

	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_remove_sup_doc","imp_file_id":imp_file_id},
    beforeSend: show_ajax_loading_image(),
  
    success: function(html){ 
		
		// $('#div_ajax_out').html(html); 
		console.log(html);


		

		if(html) {
    try {
        var resp=JSON.parse(html);
    } catch(e) {
        alert(e); // error in the above string (in this case, yes)!

		return false;
    }
}





		if(resp['result']=='success'){
			// console.log(html);


alert("Removed Supporting Document successfully")

ele.parents('tr').remove();



		}else {
			console.log(html);


			alert(resp['msg']);

			// alert()

		}
		
		stop_ajax_loading_image();  
		
		}
    
    
});	


});



function carosal_load(){
	
	$("#td_voucher_amount").html($(".item.active").data("voucher-amount"));
	
	
	
var voucher_date=$(".item.active").data("voucher-date");
var voucher_payement_date=$(".item.active").data("voucher-date-payment");
	
	
	
	
	$("#td_voucher_date").html(voucher_date.split("-").reverse().join("-"));
	
	$("#td_voucher_payment_date").html(voucher_payement_date.split("-").reverse().join("-"));
	

	
	
	
	
	$("#td_voucher_num").html($(".item.active").data("voucher-number"));
	$("#td_voucher_paid_to").html($(".item.active").data("voucher-payee"));
	$("#td_voucher_acc_head").html($(".item.active").data("voucher-acc-head"));
	
	$("#td_voucher_Desc").html($(".item.active").data("voucher-description"));
	$("#td_voucher_Desc").html($(".item.active").data("voucher-description"));
	$("#lbl_voucher_number").html($(".item.active").data("voucher_number"));
	
	
	
	
	//$("#td_voucher_Desc").html();
	
var purpose=$(".item.active").data("purpose");

if(purpose=='nil'){

	$("#tr_purpose").remove();

//delete

}else
{
	//insert row
	$("#tr_purpose").remove();
	$( '<tr  id=tr_purpose class="text-info lead"> <td colspan=1 class="bg-warning text-info lead">Purpose</td><td colspan=3 id=td_purpose></td>' ).insertAfter("#tr_amountx" );
	$("#td_purpose").html(purpose);

}
	
	
	var tr_id=$(".item.active").data("voucher-id");
	
	var c=document.getElementById(tr_id);
	
	//alert(c);
	
	$(c).css("background-color","grey");
	
	
	//$(c).addClass("bg-success");
	//alert(c);
	
	
	
	/*	
	     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"fill_audit_table_if_exists",imp_voucher_id:$(".item.active").data("voucher-id")},
    beforeSend: function(){ var a=0;},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		//alert(html);   
		
		$("#div_adjustment_sheet").html(html);
		
	//$(".item_name,.item_amount,[name=item_acc_head],.text_area_voucher_remark,.del,#add_item").prop('disabled', true);
	
	$(".audit_bill").text("Edit");
	
	var ele=$(".audit_bill");
	$(ele).removeClass("btn-primary audit_bill");
	$(ele).addClass("btn-info edit_audit");
	
		
		}
    
    
}); 
	
	*/



/*
	     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"div_adjustments_by_other_branch",imp_voucher_id:$(".item.active").data("voucher-id")},
    beforeSend: function(){ var a=0;},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		//alert(html);   
		
		$("#div_adjustments_by_other_branch").html(html);
		
	
	
		
		}
    
    
}); 
*/
	     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"view_voucher_del_button",imp_voucher_id:$(".item.active").data("voucher-id")},
		beforeSend: function(){ var a=0;
		
			$("#ajax_loading_message").append('<p class="text-success"> Loading Edit features ...</p>');
		
		},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		
		
		$("#tbody_delete_voucher").html(html);
		
	
	
		
		}
    
    
}); 

		 
///below new code
$(".tr_sup").remove();
$.ajax({
    url: "imprest_ajax.php",
    cache: false,
		 type:'POST',
		 beforeSend: function(){
		 $("#ajax_loading_message").append('<p class="text-success"> Loading supporting documents ...</p>');},
	
    data:{option:"get_supporting_documents",imp_voucher_id:$(".item.active").data("voucher-id")},
   
   
    success: function(html){ 
	
		
	 var resp=JSON.parse(html);

	// d console.log(resp);

	 //console.log(resp.has_sup_doc);
	 var has_sup_doc=resp.has_sup_doc;
	 var supfiles=resp.supfiles;
		
		if(has_sup_doc=='nil'){

$(".tr_sup").remove();

//delete

}else
{
//insert row

var count=supfiles.length;
$(".tr_sup").remove();
for(var i=0;i<count;i++)

{
	var file_type=supfiles[i]['imp_file_type'];
	var file_link=supfiles[i]['imp_file'];
	var file_cat1=supfiles[i]['imp_file_category'];
	var imp_file_id=supfiles[i]['imp_file_id'];


switch (file_cat1){

case "po":

var file_cat="Purchase order";
break;
case "es":

var file_cat="Estimate Sanction";
break;

case "wo":

var file_cat="Work order";
break;


case "e":

var file_cat="Estimate";
break;

case "ag":

var file_cat="Agreement";
break;
case "wt":

var file_cat="Written Undertaking";
break;
case "er":

var file_cat="Estimate Report";
break;
case "db":

var file_cat="Demand Notice";
break;

default:
var file_cat=file_cat1;






}



	switch (file_type){

case 'application/pdf':

var fa_fil='" fa fa-file-pdf-o"';
break;
case 'image/png':

var fa_fil='"fa fa-image"';
break;
 default:
 var fa_fil='"fa fa-file"';

	} 





	$( '<tr  class=tr_sup class="text-info lead"> <td colspan=1 class="bg-warning text-info lead"><span class='+fa_fil+'></span>&nbsp;'+file_cat+'</td><td colspan=3><a href=\''+file_link+'\' target=_blank>click to view </a></td><td><button title="Delete this Supporting Document" data-imp_file_id='+imp_file_id+' class="btn btn-danger btn-xs btn_remove_sup_doc">&times;</button></td></tr>' ).insertAfter("#tr_desc" );


}

}
		

	
		
		}
    
    
}); 
	    
////till above new code
	
	
}		





</script>

<script>
$(document).on("click",".voucher",function() 
{
	
	var slid="x";
	var voucher_id=$(this).attr('id');
	var slid=$("[data-voucher-id='"+voucher_id+"']").index();
	
	//alert(slid);
	
	$(".carousel").carousel(slid);
	
	
	
	}

);

</script>
<script>
$(document).on("click",".tr_voucher_new",function() 
{
	
	var slid="x";
	var voucher_id=$(this).attr('id');
	var slid=$("[data-voucher-id='"+voucher_id+"']").index();
	
	//alert(slid);
	
	$(".carousel").carousel(slid);
	
	
	
	}

);

</script>




<script>

function show_remitanceAmount()
{
	
	
	
	
	$("#txt_txtremit").val($("#td_cash_in_hand").html());
	}









</script>

<script>



$(document).on("click","#btn_show_div_history", function() {
	
	 $("#div_history").slideToggle();
	 $(this).text( $(this).text() == 'Hide Related correspondencess' ? "Show Related correspondences" : "Hide Related correspondencess");
	 $(this).attr('class',( $(this).attr('class') == 'btn btn-warning' ? " btn btn-success" : "btn btn-warning" ));
	
	});
$(document).on("click","#btn_hide_history", function() {
	
	 $("#div_history").hide();
	
	
	});


	$(document).on("click","#btn_show_div_history_classic", function() {
	
	//$("#div_history").slideToggle();
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_show_div_history_classic",imprest_id_ref:$(this).data("imprest_id_ref")},
    beforeSend: function(){ var a=0;},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		
		
		$("#div_history").html(html);
		$("#div_history").show();
		
	
	
		
		}
    
    
}); 

	});
	$(document).on("click","#btn_show_div_history_official", function() {
	
	//$("#div_history").slideToggle();
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_show_div_history_official",imprest_id_ref:$(this).data("imprest_id_ref")},
    beforeSend: function(){ var a=0;},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		
		
		$("#div_history").html(html);
		$("#div_history").show();
		
	
	
		
		}
    
    
}); 

	});




</script>




	<script>
		
		/* imp_voucher_detail_id numeric NOT NULL,
  imp_voucher_id numeric NOT NULL,
  
  imprest_num character varying(100),
  item_gst numeric,
  item_gst_hsn_code numeric,
  item_admisibility boolean,
  imp_holder character varying,
  imp_holder_office character varying,
  
  /*
  item_acc_code character varying(100)
  item_name character varying(100),
  item_desc character varying(2000),
  item_amount numeric,
  ,
  
  
  modified_by character varying(100),
  
  
  
  
	*/
	$(document).on("click",".edit_audit",function(){ 
		
	$(".item_name,.item_amount,[name=item_acc_head],.text_area_voucher_remark,.del,#add_item").prop('disabled', false);
	$(this).text("Save");
	
	$(this).removeClass("btn-info edit_audit");
	
	$(this).addClass("btn-primary audit_bill");
		
		
		
		});
	
	
	
	$(document).on("click",".audit_bill",function(){
		
		var ar=[];
		
		var imp_num=$(this).parents(".message").find(".accord_link").data("imprest_id_ref");
		var voucher_id=$(".item.active").data("voucher-id");
		var from_office_code=$(".item.active").data("from_office_code");
		
		//alert(imp_num);
		$(".tr_template").each(function(){
			
		var ar1=
		[
		$(this).index(),
		$(this).find(".item_name").val(),
		$(this).find(".item_amount").val(),
		$(this).find("[name=item_acc_head]").val(),
		$(this).find(".text_area_voucher_remark").val()
		];
		
			ar.push(ar1);
		
		//alert($(this).find("[name=item_acc_head]").val());
		
		});
		
		var json=JSON.stringify(ar);
		
		
		
	var btn=$(this);

if(btn.data("inprogres1")){ return;}
	
	btn.data("inprogres1",true);
	
	//var impType=$("#sel_imprest_type").val();
	//var msg=$("#txt_area_request_perm_imprest").val();
	//var amt=$("#txt_perm_imp_amnt").val();
	
	
	$(".item_name,.item_amount,[name=item_acc_head],.text_area_voucher_remark,.del,#add_item").prop('disabled', true);
	
	$(this).text("Edit");
	
	$(this).removeClass("btn-primary audit_bill");
	$(this).addClass("btn-info edit_audit");
	
	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"audit_bill",json:json,imp_num:imp_num,voucher_id:voucher_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
			
			
			alert("Success");
		//$('#div_ajax_out').html(html); 
		$('#out_put').html(html);
		
		$("#ajax_loading").modal('hide');btn.data("inprogres1",false); 
		 
		
			}
        
});	
	
		
		
		
		
		
	}
	
	
	);
	
//////////////////////////////agree audit ///////////////////////////////////


	$(document).on("click","#agree_audit",function(){
		
		var ar=[];
		
		var imp_num=$(this).parents(".message").find(".accord_link").data("imprest_id_ref");
		var voucher_id=$(".item.active").data("voucher-id");
		
		//alert(imp_num);
		$(".copy_this").each(function(){
			
		var ar1=
		[
		$(this).index(),
		$(this).find(".item_name").val(),
		$(this).find(".item_amount").val(),
		$(this).find("[name=item_acc_head]").val(),
		$(this).find(".text_area_voucher_remark").val()
		];
		
			ar.push(ar1);
		
		//alert($(this).find("[name=item_acc_head]").val());
		
		});
		
		var json=JSON.stringify(ar);
		
		
		
	var btn=$(this);

if(btn.data("inprogres1")){ return;}
	
	btn.data("inprogres1",true);
	
	//var impType=$("#sel_imprest_type").val();
	//var msg=$("#txt_area_request_perm_imprest").val();
	//var amt=$("#txt_perm_imp_amnt").val();
	
	

	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"audit_bill",json:json,imp_num:imp_num,voucher_id:voucher_id},
		beforeSend: function(){$("#ajax_loading").modal('show');
			
			
		},
    
    success: function(html){ 
			
			
			
		//	console.log(html);
													     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"fill_audit_table_if_exists",imp_voucher_id:$(".item.active").data("voucher-id")},
    beforeSend: function(){ var nop=0;},
    complete: function(){ var nop=0;},
    success: function(html){ 
	
		
		//alert(html);   
		
		$("#div_adjustment_sheet").html(html);
		
	$(".item_name,.item_amount,[name=item_acc_head],.text_area_voucher_remark,.del,#add_item").prop('disabled', true);
	
	$(".audit_bill").text("Edit");
	
	var ele=$(".audit_bill");
	$(ele).removeClass("btn-primary audit_bill");
	$(ele).addClass("btn-info edit_audit");
	$("#ajax_loading").modal('hide');btn.data("inprogres1",false);
	
		
		}
    
    
}); 
			
			
			
			
			
			
			//alert(html);
		//$('#div_ajax_out').html(html); 
		//$('#out_put').html(html); 
		 
		
			
			
			
			}
        
});	
	
		
		
		
		
		
	}
	
	
	);
		
	
	</script>
	
			<script>
	
	
		////////////////////////////////////////////////////////////////////////////////////////////// select_imprest_type//////////////////////////////////////
		//$("#sel_imprest_type").off("change");
	//$(document).off("change","#sel_imprest_type");	
	/*old version 	
$(document).on("change","#sel_imprest_type",function () {

				if($(this).val()=="Permanant")
					var option=2; 
				else if($(this).val()=="Temporary") 
					var option=3; 
				
				else if ($(this).val()==0)
				
				 
					{alert("Please select Imprest Type"); return;}
					
					
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: function(){$("#ajax_loading").modal('show')},
				   
				    success: function(html){ $('#div_permanant').html(html);
						$("#ajax_loading").modal('hide');   }
				
    
    
    }
);}
);


*/

////new version with any amount of request upto delegation 

$(document).on("change","#sel_imprest_type",function () {
	
	

				if($(this).val()=="Permanant")
					var option=2; 
				else if($(this).val()=="Temporary") 
					var option=3; 
				
				else if ($(this).val()==0)
				
				 
					{alert("Please select Imprest Type"); return;}
					
					
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:option},
				    beforeSend: function(){$("#ajax_loading").modal('show')},
				    complete: function(){$("#ajax_loading").modal('hide')},
				    
				    
				    success: function(html){
						
						 $('#div_permanant').html(html);
						 $("#btn_submit_perm_imp_req").prop("disabled",true);   
						 
						 //alert($("#imp_applicable").html());
						 if(parseInt($("#imp_applicable").html())>1)
						 {
							 $("#btn_submit_perm_imp_req").prop("disabled",false);
						 }
						 
						 
						 }
				
    
    
    }
);}
);



//////////////////////////////////////////////////////////////////////////////////////////////////////////
	

	
///////////////////////////////////// keyup request change amount for permannt imprest fresh request ///////////////////////////


	$(document).on("keyup","#txt_perm_imp_amnt",function(){ 
		$("#btn_submit_perm_imp_req").prop("disabled",false);
		$("#div_alert_imprest_amount").html("");  
		
		$(this).parents("td").removeClass("has-error");
		
	if($(this).val()>parseInt($("#imp_applicable").html()))
		{
			$(this).parents("td").addClass("has-error");
			
			//alert();
		var msg="<i class='fa fa-warning fa-2x'> !</i> You cannot request more than  Rs "+ parseInt($("#imp_applicable").html());
		
		$("#div_alert_imprest_amount").html(msg);
		
		$("#btn_submit_perm_imp_req").prop("disabled",true);
		}
			
		
		});

	
/////////////////////////////////////change amount ///////////////////////////	
	


	
		
		
		</script>
		
		<script> 
			
			/// for Editing out box details
		var url="imprest_ajax.php";
		
		
		
		
		$(document).on("click",".edit",function() {
		
 $.ajax({
       url: url,
       type: 'POST',
       data:{imp_op_id:$(this).val(),option:'showEditBox'},
           
        beforeSend: show_ajax_loading_image(),
		
      
      
       success: function (response) {
         alert(response); 
         
            $.ajax({
       url: url,
       type: 'POST',
       data:{option:'btn_show_out_box'},
       async: false,
       cache: false,
        beforeSend: function(){$("#ajax_loading").modal('show')},
	
          
     
       success: function (response1) {
         
         //var response = JSON.parse(response1);
         
         
        // alert(response.alert);
         
         $("#div_ajax_out").html(response1);
         stop_ajax_loading_image();
         $("#ajax_loading").modal('hide');
       }
   });
         
        
         
       }
   });
	

});
		
		
		</script>	
		
<script> 
			//$('.dataTable').DataTable();
		
		
		$(document).on("click",".tr_output_box1", function(){
	
	//$("tr td:nth-child(2)")
	//var imp_ref_id=$(this).find(".4").html();	
	//var imp_status=$(this).find(".1").html();	
	//var imp_op_id=$(this).find(".0").html();
	
	var imp_ref_id=$(this).find("td:nth-child(5)").html();	
	var imp_status=$("td:nth-child(2)",this).html();	
	var imp_op_id=$("td:nth-child(1)",this).html();
	
	
		
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"tr_output_box",imp_ref_id:imp_ref_id,imp_status:imp_status,imp_op_id:imp_op_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
  
    success: function(html){ 
	
		
		$('#div_modal_id').html(html); 
		$('#ajax_modal').modal('show'); 
		$("#ajax_loading").modal('hide'); 
		
		
		}
    
    
});	
	
	
	
}

);
		
		 
		
		</script>
		<script>
	
	/*
	$(document).on("click",".btn_fwd_imprest", function(){
		
		
		$("#sel_branch_sel").parents('td').removeClass('has-error');
		$("#txt_area_request_temp_imprest").parents('div').removeClass('has-error');
		
	var inReceiversInBox=true;
		
		var btn=$(this);
		
		var responseDiv=$(this).parents(".message");

		if(btn.data("inprogres1")){ return;}
	
		btn.data("inprogres1",true);
		
		
		//alert($(this).data('ineten'));
		if($(this).data('ineten')=='intern')
		
		{
				if($("#sel_branch_sel").val()==0)
				{
					$("#sel_branch_sel").parents('td').addClass('has-error');
					alert("Please Select the Branch");
					btn.data("inprogres1",false);
					return false;
					
				}
		}
		
	if($(this).attr("id")=="sub_to_expac")

{
	
			inReceiversInBox=false;
		var branch_id=$("#sel_branch_sel").val();
		var imprest_ref_id=$("#txt_area_request_temp_imprest").data('imp-ref-id');
		var to_office=$("#txt_area_request_temp_imprest").data('to_office');
		var msg=$("#txt_area_request_temp_imprest").val();
		//var to_office=$(this).attr("id");
		var imp_op_id=$("#txt_area_request_temp_imprest").data('imp_op_id');
		
		
}
else

{
	
	var branch_id=$(this).attr("name");
	var to_office=$(this).attr("id");
	var msg=$("#txt_area_voucher_note").val();
	var imprest_ref_id=$("#txt_area_request_temp_imprest").data('imp_ref_id');
	var imp_op_id=$("#txt_area_request_temp_imprest").data('imp_op_id');
	
	
	var impType=$("#sel_imprest_type").val();
	var msg=$("#txt_area_request_temp_imprest").val();
	var amt=$("#txt_perm_imp_amnt").val();
	
}

if(msg=="")
{
alert("Please Enter the Remarks ");

$("#txt_area_request_temp_imprest").parents('div').addClass('has-error');
btn.data("inprogres1",false);
return false;	
}


var conf=confirm(" !! Warning You are going to Forward Imprest request .\n 1. This operations can be undone by deleting from out box before receiving office Process it. \n. 2. Once processed By receiving office No change whatsoever can be made.  \n. 3. Please check all Details.\n \n Click Yes  to continue ? ");
if(!conf)
{
	alert("This Operations has been cancelled. Please try again");
	btn.data("inprogres1",false);
 return false;	
}
	
	
	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_fwd_imprest",inReceiversInBox:inReceiversInBox,to_office:to_office,msg:msg,imprest_ref_id:imprest_ref_id,branch_id:branch_id,imp_op_id:imp_op_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
		
		
		
		
		//$(responseDiv).html(html);
		//alert("success");
		
		//$("<?php echo $_POST[target];?>" ).html(html);
		
		//show_in_box();   
		$('#div_ajax_out').html(html);
		$("#ajax_loading").modal('hide');btn.data("inprogres1",false);
		
		}
    
    
});	
	

if($(this).attr("id")=="sub_to_expac")

{
	//$("#form_submit_to_expac").submit();
	$("#form_submit_imprest").submit();
	
}

	
	
}

);
	*/
	
	
		$(document).on("click",".btn_fwd_imprest", function(){
		
		
		$("#sel_branch_sel").parents('td').removeClass('has-error');
		$("#txt_area_request_temp_imprest").parents('div').removeClass('has-error');
		
	var inReceiversInBox=1;
		
		var btn=$(this);
		
		var responseDiv=$(this).parents(".message");

		if(btn.data("inprogres1")){ return;}
	
		btn.data("inprogres1",true);
		
		
		//alert($(this).data('ineten'));
		if($(this).data('ineten')=='intern')
		
		{
				if($("#sel_branch_sel").val()==0)
				{
					$("#sel_branch_sel").parents('td').addClass('has-error');
					alert("Please Select the Branch");
					btn.data("inprogres1",false);
					return false;
					
				}
		}
		
	if($(this).attr("id")=="sub_to_expac")

{
	
			inReceiversInBox=0;
		var branch_id=$("#sel_branch_sel").val();
		var imprest_ref_id=$("#txt_area_request_temp_imprest").data('imp-ref-id');
		var to_office=$("#txt_area_request_temp_imprest").data('to_office');
		var msg=$("#txt_area_request_temp_imprest").val();
		
		var msg1=$(this).parents(".panel-default").find("h3").html();
		
		var amount_tot=$("[name=txtamount]").val();
		msg=msg1+'\n Amount :'+ amount_tot+'\n Comments : '+msg;
		
		
		//var to_office=$(this).attr("id");
		var imp_op_id=$("#txt_area_request_temp_imprest").data('imp_op_id');
		
		//alert(msg); return false;
		
		
}
else

{
	
	var branch_id=$(this).attr("name");
	var to_office=$(this).attr("id");
	var msg=$("#txt_area_voucher_note").val();
	var imprest_ref_id=$("#txt_area_request_temp_imprest").data('imp_ref_id');
	var imp_op_id=$("#txt_area_request_temp_imprest").data('imp_op_id');
	
	
	var impType=$("#sel_imprest_type").val();
	var msg=$("#txt_area_request_temp_imprest").val();
	var amt=$("#txt_perm_imp_amnt").val();
	
}

if(msg=="")
{
alert("Please Enter the Remarks ");

$("#txt_area_request_temp_imprest").parents('div').addClass('has-error');
btn.data("inprogres1",false);
return false;	
}


var conf=confirm(" !! Warning You are going to Forward Imprest request .\n 1. This operations can be undone by deleting from out box before receiving office Process it. \n. 2. Once processed By receiving office No change whatsoever can be made.  \n. 3. Please check all Details.\n \n Click Yes  to continue ? ");
if(!conf)
{
	alert("This Operations has been cancelled. Please try again");
	btn.data("inprogres1",false);
 return false;	
}
	
	

	

if($(this).attr("id")=="sub_to_expac")

{
			
var formData = new FormData($("#form_submit_imprest")[0]);

//formData.delete('txtdesci');
formData.append("option","save_vouchers_in_saras");
formData.append("inReceiversInBox",inReceiversInBox);
formData.append("imp_op_id",imp_op_id);
//formData.append("imp_operation",imp_operation);
formData.append("to_office",to_office);
formData.append("msg",msg);
formData.append("txtdesci",msg);

formData.append("imprest_ref_id",imprest_ref_id);
formData.append("branch_id",branch_id);
//formData.append("vouchers_json",vouchers_json);





//var formData="";






$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:formData,
    processData: false,
	contentType: false, 
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
	
		
		//$('#div_modal_id').html(html); 
		//$('#ajax_modal').modal('toggle');
		
		//$('#'+result_target).html(html); 
		//show_in_box();
		
		$('#div_ajax_out').html(html);
		
		
		//// DOING NEW IMPREST OPERATIONS
	/*	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_fwd_imprest",inReceiversInBox:inReceiversInBox,
		to_office:to_office,msg:msg,imprest_ref_id:imprest_ref_id,branch_id:branch_id,imp_op_id:imp_op_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
		  
		$('#div_ajax_out').append(html); 
		$("#ajax_loading").modal('hide');btn.data("inprogres1",false);
		
		}
    
    
});	 
	*/	
		stop_ajax_loading_image();
		
		//alert(html);
		
		}
    
    
});
	//$("#form_submit_imprest").submit();
	
} else

{
		
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_fwd_imprest",inReceiversInBox:inReceiversInBox,
		to_office:to_office,msg:msg,imprest_ref_id:imprest_ref_id,branch_id:branch_id,imp_op_id:imp_op_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
		  
		$('#div_ajax_out').html(html);
		$("#ajax_loading").modal('hide');
		
		btn.data("inprogres1",false);
		
		}
    
    
});	
	
}

	
	
}

);
		
	
	
	</script>
				
<script>
//$('[data-toggle="tooltip"]').tooltip();


   

</script>
<script> $('.dataTable').DataTable();</script>

<script>

	
$(document).on("click","#btn_submit_perm_imp_req", function(){
	
	//$("#ajax_loading").modal('show');
	
	$("#txt_area_request_perm_imprest").parent('div').removeClass('has-warning');  
	
var btn=$(this);

if(btn.data("inprogres1")){ return;}
	
	btn.data("inprogres1",true);
	
	var impType=$("#sel_imprest_type").val();
	var msg=$("#txt_area_request_perm_imprest").val();
	var amt=$("#txt_perm_imp_amnt").val();
	
	
	if(msg=="")
	{
		
		alert("Please write Remarks ");
		$("#txt_area_request_perm_imprest").parent('div').addClass('has-warning');
		 return false;
	}
	
	
	
var conf=confirm(" !! Warning You are going to submit Fresh Imprest request for this financiyal year.\n 1. This operations cannot be undone. \n. 2. Please check all Details.\n \n Click Yes  to continue ? ");
if(!conf)
{
	alert("This Operations has been cancelled. Please try again");
 return false;	
}

	
	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_submit_perm_imp_req",msg:msg,impType:impType,amt:amt},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
			
			
			//alert(html);
		$('#div_ajax_out').html(html); 
		$("#ajax_loading").modal('hide');btn.data("inprogres1",false);
		 
		
			}
        
});	


});

</script>

<script>
		
		
function show_ajax_loading_image1(){
var a=0;


}
function stop_ajax_loading_image1(){
var a=0;
}

var cugt=0;
var pers=0;

$(document).on("click","#btn_save_cug", function(){

var phone=$("#txt_cug").val();
var option="btn_save_cug"

$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:option,phone:phone},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){

		try{var out=JSON.parse(html);}	catch(e)
		
		{

		alert(e);
		var nop=1;
		
		}

		if(out.result=='ok')
		{
			
			//$("#div_cug").hide(1000);

			$("#div_cug").html(out.html);
			cugt=1;
		}
		$("#ajax_loading").modal('hide');

		if(cugt==1 && pers==1){

$(".up").css('display','none');

		}
		

		//alert("Saved");

	}
});


});

$(document).on("click","#btn_save_personal", function(){

var phone=$("#txt_mobile").val();
var option="btn_save_personal"

$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:option,phone:phone},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){

		//$('#div_ajax_out').html(html);
		$("#ajax_loading").modal('hide');
		

		try{var out=JSON.parse(html);}	catch(e)
		
		{

		alert(e);
		var nop=1;
		
		}

		if(out.result=='ok')
		{
			
			//$("#div_cug").hide(1000);

			$("#div_pers_mob").html(out.html);

			pers=1;
		}

			if(cugt==1 && pers==1){

$(".up").css('display','none');

		}
		
		
		//$('#div_response').html(html.html);

		//alert("Saved");

	}
});


});


///////////////////////////////////////// send otp one time for  registration//////////////////////////////////
$(document).on("click",".send_otp", function(){


var myid=$(this).attr('id');
if(myid=='btn_send_cug_otp')
{

var phone=$("#txt_cug").val();
var type="cug";


}else if(myid=='btn_send_per_otp'){

var phone=$("#txt_mobile").val();
var type="noncug";

}

$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"send_otp",phone:phone,type:type},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 


if(myid=='btn_send_cug_otp')
{


$("#div_cug").html(html);
//$('#cug_otp_req').hide(); $('#cug_otp_res').show(100); 



}else if(myid=='btn_send_per_otp'){

	$("#div_pers_mob").html(html);
	
	

//$('#per_otp_req').hide(); $('#per_otp_res').show(100); 

}





			
			
			//alert(html);
		
		
		//$('#div_ajax_out').html(html); 
		$("#ajax_loading").modal('hide');
		
		//btn.data("inprogres1",false);
		 
		
			}
        
});	


});


/////////////////////////////////////////otp one time for cug registration//////////////////////////////////


/////////////////////////////////////////otp validation//////////////////////////////////
$(document).on("click",".submit_otp", function(){



var cugFlag;

var myid=$(this).attr('id');


if(myid=='btn_sbmt_cug_otp')
{

var otp=$("#txt_otp_cug").val();
cugFlag=1;


}else if(myid=='btn_sbmt_per_otp'){

var otp=$("#txt_otp_mobile").val();
cugFlag=0;

}




$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"validate_otp",otp:otp,cugFlag:cugFlag},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 
		try{var out=JSON.parse(html);}	catch(e)
		
		{

		//alert(e);
		var nop=1;
		
		}

		//alert(html);
		
		if(out.result=='ok')
		{
		
		if(myid=='btn_sbmt_cug_otp')
{
	$("#div_pers_mob").show();
	// $('#cug_otp_req').hide(); 
	// 	$('#cug_otp_res').hide(100);
	// 	$('#per_otp_req').show(); 
	$("#div_cug").hide();

}else if(myid=='btn_sbmt_per_otp'){

$("#div_pers_mob").hide();
// $('#per_otp_req').hide(); 
// $('#per_otp_res').hide();

$(".up").css("display","none");

}



			//alert(html);
	 
		$('#div_response').html(out.html); 
		$("#ajax_loading").modal('hide');
		
		//btn.data("inprogres1",false);
		 
		
			}

	}
        
});	


});


/////////////////////////////////////////otp one time for cug registration//////////////////////////////////




//////////////////////////////////////sys start cash in hand entry ////////////////////////////////////////

$(document).on("click","#btn_save_cash_in_hand", function(){

	var cash_in_hand=$("#txt_cash_in_hand").val();
	//txt_date_of_cash_in_hand
var date=$("#txt_date_of_cash_in_hand").val();

$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_save_cash_in_hand",cash_in_hand:cash_in_hand,date:date},
    beforeSend: function(){$("#ajax_loading").modal('show')},
   
    success: function(html){ 

		//alert(html); //return false;
			
		try{var out=JSON.parse(html);}	catch(e)
		
		{

		alert(e);
		
		}

if(out.result=='ok')
{

$('#div_cash_in_hand').hide(); 	

$("#up").css("display","none");
}

		//alert(html);
	 
		$('#div_ajax_out').html(out.html); 
		$("#ajax_loading").modal('hide');
		
		//btn.data("inprogres1",false);
		 
		
			}
        
});	




});




// Attach imprest uploaded pending voucher to returned file //



$(document).on("click",".attach_vouchers", function(){

var imprest_ref_id=$(this).data('imprest_id_ref');
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"attach_vouchers",imprest_id_ref:imprest_ref_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
    
    success: function(html){ 
		
		
		
		//console.log(html);
		
		$("#ajax_loading").modal('hide');
	show_in_box();

	//$('#div_ajax_out').html(html);
		

		
		
		  
		
		
		}
    
    
});	

});
$(document).on("click","#btn_strip_voucher", function(){

var imprest_voucher_id=$(this).attr('name');
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"strip_voucher",imprest_voucher_id:imprest_voucher_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
    
    success: function(html){ 
		
		
	//	console.log(html);
		//alert(html);
		
		//$("#ajax_loading").modal('hide');
	//show_in_box();

	//$('#div_ajax_out').html(html);
		
	$("#ajax_loading").modal('hide');
		
		
		  
		
		
		}
    
    
});	

});
//////////////////////////////////////sys start cash in hand entry ////////////////////////////////////////



//////////////////////////////////////keyup on amount /////////////////////////////////////////////////////////////////////

//// keypress//////


$(document).on("keypress","#txt_amount_imprest,#txt_cug,txt_otp_cug,txt_mobile,txt_otp_mobile,.item_amount1", function(event){
	
	if(event.which == 8 || event.which == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
        return true;
	else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	    event.preventDefault();
	  }
	
});




//////////////////////////////////////////////upload vouchers////////////////////////////////////////////////////////////// submit






$(document).on("click","#btn_bill", function(){
	$("#ajax_loading").modal('show');
});


/// file size checking on change

// $('#data_of_purchase').bind('change', function() {
//             alert('This file size is: ' + this.files[0].size/1024 + "KB Vouhcers Should to be below 300KB");
//         });










$(document).on("change","#data_of_purchase,#new_voucher", function(){

var e=$(this);



	$("#div_invalid_file_warning").html("");
	$("#btn_bill").prop('disabled',false);
	$(this).parents('td').removeClass('has-error');
	$("#span_size_file").css("color","blue");

var file_size1 = $(this)[0].files[0].size;
var file_size=file_size1/1024;

//alert(file_size);
 if(file_size>300) {

	//alert(e.val());
    file =$(this)[0].files[0];
	
	//var dUrl=await ResizeImage(file);
// alert("tesy");

// 	var imgNew = document.createElement("img");
// 	imgNew.src=dUrl;
// 	imgNew.src=file;
// 	$(".span_voucher_over_size").append(imgNew);
// 	alert(dUrl);
// console.log(dUrl);
// imgNew.src=dUrl;

	//alert(dUrl); return false;
	
	//e.val(ResizeImage(file)); 

	var file_size1 = $(this)[0].files[0].size;
var file_size=file_size1/1024;
//alert(file_size);

//return false;



	alert("Too big File size. Vouhcers need to be below 300KB");
		 
	$(this).parents('td').addClass('has-error');

	$("#span_size_file").css("color","red");
	$("#btn_bill").prop('disabled',true);
	$("#btn_change_voucher").css("display","none");
	$(".span_voucher_over_size").css("display","block");
 		

	
		
	}else{

		
		$("#btn_change_voucher").css("display","block");

		$(".span_voucher_over_size").css("display","none");
	}


	var ext = e.val().split('.').pop().toLowerCase();
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
	$("#btn_bill").prop('disabled',true);
	$("#btn_change_voucher").css("display","none");
	$(".span_voucher_over_size").css("display","block");
	
	var m=`
	<div class="alert alert-danger " id=div_invalid_file_warning>
		
		<strong class='fa fa-exclamation-triangle fa-2x'>Warning</strong> Please select Image files only
	</div>
	`;
	$(".span_voucher_over_size").html(m);
  
  
}



});
$(document).on("change",".sup_file", function(){


	$("#btn_bill").prop('disabled',false);
	$(this).parents('td').removeClass('has-error');
	$("#span_size_file").css("color","blue");

var file_size1 = $(this)[0].files[0].size;
var file_size=file_size1/1024;

//alert(file_size);
 if(file_size>1000) {
    
	
	alert("Too big File size. supporting documents need to be below 300KB");
		 
	$(this).parents('td').addClass('has-error');

	$("#span_size_file").css("color","red");
	$("#btn_bill").prop('disabled',true);
	$("#btn_change_voucher").css("display","none");
	$("#span_sup_doc_over_size").css("display","block");
 		
		
	}else{

		
		$("#btn_change_voucher").css("display","block");

		$("#span_sup_doc_over_size").css("display","none");
	}

});



$(document).on("submit","#form1",function(evt){
	
	
      evt.preventDefault();
	  
	  
      
  // alert($(this)[0]);	
     
      
  
      var formData = new FormData($(this)[0]);
      formData.append("alert","one");
			formData.append("option","tbody_imp_vouchers");
valid=true;

var err=0;
var msg="";

if($("#txt_description").val()==""){ 
	
	msg=msg+"\n"+"Please Enter a Description'";
	err=err+1;
	
	
	}


if($("#item_acc_head").val()==0){ 
	
	msg=msg+"\n"+"Please Select an account head'";
	err=err+1;
	
	
	}

if(!$.isNumeric($("#txt_amount_imprest").val())){ 
	
	
	$("#txt_amount_imprest").val("");
	msg=msg+"\n"+"Please Enter a Valid Amount'";
	err=err+1;
	
	
	}

if($("#txt_date_of_voucher").val()==""){ 
	
	
	
	msg=msg+"\n"+"Please Enter Date of Voucher'";
	err=err+1;
	
	
	}
if($("#txt_date_of_payement").val()==""){ 
	
	
	
	msg=msg+"\n"+"Please Enter Date of payment";
	err=err+1;
	
	
	}
if($("#txt_voucher_num").val()==""){ 
	
	
	
	msg=msg+"\n"+"Please Enter Voucher Number'";
	err=err+1;
	
	
	}
if($("#txt_paid_to").val()==""){ 
	
	
	
	msg=msg+"\n"+"Please Enter Payee";
	err=err+1;
	
	
	}
var ext = $('#data_of_purchase').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
    
	
	msg=msg+"\n"+"Invalid file Type !! USe Only Image Files in the jpg or jpeg Format";
	err=err+1;
	valid=false;
	
}

var file_size1 = $('#data_of_purchase')[0].files[0].size;
var file_size=file_size1/1024;
 if(file_size>300) {
    
	
		msg=msg+"\n"+"Too big File size. Vouhcers need to be below 300KB";
 		err=err+1;
 		valid=false;
		
	}



// alert(file_size);
// return false;


if($('#data_of_purchase').val()=="")
{
	msg=msg+"\n"+"Please Upload a Image file for Saving the Voucher";
	err=err+1;
	valid=false;
}

//alert(m)
if(err>0)
{

	$("#ajax_loading").modal('hide');
alert(msg);
valid=false;
return false;	
}






			if(valid==true)
			{
		
			
  $.ajax({
       url: "imprest_ajax.php",
       type: 'POST',
       data:formData,
       async: false,
       cache: false,
        beforeSend: function(){$("#ajax_loading").modal('show')},
		
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         //alert(response);
         
         $("#tbody_imp_vouchers").html(response);
         $("#ajax_loading").modal('hide');
         //$("").modal('hide');
		 //document.getElementById("#form1").reset();
		 //$("#form1").trigger("reset");
		 alert("Voucher uploaded Successfully");

       }
   });
   
			} else alert("false");
   return false;
 });
	
	
//////////////////////////////////////////////upload vouchers end////////////////////////////////////////////////////////////// submit
	
	</script>

<script>
$(document).on("click","#edit_cash_in_hand",function(){

$("#txt_cash_in_hand").prop("disabled",false);
$("#txt_date_of_cash_in_hand").prop("disabled",false);

$(this).removeClass("btn-warning").addClass("btn-success");
$(this).text("Save Cash in Hand");
$(this).attr("id","btn_save_cash_in_hand");
});

</script>

<script>
//////////////////////////////////////////////upload vouchers////////////////////////////////////////////////////////////// submit

$(document).on("submit","#frm_new_voucher",function(evt){
	
	  
	evt.preventDefault();
	var currentIndex = $('div.active').index() ;
	$("#ajax_loading").modal('show');
	
// alert($(this)[0]);	
   
	

	var formData = new FormData($(this)[0]);
	


var err=0;
var msg="";

var valid=1;










var ext = $('#new_voucher').val().split('.').pop().toLowerCase();
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
  
  
  msg=msg+"\n"+"Invalid file Type !! USe Only Image Files in the jpg or jpeg Format";
  err=err+1;
  valid=0;
  
}



var file_size1 = $('#new_voucher')[0].files[0].size;
var file_size=file_size1/1024;
 if(file_size>300) {
    
	
		msg=msg+"\n"+"Too big File size. Vouhcers need to be below 300KB";
 		err=err+1;
 		valid=0;
		
	}


//alert(err);

if(err>0)
{
	$("#ajax_loading").modal('hide');
alert(msg);
valid=0;

return false;	
}

//alert(valid);





		  if(valid==1)
		  {
	  
$.ajax({
	 url: "imprest_ajax.php",
	 type: 'POST',
	 data:formData,
	 async: false,
	 cache: false,
	 
	  
	 contentType: false,
	 enctype: 'multipart/form-data',
	 processData: false,
	 success: function (response) {
	  // alert(response);
	   //console.log(html);
	   $("#td_change_voucher_out").html(response);
	   $("#ajax_loading").modal('hide');
	   //$("").modal('hide');
	   //document.getElementById("#form1").reset();
	 //  view_imprest_vouchers();

	// view_imprest_vouchers_change(currentIndex);
	
	   alert("Voucher uploaded Successfully");
	   carosal_load();

	 }
 });
 
			} else 
			
			{
				$("#ajax_loading").modal('hide');
				alert("FAILED TO UPDATE VOUCHER");
 return false;
			}

});
  
  
//////////////////////////////////////////////upload vouchers end////////////////////////////////////////////////////////////// submit
  
  </script>


<script>
//////////////////////////////////////////////upload  supporting documents////////////////////////////////////////////////////////////// submit

$(document).on("submit","#frm_add_sup_doc",function(evt){
	
	  
	evt.preventDefault();
	$("#ajax_loading").modal('show');
	
// alert($(this)[0]);	
   
	

	var formData = new FormData($(this)[0]);
	


var err=0;
var msg="";

var valid=true;














if(err>0)
{
alert(msg);
valid=false;
return false;	
}






		  if(valid==true)
		  {
	  
$.ajax({
	 url: "imprest_ajax.php",
	 type: 'POST',
	 data:formData,
	 async: false,
	 cache: false,
	 
	  
	 contentType: false,
	 enctype: 'multipart/form-data',
	 processData: false,
	 success: function (response) {
	   //alert(response);
	   //console.log(html);
	   $("#td_change_voucher_out").html(response);
	   $("#ajax_loading").modal('hide');
	   //$("").modal('hide');
	   //document.getElementById("#form1").reset();
	   //view_imprest_vouchers();

	   alert("Supporting Documents uploaded Successfully");

	 }
 });
 
		  } else alert("false");
 return false;
});
  
  
//////////////////////////////////////////////upload  supporting documents////////////////////////////////////////////////////////////// submit



</script>



</script>




			<script>



			$(document).on("click","#btn_prepare_abstract", function(){
				
			var imprest_ref_id=$(this).data("imp-ref-id");		
	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"prepare_abstract",imp_ref_id:imprest_ref_id},
    beforeSend: function(){$("#ajax_loading").modal('show')},
    
    success: function(html){ 
		
		
		
		//alert(html);
		
		$("#abstract_sheet").html(html);
		
		$("#show_submit_to_expac_after_abstract_prep").show();
		$("#ajax_loading").modal('hide');
		
		  
		
		
		}
    
    
});	
				
			});



			</script>
				<script>
				$(document).on("change","#sel_branch_sel",function()
				
				{
					//alert($(this).val());
					$(".intern").attr("name",$(this).val());
					
					//alert($(".intern").attr("name"));
				}
				
				);
				</script>
					<script>
	$('.carousel').carousel({
    interval: false
}); 
	</script>
	<script>
 
		
		
		
		
	$(document).on("slid.bs.carousel ",".carousel",function(){carosal_load();}
	);
	
	
	
	///$(document).ready(carosal_load());
	
	//$(document).one("mouseover","#div_adjustment_sheet1",carosal_load());
	
	
	</script>
	
	<script>
				$(document).on("change","#sel_branch_sel",function()
				
				{
					//alert($(this).val());
					$(".intern").attr("name",$(this).val());
					
					//alert($(".intern").attr("name"));
				}
				
				);
				</script>


				<script>


				$(document).on("click",".add_new_item",function(){

var $this_table=$(this).closest(".adj");

var $row=$this_table.find(".tr_template:first");

var $newRow=$row.clone();
//$row.html("<p>ttt</p>");
var row_last=$this_table.find(".tr_template:last");


row_last.after($newRow);


//
//alert($this_table.attr('id'));

//alert($newRow);
});

	$(document).on("click",".del_new",function(){
	
	//var row=$(".tr_template:first").clone();
	var $this_table=$(this).closest(".adj");

	var count = $this_table.find('.tr_template').length;
	if(count==1)
	{
		alert("Cannot Remove the First Row");
		
		return false;
		
	}
	 
	$(this).closest(".tr_template").remove();
	//$('#tbl_adjust tr:last').after(row);
	
	//alert(row);
	});
	




				</script>
				

		
<script>
	$(document).on("click","#add_item",function(){
	
	var row=$(".tr_template:first").clone();
	
	
	$('#tbl_adjust tr.tr_template:last').after(row);
	
	//alert(row);
	});
	
	
	$(document).on("click",".del",function(){
	
	//var row=$(".tr_template:first").clone();
	
	var count = $('.tr_template').length;
	if(count==1)
	{
		alert("Cannot Remove the First Row");
		
		return false;
		
	}
	 
	$(this).closest(".tr_template").remove();
	//$('#tbl_adjust tr:last').after(row);
	
	//alert(row);
	});
	
	</script>

<script>


function sum_amount(){


	var sum=0;
$(".item_amount1").each(function (index, element) {


sum=sum+parseFloat($(this).val());
	// element == this
	
});
//alert(sum);

sum=parseFloat(sum);
$("#td_total").text(sum);
}


$(document).on("keyup",".item_amount1",function(){
	sum_amount();
});
</script>

<script>
function show_ajax_loading_image()  
	{
		
	
	$("#ajax_loading").modal('show');
	
	}
	
	
	function stop_ajax_loading_image()
	{
		
		
	$("#ajax_loading").modal('hide');
	}



</script>
<script>
function show_ajax_loading_image_time(a)
	{
		
	
		$("#ajax_loading").modal('show');

		$("#ajax_loading_message").text("This is a DATA intensive operation . This will Take 30 Sec to 1.5 Minutes to complete");
		
		}


function hide_ajax_loading_image_time(a)
	{
		
	
		$("#ajax_loading").modal('hide');
		$("#ajax_loading_message").text("");
		}



</script>
		<script>
		$(document).on("click",".accord_link", function(){
	
	//show input box
	$(".tr_voucher_new").remove();
	$("[name=txtpayee]").remove();
	$("[name=cmbpayee]").remove();
	
	$("#ajax_loading_message").html("");
	var div_acc=$(this).attr("href");
	var target=$(this).attr("href")+"res";
	
	var a_link=$(this);
	
	
	var id_span=$(this).data('imp_op_id');
	

	
	 $("#"+id_span).attr('class',($("#"+id_span).attr('class') == 'fa fa-envelope-o fa-lg' ? " fa fa-envelope-open fa-lg" : "fa fa-envelope-o fa-lg"));
	
	
	var imp_ref_id=$(this).data("imprest_id_ref");
	var branch_id=$(this).data("from_branch");
	var imp_operation=$(this).data("imp_operation");
	
	
		
	var imp_status=$(this).parent("h4").attr("id");	
	var imp_op_id=$(this).parent("h4").attr("name");	
var from_ofc_code=$(this).data("imprest-from_office");
var type=imp_ref_id.split("/")[2];
	
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"tr_input_box",imp_operation:imp_operation,imp_ref_id:imp_ref_id,imp_status:imp_status,imp_op_id:imp_op_id,from_ofc_code:from_ofc_code,target:target,branch_id:branch_id},
		beforeSend: function(){show_ajax_loading_image_time();
			$("#ajax_loading_message").append('<p class="text-success"> Loading Actions ...</p>');
		},
    
    success: function(html){

			hide_ajax_loading_image_time()
		//$("#ajax_loading").modal('hide'); 
			
		$(target).html(html); 
		 $(a_link).data("open","yes");
		 
		 $("#show_submit_to_expac_after_abstract_prep").hide();
		 
		
		 
		 
		 $("#div_history").hide();
		 
		 if(type=='V' || type=='VC')
		 carosal_load();	
		 var a=0;	

		 $(".intern").prop("disabled",true);
		 $(".first").prop("disabled",false);


		 sum_amount();  // sum of addded values
		
	}
    
    
});

////disabling fwd button for safety -- only could be updated after save voucher adjustments








});
</script>	

<script>

$(document).on("click","#btn_convert_to_closing", function(){

	///////////////////////////v to vc option/////////////////////////////////////////


var imp_ref_id=$(this).data("imprest_id_ref");


///alert(imp_ref_id); return;
$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"show_option_to_close_imprest",imp_ref_id:imp_ref_id},
    beforeSend: function(){ show_ajax_loading_image();},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		//alert(html1);   
		
		//$("#div_adjustments_by_other_branch").html(html);
		
		$("#div_show_option_to_close_imprest").html(html);
		stop_ajax_loading_image();

		//$("#div_ajax_out").html(html1);
		//$('#div_ajax_out').html(html); 
		//console.log(html);
		//$("#tbl_remitance_details_final_closing").hide();
	
	
		
		}
    
    
}); 


////////////////////////////////////////////////////



});
$(document).on("click","#btn_convert_to_recoupment", function(){

	///////////////////////////v to vc option/////////////////////////////////////////


var imprest_id_ref=$(this).data("imprest_id_ref");


//alert(imprest_id_ref); return;
$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_convert_to_recoupment",imprest_id_ref:imprest_id_ref},
    beforeSend: function(){ show_ajax_loading_image();},
    complete: function(){ var a=0;},
    success: function(html){ 
	
		
		
		stop_ajax_loading_image();

		$('#div_ajax_out').html(html); 
		//show_in_box()
		
	
	
		
		}
    
    
}); 


////////////////////////////////////////////////////



});



</script>


<script> 
			
			/// for deleting out box details
		var url="imprest_ajax.php";
		
		
		
		
		$(document).on("click",".delete",function() {
			
			if(confirm("Do You Really want to delete This Item")){
		
					 $.ajax({
					       url: url,
					       type: 'POST',
					       data:{imp_op_id:$(this).val(),option:'deleteImprestOperation',imprest_id_ref:$(this).data('imprest_id_ref'),imp_operation:$(this).data('imp-operation')},
					           
					        beforeSend: show_ajax_loading_image(),
							
					      
					      
					       success: function (response) {
					         //alert(response);  
					         
					         console.log(response);
					          //$("#div_ajax_out").html(response);
					            $.ajax({
					       url: url,
					       type: 'POST',
					       data:{option:'btn_show_out_box'},
					       async: false,
					       cache: false,
					        beforeSend: function(){$("#ajax_loading1").modal('show')},
						
					          
					     
					       success: function (response1) {
							   stop_ajax_loading_image();
					         
					         //alert(response1);
					         
					         //var response = JSON.parse(response1);
					         				         
					        // alert(response.alert);
					         
					         $("#div_ajax_out").html(response1);
					         
					         $("#ajax_loading1").modal('hide');
					        // $(".panel-footer").html(response1);
					       }
					   });
					      				        
					         
					       }
					   });
}	

});
		
		
		</script>
<script> 
			
			/// for deleting out box details
		var url="imprest_ajax.php";
		
		
		
		
		$(document).one("click",".revoke",function() {



			var transId=$(this).data('transid');
			//alert(transId);
			if(confirm("Do You Really want to Revoke the Voucher and  Delete This operation")){
		
					 $.ajax({
					       url: url,
					       type: 'POST',
					       data:{imp_op_id:$(this).val(),
						   option:'revokeVoucherAndDeleteImprestOperation',
						   transId:transId,imprest_id_ref:$(this).data('imprest_id_ref'),
						   imp_operation:$(this).data('imp-operation')},
					           
					        beforeSend: show_ajax_loading_image(),
							
					      
					      
					       success: function (response) {
					         //alert(response);  
					         
					         
					          $("#div_ajax_out").html(response);
										stop_ajax_loading_image();

										/*
					            $.ajax({
					       url: url,
					       type: 'POST',
					       data:{option:'btn_show_out_box'},
					       async: false,
					       cache: false,
					        beforeSend: function(){$("#ajax_loading1").modal('show')},
						
					          
					     
					       success: function (response1) {
							   stop_ajax_loading_image();
					         					         
					         
					         $("#div_ajax_out").html(response1);
					         
					         $("#ajax_loading1").modal('hide');
					        
					       }
					   });
					      */				        
					         
					       }
					   });
}	

});
		
		
		</script>


<script>
	
	//funtion to view vouchers
function view_imprest_vouchers()


{

				
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"btn_show_imprest_vouchers"},
				    beforeSend: function(){var nop=0;},
				    complete: function(){var nop=0;},
				    success: function(html){ 
						
						 
						$("#tbody_imp_vouchers").html(html);

						//$("#div_ajax_out").html(html);
						//carosal_load();
						
						carosal_load();
						
						
						
						  }
				
    
    
    }
);}	
	
function view_imprest_vouchers_change(index)


{

				
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"btn_show_imprest_vouchers"},
				    beforeSend: function(){var nop=0;},
				    complete: function(){var nop=0;},
				    success: function(html){ 
						
						 
						//$("#tbody_imp_vouchers").html(html);

						$("#div_ajax_out").html(html);
						
						//carosal_load();
						
						carosal_load();
						$("#id_carosal").carousel(index);
						
						
						
						  }
				
    
    
    }
);}	
	
function view_imprest_vouchers2()


{

				
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"btn_show_imprest_vouchers"},
				    beforeSend: function(){var nop=0;},
				    complete: function(){var nop=0;},
				    success: function(html){ 
						
						 
						$("#div_ajax_out").html(html);
						//carosal_load();
						
						carosal_load();
						
						
						
						  }
				
    
    
    }
);}	
	



</script>




<script>
//delete voucher






var url="imprest_ajax.php";
		
		
		
		
		$(document).on("click","#btn_del_voucher",function() {
			
			if(confirm("Do You Really want to delete This Item")){
			
		
													 $.ajax({
													       url: url,
													       type: 'POST',
													       data:{option:'btn_del_voucher',voucher_id:$(this).attr('name')},
													           
													        beforeSend: show_ajax_loading_image(),
															
													      
													      
													       success: function (response) {
															   stop_ajax_loading_image();
															   view_imprest_vouchers();
													        //  alert(response);
													          
													         
						// 		$.ajax({
						// 	url: url,
						// 	type: 'POST',
						// 	data:{option:'btn_show_out_box'},
						// 	async: false,
						// 	cache: false,
						// 	beforeSend: function(){$("#ajax_loading1").modal('show')},
							
								
							
						// 	success: function (response) {
								
						// 		//var response = JSON.parse(response1);
								
						// 		view_imprest_vouchers();
						// 		$("#ajax_loading1").modal('hide');
								
						// //    alert(response);
								
						// 		//$("#div_ajax_out").html(response1);
						// 	// $(".panel-footer").html(response1);
						// 	}
						// });
													         
													        
													         
													       }
													   });
													   
				   }
	

});


</script>


<script>





var url="imprest_ajax.php";
		
		
		
		
		$(document).on("click",".btn_del_voucher_admin",function() {

			// alert($(this).attr('name')); return false;
			
			if(confirm("Do You Really want to delete This Item . Use very carefully")){
			
		
													 $.ajax({
													       url: url,
													       type: 'POST',
													       data:{option:'btn_del_voucher',voucher_id:$(this).attr('name')},
													           
													        beforeSend: show_ajax_loading_image(),
															
													      
													      
													       success: function (response) {
															 
															//    btn_show_imprest_cash_book();
															   stop_ajax_loading_image();
															  
													         
													        
													         
													       }
													   });
													   
				   }
	

});


</script>



<script>
//// keypress  amount  function maheep bro//////


$(document).on("keypress","#txt_amount_imprest,.item_amount", function(event){
	
	if(event.which == 8 || event.which == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
        return true;
	else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	    event.preventDefault();
	  }
	
});



</script>




<script>
//////////////////////////////////////keyup on amount perm imprest /////////////////////////////////////////////////////////////////////


	
	function show_ajax_loading_image(){
		
		$("#ajax_loading").modal('show');
		}
	
	function stop_ajax_loading_image(){
		
		$("#ajax_loading").modal('hide');
		}
	
	
	
function show_live_balance(amount,cash_in_hand){




	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"keyup_amount_voucher",amount:amount,cash_in_hand:cash_in_hand},
    beforeSend: function(){var noperation=1;},
    complete: function(){var noperation=1;},
    success: function(html){ 
	
		
		//alert(html);   
		
		var balance; 
		
		//alert(balance);
		//$("#td_balance_at_aru").html(balance);
		$("#div_abstract").html(html);
		$("#div_abstract2").html(html);
		
		balance=$("#div_abstract").html();
		
		if(balance<0)
		{
			
			
	  var alertHtml="Your balance is insuffcient to add this Voucher \n Please Recoup the rest of the vouchers ";
	  
	  $("#btn_bill").prop('disabled',true);
	  
	  $("#alert_balance").html(alertHtml);
	  $("#alert_balance").addClass('alert alert-danger');
	  
	  $("#txt_amount_imprest").parents('td').addClass('has-error');
	  
	  $("#alert_balance").show(); 
	  
	  
  
  }
  
		
		}
    
    
});   

}




$(document).on("keyup","#txt_amount_imprest", function(event){
		
		$("#btn_bill").prop('disabled',true); 
		$("#alert_balance").hide(); 
		$("#txt_amount_imprest").parents('td').removeClass('has-error');
		var cash_in_hand =$("#td_balance_at_aru").html();
		
		if(!$.isNumeric($("#txt_amount_imprest").val())){ 
			
			//evt.preventDefault();
			$("#txt_amount_imprest").val("");
			
			//alert(cash_in_hand);
			var a=0;
			
			return false;
			
		}
    
           
            
     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"keyup_amount_voucher",amount:$(this).val(),cash_in_hand:cash_in_hand},
    beforeSend: function(){var noperation=1;},
    complete: function(){var noperation=1;},
    success: function(html){ 
	
		
		//alert(html);   
		
		var balance; 
		
		//alert(balance);
		//$("#td_balance_at_aru").html(balance);
		$("#div_abstract").html(html);
		balance=$("#div_abstract").html();
		
		if(balance<0)
		{
			
			
	  var alertHtml="Your balance is insuffcient to add this Voucher \n Please Recoup the rest of the vouchers ";
	  
	  $("#btn_bill").prop('disabled',true);
	  
	  $("#alert_balance").html(alertHtml);
	  $("#alert_balance").addClass('alert alert-danger');
	  
	  $("#txt_amount_imprest").parents('td').addClass('has-error');
	  
	  $("#alert_balance").show(); 
	  
	  
  
  }else{

	$("#btn_bill").prop('disabled',false);
  }
  
		
		}
    
    
});   
   
   //alert(balance);     
  
  
  
        
    }
		
	);








//////////////////////////////////////keyup on amount end /////////////////////////////////////////////////////////////////////




//////////////////////////////////////keyup on amount /////////////////////////////////////////////////////////////////////



</script>




<script>
	
function show_ajax_loading_image(){
		
		$("#ajax_loading").modal('show');
		}
	
	function stop_ajax_loading_image(){
		
		$("#ajax_loading").modal('hide');
		}
	



$(document).on("change","#voucher_select_all", function(){
	
	
	
	
	
	
if($(this).is(':checked'))
{
	
	$(".chk_box").prop('checked', true);
}else
{
	
	$(".chk_box").prop('checked', false);
	
}


});
	
	
$(document).on("click","#btn_submit_vouchers", function(){
		

var opening_cash_in_hand=$("#td_opening_cash_in_hand").text();
var total_expenditure=$("#td_tot_exp").text();
var closing_cash_in_hand=$("#td_cash_in_hand").text();
var imp_total_in_transit=$("#td_imprest_already_submitted").text();


//alert(opening_cash_in_hand +'\n'+ total_expenditure +'\n'+ closing_cash_in_hand +'\n'+imp_total_in_transit);

	//return false;
	var vouchers=[];
	$(".voucher").each(function()
	
	{
		
		//vouchers.push($(this).find("td:first").html());
	
	
		if($(this).find(".chk_box").is(':checked'))
		{
		//vouchers.push($(this).find("td:second").html());
		vouchers.push($(this).attr("id"));
		
	}
	
	
	
	
	});
	 	 var imp_closing=0;
	if($("#chkbox_close_imprest").is(':checked'))
	{
		 imp_closing=1;
		 
		 //alert('imp_closing');
		 
		 //return false;
		 
		 
	}
	
	var vouchers_json = JSON.stringify(vouchers);
	
	//alert(myJSON); return;
	var note=$("#txt_area_note_for_voucher").val();
     	
     	
     	if(note=="")
     	{
			alert("Please enter Remarks");
			return false;
		}
     	
     var conf=confirm(" !! Warning You are going to Forward Imprest Vochers and Imprest Sheet .\n 1. This operations can be undone by deleting from out box before receiving office Process it. \n. 2. Once processed By receiving office No change whatsoever can be made. \n3.Remitence amount you have to remit at division in case  of imprest closing   \n 4. Please check all Details.\n \n Click Yes  to continue ? ");
if(!conf)
{
	alert("This Operations has been cancelled. Please try again");
	
 return false;	
}	
     	
     	
     	
     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_submit_vouchers",amount:$(this).val(),vouchers_json:vouchers_json,
		note:note,imp_closing:imp_closing,
		opening_cash_in_hand:opening_cash_in_hand,
		total_expenditure:total_expenditure,
		closing_cash_in_hand:closing_cash_in_hand,
		imp_total_in_transit:imp_total_in_transit


		
		},
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
	
		
		//alert(html);   
		
		$("#div_ajax_out").html(html);
		stop_ajax_loading_image();
		
		}
    
    
});   
        
        
    }
		
	);	
	
$(document).on("click","#btn_save_adjustments", function(){

	$("#invalid_entity").remove();
	
		
	var vouchers=[];

	var imp_operation=$(this).data('imp_operation');
	var imprest_num=$(this).data('imprest_num');


///resetting previous values if any
	if(imp_operation=="193" || imp_operation=="666")
		{
			$("#abstract_sheet_form").html("");

		}else{
			$("#abstract_sheet_carosal").html("");

		}

	var stop=0; /// for budget check
	$(".tr_voucher_new").each(function()
	

	
											{
												

												//alert(imprest_num);
												var voucher_id=$(this).attr('id');
												
												//vouchers.push($(this).find("td:first").html());
											var table=$(this).find(".adj");
											var item_num=0;
											var voucher_details=[];


 
											//alert(table.attr('id'));
											$(table).find(".tr_template").each(function()
													{

///budget error checker
var stop1=$(this).find(".div_budget_alert").data('stop_error');
//alert(stop1);
stop=stop+stop1;

														//alert($(table).attr('id'));
																	var item_name=$(this).find(".item_name1").val();
																	var item_amount=$(this).find(".item_amount1").val();
																	var item_acc_code=$(this).find(".item_acc_code1").val();
																	var item_desc=$(this).find(".item_desc1").val();
																	item_num++;	

var row={imprest_num:imprest_num,voucher_id:voucher_id,item_num:item_num,item_name :item_name,item_amount:item_amount,item_acc_code:item_acc_code,item_desc:item_desc};



voucher_details.push(row);



													}

													

													
											
											);
											
											//alert(voucher_id);
											vouchers.push(voucher_details);
												
											
											
											
											
											});
	 	 
	
	var vouchers_json = JSON.stringify(vouchers);
	
	//alert(myJSON); return;
	
     	if(stop>0){

var a=0;
				 //alert("Please check  the budget provions for exhausted items.\n CORRECT THE ITEMS AND TRY AGAIN ");
				 //return false;
			 }
     	
     	
//      var conf=confirm(" !! Warning You are going to Forward Imprest Vochers and Imprest Sheet .\n 1. This operations can be undone by deleting from out box before receiving office Process it. \n. 2. Once processed By receiving office No change whatsoever can be made. \n3.Remitence amount you have to remit at division in case  of imprest closing   \n 4. Please check all Details.\n \n Click Yes  to continue ? ");
// if(!conf)
// {
// 	alert("This Operations has been cancelled. Please try again");
	
//  return false;	
// }	
     	
     	
     	
     	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_save_adjustments",vouchers_json:vouchers_json,imprest_num:imprest_num},
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
	
		
		//lert(html);

		
		var err=html.split("*")[0].trim();


		//console.log(err);
		//console.log(html);


		
		//$("#div_ajax_out").html(html);
		


//////////////////////////////////////show abstract//////////////////////////////////////////////////////////

//alert(imprest_num);
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"prepare_abstract",imp_ref_id:imprest_num,class1:'col-sm-12 '},
   
    
    success: function(html){ 
		
		
		
		//alert(imp_operation);
		if(imp_operation=="193" || imp_operation=="666")
		{
			$("#abstract_sheet_form").html(html);

		}else{
			$("#abstract_sheet_carosal").html(html);

		}
		
		
		$("#show_submit_to_expac_after_abstract_prep").show();
		$("#ajax_loading").modal('hide');

		stop_ajax_loading_image();
		
		if(err=="NO_ERROR"){

			$(".intern").prop("disabled",false);
		}else

		{

			$(".intern").prop("disabled",true);
 alert("Some Error has Occoured.\n Please Press Save Adjustment Button and Try Again");

		}


		var txtpayee=$("[name=txtpayee]").val();
		//alert(txtpayee);
		if(txtpayee=="-"){



			if(imp_operation=="193" || imp_operation=="666")
		{
		
		var error_div="<div class='alert alert-danger'><span class='fa fa-stop-circle fa-2x'></span>&nbsp;<br>STOP!!<br>Payee is not correctly added.<br> Check the imprest holder details <br> verify the imprest holder is given correct employee code and correct office code <br> Issue with entity . Contact 9446 485 934  </div>";
			$("#abstract_sheet_form").append(error_div);

		}else{
			var error_div="<div class='alert alert-danger'><span class='fa fa-stop-circle fa-2x'></span>&nbsp;<br>STOP!!<br>Payee is not correctly added.<br> Check the imprest holder details <br> verify the imprest holder is given correct employee code and correct office code <br> Issue with entity Contact 9446 485 934 </div>";
			$("#abstract_sheet_form").append(error_div);
			
			$("#abstract_sheet_carosal").append(error_div);

			$(".intern").prop("disabled",true);
		}
			
			
			$("#sub_to_expac").prop("disabled",true);
 
		}
		if($("#invalid_entity").length){

$("#sub_to_expac").prop("disabled",true);
}
		
		  
		
		
		}
    
    
});	
	/////////////////////////////////////////////////////////////////////////




		
		}
    
    
});  


        
        
    }
		
	);	
	
	
	
	
	
	

	
	
	

//var url="imprest_ajax.php";




$(document).on("click",".btn_fwd_voucher", function(){
	
	// removing has error set if any
		$("#sel_branch").parents("td").removeClass("has-error");
	
	


	var inReceiversInBox=1;
	var imp_operation=$(this).data('imp_operation');
	var imp_op_id=$(this).data('imp_op_id');
	var result_target=$(this).parents(".result_target").attr("id");
	var vouchers=[];
	var num_of_vouchers=0;
	

	
	$(".voucher").each(function()
		{
		if($(this).find(".chk_box").is(':checked'))
		{
		vouchers.push($(this).find("td:first").html());
		num_of_vouchers=num_of_vouchers+1;
		
	}
	});
	
	
	//if(num_of_vouchers==0) {alert("Select at least one voucher for this operation"); return false;}
	var vouchers_json = JSON.stringify(vouchers);
	
	//alert(vouchers_json);
	
	
	var to_office=$(this).attr("id")
	var msg=$("#txt_area_voucher_note").val();
	//var imprest_ref_id=$("#txt_area_voucher_note").attr("name");
	
	var imprest_ref_id=$("#txt_area_voucher_note").data("imp_ref_id");
	//var imprest_ref_id=$("#txt_area_voucher_note").data("imp_ref_id");
	
//alert(imprest_ref_id);
	
	var branch_id=$(this).attr("name");	
	
	if($("#txt_area_voucher_note").val()=="")
{
alert("Please write Remarks ");
$("#txt_area_voucher_note").parents("td").addClass("has-error");
 return false;	
}

	
	
	//alert($(this).data('ineten')); return false
		
		//// submit to expac cases parrele movement
		
		
	if($(this).data('ineten')=='intern')
	{
		if($("#sel_branch_sel").val()==0)

{
alert("Please select a branch");
$("#sel_branch_sel").parents("td").addClass("has-error");
 return false;
}
	}	
		
		
		if(($(this).attr("id")=="sub_to_expac"))


{


//checking whetehr requested amount is higher than paasing amount

var passing_amount=parseInt($("#td_total_passed_amount").html());
var requested_amount=parseInt($("#td_tot_exp").html());

if(passing_amount>requested_amount){


	alert("The Amount about to pass is greater than Amount requested by imprest holder.\nPlease check the adjustment sheet and fix the issue. \nAmount Requested :"+ requested_amount +"\nAmount Passing :"+ passing_amount );
return false;

}

//alert(passing_amount+"\n"+requested_amount);

	
	//alert("sub to expac");
		inReceiversInBox=0;
		var branch_id=$("#sel_branch_sel").val();
		var imprest_ref_id=$("#txt_area_voucher_note").data('imp_ref_id');
		var to_office=$("#txt_area_voucher_note").data('to_office_id');
		var msg=$("#txt_area_voucher_note").val();
		//var to_office=$(this).attr("id");
		
		var msg1=$(this).parents(".panel-default").find("h3").html();

		var msgh3='m'+imp_op_id;

		var msg1=$("#"+msgh3).html();


		msg1=msg1.replace("<br>","");
		// console.log(msg1);
		// alert(msg1);
		// return false;
		var amount_tot=$("[name=txtamount]").val();
		msg=msg1+'\n Amount :'+ amount_tot+'\n Comments : '+msg;
		
		
		
		
		
				if($("#sel_branch_sel").val()==0)

{
alert("Please select a branch");
$("#sel_branch_sel").parents("td").addClass("has-error");
 return false;
}


if($("#txt_area_voucher_note").val()=="")
{
alert("Please write Remarks ");
$("#txt_area_voucher_note").parents("td").addClass("has-error");
 return false;	
}


//$("#form_submit_to_expac").submit();		
		
		
var formData = new FormData($("#form_submit_to_expac")[0]);
//formData.delete('txtdesci');
formData.append("txtdesci",msg);
formData.append("option","save_vouchers_in_saras");
formData.append("inReceiversInBox",inReceiversInBox);
formData.append("imp_op_id",imp_op_id);
formData.append("imp_operation",imp_operation);
formData.append("to_office",to_office);
formData.append("msg",msg);

formData.append("imprest_ref_id",imprest_ref_id);
formData.append("branch_id",branch_id);
formData.append("vouchers_json",vouchers_json);





//var formData="";






$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:formData,
    processData: false,
	contentType: false, 
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
	
		
		//$('#div_modal_id').html(html); 
		//$('#ajax_modal').modal('toggle');
		
		//$('#'+result_target).html(html); 
		//show_in_box();
		
		$('#div_ajax_out').html(html);
		
		stop_ajax_loading_image();

		/*  bypaseed to back end code
		//// DOING NEW IMPREST OPERATIONS
			$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_fwd_voucher",inReceiversInBox:inReceiversInBox,imp_op_id:imp_op_id,imp_operation:imp_operation,to_office:to_office,msg:msg,imprest_ref_id:imprest_ref_id,branch_id:branch_id,vouchers_json:vouchers_json},
    beforeSend: show_ajax_loading_image(),
    complete: stop_ajax_loading_image(),
    success: function(html){ 
	
		
		//$('#div_modal_id').html(html); 
		//$('#ajax_modal').modal('toggle');
		
		//$('#'+result_target).html(html); 
		//show_in_box();
		
		$('#div_ajax_out').append(html); 
		
		
		
		}
    
    
});	 
		
		stop_ajax_loading_image();
		

		*/  
		//alert(html);
		
		}
    
    
});




}



else {
	
	
//////////////////////////////return to feild new code////////////////////////////////////////////

if($(this).attr('id')=='btn_return_to_feild')
{

var inReceiversInBox=1;
var imp_op_id=$(this).data('imp_op_id');
var imp_operation=$(this).data('imp_operation');
var imprest_ref_id=$(this).data('imprest_ref_id');
var to_office=$(this).data('to_office');
var to_branch=$(this).data('to_branch');
var from_office=$(this).data('from_office');
var from_branch=$(this).data('from_branch');
var set_operation=$(this).data('set_operation');


	$.ajax({
			url: "imprest_ajax.php",
			cache: false,
			type:'POST',
			data:{option:"btn_fwd_voucher",
				inReceiversInBox:inReceiversInBox,
				imp_op_id:imp_op_id,
				imp_operation:imp_operation,
				to_office:to_office,
				to_branch:to_branch,
				msg:msg,
				imprest_ref_id:imprest_ref_id,
				
				
				vouchers_json:vouchers_json,
				from_office:from_office,
				from_branch:from_branch,set_operation:set_operation

				
				},



			beforeSend: show_ajax_loading_image(),
		
			success: function(html){ 
			
				
				
				$('#div_ajax_out').html(html); 
				stop_ajax_loading_image();
				
				
				
				}
			
			
		});	



}


//////////////////////////////return to feild new end////////////////////////////////////////////

		else
		{
			
			
			$.ajax({
			url: "imprest_ajax.php",
			cache: false,
			type:'POST',
			data:{option:"btn_fwd_voucher",inReceiversInBox:inReceiversInBox,imp_op_id:imp_op_id,
				imp_operation:imp_operation,to_office:to_office,msg:msg,imprest_ref_id:imprest_ref_id,branch_id:branch_id,vouchers_json:vouchers_json},
			beforeSend: show_ajax_loading_image(),
		
			success: function(html){ 
			
				
				//$('#div_modal_id').html(html); 
				//$('#ajax_modal').modal('toggle');
				
				//$('#'+result_target).html(html); 
				//show_in_box();
				
				$('#div_ajax_out').html(html); 
				stop_ajax_loading_image();
				
				
				
				}
			
			
		});	


		}




}

//stop_ajax_loading_image();
	
}


);




$(document).ready(function () {
  $(".navbar-nav li").click(function(event) {
    $(".navbar-collapse").collapse('hide');
  });
});


$(document).on("click","#btn_show_outbox ", function(){
	
	
		
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_show_out_box"},
    beforeSend: show_ajax_loading_image(),
    
    success: function(html){ 
	
		
		$('#div_ajax_out').html(html);  
		//$('#myNavbar').collapse('hide');  
		stop_ajax_loading_image(); 
		//alert("hi"+ html);
		
		}
    
    
});	
	
	
}
);
$(document).on("click","#btn_show_settings", function(){
	
	
		
	$.ajax({
    url: "imprest_settings.php",
    cache: false,
     type:'POST',
    data:{option:"btn_show_settings"},
    beforeSend: show_ajax_loading_image(),
    
    success: function(html){ 
	
		
		$('#div_ajax_out').html(html);  
		//$('#myNavbar').collapse('hide');  
		stop_ajax_loading_image(); 
		//alert("hi"+ html);
		
		}
    
    
});	
	
	
}
);


$(document).on("change","#chkbox_close_imprest", function(){
	
	if($("#chkbox_close_imprest").is(':checked'))
		{
		$("#tbl_remitance_details").show();
		$("#txt_txtremit").val($("#td_cash_in_hand").html());
		
		//show_remitanceAmount();
		}else if(!$("#chkbox_close_imprest").is(':checked'))
		{
			
			var conf=confirm("Do you want to delete the Existing Remitance Details");
			
			if(conf)
			
											{
											$("#tbl_remitance_details").hide();
											
												$.ajax({
								    url: "imprest_ajax.php",
								    cache: false,
								     type:'POST',
								    data:{option:"del_remitance_details"},
								    beforeSend: function(){var a=0;},
								    complete: function(){var a=0;},
								    success: function(html){ 
																						
											
											btn_show_imprest_cash_book();
											
											console.log(html);
										
											}
								        
								});	
										}
		
	}	
	
	});





$(document).on("click","#save_remitance_details ", function(){
	
	
	
	if($(this).hasClass('edit-btn'))
	{
		$(this).html('<span class="fa fa-floppy-o fa-lg"></span>&nbsp;Save Remitance Details');
	
	var ele=$(this);
	$(ele).removeClass("btn btn-info edit-btn");
	$(ele).addClass("btn btn-success save-btn");
	
	
	$(".edit1").prop("disabled",false);
	return false;
	}
	
	
	
	
		
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"save_remitance_details",
		source:$("#sel_payament_mode").val(),amount:$("#txt_txtremit").val(),
		receipt:$("#txt_txtremitrpt").val(),date:$("#txt_date_of_remitance").val()},
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
	
		btn_show_imprest_cash_book();
		stop_ajax_loading_image();
		//alert(html);
		//$('#div_ajax_out').html(html);   
		//alert("hi"+ html);
		
		
		
		
		}
    
    
});	
	
	
}
);
$(document).on("click","#save_remitance_details_and_convert", function(){
	
	

	var imprest_id_ref=$(this).data('imprest_id_ref');
	
	if($(this).hasClass('edit-btn'))
	{
		$(this).html('<span class="fa fa-floppy-o fa-lg"></span>&nbsp;Save Remitance Details');
	
	var ele=$(this);
	$(ele).removeClass("btn btn-info edit-btn");
	$(ele).addClass("btn btn-success save-btn");
	
	
	$(".edit1").prop("disabled",false);
	return false;
	}
	
	
	
	
		
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"save_remitance_details_and_convert",
		source:$("#sel_payament_mode").val(),amount:$("#txt_txtremit").val(),
		receipt:$("#txt_txtremitrpt").val(),date:$("#txt_date_of_remitance").val(),
		imprest_id_ref:imprest_id_ref
		},
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
	
		//btn_show_imprest_cash_book();
		stop_ajax_loading_image();
		show_in_box();

		//console.log(html);
		//alert(html);
		//$('#div_ajax_out').html(html);   
		//alert("hi"+ html);
		
		
		
		
		}
    
    
});	
	
	
}
);

</script>



<script>



</script>
<script>


$(document).on("change","#auto_certificate",function(){


if($(this).is(':checked'))
{

	var text;
	var text=`        \t\t                CERTIFICATE
	1. Verified and Found correct.
	2.The claim preferred in  bills has not been preferred previously
	3.The claim preferred in this bill is incurred for the bonafide purpose of the kerala state electricity board limited and of unavoidable nature.
	4.The purchase has been made at the lowest rate prevailing in the locality after conducting the local enquiry. 
	5.The articles received is in good condition and accounted properly.
	 `;

	

	 if($('#txt_area_voucher_note').length){
		var curr_text=$("#txt_area_voucher_note").text();
		$("#txt_area_voucher_note").text(curr_text+'\n'+text);

	 }else if($('#txt_area_note_for_voucher').length){

		var curr_text=$("#txt_area_note_for_voucher").text();
		$("#txt_area_note_for_voucher").text(curr_text+'\n'+text);
	 }






}else{

	$("#txt_area_note_for_voucher").text(curr_text);
	$("#txt_area_voucher_note").text(curr_text);
}

});


$(document).on("change","#auto_letter",function(){

var amount=$("#td_tot_exp").text();
if($(this).is(':checked'))
{

var name="<?php echo $_SESSION[full_name].',\n '.$_SESSION[designation].',\n '.$_SESSION[office_name]?>"; 

var text;
var d1 = new Date();

var d2 = d1.getDate();
var m =  d1.getMonth();
m += 1;  // JavaScript months are 0-11
var y = d1.getFullYear();
var d= d2+'-'+m+'-'+y;


	var text=`        \t\t                Covering LETTER
	Dear Sir/Madam,
	I am here with forwarding my permanant imprest account for the month of   for adjustment and early recoupment.
	Total Expendiure incured during this period is Rs `+amount+` .
	Yours Faithfully\n`+name + '\n' + d;
	if($('#txt_area_voucher_note').length){
		var curr_text=$("#txt_area_voucher_note").text();
		$("#txt_area_voucher_note").text(curr_text+'\n'+text);

	 }else if($('#txt_area_note_for_voucher').length){

		var curr_text=$("#txt_area_note_for_voucher").text();
		$("#txt_area_note_for_voucher").text(curr_text+'\n'+text);
	 }
	}

});

</script>


<script>
$(document).on("change","#auto_text_per_imp_request",function(){

var amount=$("#txt_perm_imp_amnt").text();
if($(this).is(':checked'))
{

var name="<?php echo $_SESSION[full_name].',\n '.$_SESSION[designation].',\n '.$_SESSION[office_name]?>"; 

var text;
var d1 = new Date();

var d2 = d1.getDate();
var m =  d1.getMonth();
m += 1;  // JavaScript months are 0-11
var y = d1.getFullYear();
var d= d2+'-'+m+'-'+y;


	var text=`        \t\t                Covering LETTER
	Dear Sir/Madam,
	I am here with forwarding my Fresh permanant imprest Request for an amount of `+amount+` for meeting the office contigency expenses for this financial year.
	
	Yours Faithfully\n`+name + '\n' + d;
	if($('#txt_area_request_perm_imprest').length){
		var curr_text=$("#txt_area_request_perm_imprest").text();
		$("#txt_area_request_perm_imprest").text(curr_text+'\n'+text);

	 }else if($('#txt_area_request_perm_imprest').length){

		var curr_text=$("#txt_area_request_perm_imprest").text();
		$("#txt_area_request_perm_imprest").text(curr_text+'\n'+text);
	 }
	}

});

</script>
<script>

function btn_show_imprest_cash_book()

{
			
	$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:"btn_show_imprest_cash_book"},
    beforeSend: function(){ 
			
		show_ajax_loading_image()
		
		} ,
    complete: function(){ var nop=0;},
    success: function(html){ 
	
		
		$('#div_ajax_out').html(html);   
		stop_ajax_loading_image();
		
		}
    
    
});	
	
	}

$(document).on("click","#btn_show_imprest_cash_book,#btn_view_and_verify_cash_book",function(){ btn_show_imprest_cash_book()});





$(document).ready(function(){show_in_box()});
$(document).on("click","#btn_show_inbox,#btn_view_in_box",function(){show_in_box();});
























</script>





<script>
	
	function show_ajax_loading_image(){
		
		$("#ajax_loading").modal('show');
		}
	
	function stop_ajax_loading_image(){
		
		$("#ajax_loading").modal('hide');
		}
	
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
	//$(document.body).on('ready','[data-toggle="tooltip"]' ,function(){ $(this).tooltip()});
	 
	//$("#ul_show_more").hide();
	$("#ul_show_more").show();
	
	$("#btn_show_options").click(
	
	function() {$("#ul_show_more").slideToggle();
	
	//$("#btn_show_options").attr("id","btn_hide_options");
	
}
	
	);
	
	
	/*
	$("#btn_hide_options").click(
	
	function() {$("#ul_show_more").hide();
	
	$("#btn_hide_options").attr("id","btn_show_options");
	
}
	
	);
	
	*/
	
	
	
	
	
	
	
	
/////////////////////////////////////////////////////////////////request imprest button click////////////////////////////////////
$("#btn_request_imprest").click(function(){

$.ajax({
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:1},
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ $('#div_ajax_out').html(html);
		
		 stop_ajax_loading_image();   }
    
    
});	
	
	
	
});
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////// v to vc click////////////////////////////////////

	$(document).on("click","#convert_to_closing",function(){
var close=$(this).data('close');
var imprest_id_ref=$(this).data('imprest_id_ref');
//var close=1;
var btn=$(this);
var option="toggle_v_to_vc";
$.ajax({

	
    url: "imprest_ajax.php",
    cache: false,
     type:'POST',
    data:{option:option,close:close,imprest_id_ref:imprest_id_ref},
    beforeSend: show_ajax_loading_image(),
   
    success: function(html){ 
		
		
		//$(btn).html(html);

		$(btn).removeClass("btn-warning");
		$(btn).addClass("btn-block");
		$(btn).data('close',0);
		 stop_ajax_loading_image(); 
		 
		 //show_in_box();  
		 }
    
    
});	
	
	
	
});
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function load(html)

{
	$('#div_ajax_out').html(html);
}




/////////////////////////////////// add voucher ////////////////////////////

// $(document).on("click","#btn_add_voucher",function () {

// 				//var option="tbody_imp_vouchers";
	
// 					$.ajax({
// 				    url: "imprest_ajax.php",
// 				    cache: false,
// 				     type:'POST',
// 				    data:{option:option},
// 				    beforeSend: show_ajax_loading_image(),
				    
// 				    success: function(html){ $('#div_permanant').html(html);
// 					 carosal_load();stop_ajax_loading_image();   }
				
    
    
//     }
// );}
// );




/////////////////////////////////////////////////////////////////////////

function call_recoupment_form(){

				if($(window).width() >= 1024){
  var mobile=0;
}else
{
	var mobile=1;

}
	
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"call_recoupment_form",mobile:mobile},
				    beforeSend: show_ajax_loading_image(),
				    
				    success: function(html){ $('#div_ajax_out').html(html);stop_ajax_loading_image();   }
				
    
    
    }
);


}
function call_recoupment_form_date(startDate,endDate){

				if($(window).width() >= 1024){
  var mobile=0;
}else
{
	var mobile=1;

}
	
	
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"call_recoupment_form",mobile:mobile},
				    beforeSend: show_ajax_loading_image(),
				    
				    success: function(html){ $('#div_ajax_out').html(html);stop_ajax_loading_image();
							$( "#txt_date_of_payement" ).data("date-start-date", startDate);
							
							$( "#txt_date_of_payement" ).data("date-end-date", endDate);
							
							$( "#txt_date_of_voucher" ).data("date-end-date", endDate);




							//alert($( "#txt_date_of_payement" ).data("date-start-date"));
							//alert($( "#txt_date_of_payement" ).data("date-end-date"));
						
						   }
				
    
    
    }
);


}

/////////////////////////////////////////////////////////////////////////////////RECOUPMENT OF IMPREST //////////////////////////////////////
$(document).on("click","#btn_adjust_imprest",function () {
//	call_recoupment_form();

$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"btn_show_initial_setup"},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
							//call_recoupment_form();
						$('#div_ajax_out').html(html); 




						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						//carosal_load();
						 stop_ajax_loading_image();  

						 var i_month=$("#i_month").val();
           var i_year =$("#i_year").val();

						 
						 var minMax = getMinMaxCurrentDate(i_year,i_month);
						 var minMax = getMinMaxCurrentDateMy(i_year,i_month);

						
							var mindate=i_year+"-"+i_month+"-"+"01";
							var mindate="01"+"/"+i_month+"/"+i_year;
						
						
							var maxdate=i_year+"-"+i_month+"-"+minMax[1];
						
						//alert(minMax[1]);
							var maxdate=minMax[1]+"/"+i_month+"/"+i_year;

var i_month_next=i_month+1;
							var maxdate=minMax[1]+"/"+i_month+"/"+i_year;

							$( "#txt_date_of_payement" ).data("date-start-date", mindate);
							
							$( "#txt_date_of_payement" ).data("date-end-date", maxdate);
							
							$( "#txt_date_of_voucher" ).data("date-end-date", maxdate);

							//call_recoupment_form_date(mindate,maxdate);
						 $('#btn_bill').prop('disabled',true);

						 show_live_balance(0,0);
						  }
				
    
    
    }
);



}
);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////save month details

function getMinMaxCurrentDate(i_year,i_month) {
   var d = new Date(i_year+","+i_month+",01");
	 //alert(d);
   var day = d.getDate();         // range 1-31
   var month = d.getMonth() + 1;  // range 1-12
   var year = d.getFullYear();    // ie. (2011)
   var max;


//cae



   if (month <= 7) {
      if (month == 2) {
         // check for leap years for Febuary
         var isLeap = new Date(year,1,29).getDate() == 29;
         max = 28 + (isLeap ? 1 : 0);
      } else {
         max = (month & 1) ? 31 : 30;
      }
   } else {
      max = (month & 1) ? 30 : 31;
   }


//alert(max);
//alert(-day);
//alert(max-day);
   return [-day, max - day];

}



function getMinMaxCurrentDateMy(i_year,i_month) {
  //  var d = new Date(i_year+","+i_month+",01");
	//  //alert(d);
  //  var day = d.getDate();         // range 1-31
  //  var month = d.getMonth() + 1;  // range 1-12
	//  var year = d.getFullYear();    // ie. (2011)
	
	var month = parseInt(i_month);
   var max=31;

	//  alert(i_month);
	//  alert(month);

switch (month){

case 1:
case 3:
case 5:
case 7:
case 8:
case 10:
case 12:


max=31;
break;

case 4:
case 6:
case 9:
case 11:

max=30;
break;
case 2:
var isLeap = new Date(year,1,29).getDate() == 29;
         max = 28 + (isLeap ? 1 : 0);
break;


}

//alert(max);

   return [1, max];

}



$(document).on("click","#edit_month_details",function(){

//check whetehr any vouchers are uploaded  only then alow to change
var ele=$(this);
$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"check_any_voucher_uploaded"},
				    //beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){

//alert(html);

html=html.trim();

console.log(html);
if(html=="ALLOW"){
	ele.attr("id","btn_save_month_details");
	ele.attr("class","btn btn-info");
	ele.text("Save Month Details");
	$("#i_month").prop("disabled",false);
	$("#i_year").prop("disabled",false);
	stop_ajax_loading_image();

}else
{
	
	alert("Already some vouchers are uploadedin current Month.\nIF you still wanted to change the current Month, Delete vouchers uploaded");
	stop_ajax_loading_image();
}
						


						}




						

});

});



$(document).on("click","#btn_save_month_details",function (){

var i_month=$("#i_month").val();
var i_year =$("#i_year").val();

//alert(i_month);
					$.ajax({
				    url: "imprest_ajax.php",
				    cache: false,
				     type:'POST',
				    data:{option:"btn_save_month_details",i_month:i_month,i_year:i_year},
				    beforeSend: show_ajax_loading_image(),
				   
				    success: function(html){
						
							


							/// date picker limiting

							stop_ajax_loading_image();  
							var minMax = getMinMaxCurrentDate(i_year,i_month);
							var minMax = getMinMaxCurrentDateMy(i_year,i_month);

						
							var mindate=i_year+"-"+i_month+"-"+"01";
							var mindate="01"+"/"+i_month+"/"+i_year;
						
						
							var maxdate=i_year+"-"+i_month+"-"+minMax[1];
							var maxdate=minMax[1]+"/"+i_month+"/"+i_year;

							call_recoupment_form_date(mindate,maxdate);
							//alert(mindate);

							// console.log(html);

							//alert($( "#txt_date_of_payement" ).data("date-end-date"));
							
							//alert($( "#txt_date_of_payement" ).data("date-end-date"));
							//$( "#txt_date_of_payement" ).data({ minDate: minMax[0], maxDate: minMax[1] });

							/////
						//$('#div_ajax_out').html(html); 
						//$('#ajax_modal').html(html);
						///$('#ajax_modal').modal('show'); 
						//carosal_load();
						 
						 
						 
						 
						  }
				
    
    
    }
);

}
);







/////////////////////////////////////////////////////////////////////////////////view imprest vouchers //////////////////////////////////////
$(document).on("click","#btn_show_imprest_vouchers",function(){view_imprest_vouchers();

$("#item_acc_code").prop("disabled",false);


}
);
$(document).on("click","#btn_show_imprest_vouchers2",function(){view_imprest_vouchers2();

$("#item_acc_code").prop("disabled",false);


}
);

//////////////////////////////////////////////////////////////////////////////////////////////////////////











});




</script>

 <style>
.myBut3{
	background:none;
	display:block;
	padding:10px;
	border:none;
	width:75px;
	height:75px;
	border-radius:50px;
	background-color:blue;
	//margin
	
	
	
	}
	
	
	 
	.myBut1{
	background:none;
	display:block;
	padding:1px;
	border:none;
	width:30px;
	height:30px;
	border-radius:15px;
	background-color:white;
	//margin
	
	
	
	
	
	
	10
	}


</style>


<script src='../bootstrap/jquery.elevatezoom.js'></script>
	<script>
	$(".zoom").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5});


    $('.zoom').elevateZoom({
		zoomType				: "lens",
  lensShape : "round",
  lensSize    : 200
   
   
   
   }); 
</script>

<script src='../bootstrap/jquery.elevatezoom.js'></script>
	<script>
	$(".zoom").elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5});


    $('.zoom').elevateZoom({
    zoomType: "inner",
cursor: "crosshair",
zoomWindowFadeIn: 500,
zoomWindowFadeOut: 750
   }); 
</script>

<script>



</script>
<script>

$("#btn_add_file_for_imprest").
click(function(){

var newId=$("#ol_upload_documents").find(">li").length+1;
out="<div class=well>";
out=out+"<li><label for=\"fileToUpload\" "+newId+" > <i class=\"fa fa-cloud-upload fa-fw fa-2x text-success\">  </i></label> <input type=\"text\"  id=\"fileToUpload"+newId;
out=out+"\" style=\"display:inline-block\" placeholder=\"Type of Document:\" />	<input type=\"file\" id=\"fileToUpload"+newId+"\" style=\"display:inline-block\" />";
out=out+"<i class=\"fa fa-trash-o fa-1x i_delete_doc\" style=\"color:red;display:inline-block\" title=\"Delete\" data-placement=\"right\" data-toggle=\"tooltip\">  </i></div>  </li> ";

 $("#ol_upload_documents").append(out);

});


$(document).on("click",".i_delete_doc",function()


{
	if(confirm("Do you wanted to remove This Document"))
	{
		$(this).closest(".well").remove();
		alert("Document Removed succesfully");
		
	}
	
	});
</script>

 <?php


//

//echo "test";
 
 
 
 
 
 
 
 
 
 
 //<?php
	 function round_btn($id="id",$class="myBut",$toolTip="click",$fontAwesome="fa fa-inr fa-5x",$iStyle="color:white",$text="")
	 {
		 echo  "<button id=$id
	  class=\"$class\" data-toggle=\"tooltip\" title=\"$toolTip\" data-placement=\"left\"><i class=\"$fontAwesome\" style=\"$iStyle\"></i>
	  &nbsp;
	  <span style='color:white; font-size:11px'>
	  $text
	 </span>
	  </button>";
	
		 
		 }
	 ?>
<!--
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <i class="fa fa-ksebl fa-2x faa-pulse animated"></i>
        
      </a>
    </div>
  </div>
</nav>

-->

		


<!-- </div>  -->

<div class=row >
			<div class="col-sm-12">
				<div>
	<!--

		
					<?php 
					//print_r($_SESSION);
					
					round_btn("btn_show_options","myBut","Show Options","fa fa-angle-double-down fa-5x","color:red") ?>	 
	 

				-->
				<div id=sideButton>
				
				<nav  class="navbar  <?php echo $navbar_fixed_top ?>">
  <div class="container-fluid">
    <div class="navbar-header " >
      <a class="navbar-brand"  style="color:#fff;" href="#">Imprest</a> <br>
      <p class="fa fa-ksebl fa-4x faa-pulse animated   "></p>
	  
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
    </div>
	
	<div class="collapse navbar-collapse" id="myNavbar" style="margin:auto">
					<ul id=ul_show_more class="nav navbar-nav" style="display: inline;" style="margin:auto">
						
						<?php
						//print_r($_SESSION);
							if($_SESSION[office_code]!= $_SESSION[aru_code])
							{?>
						
						<?php 

//check from a_imprest whether reached delegation limit in fy in empcode in same office



$date = date("Y-m-d");

$fy = imprestN::findFinancialYear($date);
// $qry="select sum(amount) from a_imprest where 
// imp_holder='$_SESSION[user_name]' and
// imp_holder_office='$_SESSION[office_code]' and
// imp_fy='$fy'";
// $db->DBbeginTrans();


$sum=imprestN::getSumOfIssuedImprestInFy($_SESSION['user_name'],
$_SESSION['office_code'], $freshIssuebeforeDate);

$delegationAmount=imprestN::getPermanantImprestAmount();

// if($_SESSION['aquired']==1){
// 	if($delegationAmount<=$sum)
// 	echo "$sum is requested and $delegationAmount is delegation";
	


// }



// check whether cash_in_hand  entry is present in fy limit in fy in empcode in same office

$qry="select COALESCE (sum(amount),0) as sum from a_imprest_voucher where imp_holder='$_SESSION[user_name]'
and imp_holder_office='$_SESSION[office_code]' and type='cash_in_hand'
and imp_fy='$fy'


";

$db = new DBAccess;
$row = $db->SelectData($qry);

// $row=$db->SelectData($qry);

$cash_in_hand=$row[0]['sum'];

// if($_SESSION['aquired']==1){
// 	if($delegationAmount<=$sum)
// 	echo "$cash_in_hand is cash in hand and $delegationAmount is delegation";
	


// }



if($delegationAmount<=$sum){
	$ShowFreshRequestButton=false;
	
}else{
	$ShowFreshRequestButton=true;

}


if($delegationAmount<=$cash_in_hand){
	$ShowFreshRequestButton=false;
	
}



						// $ShowFreshRequestButton=true;

						if($ShowFreshRequestButton)
						{
						
						?>
						
						
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_request_imprest","myBut",
							"Request Imprest","fa fa-inr fa-sm","color:red",
							"Request Fresh Imprest") ?>	
						

						
						
						</li>
						<?php } ?>


						<?php
						//print_r($_SESSION);
							if(1)
							{?>
						<li style="display: inline;" class="list-inline-item">

						
							<?php  round_btn("btn_adjust_imprest","myBut","Adjust Imprest","fa fa-balance-scale fa-lg","color:yellow","Upload Vouchers ") ?>	
						
						</li>
<?php
}?>

						
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_imprest_vouchers2","myBut","Edit Delete Vouchers","fa fa-edit fa-lg","color:orange","View-Edit/Delete Vouchers") ?>	
						
						</li>
						
						
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_imprest_cash_book","myBut","Imprest cash Book","fa fa-power-off ffa-lg","color:pink","Submit Vouchers") ?>	
						
						</li>
						

						<?php
							}?>
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_reports","myBut","Reports","fa fa-files-o fa-lg","color:pink","Reports"); ?>	
						
						</li>
						
										
					
						
					
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_inbox","myBut","Show In Box","fa fa-envelope-o fa-lg","color:green","Inbox") ?>	
						</li>
						
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_outbox","myBut","Show Out box","fa fa-send-o fa-lg","color:blue","Outbox") ?>	
						</li>
						
					
						<?php
						//print_r($_SESSION);
							if((in_array($_SESSION['user_name'],array(1064767,1058642,1066892,1046855,1049072,1042429,1064380,1040232,1048592)))|| $_SESSION[aquired]==1 )
							{?>
						<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_settings","myBut","Settings","fa fa-cog fa-lg","color:golden","settings") ?>	
						</li>
						<?php
							}
						?>
						
						
					
						

					<?php 
					if((in_array($_SESSION['user_name'],array(1064767,1058642,1066892,1046855,1049072,1042429,1064380,1040232,1048592)))|| $_SESSION[aquired]==1)
					
					///if($_SESSION[user_name]==1064767 || $_SESSION[aquired]==1)
					
					{
						?>
<li style="display: inline;" class="list-inline-item">
							<?php round_btn("btn_show_super_admin","myBut","Super Admin","fa fa-user-secret fa-lg","color:red","SUPER ADMIN") ?>	
						</li>
						<?php
						
					}?>
						
					
						<li style="display: inline;" class="list-inline-item" style="font-size:small">
					<?php		
						//print_r($_SESSION);

						$name=$_SESSION[full_name];
						$desig=$_SESSION[designation];
						$office_name=$_SESSION[office_name];
						$branch=$_SESSION[branch];
						$empcode=$_SESSION[user_name];
						$office_code=$_SESSION[office_code];

						$msg="$name &nbsp; $empcode <br>$desig $branch,<br>$office_name - $office_code";
						?>
						<?php //round_btn("btn_user_details","myBut",$msg,"fa fa-user fa-sm","color:pink",$msg) ?>	
						
						<div class="alert alert-primary">
						<span class="fa fa-user fa-sm" ></span>
						&nbsp;
						<span style='font-size:11px'><?php echo $msg;?></span>
						
						</div>
						
						
						
						</li>
						<li style="display: inline;" class="list-inline-item fa fa-question-circle fa-sm">
						</li>
					
					</ul>

				 <!-- <span style="color:red;font-size:30px;"> 
					ARU offices do not use The software now or call to help line.<br>No issues to feild offices</span> -->
					 
					
					</div>
					 </div>
</nav>
  
					
					
				</div>
	</div> 


</div>

</div>


<!-- <div style='margin-top:2%'>  style='margin-top:117px-->
<div class=row style="padding-top:75px">

	<div class="col-sm-12 col-xs-12" style="padding-top:1px" >
	
	
			
	
	
	
	
		
<?php commonI::panel("div_ajax_out","panel-default","<h2><span style='color:#fff'>Imprest</span> <div style=\"text-align:right;display:inline-block\"><span  class=\"fa fa-ksebl fa-4x faa-pulse animated   \"></span></div></h2>","","Regional IT Unit Kozhikode

<span class=text-danger>In case of any issue Please whatsapp your issue to this number .9447 954 719 OR   9847599946. Please quote ur employee code in all correspondences </span>

","col-sm-12") ?>
		
	
	
	</div>




</div>


<div class=row>
	<div id=div_report_out class='col-sm-6' style='height:500px;overflow: auto;'>
	
	</div>
	
	<div id=div_report_out_res class='col-sm-6'>
	
	</div>
	 
	</div>

<!-- </div> -->

<!-- </div> -->

<div class="modal fade" id="ajax_modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id=modal_title>Message</h4>
        </div>
        <div class="modal-body" id=div_modal_id>
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>	
	
<div class="modal fade" id="ajax_loading" role="dialog" >
    <div class="modal-dialog modal-lg" >
      <div class="modal-content text-center">
       
	        <div class="modal-body" id=div_modal_id_load style="position:absolute;top:50%;left:30%;width: 100%;height: 100%; margin: 0; top:350px;left: 0;">
          <!-- <i class="fa fa-spinner fa-5x fa-spin" style="color:violet"></i>
          <i class="fa fa-spinner fa-5x fa-spin" style="color:indigo"></i>
          <i class="fa fa-spinner fa-5x fa-spin" style="color:blue"></i>
          <i class="fa fa-spinner fa-5x fa-spin" style="color:green"></i> -->
          <i class="fa fa-ksebl fa-5x fa-pulse" style="color:blue"></i>
          <!-- <i class="fa fa-spinner fa-5x fa-spin" style="color:orange"></i>
					<i class="fa fa-spinner fa-5x fa-spin" style="color:red"></i> -->
		<br>			
<p id=ajax_loading_message  style="color:red"></p>

           <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>
       
      </div>
    </div>
  </div>	
	
	<div id=vivek>
	
	</div>

<style>

/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   speak for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading.modal {
    display: block;
}

</style>

<script>




</script>
<div class="modal"><!-- for ajax busy loading --></div>
<style>


.navbar-inverse {
    background-color: #4267b2;
    border-bottom: 1px solid #29487d;
	color:#fff;
    margin:auto;
  
}</style>



<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal_show_voucher'>Trigger modal</a> -->
<div class="modal fade" style="padding:100px" id="modal_show_voucher">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Voucher</h4>
			</div>
			
			
			<div class="modal-body" id=div_modal_voucher>
				
			</div>
			<div class="modal-footer">

			<div id=adj_details></div>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>

<style>
.modal-backdrop {
  z-index: -1;
}

</style>

<?php
}
else{


	//imprestN::show_alert("Imprest Software is under maintenance . Will be back shortly . whatsapp 9847599946 ");

	echo "<h1 style='color:blue;background:yellow;'>Imprest Software is under maintenance . Will be back at  10 AM on 26/06/19 . whatsapp 9847599946<h1>";

}
?>
