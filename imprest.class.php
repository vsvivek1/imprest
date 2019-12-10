<?php
//session_start();
$loccode = $_SESSION[location_code];

?>

<?php
//include_once("head.php");
include_once("./../class/DBAccess.class.php");


class imprestN
{
	public $tot;
	public static function  firstSetup()
	{

		$power = self::isOfficerWithimprestHoldingPower();
		//$power=1;

		//echo "power";





		if (1) {

			$display_up = 0;
			//print_r($_SESSION);
			?>
			<div id=div_data_collect>






				<div class=up id=up>

					<!-- <h2 class='bg-primary'>&nbsp;IF YOU ARE NOT GETTING OTP YOUR INBOX MAY BE FULL. DELETE SOME SMS FROM YOUR INBOX AND RETRY</h2> -->

					<button type="btn btn-danger" id=btn_close_first><span style="color:red">&times;Close</span></button>
					<div id=div_response></div>
					<?php
					//////////////////////////section to collect cug number if not found /////////////////////////////

					if ($power) {




						$qry = "select * from a_cug where office_id=$_SESSION[office_code]";


						$db = new DBAccess;
						$row = $db->SelectData($qry);
						if ($row[EOF] == 1) {
							$display_up++;
							$load_carosal = $load_carosal++;

							?>


							<div class=row id=div_cug>

								<div class='col-sm-3 col-sm-offset-3' id=cug_otp_req>
									<label class=text-danger>Enter Cug *</label>
									<input type=text class='form-control' id=txt_cug>
									<!-- <button class='btn btn-primary send_otp' id=btn_send_cug_otp >SEND OTP</button> -->
									<!-- <button class='btn btn-primary send_otp' id=btn_send_cug_otp >SEND OTP</button> -->
									<button class='btn btn-primary' id=btn_save_cug>SAVE CUG</button>
								</div>







							</div>






						<?php

						}
					}



					$qry = "select * from a_personal_contacts where empcode='$_SESSION[user_name]'";

					$db = new DBAccess;
					$row = $db->SelectData($qry);
					if ($row[EOF] == 1) {

						$display_up++;
						$load_carosal = $load_carosal++;


						?>

						<div class=row id=div_pers_mob>
							<div class='col-sm-3 col-sm-offset-3' id=per_otp_req>
								<label class=text-warning>Enter Personal Mobile *</label>
								<input type=text class='form-control' id=txt_mobile>
								<!-- <button class='btn btn-primary send_otp' id=btn_send_per_otp >SEND OTP</button> -->
								<button class='btn btn-warning' id=btn_save_personal>SAVE Personal Number</button>
							</div>


						</div>





						<!-- <div class=row id=div_pers_mob>
				<div class='col-sm-3 col-sm-offset-3' id=per_otp_req>
				<label class=text-danger>Enter Personal Mobile *</label>
				<input type=text class='form-control' id=txt_mobile >
				<button class='btn btn-primary send_otp' id=btn_send_per_otp >SEND OTP</button>
				</div>
	
				
			</div>
			 -->


					<?php

					}

					if ($display_up > 0) { ?>
						<style>
							.up {
								display: block;
								position: fixed;
								z-index: 1000;
								top: 25%;
								left: 0%;
								height: 100%;
								width: 100%;
								background: rgba(0, 0, 0, .8) 50% 50% no-repeat;
							}
						</style>

					<?php


					} else { ?>
						<style>
							.up {
								display: none;
								position: fixed;
								z-index: 1000;
								top: 30%;
								left: 0%;
								height: 100%;
								width: 100%;
								background: rgba(0, 0, 0, .8) 50% 50% no-repeat;
							}
						</style>

					<?php


					}




					///////////////////////////////////////////////////////////////////////////////////

					?>
				</div>

			</div>


		<?php




		}  //if power ends



	}











	public static function getAruBalance($empcode = 0, $office_code = 0)
	{

		include_once("./../class/ExpAccSystem.class.php");
		$oExp = new ExpAccSystem;
		$oSubHead = new AccSubHead;

		if ($empcode == 0) {
			$empcode = $_SESSION[user_name];
		}

		$row1 = self::imp_holder_details($empcode, $_SESSION[location_code]);
		$row1 = self::imp_holder_details_with_office($empcode, $_SESSION[location_code], $office_code);
		$row = $row1[0];

		$cmboffice = $row[office_id];
		$txtpayee = $row[id] . "-" . $row[office_id];
		$txtnetAcc = "24210" . "." . $row[id];

		$txtbalance = 0; //??






		$eeid = $payeeid;
		$netAcc = '24210';

		$netCode = $netAcc . '.' . $eeid; //predeep net code

		$txtnetAcc = "24210" . "." . $row[id];  //my net acc code

		//$txtnetAcc="24210.3150";
		//echo $txtnetAcc;
		$netCode = $txtnetAcc;
		$oSubHead->SetAccCode($netCode);
		$dt = $oExp->dtToday();
		$Balance = $oSubHead->Balance($dt);

		//$Balance=500;
		//echo $Balance;
		return $Balance;

		$Balance = $Balance + $net;
	}



	public static function GetCurrDate($n = 0)
	{
		if ($n < 1) {
			$n = 1;
		}
		//	$n=100;
		$date = date("d");

		$month = date("m");
		$year = date("Y");
		$t = time();
		if ($n == 100) {
			// $date =29;
			// $month=03;
			// $year=2019;

			$t = strtotime('2019-03-29');
		}

		$CurrDate = mktime(0, 0, 0, $month, $date, $year);
		return $CurrDate;
	}

	public static function getAdjustmentByOtherbranch($privillage, $post, $copy_this = "")
	{
		$row[imp_voucher_id] = $_POST[imp_voucher_id];

		if ($privillage == 1) {

			$cond = "officer_privillage='$privillage'";
		} else {
			$cond = "(officer_privillage='22' or officer_privillage='23' or officer_privillage='24')";
		}



		$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$row[imp_voucher_id] and $cond
	 ";

		//echo $qry;
		$db = new DBAccess;
		$row = $db->SelectData($qry);
		if ($row[EOF] == 1) {

			$row = array();
			$row[0] = array("item_name" => "", "item_amount" => "", "item_acc_code" => "", "item_desc" => "");
		}



		if ($privillage == 1) $privillage1 = 1;
		else $privillage1 = 21;
		$qry2 = "select name from previlege where id=$privillage1 and is_live ";
		$db2 = new DBAccess;
		$row2 = $db2->SelectData($qry2);

		//print_r($row2);


		?>

		<div class='col-sm-6'>
			<table class="table table-stripped table-bordered">
				<caption class="bg-warning text-center">ADJUSTMENT SHEET FROM <?PHP echo $row2[0][name] ?></caption>

				<tr>

					<th>Item Name</th>
					<th>item Amount</th>
					<!--<th>item Description</th> 
	
	
	<th>Item GST Amount</th>
	<th>Item GST Account Code</th>  -->
					<th>Item Account Code</th>
					<!--<th>Admissible</th> -->
					<th>Remarks</th>
					<th> <?php if ($privillage == 1) echo "Originated By";
							elseif ($privillage == 2)
								echo "Verified By";
							?></th>

				</tr>
				<?php
				foreach ($row as $rw1) {
					?>
					<tr class=<?php echo "'agree_audit $copy_this'" ?>>

						<td><input disabled=disabled type=text value="<?php echo $rw1[item_name]; ?>" class="item_name form-control"></td>
						<td><input disabled=disabled type=text value="<?php echo $rw1[item_amount]; ?>" class="item_amount form-control"></td>

						<!-- <td><input type=text class=form-control id=item_desc></td>  
				
					<td><input type=text class=form-control id=item_amount></td>
				
					<td><input type=text class=form-control id=item_gst></td>
		
					-->
						<td>

							<?php
							include_once("./../class/transHeads.class.php");
							global $ttype;
							global $loccode;
							$qry = "select  acc_head,acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


					trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

							imprestN::select2key($qry, "acc_code", "acc_head", "acc_code", "item_acc_head", "item_acc_head", $rw1[item_acc_code], "disabled=disabled");

							//print_r($result);
							?>

						</td>



						<!--
		<td><label class="switch">
		<input type="checkbox">
		<span class="slider round"></span>
		</label></td>
		-->

						<td><textarea disabled=disabled class="text_area_voucher_remark form-control"><?php echo $rw1[item_desc]; ?></textarea></td>
						<td><?php echo $rw1[modified_by]; ?></td>

					</tr>


				<?php
				}

				?>

				<tr>
					<td></td>
				</tr>


				<tfoot>

					<?php if (($_SESSION[previlege_id] == 3 and ($privillage == 2)) or ($_SESSION[previlege_id] == 21 or $_SESSION[previlege_id] == 22 or $_SESSION[previlege_id] == 23)
					) { ?>
						<tr>

							<td colspan=5 class="text-center"><button id=agree_audit class="btn btn-warning text-center ">

									<span class="fa fa-hand-paper-o fa-lg"></span>
									&nbsp;


									I Agree This Adjustment</button></td>

						</tr>

					<?php

					} ?>
				</tfoot>

			</table>


			<table class="table table-bordered table-stripped">


			</table>
		</div>

	<?php

	}





	//show_in_box_detailsForVouchers




	public static function show_vouchers_submitted($post)
	{

		//print_r($post);

		$empcode1 = split("/", $post[imp_ref_id]);
		$original_office = $empcode1[1];
		$imp_holder = $empcode1[0];

		if ($original_office == $_SESSION[office_code] && $imp_holder == $_SESSION[user_name]) {


			$showEditWindow = 1;
		}





		$qry = "select imp_voucher_id,voucher_num,item_desc,amount,date_of_payment 
		from a_imprest_voucher where imp_voucher_id in  (select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where aio.imprest_op_id=$post[imp_op_id])
		   
		   and imp_voucher_id not in 
		   (
		   select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where from_office::int=$_SESSION[office_code]
		    and imprest_id_ref='$post[imp_ref_id]'
		   
	   )
		   
		   ";


		//echo $qry;

		

		// self::show_imprest_cash_book($post[imp_ref_id]);

		// if(!$_SESSION[aquired]==1)
		if(1)
{
// echo $qry2;  //  16 ms
self::show_imprest_cash_book($post[imp_ref_id]);
}



		//echo $qry;   
		$qry2 = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where imprest_num='$post[imp_ref_id]' and aif.imp_file_category='V' order by date_of_payment,upload_time
";

if($_SESSION[aquired]==1)
{
// echo $qry2;  //  16 ms

$ss=0;

}


		self::getHistory($post[imp_ref_id]);
		?>


		<?php
		self::show_carosal("id1", $qry2);
		//echo $qry2;

		////////////////////////////////////////display hiden used for voucher moovment//////////////////////////////////////
		


		// temporaily disabled  un wanted featuere
		if(!$_SESSION[aquired]==1)
{
	$qry = "select imp_voucher_id,voucher_num,date_of_payment ,item_desc,amount
	from a_imprest_voucher where imprest_num='$post[imp_ref_id]'";

 //echo $qry;
 //self::showHorizontalTableForVouchers($qry, "Vouchers", "voucher", "c");




}
		////////////////////////////////////////display hiden used for voucher moovment//////////////////////////////////////	


		self::show_noting_form_bi_directional($post);
	}
	public static function show_imprest_cash_book1($post)
	{

		//print_r($post);
		/*
	 * select imp_voucher_id,voucher_num,item_desc,amount,date_of_payment 
		from a_imprest_voucher where imp_voucher_id in  (select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where aio.imprest_op_id=479 ) and imp_voucher_id
		   not in 

		   (select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where from_office::int=4211
		    and imprest_id_ref='1047693/4531/V/2017-2018/1047693090220181518166473' )
		  
		
		*/



		$qry = "select imp_voucher_id,voucher_num,item_desc,amount,date_of_payment 
		from a_imprest_voucher where imp_voucher_id in  (select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where aio.imprest_op_id=$post[imp_op_id])
		   
		   and imp_voucher_id not in 
		   (
		   select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where from_office::int=$_SESSION[office_code]
		    and imprest_id_ref='$post[imp_ref_id]'
		   
	   )
		   
		   ";



		//echo $qry;   
		$qry2 = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where imprest_num='$post[imp_ref_id]' and aif.imp_file_category='V'
";



		//self::getHistory($post[imp_ref_id]);
		?>


		<?php
		//self::show_carosal("id1",$qry2);
		$qry = "select imp_voucher_id as \"Voucher Id.\",date_of_payment DATE,voucher_num as \"Sl.No of Voucher \",item_desc as 
	\"Particulars of transaction\",amount as Amount from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 ";

		//echo $qry;

		//self::showHorizontalTableForReport($qry,"imprest CASH ACCOUNT","voucher","class");


		self::showHorizontalTableForVouchers($qry, "imprest CASH ACCOUNT", "voucher", "class");


		//showHorizontalTableForVouchers($qry,$tableHead="",$trclass,$class="")


		self::showHorizontalTableForVouchers($qry, "Vouchers", "voucher", "c");
		self::show_noting_form_bi_directional($post);
	}


	public static function show_abstract_by_account_code($imprest_id_ref, $class = 'col-sm-6 col-sm-offset-2')

	{
		$qry = "select sum(item_amount) as total,item_acc_code,acc_name as acc_head from a_imprest_voucher_details 
	aiv inner join vw_coa co on co.acc_code=aiv.item_acc_code

 where 	aiv.loc_code=$_SESSION[location_code] and aiv.imprest_num='$imprest_id_ref'
					and officer_privillage='$_SESSION[previlege_id]'

					group by item_acc_code, acc_name  

   ";

		//echo $qry;
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);
		?>
		<div class=row>

			<!--
		<script type="text/javascript" src="../bootstrap/g_graph.js"></script>

<script type="text/javascript">
	
$(document).ready(function()
{
	//alert("h");
	// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values


function drawChart() {
	
	//var tr= document.getElementsByClass("chart");
	var goog=[['Account Head', 'Amount']];
	

	$(".chart").each(function(i){
		
		var acc_head=$(this).find(".acc_head").html();
		var acc_sum=$(this).find(".acc_sum").html();
		
		
		
		var inner_goog=[];
		
		
		inner_goog.push(acc_head);
		inner_goog.push(parseFloat(acc_sum));
		
		
		goog.push(inner_goog);
		
	
	
	}
	
	
	
	);
	

  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Friends', 2],
  ['Eat', 2],
  ['TV', 3],
  ['Gym', 2],
  ['Sleep', 7]
]);

 var data = google.visualization.arrayToDataTable(goog);



  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Expenditure By Account Head', 'width':550, 'height':400,pieSliceText: 'value'
	  
	  };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
	
	
	
}

);	
	

</script>
	
	<div class="col-sm-4 col-sm-offset-4"></div>

