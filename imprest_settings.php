<?php

session_start();
include_once("imprest.class.php");
//print_r($_SESSION);
//echo "this is loccode".$loccode;


if($_SESSION[logged_in]==1)
{

switch ($_POST["option"]){


case "btn_show_settings":

	// echo $_SESSION[higher_office_code]."<br>"; 
	// echo $_SESSION[office_code];
?>



<div class="container">
    
    <div class="row">
        



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    

<table class='table table-stripped table-hovered table-bordered'>


<tr class='bg-info'>
    <td>

<?php




	
	
$date=date("Y-m-d");
	$fy=imprestN::findFinancialYear($date);
$qry="select amount,to_char(date_of_payment,'DD/MM/YYYY') as date_of_payment from a_imprest_voucher where type='cash_in_hand' 
and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and imp_fy='$fy'";


//echo $qry;

$db = new DBAccess;
	$row=$db->SelectData($qry);
	if($row[EOF]==1){

    }else{

        $row1=$row[0];
        $amount=$row1[amount] * -1;
        $date=$row1[date_of_payment];
        $btn_text="Edit";

    }

?>

    




        
<div class=row id=div_cash_in_hand>
	<div class=col-sm-12>
		<label class=text-danger>Enter The Imprest Cash Received by Fresh Issue </label>
		<input type=text class='form-control' disabled=disabled id=txt_cash_in_hand  value="<?php echo $amount ?>">
		<label class=text-danger>Date on which Cash in hand is Given above </label>

		<?php echo imprestN::datePicker("txt_date_of_cash_in_hand","txt_date_of_cash_in_hand",$date,"form-control","disabled=disabled"); ?>


		
	</div>
		



</td><td>

<!-- <button class='btn  btn-lg btn-success' id=btn_save_cash_in_hand >Save Cash in Hand</button> -->
        <button class="btn btn-warning" id="edit_cash_in_hand">Edit</button>
    
    


    </td>
</tr>
</table>


</div>

    


        


    
  
    </div>
    
</div>






<!-- <div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Do not Use this section  now</strong> under develeopemnt
</div> -->



	

<div class="row">

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	

</div>
<div>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id=div_landing_super_div>
	
<?PHP
// FROM OFFICE SELETION


	//$db=new DBAccess;
	

	// to branch selection 

	


	// checking landing rule
	$to_office=$_SESSION[office_code];
	$qry="select * from a_imprest_landing where to_office=$to_office";
	$db = new DBAccess;
				$row = $db->SelectData($qry);
				if ($row[EOF] == 1) {

					?>

<button type="button" class="btn btn-success text-center" id=btn_create_landing_rule><span class=" fa fa-plus-square"></span>&nbsp;Create  Landing Rule</button>

					<?php
				}else{
?>
					<div id=div_landing_rule>

					<table class="table table-bordered table-hover" id=tbl_landing>
	<caption CLASS="bg-primary text-center">CREATE LANDING RULE</caption>
	<thead class="bg-info text-center">
		<tr>
			<th>SL NO</th>
			<th>FROM OFFICE</th>
			<th>TYPE</th>
			<th>RE DIRECT TO BRANCH</th>
			<th >Actions</th>
			<th><button class='btn btn-success' id='btn_add_landing_rule'> <span class='fa fa-plus'></span> Add landing rule</button></th>
			
		</tr>
	</thead>
	<tbody>

	<?php 
//print_r($row);
	foreach($row as $r1){

		?>
		<tr class="clone_landing">
			<td>1</td>
			<td><?php imprestN::select_from_office($r1[from_office],"disabled=disabled"); ?></td></td>
			<td>
				<?php
if($r1[imp_type])
				?>
				<select name=type disabled=disabled class="imp_type form-control" id="">
				
				<option <?php if($r1[imp_type]==0){echo "selected=selected";}  ?> value="0">select</option>
				<option <?php if($r1[imp_type]=="P"){echo "selected=selected";}  ?>  value="P">Fresh Request</option>
				<option <?php if($r1[imp_type]=="V"){echo "selected=selected";}  ?> value="V">Recoupment</option>
				<option <?php if($r1[imp_type]=="VC"){echo "selected=selected";}  ?> value="VC">Final Closing</option>
			
			
			</select>
			</td>
			<td>
			<?php
			//imprestN::GetSectionsTransType(104,$r1[to_branch],"disabled=disabled");
			//imprestN::GetSectionsTransTypeWithPrivillage("cmbsec",104,$r1[to_branch],"disabled=disabled");
			imprestN::GetSectionsTransTypeWithPrivillage("cmbsec",104,1,"");
			?>	
			</td>
			
<td>


<button type="button"  data-office_code='<?php echo $_SESSION[office_code];?>' class="btn btn-warning btn_edit_landing">Edit</button>

</td>
<td>

<button type="button" class="btn btn-danger">Delete</button>
</td>
		</tr>

		<?php

	}
		?>


	
	
	</tbody>
</table>




					</div>
<?php
				}
	
?>






</div>


	<?php 
//atrib 1== landing page
$qry="select * from a_imp_settings where object='$_SESSION[office_code]' and attrib=1";
$db=new DBAccess;
$row=$db->SelectData($qry);


//$db=new DBAccess;

if($row[EOF]==1){

	$landing="";
}else
{
	//$row1=$row[0];
	$landing1=$row[0];
	$landing=$landing[value];



}
//echo $qry;
$db=new DBAccess;


	$qry="select branch,branch_Id from vw_office_setup where office_code='$_SESSION[office_code]'  and is_live";

	//echo $qry;
	$db=new DBAccess;



//echo $qry;
$row=$db->SelectData($qry);


if($row[EOF]==1){

	$nop="";
}else{
	//print_r($row);

	echo "<select id=sel_branch_landing disabled=disabled class='form-control'>";
	echo "<option id=0>Head of Office</option>";
foreach ($row as $r1)
{
if($r1[branch_id]==$landing){ $selected="Selected=selected";}else{  $selected="";}

	echo "<option $selected id=$r1[branch_id]>$r1[branch]</option>";

}
echo "</select>";

}
	
	
	?>
</div>



<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<button data-office_id='<?php echo $_SESSION[office_code];?>' id=btn_edit_landing class='btn btn-danger'>Edit</button>
</div>

</div>


<table class='table table-bordered table-stripped'>
	<caption class='bg-primary'>Phone Number</caption>	
	
  
<?php 

$qry="select * from a_personal_contacts where empcode=$_SESSION[user_name]";
$row=$db->SelectData($qry);


if($row[EOF]==1){

	$phone="";
	$disabled="";
}else
{

	$phone=$row[0][phone];
	$disabled="disabled=disabled";
}
	
	echo <<< phone

	
	<tr>
<td class='text-danger'>Personal number</td>
<td><input type='text' class='form-control' value=$phone id='txt_phone' placeholder='Enter Phone'></td>
<td>
<button id=btn_personal_num_edit type='button' class='btn btn-warning'>Go!</button>
<td>
	<tr>
	
	
	</table>
	


	
	
		




";
phone;

?>
  
  
  
  <button class='btn btn-danger'>Edit</button>
 


	</li>
	<li class="list-group-item">
		<span class="badge">15</span>
		Item 3
	</li>
</ul>



<?php


    break;
    

}// if no session
}else
{
	include_once("imprest.class.php");
	$ar=array("Error"=>$err,"html"=>$html);
	
	$msg="Your Session is Expired,Please Log in Again";
	imprestN::show_alert($msg,"alert alert-danger");
	
	
	}