-->
		</div>


		<script>
			var label = [];
			var data1 = [];
			$(".chart").each(function(i) {

					var acc_head = $(this).find(".acc_head").html();
					var acc_sum = $(this).find(".acc_sum").html();



					var inner_goog = [];



					label.push(acc_head);
					data1.push(parseFloat(acc_sum));


					//goog.push(inner_goog);



				}



			);
			var ctx = document.getElementById('myChart').getContext('2d');
			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'pie',

				// The data for our dataset
				data: {
					labels: label,
					datasets: [{
						label: "My First dataset",
						backgroundColor: [
							"#3366cc",
							"#dc3912",
							"#ff9900",
							"#9b59b6",
							"#f1c40f",
							"#e74c3c",
							"#34495e"
						],
						borderColor: 'rgb(255, 255, 255)',
						data: data1,
					}]
				},

				// Configuration options go here
				options: {}
			});
		</script>







		</div>

		<div class=row>

			<div class='<?php echo $class; ?>'>
				<canvas id="myChart" style="width:250px;height:250px;"></canvas>
			</div>
		</div>


		<table class="table table-borderd table-stripped">
			<tr class='bg-success lead'>
				<th>Account Head</th>
				<th>Account Code</th>
				<th>Account Total</th>
			</tr>
			<?php
			$tot = 0;
			foreach ($row1 as $row) {
				echo "<tr class=chart>";
				echo "<td class=acc_head>$row[acc_head]</td>";

				echo "<input type=hidden name=txtDrAcc[] value='$row[item_acc_code]'>";
				//echo "<input type=hidden name=txtDrAccHead[] value='$row[item_acc_code]'>"; 
				echo "<input type=hidden name=txtDrAccHead[] value='$row[acc_head]'>";



				echo "<input type=hidden name=txtDrAmt[] value='$row[total]'>";

				$tot = $tot + $row[total];
				echo "<td>$row[item_acc_code]</td>";
				echo "<td class=acc_sum>$row[total]</td>";
				echo "</tr>";
			}
			$tot = round($tot);

			echo "<tr class='bg-success lead'>";

			echo "<td colspan=2 >";

			echo "Total amount :";

			echo "</td>";
			echo "<td id=td_total_passed_amount colspan=1>";

			echo "$tot";
			echo "</td>";
			echo "</tr>";
			echo "<input type=hidden name=txtamount value=$tot>";








			?>
		</table>

		<!-- new code for entity id checking at initial stage -->


		<?php
		$empcode1 = split("/", $imprest_id_ref);
		$empcode = $empcode1[0];
		$office_code = $empcode1[1];
		$row1 = self::imp_holder_details_with_office($empcode, $_SESSION[location_code], $office_code);
		if ($row1['EOF'] == 1) {

			$msg = "Entity is not added properly in SARAS. Check the imprest holder and do the neefull
			 before proceeding further.Contact 9446 485 934 for help";
			self::alert_failed($msg);

			self::execute_sms_personal(
				'1064767',
				"",
				"Imprest entity issue for $imprest_id_ref at office $_SESSION[office_name] "
			);
			self::execute_sms_personal(
				'1046855',
				"",
				"Imprest entity issue for $imprest_id_ref at office $_SESSION[office_name] "
			);

			echo "<input type=hidden id=invalid_entity value=1>";
		}

		//$row=$row1[0];

		// // $cmbpayee=$row[id];
		// // $cmboffice=$row[office_id];
		// $txtpayee=$row[id]."-".$row[office_id];
		?>
		<!-- <input type=hidden name=txtpayee value="<?php echo $txtpayee; ?>" > -->
	<?php









	}

	public static function sameOfficeOperation($imp_op_id)
	{
		$qry3 = "select * from a_imprest_operations where imprest_op_id=$imp_op_id";

		$db = new DBAccess;
		$row = $db->SelectData($qry3);
		$row1 = $row[0];

		if ($row1[from_office] == $row1[to_office])
			return $sameOfficeOperation = true;
		else
			return $sameOfficeOperation = false;
	}

	public static function getOriginatingbranchOfImprest($imprest_ref_id, $imp_operation = 18)
	{

		$qry = " select from_branch from a_imprest_operations where 
imprest_id_ref='$imprest_ref_id' and imp_operation='$imp_operation'";

		//echo $qry;
		$db = new DBAccess;
		$row = $db->SelectData($qry);
		$row1 = $row[0];

		//print_r($row);

		return $row1[from_branch];
	}




	public static function show_vouchers_action_at_aru($post, $aru_head = 0)
	{



		//print_r($post); echo "<br>";
		$imp_operation = $post[imp_operation];
		//seting branch
		if ($_SESSION[previlege_id] == 3) {
			$cond = " and (to_branch='$_SESSION[branch_id]' or to_branch='1')";
		} else {
			$cond = "and to_branch='$_SESSION[branch_id]'";
		}



		$qry = "select imp_voucher_id,voucher_num,item_desc,amount,date_of_payment 
		from a_imprest_voucher where imp_voucher_id in  (select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where aio.imprest_op_id=$post[imp_op_id])
		   
		   and imp_voucher_id not in 
		   (
		   select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where from_office::int=$_SESSION[office_code] and to_office::int!=$_SESSION[office_code]
		    and imprest_id_ref='$post[imp_ref_id]'
		   
	   ) ";



		//echo $qry;
		$qry2 = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where imprest_num='$post[imp_ref_id]' and aif.imp_file_category='V'  order by date_of_payment,upload_time
";

		//echo $qry2;

		$qry3 = "select * from a_imprest_operations where imprest_op_id=$post[imp_op_id]";

		//echo $qry3;
		$db = new DBAccess;
		$row = $db->SelectData($qry3);
		$row1 = $row[0];
		$to_office_branch = $row1[to_branch];

		$sameOfficeOperation = false;;

		if ($row1[from_office] == $row1[to_office]) {
			$sameOfficeOperation = true;
		}

		/// seting same operation is true if previosu operation id is 999


		$qry5 = "select *,imp_operation from a_imprest_operations where imprest_op_id<$post[imp_op_id] and imprest_id_ref='$post[imp_ref_id]' order by imprest_op_id desc limit 1";

		//echo $qry5;

		$rowq = $db->SelectData($qry5);
		$rowq1 = $rowq[0];
		if ($rowq1[imp_operation] == 999) {





			if ($to_office_branch != 1) {

				$sameOfficeOperation = true;
			}


			//	print_r($rowq);


		}

		//$sq="select * from a_imprest_landing where to_office='$_SESSION[office_code]'"
		if ($_SESSION[location_code] == 411) {
			if ($imp_operation == 191 or $imp_operation == 192 or $imp_operation == 193) {

				$sameOfficeOperation = true;
			}
		}

		//echo "Imprest operation $imp_operation";






		self::getHistory($post[imp_ref_id]);
		self::show_carosal("id1", $qry2, $sameOfficeOperation, $imp_operation);
		//self::showHorizontalTableForVouchers($qry,"Vouchers","voucher","c");

		//self:show_imprest_cash_book($post[imp_ref_id]);

		// self:show_imprest_cash_book($post[imp_ref_id]);

		imprestN::show_imprest_cash_book($post[imp_ref_id]);



		$imprest_ref_id = $post[imp_ref_id];

		$office_code1 = split("/", $imprest_ref_id);


		$office_code = $office_code1[1];
		//$office_code=$office_code1[1];

		$office_name = imprestN::get_office_name($office_code);
		// $branch_name=imprestN::getBranchNameFromBranchId(0);
		// $desig="AE";
		// $to_branch=1;
		// $msg="Your Imprest Has been forwarded to $to_branch of  $office_name";
		// imprestN::execute_sms ($office_code,$desig,$msg);

		//echo $imprest_ref_id;

		?>



		<div class="row">

			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-sm-offset-4">

				<button type=button data-imp_op_id=<?php echo $post[imp_op_id]; ?> data-imp_operation='999' data-imprest_ref_id='<?php echo $imprest_ref_id; ?>' data-from_office='<?php echo $_SESSION[office_code]; ?>' data-from_branch='<?php echo $_SESSION[branch_id]; ?>' data-to_office='<?php echo $office_code; ?>' data-to_branch='<?php

																																																																																$tobr = self::getOriginatingbranchOfImprest($imprest_ref_id, 18);

																																																																																echo $tobr;
																																																																																?>' id='btn_return_to_feild' type=button class="btn btn-danger btn_fwd_voucher ">
					<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
					<span class="fa fa-exchange fa-lg"></span>&nbsp;

					<?php

					echo " Return to $office_name";
					?>

					<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
				</button>

			</div>

		</div>



		<?php
		if ($sameOfficeOperation and $_SESSION[previlege_id] == 3) {


			//echo $qry;

			//pass to internal officers passing ->verifying -> originating etc dao

			//$sessID =  Date('dmY').time(h,m,s);
			$sessID =  Date('dmY') . time(h, m, s);

			//$cmbBilltype=1001; //for frresh issue
			$cmbBilltype = 1002; //for adjustment


			$sbmt = "SAVE1";


			//$empcode=split("/",$imp_ref_id)[0];
			$empcode1 = split("/", $post[imp_ref_id]);
			$empcode = $empcode1[0];
			$office_code = $empcode1[1];
			$row1 = self::imp_holder_details($empcode, $_SESSION[location_code]);
			$row1 = self::imp_holder_details_with_office($empcode, $_SESSION[location_code], $office_code);
			$row = $row1[0];


			$rec_type = $empcode1[2];

			//echo "rec type $rec_type";


			if ($rec_type == "V") {
				$cmbBilltype = 1002;
			} elseif ($rec_type == "VC") {
				$cmbBilltype = 1003;

				$imprest_num = $post[imp_ref_id];

				//get remit details from voucehr table

				$type = "remitance";

				$qry = "select * from a_imprest_voucher where type='$type' and imprest_num='$imprest_num' ";
				//echo $qry;
				$rowr = $db->SelectData($qry);
				$rowr1 = $rowr[0];
				$txtremit = $rowr1[amount];


				$txtremitrpt = $rowr1[item_acc_code] . "-" . $rowr1[voucher_num] . " of " . $rowr1[date_of_payment];

				//echo "amount $txtremitrpt";





			}








			//print_r($row1);
			if ($row['EOF'] == 1) {
				self::show_alert("Employee Not Added as imprest Holder In this office \n. To add an imprest Holder Click button Add imprest Holder ", "");

				?>
				<button type=button id=add_imprest_holder>Add imprest Holder</button>
			<?

			}
			//$row=self::imp_holder_details($empcode,$_SESSION[location_code]);

			//print_r($row);
			//$cmbpayee=$row[id];
			$cmboffice = $row[office_id];
			$txtpayee = $row[id] . "-" . $row[office_id];
			$txtnetAcc = "24210" . "." . $row[id];
			$cmbpayee = $row[id];
			$cmboffice = $row[office_id];
			$txtbalance = 0; //??

			//echo "textnetacc".$txtnetAcc;

			?>

			<form id=form_submit_to_expac action="expAcc.php" method=post>

				<div data-imp-ref-id=<?php echo $post[imp_ref_id] ?>>

					<!-- <button type=button style="" class="btn btn-info" id=btn_prepare_abstract data-imp-ref-id="<?php echo $post[imp_ref_id] ?>">
			<span class="fa fa fa-american-sign-language-interpreting fa-lg"></span>&nbsp;
						Prepare Abstract sheet</button> -->



					<div id=abstract_sheet_form class=col-sm-6>

					</div>
				</div>

				<?php


				?>

				<input type=hidden name=sid value="<?php echo $sessID; ?>">
				<input type=hidden name=id value=104>
				<input type=hidden name=cmbBilltype value="<?php echo $cmbBilltype; ?>">
				<input type=hidden name=cmbpayee value="<?php echo $cmbpayee; ?>">
				<input type=hidden name=txtpayee value="<?php echo $txtpayee; ?>">
				<input type=hidden name=cmboffice value="<?php echo $cmboffice; ?>">
				<input type=hidden name=locid value="<?php echo $_SESSION[location_code]; ?>">
				<input type=hidden name=sbmt value="<?php echo $sbmt; ?>">


				<input type=hidden name=txtbalance value="<?php echo self::getAruBalance($empcode, $office_code); ?>">

				<input type=hidden name=txtnetAcc value="<?php echo $txtnetAcc; ?>">
				<input type=hidden name=txtDate value="<?php echo self::GetCurrDate(100); ?>">

				<?php

				if ($rec_type == "VC") {

					?>
					<input type=hidden name=txtremit value="<?php echo $txtremit; ?>">
					<input type=hidden name=txtremitrpt value="<?php echo $txtremitrpt; ?>">

					<?php

$pass_text = "Pass the bill For Final  Closing";
				} else {

					
				}$pass_text = "Pass the bill For Payment";
				?>






				<div id=show_submit_to_expac_after_abstract_prep>
					<table class="table table-stripped table-hovered table-bordered">


						<!--
					<tr>
						<td>imprest Amount</td>
					<td>
						<input class=form-control type=text value="<? php // echo self::getPermanantimprestAmountFromRefId($imp_ref_id); 
																	?>" name=txtamount>
					
						</td>
		
			
					</tr>
		
					-->
						<tr>
							<!-- <td>Select Branch</td> -->
							<td colspan=2>
							<h3 class=bg-primary>Write Your remarks</h3>
								<?php

								switch ($_SESSION[previlege_id]) {

									case 1:
										$requiredPrivillage = 2;
										break;
									case 21:
									case 22:
									case 23:

										$requiredPrivillage = 3;
										break;


									case 3:
										$requiredPrivillage = 1;
										break;
								}

								if (0)
									if ($_SESSION[user_name] == 1064767 or $_SESSION[aquired] == 1) {

										self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
									}

							//	self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
								//self::GetSections("cmbsec");
								?>

							<!-- new code for automatic redirection to ab with out selecting ab -->

							<input type=hidden name="cmbsec"  id="sel_branch_sel" value='1101'>
							
							
							</td>


						</tr>

						<tr>
							<td>


							</td>

						<tr>

							<td colspan=2>
								<table>

									<tr>

										<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
									</tr>
									<tr>

										<td>For Payment<input class=auto_text_check_box_v type=checkbox value="&#10&#13For Payment&#10&#13"></td>
										<td>For closure<input class=auto_text_check_box_v type=checkbox value="&#10&#13For Closure&#10&#13"></td>
									</tr>
								</table>

							</td>
						</tr>

						</tr>

						<tr>
							<td colspan=2>
								<textarea style="margin-bottom:50px" class=form-control name='txtdesci' cols=55 rows=10 class=form-control id=txt_area_voucher_note data-imp_ref_id='<?php echo $post[imp_ref_id]; ?>' data-to_office_id='<?php echo $_SESSION[office_code]; ?>' placeholder="Remarks ..."></textarea>

							</td>


						<tr>
							<td colspan=2 class="text-center">

								<!-- <button id=sub_to_expac 
			

						<?php $_SESSION[option] = "save_vouchers_in_saras"; ?>
						data-imp_op_id=<?php echo $post[imp_op_id]; ?>
						data-imp_operation=<?php echo $post[imp_operation]; ?>
			
			 			type=button class="btn btn-primary btn_fwd_voucher ">
		
			 			<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
			 
			 			Submit</button> -->

								<button id=sub_to_expac <?php $_SESSION[option] = "save_vouchers_in_saras"; ?> data-imp_op_id=<?php echo $post[imp_op_id]; ?> data-imp_operation=<?php echo $post[imp_operation]; ?> type=button class="btn btn-primary btn_fwd_voucher ">

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;

									<?php echo $pass_text; ?> </button>





						</tr>


						</tr>


					</table>

				</div>


			</form>


		<?php




		} //if not ab1 section meaning executve engineer getting for the first time from lower office

		else {



			if ($_SESSION[aru_code] == $_SESSION[office_code]) $aru_head = 1;
			else $aru_head = 0;

			//echo "ofc-code=$_SESSION[office_code] and aru code is $_SESSION[aru_code] ";
			?>
			<div class=row>
				<div class="col-sm-10 col-sm-offset-1 well">


					<table>

						<tr>

							<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
						</tr>


						<?php

						//print_r($_SESSION);

						switch ($_SESSION[previlege_id]) {



							case 21:
							case 22:
							case 23:
								?><tr>
								<td>Expenditure incurred may be..<input class=auto_text_check_box_v type=checkbox value="Sir,&#10&#13Expenditure incurred Amounting to Rs <?php echo  $tot; ?>may be admitted and the imprest may be Passed&#10&#13For orders.&#10&#13"></td>
							</tr>
							<?php
							break;

						case 3:
							break;

						case "1";
							?>
							<tr>
								<td>vouchers audited and found Correct.For orders<input class=auto_text_check_box_v type=checkbox value="Sir,&#10&#13Vouchers audited and found Correct.&#10&#13For orders.&#10&#13"></td>
							</tr>
							<tr>
								<td>vouchers audited and found Correct.For Final Closing<input class=auto_text_check_box_v type=checkbox value="Sir,&#10&#13Vouchers audited and found Correct.&#10&#13For Final Closing.&#10&#13"></td>
							</tr>
							<?php
							break;
					}


					?>


						</tr>
					</table>





					<div align="center" style="margin:auto;text-align:center">
						<h5> Remarks ... </h5>
						<textarea style="margin-bottom:50px" name='<?php echo $post[imp_ref_id]; ?>' data-imp_ref_id='<?php echo $post[imp_ref_id]; ?>' cols=55 rows=10 class=form-control id=txt_area_voucher_note placeholder="Remarks ..."></textarea>

					</div>
				</div>




				<table class="table table-bordered table-stripped">

					<?php

					//if($sameOfficeOperation and $_SESSION[privillage]==3)// why this 
					if (!$sameOfficeOperation and $_SESSION[previlege_id] == 3) {
						/// case if not by passing officer no submit to saras --> new work flow -->> meaning internal transfers of vouchers

						$first = 'first';
						?>
						<tr class=bg-danger>
							<td>
								<button class="btn btn-danger btn_fwd_voucher" name='<?php echo $x[from_branch]; ?>' id='<?php echo $post[from_ofc_code]; ?>'>

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
									Return to
									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									<?php echo self::get_office_name($post[from_ofc_code]); ?>


								</button>
							<td>
						</tr>
					<?php
					}
					?>



					<tr class=bg-success>
						<td>
							<?php

							//echo "aru head is $aru_head";

							if (!$aru_head) {


								?>

								<button name='<?php echo $x[from_branch]; ?>' class="btn btn-success btn_fwd_voucher" id='<?php echo $_SESSION[higher_office_code]; ?>'>

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									Approve and Submit to
									<?php echo self::get_office_name($_SESSION[higher_office_code]); ?> </button>

								</button>



							<?php

							} else { ?>




								<button name='<?php echo $x[from_branch]; ?>' <?php $_SESSION['option'] = 'btn_fwd_voucher' ?> class="btn btn-success btn_fwd_voucher intern <?php echo $first ?>" name=intern data-ineten=intern data-imp_operation=<?php echo $post[imp_operation]; ?> data-imp_op_id=<?php echo $post[imp_op_id]; ?> id='<?php echo $_SESSION[office_code]; ?>'>

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									Approve and Transfer To
								</button>

							</td>
							<td>



								<?php

								switch ($_SESSION[previlege_id]) {

									case 1:
										$requiredPrivillage = 2;
										break;
									case 21:
									case 22:
									case 23:

										$requiredPrivillage = 3;
										break;


									case 3:
										$requiredPrivillage = 1;
										break;
								}

								if (0)
									if ($_SESSION[user_name] == 1064767 or $_SESSION[aquired] == 1) {

										self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
									}

								self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
								//self::GetSections("cmbsec");
								?>




							<?php
							}


							?>


						</td>
					</tr>
				</table>

			</div>

			</div>
			</div>
			</div>

		<?php

		}
	}

	public static function show_vouchers_action_at_aru_returned($post, $aru_head = 0)
	{








		//print_r($post);
		$imp_operation = $post[imp_operation];
		//seting branch
		if ($_SESSION[previlege_id] == 3) {
			$cond = " and (to_branch='$_SESSION[branch_id]' or to_branch='1')";
		} else {
			$cond = "and to_branch='$_SESSION[branch_id]'";
		}



		$qry = "select imp_voucher_id,voucher_num,item_desc,amount,date_of_payment 
		from a_imprest_voucher where imp_voucher_id in  (select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where aio.imprest_op_id=$post[imp_op_id])
		   
		   and imp_voucher_id not in 
		   (
		   select unnest(vouchers) from
		  a_imprest_operations aio inner join a_imprest_voucher_mvmt
		   aivm on aivm.imprest_op_id=aio.imprest_op_id where from_office::int=$_SESSION[office_code] and to_office::int!=$_SESSION[office_code]
		    and imprest_id_ref='$post[imp_ref_id]'
		   
	   ) ";



		//echo $qry;
		$qry2 = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where imprest_num='$post[imp_ref_id]' and aif.imp_file_category='V'  order by date_of_payment,upload_time
";

		//echo $qry;

		$qry3 = "select * from a_imprest_operations where imprest_op_id=$post[imp_op_id]";

		//echo $qry3;
		$db = new DBAccess;
		$row = $db->SelectData($qry3);
		$row1 = $row[0];

		$sameOfficeOperation = false;;

		if ($row1[from_office] == $row1[to_office]) {
			$sameOfficeOperation = true;
		}

		/// seting same operation is true if previosu operation id is 999


		$qry5 = "select imp_operation from a_imprest_operations where imprest_op_id<$post[imp_op_id] and imprest_id_ref='$post[imp_ref_id]' order by imp_operation desc limit 1";
		$rowq = $db->SelectData($qry5);
		$rowq1 = $rowq[0];
		if ($rowq1[imp_operation] == 999) {
			$sameOfficeOperation = true;
			// print_r($rowq);
		}



/// seting same operation is true if previosu operation id is 777  return from ratifying officer directly to aru
if($imp_operation ==777){
	$sameOfficeOperation = true;

}



		self::getHistory($post[imp_ref_id]);
		self::show_carosal("id1", $qry2, $sameOfficeOperation, $imp_operation);
		//self::showHorizontalTableForVouchers($qry,"Vouchers","voucher","c");

		//self:show_imprest_cash_book($post[imp_ref_id]);

		//self:show_imprest_cash_book($post[imp_ref_id]);

		imprestN::show_imprest_cash_book($post[imp_ref_id]);



		$imprest_ref_id = $post[imp_ref_id];

		$office_code1 = split("/", $imprest_ref_id);


		$office_code = $office_code1[1];
		//$office_code=$office_code1[1];

		$office_name = imprestN::get_office_name($office_code);
		// $branch_name=imprestN::getBranchNameFromBranchId(0);
		// $desig="AE";
		// $to_branch=1;
		// $msg="Your Imprest Has been forwarded to $to_branch of  $office_name";
		// imprestN::execute_sms ($office_code,$desig,$msg);

		//echo $imprest_ref_id;

		?>



		<div class="row">

			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-sm-offset-4">

				<button type=button data-imp_op_id=<?php echo $post[imp_op_id]; ?> data-imp_operation='999' data-imprest_ref_id='<?php echo $imprest_ref_id; ?>' data-from_office='<?php echo $_SESSION[office_code]; ?>' data-from_branch='<?php echo $_SESSION[branch_id]; ?>' data-to_office='<?php echo $office_code; ?>' data-to_branch='<?php

																																																																																$tobr = self::getOriginatingbranchOfImprest($imprest_ref_id, 18);

																																																																																echo $tobr; ?>' id='btn_return_to_feild' type=button class="btn btn-danger btn_fwd_voucher ">

					<span class="fa fa-exchange fa-lg"></span>&nbsp;

					<?php

					echo " Return to $office_name";
					?>

					<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
				</button>

			</div>

		</div>



		<?php
		if ($_SESSION[previlege_id] == 3) {


			//echo $qry;

			//pass to internal officers passing ->verifying -> originating etc dao

			//$sessID =  Date('dmY').time(h,m,s);
			$sessID =  Date('dmY') . time(h, m, s);

			//$cmbBilltype=1001; //for frresh issue
			$cmbBilltype = 1002; //for adjustment


			$sbmt = "SAVE1";


			//$empcode=split("/",$imp_ref_id)[0];
			$empcode1 = split("/", $post[imp_ref_id]);
			$empcode = $empcode1[0];
			$office_code = $empcode1[1];
			$row1 = self::imp_holder_details($empcode, $_SESSION[location_code]);
			$row1 = self::imp_holder_details_with_office($empcode, $_SESSION[location_code], $office_code);
			$row = $row1[0];


			$rec_type = $empcode1[2];

			//echo "rec type $rec_type";


			if ($rec_type == "V") {
				$cmbBilltype = 1002;
			} elseif ($rec_type == "VC") {
				$cmbBilltype = 1003;

				$imprest_num = $post[imp_ref_id];

				//get remit details from voucehr table

				$type = "remitance";

				$qry = "select * from a_imprest_voucher where type='$type' and imprest_num='$imprest_num' ";
				//echo $qry;
				$rowr = $db->SelectData($qry);
				$rowr1 = $rowr[0];
				$txtremit = $rowr1[amount];


				$txtremitrpt = $rowr1[item_acc_code] . "-" . $rowr1[voucher_num] . " of " . $rowr1[date_of_payment];

				//echo "amount $txtremitrpt";





			}








			//print_r($row1);
			if ($row['EOF'] == 1) {
				self::show_alert("Employee Not Added as imprest Holder In this office \n. To add an imprest Holder Click button Add imprest Holder ", "");

				?>
				<button type=button id=add_imprest_holder>Add imprest Holder</button>
			<?

			}
			//$row=self::imp_holder_details($empcode,$_SESSION[location_code]);

			//print_r($row);
			//$cmbpayee=$row[id];
			$cmboffice = $row[office_id];
			$txtpayee = $row[id] . "-" . $row[office_id];
			$txtnetAcc = "24210" . "." . $row[id];
			$cmbpayee = $row[id];
			$txtbalance = 0; //??

			echo "textnetacc" . $txtnetAcc;

			?>

			<form id=form_submit_to_expac action="expAcc.php" method=post>

				<div data-imp-ref-id=<?php echo $post[imp_ref_id] ?>>

					<!-- <button type=button style="" class="btn btn-info" id=btn_prepare_abstract data-imp-ref-id="<?php echo $post[imp_ref_id] ?>">
			<span class="fa fa fa-american-sign-language-interpreting fa-lg"></span>&nbsp;
						Prepare Abstract sheet</button> -->



					<div id=abstract_sheet_form class=col-sm-6>

					</div>
				</div>

				<?php


				?>

				<input type=hidden name=sid value="<?php echo $sessID; ?>">
				<input type=hidden name=id value=104>
				<input type=hidden name=cmbBilltype value="<?php echo $cmbBilltype; ?>">
				<input type=hidden name=cmbpayee value="<?php echo $cmbpayee; ?>">
				<input type=hidden name=txtpayee value="<?php echo $txtpayee; ?>">
				<input type=hidden name=cmboffice value="<?php echo $cmboffice; ?>">
				<input type=hidden name=locid value="<?php echo $_SESSION[location_code]; ?>">
				<input type=hidden name=sbmt value="<?php echo $sbmt; ?>">


				<input type=hidden name=txtbalance value="<?php echo self::getAruBalance($empcode, $office_code); ?>">

				<input type=hidden name=txtnetAcc value="<?php echo $txtnetAcc; ?>">
				<input type=hidden name=txtDate value="<?php echo self::GetCurrDate(100); ?>">

				<?php

				if ($rec_type == "VC") {

					?>
					<input type=hidden name=txtremit value="<?php echo $txtremit; ?>">
					<input type=hidden name=txtremitrpt value="<?php echo $txtremitrpt; ?>">

				<?php
				}
				?>






				<div id=show_submit_to_expac_after_abstract_prep>
					<table class="table table-stripped table-hovered table-bordered">


						<!--
					<tr>
						<td>imprest Amount</td>
					<td>
						<input class=form-control type=text value="<?php echo self::getPermanantimprestAmountFromRefId($imp_ref_id); ?>" name=txtamount>
					
						</td>
		
			
					</tr>
		
					-->
						<tr>
							<td>Select Branch</td>
							<td>
								<?php

								switch ($_SESSION[previlege_id]) {

									case 1:
										$requiredPrivillage = 2;
										break;
									case 21:
									case 22:
									case 23:

										$requiredPrivillage = 3;
										break;


									case 3:
										$requiredPrivillage = 1;
										break;
								}
								if (0)
									if ($_SESSION[user_name] == 1064767 or $_SESSION[aquired] == 1) {

										self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
									}

								self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
								//self::GetSections("cmbsec");
								?>
							</td>


						</tr>

						<tr>

							<td colspan=2>
								<table>

									<tr>

										<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
									</tr>
									<tr>

										<td>For Payment<input class=auto_text_check_box_v type=checkbox value="&#10&#133t&#10&#13"></td>
									</tr>
								</table>

							</td>
						</tr>

						<tr>
							<td colspan=2>
								<textarea style="margin-bottom:50px" class=form-control name='txtdesci' cols=55 rows=10 class=form-control id=txt_area_voucher_note data-imp_ref_id='<?php echo $post[imp_ref_id]; ?>' data-to_office_id='<?php echo $_SESSION[office_code]; ?>' placeholder="Remarks ..."></textarea>

							</td>


						<tr>
							<td colspan=2 class="text-center">
								<button id=sub_to_expac data-imp_op_id=<?php echo $post[imp_op_id]; ?> data-imp_operation=<?php echo $post[imp_operation]; ?> type=button class="btn btn-primary btn_fwd_voucher ">

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									Submit</button>





						</tr>


						</tr>


					</table>

				</div>


			</form>


		<?php




		} //if not ab1 section meaning executve engineer getting for the first time from lower office

		else {



			if ($_SESSION[aru_code] == $_SESSION[office_code]) $aru_head = 1;
			else $aru_head = 0;

			//echo "ofc-code=$_SESSION[office_code] and aru code is $_SESSION[aru_code] ";
			?>
			<div class=row>
				<div class="col-sm-10 col-sm-offset-1 well">

					<table>

						<tr>

							<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
						</tr>
						<tr>

							<td>For Payment<input class=auto_text_check_box_v type=checkbox value="&#10&#134&#10&#13"></td>
						</tr>
					</table>

					<div align="center" style="margin:auto;text-align:center">
						<h5> Remarks ... </h5>
						<textarea style="margin-bottom:50px" name='<?php echo $post[imp_ref_id]; ?>' data-imp_ref_id='<?php echo $post[imp_ref_id]; ?>' cols=55 rows=10 class=form-control id=txt_area_voucher_note placeholder="Remarks ..."></textarea>

					</div>
				</div>




				<table class="table table-bordered table-stripped">

					<?php

					//if($sameOfficeOperation and $_SESSION[privillage]==3)// why this 
					if (!$sameOfficeOperation and $_SESSION[previlege_id] == 3) {
						/// case if not by passing officer no submit to saras --> new work flow -->> meaning internal transfers of vouchers

						$first = 'first';
						?>
						<tr class=bg-danger>
							<td>
								<button class="btn btn-danger btn_fwd_voucher" name='<?php echo $x[from_branch]; ?>' id='<?php echo $post[from_ofc_code]; ?>'>

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
									Return to

									<?php echo self::get_office_name($post[from_ofc_code]); ?>

									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
								</button>
							<td>
						</tr>
					<?php
					}
					?>



					<tr class=bg-success>
						<td>
							<?php

							//echo "aru head is $aru_head";

							if (!$aru_head) {


								?>

								<button name='<?php echo $x[from_branch]; ?>' class="btn btn-success btn_fwd_voucher" id='<?php echo $_SESSION[higher_office_code]; ?>'>

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;

									Approve and Submit to
									<?php echo self::get_office_name($_SESSION[higher_office_code]); ?> </button>
								<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
								</button>



							<?php

							} else { ?>




								<button name='<?php echo $x[from_branch]; ?>' class="btn btn-success btn_fwd_voucher intern <?php echo $first ?>" name=intern data-ineten=intern data-imp_operation=<?php echo $post[imp_operation]; ?> data-imp_op_id=<?php echo $post[imp_op_id]; ?> id='<?php echo $_SESSION[office_code]; ?>'>

									<span class="fa  fa-briefcase fa-lg"></span>&nbsp;
									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									Approve and Transfer To
								</button>

							</td>
							<td>



								<?php

								switch ($_SESSION[previlege_id]) {

									case 1:
										$requiredPrivillage = 2;
										break;
									case 21:
									case 22:
									case 23:

										$requiredPrivillage = 3;
										break;


									case 3:
										$requiredPrivillage = 1;
										break;
								}

								if (0)
									if ($_SESSION[user_name] == 1064767 or $_SESSION[aquired] == 1) {

										self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
									}

								self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
								//self::GetSections("cmbsec");
								?>




							<?php
							}


							?>


						</td>
					</tr>
				</table>

			</div>

			</div>
			</div>
			</div>

		<?php

		}
	}







	public static	function getImpNumber()
	{

		//$db=new DBAccess;
		/*
		$qry="SELECT  COALESCE ((select count(imprest_id)+1 from a_imprest where imp_holder='$_SESSION[user_name]'
		 and imp_holder_office='$_SESSION[office_code]'),1) as count";
		
		$row=$db->SelectData($qry);
		
		return $row[0][count];
		*/

		$sessID =  Date('dmY') . time(h, m, s);
		$sessID =  Date('dmY') . microtime(true);

		//$sessID="$sessID";

		//echo "this is that ";

		return "$_SESSION[user_name]$sessID";
	}



	public static function submit_imprest_request($post = "", $file = "")

	{


		//print_r($post);
		//print_r($file);

		//echo "here";



		/*
	function isDataInserted($qry)
	
	{
		$db=new DBAccess;
		
		
		
		$row=$db->SelectData($qry);
		
		if($row[EOF]==1)
		return false;
		else return true;;
		
	}
	
	*/


		$Closed = false;
		$Submited = false;

		//if($Closed and !($Submited) )


		$date = date("Y-m-d");

		//	$date=date("2019-03-25");

		$imp = self::getImpNumber();
		$fy = imprestN::findFinancialYear($date);
		$impReqNum = $_SESSION[user_name] . "/" . $_SESSION[office_code] . "/P" . "/" . $fy . "/" . $imp;
		$impAmount = $post[amt];

		/*
		$qry="select * from a_imprest where
		 imp_holder='$_SESSION[user_name]' and  imp_holder_office='$_SESSION[office_code]' and imp_type='P' and open and imp_fy='$fy'" ;
		*/
		//if(!self::isDataInserted($qry)) //code changed checking at initial stages only 
		if (1) {



			$qry = "insert into a_imprest (imp_req_num,imp_holder,imp_holder_office,imp_type,amount,imp_fy,open)
	
	values('$impReqNum','$_SESSION[user_name]','$_SESSION[office_code]','P',$impAmount,'$fy',true
	
	
	
	)
	
	";


			//echo $qry;

			//echo $imp;
			$result['err'] = 0;
			$db = new DBAccess;

			$db->DBbeginTrans();

			//$row=$db->SelectData($qry);

			$result = $db->UpdateData($qry);

			$post[msg] = str_replace("'", "''", $post[msg]);


			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}

			$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,imp_oprn_msg,imprest_id_ref) values
	
	('1','$_SESSION[office_code]','$_SESSION[higher_office_code]','$_SESSION[branch_id]','1','$_SESSION[user_name]','$post[msg]','$impReqNum'
	
	) ";


			//echo $qry;


			$db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg2'] = "Insert into a_imprest_operations failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}

			$db->DBcommitTrans();

			if ($result['err'] > 0) {

				$i = "<i class=\"fa fa-exclamation-triangle fa-3x\" style=\"color:red\" aria-hidden=\"true\">Error</i>";
				$msg = $i . "<br>" . $result['adl_msg1'] . "\n" . $result['adl_msg2'];
				self::show_error($msg);
			} else {

				$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
				self::show_alert("$i <br> Request  submited for Permanant Imprest Successfully", "alert alert-success");
			}
			//echo $qry;
		} else {

			$i = "<i class=\"fa fa-exclamation-triangle fa-3x\" style=\"color:red\" aria-hidden=\"true\"> Error !!</i>";
			self::show_alert("$i <br>  Already requested in this Financial year", "alert alert-danger");
		}
	}


	public static function alert_failed($msg)
	{

		$i = "<i class=\"fa fa-exclamation-triangle fa-3x\" style=\"color:red\" aria-hidden=\"true\"> Error !!</i>";
		self::show_alert("$i <br>$msg", "alert alert-danger");
	}



	public static function alert_success($msg)
	{

		$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
		self::show_alert("$i <br>$msg", "alert alert-success");
	}

	public static function submit_imprest_request_old($post = "", $file = "")

	{


		//print_r($post);
		//print_r($file);

		//echo "here";



		/*
	function isDataInserted($qry)
	
	{
		$db=new DBAccess;
		
		
		
		$row=$db->SelectData($qry);
		
		if($row[EOF]==1)
		return false;
		else return true;;
		
	}
	
	*/


		$Closed = false;
		$Submited = false;

		//if($Closed and !($Submited) )


		$date = date("Y-m-d");
		//$date=date("2019-03-25");

		$imp = self::getImpNumber();
		$fy = imprestN::findFinancialYear($date);
		$impReqNum = $_SESSION[user_name] . "/" . $_SESSION[office_code] . "/P" . "/" . $fy . "/" . $imp;
		$impAmount = $post[amt];

		$qry = "select * from a_imprest where
		 imp_holder='$_SESSION[user_name]' and  imp_holder_office='$_SESSION[office_code]' and imp_type='P' and open and imp_fy='$fy'";

		if (!self::isDataInserted($qry)) {



			$qry = "insert into a_imprest (imp_req_num,imp_holder,imp_holder_office,imp_type,amount,imp_fy,open)
	
	values('$impReqNum','$_SESSION[user_name]','$_SESSION[office_code]','P',$impAmount,'$fy',true
	
	
	
	)
	
	";


			//echo $qry;


			$date = date("Y-m-d");
			//$date=date("2019-03-25");
			$fy = imprestN::findFinancialYear($date);
			$post[msg] = str_replace("'", "''", $post[msg]);
			//echo $imp;
			$result['err'] = 0;
			$db = new DBAccess;

			$db->DBbeginTrans();

			//$row=$db->SelectData($qry);

			$result = $db->UpdateData($qry);

			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}

			$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,imp_oprn_msg,imprest_id_ref,imp_fy) values
	
	('1','$_SESSION[office_code]','$_SESSION[higher_office_code]','$_SESSION[branch_id]','1','$_SESSION[user_name]','$post[msg]','$impReqNum','$fy'
	
	) ";


			//echo $qry;


			$db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg2'] = "Insert into a_imprest_operations failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}

			$db->DBcommitTrans();

			if ($result['err'] > 0) {

				$i = "<i class=\"fa fa-exclamation-triangle fa-3x\" style=\"color:red\" aria-hidden=\"true\">Error</i>";
				$msg = $i . "<br>" . $result['adl_msg1'] . "\n" . $result['adl_msg2'];
				self::show_error($msg);
			} else {

				$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
				self::show_alert("$i <br> Request  submited for Permanant imprest Successfully", "alert alert-success");
			}
			//echo $qry;
		} else {

			$i = "<i class=\"fa fa-exclamation-triangle fa-3x\" style=\"color:red\" aria-hidden=\"true\"> Error !!</i>";
			self::show_alert("$i <br>  Already requested in this Financial year", "alert alert-danger");
		}
	}














	public static function li()
	{ ?><li><label for=\"fileToUpload\"> <i class=\"fa fa-briefcase\"></i>Upload Work Order :<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\"></label> </li>
	<?php
	}


	public function  round_btn($id = "id", $class = "myBut", $toolTip = "click", $fontAwesome = "fa fa-inr fa-5x", $iStyle = "color:white", $style = "", $content)
	{
		echo  "<button id=$id
	  class=\"$class\" data-toggle=\"tooltip\" style=\"$style \" title=\"$toolTip\" data-placement=\"left\"><i class=\"$fontAwesome\" style=\"$iStyle\"></i>
	$content </button>";
	}


	public static function modal_btn(
		$modalId,
		$id = "id",
		$class = "myButt1",
		$toolTip = "click",
		$fontAwesome = "fa fa-inr fa-5x",
		$iStyle = "color:white",
		$style = "",
		$btnClass = "btn btn-info btn-lg"
	) {

		//echo "<button type=\"button\"  data-toggle=\"modal\" data-target=\"#$modalId\">Open Modal</button>";

		echo  "
 <span data-toggle=\"tooltip\" title=\"$toolTip\"  data-placement=\"right\" >
 <button id=$id
	  class=\"$class\" data-target=\"#$modalId\" data-toggle=\"modal\" style=\"$style \" ><i class=\"$fontAwesome\" style=\"$iStyle\"></i>
	  </button>
	  
	  </span>";



		?>
	<?php
	}

	public static	function isDataInserted($qry)

	{
		$db = new DBAccess;



		$row = $db->SelectData($qry);
		//print_r($row);
		if ($row[EOF] == 1)
			return false;
		else return true;
	}


	public static	function getData($qry, $alias)

	{
		$db = new DBAccess;



		$row = $db->SelectData($qry);

		return $row[0][$alias];
	}




	public static function getimprestBalanceAmount($newVoucher, $imp_holder = '1047693', $imp_holder_office = '4531', $fystart = '2016-04-01', $orig_imp = 15000)
	{
		$orig_imp = self::getPermanantimprestAmount();

		$qry = "select sum(amount) from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and
	 imp_holder_office='$_SESSION[office_code]' and date_of_payment>'$fystart'";


		$used = self::getData($qry, 'sum');

		return $used;
	}

	public static function execute_sms($office_code, $desig, $message)
	{




		$qry = "select * from a_tele_contacts where office_code::int=$office_code and upper(contact_person) like('%$desig%')";

		$qry = "select * from a_cug where office_id=$office_code";
		//echo $qry;
		$db = new DBAccess;


		$row = $db->SelectData($qry);
		$rw = $row[0];
		//print_r($rw);

		// foreach ($row as $rw)

		// {


		// }


		$phone1 = $rw[cug];
		$phone = "+91" . $phone1;


		self::send_sms($phone, $message);
		//self::send_sms(+919847599946,$message.$phone);

	}


	public static function send_sms_to_receiver($to_offfice, $to_branch, $message)
	{

		$qry = "select user_name from vw_office_setup where office_code='$to_office' and branch_id=$to_branch";
		$db = new DBAccess;


		$row = $db->SelectData($qry);
		$rw = $row[0];
		$empcode = $rw[user_name];

		$desig = "";


		self::execute_sms_personal($empcode, $desig, $message);
	}

	public static function execute_sms_personal($empcode, $desig, $message)
	{




		$qry = "select * from a_tele_contacts where office_code::int=$office_code and upper(contact_person) like('%$desig%')";

		$qry = "select * from a_personal_contacts where empcode=$empcode";
		//echo $qry;
		$db = new DBAccess;


		$row = $db->SelectData($qry);
		$rw = $row[0];
		//print_r($rw);

		// foreach ($row as $rw)

		// {


		// }


		$phone1 = $rw[phone];
		$phone = "+91" . $phone1;
		if ($empcode = '1064767') {
			self::send_sms($phone, $message . "\n.$phone1");
		} else {

			self::send_sms($phone, $message);
		}


		//self::send_sms(+919847599946,$message.$phone);



	}





	public static function send_sms($phone, $message)
	{

		//
		$aryWsfxParams = array();
		$aryWsfxParams['sms_mobile'] = $phone;
		$aryWsfxParams['sms_body'] = $message;
		$aryWsfxParams['sms_flag'] = 1;    # test/  1: send sms
		//echo '<br> ksebsms webservice test: inputs aryWsfxParams: ';print_r($aryWsfxParams);
		$strWsfxName = 'sendSms';

		try {
			$wsSecuritytoken = '1005659BF455C12F1500B7AB250374230693';    # Token for  SARAS
			$ObjSoapClient = new SoapClient('http://10.0.1.44/ws/sms/ksebsms.wsdl', array('trace' => 1));    # Local


			//$v=new soapClient()
			$wsRequest = json_encode($aryWsfxParams);
			$wsResponse = $ObjSoapClient->callKsebSmsWs($strWsfxName, $wsRequest, $wsSecuritytoken);
			$wsResponseValue = json_decode($wsResponse, true);
		} catch (SoapFault $exception) {
			// echo "<pre>".$ObjSoapClient->__getLastRequest()."</pre><br>";
			// echo "<pre>".$ObjSoapClient->__getLastResponse()."</pre><br>";
			// echo '<br>'.$exception->getMessage();
			$wsResponseValue['ws_err_flag']  = 9011;    # WSERROR_EXCEPTION_ERROR
			$wsResponseValue['ws_disp_msg']  = 'Fault Exception: ' . $exception->getMessage();
		}
		unset($ObjSoapClient);
		//echo "<br>Jason encoded Parameters (fxParams): $wsRequest<br>Function Name (wsfxName) : $strWsfxName<br>";
		//echo'<br> Output: ';print_r($wsResponseValue); echo '<br><br> Ouput Values';
		//foreach($wsResponseValue as $key => $value)
		//echo "<br>$key = $value";




	}



	public static function getimprestBalance($newVoucher, $aru_balance, $imp_holder = '1047693', $imp_holder_office = '4531', $fystart = '2016-04-01', $orig_imp = 15000)
	{

		//echo $aru_balance;

		$today = date("Y-m-d");

		// if($_SESSION[user_name]==1063735 ){
		// 	$today=date("2019-03-25");


		// }
		$fystart = self::getFirstDayOfFy($today);
		$orig_imp = self::getPermanantimprestAmount();

		$fy = date("Y-m-d");
		//$fy=date("2019-03-31");


		// if(in_array($_SESSION['user_name'],array(1047393,1063733,1063735)))
		// ///if($_SESSION[user_name] )


		// {
		// 	$today=date("2019-03-25");
		// 	$fy=date("2019-03-25");

		// }

		$imp_fy = self::findFinancialYear($fy);


		$qry = "select sum(amount) from a_imprest_voucher 
	where imp_holder='$_SESSION[user_name]' and	 imp_holder_office='$_SESSION[office_code]' 
	and date_of_payment>'$fystart'";


		$qry = "
	 select sum(yyy.amount) from (select coalesce(v.passed_amount,x.amount) as amount from a_imprest_voucher x
	 left join v_passed_amount v on v.imp_voucher_id=x.imp_voucher_id
	  where x.imp_holder='$_SESSION[user_name]' and
		  x.imp_holder_office='$_SESSION[office_code]'  and  imp_fy='$imp_fy') yyy
	 ";

		//echo $qry;

		$used = self::getData($qry, 'sum');


		//echo $qry;


		//self::show_panel($head,$orig_imp-$used-$newVoucher );
		?>

		<?php //echo $aru_balance-$used-$newVoucher 
		?>

		<?php //echo $aru_balance-$used-$newVoucher 
		?>
		<?php

		if ($_SESSION[user_name] == 1064767) {

			echo "15000";
		} elseif ($_SESSION[user_name] == 1104418) {

			$out = 15000 - $newVoucher;

			//echo $out;

			echo ($used) * -1 - $newVoucher;
		} else {

			echo ($used) * -1 - $newVoucher;
		}



		?>


	<?

		//return $orig_imp-self::getData($qry,'sum');


	}

	public static function getSumOfImprestSubmitted($imp_ref_id = 0)
	{

		$date = date("Y-m-d");
		//$date=date("2019-03-31");
		$fy = imprestN::findFinancialYear($date);
		if ($imp_ref_id != 0) {
			$empcode1 = split("/", $imp_ref_id);
			$emp_code = $empcode1[0];
			$office_code = $empcode1[1];

			// echo "this is ".$imp_ref_id;

			//

			$uniq = $empcode1[4];
			$time = substr($uniq, 15, 23);

			$qry = "select sum(y.amount) from ( select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0') as 
   type from a_imprest_voucher x 
	inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num where 
	 x.imp_holder='$emp_code'and
	 x.imp_holder_office='$office_code' 
	 
	 and x.imprest_num='$imp_ref_id'
   and time::numeric < time::numeric and coalesce(type,'0')='0' and (x.voucher_status=2 or x.voucher_status=2)   
   order by time,date_of_payment)y ";
			// echo $qry;


			$qry = "select coalesce(sum(y.amount)::text,'0')::numeric as sum from (

	select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0')
	as type from a_imprest_voucher x 
	inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num 
	
	
	where 
	
	x.imp_holder='$emp_code' and
	 x.imp_holder_office='$office_code' 
	 
	 
	 and not (date_of_payment>to_timestamp(coalesce(time::text,'0')::numeric))
	
	and (x.voucher_status=2 ) and coalesce(type,'0')<>'r'
	and
	
	coalesce(time::text)::numeric <
	
	(select coalesce(time::text,'0')::numeric from v_date_of_imprest_origin  where imprest_id_ref=
	'$imp_ref_id' ) 
	






	order by time,date_of_payment
	
	
	)y";



			$qry = " select coalesce(sum(amount)::text,'0')::numeric as sum from
	( 
	
	(
	select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0')
	as type from a_imprest_voucher x inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num
	where x.imp_holder='$emp_code' and x.imp_holder_office='$office_code'
	and
	(x.voucher_status=2) and coalesce(type,'0')<>'r' and
	coalesce(time::text)::numeric
	< (select coalesce(time::text,'0')::numeric
	from v_date_of_imprest_origin where imprest_id_ref= '$imp_ref_id' )
	order by time,date_of_payment
	
	)
	union all
	
	(
	
	select date_of_payment,amount*-1,time::numeric as time2 , coalesce(type,'0')
	as type from a_imprest_voucher x left join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num
	where x.imp_holder='$emp_code' and x.imp_holder_office='$office_code'
	and
	 coalesce(type,'0')='r' and
	x.date_of_payment
	>	 ( select  to_timestamp(coalesce(time::text,'0')::numeric)
	from v_date_of_imprest_origin where imprest_id_ref= '$imp_ref_id' )



	and x.date_of_payment <

	coalesce(
	
	(select  imp_opn_time from a_imprest_operations where 
	imprest_id_ref= '$imp_ref_id' and imp_operation='200'),now())
	



	order by time,date_of_payment
	
	
	)
	
	
	
	
	
	
	
	
	
	)y";


			$qry = " select coalesce(sum(amount)::text,'0')::numeric as sum from
	( 
	
	(
	select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0')
	as type from a_imprest_voucher x inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num
	where x.imp_holder='$emp_code' and x.imp_holder_office='$office_code'
	and
	(x.voucher_status=2) and coalesce(type,'0')<>'r' and amount>0 and time<>'' and
	coalesce(time::text)::numeric
	< (select coalesce(time::text,'0')::numeric
	from v_date_of_imprest_origin where imprest_id_ref= '$imp_ref_id' )
	order by time,date_of_payment
	
	)
	union all
	
	(
	
		select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0')
		as type from a_imprest_voucher x inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num
		where x.imp_holder='$emp_code' and x.imp_holder_office='$office_code'
		and
		(x.voucher_status=3) and coalesce(type,'0')<>'r' and amount>0 and time<>'' and
		coalesce(time::text,'0')::numeric
		<(select coalesce(time::text,'0')::numeric
		from v_date_of_imprest_origin where imprest_id_ref= '$imp_ref_id' )

		and 
		
		
		coalesce(time::text)::numeric >(
				select extract(epoch from imp_opn_time) from a_imprest_operations where imprest_id_ref= '$imp_ref_id' 
				 and imp_operation='200' order by imprest_op_id desc limit 1
				
				)
		order by time,date_of_payment


	
	
	
	)
	
	
	
	
	
	
	
	
	
	)y";




			$qry = " select coalesce(sum(amount)::text,'0')::numeric as sum from
	( 
	
	(
	select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0')
	as type from a_imprest_voucher x inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num
	where x.imp_holder='$emp_code' and x.imp_holder_office='$office_code'
	and imp_fy='$fy' and
	(x.voucher_status=2) and coalesce(type,'0')<>'r' and amount>0 and time<>0 and
	coalesce(time::text)::numeric
	< (select coalesce(time::text,'0')::numeric
	from v_date_of_imprest_origin where imprest_id_ref= '$imp_ref_id' )
	order by time,date_of_payment
	
	)
	union all
	
	(
	
		select date_of_payment,amount,time::numeric as time2 , coalesce(type,'0')
		as type from a_imprest_voucher x inner join v_date_of_imprest_origin vo on vo.imprest_id_ref=x.imprest_num
		where x.imp_holder='$emp_code' and x.imp_holder_office='$office_code'
		and imp_fy='$fy' and
		(x.voucher_status=3) and coalesce(type,'0')<>'r' and amount>0 and time<>0 and
		coalesce(time::text,'0')::numeric
		<(select coalesce(time::text,'0')::numeric
		from v_date_of_imprest_origin where imprest_id_ref= '$imp_ref_id' )

		and 
		
		
		passed_date>to_timestamp(
         
			(select coalesce(time::text,'0')::numeric from v_date_of_imprest_origin
			 where imprest_id_ref= '$imp_ref_id' )
)


		order by time,date_of_payment


	
	
	
	)
	
	
	
	
	
	
	
	
	
	)y";






			// echo $qry;
			/*and not to_timestamp(coalesce(time::text,'0')::numeric)>date_of_payment*/

			$used = self::getData($qry, 'sum');
			//echo "this is used".$used;

			//print_r($used);

		}
		if ($imp_ref_id == 0) {

			$fy = date("Y-m-d");
			
	
			$imp_fy = self::findFinancialYear($fy);

			// 


			$qry = "select coalesce(sum(amount),0) as sum from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and 
		imp_holder_office='$_SESSION[office_code]' and voucher_status='2' and  (coalesce(type,'Nill')<>'r' and 
		coalesce(type,'Nill')<>'cash_in_hand'

		and imp_fy='$imp_fy'
		
		)";

		
			$used = self::getData($qry, 'sum');

			//echo $qry;

		}



		// echo $qry;
		return $used;
	}

	public static function getOpeningCashInhand($imp_holder, $imp_holder_office, $imp_ref_id = 0)
	{

		//print_r($_SESSION);
		$fy = date("Y-m-d");
		//$fy=date("2019-03-31");

		$imp_fy = self::findFinancialYear($fy);


		if ($imp_holder == 0) {
			$imp_holder = $_SESSION[user_name];
			$imp_holder_office = $_SESSION[office_code];
		}


		//if($_SESSION[user_name]==$imp_holder) //if the user is Imprest holder show him sum of  all voucher with status 2 
		if ($imp_ref_id == 0) //if the user is Imprest holder show him sum of  all voucher with status 2 
		{
			$qry = "select sum(amount),imp_holder,ename,imp_holder_office from a_imprest_voucher 
		aiv inner join  dl_empl emp on aiv.imp_holder::int=emp.unique_code::int where 

voucher_status=2 and imp_holder='$imp_holder' and 
imp_holder_office='$imp_holder_office' group by imp_holder,ename,imp_holder_office;
";

			$qry = "
select sum(yyy.amount) from (select coalesce(v.passed_amount,x.amount) as amount from a_imprest_voucher x
left join v_passed_amount v on v.imp_voucher_id=x.imp_voucher_id
 where x.imp_holder='$_SESSION[user_name]'  and x.imprest_num<>'$imp_ref_id' and 
	 x.imp_holder_office='$_SESSION[office_code]' and (x.voucher_status='3' or x.voucher_status='2')  and   imp_fy='$imp_fy'
	 
	
	 
	 
	 ) yyy


";
			// and v.impfy='$imp_fy'
			//echo $qry;

			$qry1 = "select passed_amount as sum from v_passed_amount where imp_holder='$_SESSION[user_name]' and
imp_holder_office='$_SESSION[office_code]' where impfy='$imp_fy'  ";

			//andseke
			//  imp_fy>'$fystart' 



		} else //if user in not imprest holder show sum of all vouchers with status 2 except the vouchers in  current imprest request
		{


			$qry = "select sum(amount),imp_holder,ename,imp_holder_office from a_imprest_voucher aiv inner join  dl_empl emp
	on aiv.imp_holder::int=emp.unique_code::int where 

voucher_status=2 and imp_holder='$imp_holder' and imp_holder_office='$imp_holder_office'
 and imprest_num<>'$imp_ref_id' group by imp_holder,ename,imp_holder_office;
";

			//new qry with date less than first voucher of the current imprest 


			$qry = "select sum(amount),imp_holder,ename,imp_holder_office from a_imprest_voucher aiv inner join
 dl_empl emp on aiv.imp_holder::int=emp.unique_code::int where voucher_status=2 and imp_holder='$imp_holder' and 
 imp_holder_office='$imp_holder_office' and

 date_of_payment<=(select distinct(date_of_payment) from a_imprest_voucher where imprest_num='$imp_ref_id' order by date_of_payment asc limit 1) 
 
 and imprest_num<>'$imp_ref_id'
  group by imp_holder,ename,imp_holder_office";


			$qry = "select sum(amount),imp_holder,ename,imp_holder_office from a_imprest_voucher aiv inner join
 dl_empl emp on aiv.imp_holder::int=emp.unique_code::int where (voucher_status=2 or voucher_status=3)  and imp_holder='$imp_holder' and 
 imp_holder_office='$imp_holder_office' and imprest_num in (select distinct(imprest_num) from a_imprest<=
 (select distinct(to_char(date_of_payment,'DDMMYYYY')::bigint) as kk from a_imprest_voucher where imprest_num='$imp_ref_id' 
 order by kk asc limit 1) )


 
 and imprest_num<>'$imp_ref_id'
  group by imp_holder,ename,imp_holder_office";


			//echo $qry;

			$curr = explode("/", $imp_ref_id);
			$curr1 = substr($curr[4], 11, 12);
			$qry = "select sum(sum) from vw_pimprest_total v where imp_holder='$imp_holder' and 
 imp_holder_office='$imp_holder_office' and ukey::numeric<$curr1";
			//echo $qry;



			//latest qry for consdering passed amount only for arriving balance 

			$empcode1 = split("/", $imp_ref_id);
			$emp_code = $empcode1[0];
			$office_code = $empcode1[1];




			$uniq = $empcode1[4];
			//echo $uniq;
			$date_of_submision = substr($uniq, 7, 8);

			$d = substr($date_of_submision, 0, 2);
			$m = substr($date_of_submision, 2, 2);
			$y = substr($date_of_submision, 4, 4);

			$date_of_submision2 = $y . "-" . $m . "-" . "$d";

			$time = substr($uniq, 15, 23);

			$qry = "
select sum (act.act) from (
 select coalesce(v.passed_amount,x.amount) as act ,x.amount,v.passed_amount,x.date_of_payment,x.imprest_num from a_imprest_voucher
   x left join v_passed_amount v on v.imp_voucher_id=x.imp_voucher_id
    left join  v_date_of_imprest_origin vo on x.imprest_num=vo.imprest_id_ref 

where

 
 to_timestamp(vo.time::numeric)< to_timestamp('$time')

 and x.imp_holder='$imp_holder' and x.imp_holder_office='$imp_holder_office'  and 
 coalesce(x.imprest_num,'0')<>'$imp_ref_id' 
 order by x.date_of_payment) act";


			$qry = "
select sum (act.act) from (

select coalesce(v.passed_amount,x.amount)
as act ,x.amount,v.passed_amount,x.date_of_payment,coalesce(x.imprest_num,'0')as imprest_num,vo.time::numeric from 
a_imprest_voucher x 
left join v_passed_amount v on v.imp_voucher_id=x.imp_voucher_id 
left join v_date_of_imprest_origin vo on coalesce(x.imprest_num,'0')=vo.imprest_id_ref 
where x.imp_fy='$imp_fy' and 
to_timestamp(coalesce(vo.time::text,'0')::numeric)< to_timestamp('$time') and  x.imp_holder='$imp_holder'
and x.imp_holder_office='$imp_holder_office'   and voucher_status<>1 and 
coalesce(x.imprest_num,'0')<>'$imp_ref_id' and  not (x.date_of_payment> to_timestamp('$time'))
order by x.date_of_payment
) act

";
		}


		
		//echo $qry;
		//echo $_SESSION[user_name];
		//echo $imp_holder;//

		if($_SESSION[aquired]==1)
{

$ss=0;

// echo $qry;

}

		//echo $qry;
		$used = self::getData($qry, 'sum');

		//echo $qry;
		//print_r($used);
		return $used;
	}
	public static function getSumOfIssuedImprestInFy($emp_code, $office_code, $freshIssuebeforeDate)
	{


		if ($emp_code == 0) {
			$emp_code = $_SESSION[user_name];
			$office_code = $_SESSION[office_code];
		}



		$fy = date("Y-m-d");
		//$fy=date("2019-03-31");

		$imp_fy = self::findFinancialYear($fy);

		$qry = "select COALESCE(sum(amount),0) as sum from a_imprest where imp_holder='$emp_code'
	 and imp_holder_office='$office_code' and imp_fy='$imp_fy'";

		// and imp_time<'$freshIssuebeforeDate'


		if($_SESSION[aquired]==1)
{

$ss=0;

// echo $qry;

}

		$used = self::getData($qry, 'sum');

		if ($used == 0) {

			$qry = "select -amount as amount  from a_imprest_voucher where imp_holder='$emp_code'
	 and imp_holder_office='$office_code' and imp_fy='$imp_fy' and type='cash_in_hand'";

			//echo $qry;
			$used = self::getData($qry, 'amount');
		}

		//echo $qry;



		//echo $used;
		//print_r($used);

		//$used=15000;
		return $used;

		//

	}






	public static function getImprestTilteFromNum($imprest_ref_id, $imp_date)
	{
		$arr = split("/", $imprest_ref_id);
		$emp_code = $arr[0];
		$office = $arr[1];
		$dateS = $arr[4];
		$date = split("$emp_code", $imprest_ref_id);
		//echo $date;
		//$date=split("$emp_code",$imprest_ref_id);

		//echo $date[2]."date";
		//echo $imprest_ref_id;


		//$date_array = explode(".",$date[2]);

		//print_r($date);

		//
		$date1 = $imp_date;

		$date1 = date_create_from_format("Y-m-d", $date1);
		$date1 = date_format($date1, "M Y");

		//echo "<br>".$date1."date1<br>";

		$emp_name = self::getEmpNameFromEmpCode($emp_code);
		$office_name = self::get_office_name($office);

		echo "Permanant Imprest Account of $emp_name , $office_name for the Month of  $date1";
	}



	public static function show_imprest_cash_book($imp_ref_id = 0)

	{


		$available_in_table=false;

		$imp_num = $imp_ref_id;


if(!imp_ref_id==0){
	// echo $imp_ref_id.'this';
$qry="select * from a_imprest_details where imprest_ref_id='$imp_ref_id'";
$db = new DBAccess;
		$row1 = $db->SelectData($qry);
		// print_r($row1);
		if (!isset($row1['EOF']))
		 {


			// echo $qry;
			$available_in_table=true;

			$row=$row1[0];

			$exp=$row[expenditure];
			$op_bal=$row[opening_balance]*-1;
			$imp_transit=$row[imp_total_in_transit];
			$bal=$row[balance];
			

		}




}

// $available_in_table=false;




		$qry = "select date_of_payment DATE,imp_voucher_id as \"Voucher Id.\",voucher_num as \"Sl.No of Voucher \",item_desc as 
	\"Particulars of transaction\",amount as Amount,item_acc_code from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 ";


		if ($imp_ref_id == 0) {

			$qry = "select date_of_payment DATE,imp_voucher_id,voucher_num,item_desc,amount as Amount,item_acc_code,type from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 order by date_of_payment,imp_voucher_id";
		} else {
			$qry = "select date_of_payment DATE,imp_voucher_id,voucher_num,item_desc,amount as Amount,item_acc_code,type from a_imprest_voucher
	where imprest_num='$imp_ref_id' order by  date_of_payment,imp_voucher_id 
	
	 ";
		}



		if($_SESSION[aquired]==1)
{

	// checking qry 1

	// echo $qry;   .5 ms 

}
		//echo $qry;


		/////////////////////cash book //////////////////////////////////

		$tableHead = "Imprest CASH ACCOUNT (original Entries by Imprest holder)";
		$trclass = "voucher";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);
		//echo $qry;

		//print_r($row1);
		if (!$row1['EOF'] == 1) {


			//print_r($row1); 
			//echo "<canvas>";
			?>

			<?php
			echo "<i class='fa fa-print fa-2x pull-right' id='i_print_cash_book' style='cursor: pointer;color:black;border-collapse: collapse;'>&nbsp;Print</i>";
			echo "<table class='table table-hovered table-stripped table-bordered dataTable' border=1 id='table_cash_book' >";

			echo "<caption class='bg-primary text-center'>$tableHead</caption>";
			//$row=$result->fetch_assoc;

			echo "<thead style='color:blue'>";
			echo "<tr>";
			echo "<th rowspan=2> Sl</th>";
			echo "<th rowspan=2> Date</th>";
			//echo "<th>Sys id</th>";

			echo "<th rowspan=2> Particulars of Transaction</th>";
			//echo "<th> Amount Received</th>";
			echo "<th colspan=2> Amount Disbursed </th>";
			echo "<th rowspan=2> Head of Account</th>";
			echo "<th style='display:none' class=text-primary> Select All <input type=checkbox disabled=disabled checked=checked class=form-control id='voucher_select_all'></th>";

			echo "</tr>";

			echo "<tr><th class=text-success>Dr.</th><th class=text-danger>Cr.</th></tr>";

			echo "</thead>";




			//$openingbalance=self::getimprestBalanceAmount(0,'$_SESSION[user_name]','$_SESSION[office_code]','2016-04-01',10000);



			// $openingbalance=self::getSumOfIssuedImprestInFy($emp_code,$office_code); 


			$empcode1 = split("/", $imp_ref_id);
			$emp_code = $empcode1[0];
			$office_code = $empcode1[1];



			//echo "opening bal $openingbalance";

			$uniq = $empcode1[4];
			//echo $uniq;
			$date_of_submision = substr($uniq, 7, 8);

			$d = substr($date_of_submision, 0, 2);
			$m = substr($date_of_submision, 2, 2);
			$y = substr($date_of_submision, 4, 4);

			$date_of_submision = $d . "-" . $m . "-" . "$y";

			if ($date_of_submision == '--') {
				$date_of_submision = date('d-m-Y');
			}

			$freshIssuebeforeDate = $y . "-" . $m . "-" . "$d";
			
			if($available_in_table){
				$openingbalance=self::getSumOfIssuedImprestInFy($emp_code, $office_code, $freshIssuebeforeDate);

			}else{
				$openingbalance = self::getSumOfIssuedImprestInFy($emp_code, $office_code, $freshIssuebeforeDate);


			}

			//echo $openingbalance;

			//$date_of_submision=date('d-M-Y',$date_of_submision);

			//echo $imp_ref_id;
			


			if($available_in_table){
				$openingCashInhand1=$op_bal;

			}else{
				$openingCashInhand1 = self::getOpeningCashInhand($emp_code, $office_code, $imp_ref_id);


			}



			$openingCashInhand = $openingCashInhand1 * -1;

			$openingCashInhand1 = number_format((float) $openingCashInhand, 2, '.', '');
			echo "<tr class=text-danger><td colspan=3>Opening cash in Hand</td><td id=td_opening_cash_in_hand>$openingCashInhand</td><td></td><td></td><td></td></tr>";

			$sl = 1;
			$total = 0;
			$received2 = 0;
			foreach ($row1 as $row) {



				echo "<tr class=$trclass id=$row[imp_voucher_id]>";




				$qry = "select date_of_payment DATE,imp_voucher_id as \"Voucher Id.\",voucher_num as \"Sl.No of Voucher \",item_desc as 
	\"Particulars of transaction\",amount as Amount,item_acc_code from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 ";



				//echo "<td >$row['imp_voucher_id']</td>";
				//echo "<td >$row['Voucher Id.']</td>";
				//echo "<td >$row[voucher_num]</td>";


				if ($row[type] == 'cash_in_hand') {

					$timestamp = strtotime($row[date]);



					$dmy = date("d-m-y", $timestamp);
					echo "<td >0</td>";
					echo "<td width=75 >$dmy</td>";

					$received = $row[amount] * -1;
					$received1 = number_format((float) $received, 2, '.', '');

					//echo "<td > Received Amount by Recoupment </td>";
					echo "<td >$row[item_desc]</td>";

					echo "<td class=text-success>$received1</td>";

					//echo "<td>0</td>";

					$received2 = $received2 + $received1;
					$openingbalance = $received1;
					//$openingbalance=$received2;
				}


				if ($row[item_desc] == 'KSEB') {

					$cheque = self::getChequeDetailsfromImpVoucherId($row['imp_voucher_id']);
					// $cheque =' a a';

					$chk = explode(' ', $cheque);

					//print_r($chk);
					//$row[date]=$chk[4];
					//$timestamp = strtotime($row[date]);
					$dmy = $chk[4];


					//$dmy = date("d-m-y", $timestamp);

					echo "<td >0</td>";
					echo "<td width=75 >$dmy</td>";
					$received = $row[amount] * -1;
					$received1 = number_format((float) $received, 2, '.', '');


					// $cheque = self::getChequeDetailsfromImpVoucherId($row['imp_voucher_id']);
					echo "<td  class=bg-primary> Received Amount by Recoupment $cheque </td>";


					echo "<td class=text-success>$received1</td>";

					//echo "<td>0</td>";


					$received2 = $received2 + $received1;
				} else {

					$timestamp = strtotime($row[date]);

					echo "<td >$sl</td>";

					$dmy = date("d-m-y", $timestamp);

					echo "<td width=75 >$dmy</td>";
					if ($row[type] == 'cash_in_hand') continue;

					$spend = number_format((float) $row[amount], 2, '.', '');


					echo "<td >$row[item_desc]</td>";

					echo "<td></td>";
					echo "<td class=text-danger>$spend</td>";

					$sl++;


					$total = $total + $row[amount];
				}


				//echo "<td >$row[DATE]</td>";

				//////////////////account head ////////////////////////////////

				if ($row[item_desc] <> 'KSEB') {
					echo "<td >$row[item_acc_code]</td>";
				}



				///////////////////////////////////////////////////////////////////


				echo "<td class=text-primary><input disabled=disabled style='display:none' checked=checked class=\"form-control chk_box\" type=checkbox id=$row[imp_voucher_id]></td>";

				echo "</tr>";
			}


			//echo "opening balance $openingbalance and total $total ";
			$cash_in_hand = $openingbalance - $total;


			//$cash_in_hand=$openingCashInhand-$total;
			//echo "<tr class=bg-primary><td colspan=4>Total Expenditure</td><td>$total</td><td></td><td></td></tr>";
			//echo "<tr class=bg-primary><td colspan=4>Cash in hand</td><td id=td_cash_in_hand>$cash_in_hand</td><td></td><td></td></tr>";

			$total1 = number_format((float) $total, 2, '.', '');
			$cash_in_hand1 = number_format((float) $cash_in_hand, 2, '.', '');

			//echo $cash_in_hand1;

			$cash1 = ($openingCashInhand + $received2) * -1 + $total1;
			//echo $received2;
			$cash2 = $cash1 * -1;

			$cash = number_format((float) $cash2, 2, '.', '');
			
			
			

			if($available_in_table){
				$imprest_already_submitted=$imp_transit;

			}else{
				 $imprest_already_submitted = self::getSumOfImprestSubmitted($imp_num);


			}


			echo "<tr class=' text-primary lead'><td colspan=3>Total Expenditure</td><td></td><td id=td_tot_exp>$total1</td><td></td></tr>";






			// echo $imprest_already_submitted;
			//echo "ref id $imp_num";
			if ($imprest_already_submitted >= 0) {
				$cash_in_hand2 = $cash_in_hand1 - $imprest_already_submitted;
				echo "<tr class=' text-success lead'><td colspan=3>Cash in hand on Submision date 
			 $date_of_submision</td><td ></td><td id=td_cash_in_hand>$cash_in_hand2</td><td></td></tr>";
				echo "<tr class=' text-danger lead'><td colspan=3>Imprest Already submitted </td>
			<td >$imprest_already_submitted</td><td id=td_imprest_already_submitted>$imprest_already_submitted</td><td></td></tr>";
			} else {
				$cash_in_hand2 = $cash_in_hand1;
				echo "<tr class=' text-success lead'><td colspan=3>Cash in hand on Submision date 
			 $date_of_submision</td><td ></td><td id=td_cash_in_hand>$cash_in_hand2</td><td></td></tr>";
			}
			//echo "<tr class=' text-danger lead'><td colspan=3>Imprest Already submitted </td><td >$imprest_already_submitted</td><td></td><td></td></tr>";






			$cr_total = $total1 + $cash_in_hand1;
			$dr_balance = $received2 + $openingCashInhand + $imprest_already_submitted;
			echo "<tr><td class=text-primary colspan=3>Total</td> <td class='text-success'>$dr_balance</td><td class='text-danger'>$cr_total</td></tr>";

			//echo "<tr class=' text-danger lead'><td colspan=3>Cash in hand Live (Including expense incured by other Requests) </td><td id=td_cash_in_hand_live>$cash</td><td></td><td></td></tr>";








			echo "</table>";
			//echo "</canvas>";

			?>


			<script>
				// $('.dataTable').DataTable();
			</script>
		<?php


			//return $row;

		} else { //no data in in box


			self::show_error("NO data");
		}

		//////////////////////////cash book end//////////////////////////







	}

	public static function show_imprest_cash_book2($imp_ref_id = 0)

	{

		$qry = "select * from a_imprest_details where imprest_ref_id='$imp_ref_id' ";

		$db = new DBAccess;
		$row = $db->SelectData($qry);
		if ($row[EOF] == 1) { } else { }



		$imp_num = $imp_ref_id;
		$qry = "select date_of_payment DATE,imp_voucher_id as \"Voucher Id.\",voucher_num as \"Sl.No of Voucher \",item_desc as 
	\"Particulars of transaction\",amount as Amount,item_acc_code from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 ";


		if ($imp_ref_id == 0) {

			$qry = "select date_of_payment DATE,imp_voucher_id,voucher_num,item_desc,amount as Amount,item_acc_code,type from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 order by date_of_payment,imp_voucher_id";
		} else {
			$qry = "select date_of_payment DATE,imp_voucher_id,voucher_num,item_desc,amount as Amount,item_acc_code,type from a_imprest_voucher
	where imprest_num='$imp_ref_id' order by  date_of_payment,imp_voucher_id 
	
	 ";
		}

		//echo $qry;


		/////////////////////cash book //////////////////////////////////

		$tableHead = "Imprest CASH ACCOUNT (original Entries by Imprest holder)";
		$trclass = "voucher";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);
		//echo $qry;

		//print_r($row1);
		if (!$row1['EOF'] == 1) {


			//print_r($row1); 
			//echo "<canvas>";
			?>

			<?php
			echo "<i class='fa fa-print fa-2x pull-right' id='i_print_cash_book' style='cursor: pointer;color:black;border-collapse: collapse;'>&nbsp;Print</i>";
			echo "<table class='table table-hovered table-stripped table-bordered dataTable' border=1 id='table_cash_book' >";

			echo "<caption class='bg-primary text-center'>$tableHead</caption>";
			//$row=$result->fetch_assoc;

			echo "<thead style='color:blue'>";
			echo "<tr>";
			echo "<th rowspan=2> Sl</th>";
			echo "<th rowspan=2> Date</th>";
			//echo "<th>Sys id</th>";

			echo "<th rowspan=2> Particulars of Transaction</th>";
			//echo "<th> Amount Received</th>";
			echo "<th colspan=2> Amount Disbursed </th>";
			echo "<th rowspan=2> Head of Account</th>";
			echo "<th style='display:none' class=text-primary> Select All <input type=checkbox disabled=disabled checked=checked class=form-control id='voucher_select_all'></th>";

			echo "</tr>";

			echo "<tr><th class=text-success>Dr.</th><th class=text-danger>Cr.</th></tr>";

			echo "</thead>";




			//$openingbalance=self::getimprestBalanceAmount(0,'$_SESSION[user_name]','$_SESSION[office_code]','2016-04-01',10000);



			//$openingbalance=self::getSumOfIssuedImprestInFy($emp_code,$office_code); 


			$empcode1 = split("/", $imp_ref_id);
			$emp_code = $empcode1[0];
			$office_code = $empcode1[1];



			//echo "opening bal $openingbalance";

			$uniq = $empcode1[4];
			//echo $uniq;
			$date_of_submision = substr($uniq, 7, 8);

			$d = substr($date_of_submision, 0, 2);
			$m = substr($date_of_submision, 2, 2);
			$y = substr($date_of_submision, 4, 4);

			$date_of_submision = $d . "-" . $m . "-" . "$y";

			if ($date_of_submision == '--') {
				$date_of_submision = date('d-m-Y');
			}

			$freshIssuebeforeDate = $y . "-" . $m . "-" . "$d";
			$openingbalance = self::getSumOfIssuedImprestInFy($emp_code, $office_code, $freshIssuebeforeDate);

			//echo $openingbalance;

			//$date_of_submision=date('d-M-Y',$date_of_submision);

			//echo $imp_ref_id;
			$openingCashInhand1 = self::getOpeningCashInhand($emp_code, $office_code, $imp_ref_id);
			$openingCashInhand = $openingCashInhand1 * -1;

			$openingCashInhand1 = number_format((float) $openingCashInhand, 2, '.', '');
			echo "<tr class=text-danger><td colspan=3>Opening cash in Hand</td><td id=td_opening_cash_in_hand>$openingCashInhand</td><td></td><td></td><td></td></tr>";

			$sl = 1;
			$total = 0;
			$received2 = 0;
			foreach ($row1 as $row) {



				echo "<tr class=$trclass id=$row[imp_voucher_id]>";




				$qry = "select date_of_payment DATE,imp_voucher_id as \"Voucher Id.\",voucher_num as \"Sl.No of Voucher \",item_desc as 
	\"Particulars of transaction\",amount as Amount,item_acc_code from a_imprest_voucher
	where imp_voucher_id>1 and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'
	
	AND voucher_status=1 ";



				//echo "<td >$row['imp_voucher_id']</td>";
				//echo "<td >$row['Voucher Id.']</td>";
				//echo "<td >$row[voucher_num]</td>";


				if ($row[type] == 'cash_in_hand') {

					$timestamp = strtotime($row[date]);



					$dmy = date("d-m-y", $timestamp);
					echo "<td >0</td>";
					echo "<td width=75 >$dmy</td>";

					$received = $row[amount] * -1;
					$received1 = number_format((float) $received, 2, '.', '');

					//echo "<td > Received Amount by Recoupment </td>";
					echo "<td >$row[item_desc]</td>";

					echo "<td class=text-success>$received1</td>";

					//echo "<td>0</td>";

					$received2 = $received2 + $received1;
					$openingbalance = $received1;
					//$openingbalance=$received2;
				}


				if ($row[item_desc] == 'KSEB') {

					$cheque = self::getChequeDetailsfromImpVoucherId($row['imp_voucher_id']);

					$chk = explode(' ', $cheque);

					//print_r($chk);
					//$row[date]=$chk[4];
					//$timestamp = strtotime($row[date]);
					$dmy = $chk[4];


					//$dmy = date("d-m-y", $timestamp);

					echo "<td >0</td>";
					echo "<td width=75 >$dmy</td>";
					$received = $row[amount] * -1;
					$received1 = number_format((float) $received, 2, '.', '');


					$cheque = self::getChequeDetailsfromImpVoucherId($row['imp_voucher_id']);
					echo "<td  class=bg-primary> Received Amount by Recoupment $cheque </td>";


					echo "<td class=text-success>$received1</td>";

					//echo "<td>0</td>";


					$received2 = $received2 + $received1;
				} else {

					$timestamp = strtotime($row[date]);

					echo "<td >$sl</td>";

					$dmy = date("d-m-y", $timestamp);

					echo "<td width=75 >$dmy</td>";
					if ($row[type] == 'cash_in_hand') continue;

					$spend = number_format((float) $row[amount], 2, '.', '');


					echo "<td >$row[item_desc]</td>";

					echo "<td></td>";
					echo "<td class=text-danger>$spend</td>";

					$sl++;


					$total = $total + $row[amount];
				}


				//echo "<td >$row[DATE]</td>";

				//////////////////account head ////////////////////////////////

				echo "<td >$row[item_acc_code]</td>";


				///////////////////////////////////////////////////////////////////


				echo "<td class=text-primary><input disabled=disabled style='display:none' checked=checked class=\"form-control chk_box\" type=checkbox id=$row[imp_voucher_id]></td>";

				echo "</tr>";
			}


			//echo "opening balance $openingbalance and total $total ";
			$cash_in_hand = $openingbalance - $total;


			//$cash_in_hand=$openingCashInhand-$total;
			//echo "<tr class=bg-primary><td colspan=4>Total Expenditure</td><td>$total</td><td></td><td></td></tr>";
			//echo "<tr class=bg-primary><td colspan=4>Cash in hand</td><td id=td_cash_in_hand>$cash_in_hand</td><td></td><td></td></tr>";

			$total1 = number_format((float) $total, 2, '.', '');
			$cash_in_hand1 = number_format((float) $cash_in_hand, 2, '.', '');

			//echo $cash_in_hand1;

			$cash1 = ($openingCashInhand + $received2) * -1 + $total1;
			//echo $received2;
			$cash2 = $cash1 * -1;

			$cash = number_format((float) $cash2, 2, '.', '');
			$imprest_already_submitted = self::getSumOfImprestSubmitted($imp_num);


			echo "<tr class=' text-primary lead'><td colspan=3>Total Expenditure</td><td></td><td id=td_tot_exp>$total1</td><td></td></tr>";






			//echo $imprest_already_submitted;
			//echo "ref id $imp_num";
			if ($imprest_already_submitted >= 0) {
				$cash_in_hand2 = $cash_in_hand1 - $imprest_already_submitted;
				echo "<tr class=' text-success lead'><td colspan=3>Cash in hand on Submision date 
			 $date_of_submision</td><td ></td><td id=td_cash_in_hand>$cash_in_hand2</td><td></td></tr>";
				echo "<tr class=' text-danger lead'><td colspan=3>Imprest Already submitted </td>
			<td >$imprest_already_submitted</td><td id=td_imprest_already_submitted>$imprest_already_submitted</td><td></td></tr>";
			} else {
				$cash_in_hand2 = $cash_in_hand1;
				echo "<tr class=' text-success lead'><td colspan=3>Cash in hand on Submision date 
			 $date_of_submision</td><td ></td><td id=td_cash_in_hand>$cash_in_hand2</td><td></td></tr>";
			}
			//echo "<tr class=' text-danger lead'><td colspan=3>Imprest Already submitted </td><td >$imprest_already_submitted</td><td></td><td></td></tr>";






			$cr_total = $total1 + $cash_in_hand1;
			$dr_balance = $received2 + $openingCashInhand + $imprest_already_submitted;
			echo "<tr><td class=text-primary colspan=3>Total</td> <td class='text-success'>$dr_balance</td><td class='text-danger'>$cr_total</td></tr>";

			//echo "<tr class=' text-danger lead'><td colspan=3>Cash in hand Live (Including expense incured by other Requests) </td><td id=td_cash_in_hand_live>$cash</td><td></td><td></td></tr>";








			echo "</table>";
			//echo "</canvas>";

			?>


			<script>
				// $('.dataTable').DataTable();
			</script>
		<?php


			//return $row;

		} else { //no data in in box


			self::show_error("NO data");
		}

		//////////////////////////cash book end//////////////////////////







	}


	public static function show_panel($head, $body, $panel = "panel panel-info")
	{

		?>

		<div class="<?php echo $panel; ?>">
			<div class="panel-heading"><?php echo $head; ?></div>
			<div class="panel-body"><?php echo $body; ?></div>
		</div>


	<?php

	}



	public static function findFinancialYear($date)

	{
		if (!empty($date)) {

			if (date('m', strtotime($date)) <= 3) { //Upto march
				$financial_year = (date('Y', strtotime($date)) - 1) . '-' . date('Y', strtotime($date));
			} else { //After march
				$financial_year = date('Y', strtotime("$date")) . '-' . (date('Y', strtotime($date)) + 1);
			}
			//echo $financial_year;

			//$financial_year='2018-2019';
			return $financial_year;
		} else return null;
	}
	private function replace_space_in_string($string = null)
	{
		if (!empty($string)) {
			$string = str_replace(" ", "_", $string);
			$string = str_replace("  ", "_", $string);
			$string = str_replace(", ", "_", $string);
			$string = str_replace(",", "_", $string);
			$string = str_replace("/", "", $string);

			$string = str_replace("__", "_", $string);
		}
		return $string;
	}
	public static function transfer_file_to_folder($file, $imp_voucher_id, $imp_num)
	{

		$folder = "imprest_files";
		//$folder="/saras_app_data/SARAS/documents/imprest_files";

		$slash = "/";
		if (!is_dir($folder)) {
			mkdir($folder);
		}

		$fy = date("Y-m-d");
		$fy = self::findFinancialYear($fy);
		$folder = "imprest_files$slash$fy";

		if (!is_dir($folder)) {
			mkdir($folder);
		}
		$office = $_SESSION[office_name];
		/*$office=str_replace(" ","_",$office);
					$office=str_replace("  ","_",$office);
					$office=str_replace(", ","_",$office);
					$office=str_replace(",","_",$office);
					$office=str_replace("/","",$office); */
		$office = self::replace_space_in_string($office);
		//$office=$_SESSION[office_code];
		$folder = "imprest_files$slash$fy$slash$office";


		if (!is_dir($folder)) {
			mkdir($folder);
			//	echo $folder;
		}

		$name_empcode = $_SESSION[full_name] . "-" . $_SESSION[user_name];
		$name_empcode = self::replace_space_in_string($name_empcode);
		$folder = "imprest_files$slash$fy$slash$office$slash$name_empcode$slash";
		if (!is_dir($folder)) {
			mkdir($folder);
			//echo $folder;
		}

		$mon = date("M");

		$folder = "imprest_files$slash$fy$slash$office$slash$name_empcode$slash$mon$slash";

		if (!is_dir($folder)) {
			mkdir($folder);
			//echo $folder;
		}


		$d = date("d-m-Y");

		$folder = "imprest_files$slash$fy$slash$office$slash$name_empcode$slash$mon$slash$d$slash";

		if (!is_dir($folder)) {
			mkdir($folder);
			//echo $folder;
		}


		//		$imp_file="$folder".time()."-".$file['data_of_purchase']['name'];	
		$imp_file = "$folder" . time() . "_" . rand(10000, 1000000);
		move_uploaded_file($file['data_of_purchase']['tmp_name'], $imp_file);


		//$imp_file_name=$file[name];
		//$imp_file=$file[data_of_purchase][tmp_name];
		//$imp_file=addslashes(file_get_contents($file[data_of_purchase][tmp_name]));
		$imp_file_type = $file[data_of_purchase][type];

		$date = date("Y-m-d");
		//$date=date("2019-03-25");
		$fy = imprestN::findFinancialYear($date);

		$db = new DBAccess;

		$qry = "insert into a_imprest_files (imp_voucher_id,imp_num,imp_file_name,imp_file,imp_file_category,imp_file_type,imp_fy)

values

($imp_voucher_id,'$imp_num','$imp_file_name','$imp_file','V','$imp_file_type','$fy')";

		//echo $qry;

		$result = $db->UpdateData($qry);
		if ($result['EOF']) {
			$result['adl_msg'] = "Insert into Voucher files failed";
			$db->DBrollBackTrans();
			return $result;
		}
	}
	public static function transfer_sup_file_to_folder($file, $post, $imp_voucher_id, $imp_num)
	{

		$folder = "imprest_files";

		$slash = "/";
		if (!is_dir($folder)) {
			mkdir($folder);
		}

		$fy = date("Y-m-d");
		//$fy=date("2019-03-31");
		$fy = self::findFinancialYear($fy);
		$folder = "imprest_files$slash$fy";

		if (!is_dir($folder)) {
			mkdir($folder);
		}
		$office = $_SESSION[office_name];

		//$office=str_replace("/","",$office);
		//$office=$_SESSION[office_code];
		$office = self::replace_space_in_string($office);
		$folder = "imprest_files$slash$fy$slash$office";


		if (!is_dir($folder)) {
			mkdir($folder);
			//	echo $folder;
		}

		$name_empcode = $_SESSION[full_name] . "-" . $_SESSION[user_name];
		$name_empcode = self::replace_space_in_string($name_empcode);
		$folder = "imprest_files$slash$fy$slash$office$slash$name_empcode$slash";
		if (!is_dir($folder)) {
			mkdir($folder);
			//echo $folder;
		}

		$mon = date("M");

		$folder = "imprest_files$slash$fy$slash$office$slash$name_empcode$slash$mon$slash";

		if (!is_dir($folder)) {
			mkdir($folder);
			//echo $folder;
		}


		$d = date("d-m-Y");

		$folder = "imprest_files$slash$fy$slash$office$slash$name_empcode$slash$mon$slash$d$slash";

		if (!is_dir($folder)) {
			mkdir($folder);
			//echo $folder;
		}

		echo $folder;

		///	print_r($post);
		//print_r($file);
		$doctype = $post[doctype];
		$count = 0;
		foreach ($doctype as $doc) {
			//$fil=$post[supporting_file][count];
			//echo "<br>this is doc $doc <br>";
			//echo "<h1 class=bg-primary>this $count is file $fil[$count]";

			//	$imp_file="$folder".time()."-".$file['supporting_file']['name'][$count];	
			$imp_file = "$folder" . time() . "_" . rand(10000, 1000000);
			echo $imp_file;
			move_uploaded_file($file['supporting_file']['tmp_name'][$count], $imp_file);

			$imp_file_type = $file['supporting_file'][type][$count];

			$date = date("Y-m-d");
			//$date=date("2019-03-25");
			$fy = imprestN::findFinancialYear($date);

			$db = new DBAccess;
			//echo $imp_file;



			$qry = "insert into a_imprest_files (imp_voucher_id,imp_num,imp_file_name,imp_file,imp_file_category,imp_file_type,imp_fy)
	
	values
	
	($imp_voucher_id,'$imp_num','$imp_file_name','$imp_file','$doc','$imp_file_type','$fy')";

			//echo $qry;

			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into Voucher files failed";
				$db->DBrollBackTrans();
				return $result;
			}


			$count++;
		}
		//print_r($file);




		//$imp_file_name=$file[name];
		//$imp_file=$file[data_of_purchase][tmp_name];
		//$imp_file=addslashes(file_get_contents($file[data_of_purchase][tmp_name]));






	}


	public static function getlastDayOfFy($date)
	{

		///function to find last date of the financial year

		$fy = imprestN::findFinancialYear($date);

		$start1 = split("-", $fy);
		$start = $start1[1];

		$start_date1 = $start . "-03-31";





		return $start_date1;
	}
	public static function getFirstDayOfFy($date)
	{

		///function to find first date of the financial year

		$fy = imprestN::findFinancialYear($date);

		$start1 = split("-", $fy);
		$start = $start1[0];

		$start_date1 = $start . "-04-01";





		return $start_date1;
	}


	public static function save_cash_in_hand($post)
	{


		if ($post[date] == '') {
			$post[date] = date('Y-m-d');
		}


		$post[date] = self::dmyToyymmdd($post[date]);

		$fy = imprestN::findFinancialYear($post[date]);

		$date = $post[date];
		$post[source] = "cash_in_hand";
		//print_r($post);

		$a = 0;
		$imp_holder = $_SESSION[user_name];
		$imp_holder_office = $_SESSION[office_code];

		$office_name = self::get_office_name($imp_holder_office);
		$name_of_employee = self::getEmpNameFromEmpCode($imp_holder);
		$imp_voucher_id = $imp = self::getImpNumber();
		//$txt_txtremitrpt=$post[receipt];
		$item_description = "Cash in Hand on system start date for  $name_of_employee of $office_name ";
		$amount = $post[cash_in_hand] * -1;
		$paid_to = $imp_holder;
		$imp_num = "i";
		$txt_date_of_remitance = self::dmyToyymmdd($post[date]);
		$date_of_voucher = $txt_date_of_remitance;
		$date_of_payment = $txt_date_of_remitance;

		//$date_of_voucher=self::dmyToyymmdd($post[txt_date_of_voucher]);



		$type = "cash_in_hand";

		$item_acc_code = $post[source];




		$last_day = self::getlastDayOfFy($date_of_payment);
		$First_day = self::getFirstDayOfFy($date_of_payment);

		//echo $last_day;

		//echo $First_day; 


		//exit;


		/// deleting existing remitance voucher 
		$fy = imprestN::findFinancialYear($date);
		$qry_json="";
		$qry = "delete from a_imprest_voucher where type='$type' and imp_holder='$imp_holder' and  imp_holder_office='$imp_holder_office'
	
	 and imp_fy='$fy'";

	 $qry_json=$qry_json."<br>".$qry;

	//	echo $qry;
		$db = new DBAccess;
		$db->DBbeginTrans();

		$result = $db->UpdateData($qry);




		$date = date("Y-m-d");
		//$date=date("2019-03-25");




		//print_r($file[data_of_purchase]);

		//echo $file[data_of_purchase][tmp_name];
		$qry = "select imp_voucher_id from a_imprest_voucher where voucher_num='$post[txt_voucher_num]' and 
	item_desc='$item_description'  and amount='$amount' and item_acc_code='$item_acc_code' and imp_fy='$fy'
	";

		//$i = self::isDataInserted($qry); comending  for a posssible bug

		$qry_json=$qry_json."<br>".$qry;

		$i=false;

		if (!$i) {

			// $db = new DBAccess;
			// $db->DBbeginTrans();


			$qry = "insert into a_imprest_voucher (imp_voucher_id,voucher_num,item_desc,amount,paid_to,imprest_num,
		date_of_voucher,date_of_payment,imp_holder,
		
		imp_holder_office,item_acc_code,type,imp_fy) values 
		($imp_voucher_id,'$txt_txtremitrpt','$item_description','$amount',
		'$paid_to','$imp_num','$date_of_voucher','$txt_date_of_remitance','$imp_holder','$imp_holder_office',
		'$item_acc_code','$type','$fy') returning imp_voucher_id
		";


		$qry_json=$qry_json."<br>".$qry;

			// echo $qry;
			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}



			//$arr=array("result"=>"ok");

			$result = "ok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>Cash in hand updated successfully <br> $qry_json", "alert alert-success");

			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");


			$result1 = $result['data'];
			$imp_voucher_id1 = $result1[0];
			$imp_voucher_id = $imp_voucher_id1[imp_voucher_id];

			$imp_num = $post[txt_imp_num];












			$db->DBcommitTrans();

			echo json_encode($response);
		} else {
			$msg = "You have already Updated this voucher";
			//self::show_alert($msg);

			$result = "ok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>Cash in Already Updated", "alert alert-success");

			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		}
	}


	public static function add_remitance($post)
	{



		//print_r($post);

		$a = 0;
		$imp_holder = $_SESSION[user_name];
		$imp_holder_office = $_SESSION[office_code];

		$office_name = self::get_office_name($imp_holder_office);
		$name_of_employee = self::getEmpNameFromEmpCode($imp_holder);
		$imp_voucher_id = $imp = self::getImpNumber();
		$txt_txtremitrpt = $post[receipt];
		$item_description = "Remitance of cash in hand By $name_of_employee of $office_name ";
		$amount = $post[amount];
		$paid_to = "ksebl";
		$imp_num = "i";
		$txt_date_of_remitance = self::dmyToyymmdd($post[date]);
		$date_of_voucher = $txt_date_of_remitance;
		$date_of_payment = $txt_date_of_remitance;

		//$date_of_voucher=self::dmyToyymmdd($post[txt_date_of_voucher]);



		$type = "remitance";

		$item_acc_code = $post[source];




		$last_day = self::getlastDayOfFy($date_of_payment);
		$First_day = self::getFirstDayOfFy($date_of_payment);

		//echo $last_day;

		//echo $First_day; 


		//exit;


		/// deleting existing remitance voucher 

		$date = date("Y-m-d");
		$fy = imprestN::findFinancialYear($date);

		$qry = "delete from a_imprest_voucher where type='$type' and imp_holder='$imp_holder' and  imp_holder_office='$imp_holder_office'
	
	and voucher_status=1 and imp_fy='$fy'";

		echo $qry;
		$db = new DBAccess;

		$result = $db->UpdateData($qry);
		if ($result['EOF']) {
			$result['adl_msg'] = "Insert into amnt. details failed";
			$db->DBrollBackTrans();
			return $result;
		}



		$date = date("Y-m-d");
		//$date=date("2019-03-25");
		$fy = imprestN::findFinancialYear($date);



		//print_r($file[data_of_purchase]);

		//echo $file[data_of_purchase][tmp_name];
		$qry = "select imp_voucher_id from a_imprest_voucher where voucher_num='$post[txt_voucher_num]' and 
	item_desc='$item_description'  and amount='$amount' and item_acc_code='$item_acc_code' 
	";

		$i = self::isDataInserted($qry);




		if (!$i) {

			$db = new DBAccess;
			$db->DBbeginTrans();



			$qry = "insert into a_imprest_voucher (imp_voucher_id,voucher_num,item_desc,amount,paid_to,imprest_num,
		date_of_voucher,date_of_payment,imp_holder,
		
		imp_holder_office,item_acc_code,type,imp_fy) values 
		($imp_voucher_id,'$txt_txtremitrpt','$item_description','$amount',
		'$paid_to','$imp_num','$date_of_voucher','$txt_date_of_remitance','$imp_holder','$imp_holder_office',
		'$item_acc_code','$type','$fy') returning imp_voucher_id
		";



			//echo $qry;
			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}





			$imp_voucher_id = $result['data'][0][imp_voucher_id];

			$imp_num = $post[txt_imp_num];












			$db->DBcommitTrans();
		} else {
			$msg = "You have already Updated this voucher";
			self::show_alert($msg);
		}
	}
	public static function add_remitance_and_convert($post)
	{



		//print_r($post);

		$imprest_id_ref = $post[imprest_id_ref];
		$empcode1 = split("/", $post[imprest_id_ref]);
		$original_office = $empcode1[1];
		$imp_holder = $empcode1[0];

		//exit;

		$a = 0;
		// $imp_holder=$_SESSION[user_name];
		// $imp_holder_office=$_SESSION[office_code];

		$imp_holder = $imp_holder;
		$imp_holder_office = $original_office;

		//echo "origibal office $original_office";
		//echo "origibal name $imp_holder";


		$office_name = self::get_office_name($original_office);
		$name_of_employee = self::getEmpNameFromEmpCode($imp_holder);
		$imp_voucher_id = self::getImpNumber();
		$txt_txtremitrpt = $post[receipt];
		$item_description = "Remitance of cash in hand By $name_of_employee of $office_name ";
		$amount = $post[amount];
		$paid_to = "ksebl";
		$imp_num = $imprest_id_ref;
		$txt_date_of_remitance = self::dmyToyymmdd($post[date]);
		$date_of_voucher = $txt_date_of_remitance;
		$date_of_payment = $txt_date_of_remitance;

		//$date_of_voucher=self::dmyToyymmdd($post[txt_date_of_voucher]);



		$type = "remitance";

		$item_acc_code = $post[source];




		$last_day = self::getlastDayOfFy($date_of_payment);
		$First_day = self::getFirstDayOfFy($date_of_payment);

		//echo $last_day;

		//echo $First_day; 


		//exit;


		/// deleting existing remitance voucher 
		//$date="2019-03-31";

		$fy = imprestN::findFinancialYear($date);


		//echo $qry;

		$db = new DBAccess;
		$db->DBbeginTrans();

		$qry = "delete from a_imprest_voucher where type='$type' and imp_holder='$imp_holder' and  imp_holder_office='$imp_holder_office'
	
		 and imp_fy='$fy'";

		$result = $db->UpdateData($qry);

		//echo $qry;



		$date = date("Y-m-d");
		//	$date=date("2019-03-25");
		//$date=date("2019-03-31");

		$fy = imprestN::findFinancialYear($date);



		//print_r($file[data_of_purchase]);

		//echo $file[data_of_purchase][tmp_name];
		$qry = "select imp_voucher_id from a_imprest_voucher where voucher_num='$post[txt_voucher_num]' and 
	item_desc='$item_description'  and amount='$amount' and item_acc_code='$item_acc_code' 
	";

		//echo $qry;

		$i = self::isDataInserted($qry);




		if (!$i) {





			$qry = "insert into a_imprest_voucher (imp_voucher_id,voucher_num,item_desc,amount,paid_to,imprest_num,
		date_of_voucher,date_of_payment,imp_holder,
		
		imp_holder_office,item_acc_code,type,imp_fy) values 
		($imp_voucher_id,'$txt_txtremitrpt','$item_description','$amount',
		'$paid_to','$imp_num','$date_of_voucher','$txt_date_of_remitance','$imp_holder','$imp_holder_office',
		'$item_acc_code','$type','$fy') returning imp_voucher_id
		";



			//echo $qry;
			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}





			$imp_voucher_id = $result['data'][0][imp_voucher_id];

			$imp_num = $post[txt_imp_num];



			////////////////////////////////////////convert to vc////////////////////////////////////

			//add_remitance_and_convert

			$imprest_id_ref = $_POST[imprest_id_ref];

			$_POST[close] = 1;
			$close = $_POST[close];

			if ($close == 1) {

				$old = "V/";
				$new = "VC/";
			} else if ($close == 0) {
				$old = "VC/";
				$new = "V/";
			}






			$qry = "Update a_imprest_voucher set imprest_num=replace(imprest_num,'$old','$new') 

where imprest_num='$imprest_id_ref'";

			echo $qry;

			echo "<br>";
			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}
			$qry = "Update a_imprest_voucher_details set imprest_num=replace(imprest_num,'$old','$new') 

where imprest_num='$imprest_id_ref'";

			echo $qry;

			echo "<br>";
			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}

			$qry = "Update a_imprest_operations set imprest_id_ref=replace(imprest_id_ref,'$old','$new') 

where imprest_id_ref='$imprest_id_ref'";

			//echo $qry;
			//echo "<br>";
			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}



			$db->DBcommitTrans();



			///////////////////////////////////////////////









		} else {
			$msg = "You have already Updated this voucher";
			self::show_alert($msg);
		}
	}


	public static function add_supporting_files($post, $file)
	{ }




	public static function add_voucher($post, $file)
	{



		//print_r($post);

		$imp_file_type = $file[data_of_purchase][type];
		$check = getimagesize($file["data_of_purchase"]["tmp_name"]);

		//echo $imp_file_type; return false;

		//if($imp_file_type != "jpg" && $imp_file_type != "png" && $imp_file_type != "jpeg" && $imp_file_type != "gif" ) 

		//if($imp_file_type !='image/jpeg')

		if ($check == false) {
			$msg = "Sorry, only JPG, JPEG files are allowed.Please Upload an Image File";
			self::show_error($msg);

			return false;
		}



		$a = 0;


		$date_of_payment = self::dmyToyymmdd($post[txt_date_of_payement]);
		$date_of_voucher = self::dmyToyymmdd($post[txt_date_of_voucher]);

		$imp_holder = $_SESSION[user_name];
		$imp_holder_office = $_SESSION[office_code];

		$item_acc_code = $post['item_acc_head'];
		$imp_voucher_id = $imp = self::getImpNumber();


		$date = date("Y-m-d");
		//$date=date("2019-03-25");
		$fy = imprestN::findFinancialYear($date);
		$des = str_replace("'", "''", $post[txt_description_imprest]);
		//$des=addslashes($post[txt_description_imprest]);
		$paid_to = str_replace("'", "''", $post[txt_paid_to]);
		//$paid_to=addslashes($post[txt_paid_to]);


		$purpose = str_replace("'", "''", $post[purpose]);

		//$purpose=$post[purpose];


		//print_r($file[data_of_purchase]);

		//echo $file[data_of_purchase][tmp_name];
		$qry = "select imp_voucher_id from a_imprest_voucher where voucher_num='$post[txt_voucher_num]' and 
	item_desc='$des'  and amount='$post[txt_amount_imprest]' and paid_to='$paid_to' 
	and imprest_num='$post[txt_imp_num]' ";

		$i = self::isDataInserted($qry);



		if (!$i) {

			$db = new DBAccess;
			$db->DBbeginTrans();


			$qry = "insert into a_imprest_voucher (imp_voucher_id,voucher_num,
		item_desc,amount,paid_to,imprest_num,date_of_voucher,date_of_payment,imp_holder,
		
		imp_holder_office,item_acc_code,imp_fy,purpose) values 
		($imp_voucher_id,'$post[txt_voucher_num]','$des','$post[txt_amount_imprest]',
		'$paid_to','$post[txt_imp_num]','$date_of_voucher','$date_of_payment','$imp_holder',
		'$imp_holder_office','$item_acc_code','$fy','$purpose') returning imp_voucher_id
		";



			//echo $qry;
			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}



			//$imp_file = base64_encode(addslashes(file_get_contents($file['data_of_purchase']['tmp_name'])));		

			//		echo "this is that ".$result['data'];
			//prin/t_r($post);

			$imp_voucher_id = $result['data'][0][imp_voucher_id];

			$imp_num = $post[txt_imp_num];


			//echo "<h2 class=bg-primary> this is file $photo</h2>"; 

			//$photo = addslashes(file_get_contents($_FILES['file']['tmp_name']));


			//qry for carosal
			$qry = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where aiv.imp_holder='$_SESSION[user_name]' and aiv.imp_holder_office='$_SESSION[office_code]'
and aiv.voucher_status=1  and aif.imp_file_category='V' order by date_of_payment,upload_time
";




			//qry for carosal




			if (isset($file[supporting_file])) {


				//echo "below is supprting files ";
				//print_r($file[supporting_file]);
				self::transfer_sup_file_to_folder($file, $post, $imp_voucher_id, $imp_num);

				//self::add_supporting_files($post,$file);
				//print_r($post);

			}
			self::transfer_file_to_folder($file, $imp_voucher_id, $imp_num);





			self::show_carosal("id1", $qry);
			//self::show_imprest_cash_book();
			//self::show_noting_form();

			$db->DBcommitTrans();
		} else {
			$msg = "You have already Updated this voucher";
			self::show_alert($msg);
		}
	}

	public static function show_carosal($carosal_id = "id", $qry = "", $sameOfficeOperation = false, $imp_operation = 0)
	{
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);

		$rowForQuick = $row1;


		$num_of_slides = sizeof($row1);


		if ($row1['EOF'] == "1") {

			self::show_alert("No Vouchers to Show", "alert alert-danger");

			return;
			exit;
		}


		?>


		<div id=out_put>

		</div>


		<div class='container'>

			<div class=row>

				<div class='col-sm-6'>
					<div class="bs-callout bs-callout-primary">

						<div id="<?php echo $carosal_id; ?>" class="carousel slide" data-interval="false" data-ride="carousel" style="width: auto;
	   		position: relative;  margin: auto;   bottom: 0;   height: auto; z-index:99">
							<!-- Indicators -->


							<ol class="carousel-indicators">
								<?php

								///////////////////


								////////////////////




								for ($i = 0; $i < $num_of_slides; $i++) {

									if ($i == 0) $cl = "class=active";
									else $cl = "";


									echo "<li data-target=#$carosal_id data-slide-to=$i $cl></li>";
								}

								?>

							</ol>

							<!-- Wrapper for slides -->

							<div class="carousel-inner" role="listbox">




								<?php


								$i = 0;


								foreach ($row1 as $row) {

									if ($i == 0) $cl = "'data-div item active'";
									else $cl = "'data-div item'";


									?>
									<div class=<?php echo $cl; ?> data-voucher-date='<?php echo "$row[date_of_voucher]"; ?>' data-voucher-date-payment='<?php echo "$row[date_of_payment]"; ?>' data-voucher-number='<?php echo "$row[voucher_num]"; ?>' data-voucher-payee='<?php echo "$row[paid_to]"; ?>' data-voucher-amount='<?php echo "$row[amount]"; ?>' data-voucher-acc-head='<?php echo "$row[item_acc_code]"; ?>' data-voucher-description='<?php echo "$row[item_desc]"; ?>' data-voucher-id='<?php echo "$row[imp_voucher_id]"; ?>' data-purpose='<?php echo "$row[purpose]"; ?>' data-voucher_number='<?php
																																																																																																																																																					$voucher_num = $i + 1;

																																																																																																																																																					echo "$voucher_num of $num_of_slides"; ?>'>




										<?php
										//$im = new imagick('file.pdf[0]');
										//$im->setImageFormat('jpg');
										//header('Content-Type: image/jpeg');
										//$row[imp_file]=base64_encode($im);
										?>




										<img src='<?php echo "$row[imp_file]"; ?>' alt="..." width="900" height="345" class='zoom' data-zoom-image='<?php echo "$row[imp_file]"; ?>'>


										<!--  <img src='data:image/png;base64,<?php echo "$row[imp_file]"; ?>' alt="..."  width="900" height="345" >   -->


										<!-- <iframe src='<?php echo "$row[imp_file]"; ?>' alt="..."  width="900" height="345" > </iframe> -->

										<div class="carousel-caption">

											<?php //echo "$row[item_desc]" ;
											?>
										</div>
									</div>
									<?php

									$i++;
								}
								?>
							</div>

							<!-- Controls -->
							<a class="left carousel-control " href="#<?php echo $carosal_id; ?>" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>

							<a class="right carousel-control" href="#<?php echo $carosal_id; ?>" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>

					</div>
				</div>

				<div class='col-sm-6'>


					<div id=div_adjustment_sheet1>





						<button class='btn btn-info fa fa-rotate-right' id=btn_rotate_image>&nbsp;Rotate</button>
						<table class="table table-stripped table-bordered">


							<th colspan=4 class="bg-waning text-center text-primary"> VOUCHER DETAILS

								<span class="label label-warning pull-right" id=lbl_voucher_number></span>

							</th>
							<tr class=" text-info lead">
								<td class="bg-warning text-info lead">Voucher Date</td>
								<td id=td_voucher_date></td>
								<td class="text-info lead bg-warning">Date of payment</td>
								<td id=td_voucher_payment_date></td>
							</tr>


							<tr class="text-info lead">
								<td class="text-info lead bg-warning">Invoice No/Bill No</td>
								<td id=td_voucher_num></td>
								<td class="text-info lead bg-warning">Paid to</td>
								<td id=td_voucher_paid_to></td>
							</tr>


							<tr id=tr_amountx class="text-info lead">
								<td class="bg-warning text-info lead">Amount</td>
								<td id=td_voucher_amount></td>



								<td class="text-info lead bg-warning">Account Head</td>
								<td id=td_voucher_acc_head></td>
							</tr>
							<tr id=tr_desc class="text-info lead">
								<td class="text-info lead bg-warning">Description</td>
								<td colspan=3 id=td_voucher_Desc></td>
							</tr>


							<tbody id=tbody_audit_test>

							</tbody>

							<tbody id=tbody_delete_voucher>

							</tbody>






						</table>
					</div>
				</div>

			</div>

			<?php


			if ($sameOfficeOperation) {
				include_once("./../class/transHeads.class.php");
				global $ttype;
				global $loccode;
				$qry = "select  acc_head,acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 
	
	
			trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";


				$rowS = $db->SelectData($qry);  //shifted the acc account outside the loop for fetching for speed
				//	$rowS="";  //shifted the acc account outside the loop for fetching for speed


				?>

				<!-- <div class=row>
	<div id=div_adjustments_by_other_branch class='col-sm-12' ></div>
	</div>
	<div class=row>
	<div id=div_adjustment_sheet  class='col-sm-12'></div>
	</div> -->


				<div class="panel panel-Primary">
					<!-- Default panel contents -->
					<div class="panel-heading text-center"> VOUCHER ACCOUNTING AND AUDITING </div>
					<div class="panel-body">










						<div class="row" id=quick_editing>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

								<table class="table table-stripped table-bordered">
									<thead>
										<tr>
											<th width='3%' class="text-center bg-primary">sl</th>
											<th width='7%' class="text-center bg-primary">Date</th>
											<th width='40%' class="text-center bg-primary">Particulars</th>
											<th width='50%' colspan=4 class="text-center bg-primary">Adjustments</th>

										</tr>
									</thead>


									<tbody>
										<?php

										//print_r($rowForQuick);
										$sln = 1;

										$imprest_ref_id = "a";
										foreach ($rowForQuick as $r1) {

											//echo "$r1[imprest_num]";

											$imprest_ref_id = $r1[imprest_num];
											echo "<tr class=tr_voucher_new id=$r1[imp_voucher_id]  data-imprest_num=$r1[imprest_num] >";

											echo "<td>$sln</td>";
											echo "<td>$r1[date_of_payment]</td>";
											echo "<td>$r1[item_desc]
	
	<br> <button id=$r1[imp_voucher_id] class='btn btn-info show_voucher'><span class='fa fa-eye'><span>&nbsp;View voucher</button>
	
	
	</td>";


											echo "<td colspan=5>";

											// if($_SESSION[aquired]==1){

											// 	self::adjustmentSheet($r1[imp_voucher_id],$rowS);

											// }
											self::adjustmentSheet($r1[imp_voucher_id], $rowS);
											echo "</td>";

											//echo "<td>$r1[amount]</td>";



											echo "</tr>";
											$sln++;
										}
										?>
										<tr>
											<td colspan=3>Total</td>
											<td id=td_total></td>

										</tr>


									</tbody>

									<tfoot>
										<tr>
											<td colspan=7 class='text-center'>

												<button id=btn_save_adjustments data-imprest_num='<?php echo $imprest_ref_id; ?>' data-imp_operation='<?php echo $imp_operation; ?>' class='btn btn-warning  text-center'>Save All Adjustments</button>

											</td>
										</tr>



									</tfoot>
								</table>

							</div>

						</div>


					<?php

					} ?>
					</td>


					</tr>





					<span style="color:red;">After making corrrections in Amount and account code Click button <b>Save all adjustments"</b> and send to
						next level' .if any item is not admisible put 0 as amount and put reason in comment column . The vouchers shall move from AB to DA/AFO/Fo and then to ARU head

						" </span>

				</div>

				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id=abstract_sheet_carosal>

				</div>

			</div>
		</div>'

		<?php
		if ($_SESSION[previlege] == "Orginating Official" and $_SESSION[branch] == "AB1 Section")

			$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$row[imp_voucher_id] and 
	officer_privillage='$_SESSION[previlege_id]'  ";



		if ($sameOfficeOperation) {
			echo "";
		} else {


			echo "";
		}


		if ($sameOfficeOperation) {
			self::auditBill();
		}
	}



	public static function show_carosal_out_box($carosal_id = "id", $qry = "", $sameOfficeOperation = false)
	{
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);

		$rowForQuick = $row1;

		//print_r($rowForQuick);
		//echo $qry;

		$num_of_slides = sizeof($row1);

		//print_r($row1);

		if ($row1['EOF'] == "1") {

			self::show_alert("No Vouchers to Show", "alert alert-danger");

			return;
			exit;
		}


		?>


		<div id=out_put>

		</div>


		<!--
		<table class="table table-bordered table-stripped">
			<tr>
				<td colspan=1>
		
		
		-->

		<div class='container'>

			<div class=row>

				<div class='col-sm-6'>
					<div class="bs-callout bs-callout-primary">

						<div id="<?php echo $carosal_id; ?>" class="carousel slide" data-interval="false" data-ride="carousel" style="width: auto;
		   		position: relative;  margin: auto;   bottom: 0;   height: auto; z-index:99">
							<!-- Indicators -->


							<ol class="carousel-indicators">
								<?php

								for ($i = 0; $i < $num_of_slides; $i++) {

									if ($i == 0) $cl = "class=active";
									else $cl = "";


									echo "<li data-target=#$carosal_id data-slide-to=$i $cl></li>";
								}

								?>

							</ol>

							<!-- Wrapper for slides -->

							<div class="carousel-inner" role="listbox">




								<?php

								//print_r($row);
								//echo "this is row $row[$i]";
								//for($i=0;$i<$num_of_slides;$i++)

								$i = 0;
								$imprest_id_ref = 0;
								foreach ($row1 as $row) {

									$imprest_id_ref = $row[imprest_num];

									//echo $imprest_id_ref;

									//print_r($row);
									if ($i == 0) $cl = "'data-div item active'";
									else $cl = "'data-div item'";

									//echo "this is row $row[amount]";
									?>
									<div class=<?php echo $cl; ?> data-voucher-date='<?php echo "$row[date_of_voucher]"; ?>' data-voucher-date-payment='<?php echo "$row[date_of_payment]"; ?>' data-voucher-number='<?php echo "$row[voucher_num]"; ?>' data-voucher-payee='<?php echo "$row[paid_to]"; ?>' data-voucher-amount='<?php echo "$row[amount]"; ?>' data-voucher-acc-head='<?php echo "$row[item_acc_code]"; ?>' data-voucher-description='<?php echo "$row[item_desc]"; ?>' data-voucher-id='<?php echo "$row[imp_voucher_id]"; ?>'>




										<?php
										//$im = new imagick('file.pdf[0]');
										//$im->setImageFormat('jpg');
										//header('Content-Type: image/jpeg');
										//$row[imp_file]=base64_encode($im);
										?>





										<img src='<?php echo "$row[imp_file]"; ?>' alt="..." width="900" height="345" class='zoom' data-zoom-image='<?php echo "$row[imp_file]"; ?>'>



										<!--  <img src='data:image/png;base64,<?php echo "$row[imp_file]"; ?>' alt="..."  width="900" height="345" >   -->


										<!-- <iframe src='<?php echo "$row[imp_file]"; ?>' alt="..."  width="900" height="345" > </iframe> -->

										<div class="carousel-caption">

											<?php //echo "$row[item_desc]" ;
											?>
										</div>
									</div>
									<?php

									$i++;
								}
								?>
							</div>

							<!-- Controls -->
							<a class="left carousel-control " href="#<?php echo $carosal_id; ?>" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>

							<a class="right carousel-control" href="#<?php echo $carosal_id; ?>" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>

					</div>
				</div>

				<div class='col-sm-6'>


					<div id=div_adjustment_sheet1>
						<table class="table table-stripped table-bordered">
							<th colspan=4 class="bg-waning text-center text-primary"> VOUCHER DETAILS</th>
							<tr class=" text-info lead">
								<td class="bg-warning text-info lead">Voucher Date</td>
								<td id=td_voucher_date></td>
								<td class="text-info lead bg-warning">Date of payment</td>
								<td id=td_voucher_payment_date></td>
							</tr>


							<tr class="text-info lead">
								<td class="text-info lead bg-warning">Invoice No/Bill No</td>
								<td id=td_voucher_num></td>
								<td class="text-info lead bg-warning">Paid to</td>
								<td id=td_voucher_paid_to></td>
							</tr>


							<tr class="text-info lead">
								<td class="bg-warning text-info lead">Amount</td>
								<td id=td_voucher_amount></td>
								<td class="text-info lead bg-warning">Account Head</td>
								<td id=td_voucher_acc_head></td>
							</tr>
							<tr class="text-info lead">
								<td class="text-info lead bg-warning">Description</td>
								<td colspan=3 id=td_voucher_Desc></td>
							</tr>








						</table>
					</div>
				</div>

			</div>


			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Related Notes</h3>
				</div>
				<div class="panel-body">
					<?php self::getHistory($imprest_id_ref); ?>
				</div>
			</div>
			<?php


			if ($sameOfficeOperation) {
				?>

				<!-- <div class=row>
		<div id=div_adjustments_by_other_branch class='col-sm-12' ></div>
		</div>
		<div class=row>
		<div id=div_adjustment_sheet  class='col-sm-12'></div>
		</div> -->


				<div class="panel panel-Primary">
					<!-- Default panel contents -->
					<div class="panel-heading text-center"> VOUCHER ACCOUNTING AND AUDITING </div>
					<div class="panel-body">












						<div class="row" id=quick_editing>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

								<table class="table table-stripped table-bordered">
									<thead>
										<tr>
											<th width='3%' class="text-center bg-primary">sl</th>
											<th width='7%' class="text-center bg-primary">Date</th>
											<th width='40%' class="text-center bg-primary">Particulars</th>
											<th width='50%' colspan=4 class="text-center bg-primary">Adjustments</th>

										</tr>
									</thead>


									<tbody>
										<?php
										include_once("./../class/transHeads.class.php");
										global $ttype;
										global $loccode;
										$qry = "select  acc_head,acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


		trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";


										$rowS = $db->SelectData($qry);  //shifted the acc account outside the loop for fetching for speed
										//print_r($rowForQuick);
										$sln = 1;
										foreach ($rowForQuick as $r1) {
											echo "<tr class=tr_voucher_new id=$r1[imp_voucher_id]  data-imprest-num=$r1[imprest_num] >";

											echo "<td>$sln</td>";
											echo "<td>$r1[date_of_payment]</td>";
											echo "<td>$r1[item_desc]</td>";


											echo "<td colspan=5>";


											self::adjustmentSheet($r1[imp_voucher_id], $rowS);
											echo "</td>";

											//echo "<td>$r1[amount]</td>";



											echo "</tr>";
											$sln++;
										}
										?>
										<tr>
											<td colspan=3>Total</td>
											<td id=td_total></td>

										</tr>


									</tbody>

									<tfoot>
										<tr>
											<td colspan=7 class='text-center'>

												<button id=btn_save_adjustments class='btn btn-warning  text-center'>Save All Adjustments</button>

											</td>
										</tr>



									</tfoot>
								</table>

							</div>

						</div>


					<?php

					} ?>
					</td>


					</tr>





					<span style="color:red;">After making corrrections in Amount and account code Click button <b>Save all adjustments"</b> and send to
						next level' .if any item is not admisible put 0 as amount and put reason in comment column . The vouchers shall move from AB to DA/AFO/Fo and then to ARU head

						" </span>

				</div>

				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" id=abstract_sheet_carosal_out>

				</div>

			</div>
		</div>'

		<?php
		if ($_SESSION[previlege] == "Orginating Official" and $_SESSION[branch] == "AB1 Section")

			$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$row[imp_voucher_id] and 
		officer_privillage='$_SESSION[previlege_id]'  ";



		if ($sameOfficeOperation) {
			echo "";
		} else {


			echo "";
		}


		if ($sameOfficeOperation) {
			self::auditBill();
		}
	}








	public static function adjustmentSheet($voucher_id, $rowS)
	{
		?>
		<table id='tbl-<?php echo $voucher_id; ?>' class="table table-stripped table-bordered adj">
			<?php
			$db = new DBAccess;

			$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$voucher_id and 
				officer_privillage='$_SESSION[previlege_id]'  ";


			//echo $qry;
			$row = $db->SelectData($qry);
			if ($row[EOF] == 1) {


				if ($_SESSION['previlege_id'] == 1) {
					//originating officer --fetch from ae

					$qry = "select amount as item_amount, item_acc_code from a_imprest_voucher where imp_voucher_id=$voucher_id";
				} else if ($_SESSION['previlege_id'] == 21 or $_SESSION['previlege_id'] == 22 or $_SESSION['previlege_id'] == 23) {
					//verifying  officer fetch from originating officer


					$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$voucher_id and 
				officer_privillage='1' ";
				} else if ($_SESSION[previlege_id] == 3) {
					//passing officer fetch from verifying  officer

					$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$voucher_id and (
				officer_privillage='21' or officer_privillage='22' or officer_privillage='23'  )";
				}
				//echo $qry;
				$row = $db->SelectData($qry);
			}



			if ($row['EOF'] != 1) {

				?>



				<tr>


					<td>Item Amount</th>
						<!--<td>item Description</th> 
				
				
				<td>Item GST Amount</th>
				<td>Item GST Account Code</th>  -->
					<td>Item Account Code</td>
					<!--<td>Admissible</th> -->
					<td>Remarks</td>
					<td><button class="btn btn-success btn-xs add_new_item"><span class="fa fa-plus"></span>&nbsp;</button></td>
					<!-- <td><input class=select type=checkbox> Select </td> -->
				</tr>

				<?php

				$a = 0;







				foreach ($row as $rw1) {


					?>
					<tr class=tr_template>

						<!-- <td><input type=text value="<?php echo $rw1[item_name]; ?>" class="item_name1" ></td> -->
						<td><input type=text value="<?php echo $rw1[item_amount]; ?>" class="item_amount1 form-control text-right"></td>
						<!-- <td><input type=text value="<?php //echo $rw1[item_amount];
															?>" class="item_amount form-control" ></td> -->

						<!-- <td><input type=text class=form-control id=item_desc></td>  
							
									<td><input type=text class=form-control id=item_amount></td>
							
									<td><input type=text class=form-control id=item_gst></td>
					
									-->
						<td>

							<?php

							//echo "item acc code = $rw1[item_acc_code]";

							echo "<select class='item_acc_code1 form-control' data-offfice_id=$_SESSION[office_id] style='max-width:150px'>";
							foreach ($rowS as $rws1) {
								if ($rw1[item_acc_code] == $rws1[acc_code]) $selected = "Selected=selected";
								else $selected = "";

								echo "<option $selected value=$rws1[acc_code] >$rws1[acc_code]-$rws1[acc_head]</option>";
							}
							///imprestN::select($qry,"acc_code","acc_head","item_acc_head","item_acc_head", $rw1[item_acc_code]);
							//
							?>

							<style>
								select {
									width: 100px;
									overflow: hidden;
									white-space: pre;
									text-overflow: ellipsis;
									-webkit-appearance: none;
								}

								option {
									border: solid 1px #DDDDDD;
								}
							</style>

							<?php

							echo "</select >";

							//imprestN::select2key($qry,"acc_code","acc_head","acc_code","item_acc_head","item_acc_head",$rw1[item_acc_code]);

							//print_r($result);
							/////budget control


							$date = "2019-04-01";
							// if($_SESSION[user_name]==1045145){

							// 	$date="2018-04-01";
							// }

							if($_SESSION[aquired]==1){
// print_r($_SESSION);

							}

							if (0) {

								include_once('../class/budget.class.php');

								$bud = new Budget;
								$office_id = $_SESSION[office_id];
								$item_acc_code = $rw1[item_acc_code];
								$bal = $bud->GetBudgetCurrBalance($office_id, $item_acc_code, $date);

								//print_r($bal);

								$budget_amount = $bal[amount];
								$expenditute_till_now = $bal[expamount];

								$balance = $budget_amount - $expenditute_till_now;
								$item_amount = $rw1[item_amount];
								$new_balance = $balance - $item_amount;
								$stop = 0;
								if ($new_balance < 0) {
									$html = "<span class='fa fa-warning' style='color:red' >Balance in this head : $new_balance</span>";
									$stop++;
								} else {
									$html = "<span class='fa fa-check' style='color:green' >Balance Available in this head : $new_balance</span>";
								}

								/// budget control end

							}
							?>

							<div class="div_budget_alert" data-stop_error='<?php echo $stop ?>' name='<?php echo $balance ?>'>
								<?php echo $html; ?>

							</div>



						</td>











						<!--
					<td><label class="switch">
					<input type="checkbox">
					<span class="slider round"></span>
					</label></td>
					-->

						<td><textarea class="item_desc1 form-control"><?php echo $rw1[item_desc]; ?></textarea></td>
						<td><button class="btn btn-xs btn-danger del_new">

								<span class="fa fa-minus fa-lg"></span>&nbsp;



							</button></td>

					</tr>


				<?php
				}
			} else {

				self::show_alert("The Adjsutment was not saved Properly  by the Previous branch.
Return to Previous branch or ask them to delete from out box and redo the Adjustment ");
			}


			?>

			<tr>
				<td></td>
			</tr>




		</table>



	<?php

	}







	public static function auditBill()

	{ ?>










		<table class="table table-bordered table-stripped">


		</table>

	<?php


	}


	public static function getBranchesOfPrivillageInoffice($office_code, $prv)
	{


		$qry = "select b.name as branch,os.branch_id,o.name as office,o.code as office_code from office_setup os
inner join offices o on o.id=os.office_id

inner join branch b on b.id=os.branch_id
where o.code='$office_code' and os.previlege_id=$prv and os.is_live";

		$db = new DBAccess;
		$row = $db->SelectData($qry);
		return $row;
	}
	public static function getPrivillageOfBranchInoffice($office_code, $branch)
	{


		$qry = "select os.previlege_id as prv from office_setup os
inner join offices o on o.id=os.office_id
inner join branch b on b.id=os.branch_id
where o.code='$office_code'  and os.branch_id::int=$branch and os.is_live  ";

		$db = new DBAccess;
		$row = $db->SelectData($qry);


		return $row[0][prv];
	}


	public static function fwd_imprest($to_office, $msg, $imprest_ref_id, $to_branch = 0, $imp_op_id, $inReceiversInBox)
	{



		$to_branch_sms = $to_branch;

		$resposne = array();

		if ($to_office == $_SESSION[higher_office_code]) {
			$to_branch = 1;
		} else {
			//$to_branch=$branch_id; let us c

			//$to_branch=1;
			$nop = 0;
		}





		$imp_operation = 1;
		//getiing imprest office values


		/// lower office to higher office  office to offfice =11

		if ($to_office == $_SESSION[higher_office_code]) {
			$imp_operation = 11;
		} elseif ($to_office == $_SESSION[office_code]) {

			//same office

			$from_branch_prv = self::getPrivillageOfBranchInoffice($_SESSION[office_code], $_SESSION[branch_id]);
			$to_branch_prv = self::getPrivillageOfBranchInoffice($to_office, $to_branch);

			//$imp_operation=11;

			//if same office then check branch


			//orig --> verif

			if ($from_branch_prv == 1 and ($to_branch_prv == 21 or $to_branch_prv == 22 or $to_branch_prv == 23)) {
				$imp_operation = 111;
			}


			//verf --> orig

			if ($to_branch_prv == 1 and ($from_branch_prv == 21 or $from_branch_prv == 22 or $from_branch_prv == 23)) {
				$imp_operation = 112;
			}


			//verf--> pass

			if (($from_branch_prv == 21 or $from_branch_prv == 22 or $from_branch_prv == 23) and  $to_branch_prv == 3) {
				$imp_operation = 113;
			}




			//pass -->verify

			if ($from_branch_prv == 3 and ($to_branch_prv == 21 or $to_branch_prv == 22 or $to_branch_prv == 23)) {
				$imp_operation = 114;
			}



			//pass --> orig



			if ($to_branch_prv == 1 and ($from_branch_prv == 3)) {
				$imp_operation = 115;
			}
		}



		//check inserted

		$qry = "select * from a_imprest_operations where imprest_id_ref='$imprest_ref_id' and
	 from_office='$_SESSION[office_code]' and  to_office='$to_office' and from_branch='$_SESSION[branch_id]' and
	 to_branch='$to_branch' and imp_oprn_msg='$msg' ";

		//echo $qry;



		$t = self::isDataInserted($qry);
		// $t=false;
		//$t=true;


		// 	 echo $t;
		// if ($t==false){

		// 	echo "test false";
		// }
		// if ($t==true){

		// 	echo "test true";
		// }


		if (!$t) {


			$db = new DBAccess;
			$db->DBbeginTrans();
			$qry = "update a_imprest_operations set action_pending=false where imprest_id_ref='$imprest_ref_id' and to_office='$_SESSION[office_code]'
	and to_branch='1'";

			$qry = "update a_imprest_operations set action_pending=false where imprest_op_id=$imp_op_id";

			$date = date("Y-m-d");
			//$date=date("2019-03-25");
			$fy = imprestN::findFinancialYear($date);
			$msg = str_replace("'", "''", $msg);
			//return;
			$result = $db->UpdateData($qry);
			if ($result1['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}


			$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,imp_oprn_msg,imprest_id_ref,imp_fy) values
	
	('$imp_operation','$_SESSION[office_code]','$to_office','$_SESSION[branch_id]','$to_branch','$_SESSION[user_name]','$msg','$imprest_ref_id','$fy'
	
	)returning imprest_op_id ";





			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into imprest operation failed";
				$db->DBrollBackTrans();
				return $result;
			}


			$imprest_op_id = $result['data'][0][imprest_op_id];

			if (!$inReceiversInBox) {
				$qry = "update a_imprest_operations set action_pending=false where imprest_op_id='$imprest_op_id' ";
				$db->UpdateData($qry);
				if ($result['EOF']) {
					$result['adl_msg'] = "Updating imprest operations to false failed";
					$db->DBrollBackTrans();
					return $result;
				}
			}




			//$msg=""

			//$resposne=["alert"=>"Success","html" => $msg];


			$msg = "<div class='alert alert-success'><ul>
		<li><i class='fa fa-check fa-3x'>   Updated Success fully</i></li>
		<li><i class='fa fa-check fa-3x'>   <button class='btn btn-primary' id='btn_view_in_box'><i class='fa-mail fa-3x'></i>
		  Click Here to View Inbox</button></i></li>
		
		
		
		</ul></div>";

			self::show_alert($msg, "alert alert-success");



			$db->DBcommitTrans();




			////////////////////////sms ///////////////////////////
			//$to_branch=$to_branch;

			$office_code_of_imperst_holder1 = split("/", $imprest_ref_id);
			$office_code_of_imperst_holder = $office_code_of_imperst_holder1[1];



			$imperst_holder = $office_code_of_imperst_holder1[0];
			$name_of_employee = self::getEmpNameFromEmpCode($imperst_holder);
			$office_name = self::get_office_name($to_office);

			if ($to_branch == 1) {

				$branch_name = " Head of Office ";
			} else {
				$branch_name = self::getBranchNameFromBranchId($to_branch);
				$receiver = self::getEmployenameOfbranch($to_office, $to_branch);
			}



			//$office_code=$_SESSION[office_code];



			//$desig="AE";
			//$to_branch=1;




			if ($receiver != "") $with = "Your imprest is with $receiver.";
			else $with = "";

			$imperst_holder = $office_code_of_imperst_holder1[0];
			$name_of_employee = self::getEmpNameFromEmpCode($imperst_holder);
			$msg = "Dear $name_of_employee,\nyour imprest has been forwarded to $branch_name of  $office_name.$with";

			if (!$inReceiversInBox) {
				$msg = "Dear $name_of_employee,\nyour Imprest has been passed  Cheque will be issued soon by  $branch_name of  $office_name.$with" . "If you have not received cheque in 2 days,contact ARU immediately";
			}
			self::execute_sms($office_code_of_imperst_holder, $desig, $msg);
			$empcode = $office_code_of_imperst_holder1[0];
			self::execute_sms_personal($empcode, $desig, $msg);
			self::execute_sms_personal(9847599946, $desig, $msg);


			///////////////////////////////////////////////////////

			///  message to receiver ////////////////////////


			$qry = "select user_name,entity_name from vw_office_setup where office_code='$to_office' and  branch_id=$to_branch_sms";
			//echo $qry;
			$row = $db->SelectData($qry);

			if (!isset($row['EOF'])) {
				$row1 = $row[0];

				$empcode = $row1[user_name];
				$to_employee = $row1[entity_name];

				$msg = "Dear $to_employee,\n Imprest of $name_of_employee has been forwarded to you.Kindly check Your imprest software and do the needfull.\n Regards,\n Regional IT Unit Kozhikode ";


				self::execute_sms_personal($empcode, $desig, $msg);
				self::execute_sms_personal('1064767', $desig, $msg);
			}









			/////////////////////////////////////////////////////////////





			///////////////////////////////////////////////////////

		} else {
			self::show_error("Already Updated");
		}
	}


	public static function submit_vouchers($post)
	{




		if ($post[imp_closing] == 1) {
			$v = 'VC';
		} elseif ($post[imp_closing] == 0) {
			$v = 'V';
		}
		//print_r($post);
		$from_office = $_SESSION[office_code];
		$qry = "select * from a_imprest_operations where from_office='$from_office'
		 and imp_operation='18' and imp_oprn_msg='$post[note]'";
		if (!self::isDataInserted($qry)) {

			//$impReqNum="1234";
			$date = date("Y-m-d");
			//$date=date("2019-03-25");

			$imp = self::getImpNumber();
			$fy = imprestN::findFinancialYear($date);
			$impReqNum = $_SESSION[user_name] . "/" . $_SESSION[office_code] . "/$v" . "/" . $fy . "/" . $imp;

			$post[note] = str_replace("'", "''", $post[note]);

			$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,
			to_branch,action_by,imp_oprn_msg,imprest_id_ref,imp_fy,action_pending) values
	
	('18','$_SESSION[office_code]','$_SESSION[higher_office_code]',
	'$_SESSION[branch_id]','1','$_SESSION[user_name]','$post[note]','$impReqNum','$fy','t'
	
	) returning imprest_op_id";
			$db = new DBAccess;
			$db->DBbeginTrans();

			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into imprest operation failed";
				$db->DBrollBackTrans();

				$msg = "insert Into operations failed";
				self::alert("$msg");
				return $result;
			}


			$imprest_op_id = $result['data'][0][imprest_op_id];


			$vouchers = $post[vouchers_json];
			$date = date("Y-m-d");
			//$date=date("2019-03-25");
			$fy = imprestN::findFinancialYear($date);
			$vouchers = str_replace('[', '{', $vouchers);
			$vouchers = str_replace(']', '}', $vouchers);

			// $qry="insert into a_imprest_voucher_mvmt (imprest_op_id,vouchers,imp_fy) values ($imprest_op_id,'$vouchers','$fy')";	
			// 	$result=$db->UpdateData($qry);

			// 	//echo $qry;
			// if($result['EOF'])
			// {	$result['adl_msg']="Insert into amnt. details failed";
			// 	$db->DBrollBackTrans();

			// 	$msg= "insert Into voucher mvmt failed";
			// 	self::alert("$msg");
			// 	return $result;
			// }	


			$voucher_array = json_decode($post[vouchers_json], true);

			//print_r($voucher_array);

			foreach ($voucher_array as $voucher) {
				$qry = "update a_imprest_voucher set voucher_status='2',imprest_num='$impReqNum' where imp_voucher_id=$voucher";
				$result = $db->UpdateData($qry);

				//echo $qry;
				if ($result['EOF']) {
					$result['adl_msg'] = "Insert into amnt. details failed";
					$db->DBrollBackTrans();

					$msg = "updating voucher status to 2 Failed";
					self::alert("$msg");
					return $result;
				}
			}

			//// for cash in hand /////////////////////


			$qry = "update a_imprest_voucher set voucher_status=2,imprest_num='$impReqNum' where voucher_status=1 and imp_holder='$_SESSION[user_name]' and 
imp_holder_office='$_SESSION[office_code]' and type='cash_in_hand'

";

			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();

				$msg = "updating voucher status to 2 Failed";
				self::alert("$msg");
				return $result;
			}

			//echo $qry;


			// new feature for cash book
			$status = 2;


			$opening_balance = $post[opening_cash_in_hand];
			$expenditure = $post[total_expenditure];
			$balance = $post[closing_cash_in_hand];
			$imp_total_in_transit = $post[imp_total_in_transit];
			$qry = "update a_imprest_details set

imprest_ref_id='$impReqNum',
opening_balance=$opening_balance,
expenditure=$expenditure,
imp_total_in_transit=$imp_total_in_transit,
balance=$balance,
status=$status

where 
imp_holder=$_SESSION[user_name] and 
imp_holder_office=$_SESSION[office_code] and
status=1


";
			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				$msg = "updating to imprest details  Failed";
				self::alert("$msg");
				return $result;
				//return $result;
			}




			 /// origin time  ///


			 $qry="insert into a_date_of_imprest_origin (imprest_id_ref) values('$impReqNum')";
			 $result = $db->UpdateData($qry);
			 if ($result['EOF']) {
				 $result['adl_msg'] = "Insert into amnt. details failed";
				 $db->DBrollBackTrans();
				 $msg = "updating to imprest origin failed";
				 self::alert("$msg");
				 return $result;
				 //return $result;
			 }




			//$result=$db->UpdateData($qry);
			//echo "Near commit";

			$db->DBcommitTrans();

			$msg = "<div class='alert alert-success'><ul>
		<li><i class='fa fa-check fa-3x'>   Updated Success fully</i></li>
		<li><i class='fa fa-check fa-3x'>   <button class='btn btn-primary' id='btn_view_in_box'><i class='fa-mail fa-3x'></i>
		  Click Here to View Inbox</button></i></li>
		
		
		
		</ul></div>";

			self::show_alert($msg, "alert alert-success");
		}
	}

	public static function landing_recoupment()
	{


		$isOfficerWithImprestHoldingPower = imprestN::isOfficerWithImprestHoldingPower();

		$mobile = $_POST[mobile];
		//echo "mobile is $mobile";

		if ($isOfficerWithImprestHoldingPower) {

			if ($mobile == 0) {
				// if($_SESSION[user_name]==1064767)
				if (1) {

					$imp_holder = $_SESSION[user_name];
					$imp_holder_office = $_SESSION[office_code];
					$status = 1; // first status =1
					$qry = "select * from a_imprest_details where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and status=1";


					//echo $qry;
					$db = new DBAccess;
					$row = $db->SelectData($qry);

					//check initial settings done
					//$db=new DBAccess;

					if ($row[EOF] == 1) {

						imprestN::show_initial_set_up_for_month();
					} else {
						imprestN::show_recoupment_imprest_form_with_addition();
					}


					//imprestN::show_recoupment_imprest_form_with_addition();

				} else {

					//imprestN::show_recoupment_imprest_form();
					//imprestN::show_recoupment_imprest_form_with_addition();


					if ($_SESSION[user_name] == 1064767) { } else {

						imprestN::show_alert("Imprest request for FY 2019 will open on 24-04-2019");
					}

					//imprestN::show_alert("Will be open on 16 th march");

				}
			} elseif ($mobile == 1) {
				imprestN::show_recoupment_imprest_form_mobile();
			}
			//



		} else {
			$msg = "<i class=\"fa fa-exclamation-triangle fa-3x text-center\" aria-hidden=\"true\"style=\"color:red\">  No Imprest Holding Power</i>";
			imprestN::show_error($msg);
		}
	}


	public static function table_month_year_for_initial_setup($action)
	{
		$month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$mon = 1;

		if ($action == "E") {

			$imp_holder = $_SESSION[user_name];
			$imp_holder_office = $_SESSION[office_code];
			$status = 1; // first status =1
			$qry = "select * from a_imprest_details where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and status=1";


			//echo $qry;
			$db = new DBAccess;
			$row = $db->SelectData($qry);
			$row1 = $row[0];

			$i_month = $row1[i_month];
			$i_year = $row1[i_year];

			$disabled = "disabled=disabled";
		} else {
			$i_month = date(m);
			$disabled = "";
		}

		//echo date(m);
		?>
		<table class='table table-bordered table-stripped'>
			<tr>


			</tr>
			<td>

				<select id=i_month name=i_month <?php echo $disabled; ?> class='form-control'>


					<?php
					foreach ($month_names as $month) {


						if ($mon == $i_month) {
							$selected = "selected=selected";
						} else {
							$selected = "";
						}
						echo "<option  $selected value=$mon>$month</option>";
						$mon++;
					}
					?>


				</select>
			</td>

			<td>

				<select class='form-control' id=i_year>
					<option value=2019 selected=selected>2019</option>
					<option value=2020>2020</option>
				</select>


			</td>

			<tr>

				<td colspan=2 class='text-center'>
					<?php


					if ($action == "E") {

						?>
						<button type="button" id=edit_month_details class="btn btn-warning">Edit Month Details</button>
					<?php
					} else {
						?>

						<button type="button" id=btn_save_month_details class="btn btn-info">Save Month Details</button>

					<?php
					} ?>


				</td>
			</tr>

		</table>
	<?php


	}


	public static function show_initial_set_up_for_month()
	{
		?>



		<div class="row">




			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3">

				<div class="well">



					<div class="alert alert-info">

						<?php echo self::table_month_year_for_initial_setup("I"); ?>


					</div>

				</div>


			</div>


		</div>




	<?php


	}


	public static function submit_vouchers_new($post)
	{


		//print_r($post);





		if ($post[imp_closing] == 1) {
			$v = 'VC';
		} elseif ($post[imp_closing] == 0) {
			$v = 'V';
		}
		//print_r($post);
		$from_office = $_SESSION[office_code];
		$qry = "select * from a_imprest_operations where from_office='$from_office' and imp_operation='18' and imp_oprn_msg='$post[note]'";
		if (!self::isDataInserted($qry)) {

			//$impReqNum="1234";
			$date = date("Y-m-d");
			///	$date=date("2019-03-25");

			$imp = self::getImpNumber();
			$fy = imprestN::findFinancialYear($date);
			$impReqNum = $_SESSION[user_name] . "/" . $_SESSION[office_code] . "/$v" . "/" . $fy . "/" . $imp;
			$post[note] = str_replace("'", "''", $post[note]);


			$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,imp_oprn_msg,imprest_id_ref,imp_fy) values
	
	('18','$_SESSION[office_code]','$_SESSION[higher_office_code]','$_SESSION[branch_id]','1','$_SESSION[user_name]','$post[note]','$impReqNum','$fy'
	
	) returning imprest_op_id";
			$db = new DBAccess;

			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into imprest operation failed";
				$db->DBrollBackTrans();
				return $result;
			}


			$imprest_op_id = $result['data'][0][imprest_op_id];


			$vouchers = $post[vouchers_json];
			$date = date("Y-m-d");
			//$date=date("2019-03-25");
			$fy = imprestN::findFinancialYear($date);
			$vouchers = str_replace('[', '{', $vouchers);
			$vouchers = str_replace(']', '}', $vouchers);

			$qry = "insert into a_imprest_voucher_mvmt (imprest_op_id,vouchers,imp_fy) values ($imprest_op_id,'$vouchers','$fy')";
			$result = $db->UpdateData($qry);

			//echo $qry;
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}


			$voucher_array = json_decode($post[vouchers_json], true);

			//print_r($voucher_array);

			foreach ($voucher_array as $voucher) {
				$qry = "update a_imprest_voucher set voucher_status='2',imprest_num='$impReqNum' where imp_voucher_id=$voucher";
				$result = $db->UpdateData($qry);

				//echo $qry;
				if ($result['EOF']) {
					$result['adl_msg'] = "Insert into amnt. details failed";
					$db->DBrollBackTrans();
					return $result;
				}
			}

			//// for cash in hand /////////////////////


			$qry = "update a_imprest_voucher set voucher_status=2,imprest_num='$impReqNum' where voucher_status=1 and imp_holder='$_SESSION[user_name]' and 
imp_holder_office='$_SESSION[office_code]' and type='cash_in_hand'

";

			//echo $qry;
			$result = $db->UpdateData($qry);


			$db->DBcommitTrans();

			$msg = "<div class='alert alert-success'><ul>
		<li><i class='fa fa-check fa-3x'>   Updated Success fully</i></li>
		<li><i class='fa fa-check fa-3x'>   <button class='btn btn-primary' id='btn_view_in_box'><i class='fa-mail fa-3x'></i>
		  Click Here to View Inbox</button></i></li>
		
		
		
		</ul></div>";

			self::show_alert($msg, "alert alert-success");
		}
	}


	public static function getEmployenameOfbranch($office_code, $branch_id)
	{

		//echo $branch_id;

		if ($branch_id == '1') {
			$qry = "select * from vw_office_setup where  is_head_of_office and office_code='$office_code' and is_live";
			$db = new DBAccess;
			$row1 = $db->SelectData($qry);
			$row = $row1[0];
			//echo $qry;
			//echo $row[entity_name].",".$row[designation];
			return $row[entity_name] . "," . $row[designation] . ',' . $row[office_name];
		} elseif ($branch_id == '') {

			$a = 0;
		} else {

			$qry = "select * from vw_office_setup where branch_id=$branch_id and office_code='$office_code' and is_live";
			$db = new DBAccess;
			$row1 = $db->SelectData($qry);
			$row = $row1[0];
			//echo $qry;
			//echo $row[entity_name].",".$row[designation];
			return $row[entity_name] . "," . $row[designation] . ',' . $row[office_name];
		}
	}


	public static function return_voucher_to_feild($post)
	{


		//echo "is this";
		//print_r($post);
		$imp_operation = $post[imp_operation];
		$imprest_ref_id = $post[imprest_ref_id];
		$msg = $post[msg];
		$to_office = $post[to_office];
		$to_branch = $post[to_branch];


		$from_office = $post[from_office];
		$from_branch = $post[from_branch];
		$inReceiversInBox = $post[inReceiversInBox];

		$date = date("Y-m-d");
		$fy = imprestN::findFinancialYear($date);

		$db = new DBAccess;
		$db->DBbeginTrans();




		//print_r($row);
		//$db=new DBAccess;




		//if($len==0)
		//{

		//$db = new DBAccess;
		//$db->DBbeginTrans();
		//$qry="update a_imprest_operations set action_pending=false where imprest_id_ref='$imprest_ref_id' and to_office='$_SESSION[office_code]'";  old qry


		$qry = "update a_imprest_operations set action_pending=false where imprest_op_id=$post[imp_op_id] ";

		$result = $db->UpdateData($qry);


		//	echo $qry."<br>";
		//	print_r($result);
		if ($result[EOF] == 1) {
			echo "update operation failed";
			$db->DBrollBackTrans();
			return $result;
		}




		/// qry bloc to prevent duplications
		$msg = str_replace("'", "''", $msg);
		$qry = "select * from a_imprest_operations where
		 imprest_id_ref='$imprest_ref_id'
	 and from_office='$_SESSION[office_code]' and
		from_branch='$_SESSION[branch_id]' and
		to_office='$to_office' and
		to_branch='$to_branch'
		and imp_oprn_msg='$msg' ";
		//echo $qry."<br>";
		$row = $db->SelectData($qry);

		if ($row[EOF] == 1) {



			$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,imp_oprn_msg,imprest_id_ref,imp_fy) values
	
	('$imp_operation','$_SESSION[office_code]','$to_office','$_SESSION[branch_id]','$to_branch','$_SESSION[user_name]','$msg','$imprest_ref_id','$fy'
	
	) returning imprest_op_id ";

			//echo $qry;
			//echo $qry."<br>";
			$result = $db->UpdateDataAndReturn($qry);
			if ($result[EOF] == 1) {
				echo "insert into imprest operations failed";
				$db->DBrollBackTrans();
				return $result;
			}

			//echo "near commit";
			$db->DBcommitTrans();
			$office_name = self::get_office_name($to_office);
			//self::show_success("Submited to $office_name successfully ");

			$msg = "<div class='alert alert-success'><ul>
		<li><i class='fa fa-check fa-3x'>   Updated Success fully</i></li>
		<li><i class='fa fa-check fa-3x'>   <button class='btn btn-primary' id='btn_view_in_box'><i class='fa-mail fa-3x'></i>
		  Click Here to View Inbox</button></i></li>
		
		

		
		</ul></div>";

			self::show_alert($msg, "alert alert-success");
		} else {

			self::show_alert("<span class='fa fa-exclamation-triangle'>
			</span>&nbsp;This operation is already done. check out box 
			and verify that this is not a Duplication. If its not duplication, change the remarks and try");
			$db->DBrollBackTrans();

			return;
		}



		$imprest_op_id = $result['data'][0][imprest_op_id];
		$vouchers = $post[vouchers_json];
		$vouchers = str_replace('[', '{', $vouchers);
		$vouchers = str_replace(']', '}', $vouchers);




		//echo "near commit"	;



		////////////////////////sms ///////////////////////////
		//$to_branch=$to_branch;

		$office_code_of_imperst_holder1 = split("/", $imprest_ref_id);
		$office_code_of_imperst_holder = $office_code_of_imperst_holder1[1];

		$office_name = self::get_office_name($to_office);
		$branch_name = self::getBranchNameFromBranchId($to_branch);





		$receiver = self::getEmployenameOfbranch($from_office, $from_branch);
		$with = "$receiver";



		$imperst_holder = $office_code_of_imperst_holder1[0];
		$name_of_employee = self::getEmpNameFromEmpCode($imperst_holder);
		$msg = "Dear $name_of_employee,\n your Imprest Has been Returned to You by  $office_name.$with.\nPlease check your Imprest Inbox and do the Needful";

		self::execute_sms($office_code_of_imperst_holder, $desig, $msg);
		$empcode = $office_code_of_imperst_holder1[0];
		self::execute_sms_personal($empcode, $desig, $msg);



		///////////////////////////////////////////////////////







	}


	public static function update_settings($attrib, $object, $value)
	{

		// check whether updated

		$qry1 = "select * from a_imp_setttings where object='$object' and attrib=$attrib";

		$db = new DBAccess;



		//echo $qry1;
		$row = $db->SelectData($qry1);
		if ($row[EOF] == 1) {


			$qryInsert = "insert into a_imp_settings ('attrib','object','value') values ('$attrib','$object','$value') ";



			$result = $db->UpdateData($qryInsert);

			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into cug failed";
				$result['err'] = $result['err'] + 1;

				$result = "notok";
				$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
				$html = imprestN::show_alert1("$i <br>Update settings failed", "alert alert-danger");

				$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
				echo json_encode($response);
			} else {

				$result = "ok";
				$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
				$html = imprestN::show_alert1("$i <br>Updated settings successfully", "alert alert-success");


				$html = $html;


				$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
				echo json_encode($response);
			}
		} else {
			//updating new settings 




			$qryUpdate = "update  a_imp_settings set value='$value' where  attrib='$attrib' and  object='$object' ";



			$result = $db->UpdateData($qryUpdate);

			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into cug failed";
				$result['err'] = $result['err'] + 1;

				$result = "notok";
				$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
				$html = imprestN::show_alert1("$i <br>Update settings failed", "alert alert-danger");

				$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
				echo json_encode($response);
			} else {

				$result = "ok";
				$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
				$html = imprestN::show_alert1("$i <br>Updated settings successfully", "alert alert-success");


				$html = $html;


				$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
				echo json_encode($response);
			}
		}
	}


	public static function is_already_forwarded($post)
	{

		$imprest_ref_id = $post[imprest_ref_id];
		$msg = $post[msg];
		$to_office = $post[to_office];
		$inReceiversInBox = $_POST[inReceiversInBox];



		if ($to_office == $_SESSION[higher_office_code]);
	}


	public static function fwd_vouchers($post)
	{

		//print_r($post);

		$to_office = $post[to_office];
		if (!isset($_POST[branch_id])) {
			if ($to_office == $_SESSION[higher_office_code]) {

				$to_branch = 1;
			}
		} else {
			if ($_POST[branch_id] == "") {
				$to_branch = 1;
			} else {

				$to_branch = $_POST[branch_id];
			}
		}



		$imprest_ref_id = $post[imprest_ref_id];
		$msg = $post[msg];
		$msg = str_replace("'", "''", $msg);

		$today = date("d/m/Y");

		$msg = $msg . '' . $today;
		$to_office = $post[to_office];
		$inReceiversInBox = $_POST[inReceiversInBox];

		/*$qry="select * from a_imprest_operations where imprest_id_ref='$imprest_ref_id' and
	from_office='$_SESSION[office_code]' and  to_office='$to_office' and from_branch='$_SESSION[branch_id]' and
	to_branch='$to_branch' and imp_oprn_msg='$msg' ";
	*/
		///// new function to check duplication
		//$qry="select * from a_imprest_operations where imprest_id_ref='$imprest_ref_id' and imprest_op_id>$post[imp_op_id] order by 1  limit 1";
		//echo $qry;




		//exit;
		$db = new DBAccess;
		$db->DBbeginTrans();

		$qry = "select * from a_imprest_operations where imprest_id_ref='$imprest_ref_id'
 and from_office='$_SESSION[office_code]' and
	from_branch='$_SESSION[branch_id]' and
	to_office='$to_office' and
	to_branch='$to_branch'
	and imp_oprn_msg='$msg' ";


		$qry = "select * from a_imprest_operations where imprest_id_ref='$imprest_ref_id'
 and from_office='$_SESSION[office_code]' and
	from_branch='$_SESSION[branch_id]' and
	to_office='$to_office' and
	to_branch='$to_branch'
	and imp_oprn_msg='$msg'
	";


		//echo $qry;
		//return;



		$row = $db->SelectData($qry);

		//print_r($row);
		if ($row['EOF'] != 1)
		//if()

		{
			self::show_alert("<br>This operation is already done. If not sure please check the out box and verify. If you still wanted to do this operation Delete the previous operation done on this imprest and Retry ", "alert alert-danger");
			$db->DBrollBackTrans();
			return false;
		} else {








			if ($post[imp_operation] == '999' or isset($post[set_operation])) {
				//getting imp operation directly

				//print_r($post);

				self::return_voucher_to_feild($post);
				$db->DBcommitTrans();

				return;
			} else {
				// for finding imprest operation status --> if in same office 

				// 191= forwarded vouchers to originating officer

				//193 forwawrded vouchers to passing officer 
				if ($to_office == $_SESSION[office_code]) {

					// if same office

					if ($_SESSION[previlege_id] == 3) // and to branch privillage is 1
					{
						$imp_operation = 191;   //192 forwarded vocuers to passing officer

					}
					if ($_SESSION[previlege_id] == 21 or $_SESSION[previlege_id] == 22 or $_SESSION[previlege_id] == 23) // and to branch privillage is 3
					{
						$imp_operation = 193;   //192 forwarded vocuers to passing officer

					}
					if ($_SESSION[previlege_id] == 1) // and to branch privillage is 22 or 23 or 21
					{
						$imp_operation = 192;   //192 forwarded vocuers to verifying officer

					}
				} elseif ($to_office == $_SESSION[higher_office_code]) {
					$imp_operation = 19;  ///imprest forwarded to higher office
				} else {
					$imp_operation = 91;  ///imprest returned to lower office 	}

				}



				if ($inReceiversInBox == 0) {
					//final passing of bill
					$imp_operation = 200;
				}


				/// if ip operation is set from post  overrding calculation of imp_operation

				if($_SESSION[aquired]==1){
					if (isset($post[imp_operation])){
						$imp_operation = $post[imp_operation];
	
					}

				}
				






				if ($_SESSION[previlege_id] == 3) {
					$cond = "and  ( to_branch='$_SESSION[branch_id]' or to_branch='1')";
				} else {
					$cond = "and to_branch='$_SESSION[branch_id]'";
				}

				if ($to_office == $_SESSION[office_code]) {

					// if same office

					$qry = "select unnest(vouchers) as vouchers from  a_imprest_operations 
 aio inner join a_imprest_voucher_mvmt aivm on aivm.imprest_op_id=aio.imprest_op_id
 and to_office::int=$_SESSION[office_code]  $cond ";
				} else {			//different office 

					//check if all vouchers has been selected for forwarding
					$qry = "select unnest(vouchers) as vouchers from  a_imprest_operations 
 aio inner join a_imprest_voucher_mvmt aivm on aivm.imprest_op_id=aio.imprest_op_id
 and to_office::int=$_SESSION[office_code]";
				}

				//$vouchers_received1=$db->SelectData($qry);
				// if($vouchers_received1['EOF'])
				// {	
				// 	$db->DBrollBackTrans();
				// 	echo "rollback at vouchers received". $vouchers_received1;
				// 	return $result;
				// }

				//$vouchers_received=array_column($vouchers_received1,'vouchers');	
				$vouchers_forwarding = json_decode($post[vouchers_json], true);
				//$vouchers_pending=array_diff($vouchers_received,$vouchers_forwarding);

				/*echo "<br>";
print_r($vouchers_received);
 echo "<br>";
print_r($vouchers_forwarding);echo "<br>";
print_r($vouchers_pending);echo "<br>";
*/
				//$len=sizeof($vouchers_pending);	



				//if($len==0)
				//{


				//$qry="update a_imprest_operations set action_pending=false where imprest_id_ref='$imprest_ref_id' and to_office='$_SESSION[office_code]'";  old qry
				$qry = "update a_imprest_operations set action_pending='f' where imprest_op_id='$post[imp_op_id]' ";

				//echo $qry;

				//return;
				$row = $db->UpdateData($qry);
				if ($row['EOF']) {
					$db->DBrollBackTrans();
					echo "rollback at set action pending false";

					//print_r($row);
					return $row;
				}



				//}

				if ($to_office == $_SESSION[higher_office_code]) {
					//	self::execute_sms_personal(1064767,"","Executed before  for landing from $_SESSION[office_name] of loc code $_SESSION[loc_code]");

					////// fetching higher office landing branch  if higher office  code is aru
					if ($to_office == $_SESSION[aru_code]) {
						//attrib 1= set landing page of imprest voucher
						//$qrys="select value from a_imp_settings where attrib=1 and object='$_SESSION[aru_code]'";
						$qrylanding = "select * from a_imprest_landing where to_office='$_SESSION[aru_code]'
					
					and from_office='$_SESSION[office_code]'
					
					";


						//echo $qry1;
						$rows = $db->SelectData($qrylanding);
						if ($rows[EOF] == 1) {

							$to_branch = 1;
						} else {

							//self::execute_sms_personal(1064767,"","Executed New setting for landing from $_SESSION[office_name] of loc code $_SESSION[loc_code]");
							//self::execute_sms_personal(1064767,"","$qrylanding");
							//new code need to be added

							$row1 = $rows[0];
							$to_branch = $row1[to_branch];

							$imp_operation = $row1[imp_operation];; /// setting imprest operation to 191

						}
					} else {

						$to_branch = 1;
					}
				} else {
					//$to_branch=$branch_id; let us c

					$to_branch = $post[branch_id];
				}


				//$date=date("2019-03-31");
				$date = date("Y-m-d");
				//$date=date("2019-03-25");
				$msg = str_replace("'", "''", $msg);

				$fy = imprestN::findFinancialYear($date);



				if ($inReceiversInBox == 0) {
					$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,
				imp_oprn_msg,imprest_id_ref,action_pending,imp_fy) values
	
	('$imp_operation','$_SESSION[office_code]','$to_office','$_SESSION[branch_id]','$to_branch','$_SESSION[user_name]',
	'$msg','$imprest_ref_id',false,'$fy'
	
	) returning imprest_op_id ";
				} else {
					$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,imp_oprn_msg,imprest_id_ref,imp_fy) values
	
	('$imp_operation','$_SESSION[office_code]','$to_office','$_SESSION[branch_id]','$to_branch','$_SESSION[user_name]','$msg','$imprest_ref_id','$fy'
	
	) returning imprest_op_id ";
				}


				//	echo "<br>";
				//	echo $qry;

				//return;


				$result1 = $db->UpdateDataAndReturn($qry);
				if ($result1['EOF']) {
					$result['adl_msg'] = "Insert into amnt. details failed";
					$db->DBrollBackTrans();
					echo "rollback at insert into into imprest operatons";
					return $result1;
				}



				$imprest_op_id = $result1['data'][0][imprest_op_id];


				$vouchers = $post[vouchers_json];

				$vouchers = str_replace('[', '{', $vouchers);
				$vouchers = str_replace(']', '}', $vouchers);

				$date = date("Y-m-d");
				//$date=date("2019-03-25");
				$fy = imprestN::findFinancialYear($date);

				$qry = "insert into a_imprest_voucher_mvmt (imprest_op_id,vouchers,imp_fy) values ($imprest_op_id,'$vouchers','$fy')";
				$result = $db->UpdateData($qry);



				if ($result['EOF']) {
					$result['adl_msg'] = "Insert into amnt. details failed";
					$db->DBrollBackTrans();
					echo "rollback at insert into into voucher mvmt" . $row;
					return $result;
				}

				/*
		if($inReceiversInBox)
		{
			$qry="update a_imprest_operations set action_pending=false where imprest_op_id='$imprest_op_id' ";
			$db->UpdateData($qry);
			if($result['EOF'])
				{	$result['adl_msg']="Updating imprest operations to false failed";
					$db->DBrollBackTrans();
					return $result;
				}
			
		}
		*/





				$db->DBcommitTrans();


				////////////////////////sms ///////////////////////////
				//$to_branch=$to_branch;

				$office_code_of_imperst_holder1 = split("/", $imprest_ref_id);
				$office_code_of_imperst_holder = $office_code_of_imperst_holder1[1];

				$office_name = self::get_office_name($to_office);
				$branch_name = self::getBranchNameFromBranchId($to_branch);

				//echo $imprest_ref_id;
				///echo  $branch_name;

				//echo "To branch $to_branch";

				//$office_code=$_SESSION[office_code];

				// if($branch_name=="") $branch_name=" Head of Office ";


				if ($to_branch == 1) {
					$row1 = self::getHeadOfofficeDetails($to_office);

					$row = $row1[0];

					$branch_name = $row[branch];

					$receiver = $row[entity_name] . "," . $row[designation];

					$with = "Your Imprest is with $receiver";
				} else {
					$receiver = self::getEmployenameOfbranch($to_office, $to_branch);
					$with = "Your Imprest is with $receiver";
				}
				//$desig="AE";
				//$to_branch=1;

				$imperst_holder = $office_code_of_imperst_holder1[0];
				$name_of_employee = self::getEmpNameFromEmpCode($imperst_holder);
				$msg = "Dear $name_of_employee,Your imprest has been forwarded to $branch_name of  $office_name.$with";

				if ($imp_operation == 200) {
					$msg = "Dear $name_of_employee,
	your imprest has been passed . Cheque will be issued soon by  $branch_name of  $office_name.";
					//self::execute_sms($office_code_of_imperst_holder, $desig, $msg);
					$empcode = $office_code_of_imperst_holder1[0];
					self::execute_sms_personal($empcode, $desig, $msg);
				} else {
					//self::execute_sms($office_code_of_imperst_holder, $desig, $msg);
					$empcode = $office_code_of_imperst_holder1[0];
					self::execute_sms_personal($empcode, $desig, $msg);
				}


				/////////sms to receiver /////////////////////////////////////


				///  message to receiver ////////////////////////

				if ($to_branch == 1) {
					$qry = "select user_name,entity_name,branch,office_name from vw_office_setup where office_code='$to_office' and  is_head_of_office and is_live";
				} else {

					$qry = "select user_name,entity_name,branch,office_name from vw_office_setup where office_code='$to_office' and  branch_id='$to_branch'";
				}


				$row = $db->SelectData($qry);

				//if(!isset($row['EOF']))
				if ($imp_operation != 200) {
					$row1 = $row[0];

					$empcode = $row1[user_name];
					$to_employee = $row1[entity_name];
					$to_branch_name_sms = $row1[branch];
					$to_ofc_name_sms = $row1[office_name];

					$msg = "Dear $to_employee,\nImprest Vouchers of $name_of_employee has been forwarded to you .Kindly check your imprest software for the role of $to_branch_name_sms,$to_ofc_name_sms and do the needfull.\nRegards,\nRegional It Unit Kozhikode ";


					self::execute_sms_personal($empcode, $desig, $msg);
					//self::execute_sms_personal('1064767',$desig,$msg.$empcode);
					//self::execute_sms_personal('1064767',$desig,$qry);


				}




				//////////////////////////////////////////////////////


				///////////////////////////////////////////////////////



				$office_name = self::get_office_name($to_office);
				//self::show_success("Submited to $office_name successfully ");

				$msg = "<div class='alert alert-success'><ul>
		<li><i class='fa fa-check fa-3x'>   Updated Success fully</i></li>
		<li><i class='fa fa-check fa-3x'>   <button class='btn btn-primary' id='btn_view_in_box'><i class='fa-mail fa-3x'></i>
		  Click Here to View Inbox</button></i></li>
		
		
		
		</ul></div>";

				self::show_alert($msg, "alert alert-success");
			}
		} //case of not inserted ends here

	}

	public static function getHeadOfofficeDetails($office_code)
	{

		$qry = "select * from vw_office_setup where is_head_of_office='t' and office_code='$office_code'and is_live";

		$db = new DBAccess;
		$row = $db->SelectData($qry);

		return $row;
	}



	public static function yymmddToddmmyy($date)
	{
		return implode('/', array_reverse(explode('-', $date)));
	}

	public static function datePicker($id = "", $name = "name", $value = "", $class = "form-control", $disabled = "")
	{


		//$date=transaction::yyddmmToDDMMYY_slash($value);
		$res = "
	
	
	<script src=\"../bootstrap/bootstrap-datepicker.js\"></script>
	 <link href=\"../bootstrap/bootstrap-datepicker.css\" rel=\"stylesheet\" type=\"text/css\">
	
	 
	 
	 
	 
<script type=\"text/javascript\">
	
	
	
$(document.body).on('focus', \"#" . $id . "\" ,function(){ $(this).datepicker(
	
	{
        format: \"dd/mm/yyyy\",
        todayBtn: true,
        clearBtn: true,
        daysOfWeekHighlighted: \"0,6\",
         autoclose: true
    }	
	
	);});
</script>
<input  data-date-end-date='0d' type=text class=$class  id=$id  name=$name value=$value $disabled>
	";

		return $res;
	}
	public static function datePicker_max($id = "", $name = "name", $value = "", $class = "form-control", $max, $disabled1 = "")
	{


		//$date=transaction::yyddmmToDDMMYY_slash($value);
		$res = "
	
	
	
	
	script src=\"../bootstrap/bootstrap-datepicker.js\"></script>
	<link href=\"../bootstrap/bootstrap-datepicker.css\" rel=\"stylesheet\" type=\"text/css\">
	 
	 
	 
<script type=\"text/javascript\">
var currentTime = new Date($max);
// First Date Of the month 
var startDateFrom = new Date(currentTime.getFullYear(),currentTime.getMonth(),1);
// Last Date Of the Month 
var startDateTo = new Date(currentTime.getFullYear(),currentTime.getMonth() +1,0);

	
$(document.body).on('focus', \"#" . $id . "\" ,function(){ $(this).datepicker(
	
	{
        format: \"dd/mm/yyyy\",
        todayBtn: true,
        clearBtn: true,
        daysOfWeekHighlighted: \"0,6\",
		 autoclose: true,
		 minDate: startDateFrom,
    maxDate: startDateTo
    }	
	
	);});
</script>
<input  data-date-end-date='0d' type=text class=$class  id=$id  name=$name value=$value $disabled1>
	";

		return $res;
	}


	public static function select_imprest_type()

	{ ?>

		<div class=row>
			<div class="col-sm-8 col-sm-offset-2">



				<div align="center1" class="well" style="text-align:center">
					<label> <b class="text-info">
							<h5>Select imprest type :</h5></label>
					<h5>
						<select id=sel_imprest_type>
							<option value=0>Select</option>
							<option value=Permanant>Permanent</option>
							<!--<option value=Temporary>Temperory</option>  -->
						</select>
					</h5>
				</div>
			</div>
		</div>

		<div class=row>
			<div class="col-sm-10 col-sm-offset-1">
				<div id=div_permanant></div>
				<div id=div_temporary></div>

			</div>
		</div>








	<?php
	}

	public static function GetSections($name)
	{
		global $loccode;
		$length = strlen($maincode);
		//session_start();
		if ($loccode == 323) {
			$strQry = "select distinct(branch_id),branch from vw_office_setup where branch_id<>" . $_SESSION['branch_id'] . "
                       	and loc_code(id)=" . $loccode . " and appln=" . $_SESSION['appln'] . " 
			and office_id=" . $_SESSION['office_id'] . " and is_live=true order by branch";
		} else {



			//$strQry="select distinct(branch_id),branch from vw_office_setup where branch_id<>".$_SESSION['branch_id']." 
			//and loc_code(id)=".$loccode." and is_live=true order by branch";

			$strQry = "select distinct(branch_id),branch from vw_office_setup where branch_id<>" . $_SESSION['branch_id'] . " 
			and loc_code=" . $loccode . " and appln=" . $_SESSION['appln'] . " and is_live=true order by branch";
		}
		//	echo "qqqqqqqqqq".$strQry;	
		$DB = new DBAccess();

		$result = $DB->SelectData($strQry);
		//return $result;

		if ($result[EOF] == 1) {
			imprestN::alert_failed("Please give Imprest roles to  to All officers in ARU involved in Imprest");
			return;
		}

		echo "<select class=form-control name=$name id=sel_branch_sel>";

		echo "<option value=0>Select</option>";
		foreach ($result as $row1)
			echo "<option value=$row1[branch_id]>$row1[branch]</option>";
		echo "</select>";
	}


	public static function select_from_office($defaut = "", $disabled = "")
	{

		$qry = "select * from offices where higher_office_id='$_SESSION[office_code]'";
		$db = new DBAccess;
		$row = $db->SelectData($qry);
		if ($row[EOF] == 1) {
			imprestN::alert_failed("No Data");
			return;
		}
		echo "<select $disabled class='from_office_landing form-control'>";
		foreach ($row as $r) {


			if ($r[code] == $defaut) {

				$selected = "selected=selected";
			} else {
				$selected = "";
			}
			echo "<option $selected value=$r[code]>$r[name]</option>";
		}
		echo "</select>";
	}

	public static function GetSectionsPrivillage($name, $requiredPrivillage)
	{
		global $loccode;
		// print_r($_SESSION);
		// echo "required privillage $requiredPrivillage";
		$trans_type = 104;
		if ($requiredPrivillage == 2) {
			$cond = 'and (previlege_id= \'21\' or previlege_id= \'22\' or previlege_id= \'23\') ';
		} else {
			$cond = 'and previlege_id=\'' . $requiredPrivillage . '\'';
		}


		$qry = "select distinct(branch_id),branch from vw_office_setup where branch_id<>$_SESSION[branch_id]
			and loc_code=$_SESSION[location_code] and appln=$_SESSION[appln]  and is_live=true and
			
			
			branch_id in( 
		
		
				select branch_id from role_assoc where office_id=$_SESSION[office_id] and 
				submenu_id=(
					select id from sub_menu where trans_type=$trans_type and   branch_id<>$_SESSION[branch_id] )
					$cond  ) order by branch  
			
			";
		//echo $qry;
		$DB = new DBAccess();

		$result = $DB->SelectData($qry);
		//return $result;

		if ($result[EOF] == 1) {
			imprestN::alert_failed("Please give Imprest roles to Receiving officer 
			 in SARAS for  forwarding this imprest");
			return;
		}

		echo "<select class=form-control name=$name id=sel_branch_sel>";

		echo "<option value=0>Select</option>";
		foreach ($result as $row1)
			echo "<option value=$row1[branch_id]>$row1[branch]</option>";
		echo "</select>";
	}





	public static function GetSectionsTransType($trans_type = 104, $requiredPrivillage, $disabled)
	{	//global $loccode;
		// $length = strlen($maincode);
		// //session_start();
		// if($loccode==323)
		// {
		//            $strQry="select distinct(branch_id),branch from vw_office_setup where branch_id<>".$_SESSION['branch_id']."
		//                	and loc_code(id)=".$loccode." and appln=".$_SESSION['appln']." 
		// 	and office_id=".$_SESSION['office_id']." and is_live=true order by branch";

		// }
		// else
		// {



		//$strQry="select distinct(branch_id),branch from vw_office_setup where branch_id<>".$_SESSION['branch_id']." 
		//and loc_code(id)=".$loccode." and is_live=true order by branch";

		if ($requiredPrivillage == 2) {
			$previlege_id = 'and (privilege_id= 21 or privilege_id= 22 or privilege_id= 23 ';
		} else {
			$previlege_id = 'and privilege_id= previlege_id';
		}


		$qry = "select distinct(branch_id),branch from vw_office_setup where branch_id<>$_SESSION[branch_id]
	and loc_code=$_SESSION[location_code] and appln=$_SESSION[appln]  and is_live=true and
	
	
	branch_id in( 


		select branch_id from role_assoc where office_id=$_SESSION[office_id] and 
		submenu_id=(
			select id from sub_menu where trans_type=$trans_type and   branch_id<>$_SESSION[branch_id] )
			  ) order by branch  $previlege_id
	
	";





		//	}
		//	echo "qqqqqqqqqq".$strQry;

		//echo $qry;
		$DB = new DBAccess();

		$result = $DB->SelectData($qry);
		//return $result;
		$result = $DB->SelectData($qry);
		//return $result;
		if ($result == 1) {
			imprestN::alert_failed("Please give Imprest roles to  to All officers in ARU involved in Imprest");
			return;
		}

		//print_r($result);
		echo "<select class='form-control to_branch_landing' $disabled >";

		echo "<option value=0>Select</option>";
		foreach ($result as $row1) {
			//if($row1[branch_id]==$branch_id) $selected="selected=selected"; else $selected="";
			//	echo "<option $selected  value=$row1[branch_id]>$row1[branch]</option>";
			echo "<option  value=$row1[branch_id]>$row1[branch]</option>";
		}



		echo "</select>";
	}
	public static function GetSectionsTransTypeWithPrivillage($cmbsec = "cmbsec", $trans_type = 104, $privillage_id, $disabled)
	{
		global $loccode;
		$length = strlen($maincode);
		//session_start();


		switch ($privillage_id) {

			case 1:


				$cond = "and (privillage_id=22 or privillage_id=23 or privillage_id=21)";
				//$to_branch_priv=

				break;
			case 21:
			case 22:
			case 23:
				$cond = " and privillage_id=3";
				break;
			case 3:
				$cond = "and privillage_id=1";
				break;

			default:

				$cond = "";
				break;
		}


		if ($loccode == 0) {
			$strQry = "select distinct(branch_id),branch from vw_office_setup where branch_id<>" . $_SESSION['branch_id'] . "
                       	and loc_code(id)=" . $loccode . " and appln=" . $_SESSION['appln'] . " 
			and office_id=" . $_SESSION['office_id'] . " and is_live=true $cond order by branch";
		} else {



			//$strQry="select distinct(branch_id),branch from vw_office_setup where branch_id<>".$_SESSION['branch_id']." 
			//and loc_code(id)=".$loccode." and is_live=true order by branch";


			$qry = "select distinct(branch_id),branch from vw_office_setup where branch_id<>$_SESSION[branch_id]
	and loc_code=$loccode and appln=$_SESSION[appln]  and is_live=true and branch_id in(
		select branch_id from role_assoc where office_id=$_SESSION[office_id] and 
		submenu_id=(select id from sub_menu where trans_type=$trans_type) and 
		 branch_id<>$_SESSION[branch_id] $cond order by branch
	
	";
		}

		echo $qry;
		//	echo "qqqqqqqqqq".$strQry;	
		$DB = new DBAccess();

		$result = $DB->SelectData($strQry);
		//return $result;

		echo "<select class='form-control to_branch_landing' $disabled >";

		echo "<option value=0>Select</option>";
		foreach ($result as $row1) {
			//if($row1[branch_id]==$branch_id) $selected="selected=selected"; else $selected="";
			echo "<option $selected  value=$row1[branch_id]>$row1[branch]</option>";
		}



		echo "</select>";
	}


	public static function imp_holder_details($empcode, $loccode)

	{
		$qry = "select substr(eet.ee_id::text,4,20)
 as id, upper(e.name) || 
 case
  when 
 split_part(eet.unique_code,'-',4)::int=0 then '' else ' -in-charge ' end as name,
 
 o.id as office_id,o.name as 
  office_name,e.id as entity_id from 
 entities e inner join entity_entitytype
  eet   on eet.entity_id=e.id

inner join offices o on
o.code=split_part(unique_code,'-',1)

   where entitytype_id=12 

  and split_part(unique_code,'-',2)='$empcode'
and eet.is_live and loc_code=$loccode";

		//echo $qry;
		$db = new DBAccess;
		$row = $db->SelectData($qry);

		return $row;
	}




	public static function imp_holder_details_with_office($empcode, $loccode, $office_code)

	{
		$qry = "select substr(eet.ee_id::text,4,20)
 as id, upper(e.name) || 
 case
  when 
 split_part(eet.unique_code,'-',4)::int=0 then '' else ' -in-charge ' end as name,
 
 o.id as office_id,o.name as 
  office_name,e.id as entity_id from 
 entities e inner join entity_entitytype
  eet   on eet.entity_id=e.id

inner join offices o on
o.code=split_part(unique_code,'-',1)

   where entitytype_id=12 

  and split_part(unique_code,'-',2)='$empcode'
and eet.is_live and loc_code=$loccode

and split_part(unique_code,'-',1)= '$office_code'

";

		//echo $qry;
		$db = new DBAccess;
		$row = $db->SelectData($qry);

		//print_r($row);

		return $row;
	}



	public static function get_office_name($code)

	{

		$qry = "select * from offices where code='$code'";
		//echo $qry;
		$db = new DBAccess;
		$row = $db->SelectData($qry);

		return $row[0][name];
	}


	public static function show_office_particulars_as_heading($office_code = -1)
	{
		$sql = "SELECT * from offices where code='$office_code' ";
		$db = new DBAccess;
		$row = $db->SelectData($sql);
		$row1 = $row[0];

		$officeDetails = $row;

		$telNo = ((!empty($officeDetails[0]['tele_nos'])) && ($officeDetails[0]['tele_nos'] <> 'NIL')) ? "Tel #:" . $officeDetails[0]['tele_nos'] : '';
		$address = ((!empty($officeDetails[0]['corr_address'])) && ($officeDetails[0]['corr_address'] <> 'NIL')) ? $officeDetails[0]['corr_address'] : '';
		$email = ((!empty($officeDetails[0]['email'])) && ($officeDetails[0]['email'] <> 'NIL')) ? $officeDetails[0]['email'] : '';
		$isocertified = (in_array($_SESSION['office_code'], array(3052))) ? '(ISO 9001:2015 Certified)' : '';
		$isocertified = "<p style=\"font-size:11px\">" . $isocertified . "</p>";
		// <td ><img src='../public/img/kseb.jpg' class='img-responsive eofficeimg' alt='gandhi logo' />
		// </td>
		$htm = "<table  align='center'  width='100%' >
			<tr>
				<td width='20%' align='center'>
						<table width='100%' >
					<tr>
							<td ><img src='../public/img/kseb.jpg' class='img-responsive eofficeimg' alt='kseb logo' /></td>
					</tr>
					<tr>
							
					</tr>
						</table>
				</td>
				<td width='80%'>
						<table width='100%' >
					<tr>
							<td width='100%' align='center'>
						<h2 style='margin-bottom: 0px;'>KERALA STATE ELECTRICITY BOARD LTD</h2>
						<p style='font-size:10px; font-style:italic;'>(Incorporated under the Companies Act 1956)</p>
						<p style='font-size:10px'>CIN:U40100KL2011SGC027424</p>
						<p class=''>Reg. Office: Vydyuthi Bhavanam, Pattom, Thiruvananthapuram KERALA. PIN:695 004.<span style='font-style:italic'> </style></p>
						
						<p class='h4' style='margin-bottom: 0px;'>" . $officeDetails[0]['name'] . "</p>" . $isocertified . "
						<p class=''>" . $address . "</p>
						<p class=''>" . $telNo . "</p>
						<p class=''> e-mail: " . $email . "</p>
							</td>
					</tr>
						</table>
					
				</td>
				</tr>
			</table>";
		return $htm;
	}



	public static function getHistory($imp_ref_id)
	{
		//return;
		$qry = "select * from a_imprest_operations where imprest_id_ref='$imp_ref_id' order by imp_opn_time";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);






		?>
		<div class="row" style="/*border:2px solid black;*/ padding-bottom:10px;">
			<div class='col-sm-4 col-sm-offset-1'>
				<button id=btn_show_div_history_official data-imprest_id_ref="<?php echo $imp_ref_id; ?>" class='btn btn-warning'><span class="fa fa-lg fa-ksebl"></span>
					&nbsp;
					Show Related correspondences Official view</button>




			</div>

			<div class='col-sm-2'>
				<button id=btn_hide_history data-imprest_id_ref="<?php echo $imp_ref_id; ?>" class='btn btn-danger'>
					<span class="fa fa-eye-slash"></span>
					&nbsp;
					Hide correspondences</button>



			</div>
			<div class='col-sm-4 '>
				<button id=btn_show_div_history_classic data-imprest_id_ref="<?php echo $imp_ref_id; ?>" class='btn btn-primary'><span class="fa fa-lg far fa-comment"></span>
					&nbsp;
					Show Related correspondences Classic View </button>



			</div>
		</div>

		<div id=div_history>

		</div>


	<?php
	}
	public static function getHistoryBackUp($imp_ref_id)
	{
		//return;
		$qry = "select * from a_imprest_operations where imprest_id_ref='$imp_ref_id' order by imp_opn_time";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);






		?>
		<div class="row" style="/*border:2px solid black;*/">
			<div class='col-sm-4 col-sm-offset-2'>
				<button id=btn_show_div_history_official class='btn btn-warning'><span class="fa fa-lg fa-ksebl"></span>
					&nbsp;
					Show Related correspondences Official view</button>




			</div>
			<div class='col-sm-4'>
				<button id=btn_show_div_history_classic data-imprest_id_ref="<?php echo $imp_ref_id; ?>" class='btn btn-primary'><span class="fa fa-lg far fa-comment"></span>
					&nbsp;
					Show Related correspondences Classic View </button>



			</div>
		</div>

		<div id=div_history>


			<table class="table table-bordered  table-stripped" style="border:1px solid blue;">




				<?php
				if ($_SESSION[aquired] == 1) {
					//echo "<th>Action</th>";
				} ?>
				<?php

				$sl = 1;

				foreach ($row1 as $row) {



					$sl1 = $sl % 2;





					echo "<h1 class='bg-primary'>$sl</h1>";
					$sl++;

					$imprest_transaction_type1 = split("/", $row[imprest_id_ref]);
					$imprest_transaction_type = $imprest_transaction_type1[2];
					if ($imprest_transaction_type == "P") {
						$amount = self::GetimprestRequestedAmount($row[imprest_id_ref]);

						$amt_info = "<span class=text-success> Requested Amount : $amount</span>";
					}


					?>
					<tr>
						<?php
						$html = self::show_office_particulars_as_heading($row[from_office]);
						echo $html;

						?>
						<hr style="
    			display: block;
    			height: 1px;
    			border: 0;
    			border-top: 1px solid #ccc;
    			margin: 1em 0;
    			padding: 0;
			">

						<?php echo "<BR><BR><BR><BR>From<BR>" . self::getEmpNameFromEmpCode($row[action_by]) . "<BR>"; ?>




						<?php echo "" . self::getBranchNameFromBranchId($row[from_branch]) . "<BR>"; ?>
						<?php echo self::get_office_name($row[from_office]) . "<BR>"; ?>


						<BR><BR><BR>TO <BR> <?php echo self::getBranchNameFromBranchId($row[to_branch]) . "<span class='text-primary'>" . "<BR>";;

											echo "" . self::get_office_name($row[to_office]) . "<BR><BR><BR>"; ?>
						<?php echo $row[imp_oprn_msg]; ?>

						<br><br>
						<span>
							<div class=' lead pull-left'><?php $rounded = date('d-M-Y g:ia', strtotime(($row[imp_opn_time])));
															echo $rounded; ?> </div>
							<div class='pull-right'><br><br>Your's Faithfully<br>Sd-<br> <?php echo "" . self::getEmpNameFromEmpCode($row[action_by]) . "<BR>"; ?></div>
						</span>
						<br>
						<p class="bg-danger"><?php echo $amt_info; ?></p>
						<br>
						<p class="text-success"> IMP OP ID :<?php echo $row[imprest_op_id]; ?></p>





						<?php
						//echo "action pending  $row[action_pending]";

						?>
						</td>
						<?php
						if ($_SESSION[aquired] == 1) {

							echo "<td>";
							if ($row[action_pending] == 'f') {
								?>



								<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-success btn_make_live">Make Live </button></p>
							<?php
							} else {

								?>



								<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-warning btn_make_sleep">Make sleep </button></p>


							<?php

							}

							echo "</td>";
						}
						?>



					</tr>






				<?php
				}
				?>
			</table>

		</div> <!-- div well -->
	<?php
	}
	public static function getHistoryOfficial($imp_ref_id)
	{
		//return;
		$qry = "select * from a_imprest_operations where imprest_id_ref='$imp_ref_id' order by imp_opn_time";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);

		//print_r($row1);




		?>



		<table class="table table-bordered  table-stripped" style="border:1px solid blue;">




			<?php
			if ($_SESSION[aquired] == 1) {
				//echo "<th>Action</th>";
			} ?>
			<?php

			$sl = 1;

			foreach ($row1 as $row) {



				$sl1 = $sl % 2;





				echo "<h1 class='bg-primary'>$sl</h1>";
				$sl++;

				$imprest_transaction_type1 = split("/", $row[imprest_id_ref]);
				$imprest_transaction_type = $imprest_transaction_type1[2];
				if ($imprest_transaction_type == "P") {
					$amount = self::GetimprestRequestedAmount($row[imprest_id_ref]);

					$amt_info = "<span class=text-success> Requested Amount : $amount</span>";
				}


				?>
				<tr>
					<?php
					$html = self::show_office_particulars_as_heading($row[from_office]);
					echo $html;

					?>
					<hr style="
    			display: block;
    			height: 1px;
    			border: 0;
    			border-top: 1px solid #ccc;
    			margin: 1em 0;
    			padding: 0;
			">

					<?php echo "<BR><BR><BR><BR>From<BR>" . self::getEmpNameFromEmpCode($row[action_by]) . "<BR>"; ?>




					<?php echo "" . self::getBranchNameFromBranchId($row[from_branch]) . "<BR>"; ?>
					<?php echo self::get_office_name($row[from_office]) . "<BR>"; ?>


					<BR><BR><BR>TO <BR> <?php echo self::getBranchNameFromBranchId($row[to_branch]) . "<span class='text-primary'>" . "<BR>";;

										echo "" . self::get_office_name($row[to_office]) . "<BR><BR><BR>"; ?>
					<?php echo $row[imp_oprn_msg]; ?>

					<br><br>
					<span>
						<div class=' lead pull-left'><?php $rounded = date('d-M-Y g:ia', strtotime(($row[imp_opn_time])));
														echo $rounded; ?> </div>
						<div class='pull-right'><br><br>Your's Faithfully<br>Sd-<br> <?php echo "" . self::getEmpNameFromEmpCode($row[action_by]) . "<BR>"; ?></div>
					</span>
					<br>
					<p class="bg-danger"><?php echo $amt_info; ?></p>
					<br>
					<p class="text-success"> IMP OP ID :<?php echo $row[imprest_op_id]; ?></p>





					<?php
					//echo "action pending  $row[action_pending]";

					?>
					</td>
					<?php
					if ($_SESSION[aquired] == 1) {

						echo "<td>";
						if ($row[action_pending] == 'f') {
							?>



							<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-success btn_make_live">Make Live </button></p>
						<?php
						} else {

							?>



							<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-warning btn_make_sleep">Make sleep </button></p>


						<?php

						}

						echo "</td>";
					}
					?>



				</tr>






			<?php
			}
			?>
		</table>

		</div> <!-- div well -->
	<?php
	}


	public static function getHistoryClassic($imp_ref_id)
	{
		//	return;
		$qry = "select * from a_imprest_operations where imprest_id_ref='$imp_ref_id' order by imp_opn_time";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);






		?>
		<style>
			/* General CSS Setup */
			/* container */
			.container {
				padding: 5% 5%;
			}

			/* CSS talk bubble */
			.talk-bubble {
				margin: 40px;
				display: inline-block;
				position: relative;
				width: 200px;
				height: auto;
				background-color: lightyellow;
			}

			.border {
				border: 8px solid #666;
			}

			.round {
				border-radius: 30px;
				-webkit-border-radius: 30px;
				-moz-border-radius: 30px;

			}

			/* Right triangle placed top left flush. */
			.tri-right.border.left-top:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: -40px;
				right: auto;
				top: -8px;
				bottom: auto;
				border: 32px solid;
				border-color: #666 transparent transparent transparent;
			}

			.tri-right.left-top:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: -20px;
				right: auto;
				top: 0px;
				bottom: auto;
				border: 22px solid;
				border-color: lightyellow transparent transparent transparent;
			}

			/* Right triangle, left side slightly down */
			.tri-right.border.left-in:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: -40px;
				right: auto;
				top: 30px;
				bottom: auto;
				border: 20px solid;
				border-color: #666 #666 transparent transparent;
			}

			.tri-right.left-in:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: -20px;
				right: auto;
				top: 38px;
				bottom: auto;
				border: 12px solid;
				border-color: lightyellow lightyellow transparent transparent;
			}

			/*Right triangle, placed bottom left side slightly in*/
			.tri-right.border.btm-left:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: -8px;
				right: auto;
				top: auto;
				bottom: -40px;
				border: 32px solid;
				border-color: transparent transparent transparent #666;
			}

			.tri-right.btm-left:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: 0px;
				right: auto;
				top: auto;
				bottom: -20px;
				border: 22px solid;
				border-color: transparent transparent transparent lightyellow;
			}

			/*Right triangle, placed bottom left side slightly in*/
			.tri-right.border.btm-left-in:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: 30px;
				right: auto;
				top: auto;
				bottom: -40px;
				border: 20px solid;
				border-color: #666 transparent transparent #666;
			}

			.tri-right.btm-left-in:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: 38px;
				right: auto;
				top: auto;
				bottom: -20px;
				border: 12px solid;
				border-color: lightyellow transparent transparent lightyellow;
			}

			/*Right triangle, placed bottom right side slightly in*/
			.tri-right.border.btm-right-in:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: 30px;
				bottom: -40px;
				border: 20px solid;
				border-color: #666 #666 transparent transparent;
			}

			.tri-right.btm-right-in:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: 38px;
				bottom: -20px;
				border: 12px solid;
				border-color: lightyellow lightyellow transparent transparent;
			}

			/*
			left: -8px;
  		right: auto;
  		top: auto;
			bottom: -40px;
			border: 32px solid;
			border-color: transparent transparent transparent #666;
			left: 0px;
  		right: auto;
  		top: auto;
			bottom: -20px;
			border: 22px solid;
			border-color: transparent transparent transparent lightyellow;

		/*Right triangle, placed bottom right side slightly in*/
			.tri-right.border.btm-right:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: -8px;
				bottom: -40px;
				border: 20px solid;
				border-color: #666 #666 transparent transparent;
			}

			.tri-right.btm-right:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: 0px;
				bottom: -20px;
				border: 12px solid;
				border-color: lightyellow lightyellow transparent transparent;
			}

			/* Right triangle, right side slightly down*/
			.tri-right.border.right-in:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: -40px;
				top: 30px;
				bottom: auto;
				border: 20px solid;
				border-color: #666 transparent transparent #666;
			}

			.tri-right.right-in:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: -20px;
				top: 38px;
				bottom: auto;
				border: 12px solid;
				border-color: lightyellow transparent transparent lightyellow;
			}

			/* Right triangle placed top right flush. */
			.tri-right.border.right-top:before {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: -40px;
				top: -8px;
				bottom: auto;
				border: 32px solid;
				border-color: #666 transparent transparent transparent;
			}

			.tri-right.right-top:after {
				content: ' ';
				position: absolute;
				width: 0;
				height: 0;
				left: auto;
				right: -20px;
				top: 0px;
				bottom: auto;
				border: 20px solid;
				border-color: lightyellow transparent transparent transparent;
			}

			/* talk bubble contents */
			.talktext {
				padding: 1em;
				text-align: left;
				line-height: 1.5em;
			}

			.talktext p {
				/* remove webkit p margins */
				-webkit-margin-before: 0em;
				-webkit-margin-after: 0em;
			}
		</style>




		<div class=well style="background-color:black">

			<?php

			$sl = 1;

			foreach ($row1 as $row) {



				$sl1 = $sl % 2;
				$sl++;



				if ($sl1 == 1) {

					$imprest_transaction_type1 = split("/", $row[imprest_id_ref]);
					$imprest_transaction_type = $imprest_transaction_type1[2];
					if ($imprest_transaction_type == "P") {
						$amount = self::GetimprestRequestedAmount($row[imprest_id_ref]);

						$amt_info = "<span class=text-success> Requested Amount : $amount</span>";
					}


					?>
					<div class="talk-bubble tri-right round btm-left">
						<div class="talktext">
							<P>
								<b class=text-danger>On <?php $rounded = date('d-M-Y g:ia', strtotime(($row[imp_opn_time])));
														echo $rounded; ?></b>


								<span class=text-warning> <?php echo self::getEmpNameFromEmpCode($row[action_by]); ?> </span>

								<span class=text-primary> <?php echo " ," . self::getBranchNameFromBranchId($row[from_branch]); ?> </span>
								<span class=text-success> , <?php echo self::get_office_name($row[from_office]); ?> </span>


								wrote to <?php echo " ,<span class='text-danger'>" . self::getBranchNameFromBranchId($row[to_branch]) . "</span>";

											echo " ," . self::get_office_name($row[to_office]);  ?></P>
							<p class="text-primary"><?php echo $row[imp_oprn_msg]; ?></p>

							<p class="bg-danger"><?php echo $amt_info; ?></p>
							<p class="bg-success"> IMP OP ID :<?php echo $row[imprest_op_id]; ?></p>
							<?php
							echo "action pending  $row[action_pending]";
							if ($_SESSION[aquired] == 1) {


								if ($row[action_pending] == 'f') {
									?>



									<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-success btn_make_live">Make Live </button></p>
								<?php
								} else {

									?>



									<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-warning btn_make_sleep">Make sleep </button></p>
								<?php

								}
							}
							?>



						</div>


					</div>

				<?
				} else if ($sl1 == 0) { ?>

					<div class="talk-bubble tri-right round right-in">
						<div class="talktext">
							<P>
								<b class=text-danger>On <?php $rounded = date('d-M-Y g:ia', strtotime(($row[imp_opn_time])));
														echo $rounded; ?></b>


								<span class=text-warning> <?php echo self::getEmpNameFromEmpCode($row[action_by]); ?>, </span>

								<span class=text-primary> <?php echo " ," . self::getBranchNameFromBranchId($row[from_branch]); ?> </span>
								<span class=text-success> , <?php echo self::get_office_name($row[from_office]); ?> </span>


								wrote to <?php echo " ," . self::getBranchNameFromBranchId($row[to_branch]);

											echo " ," . self::get_office_name($row[to_office]);  ?></P>
							<p class="text-primary"><?php echo $row[imp_oprn_msg]; ?></p>
							<p class="bg-danger"><?php echo $amt_info; ?></p>
							<p class="bg-success"> IMP OP ID :<?php echo $row[imprest_op_id]; ?></p>


							<?php
							if ($_SESSION[aquired] == 1) {
								if ($row[action_pending] == 'f') {
									?>



									<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-success btn_make_live">Make Live </button></p>
								<?php
								} else {

									?>



									<p class="bg-success"> <button data-imp_op_id="<?php echo $row[imprest_op_id]; ?>" class="btn btn-warning btn_make_sleep">Make sleep </button></p>
								<?php

								}
								?>
							</div>

						</div>


					<?php

					}
				}
			}

			?>
		</div> <!-- div well -->



		<!-- div historyend above -->

	<?php

	}







	public static function getBranchNameFromBranchId($branch_id = 0)



	{

		$qry = "select name from branch where id=$branch_id";
		$db = new DBAccess;
		$row = $db->SelectData($qry);
		//echo $qry;
		$row1 = $row[0];

		if ($row['EOF'] == 1) {
			echo "Head of Office";
		}
		//echo $row1[name];
		//return $row1[amount];

		///cho $row1[name];
		return $row1[name];
	}



	public static function getHistory1($imp_ref_id)
	{

		$qry = "select * from a_imprest_operations where imprest_id_ref='$imp_ref_id' order by imp_opn_time";
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);






		?>

		<div class='col-sm-4 col-sm-offset-4'>
			<button id=btn_show_div_history class='btn btn-warning'> Hide Related correspondences</button>
		</div>
		<div id=div_history>

			<style>
				/* General CSS Setup */
				/* container */
				.container {
					padding: 5% 5%;
				}

				/* CSS talk bubble */
				.talk-bubble {
					margin: 40px;
					display: inline-block;
					position: relative;
					width: 200px;
					height: auto;
					background-color: lightyellow;
				}

				.border {
					border: 8px solid #666;
				}

				.round {
					border-radius: 30px;
					-webkit-border-radius: 30px;
					-moz-border-radius: 30px;

				}

				/* Right triangle placed top left flush. */
				.tri-right.border.left-top:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: -40px;
					right: auto;
					top: -8px;
					bottom: auto;
					border: 32px solid;
					border-color: #666 transparent transparent transparent;
				}

				.tri-right.left-top:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: -20px;
					right: auto;
					top: 0px;
					bottom: auto;
					border: 22px solid;
					border-color: lightyellow transparent transparent transparent;
				}

				/* Right triangle, left side slightly down */
				.tri-right.border.left-in:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: -40px;
					right: auto;
					top: 30px;
					bottom: auto;
					border: 20px solid;
					border-color: #666 #666 transparent transparent;
				}

				.tri-right.left-in:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: -20px;
					right: auto;
					top: 38px;
					bottom: auto;
					border: 12px solid;
					border-color: lightyellow lightyellow transparent transparent;
				}

				/*Right triangle, placed bottom left side slightly in*/
				.tri-right.border.btm-left:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: -8px;
					right: auto;
					top: auto;
					bottom: -40px;
					border: 32px solid;
					border-color: transparent transparent transparent #666;
				}

				.tri-right.btm-left:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: 0px;
					right: auto;
					top: auto;
					bottom: -20px;
					border: 22px solid;
					border-color: transparent transparent transparent lightyellow;
				}

				/*Right triangle, placed bottom left side slightly in*/
				.tri-right.border.btm-left-in:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: 30px;
					right: auto;
					top: auto;
					bottom: -40px;
					border: 20px solid;
					border-color: #666 transparent transparent #666;
				}

				.tri-right.btm-left-in:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: 38px;
					right: auto;
					top: auto;
					bottom: -20px;
					border: 12px solid;
					border-color: lightyellow transparent transparent lightyellow;
				}

				/*Right triangle, placed bottom right side slightly in*/
				.tri-right.border.btm-right-in:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: 30px;
					bottom: -40px;
					border: 20px solid;
					border-color: #666 #666 transparent transparent;
				}

				.tri-right.btm-right-in:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: 38px;
					bottom: -20px;
					border: 12px solid;
					border-color: lightyellow lightyellow transparent transparent;
				}

				/*
			left: -8px;
  		right: auto;
  		top: auto;
			bottom: -40px;
			border: 32px solid;
			border-color: transparent transparent transparent #666;
			left: 0px;
  		right: auto;
  		top: auto;
			bottom: -20px;
			border: 22px solid;
			border-color: transparent transparent transparent lightyellow;

		/*Right triangle, placed bottom right side slightly in*/
				.tri-right.border.btm-right:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: -8px;
					bottom: -40px;
					border: 20px solid;
					border-color: #666 #666 transparent transparent;
				}

				.tri-right.btm-right:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: 0px;
					bottom: -20px;
					border: 12px solid;
					border-color: lightyellow lightyellow transparent transparent;
				}

				/* Right triangle, right side slightly down*/
				.tri-right.border.right-in:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: -40px;
					top: 30px;
					bottom: auto;
					border: 20px solid;
					border-color: #666 transparent transparent #666;
				}

				.tri-right.right-in:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: -20px;
					top: 38px;
					bottom: auto;
					border: 12px solid;
					border-color: lightyellow transparent transparent lightyellow;
				}

				/* Right triangle placed top right flush. */
				.tri-right.border.right-top:before {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: -40px;
					top: -8px;
					bottom: auto;
					border: 32px solid;
					border-color: #666 transparent transparent transparent;
				}

				.tri-right.right-top:after {
					content: ' ';
					position: absolute;
					width: 0;
					height: 0;
					left: auto;
					right: -20px;
					top: 0px;
					bottom: auto;
					border: 20px solid;
					border-color: lightyellow transparent transparent transparent;
				}

				/* talk bubble contents */
				.talktext {
					padding: 1em;
					text-align: left;
					line-height: 1.5em;
				}

				.talktext p {
					/* remove webkit p margins */
					-webkit-margin-before: 0em;
					-webkit-margin-after: 0em;
				}
			</style>

			<div class=well style="background-color:black">

				<?php

				$sl = 1;

				foreach ($row1 as $row) {


					//print_r($row1);

					//$row=$row1[0];
					//for($i=0;$i<10;$i++)

					$sl1 = $sl % 2;
					$sl++;
					//echo "$sl1<br>";


					if ($sl1 == 1) {

						$imprest_transaction_type1 = split("/", $row[imprest_id_ref]);
						$imprest_transaction_type = $imprest_transaction_type1[2];
						if ($imprest_transaction_type == "P") {
							$amount = self::GetimprestRequestedAmount($row[imprest_id_ref]);

							$amt_info = "<span class=text-success> Requested Amount : $amount</span>";
						}


						?>
						<div class="talk-bubble tri-right round btm-left">
							<div class="talktext">
								<P> <b class=bg-info>On <?php $rounded = date('d-M-Y g:ia', strtotime(($row[imp_opn_time])));
														echo $rounded; ?></b> <i class=bg-primary> <?php echo self::getEmpNameFromEmpCode($row[action_by]); ?> </i> wrote to <?php

																																																													echo self::get_office_name($row[to_office]);  ?></P>
								<p class="text-primary"><?php echo $row[imp_oprn_msg]; ?></p>
								<p class="bg-danger"><?php echo $amt_info; ?></p>
							</div>
						</div>

					<?
					} else if ($sl1 == 0) {
						$imprest_transaction_type1 = split("/", $row[imprest_id_ref]);
						$imprest_transaction_type = $imprest_transaction_type1[2];
						if ($imprest_transaction_type == "P") {
							$amount = self::GetimprestRequestedAmount($row[imprest_id_ref]);

							$amt_info = "<span class=text-success> Requested Amount : $amount</span>";
						}


						?>

						<div class="talk-bubble tri-right round right-in">
							<div class="talktext">
								<P class=text-warning>On <?php echo $row[imp_opn_time]; ?> <i> <?php echo self::getEmpNameFromEmpCode($row[action_by]);  ?> wrote</i> to <?php

																																											echo self::get_office_name($row[to_office]);  ?></P>
								<p class="text-primary"><?php echo $row[imp_oprn_msg]; ?></p>
								<p class="bg-danger"><?php echo $amt_info; ?></p>
							</div>
						</div>


					<?php

					}
				}

				?>
			</div> <!-- div history -->

		</div>
	<?php

	}


	public static function getPermanantimprestAmountFromRefId($imp_ref_id)

	{

		$qry = "select amount from a_imprest where imp_req_num='$imp_ref_id'";
		$db = new DBAccess;
		$row = $db->SelectData($qry);
		//echo $qry;
		return $row[0][amount];
	}

	public static function getEmpNameFromEmpCode($emp_code)

	{

		$qry = "select * from dl_empl where unique_code='$emp_code'";
		$db = new DBAccess;
		$row = $db->SelectData($qry);
		//echo $qry;
		$row1 = $row[0];
		return $row1[ename];
	}

	//	public static function 
	public static function show_in_box_details($post, $aru_head)

	{



		///////////////////code for returned to ae/////////////////


		$empcode1 = split("/", $imp_ref_id);
		$empcode = $empcode1[0];
		$office_code = $empcode1[1];

		////////////////////////////////////////////////////////////////////////////////////////


		//print_r($post);
		//

		$imp_op_id = $post[imp_op_id];

		//echo $imp_op_id;

		if ($_SESSION[aru_code] == $_SESSION[office_code]) $office_type = "aru";
		else $office_type = "non_aru";


		if (self::sameOfficeOperation($imp_op_id)) {
			$to_branch = $_SESSION[branch_id];
		} else {
			$to_branch = 1;
		}


		$imp_ref_id = $post[imp_ref_id];

		$qry = "select imprest_op_id,imp_status,from_office ,imp_oprn_msg,imprest_id_ref,o.name
			 from a_imprest_operations aio left join a_imprest_status ais 
		
		on ais.stat_id=aio.imp_operation inner join offices o on o.code=aio.to_office
		
		where to_office='$_SESSION[office_code]' and 
		to_branch='$to_branch' and imprest_id_ref='$imp_ref_id'";


		$x = 0;


		self::getHistory($imp_ref_id);


		switch ($office_type) {

			case "aru":
				//if($_SESSION[previlege]=="Orginating Official" and $_SESSION[branch]=="AB1 Section"){
				if ($post[imp_operation] == 113) {

					//pass to dao

					$sessID =  Date('dmY') . time(h, m, s);
					$cmbBilltype = 1001;
					$sbmt = "SAVE1";

					$empcode1 = split("/", $imp_ref_id);
					$empcode = $empcode1[0];
					$office_code = $empcode1[1];
					$row1 = self::imp_holder_details($empcode, $_SESSION[location_code]);
					$row1 = self::imp_holder_details_with_office($empcode, $_SESSION[location_code], $office_code);
					$row = $row1[0];
					//print_r($row1);

					///print_r($row1);
					if ($row1['EOF'] == 1) {
						//self::show_alert("Employee Not Added as imprest Holder In this office \n. To add an imprest Holder Click button Add imprest Holder ");

						$disabled = ' disabled=disabled '
						?>
					<div class='container' id='div_not_added_as_imp_holder'>

						<div class='row'>
							<div class='col-sm-4 col-sm-offset-4'>

								<?php self::show_alert("Employee Not Added as imprest Holder In this office \n. To add an imprest Holder Click button Add imprest Holder "); ?>

								<button class='btn btn-danger' data-empcode='<?php echo $empcode; ?>' data-office-code='<?php echo $office_code; ?>' type=button id=add_imprest_holder>
									<span class='fa fa-stop-circle fa-lg'></span>&nbsp; Add as imprest Holder</button>





							</div>
						</div>
						<div></div>
					</div>
				<?

				}



				//$txtpayee=$row[id]."-".$row[office_id];


				$txtpayee = $row[id] . "-" . $row[office_id];


				$txtnetAcc = "24210" . "." . $row[id];

				//echo "textnetacc".$txtnetAcc;


				//echo "cmboffice=$cmboffice";
				//echo "empcode=$empcode";

				$cmboffice = $row[office_id];
				$cmbpayee = $row[id];


				?>



				<form action="expAcc.php" id=form_submit_imprest method=post>


					<input type=hidden name=sid value="<?php echo $sessID; ?>">
					<input type=hidden name=id value=104>
					<input type=hidden name=cmbBilltype value="<?php echo $cmbBilltype; ?>">
					<input type=hidden name=cmbpayee value="<?php echo $cmbpayee; ?>">
					<input type=hidden name=txtpayee value="<?php echo $txtpayee; ?>">
					<input type=hidden name=cmboffice value="<?php echo $cmboffice; ?>">
					<input type=hidden name=locid value="<?php echo $_SESSION[location_code]; ?>">
					<input type=hidden name=sbmt value="<?php echo $sbmt; ?>">
					<input type=hidden name=txtnetAcc value="<?php echo $txtnetAcc; ?>">
					<input type=hidden name=txtDate value="<?php echo self::GetCurrDate(); ?>">

					<table class="table table-stripped table-hovered table-bordered">

						<tr>
							<td>imprest Amount</td>
							<td>
								<input class=form-control type=text value="<?php echo self::getPermanantimprestAmountFromRefId($imp_ref_id); ?>" name=txtamount>

							</td>

						</tr>
						<tr>
							<td>Select Branch</td>
							<td>
								<?php

								switch ($_SESSION[previlege_id]) {

									case 1:
										$requiredPrivillage = 2;
										break;
									case 21:
									case 22:
									case 23:

										$requiredPrivillage = 3;
										break;


									case 3:
										$requiredPrivillage = 1;
										break;
								}

								if (0)
									if ($_SESSION[user_name] == 1064767 or $_SESSION[aquired] == 1) {

										self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
									}

								self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
								//self::GetSections("cmbsec");
								?>

							</td>

						</tr>
						<!--
		
		Array (  
 [cmbsec] => 2303 [locid] => 323 [impchequeid] => [sbmt] => SAVE ) 

		
		
		-->
						<tr>

							<td></td>
						</tr>
						<tr>

						<tr>

							<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
						</tr>
						<tr>

							<td>For Payment <input class=auto_text_check_box type=checkbox value="For Payment"></td>
						</tr>





						<td colspan=2>


							<textarea style="margin-bottom:50px" class=form-control name='txtdesci' cols=55 rows=10 class=form-control id=txt_area_request_temp_imprest data-imp-ref-id='<?php echo $imp_ref_id ?>' data-to_office='<?php echo $_SESSION[office_code] ?>' data-imp_op_id='<?php echo $imp_op_id; ?>' placeholder="Remarks ..."></textarea>

						</td>

						<tr>
							<td colspan=2 class="text-center">

								<?php $_SESSION[option] = "save_vouchers_in_saras"; ?>
								<button name=sbmt1 value=SAVE1 <?php echo $disabled; ?> type=button id=sub_to_expac class="btn btn-primary btn_fwd_imprest">Submit</button>




						</tr>


						</tr>


					</table>

				</form>





			<?


			} else {    //executive engineer or aru head 


				?>
				<div class=row>
					<div class="col-sm-10 col-sm-offset-1 well">

						<div align="center" style="margin:auto;text-align:center">
							<table>

								<tr>

									<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
								</tr>
								<tr>

									<td>Audited and Found Ok. For Orders<input class=auto_text_check_box type=checkbox value="Sir,&#10&#13Audited and Found Ok.&#10&#13For Orders"></td>
								</tr>
							</table>
							<h5> Remarks ... </h5>
							<textarea style="margin-bottom:50px" name='<?php echo $x[imprest_id_ref]; ?>' cols=55 rows=10 class=form-control id=txt_area_request_temp_imprest data-imp_ref_id='<?php echo $post[imp_ref_id] ?>' data-imp_op_id='<?php echo $imp_op_id; ?>' placeholder="Remarks ..."></textarea>

						</div>
					</div>

					<table class="table table-hovered table-stripped">

						<?php if ($post[from_ofc_code] != $_SESSION[office_code]) { ?>

							<tr>
								<td class="lead bg-danger">Return to </td>
								<td>


									<button class="btn btn-danger btn_fwd_imprest" name='<?php echo $post[branch_id]; ?>' id='<?php echo $post[from_ofc_code]; ?>'>Return to

										<?php echo self::get_office_name($post[from_ofc_code]); ?>

									</button>
								</td>
							</tr>
						<?php
						}
						?>



						<table class="table table-hovered table-stripped">
							<tr>
								<td class="lead bg-success">Approve and Transfer to </td>
								<td>
									<button name='<?php echo $post[branch_id]; ?>' class="btn btn-success btn_fwd_imprest intern first" data-ineten=intern data-imp_op_id='<?php echo $imp_op_id; ?>' id='<?php echo $_SESSION[office_code]; ?>'> Approve and Transfer
									</button>
								</td>
								<td class="lead bg-success">Select branch</td>
								<td>




									<?php

									switch ($_SESSION[previlege_id]) {

										case 1:
											$requiredPrivillage = 2;
											break;
										case 21:
										case 22:
										case 23:

											$requiredPrivillage = 3;
											break;


										case 3:
											$requiredPrivillage = 1;
											break;
									}

									if (0)
										if ($_SESSION[user_name] == 1064767 or $_SESSION[aquired] == 1) {

											self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
										}

									self::GetSectionsPrivillage("cmbsec", $requiredPrivillage);
									//self::GetSections("cmbsec");
									?>



								<?php
								}


								?>
							</td>
						</tr>
					</table>
			</div>


			</div>

			</div>
			</div>
			</div>

			<?php



			$nop = 1;


			break;


		case "non_aru":




			?>
			<!-- wwww -->
			<div class=row>
				<div class="col-sm-10 col-sm-offset-1 well">

					<div align="center" style="margin:auto;text-align:center">
						<h5> Remarks ... </h5>
						<textarea style="margin-bottom:50px" name='<?php echo $x[imprest_id_ref]; ?>' cols=55 rows=10 class=form-control id=txt_area_request_temp_imprest data-imp_ref_id='<?php echo $post[imp_ref_id] ?>' data-imp_op_id='<?php echo $imp_op_id; ?>' placeholder="Remarks ..."></textarea>

					</div>
				</div>

				<table class="table table-hovered table-stripped">

					<?php if ($post[from_ofc_code] != $_SESSION[higher_office_code]) { ?>

						<tr>
							<td class="lead bg-danger">Return to </td>
							<td>
<?php 

// print_r($_SESSION);

if($_SESSION[aquired]){

	$qry="select from_office from a_imprest_operaion where imprst_id_ref='$imp_ref_id' ";
	$db = new DBAccess;
	$row = $db->SelectData($qry);


	//$db=new DBAccess;

	if (!$row[EOF] == 1) {

		print_r($row);
}
}

?>



	<button class="btn btn-danger btn_fwd_imprest" name='<?php echo $post[branch_id]; ?>' id='<?php echo $post[from_ofc_code]; ?>'>Return to

									<?php echo self::get_office_name($post[from_ofc_code]); ?>

								</button>
							</td>
						</tr>

					<?php
					}
					?>

					<tr>
						<td class="lead bg-success">Approve and submit to </td>
						<td>
							<button name='<?php echo $post[branch_id]; ?>' class="btn btn-success btn_fwd_imprest" data-imp_op_id='<?php echo $imp_op_id; ?>' id='<?php echo $_SESSION[higher_office_code]; ?>'> Approve and Submit to
								<?php echo self::get_office_name($_SESSION[higher_office_code]); ?> </button>

							</button>
						</td>
					</tr>
				</table>
				<?php




				$nop = 1;




				break;
		}



		// $office_code1=split("/",$imprest_ref_id);
		// 	$office_code=$office_code1;
		// 	$office_name=self::get_office_name($office_code);
		// 	$branch_name=self::getBranchNameFromBranchId($to_branch);
		// 	$desig="AE";
		// 	$to_branch=1;
		// 	$msg="Your Imprest Has been forwarded to $to_branch of  $office_name";
		// 	self::execute_sms ($office_code,$desig,$msg);

	}













	public static function editimprestOperation($post)

	{
		$imp_op_id = $post[imp_op_id];
		$db = new DBAccess;

		$qry = "select action_pending from a_imprest_operations where imprest_op_id=$imp_op_id";
		//echo $qry;


		$row1 = $db->SelectData($qry);

		$row = $row1[0];
		$isForwardedByHigherOffice = $row[action_pending];

		//isForwardedByHigherOffice


		if ($isForwardedByHigherOffice) {

			$qry = "delete from a_imprest_operations where imprest_op_id=$imp_op_id";


			//echo $qry;
			$db = new DBAccess;

			$db->DBbeginTrans();

			$result = $db->UpdateData($qry);


			if ($result['EOF']) {
				$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}

			$qry = "update a_imprest_operations set action_pending=true where imprest_id_ref='$imprest_ref_id' and to_office='$_SESSION[office_code]'";
			//$qry="update a_imprest_operations set action_pending=true where imprest_id_ref='$imprest_ref_id' and to_office='$_SESSION[office_code]'";

			$result = $db->UpdateData($qry);

			if ($result['EOF']) {
				$result['adl_msg2'] = "Setting true of a_imprest_operation s previos office operation";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				return $result;
			}


			$db->DBcommitTrans();



			$alert = "successfully deleted the operation";
			$html = "";
		} else {
			$alert = "Data Processed by Higher office. \n No Operation Permited";
			$html = self::show_error($alert);
		}




		$response = array("html" => $html, "alert" => $alert, "error" => "43", "status" => "");
		$response_json = json_encode($response);
		echo $response;
		///$response=ne



	}


	public static function showEditBox($post)
	{ ?>

			<div class=row>
				<div class="col-sm-8 col-sm-offset-2">



				</div>



			</div>




		<?php

		}


		public static function isOfficerWithimprestHoldingPower()
		{
			//

			//print_r($_SESSION);
			return true;
			if ((in_array($_SESSION['designation_id'], array(8, 12, 80, 226)))) {
				return true;
			} else return false;
			// if(strpos(strtolower($_SESSION[designation]),"engineer")){
			// 		return true;
			// }else return false;



		}


		public static function getPreviousImprestOpId($imprest_id_ref, $op_id)
		{
			$db = new DBAccess;

			$qry = "select * from(select * from a_imprest_operations
		
		 where imprest_id_ref='$imprest_id_ref' order by 1 desc)
		 a where imprest_op_id<$op_id limit 1;";
			//echo $qry;


			$row1 = $db->SelectData($qry);


			if ($row1['EOF'] == 1) {

				$imprest_op_id = 0;
				return $imprest_op_id;
			}
			$row = $row1[0];
			$imprest_op_id = $row[imprest_op_id];

			return $imprest_op_id;
		}




		public static function deleteimprestOperation($post)

		{


			print_r($_POST);
			$imp_op_id = $post[imp_op_id];
			$imprest_id_ref = $post[imprest_id_ref];
			$imp_operation = $post[imp_operation];

			// checking is it a voucher operation 

			$type1 = split("/", $imprest_id_ref);
			$type = $type1[2];

			echo $type;

			//echo "<h2 class=bg-success>type= $type</h2>";



			$db = new DBAccess;

			$qry = "select action_pending from a_imprest_operations where imprest_op_id=$imp_op_id";
			//echo $qry;


			$row1 = $db->SelectData($qry);

			$row = $row1[0];
			$actionPending = $row[action_pending];

			//isForwardedByHigherOffice


			if ($actionPending == true) {


				$to_branch = 1;
				// get imp ref id  $imprest_id_ref

				//get imp op id send from this office and this branch  and with imp ref id


				// set the above imp op id as true



				$previous_id = self::getPreviousImprestOpId($imprest_id_ref, $imp_op_id);

				$db->DBbeginTrans();

				if ($previous_id == 0) {


					/// this condition first submission of imprest 



					//// setting voucher status as 1 


					$qry = "update a_imprest_voucher set voucher_status='1' where imprest_num='$imprest_id_ref' ";

					//	echo $qry;


					$result = $db->UpdateData($qry);

					if ($result['EOF']) {
						$result['adl_msg1'] = "updatation of voucher status=1 failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				} else {
					$qry = "update  a_imprest_operations set action_pending='t' where imprest_id_ref='$imprest_id_ref' and 
						imprest_op_id=$previous_id";

					//echo $qry; echo "<br>";
					$result = $db->UpdateData($qry);


					if ($result['EOF']) {
						$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				}




				if ($type == 'V' or $type == 'VC') {

					$qry = "delete from  a_imprest_voucher_mvmt  where imprest_op_id=$imp_op_id";
					echo $qry;
					echo "<br>";

					$result = $db->UpdateData($qry);


					if ($result['EOF']) {
						$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				}
				if ($imp_operation == 1) {

					$qry = "delete from  a_imprest  where imp_req_num='$imprest_id_ref'";
					//echo $qry; echo "<br>";

					$result = $db->UpdateData($qry);


					if ($result['EOF']) {
						$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				}



				$qry = "delete from  a_imprest_operations  where imprest_op_id=$imp_op_id";
				//echo $qry; echo "<br>";

				$result = $db->UpdateData($qry);


				if ($result['EOF']) {
					$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}





				$db->DBcommitTrans();

				$alert = "success";
				$html = "";
			} else {
				$alert = "Data Processed by Higher office. \n No Operation Permited";
				$html = self::show_error($alert);
			}




			$response = array("html" => $html, "alert" => $alert, "error" => "43", "status" => "");
			$response_json = json_encode($response);
			echo $response;
			///$response=ne



		}

		public static function revokeVoucherAndDeleteImprestOperation($post)

		{


			//print_r($_POST);
			$imp_op_id = $post[imp_op_id];
			$imprest_id_ref = $post[imprest_id_ref];
			$imp_operation = $post[imp_operation];
			$trans_id = $post[transId];

			// checking is it a voucher operation 

			$type1 = split("/", $imprest_id_ref);
			$type = $type1[2];

			//echo "<h2 class=bg-success>type= $type</h2>";



			$db = new DBAccess;

			$qry = "select action_pending from a_imprest_operations where imprest_op_id=$imp_op_id";
			//echo $qry;


			$row1 = $db->SelectData($qry);

			$row = $row1[0];
			$actionPending = $row[action_pending];

			//isForwardedByHigherOffice


			if ($actionPending == true) {


				$to_branch = 1;
				// get imp ref id  $imprest_id_ref

				//get imp op id send from this office and this branch  and with imp ref id


				// set the above imp op id as true



				$previous_id = self::getPreviousImprestOpId($imprest_id_ref, $imp_op_id);

				$db->DBbeginTrans();

				if ($previous_id == 0) {


					/// this condition first submission of imprest 



					//// setting voucher status as 1 


					$qry = "update a_imprest_voucher set voucher_status='1' where imprest_num='$imprest_id_ref' ";

					//echo $qry;


					$result = $db->UpdateData($qry);

					if ($result['EOF']) {
						$result['adl_msg1'] = "updatation of voucher status=1 failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				} else {
					$qry = "update  a_imprest_operations set action_pending='t' where imprest_id_ref='$imprest_id_ref' and 
						imprest_op_id=$previous_id";

					// $qry; echo "<br>";
					$result = $db->UpdateData($qry);


					if ($result['EOF']) {
						$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				}




				if ($type == 'V' or $type == 'VC') {

					$qry = "delete from  a_imprest_voucher_mvmt  where imprest_op_id=$imp_op_id";
					//echo $qry; echo "<br>";

					$result = $db->UpdateData($qry);


					if ($result['EOF']) {
						$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				}
				if ($imp_operation == 1) {

					$qry = "delete from  a_imprest  where imp_req_num='$imprest_id_ref'";
					//echo $qry; echo "<br>";

					$result = $db->UpdateData($qry);


					if ($result['EOF']) {
						$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}
				}



				$qry = "delete from  a_imprest_operations  where imprest_op_id=$imp_op_id";
				//	echo $qry; echo "<br>";

				$result = $db->UpdateData($qry);


				if ($result['EOF']) {
					$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}

				//deleteing voucher from a_imprest-voucher
				$qry = "delete from  a_imprest_voucher  where purpose='$imprest_id_ref' and type='r' and item_acc_code='$imp_op_id'";
				//echo $qry; echo "<br>";

				$result = $db->UpdateData($qry);


				if ($result['EOF']) {
					$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}

				//updating t master
				$qry = "Update t_master set status=91 where trans_id=$trans_id";
				//echo $qry; echo "<br>";

				$result = $db->UpdateData($qry);


				if ($result['EOF']) {
					$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}
				$qry = "Update trans_master set status=91 where trans_id=$trans_id";
				//	echo $qry; echo "<br>";

				$result = $db->UpdateData($qry);


				if ($result['EOF']) {
					$result['adl_msg1'] = "Delete from a_imprest_operation failed \n";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}





				$db->DBcommitTrans();

				$alert = "success";
				$html = "";

				self::show_alert("<i class='fa fa-check fa-2x'><i/>Success fulyrevoked the Voucher. 
							Please find the item in your inbox for corrective action", "alert alert-success");
			} else {
				$alert = "Data Processed by Higher office. \n No Operation Permited";
				$html = self::show_error($alert);
			}




			$response = array("html" => $html, "alert" => $alert, "error" => "43", "status" => "");
			$response_json = json_encode($response);
			echo $response;
			///$response=ne



		}




		public static function GetimprestRequestedAmount($reference)



		{

			$qry = "select amount from a_imprest where imp_req_num='$reference'";
			$db = new DBAccess;
			$row = $db->SelectData($qry);
			//echo $qry;
			$row1 = $row[0];

			//echo $row1[amount];
			return $row1[amount];
		}
		public static function GetimprestRecoupmentAmount($reference, $c = '')



		{

			if ($c == 'c') {
				$cond = 'and ';
			}

			$qry = "select sum(a.amount1) as amount from(select  amount   as amount1,coalesce(type,'0') as imt from a_imprest_voucher where
		 imprest_num='$reference')a where imt='0';";
			$db = new DBAccess;
			$row = $db->SelectData($qry);
			//echo $qry;
			$row1 = $row[0];
			//echo $qry;
			//echo $row1[amount];
			return $row1[amount];
		}

		public static function show_current_status($imprest_ref_id = 0)
		{

			$qry = "select to_office,to_branch from a_imprest_operations where imprest_id_ref='$imprest_ref_id' and action_pending='t' ";

			//echo $qry;
			$db = new DBAccess;
			$row = $db->SelectData($qry);

			if ($row[EOF] == 1) {
				return "";
			} else {
				$row1 = $row[0];


				///print_r($row1);
				$to_branch = $row1[to_branch];
				$to_office = $row1[to_office];


				//print_r($row1);
				return self::getEmployenameOfbranch($to_office, $to_branch);
			}
		}


		public static function getChequeDetailsfromImpVoucherId($voucher)
		{

			$qry = "select description,to_char(trans_date,'DD/MM/YYYY') as date1  from a_imprest_voucher aiv inner join
			 payment_trans  paytn on aiv.imp_voucher_id=paytn.bill_trans_id

inner join t_master tm on tm.trans_id=paytn.trans_id

 where aiv.type='r' and imp_voucher_id=$voucher";


			$qry1 = "select description,to_char(trans_date,'DD/MM/YYYY') as date1 from 
			 payment_trans  paytn 

inner join t_master tm on tm.trans_id=paytn.bill_trans_id

 where tm.trans_id=$voucher";

//  echo $qry;

			$db = new DBAccess;
			$row = $db->SelectData($qry);

			if ($row[EOF] == 1) {
				return 0;
			} else {
				$row1 = $row[0];

				$chequeNo = $row1[description];
				$date = $row1[date1];


				//print_r($row1);
				return "Cheque No $chequeNo Dated $date";
			}
		}

		public static function show_out_box()

		{

			?>






			<?php


			$qry = "select imprest_op_id as \"operation\",imp_status as status,o.name as \"To_office\",
		imp_oprn_msg as Message,imprest_id_ref as
		 reference,imp_operation,action_pending, to_char(imp_opn_time,'DD/MM/YYYY') as date1 
		 from a_imprest_operations aio left join a_imprest_status ais 
		
		on ais.stat_id=aio.imp_operation inner join offices o on o.code=aio.to_office
		
		where from_office='$_SESSION[office_code]' and 
		from_branch='$_SESSION[branch_id]' order by imprest_op_id desc";

			$qry = "select imprest_op_id as \"operation\",
		imp_oprn_msg as Message,imprest_id_ref as
		 reference,imp_operation,action_pending, to_char(imp_opn_time,'DD/MM/YYYY') as date1 
		 from a_imprest_operations  
		
		where from_office='$_SESSION[office_code]' and 
		from_branch='$_SESSION[branch_id]' order by imprest_op_id desc";

			//echo $qry;

			/*
		$qry="select * from a_imprest_operations aio inner join a_imprest_status aison ais.stat_id=aio.imp_operation inner join offices o on o.code=aio.to_office
		 
		where from_office='$_SESSION[office_code]' and 
		from_branch='$_SESSION[branch_id]'";
		
		
		*/
			//echo $qry;
			//self::showHorizontalTableForReport($qry,"Out Box","tr_output_box","dataTable");



			$db = new DBAccess;
			$row1 = $db->SelectData($qry);

			if ($row1['EOF'] == 1) {
				?>

				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					No items in Out box
				</div>

				<?php
				exit;
			}
			?>
			<script>
				$('.dataTable').DataTable(

					{

						"order": [
							[1, "desc"]
						]


					}


				);
			</script>
			<?php

			$tableHead = "Details of Outgoing actions";
			echo "<table class='table table-hovered table-stripped table-bordered dataTable' style='margin-top:5%'>";

			echo "<caption class='bg-primary text-center'>$tableHead</caption>";


			echo "<thead>";
			echo "<th class='bg-primary text-center'>Op id</th>";
			echo "<th class='bg-primary text-center'>Current Location of File</th>";
			echo "<th class='bg-primary text-center'>Sent Date</th>";
			echo "<th class='bg-primary text-center'>To office</th>";
			echo "<th class='bg-primary text-center'>Message</th>";
			echo "<th class='bg-primary text-center'>Details</th>";
			echo "<th class='bg-primary text-center'>Action</th>";
			//echo "</tbody>";
			echo "</thead>";
			echo "<tbody>";

			//print_r($row1);
			$sl = 1;
			if ($row1[err_msg] != "Nothing to Show in Out Box") {
				foreach ($row1 as $row) {

					$revokable=-1;
					$outTrans=-1;
					if ($sl == 1) {
						$sl++;
						$key = array_keys($row);
						//echo "<tbody>";

						/*
						foreach ($key as $td)
						{
							if($td=='imp_operation') continue;
							echo "<th class='bg-primary text-center'>";
							echo strtoupper($td);
							echo "</th>";
						}
						* 
						* */
					}

					echo "<tr class=tr_output_box>";


					echo "<td>$row[operation]</td>";
					//print_r($row);
					$status = self::show_current_status($row[reference]);

					echo "<td class='text-danger'>$status</td>";
					echo "<td>$row[date1]</td>";
					echo "<td>$row[To_office]</td>";
					echo "<td>$row[message]</td>";

					$imp_operation = $row[imp_operation];
					$imprest_of_office_code1 = split("/", $row[reference]);
					$imprest_of_office_code = $imprest_of_office_code1[1];
					$imprest_of_office_name = self::get_office_name($imprest_of_office_code);

					$imprest_transaction_type1 = split("/", $row[reference]);
					$imprest_transaction_type = $imprest_transaction_type1[2];
					if ($imprest_transaction_type == "P") {
						$amount = self::GetimprestRequestedAmount($row[reference]);

						$amt_info = "<span class=text-success>4. Requested Amount : $amount</span>";
					} elseif ($imprest_transaction_type == "V") {
						$amount = self::GetimprestRecoupmentAmount($row[reference]);

						$amt_info = "<span class=text-success>4. Recoupment Amount : $amount</span>";
					} elseif ($imprest_transaction_type == "VC") {
						$amount = self::GetimprestRecoupmentAmount($row[reference], 'c');

						$amt_info = "<span class=text-success>4. Clossure Amount : $amount</span>";
					}

					$empcode1 = split("/", $row[reference]);
					$emp_code = $empcode1[0];
					$emp_name = self::getEmpNameFromEmpCode($emp_code);
					$type = $empcode1[2];
					echo "<td>
						
						1. <span class='text-warning'>$row[reference]</span> <br>
						2. <span class='text-primary'>Request of $emp_name </span><br>
						3. <span class='text-danger'>$imprest_of_office_name</span> <br>
						
						$amt_info
						
						4. imp opn $imp_operation
						
						</td>";

					if ($imp_operation == 200 or $imp_operation == 300) {




						$imprest_id_ref = $row[reference];
						$qry = "select * from a_imprest_voucher where purpose='$imprest_id_ref'";
						$db = new DBAccess;
						$out1 = $db->SelectData($qry);

						//print_r($out1);
						//echo $qry;
						if ($out1['EOF'] == 1) {
							$revokable = 0;

							$trans_id = 0;

							//echo $qry;

							// $no_recoup_voucher = "NO RECOUP VOUCHER";
						} else {

							//	print_r($out1);
							//$qry;
							$out = $out1[0];
							$trans_id = $out[imp_voucher_id];

							$qry = "select status from t_master where trans_id=$trans_id and status not in (91,21)";

							//revoke	echo $qry;
							$outTrans1 = $db->SelectData($qry);
							$outTrans = $outTrans1[0][status];

							




							if ($outTrans == 11 or $outTrans == 41) {
								$revokable = 1;

								//	$textrevoke="$outTrans Voucher $imp_operation Can be revoked till payment is effected. No action Permited after effecting payment$trans_id";
								$textrevoke = "Voucher  Can be revoked till payment is effected. No action Permited after effecting payment";
							} else {
								$revokable = 0;
								$textrevoke = "Voucher cannot be revokable.No action Permited";
							}


							// echo $imprest_id_ref;
							if ($imprest_id_ref == '1104435/6599/V/2019-2020/1104435150720191563185192.9818') {

								$revokable = 1;
							}
						}
					}
				//	echo "";
// echo "<td>out trans $outTrans</td>";
					//echo "<td><button class='btn btn-warning edit' value=$row[operation]>Edit</button></td>";

					if ($row[action_pending] == 't') {
						if ($type == 'V' or $type == "VC") {
							echo "<td><button class='btn btn-danger delete' data-imp-operation='$row[imp_operation]' data-imprest_id_ref=$row[reference] value=$row[operation]>Delete</button><br>";
							echo "<br><button class='btn btn-success show_send_voucher' data-imp-operation=$row[imp_operation] data-imprest_id_ref=$row[reference] value=$row[operation]>Show send Vouchers</button></td>";
						} elseif ($type == 'P') {

							echo "<td><button class='btn btn-danger delete' data-imp-operation=$row[imp_operation] data-imprest_id_ref=$row[reference] value=$row[operation]>Delete</button><br>";
							echo "<br><button class='btn btn-primary show_related_correspondences'
			 data-imp-operation=$row[imp_operation] data-imprest_id_ref=$row[reference]
			  value=$row[operation]>Show Related Correspondences</button></td>";
						}
					} else {

						if ($type == 'V' or $type == "VC") {
							echo "<td class=text-danger>$textrevoke <br>";
							if ($revokable == 1) {


								echo "<button class='btn btn-danger revoke' data-imp-operation=$row[imp_operation] data-imprest_id_ref=$row[reference] 
	data-transId=$trans_id	value=$row[operation]>REVOKE</button><br>";
								echo "$no_recoup_voucher";
							} else {
								echo "$no_recoup_voucher";
								echo "Request processed By Receiving office.No action Permited<br>";
							}


							echo "<br><button class='btn btn-success show_send_voucher' data-imp-operation=$row[imp_operation] data-imprest_id_ref=$row[reference]
					 value=$row[operation]  >Show send Vouchers</button></td>";
						} elseif ($type == 'P') {
							echo "<td class=text-danger>$textrevoke <br>";
							if ($revokable == 1) {
								echo "<button class='btn btn-danger revoke' data-imp-operation=$row[imp_operation] data-imprest_id_ref=$row[reference] 
					data-transId=$trans_id	value=$row[operation]>REVOKE</button><br>";
							} else {

								echo "Request processed By Receiving office.No action Permited<br>";
								echo "$no_recoup_voucher";
							}




							echo "<br><button class='btn btn-primary show_related_correspondences' data-imp-operation=$row[imp_operation] 
				data-imprest_id_ref=$row[reference] value=$row[operation]>Show Related Correspondences</button></td>";
						}
					}

					echo "</tr>";
				}
				echo "</tbody>";


				echo "</table>";
			} else self::show_error("No Data in Out Box");
			?>

		<?php

		}


		public static function showHorizontalTableForReport($qry, $tableHead = "", $trclass, $class = "", $trname = "")

		{
			$db = new DBAccess;
			$row1 = $db->SelectData($qry);

			if ($row1[EOF] != 1) {

				echo "<table class='table table-hovered table-stripped table-bordered dataTable' >";

				echo "<caption class='bg-success text-center'>$tableHead</caption>";
				//$row=$result->fetch_assoc;

				$sl = 0;
				foreach ($row1 as $row) {
					if ($sl == 0) {
						echo "<thead>";
						$sl++;
						@$key = array_keys($row);


						foreach ($key as $td) {

							echo "<th   style='color:blue'>";
							echo strtoupper($td);
							echo "</th>";
						}
						echo "</thead>";
					}

					echo "<tr class=$trclass name=$trname>";
					$sl = 0;
					foreach (@$row as $rw) {
						echo "<td class=$sl>";
						echo $rw;
						echo "</td>";
						$sl++;
					}


					echo "</tr>";
				}


				echo "</table>";

				?>

			<?php


			} else self::show_error("No Data to Show");
		}



		public static function show_out_box_details($post)

		{


			//print_r($post); 
			echo "<br>";
			echo "<br>";
			echo "<br>";
			$imp_ref_id = $post[imp_ref_id];
			$imp_op_id = $post[imp_op_id];
			$qry = "select imprest_op_id,imp_status,to_office,imp_oprn_msg,imprest_id_ref,o.name
			 from a_imprest_operations aio left join a_imprest_status ais 
		
		on ais.stat_id=aio.imp_operation inner join offices o on o.code=aio.to_office
		
		where from_office='$_SESSION[office_code]' and 
		from_branch='$_SESSION[branch_id]' and aio.imprest_op_id='$imp_op_id'";


			//echo $qry;

			//self::showVerticalTableForReport($qry,"In Box","tr_input_box",$class="");



			$db = new DBAccess;
			$row1 = $db->SelectData($qry);

			if ($row1[EOF] != 1) {

				echo "<table class='table table-hovered table-stripped table-bordered dataTable'  id=out_box_table >";

				echo "<caption class='bg-success text-center'>$tableHead</caption>";
				//$row=$result->fetch_assoc;

				$sl = 0;
				foreach ($row1 as $row) {
					if ($sl == 0) {
						echo "<thead>";
						$sl++;
						@$key = array_keys($row);


						foreach ($key as $td) {

							echo "<th   style='color:blue'>";
							echo strtoupper($td);
							echo "</th>";
						}
						echo "</thead>";
					}

					echo "<tr class=$trclass name=$trname>";
					$sl = 0;
					foreach (@$row as $rw) {
						echo "<td class=$sl>";
						echo $rw;
						echo "</td>";
						$sl++;
					}


					echo "</tr>";
				}


				echo "</table>";

				?>
				<script>
					//$('.dataTable').DataTable();
				</script>
			<?php


			} else self::show_error("No Data to Show");
		}

		public static function showVerticalTableForReport($qry, $tableHead = "", $trclass, $class = "")

		{
			$db = new DBAccess;
			$row1 = $db->SelectData($qry);



			echo "<table class='table table-hovered table-stripped table-bordered dataTable' >";

			echo "<thead>";
			echo "<th class='text-primary text-center'>Description</th>";
			echo "<th class='text-primary text-center'>Details</th>";

			echo "</thead>";

			foreach ($row1[0] as $key => $value) {
				echo "<tr>";
				echo "<td>$key</td>";
				echo "<td>$value</td>";
				echo "</tr>";
			}

			echo "</table>";
			return $row1[0];
		}




		public static function accordion()
		{ ?>





		<?php


		}



		public static function getimprestMonthDetails($imprest_id_ref)
		{

			$qry = "select i_month,i_year from a_imprest_details where imprest_ref_id='$imprest_id_ref'";
			$db = new DBAccess;
			$row = $db->SelectData($qry);


			//$db=new DBAccess;

			if ($row[EOF] != 1) {

				$row1 = $row[0];

				$dateObj   = DateTime::createFromFormat('!m', $row1[i_month]);
				$monthName = $dateObj->format('F');
				return " $monthName/$row1[i_year]";
			}
		}



		public static function show_input_box()

		{

			?>


			<?php
			// 	//	19 to 191
			// $settings[to_branch]=1102;
			// $settings[from_office]=6239;
			// $settings[to_office]=6109;
			// $settings[imp_operation]=191;

			// case ($_SESSION[branch_id]){



			// }




			//or

			//$_SESSION[previlege_id]==3

			$office_code = $_SESSION[office_code];
			$aru_code = $_SESSION[aru_code];

			if ($office_code != $aru_code) $aru = 0;
			else $aru = 1;

			if ($_SESSION[previlege_id] == 3 or ($_SESSION[previlege_id] == 1 and $_SESSION[designation_id] == 12)) {
				$cond = " and ( to_branch='$_SESSION[branch_id]' or to_branch='1')";
			} elseif ($aru == 0) {

				$cond = " and ( to_branch='$_SESSION[branch_id]' or to_branch='1')";
			} else {
				$cond = "and  to_branch='$_SESSION[branch_id]'";
			}

			if ($_SESSION[aquired] == 1 or $_SESSION[location_code] == 411)
				if (0) {
					if ($_SESSION[previlege_id] == 3 or ($_SESSION[previlege_id] == 1 and $_SESSION[designation_id] == 12)) {
						//$cond=" and ( to_branch='$_SESSION[branch_id]' or to_branch='1')"; 
						$cond = " and ( coalesce(ail.to_branch,aio.to_branch::integer)='$_SESSION[branch_id]' or
			 coalesce(ail.to_branch,1)='$_SESSION[branch_id]')";
					} elseif ($aru == 0) {

						$cond = " and ( to_branch='$_SESSION[branch_id]' or to_branch='1')";
					} else {
						$cond = "and   coalesce(ail.to_branch::text,aio.to_branch)='$_SESSION[branch_id]'";
					}
				}







			//print_r($_SESSION);

			$qry = "select imprest_op_id,imp_status,imp_operation, name as from_office,imp_oprn_msg,imprest_id_ref,
		imp_operation,from_office as from_office_code,from_branch,action_by from a_imprest_operations aio left join a_imprest_status ais 
		
		on ais.stat_id=aio.imp_operation
		 inner join offices o on o.code=aio.from_office
		
		
		 where to_office='$_SESSION[office_code]'  $cond  and aio.action_pending=true order by imprest_op_id  asc";


			if (0)
				if ($_SESSION[aquired] == 1 or $_SESSION[location_code] == 411) {
					$qry = "select aio.imprest_op_id,imp_status,  coalesce(ail.imp_operation::text,aio.imp_operation), name as from_office,imp_oprn_msg,imprest_id_ref,
	aio.imp_operation,aio.from_office as from_office_code ,aio.from_branch,action_by 
	from a_imprest_operations aio left join a_imprest_status ais 
	
	on ais.stat_id=aio.imp_operation
	 inner join offices o on o.code=aio.from_office
	
	 left join a_imprest_landing ail on ail.from_office::text=aio.from_office and ail.to_office::text=aio.to_office 
	
	 where 
	 coalesce(ail.to_office::text,aio.to_office)='$_SESSION[office_code]'
	  $cond  and  aio.action_pending=true   order by imprest_op_id  asc";
				}

			if ($_SESSION[aquired] == 1) {

				//	echo $qry;
			}



			$db = new DBAccess;
			$row1 = $db->SelectData($qry);

			//print_r($row1);

			//return false;



			if ($row1['EOF'] == 1) {

				self::show_error("NO Items Pending for Action");
			} else {


				?>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<?php
					$sl = 0;

					foreach ($row1 as $row) {
						$sl++;


						$imprest_of_office_code1 = split("/", $row[imprest_id_ref]);
						$imprest_of_office_code = $imprest_of_office_code1[1];
						$imprest_of_office_name = self::get_office_name($imprest_of_office_code);

						$imprest_transaction_type1 = split("/", $row[imprest_id_ref]);
						$imprest_transaction_type = $imprest_transaction_type1[2];


						$empcode1 = split("/", $row[imprest_id_ref]);
						$emp_code = $empcode1[0];
						$emp_name = self::getEmpNameFromEmpCode($emp_code);

						$imp_operation = $row[imp_operation];


						$imprest_id_ref = $row[imprest_id_ref];
						$imprest_month_details = self::getimprestMonthDetails($imprest_id_ref);

						switch ($imp_operation) {

							case 193:
							case 113:
								$text_info = "Action required.Passing ";

								$text_info = $row[imp_oprn_msg];
								break;
							case 19:
								$text_info = "Action required.Forward to concerned AB branch For Auditing ";
								break;
						}






						if ($imprest_transaction_type == "VC") {
							$dispaly_voucher_type = "Imprest Vouchers for Adjustment and Final CLOSING";

							$txt_class = "text-danger";
						} else
if ($imprest_transaction_type == "V") {
							$dispaly_voucher_type = "Imprest Vouchers FOR RECOUPMENT FOR the Month of $imprest_month_details";
							$txt_class = "text-success";
						} else if ($imprest_transaction_type == "P") {
							$dispaly_voucher_type = "FRESH PERMANENT  IMPREST REQUEST";
							$txt_class = "text-info";
						}

						$text_info = $row[imp_oprn_msg];
						//echo $imprest_of_office_name;
						?>

						<div class="panel panel-default message" style="margin-top:2%">
							<div class="panel-heading" role="tab" id="<? echo "heading-$sl"; ?>">

								<h4 class="panel-title" id="<? echo $row[imp_status]; ?>" value="<? echo $row[imprest_op_id]; ?>" name="<? echo $row[imprest_op_id]; ?>">


									<a class="accord_link" name='<? echo "$row[imprest_id_ref]"; ?>' data-toggle="collapse" data-parent="#accordion" href="<? echo "#collapse-$sl"; ?>" data-imprest-status="<? echo $row[imp_status]; ?>" data-imprest-from_office="<? echo $row[from_office_code]; ?>" data-imprest_id_ref="<? echo $row[imprest_id_ref]; ?>" data-from_branch="<? echo $row[from_branch]; ?>" data-imp_op_id="<? echo $row[imprest_op_id]; ?>" data-imp_operation="<? echo $row[imp_operation]; ?>" aria-expanded="false" aria-controls="<? echo "collapse-$sl"; ?>" role="button">
										<span class=" text-danger">

											<span id='<? echo $row[imprest_op_id]; ?>' class="fa fa-envelope-o fa-lg"></span>&nbsp;



											Click to Open</span>


									</a>




									<div class="row">




										<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
											<h3 id=<?php echo "m$row[imprest_op_id]" ?> class="<?php echo $txt_class; ?>  ">
												<?php echo "$dispaly_voucher_type"; ?>
												by <?php echo "$emp_name"; ?> of <br> <?php echo "$imprest_of_office_name"; ?></h3>

										</div>


										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4  ">



											<div class="panel panel-info">
												<div class="panel-heading">
													<h3 class="panel-title">Note from <?php echo  self::getEmpNameFromEmpCode($row[action_by]); ?> </h3>
												</div>
												<div class="panel-body">
													<span class="pull-right"><?php echo $text_info; ?> </span>
												</div>
											</div>


										</div>

									</div>




								</h4>
								<!-- <b class="text-warning "> Forwarded By <? echo "$row[from_office]"; ?></b> -->


								<!--  <b class="text-info "><? echo "$row[imp_oprn_msg]"; ?></b>  -->

								</h4>

								<h6 class="text-success  "><? echo " Reference No : $row[imprest_id_ref]"; ?></h6>
								<h6 class="badge"><? echo " Op Id No : $row[imprest_op_id]"; ?></h6>

								<?php
								//or ($imp_holder == $_SESSION[user_name])
								if ($_SESSION[aquired] == 1) {

									$imprest_id_ref = $row[imprest_id_ref];
									$empcode1 = split("/", $imprest_id_ref);
									$original_office = $empcode1[1];
									$imp_holder = $empcode1[0];

									$qry = "select * from a_imprest_voucher where imp_holder='$imp_holder' and imp_holder_office='$original_office'
and  voucher_status=1
and coalesce(type,'0')<>'r'";
									$db = new DBAccess;

									$db->DBbeginTrans();
									$rowx = $db->SelectData($qry);

									//$row[EOF]=0;
									//$db=new DBAccess;

									if (!$rowx[EOF] == 1) {

										?>
										<button class='btn btn-danger attach_vouchers' data-imprest_id_ref=<? echo "$row[imprest_id_ref]"; ?>>Attach Unsend Uploaded vouchers to this File </button>

									<?php
									}
								}

								?>
							</div>

							<div id="<? echo "collapse-$sl"; ?>" class="panel-collapse collapse result_target" role="tabpanel" aria-labelledby="<? echo "heading-$sl"; ?>">
								<div class="panel-body">


									<b class="text-info"><?php //echo "$row[imp_oprn_msg]";
															?></b>

									<div id="<? echo "collapse-$sl" . "res"; ?>"></div>


								</div>
							</div>


						</div>

						<script>
							//$('.collapse').collapse('hide');
						</script>



					<?php
					}
					echo "</div>";

					?>

					<div id=show_option_to_close_imprest></div>


				<?

				}
			}

			//return false;


			//self::showHorizontalTableForReport($qry,"Out Box","tr_input_box","dataTable");
			//self::showHorizontalTableForVouchers($qry,"Out Box","tr_input_box","dataTable");









			public static function showHorizontalTableForVouchers($qry, $tableHead = "", $trclass, $class = "")

			{
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//echo $qry;
				if (!$row1['EOF'] == 1) {

					//print_r($row1); 

					echo "<table style='display:none' class='table table-hovered table-stripped table-bordered dataTable' >";

					echo "<caption class='bg-primary text-center'>$tableHead</caption>";
					//$row=$result->fetch_assoc;

					$sl = 0;
					foreach ($row1 as $row) {
						if ($sl == 0) {
							echo "<thead>";
							$sl++;
							$key = array_keys($row);

							foreach ($key as $td) {

								echo "<th   style='color:blue'>";
								echo strtoupper($td);
								echo "</th>";
							}

							echo "<th class=text-primary> Select All <input type=checkbox disabled=disabled checked=checked class=form-control id='voucher_select_all'></th>";
							echo "</thead>";
						}

						echo "<tr class=$trclass>";
						$sl = 0;
						foreach ($row as $rw) {
							echo "<td class=$sl>";
							echo $rw;
							echo "</td>";


							$sl++;
						}
						echo "<td class=text-primary><input disabled=disabled checked=checked class=\"form-control chk_box\" type=checkbox id=$row[imp_voucher_id]></td>";

						echo "</tr>";
					}


					echo "</table>";

					?>
					<script>
						//$('.dataTable').DataTable();
					</script>
				<?php


					//return $row;

				} else { //no data in in box


					self::show_error("NO data");
				}
			}














			public static function show_data_table($row, $edit = 0)

			{
				$var = 0;
			}


			public static	function getPermanantimprestAmount()

			{

				switch ($_SESSION[designation]) {
					case "Chief Engineer (E)":
						return 25000;
						break;
					case "Deputy Chief Engineer (E)":
						return 20000;
						break;
					case "Executive Engineer (E)":
						return 15000;
						break;
					case "Assistant Executive Engineer (E)":
						return 15000;
						break;

					case "Assistant Engineer (E)":
						return 15000;
						break;

					case "Sub Engineer (E)":
						return 15000;
						break;
						
					case "Regional Audit Officer":
						return 4000;
						break;

					default:
						return 15000;
				}
			}






			public static function show_permanant_imprest_form()
			{

				?>



				<?php

				$qry = "select * from offices where code='$_SESSION[higher_office_code]'";

				//echo $qry;

				$db = new DBAccess;
				$row = $db->SelectData($qry);

				//print_r($row);


				{ ?>



					<div class=row>
						<div class="col-sm-10 col-sm-offset-1 well">

							<div align="center" style="margin:auto;text-align:center">


								<table class="table table-stripped table-bordered">
									<tr>
										<td class='text-success lead'>Imprest Amount </td>
										<td>

										<input type="checkbox" class="form-control" id="auto_text_per_imp_request">

											<input type=text class=form-control id=txt_perm_imp_amnt value=<?php echo self::getPermanantImprestAmount() - self::getImprestequestedInFy(); ?>>
										</td>
										<td>
											<div style="display:inline" id=div_max_delegation class="text-danger">
												* Max Limit as Per Delegation Rs/- <?php echo self::getPermanantImprestAmount(); ?> <br><br><br>
												<span class="text-danger">* Balance Available for Fresh Request Rs/- </span><span id=imp_applicable class="text-info">



													<?php echo self::getPermanantImprestAmount() - self::getImprestequestedInFy(); ?></span>


											</div>

										</td>
									</tr>
								</table>

								<div id=div_alert_imprest_amount class=alert-danger></div>
								<h5> Remarks .... </h5>


							

								<textarea cols=55 rows=10 class=form-control id=txt_area_request_perm_imprest placeholder="Remarks ..."></textarea>



							</div>

							<div class=row style="margin-top:5px">
								<div class="col-sm-10 col-sm-offset-2">
									<button id=btn_submit_perm_imp_req class="btn btn-primary ">
										<p> Submit to <?php echo $row[0][name]; ?></p>
									</button>
								</div>
							</div>


						</div>



					</div>




				<?php
				}
			}

			public static function getImprestequestedInFy($user_name = '$_SESSION[user_name]', $imp_holder_office = '$_SESSION[office_code]')
			{
				$date = date("Y-m-d");
				//$date=date("2019-03-25");
				//$date=date("2019-03-31");
				$fy = self::findFinancialYear($date);
				$qry = "select sum(amount) from a_imprest where imp_holder='$user_name' and 
		imp_holder_office='$imp_holder_office'
		
		and imp_fy='$fy'
		";

				//echo $qry;

				$db = new DBAccess;
				$row = $db->SelectData($qry);

				return $row[0][sum];
			}



			public static function show_permanant_imprest_form_new()
			{

				?>



				<?php

				$qry = "select * from offices where code='$_SESSION[higher_office_code]'";

				//echo $qry;

				$db = new DBAccess;
				$row = $db->SelectData($qry);

				//print_r($row);


				{ ?>

					<div class=row>
						<div class="col-sm-10 col-sm-offset-1 well">

							<div align="center" style="margin:auto;text-align:center">


								<table class="table table-stripped table-bordered">
									<tr>
										<td class='text-success lead'>Imprest Amount </td>
										<td>
											<input type=text class=form-control id=txt_perm_imp_amnt value='<?php //echo self::getPermanantImprestAmount()-self::getImprestequestedInFy(); 
																											?>'>
										</td>
										<td>
											<div style="display:inline" id=div_max_delegation class="text-danger">
												* Max Limit as Per Delegation Rs/- <?php echo self::getPermanantImprestAmount(); ?> <br><br><br>
												<span class="text-danger">* Balance Available for Fresh Request Rs/- </span><span id=imp_applicable class="text-info">



													<?php echo self::getPermanantImprestAmount() - self::getImprestequestedInFy(); ?></span>


											</div>

										</td>
									</tr>
								</table>

								<div id=div_alert_imprest_amount class=alert-danger></div>
								<h5> Remarks ... </h5>
								<textarea cols=55 rows=10 class=form-control id=txt_area_request_perm_imprest placeholder="Remarks ..."></textarea>



							</div>

							<div class=row style="margin-top:5px">
								<div class="col-sm-10 col-sm-offset-2">

									<?php


									if ($_SESSION[office_code] == $_SESSION[aru_code]) {

										$a = 0;

										//print_r($_SESSION);


									} else {
										?>
										<button id=btn_submit_perm_imp_req class="btn btn-primary ">
											<p> Submit to <?php echo $row[0][name]; ?></p>
										</button>
									<?php
									}
									?>

								</div>
							</div>


						</div>



					</div>




				<?php
				}
			}






			public static function show_permanant_imprest_form_old_version()
			{

				?>



				<?php

				$qry = "select * from offices where code='$_SESSION[higher_office_code]'";

				//echo $qry;

				$db = new DBAccess;
				$row = $db->SelectData($qry);

				//print_r($row);


				{ ?>

					<div class=row>
						<div class="col-sm-10 col-sm-offset-1 well">

							<div align="center" style="margin:auto;text-align:center">

								<p class=text-success>imprest Amount :</p><input type=text class=form-control id=txt_perm_imp_amnt value=<?php echo self::getPermanantimprestAmount(); ?>>
								<h5> Remarks ... </h5>
								<textarea cols=55 rows=10 class=form-control id=txt_area_request_perm_imprest placeholder="Remarks ..."></textarea>



							</div>

							<div class=row style="margin-top:5px">
								<div class="col-sm-10 col-sm-offset-2">
									<button id=btn_submit_perm_imp_req class="btn btn-primary ">
										<p> Submit to <?php echo $row[0][name]; ?></p>
									</button>
								</div>
							</div>


						</div>



					</div>




				<?php
				}
			}


			public static function show_temporary_imprest_form()
			{

				$qry = "select * from offices where code='$_SESSION[higher_office_code]'";

				//echo $qry;

				$db = new DBAccess;
				$row = $db->SelectData($qry); { ?>


					<div class=row>
						<div class="col-sm-10 col-sm-offset-1 well">

							<div align="center" style="margin:auto;text-align:center">
								<h5> Remarks ... </h5>
								<textarea cols=55 rows=10 class=form-control id=txt_area_request_temp_imprest placeholder="Remarks ..."></textarea>



							</div>






							Upload Documents :

							<?php self::round_btn("btn_add_file_for_imprest", "myBut1", "Click to Add More documents", "fa fa-plus-circle fa-3x", "color:blue") ?>



							<ol id="ol_upload_documents">



								<div class=well>
									<li>

										<label for="fileToUpload"> <i class="fa fa-cloud-upload fa-fw fa-2x text-success"> </i></label>

										<input type="text" id="fileToUpload" class=form-control style="display:inline-block" placeholder="Type of Document:" />



										<input type="file" name="fileToUpload" id="fileToUpload" class=form-control style="display:inline-block" />

										<i class="fa fa-trash-o fa-1x i_delete_doc" style="color:red;display:inline-block" title="delete" data-placement="right" data-toggle="tooltip"> </i>

								</div>
								</li>



							</ol>


							<div class=row style="margin-top:5px">
								<div class="col-sm-10 col-sm-offset-2">
									<button class="btn btn-primary ">
										<p> Submit to <?php echo $row[0][name]; ?></p>
									</button>
								</div>
							</div>




						</div>
					</div>



				</div>




			<?php
			}
		}



		public static function dmyToyymmdd($date)
		{
			return implode('-', array_reverse(explode('/', $date)));
		}

		public static function showRemitanceOption()
		{


			//checck whether remitance is entereed
			//echo "pooi";
			$imp_holder = $_SESSION[user_name];
			$imp_holder_office = $_SESSION[office_code];

			$qry = "select * from a_imprest_voucher where type='remitance'
	
	and imp_holder='$imp_holder' and imp_holder_office='$imp_holder_office'
	and voucher_status=1
	";

			$db = new DBAccess;
			$row1 = $db->SelectData($qry);

			if (isset($row1['EOF'])) {
				$checked = "";
				$class = "form-control save";
				$style = "display:none";

				$Button_text = "Save Remitance Details";

				$btn_class = "btn btn-success save-btn";

				$class1 = 'form-control';
			} else {

				$row = $row1[0];
				$Button_text = "Edit Remitance Details";
				$checked = "checked=checked";
				$style = "display:block";
				$disabled = "disabled=disabled";
				$class = "form-control edit1";
				$btn_class = "btn btn-info edit-btn";
				$class1 = 'form-control edit';
				$Button_text = "Edit Remitance Details";
			}

			//if entered check box on and prefill the details edit mode for remitance -delete if entered again///

			///

			?>
			<div class=row>
				<div class="col-sm-12">
					<table class='table table-stripped table-hovered table-bordered'>
						<tr class=bg-primary>
							<td>

								Are you closing the Imprest after End of Financial Year or by any other Reasons.
								<span class="bg-danger text-danger">If you do not need Recoupmentor Payment , Turn on this button<span>
							</td>
							<td>


							<td><label class="switch">Close
									<input id=chkbox_close_imprest class='<?php echo $class; ?>' type="checkbox" <?php echo $checked; ?> <?php echo $disable; ?>>
									<span class="slider round"> off</span>
								</label></td>
							</td>

						</tr>
						<tr>
							<td colspan=2>

								<table id=tbl_remitance_details style=<?php echo $style; ?> class="table table-bordered table stripped ">
									<tr>
										<td>Remitence Amount</td>
										<td> <input type=text class='<?php echo $class; ?>' <?php echo $disabled; ?> value=<?php echo $row[amount]; ?> name=txtremit id=txt_txtremit></td>



										<td>Remittance Receipt No</td>
										<td> <input class='<?php echo $class; ?>' <?php echo $disabled; ?> value='<?php echo $row[voucher_num]; ?>' type=text name=txtremitrpt id=txt_txtremitrpt></td>
									</tr>
									<tr>
										<td>Date of Receipt1</td>
										<td> <?php

												$date = imprestN::yymmddToddmmyy($row[date_of_payment]);


												echo imprestN::datePicker("txt_date_of_remitance", "txt_date_of_remitance", $date, "$class1", $disabled); ?></td>

										<td>Select Payment Mode</td>
										<td>
											<select class='<?php echo $class; ?>' id=sel_payament_mode <?php echo $disabled; ?>>
												<option value=0>Select</option>
												<option <?php if ($row[item_acc_code] == "saras") echo 'selected'; ?> value=saras>Saras</option>
												<option <?php if ($row[item_acc_code] == "orumanet") echo 'selected'; ?> value=orumanet>OrumaNet</option>
											</select>
										</td>
									</tr>

									<tr>
										<td colspan=4 class=text-center><button class='<?php echo $btn_class; ?>' id=save_remitance_details>

												<span class="fa fa-money fa-lg"></span>&nbsp;

												<?php echo $Button_text; ?></button></td>
									</tr>

								</table>
							</td>

						</tr>



					</table>

				</div>
			<?php

			}



			public static function show_noting_form_bi_directional($post)
			{


				//print_r($post);

				$imp_ref_id = $post[imp_ref_id];
				$imp_op_id = $post[imp_op_id];
				$returned = 0;
				if ($post[imp_operation] == 999) {


					$returned = 1;
					$qry = "select * from a_imprest_operations where imprest_id_ref='$imp_ref_id' and imprest_op_id<$imp_op_id
		 order by imprest_op_id desc limit 1";

					//echo $qry;

					$db = new DBAccess;
					$row = $db->SelectData($qry);


					//$db=new DBAccess;

					if ($row[EOF] == 1) {
						echo "error";
					} else {

						$row1 = $row[0];

						$post[imp_operation] = $row1[imp_operation];

						//echo $row1[imp_operation];

						$imp_operation_r = $row1[imp_operation];

						$to_branch_r = $row1[to_branch];
						$to_office_r = $row1[to_office];

						//$imp_op_id_r=$row1[imp_op_id];

					}
				}

				$x = $post[from_ofc_code];

				//echo "This is print r <br>";
				//print_r($post);
				//echo "This is print r <br>";
				//echo $x;


				if ($returned == 1) {

					//echo "returned $returned";
					?>



					<div class=row>
						<div class="col-sm-12">
							<span class='fa fa-thumbs-up fa-lg  text-center' style='color:blue'>ADD CERTIFICATE <input type=checkbox id=auto_certificate></span> <br>

							<span class='fa fa-sticky-note-o fa-lg  text-center' style='color:blue'>ADD COVERING LETTER <input type=checkbox id=auto_letter></span>

							<?php //imprestN::show_noting_form(); 
							?>

						</div>

					</div>

				<?php
				}
				?>

				<div class=row>
					<div class="col-sm-10 col-sm-offset-1 well">





						<table>

							<tr>

								<td colspan=2 class='text-success text-center '><span class='fa fa-hand-o-down text-info'></span>&nbsp; Please check the boxes for writing quick remarks </td>
							</tr>
							<tr>

								<td>For Payment<input class=auto_text_check_box_v type=checkbox value="&#10&#136t&#10&#13"></td>
							</tr>
						</table>


						<div align="center" style="margin:auto;text-align:center">
							<h5> Remarks ... </h5>
							<textarea style="margin-bottom:50px" name='<?php echo $post[imprest_id_ref]; ?>' cols=55 rows=10 class=form-control id=txt_area_voucher_note placeholder="Remarks ..." data-imp_ref_id='<?php echo $post[imp_ref_id]; ?>'></textarea>


							<?php
							$empcode1 = split("/", $post[imp_ref_id]);
							$original_office = $empcode1[1];
							$imp_holder = $empcode1[0];

							//echo 
							if ($original_office != $_SESSION[office_code]) {






								?>
<?php 
// if($_SESSION[aquired]==1)
if(1)
{

	// print_r($_SESSION);
?>

<div class="container">
	<div class="row alert alert-primary" >


	<div class="col-sm-3">
	<label for="">Select office for Returning for Direct Returning </label>
	
	</div>
		<div class="col-sm-3 block-center" >

		
		
		
		
	<?php  
// if($_SESSION[aquired]==1)
if(1)
{

$qry="select distinct from_office,from_branch from a_imprest_operations where imprest_id_ref='$imp_ref_id'

and from_office<>'$_SESSION[office_code]'

";
$db = new DBAccess;
$row = $db->SelectData($qry);


//$db=new DBAccess;

if (!$row[EOF] == 1) {

	// print_r($row);
?>



<select id=sel_return_to_office>
<option value="0">Select the Branch</option>
<?php

foreach ($row as $r1){

$from_ofc_code=$r1[from_office];
$from_branch_code=$r1[from_branch];
$from_branch_name=imprestN::getBranchNameFromBranchId($r1[from_branch]);

$ofc_name=self::get_office_name($from_ofc_code);
echo "<option value=$from_ofc_code-$from_branch_code>  $ofc_name  - $from_branch_name  </option>";

}

?>




</select>


<?php

}
}
?>	
	<button
		
		
		data-imp_op_id=<?php echo $imp_op_id; ?>
		
		

		
		
		 class="btn btn-info"  style="display:none" id="btn_transfer_imprest" >
Transfer
</button>	
		
		</div>


		
		
		
	</div>
</div>

<?php 
}

?>

<?php 

// print_r($_SESSION);


?>

								<button class="btn btn-danger btn_fwd_voucher"
								 name='<?php echo $post[branch_id]; ?>' 
								 data-imp_op_id='<?php echo $post[imp_op_id]; ?>' 
								 data-imp_operation='<?php echo $post[imp_operation]; ?>' id='<?php echo $x; ?>'>

									Return to
									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									<?php echo self::get_office_name($x); ?>


								<?php




								}

								//echo "returned $returned";
								if ($returned == 1) {
									//cho "returned $returned";
									?>



									<button class="btn btn-danger btn_fwd_voucher" id=btn_return_to_feild data-imp_operation='<?php echo $imp_operation_r; ?>' data-imp_op_id='<?php echo $imp_op_id; ?>' data-imprest_ref_id='<?php echo $imp_ref_id; ?>' data-to_office='<?php echo $to_office_r; ?>' data-to_branch='<?php echo $to_branch_r; ?>' data-from_office='<?php echo $_SESSION[office_code]; ?>' data-from_branch='<?php echo $_SESSION[branch_id]; ?>' data-set_operation='1'>
										Resubmit to
										<?php

										$ofc = self::get_office_name($to_office_r);
										$br = self::getBranchNameFromBranchId($to_branch_r); ?>

										<?php
										echo "$br of $ofc ";
										?>

										<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>

									</button>

									<button name='<?php  //echo $x[from_branch];
													?>' class="btn btn-success btn_fwd_voucher" data-imp_op_id='<?php echo $post[imp_op_id]; ?>' data-imp_operation='<?php echo $post[imp_operation] ?>' name='1' id='<?php echo $_SESSION[higher_office_code]; ?>'>

										<?php
										if ($original_office != $_SESSION[office_code]) { ?>

											Approve and Submit to

										<?php
										} else {
											echo "Resubmit To ";
										} ?>
										<?php echo self::get_office_name($_SESSION[higher_office_code]);

										?>

										<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
									</button>





								<?php

								} else {
									?>

								</button> <button name='<?php  //echo $x[from_branch];
														?>' class="btn btn-success btn_fwd_voucher" data-imp_op_id='<?php echo $post[imp_op_id]; ?>' data-imp_operation='<?php echo $post[imp_operation] ?>' id='<?php echo $_SESSION[higher_office_code]; ?>'>

									<?php
									if ($original_office != $_SESSION[office_code]) { ?>

										Approve and Submit to

									<?php
									} else {
										echo "Resubmit To ";
									} ?>
									<?php echo self::get_office_name($_SESSION[higher_office_code]);

									?>

									<?php $_SESSION['option'] = 'btn_fwd_voucher' ?>
								</button>




							</div>
						</div>
					</div>

				<?php
				}
			}








			public static function show_noting_form()
			{

				$qry = "select * from offices where code='$_SESSION[higher_office_code]'";

				//echo $qry;

				$db = new DBAccess;
				$row = $db->SelectData($qry); { ?>

					<div class=row>
						<div class="col-sm-10 col-sm-offset-1 well">

							<div align="center" style="margin:auto;text-align:center">


								<h5> Remarks ... </h5>
								<textarea cols=55 rows=10 class=form-control id=txt_area_note_for_voucher placeholder="Remarks ..."></textarea>



							</div>

							<div class=row style="margin-top:5px">
								<div class="col-sm-10 col-sm-offset-2 text-center">

									<?php
									if ($_SESSION[office_code] == $_SESSION[aru_code]) {
										?>
										<button id=btn_submit_vouchers class="btn btn-primary ">
											<p> Submit to AB1 </p>
										</button>

									<?php
									} else {

										?>
										<button id=btn_submit_vouchers class="btn btn-primary ">
											<p> Submit to <?php echo $row[0][name]; ?></p>
										</button>


									<?php
									}

									?>

								</div>
							</div>


						</div>



					</div>




				<?php
				}
			}

			public static function show_recoupment_imprest_form_mobile()
			{ ?>



				<?php



				$emp_code = $_SESSION[user_name];
				$emp_office_code = $_SESSION[office_code];


				$head = "<i class=float-right>Balance</i>";

				?>


				<div class=row>

					<div class="col-sm-4 col-sm-offset-4 well">


						<div class="panel panel-info">
							<div class="panel-heading"><?php echo $head; ?></div>
							<div class="panel-body">
								<div id=alert_balance role="alert"></div>
								<table class="table table-bordered table-stripped table-hovered" style="width:100%;margin:0">
									<!-- <tr>
		  		<td>Balance as per ARU Accounts</td><td id=td_balance_at_aru><?php  //echo self::getAruBalance();  
																				?></td>
		  
	  		</tr>
	  
	  		<tr>
		 		<td>Balance as Live</td><td id=div_abstract></td>
		  
	  		</tr> -->

								</table>


							</div>
						</div>




					</div>


					<style>
						table td {
							width: auto !important;
						}
					</style>

					<form id=form1>
						<table class="table table-stripped table-bordered">


							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


									<label for="">Bill No/Invoice Number</label>


									<input type=text name=txt_voucher_num id=txt_voucher_num class="form-control">
								</div>


							</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Paid To</label>
									<input type=text name=txt_paid_to id=txt_paid_to class="form-control">
								</div>


							</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Date of Payment</label>
									<?php echo self::datePicker("txt_date_of_payement", "txt_date_of_payement", ""); ?>
								</div>


							</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Date of Voucher</label>
									<?php echo self::datePicker("txt_date_of_voucher", "txt_date_of_voucher", ""); ?>
								</div>


							</div>


							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Amount</label>
									<input type=text name=txt_amount_imprest id=txt_amount_imprest class="form-control">
								</div>


							</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for="">Account Head</label>
									<?php

									include_once("./../class/transHeads.class.php");
									global $ttype;
									global $loccode;

									$qry = "select  distinct(acc_head),acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


					trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

									self::select($qry, "acc_code", "acc_head", "item_acc_head", "item_acc_head", 0);


									//print_r($result);
									?>
								</div>


							</div>

							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for=""><span class='fa fa-bell text-danger'>&nbsp;Auto Description</span>&nbsp;<input checked='checked' type=checkbox id=chk_auto_description>
										&nbsp;Description</label>
									<textarea name=txt_description_imprest id=txt_description_imprest class="form-control"></textarea>
								</div>


							</div>

							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<label for=""><span class='fa fa-bell text-danger'>Upload Voucher
									</label>
									<input type=file id=data_of_purchase name=data_of_purchase>
								</div>


							</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<button disabled=disabled class="btn btn-success" id=btn_bill>Save Voucher</button>
								</div>


							</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<button class="btn btn-warning" type=button id=btn_show_imprest_vouchers>View imprest Vouchers</button>
								</div>


							</div>

							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class=row id=tbody_imp_vouchers></div>
								</div>


							</div>








					</form>

				</div>







				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modal Header</h4>
							</div>
							<div class="modal-body">
								<p>This is a large modal.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>






			<?php
			}


			public static function show_recoupment_imprest_form_with_addition()
			{ ?>



				<?php

				$emp_code = $_SESSION[user_name];
				$emp_office_code = $_SESSION[office_code];
				$head = "<i class=float-right>Balance</i>";

				?>

				<!-- <h1 style="color:red">Application under maintenance for this section . please call before using this section</h1> -->
				<div class=row>

					<div class="col-sm-4 col-sm-offset-4 well">



						<div class="panel panel-info">
							<div class="panel-heading"><?php echo $head; ?></div>
							<div class="panel-body">
								<div id=alert_balance role="alert"></div>

								<table class="table table-bordered table-stripped table-hovered" style="width:100%;margin:0">
									<!-- <tr>
		  		<td>Balance as per ARU Accounts</td><td id=td_balance_at_aru><?php  //echo self::getAruBalance();  
																				?></td>
		  
	  		</tr> -->

									<?php

									$date = date("Y-m-d");
									//$date=date("2019-03-31");
									$fy = imprestN::findFinancialYear($date);
									$db = new DBAccess;
									$qry = "select * from a_imprest where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and imp_fy='$fy'";

									$row = $db->SelectData($qry);
									if ($row[EOF] == 1) {

										//	if($_SESSION[location_code]!=411)

										//{




										echo "<tr>";
										$qry = "select * from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and type='cash_in_hand'

and imp_fy='$fy'

";

										//print_r($_SESSION);
										//echo $qry;

										$row = $db->SelectData($qry);
										if ($row[EOF] == 1) {

											$display_up++;

											//print_r($_SESSION);
											?>
											<div class=row id=div_cash_in_hand>
												<div class=col-sm-12>
													<label class=text-danger>Enter The Imprest Cash Received by Fresh Issue </label>
													<input type=text class='form-control' id=txt_cash_in_hand>
													<label class=text-danger>Date on which Cash in hand is Given above </label>

													<?php echo imprestN::datePicker("txt_date_of_cash_in_hand", "txt_date_of_cash_in_hand", ""); ?>


													<button class='btn  btn-lg btn-success' id=btn_save_cash_in_hand>Save Cash in Hand</button>
												</div>
											<?php
											}
										}
										?>
									</div>



									</tr>

									<tr>
										<td>Balance as Live</td>
										<td id=div_abstract>


										</td>




									</tr>


									<tr>

										<td colspan=2 class="text-center bg-primary">Current Month</td>
									</tr>

									<tr>
										<td colspan=2 id=div_abstract>

											<?php echo self::table_month_year_for_initial_setup("E"); ?>

										</td>
									</tr>
								</table>


							</div>
						</div>




					</div>


					<style>
						table td {
							width: auto !important;
						}
					</style>
					<div class="col-sm-12 well">
						<form id=form1>
							<table border=1 class="table table-stripped table-bordered" style="border:1px solid blue;">


								<tr class="text-success lead">
									<td>Bill No/Invoice Number</td>
									<td>
										<input type=text name=txt_voucher_num id=txt_voucher_num class="form-control"></td>
									<td>Paid To</td>
									<td><input type=text name=txt_paid_to id=txt_paid_to class="form-control"></td>
								</tr>

								<tr class="text-success lead">
									<td>Date of Payment</td>
									<td><?php
										/// getting the date of first voucher and making the month of payment upper and lower 


										$qry = "Select max(date_of_payment) as date1 from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and voucher_status=1";

										$db = new DBAccess;
										//echo $qry;
										$row1 = $db->SelectData($qry);
										$row = $row1[0];
										$date1 = $row[date1];
										//echo $date1;



										echo self::datePicker("txt_date_of_payement", "txt_date_of_payement", ""); ?></td>



									<td>Date of Voucher </td>
									<td><?php echo self::datePicker("txt_date_of_voucher", "txt_date_of_voucher", ""); ?></td>
								</tr>

								<tr class="text-success lead">
									<td>Amount&nbsp;&#12;&#13;
										<div class="bg-info text-danger"><span>Balance Info</span>
											<span id=div_abstract2></span>

										</div>

									</td>
									<td>

										<input type=text name=txt_amount_imprest id=txt_amount_imprest class="form-control"></td>



									<td>Account Head</td>


									<td>
										<?php

										include_once("./../class/transHeads.class.php");
										global $ttype;
										global $loccode;

										$qry = "select  distinct(acc_head),acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


					trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

										self::select($qry, "acc_code", "acc_head", "item_acc_head", "item_acc_head", 0);


										//print_r($result);
										?>



									</td>

								</tr>







								<tr class="text-success lead">
									<td>Purpose </td>
									<td> <input type=text name=purpose required=required class='form-control'> </td>

									<td>Upload Voucher<br>
										&nbsp; <span id="span_size_file" class="fa fa-warning" style="color:blue;">Size below 300KB</span>

									</td>
									<td><input required=required type=file id=data_of_purchase name=data_of_purchase>
										<div class="alert alert-danger span_voucher_over_size" style="display:none">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<strong>Warning</strong> <span> Please Upload Vouchers below 300KB
										</div>


									</td>

								</tr>


								<tr class="text-success lead">
									<td>
										<span class='fa fa-bell text-danger'>&nbsp;Auto Description</span>&nbsp;<input checked='checked' type=checkbox id=chk_auto_description>
										&nbsp;Description


									</td>
									<td colspan=3><textarea name=txt_description_imprest id=txt_description_imprest class="form-control"></textarea></td>
								</tr>


								<tr class="text-success lead ">
									<td colspan=4 class=text-center>


										<div class="alert alert-danger " id=span_sup_doc_over_size style="display:none">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<strong>Warning</strong> <span> Please Upload Vouchers below 300KB
										</div>
										<button id=btn_add_supporting_documents type="button" class="btn btn-info fa fa-crosshairs text-center"> Add Supporting Documents</button>

										<table class='table table-bordered table-stripped' style="border:1px solid red;">
											<tbody id=tbody_supporting_list>

											</tbody>
										</table>






									</td>
								</tr>


								<tr class="text-success lead text-center">

									<td colspan=2><button disabled=disabled class="btn btn-success" id=btn_bill>
										<span class="fa fa-upload"></span>
									Upload  Voucher</button></td>
									<td colspan=2><button class="btn btn-warning" type=button id=btn_show_imprest_vouchers>View imprest Vouchers</button></td>
								</tr>

							</table>


					</div>

					</form>

				</div>


				<div class=row id=tbody_imp_vouchers></div>




				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modal Header</h4>
							</div>
							<div class="modal-body">
								<p>This is a large modal.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>






			<?php
			}


			public static function show_recoupment_imprest_form()
			{ ?>



				<?php

				$emp_code = $_SESSION[user_name];
				$emp_office_code = $_SESSION[office_code];
				$head = "<i class=float-right>Balance</i>";

				?>

				<!-- <h1 style="color:red">Application under maintenance for this section . please call before using this section</h1> -->
				<div class=row>

					<div class="col-sm-4 col-sm-offset-4 well">



						<div class="panel panel-info">
							<div class="panel-heading"><?php echo $head; ?></div>
							<div class="panel-body">
								<div id=alert_balance role="alert"></div>
								<table class="table table-bordered table-stripped table-hovered" style="width:100%;margin:0">
									<!-- <tr>
		  		<td>Balance as per ARU Accounts</td><td id=td_balance_at_aru><?php  //echo self::getAruBalance();  
																				?></td>
		  
	  		</tr> -->

									<?php
									if ($_SESSION[location_code] != 411) {
										echo "<tr>";
										$qry = "select * from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and type='cash_in_hand'";

										//print_r($_SESSION);
										//echo $qry;
										$db = new DBAccess;
										$row = $db->SelectData($qry);
										if ($row[EOF] == 1) {

											$display_up++;

											//print_r($_SESSION);
											?>
											<div class=row id=div_cash_in_hand>
												<div class=col-sm-12>
													<label class=text-danger>Enter The Cash In Hand </label>
													<input type=text class='form-control' id=txt_cash_in_hand>
													<label class=text-danger>Date on which Cash in hand is Given above </label>

													<?php echo imprestN::datePicker("txt_date_of_cash_in_hand", "txt_date_of_cash_in_hand", ""); ?>


													<button class='btn  btn-lg btn-success' id=btn_save_cash_in_hand>Save Cash in Hand</button>
												</div>
											<?php
											}
										}
										?>
									</div>



									</tr>

									<tr>
										<td>Balance as Live</td>
										<td id=div_abstract></td>

									</tr>

								</table>


							</div>
						</div>




					</div>


					<style>
						table td {
							width: auto !important;
						}
					</style>
					<div class="col-sm-12 well">
						<form id=form1>
							<table class="table table-stripped table-bordered">


								<tr class="text-success lead">
									<td>Bill No/Invoice Number</td>
									<td>
										<input type=text name=txt_voucher_num id=txt_voucher_num class="form-control"></td>
									<td>Paid To</td>
									<td><input type=text name=txt_paid_to id=txt_paid_to class="form-control"></td>
								</tr>

								<tr class="text-success lead">
									<td>Date of Payment</td>
									<td><?php
										/// getting the date of first voucher and making the month of payment upper and lower 


										$qry = "Select max(date_of_payment) as date1 from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and voucher_status=1";

										$db = new DBAccess;
										//echo $qry;
										$row1 = $db->SelectData($qry);
										$row = $row1[0];
										$date1 = $row[date1];
										//echo $date1;



										echo self::datePicker("txt_date_of_payement", "txt_date_of_payement", ""); ?></td>



									<td>Date of Voucher </td>
									<td><?php echo self::datePicker("txt_date_of_voucher", "txt_date_of_voucher", ""); ?></td>
								</tr>

								<tr class="text-success lead">
									<td>Amount</td>
									<td>

										<input type=text name=txt_amount_imprest id=txt_amount_imprest class="form-control"></td>



									<td>Account Head</td>


									<td>
										<?php

										include_once("./../class/transHeads.class.php");
										global $ttype;
										global $loccode;

										$qry = "select  distinct(acc_head),acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


					trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

										self::select($qry, "acc_code", "acc_head", "item_acc_head", "item_acc_head", 0);


										//print_r($result);
										?>



									</td>

								</tr>


								<tr class="text-success lead">
									<td>
										<span class='fa fa-bell text-danger'>&nbsp;Auto Description</span>&nbsp;<input checked='checked' type=checkbox id=chk_auto_description>
										&nbsp;Description


									</td>
									<td colspan=3><textarea name=txt_description_imprest id=txt_description_imprest class="form-control"></textarea></td>
								</tr>





								<tr class="text-success lead">
									<td>Upload Voucher</td>
									<td colspan=3><input type=file id=data_of_purchase name=data_of_purchase></td>
								</tr>





								<tr class="text-success lead text-center">

									<td colspan=2><button disabled=disabled class="btn btn-success" id=btn_bill>Submit Voucher</button></td>
									<td colspan=2><button class="btn btn-warning" type=button id=btn_show_imprest_vouchers>View imprest Vouchers</button></td>
								</tr>

							</table>


					</div>

					</form>

				</div>


				<div class=row id=tbody_imp_vouchers></div>




				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modal Header</h4>
							</div>
							<div class="modal-body">
								<p>This is a large modal.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>






			<?php
			}

			public static function attach_supporting_doc()
			{

				?>


				<button type="button" class="btn btn-primary"> &nbsp;<span></span> Add Supporting Documents</button>

				<table>
					<tr>


					</tr>

				</table>

			<?php




			}


			public static function select($qry, $option, $key, $selid = "sel_id", $sel_name = "sel_name", $selected = 0, $disabled = "")
			{

				$db = new DBAccess;
				$row = $db->SelectData($qry);


				echo "<select $disabled name=$sel_name id=$selid class=form-control>";

				echo "<option value=0>Select</option>";
				foreach ($row as  $rw) {



					if ($selected == $rw[$option]) {
						$sel = "selected=selected";
					} else $sel = "";

					echo "<option $sel value=$rw[$option] >$rw[$key]</option>";
				}

				echo "</select>";
			}


			public static function select2key($qry, $option, $key1, $key2, $selid = "sel_id", $sel_name = "sel_name", $selected = 0, $disabled = "", $class = 'form-control', $style = "")
			{

				$db = new DBAccess;
				$row = $db->SelectData($qry);

				//echo "hrere";


				echo "<select  name=$sel_name id=$selid class=$class style=$style >";

				echo "<option value=0>Select</option>";
				foreach ($row as  $rw) {



					if ($selected == $rw[$option]) {
						$sel = "selected=selected";
					} else $sel = "";

					echo "<option $sel value=$rw[$option] >$rw[$key2]-$rw[$key1]</option>";
				}

				echo "</select>";
			}







			public static function show_error($msg)
			{

				?>

				<div class="alert alert-danger" role="alert"><?php echo $msg; ?> </div>



			<?php


			}


			public static function show_success($msg)
			{

				?>

				<div class="alert alert-success" role="alert"><i class="fa fa-check fa-3x" style="color:green"></i><?php echo $msg; ?> </div>



			<?php


			}


			public static function show_alert($msg, $class = "alert alert-danger")
			{



				echo "<div class='$class' role=\"alert\">$msg</div>";
			}

			public static function show_alert1($msg, $class = "alert alert-danger")
			{



				return "<div class='$class' role=\"alert\">$msg</div>";
			}


			/*
	public static function findFinancialYear($date)
	
{
						if (!empty ($date))
						{
						
						if (date('m',strtotime($date)) <= 3) 	{//Upto march
														$financial_year = (date('Y',strtotime($date))-1) . '-' . date('Y',strtotime($date));
													
													
													
													} else {//After march
																$financial_year = date('Y',strtotime("$date")) . '-' . (date('Y',strtotime($date)) + 1);
															}
						//echo $financial_year;
						return $financial_year;
					}
					else return null;
	
	}	
	
	
	
*/
		}





		?>