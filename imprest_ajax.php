<?php
session_start();
//print_r($_SESSION);
//echo "this is loccode".$loccode;
//if($_SESSION[aquired]==1 or $_SESSION[user_name]==1064767 ) //maintanace
if (1) //maintanace
{


	if ($_SESSION[logged_in] == 1) {
		//echo "this s logged in $_SESSION[logged_in]";

		$date = date("Y-m-d");
		?>



		<?php
		//print_r($_POST);
		//include_once("head.php");
		//include_once("common.class.php");
		include_once("imprest.class.php");

		$impOpn = array(
			"1" => "Requested for Permanant Imprest",
			"2" => "Requested for Temporary Imprest",
			"11" => "Forwarded Permanant imprest Request to Higher office ",
			"21" => "Forwarded Temporary imprest Request to Higher office ",
			"12" => "Return Permanat imprest Request to Lower  office ",
			"22" => "Return Temporary imprest Request to Lower  office ",
			"13" => "verified the Permanant Imprest Request ",
			"23" => "verified the Temporary Imprest Request ",
			"15" => "Passed permanant Imprest  ",
			"25" => "Passed Temporary Imprest  ",
			"16" => "Close Permanant Imprest  ",
			"17" => "Close Temporary Imprest  "



		);



		//echo "<h2>test</h2>";

		//print_r($_SESSION);



		switch ($_POST["option"]) {


case "del_remitance_details":
$date = date("Y-m-d");
						//$date=date("2019-03-31");
$fy = imprestN::findFinancialYear($date);
$qry="delete from a_imprest_voucher where type='remitance' and imp_fy='$fy' 
and imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and voucher_status=1";

//echo $qry;

		$db=new DBAccess;
		
		$db->DBbeginTrans();
		
		$result=$db->UpdateData($qry);

		
			if($result['EOF'])
		{	
			
			$db->DBrollBackTrans();
			return $result;
		}
		$db->DBcommitTrans();

break;


case "btn_show_div_history_classic":
imprestN::getHistoryClassic($_POST[imprest_id_ref]);
break;
case "btn_show_div_history_official":

//print_r($_POST);
imprestN::getHistoryOfficial($_POST[imprest_id_ref]);
break;



			case "save_imp_setting":

				$object = $_POST['object'];
				$attrib = $_POST['attrib'];
				$value = $_POST['value'];

				$qry = "select * from a_imp_settings where object='$object' and attrib=$attrib";

				//echo $qry;
				$db = new DBAccess;
				$row = $db->SelectData($qry);


				//$db=new DBAccess;

				if ($row[EOF] == 1) {


					// insert

					$qry = "insert into a_imp_settings (object,attrib,value) values ('$object',$attrib,$value)";
					$db = new DBAccess;
					$result = $db->UpdateData($qry);

					if ($result['EOF']) {
						$result['adl_msg1'] = "Insert into a_imprest failed";
						$result['err'] = $result['err'] + 1;
						$db->DBrollBackTrans();
						return $result;
					}

					$db->DBcommitTrans();
				} else {
					//update



				}


				break;



				case "btn_create_landing_rule":
?>
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
					<tr class="clone_landing">
						<td>1</td>
						<td><?php imprestN::select_from_office(); ?></td>
						<td>
							<select name=type class="imp_type form-control" id="">
							
							<option value="0">select</option>
							<option value="P">Fresh Request</option>
							<option value="V">Recoupment</option>
							<option value="VC">Final Closing</option>
						
						
						</select>
						</td>
						<td>
						<?php
					//	imprestN::GetSectionsTransType(104,"","");
						//imprestN::GetSectionsTransTypeWithPrivillage("cmbsec",104,3,"");
						imprestN::GetSections("cmbsec");
						?>	
						</td>
						
			<td>
			
			
			<button type="button" data-office_code='<?php echo $_SESSION[office_code];?>' class="btn btn-success btn_save_imprest_landing">Save</button>
			
			</td>
			<td>
			
			
			<button type="button" class="btn btn-danger">Delete</button>
			
			</td>
			
			
			
					</tr>
				
				
				</tbody>
			</table>
			<?php
			
				break;


			case "btn_save_imprest_landing":

				/// check insertted

print_r($_POST);

				$to_office=$_POST[to_office];
				$from_office=$_POST[from_office];
				$to_branch=$_POST[to_branch];
				$imp_type=$_POST[imp_type];


				switch ($imp_type){


					case 'P':

					break;
					
					case 'V':
					$imp_operation=191;

					break;
					case 'VC':
					$imp_operation=191;
					break;



				}
				$qry = "select * from a_imprest_landing where 
				 from_office=$from_office and to_office=$to_office and imp_type='$imp_type'"; //from_branch=$from_branch and
				$db = new DBAccess;
				$row = $db->SelectData($qry);
				if ($row[EOF] == 1) {



					$qry = "insert into a_imprest_landing (from_office,to_branch,to_office,imp_operation,imp_type)
		values($from_office,$to_branch,$to_office,$imp_operation,'$imp_type'
			)
		";


					// insert
				} else {



					//update

					$qry = "update a_imprest_landing set
to_branch=$to_branch
where
from_office=$from_office and
to_office=$to_office and
imp_type='$imp_type'
";
				}
echo $qry;
				$result = $db->UpdateData($qry);

				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into a_imprest failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}

				$db->DBcommitTrans();



				//delete


				break;





			case "btn_show_settings":
				echo $_SESSION[higher_office_code] . "<br>";
				echo $_SESSION[office_code];
				?>



			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Do not Use this section now</strong> under develeopemnt
			</div>


			<ul class="list-group">
				<li class="list-group-item">


					<div class="row">

						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							Inward landing

						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">




							<?php
							//atrib 1== landing page
							$qry = "select * from a_imp_settings where object='$_SESSION[office_code]' and attrib=1";
							$db = new DBAccess;
							$row = $db->SelectData($qry);


							//$db=new DBAccess;

							if ($row[EOF] == 1) {

								$landing = "";
							} else {
								//$row1=$row[0];
								$landing1 = $row[0];
								$landing = $landing[value];
							}
							//echo $qry;
							$db = new DBAccess;


							$qry = "select branch,branch_Id from vw_office_setup where office_code='$_SESSION[office_code]'  and is_live";

							//echo $qry;
							$db = new DBAccess;



							//echo $qry;
							$row = $db->SelectData($qry);


							if ($row[EOF] == 1) {

								$nop = "";
							} else {
								//print_r($row);

								echo "<select id=sel_branch_landing disabled=disabled class='form-control'>";
								echo "<option id=0>Head of Office</option>";
								foreach ($row as $r1) {
									if ($r1[branch_id] == $landing) {
										$selected = "Selected=selected";
									} else {
										$selected = "";
									}

									echo "<option $selected id=$r1[branch_id]>$r1[branch]</option>";
								}
								echo "</select>";
							}


							?>
						</div>



						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<button data-office_id='<?php echo $_SESSION[office_code]; ?>' id=btn_edit_landing class='btn btn-danger'>Edit</button>
						</div>

					</div>


				</li>
				<li class="list-group-item">

					<ul class="list-inline">
						<li class="list-inline-item">Phone</li>
						<li class="list-inline-item">

							<?php

							$qry = "select * from a_personal_contacts where empcode=$_SESSION[user_name]";
							$row = $db->SelectData($qry);


							if ($row[EOF] == 1) {

								$phone = "";
							} else {

								echo '


<div class="input-group">
	<input type="text" class="form-control" id="txt_phone" placeholder="Enter Phone">
	<span class="input-group-btn">
		<button type="button" class="btn btn-danger">Go!</button>
	</span>
</div>



';
							}
							?>


						</li>
						<li class="list-inline-item">
							<button class='btn btn-danger'>Edit</button>

						</li>
					</ul>


				</li>
				<li class="list-group-item">
					<span class="badge">15</span>
					Item 3
				</li>
			</ul>



			<?php


			break;



		case "show_related_correspondences":

			$imprest_num = $_POST[imprest_id_ref];
			?>

			<div class="container">

				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php

						// $qry="select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
						// where imprest_num='$imprest_num' and imp_file_category='V'  order 
						// by  date_of_payment,upload_time desc

						// ";

						// 		imprestN::show_carosal_out_box("id_carosal",$qry); 
						?>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php

						// $qry="select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
						// where imprest_num='$imprest_num' and aif.imp_file_category='V' order 
						// by  date_of_payment,upload_time desc

						// ";
						// 		//echo $imprest_num;
						imprestN::getHistory($imprest_num);
						?>

					</div>

				</div>

			</div>


			<?php
			break;

		case "show_send_voucher":

			$imprest_num = $_POST[imprest_id_ref];
			?>

			<div class="container">

				<div class="row">

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php

						$qry = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where imprest_num='$imprest_num' and imp_file_category='V'  order 
by  date_of_payment,upload_time desc

";

						imprestN::show_carosal_out_box("id_carosal", $qry);
						?>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php

						$qry = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where imprest_num='$imprest_num' and aif.imp_file_category='V' order 
by  date_of_payment,upload_time desc

";
						//echo $imprest_num;
						imprestN::show_imprest_cash_book($imprest_num);
						?>

					</div>

				</div>

			</div>


			<?php
			break;




		case "sel_office":
			$qry = "select * from vw_office_setup where office_code='$_POST[office_code]'  and is_live
		
		
		
		order by office_name";

			//echo $qry;
			$db = new DBAccess;

			$row1 = $db->SelectData($qry);
			if ($row1['EOF']) {

				exit;
			} else {
				?>

				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">List of offices</div>
					<div class="panel-body">
						<p>Select the Role</p>
					</div>

					<!-- Table -->
					<table class="table">
						<thead>
							<tr>
								<th>LOC CODE</th>

								<th>BRANCH</th>

								<th>OFFICE-ID</th>
								<th>OFFICE NAME</th>

								<th>BRANCH ID</th>
								<th>Employee code</th>

								<th>NAME OF EMPLOYEE</th>
								<th>DESIGNATION</th>

								<th>Select</th>
							</tr>
						</thead>
						<tbody>
							<?php


							//print_r($row1);
							foreach ($row1 as $rw1) {
								echo "<tr>";
								echo "<td>$rw1[LOC_CODE]</td>";
								echo "<td>$rw1[branch]</td>";
								echo "<td>$rw1[office_id]</td>";
								echo "<td>$rw1[office_name]</td>";
								echo "<td>$rw1[branch_id]</td>";
								echo "<td>$rw1[user_name]</td>";
								echo "<td>$rw1[entity_name]</td>";
								echo "<td>$rw1[designation]</td>";
								//echo "<td>$rw1[str_appln]</td>";
								echo "<td><button class='btn btn-danger span_aquire_session' id=$rw1[id]>Select</button></td>";
								echo "</tr>";
							}
							?>

						</tbody>
					</table>
				</div>




				</table>
			<?php
		}
		break;
	case "span_list_sessions_for_aquiring":
		$qry = "select * from vw_office_setup where user_name='$_POST[empcode]'  and is_live";
		$db = new DBAccess;

		$row1 = $db->SelectData($qry);
		if ($row1['EOF']) {

			exit;
		} else {
			?>

				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">List of Roles</div>
					<div class="panel-body">
						<p>Select the Role</p>
					</div>

					<!-- Table -->
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>OFFICE</th>

								<th>BRANCH</th>

								<th>Designation</th>

								<th>Application</th>

								<th>Select</th>
							</tr>
						</thead>
						<tbody>
							<?php


							//print_r($row1);
							foreach ($row1 as $rw1) {
								echo "<tr>";
								echo "<td>$rw1[id]</td>";
								echo "<td>$rw1[office_name]</td>";
								echo "<td>$rw1[branch]</td>";
								echo "<td>$rw1[designation]</td>";
								echo "<td>$rw1[str_appln]</td>";
								echo "<td><button class='btn btn-danger span_aquire_session' id=$rw1[id]>Select</button></td>";
								echo "</tr>";
							}
							?>

						</tbody>
					</table>
				</div>




				</table>
			<?php
		}
		break;





	case "span_aquire_session":

		$qry = "select * from vw_office_setup where id='$_POST[id]'  and is_live";
		$db = new DBAccess;

		$row1 = $db->SelectData($qry);
		if ($row1['EOF']) {

			exit;
		} else {
			$row = $row1[0];

			// print_r($row);
			$_SESSION[branch] = "$row[branch]";
			$_SESSION[branch_id] = "$row[branch_id]";
			$_SESSION[designation] = "$row[designation]";
			$_SESSION[designation_id] = "$row[designation_id]";
			$_SESSION[full_name] = "$row[entity_name]";
			$_SESSION[location_code] = "$row[loc_code]";
			$_SESSION[office_code] = "$row[office_code]";
			$_SESSION[office_name] = "$row[office_name]";
			$_SESSION[previlege] = "$row[previlege]";
			$_SESSION[previlege_id] = "$row[previlege_id]";
			$_SESSION[user_id] = "$row[user_id]";
			$_SESSION[user_name] = "$row[user_name]";

			$_SESSION[appln] = "$row[appln]";
			$_SESSION[aru_code] = "$row[aru_code]";

			$_SESSION[fun_type] = "$row[fun_type] ";
			$_SESSION[higher_office_code] = "$row[higher_office_code]";
			$_SESSION[is_head_of_office] = "$row[is_head_of_office]";
			$_SESSION[is_view_previlege] = "$row[is_view_previlege]";

			$_SESSION[no_of_roles] = "$row[no_of_roles]";
			$_SESSION[office_id] = "$row[office_id]";
			$_SESSION[officetype_id] = "$row[officetype_id]";
			$_SESSION[offtype_4_menu] = "$row[offtype_4_menu]";
			$_SESSION[pid] = "$row[pid]";
			$_SESSION[sbu_prefix] = "$row[sbu_prefix]";
			//$_SESSION[SERVER_NAME] ="$row[SERVER_NAME]";
			$_SESSION[str_appln] = "$row[str_appln]";

			$_SESSION[user_status] = "$row[user_status]";
			$_SESSION[view_aru] = "$row[view_aru]";


			$_SESSION[aquired] = 1;

			?>

				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Title!</strong>
					<span class="fa fa-angle-double-left"> Acquired successfully <?php echo $row[branch] . $row[designation_id] . $row[office_name] ?></span>

				</div>
			<?php
		}
		break;


	case 'btn_show_super_admin':
		// print_r($_SESSION);
		?>
			<div class="container">

				<div class="row">




					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

						<div class='panel panel-yellow'>
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-tasks fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="" style="font-size: 15px;">SEARCH office</div>
										<div>OFFICES</div>
									</div>
								</div>
							</div>

							<div class="panel-footer">
								<span class="pull-left">



									<?php
									$qry = "select distinct(office_name) ,office_code from vw_office_setup 
								
								
								where is_live  /*and loc_code in (102,204,219,310,411,421,802,957)*/ order by office_name 
								";

									$db = new DBAccess;
									$row = $db->SelectData($qry);
									?>

									<div class="form-group">

										<div class="col-sm-10">




											<input required="required" type=textarea id="txt_search_office" />
											<button id="btn_clear_sell" class="btn btn-danger">Clear</button>
											<div id="suggesstion-box1"></div>

											<select id=ofc_fil>

												<option value='Select'>Select</option>
												<option value='Section'>Section</option>
												<option value='Division'>Division</option>
												<option value='Sub Division'>Sub Division</option>
												<option value='circle'>Circle</option>

											</select>


											<select name="" id="sel_office" class="form-control ">
												<?php
												echo '<option value="0">-- Select One --</option>';
												foreach ($row as $rw) {


													echo "<option value=$rw[office_code]>$rw[office_name]</option>";
												}
												?>

											</select>
										</div>
									</div>





								</span>
								<span class="pull-right"><button id=span_list_sessions_for_aquiring class=" fa fa-arrow-circle-right fa-3x text-primary"></button></span>
								<div class="clearfix"></div>
							</div>

						</div>

					</div>



				</div>
			</div>



			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				Voucher Edit
				<div class='panel panel-success'>
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="" style="font-size: 15px;">Employee</div>
								<div>Search Employee</div>
							</div>
						</div>
					</div>

					<div class="panel-footer">
						<span class="pull-left">

							<button id=btn_report_total_aru class=' btn '>
								Show Imprest<br> Expense of<br>
								Division by <br> Account Head</button>

						</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
						<div class="clearfix"></div>
					</div>

				</div>

			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				V to VC
				<div class='panel panel-success'>
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="" style="font-size: 15px;">ABSTRACT</div>
								<div>DIVISION ABSTRACT</div>
							</div>
						</div>
					</div>

					<div class="panel-footer">
						<span class="pull-left">

							<button id=btn_report_total_aru class=' btn '>
								Show Imprest<br> Expense of<br>
								Division by <br> Account Head</button>

						</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
						<div class="clearfix"></div>
					</div>

				</div>

			</div>


			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">


				<button type="button" id=btn_send_alert_sms class="btn btn-danger">SEND ALERT SMS</button>

			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">


				<button type="button" id=btn_alert_pending_sms_to_feild class="btn btn-warning">SEND ALERT SMS to FEILD 2 DAYS</button>

			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">


				<button type="button" id=btn_show_pending_action class="btn btn-info">SHOW PENDING ACTIONS</button>

			</div>



			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

				<div class='panel panel-success'>
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="" style="font-size: 15px;">Aquire session</div>
								<div>DIVISION ABSTRACT</div>
							</div>
						</div>
					</div>

					<div class="panel-footer">
						<span class="pull-left">

							<input type="text" class='form-control ' id="text_empcode">

							<?php
							$qry = "select distinct(imp_holder),ename,imp_holder_office,o.name from v_bills_with_name
								vb inner join offices o on o.code=vb.imp_holder_office and vb.imp_holder_office<>'' order by ename
								";


								//echo $qry;
							$db = new DBAccess;
							$row = $db->SelectData($qry);
							?>

							<div class="form-group">

								<div class="col-sm-10">
									<select name="" id="sel_empcode" class="form-control ">
										<?php
										echo '<option value="0">-- Select One --</option>';
										foreach ($row as $rw) {


											echo "<option value=$rw[imp_holder]>$rw[ename] of $rw[name]</option>";
										}
										?>

									</select>
								</div>
							</div>





						</span>
						<span class="pull-right"><button id=span_list_sessions_for_aquiring class=" fa fa-arrow-circle-right fa-3x text-primary"></button></span>
						<div class="clearfix"></div>
					</div>

				</div>

			</div>



			</div>

			</div>
			<?php
			break;


		case "txt_search_office":
			?>
			<style>
				.frmSearch {
					border: 1px solid #F0F0F0;
					background-color: #CCFFFF;
					margin: 2px 0px;
					padding: 40px;
				}

				#country-list {
					float: left;
					list-style: none;
					margin: 0;
					padding: 0;
					width: 190px;
				}

				#country-list li {
					padding: 10px;
					background: #FAFAFA;
					border-bottom: #F0F0F0 1px solid;
				}

				#country-list li:hover {
					background: #F0F0F0;
				}

				<?php echo '#' . $_POST[sugBox] . '';

				?> {
					padding: 10px;
					border: #F0F0F0 1px solid;
				}
			</style>
			
			<script>
				function
				selectContractor(val) {

					$(<?php echo '"#' . $_POST[inp] . '"'; ?>).val(val);
					$(<?php echo '"#' . $_POST[sugBox] . '"'; ?>).hide();
				}
			</script>
			<ul id="country-list">
				<?php

				//$mod = new models;//
				//echo "below is session <br>";

				$qry = "select * from offices o inner join office_details od on od.office_id=o.id where upper(name) 
	like upper('%$_POST[name]%') order by name asc";
				//echo $qry;
				$db = new DBAccess;
				$rs = $db->SelectData($qry);
				//echo $qry;	
				?>


				<?php
				/////$row["attribute_value"]="balakrishnan contractor";
				foreach ($rs as $row) {
					?>

					<li onClick="selectContractor('<?php echo $row["name"]; ?>');"><?php echo $row["name"]; ?></li>
					<!-- <li id=li><?php echo $row["nameofrmu"]; ?> </li>-->


					<?php
					$i++;
				} ?>
			</ul>
			<?php

			break;




		case "show_voucher":
			$imp_voucher_id = $_POST[id];
			$qry = "select * from a_imprest_files where imp_voucher_id=$imp_voucher_id and imp_file_category='V'";

			$db = new DBAccess;

			$row = $db->SelectData($qry);
			if ($row['EOF']) {
				$row['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				//return $result;

				$msg = "No Vouchers Found";
				imprestN::show_error($msg);
			} else {

				$row1 = $row[0];

				$source = $row1[imp_file];
				?>

				<div class="well ">

					<img src='<?php echo "$source";  ?>' class="img-responsive" alt=" Image" height="500" width="568" style="width:568px;height:500px;">

				</div>
			<?php

		}

		break;




	case "btn_report_show_passed_amount":

		//exit;

		//$_POST[user_name]=$_SESSION[user_name];
		$imprest_holder = $_POST[user_name];
		$imprest_holder_office = $_POST[office_code];
		$qry = "select * from v_passed_amount where imp_holder='$imprest_holder' and imp_holder_office='$imprest_holder_office' 
	order by imp_date,date_of_payment, imp_voucher_id desc
	
	";

		//ssssssecho $qry;
		$db = new DBAccess;

		$row = $db->SelectData($qry);
		if ($row['EOF']) {
			$row['adl_msg'] = "Insert into amnt. details failed";
			$db->DBrollBackTrans();
			//return $result;

			$msg = "No Vouchers Found";
			imprestN::show_error($msg);

			exit;
		}



		$sl = 0;
		$imprest_num = "";
		$closing_balance = 0;
		$opening_balance = 0;
		$nth_imprest = 0;

		$recouped_amount = 0;

		$closing = 0;
		foreach ($row as $rw1) {



			if ($imprest_num != $rw1[imprest_num]) {







				if ($sl != 0) {

					$closing_balance = $opening_balance - $expense;

					$cash_in_hand = $opening_balance - $expense;

					echo "</tbody>";
					echo "<tfoot";

					$opening_balance = $closing_balance;
					echo "<tr class=text-success><td colspan=5>Total Expense</td><td>$expense</td></tr>";
					echo "<tr class=text-danger><td colspan=5>Cash in Hand</td><td>$cash_in_hand</td></tr>";
					echo "</tfoot";


					echo "</table>";
					echo "<table  class='table table-stripped table-hover table-condensed myPassedAmount'>";
					// echo "<caption class=bg-primary>"
					// .imprestN::getImprestTilteFromNum($rw1[imprest_num],$rw1[imp_date])
					// ."Imprest File No: $rw1[imprest_num] 	 Total Passed amount :$rw1[total_passed_amount] </caption>";

					// ;

					echo "<caption class=bg-primary>";
					imprestN::getImprestTilteFromNum($rw1[imprest_num], $rw1[imp_date]);

					echo "<br><br>Imprest File No:  $rw1[imprest_num]	 <br> <br>
	
	<span class='bg-info text-danger'>
	Total Passed amount :$rw1[total_passed_amount]
	</span>
	
	</caption>";
				}

				if ($nth_imprest == 0) {


					if ($sl == 0) {
						echo "<table  class='table table-stripped table-hover table-condensed myPassedAmount'>";


						echo "<caption class=bg-primary>";
						imprestN::getImprestTilteFromNum($rw1[imprest_num], $rw1[imp_date]);

						echo "<br><br>Imprest File No:  $rw1[imprest_num]	 <br> <br>
	
	<span class='bg-info text-danger'>
	Total Passed amount :$rw1[total_passed_amount]
	</span>
	
	</caption>";
					}


					$fresh_issued_amount = imprestN::getImprestequestedInFy($imprest_holder, $imprest_holder_office);

					//echo "<tr><td colspan=6>Closing balance=$closing_balance</td></tr>";
					//echo "</tbody>";
					$opening_balance = $fresh_issued_amount;
				} else {


					if ($type == "VC") {

						$opening_balance = $cash_in_hand;
					} else {
						$opening_balance = $cash_in_hand + $recouped_amount;
					}
				}


				//echo "<tr class='bg-warning'><td colspan=6>Imprest File No: $rw1[imprest_num] 	 Total Passed amount :$rw1[total_passed_amount] </td> </tr>";
				$imprest_num = $rw1[imprest_num];
				$sl = 0;
				$expense = 0;


				echo "<thead>";
				echo "<th>Date of Payment</th>";
				echo "<th>Sl No</th>";

				echo "<th>Particulars <br> of Transaction</th>";
				echo "<th>Received Amount</th>";
				echo "<th>Voucher Amount</th>";
				echo "<th>Passed Amount</th>";

				//echo "<th>Total Passed Amount</th>";
				echo "<th>ARU Comment</th>";

				//echo "<tr class='bg-warning text-warning text-center'><td colspan=7>Imprest File No: $rw1[imprest_num] 	 Total Passed amount :$rw1[total_passed_amount] </td> </tr>";

				if ($nth_imprest != 0) {
					echo "<tr class=' text-primary'><td colspan=3>Opening Cash in hand  	 </td> <td>$cash_in_hand  </td> <td></td> <td></td> <td></td> </tr>";

					if ($type == "VC") {
						echo "<tr class='text-danger'><td colspan=3>Amount Closed  	 </td><td>$recouped_amount </td><td></td> <td></td><td></td>   </tr>";
					} else {

						echo "<tr class='text-success'><td colspan=3>Amount Recouped  	 </td><td>$recouped_amount </td><td></td> <td></td><td></td>   </tr>";
					}
				}
				if ($nth_imprest == 0) {
					echo "<tr class='bg-warning'><td colspan=3>Amount Received by Fresh Issue
		  </td><td>$fresh_issued_amount</td><td>-</td> <td>-</td><td>-</td>  </tr>";


					//echo "<tr class='bg-warning'><td colspan=6>Amount recouped  $recouped_amount	 </td> </tr>";

				}


				echo "</thead>";



				echo "<tbody>";
			}


			$sl++;


			echo "<tr class='show_voucher' id=$rw1[imp_voucher_id]>";

			//echo "<td>$rw1[ename]</td>";

			$date_of_payment = imprestN::yymmddToddmmyy($rw1[date_of_payment]);
			echo "<td>$date_of_payment</td>";
			echo "<td>$sl</td>";
			echo "<td>$rw1[item_desc]</td>";

			echo "<td>0</td>";
			echo "<td>$rw1[amount]</td>";
			echo "<td>$rw1[passed_amount]</td>";
			//echo "<td>$rw1[imprest_num]</td>";
			//echo "<td>$rw1[total_passed_amount]</td>";
			echo "<td>$rw1[comment]</td>";
			echo "</tr>";
			$expense = $expense + $rw1[passed_amount];
			$nth_imprest++;
			$recouped_amount = $rw1[total_passed_amount];


			$type1 = split('/', $rw1[imprest_num]);  //seting type of imprest for newx operation
			$type = $type1[2];  //seting type of imprest for newx operation

			//echo "This is type $type ";

		}


		////////////////for last array  problem//////////

		if ($type == 'VC') {
			$closing_balance = $opening_balance - $expense;

			$cash_in_hand = $opening_balance - $expense;

			echo "</tbody>";
			echo "<tfoot";

			$opening_balance = $closing_balance;
		} else {
			$closing_balance = $opening_balance - $expense;

			$cash_in_hand = $opening_balance - $expense;

			echo "</tbody>";
			echo "<tfoot";

			$opening_balance = $closing_balance;
		}




		echo "<tr class='text-primary'><td colspan=5>Total Expense</td><td>$expense</td><td><td></tr>";
		echo "<tr class='text-danger'><td colspan=5>Cash in Hand</td><td>$cash_in_hand</td><td><td></tr>";
		echo "</tfoot";




		//////////////////////////////////////

		echo "</table>";
		?>
			<script>
				$(document).ready(function() {
					$('.myPassedAmount').DataTable(

						{
							"pageLength": 100
						}
					);
				});
			</script>
			<?php
			break;


		case "check_budget_provision_of_item_acc_code":

			//print_r($_POST);

			$office_id = $_POST[office_id];
			$item_acc_code = $_POST[item_acc_code];

			$date = "2019-04-01";

			include_once('../class/budget.class.php');

			$bud = new Budget;
			$bal = $bud->GetBudgetCurrBalance($office_id, $item_acc_code, $date);


			//print_r($bal);

			$budget_amount = $bal[amount];
			$expenditute_till_now = $bal[expamount];

			$balance = $budget_amount - $expenditute_till_now;
			$stop = 0;
			if ($balance <= 0) {
				$html = "<span class='fa fa-warning' style='color:red' >Balance in this head : $balance</span>";
				$stop++;
			} else {
				$html = "<span class='fa fa-warning' style='color:green' >Balance Available in this head : $balance</span>";
			}


			echo json_encode(array("html" => "$html", "stop" => "$stop", "balance" => "$balance"));
			break;





		case "btn_update_voucher":

			//print_r($_POST);

			$imp_voucher_id = $_POST[voucher_id];
			//$voucher_num=$_POST[voucher_num];

			//$voucher_num=$_POST[voucher_num];


			$voucher_num = str_replace("'", "''", $_POST[voucher_num]);


			//$purpose=$_POST[purpose];

			$purpose = str_replace("'", "''", $_POST[purpose]);


			//$paid_to=$_POST[paid_to];
			$paid_to = str_replace("'", "''", $_POST[paid_to]);
			//$txt_date_of_payement=$_POST[txt_date_of_payement];
			$txt_date_of_payment = imprestN::dmyToyymmdd($_POST[txt_date_of_payment]);
			$txt_date_of_voucher = imprestN::dmyToyymmdd($_POST[txt_date_of_voucher]);
			$txt_amount_imprest = $_POST[txt_amount_imprest];
			$item_acc_head = $_POST[item_acc_head];

			//$txt_description_imprest=$_POST[txt_description_imprest];

			$txt_description_imprest = str_replace("'", "''", $_POST[txt_description_imprest]);



			$qry = "update a_imprest_voucher 
	
	set
	voucher_num='$voucher_num',
	item_desc='$txt_description_imprest',
	amount=$txt_amount_imprest,
	paid_to='$paid_to',
	date_of_voucher='$txt_date_of_voucher',
	date_of_payment='$txt_date_of_payment',
	item_acc_code='$item_acc_head',
	purpose='$purpose'
	
	where imp_voucher_id=$imp_voucher_id returning *";

			//echo $qry;

			$db = new DBAccess;

			$result = $db->UpdateDataAndReturn($qry);
			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;
			}


			$row = $result['data'][0];

			?>


			<table class="table table-stripped table-bordered">
				<th colspan=4 class="bg-waning text-center text-primary"> VOUCHER DETAILS</th>
				<tr class=" text-info lead">
					<td class="bg-warning text-info lead">Voucher Date</td>
					<td id=td_voucher_date>
						<?php

						$date_of_voucher = imprestN::yymmddToddmmyy($row[date_of_voucher]);
						echo $date_of_voucher;

						?>


					</td>
					<td class="text-info lead bg-warning">Date of payment</td>
					<td id=td_voucher_payment_date>

						<?php

						$date_ofpayment = imprestN::yymmddToddmmyy($row[date_of_payment]);
						echo $date_ofpayment;

						?>

					</td>
				</tr>


				<tr class="text-info lead">
					<td class="text-info lead bg-warning">Voucher No</td>
					<td id=td_voucher_num>
						<?php echo $row[voucher_num]; ?>

					</td>
					<td class="text-info lead bg-warning">Paid to</td>
					<td id=td_voucher_paid_to>
						<?php echo $row[paid_to]; ?>

					</td>
				</tr>


				<tr class="text-info lead">
					<td class="bg-warning text-info lead">Amount</td>
					<td id=td_voucher_amount>

						<?php echo $row[amount]; ?>

					</td>
					<td class="text-info lead bg-warning">Account Head</td>
					<td id=td_voucher_acc_head>
						<?php echo $row[item_acc_code]; ?>

					</td>
				</tr>
				<tr class="text-info lead">
					<td class="text-info lead bg-warning">Description</td>
					<td colspan=3 id=td_voucher_Desc>
						<?php echo $row[item_desc]; ?>

					</td>
				</tr>




				<tbody id=tbody_delete_voucher>

					<tr>

						<td colspan=2 class="bg-danger text-center"><button name='<?php echo $imp_voucher_id; ?>' class="btn btn-danger" id=btn_del_voucher>

								<span class="fa fa-trash fa-lg"></span>&nbsp;

								Delete</button></td>


						<td colspan=2 class="bg-success text-center"><button name='<?php echo $imp_voucher_id; ?>' class="btn btn-primary shadow" id=btn_edit_voucher>

								<span class="fa fa-pencil-square-o fa-lg"></span>&nbsp;

								Edit</button></td>


					</tr>

				</tbody>


			</table>


			<!--
	
				<table class="table table-stripped table-bordered">
				
				
							<tr class="text-success lead"><td>Voucher No/Bill No </td><td >
								<input type=text value='<?php echo $row[voucher_num] ?>' name=txt_voucher_num id=txt_voucher_num class="form-control"></td>
							<td>Paid To</td><td><input type=text name=txt_paid_to id=txt_paid_to class="form-control"   value='<?php echo $row[paid_to] ?>'></td></tr>
				
							<tr class="text-success lead">
								<td>Date of Payment</td><td><?php

															$date_ofpayment = imprestN::yymmddToddmmyy($row[date_of_payment]);

															echo imprestN::datePicker("txt_date_of_payement", "txt_date_of_payement", $date_ofpayment); ?></td>
							<td>Date of Voucher </td><td><?php

															$date_of_voucher = imprestN::yymmddToddmmyy($row[date_of_voucher]);
															echo imprestN::datePicker("txt_date_of_voucher", "txt_date_of_voucher", $date_of_voucher); ?></td></tr>
				
							<tr class="text-success lead"><td>Amount</td><td>
					
								<input value='<?php echo $row[amount] ?>' type=text name=txt_amount_imprest id=txt_amount_imprest class="form-control"></td>
				
				
				
							<td>Account Head</td>
				
				
							<td>
								<?php

								include_once("./../class/transHeads.class.php");
								global $ttype;
								global $loccode;

								$qry = "select  distinct(acc_head),acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


					trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

								imprestN::select($qry, "acc_code", "acc_head", "item_acc_head", "item_acc_head", $row[item_acc_code]);


								//print_r($result);
								?>
					
					
					
								</td>
					
								</tr>
				

								<tr><td colspan=2><input id=txt_purpose type=text name=purpose value="<?php echo $row[purpose]; ?>" ></td></tr>
				
					<tr class="text-success lead"><td >Description</td><td colspan=3>
			
						<textarea name=txt_description_imprest id=txt_description_imprest class="form-control">
						<?php echo $row[item_desc]; ?>
						</textarea></td></tr>

				<tr><td colspan=4 class='text-center'><button name='<?php echo $row[imp_voucher_id]; ?>' class='btn btn-info ' id=btn_update_voucher>
					<span class="fa fa-refresh fa-lg"></span>&nbsp;
		
					Update</button></td></tr>
	
				-->
			<?php




			break;





		case "btn_edit_voucher":

			$voucher_id = $_POST[voucher_id];
			$qry = "select * from a_imprest_voucher where imp_voucher_id=$voucher_id";

			$db = new DBAccess;
			$row1 = $db->SelectData($qry);
			$row = $row1[0];
			//print_r($row);

			?>
			<table class="table table-stripped table-bordered">


				<tr class="text-success lead">
					<td>Voucher No/Bill No </td>
					<td>
						<input type=text value='<?php echo $row[voucher_num] ?>' name=txt_voucher_num id=txt_voucher_num1 class="form-control"></td>
					<td>Paid To</td>
					<td><input type=text name=txt_paid_to id=txt_paid_to1 class="form-control" value='<?php echo $row[paid_to] ?>'></td>
				</tr>

				<tr class="text-success lead">
					<td>Date of Payment</td>
					<td><?php

						$date_ofpayment = imprestN::yymmddToddmmyy($row[date_of_payment]);

						echo imprestN::datePicker("txt_date_of_payement2", "txt_date_of_payement2", $date_ofpayment); ?></td>
					<td>Date of Voucher </td>
					<td><?php

						$date_of_voucher = imprestN::yymmddToddmmyy($row[date_of_voucher]);
						echo imprestN::datePicker("txt_date_of_voucher1", "txt_date_of_voucher1", $date_of_voucher); ?></td>
				</tr>

				<tr class="text-success lead">
					<td>Amount</td>
					<td>

						<input value='<?php echo $row[amount] ?>' type=text name=txt_amount_imprest1 id=txt_amount_imprest1 class="form-control"></td>



					<td>Account Head</td>


					<td>
						<?php

						include_once("./../class/transHeads.class.php");
						global $ttype;
						global $loccode;

						$qry = "select  distinct(acc_head),acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 


					trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

						imprestN::select($qry, "acc_code", "acc_head", "item_acc_head1", "item_acc_head1", $row[item_acc_code]);


						//print_r($result);
						?>



					</td>

				</tr>
				<tr>
					<td>Purpose</td>
					<td colspan=3 class=text-center><input id=txt_purpose class=form-control type=text name=purpose value="<?php echo $row[purpose]; ?>"></td>
				</tr>

				<tr class="text-success lead">
					<td>Description</td>
					<td colspan=3>

						<textarea name=txt_description_imprest id=txt_description_imprest1 class="form-control">
						<?php echo $row[item_desc]; ?>
						</textarea></td>
				</tr>

				<tr>
					<td colspan=4 class='text-center'><button name='<?php echo $row[imp_voucher_id]; ?>' class='btn btn-info ' id=btn_update_voucher>
							<span class="fa fa-refresh fa-lg"></span>&nbsp;

							Update</button></td>
				</tr>

				<?php

				break;







			case "btn_show_reports":

				//ImprestN::send_sms(0,"hi");

				//$office_code1=split("/",$imprest_ref_id);


				// $office_code=$office_code1;
				// $office_code=$_SESSION[office_code];
				// $office_name=imprestN::get_office_name($office_code);
				// $branch_name=imprestN::getBranchNameFromBranchId(0);
				// $desig="AE";
				// $to_branch=1;
				// $msg="Your Imprest Has been forwarded to $to_branch of  $office_name";
				// imprestN::execute_sms ($office_code,$desig,$msg);
				?>

				<style>
					.rep {
						border: 1px outset blue;
						background-color: lightBlue;
						height: 125px;
						width: 125px;
						cursor: pointer;
					}

					.rep:hover {
						background-color: Blue;
						color: white;
					}
				</style>


				<div class=row>
					<div class='col-sm-3' id=btn_report_total_all style="">




						<div class='panel panel-success'>
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-tasks fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="" style="font-size: 15px;">My vouchers and Passed Amount</div>
										<div>ALL Vouchers</div>
									</div>
								</div>
							</div>

							<div class="panel-footer">
								<span class="pull-left">
									<?php
									//print_r($_SESSION);
									if ($_SESSION[office_code] == $_SESSION[aru_code]) {
										$qry = "select distinct(ename),imp_holder,imp_holder_office  from v_bills_with_name vbn
left join (select code,aru_code from offices )o on o.code=vbn.imp_holder_office where aru_code='$_SESSION[aru_code]' order by ename";

										//echo $qry;
										$db = new DBAccess;
										$row = $db->SelectData($qry);
										if ($row[EOF] == 1) {
											echo "No data found";
										} else {
											echo "<select id=sel_imp_holder_for_passed_amount>";
											echo "<option>Select</option>";
											foreach ($row as $rw) {

												echo "<option data-office_code=$rw[imp_holder_office] value=$rw[imp_holder]>$rw[ename] </option>";
											}
											echo "</select>";
										}
									} else {

										?>
										<button id=btn_report_show_passed_amount data-office_code='<?php echo $_SESSION[office_code]; ?>' value='<?php echo $_SESSION[user_name]; ?>' class=' btn btn-primary'>
											Show Voucherst<br>and passed amount<br>
										</button>
									<?php
								} ?>

								</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
								<div class="clearfix"></div>
							</div>

						</div>


						<div class='panel panel-yellow'>
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-tasks fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="" style="font-size: 15px;">Cheques Received</div>

									</div>
								</div>
							</div>
							<div class="panel-footer">
								<span class="pull-left">

									<button id=btn_show_my_cheque class=' btn '>
										Show Cheques<br>Received<br>
									</button>

								</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
								<div class="clearfix"></div>
							</div>

						</div>
					</div>



				</div>




				</div>

				<?php if ($_SESSION[office_code] == $_SESSION[aru_code]) { ?>
					<div class=row>
						<div class='col-sm-3' id=btn_report_total_all style="">




							<div class='panel panel-success'>
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-tasks fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="" style="font-size: 15px;">ABSTRACT</div>
											<div>DIVISION ABSTRACT</div>
										</div>
									</div>
								</div>

								<div class="panel-footer">
									<span class="pull-left">

										<button id=btn_report_total_aru class=' btn '>
											Show Imprest<br> Expense of<br>
											Division by <br> Account Head</button>

									</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
									<div class="clearfix"></div>
								</div>

							</div>










						</div>
					<?php

				} ?>


					<?php if ($_SESSION[office_code] == $_SESSION[aru_code]) { ?>
						<div class='col-sm-3' id=btn_report_total_all style="">


							<div class='panel panel-primary'>
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-search fa-4x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge" style="font-size: 20px;">Search </div>
											<div>Imprest holder Name</div>
										</div>
									</div>
								</div>

								<div class="panel-footer">
									<span class="pull-left">

										<input type=text class='form-control' id=txt_emp_name>

									</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
									<div class="clearfix"></div>
								</div>

							</div>



						</div>

					<?php } ?>


					<div class='col-sm-3' id=div_show_my_imprests style="">


						<div class='panel panel-green'>
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-info-circle fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge" style="font-size: 20px;">MY IMPREST </div>
										<div>Time line</div>
									</div>
								</div>
							</div>

							<div class="panel-footer">
								<span class="pull-left">


									<button class='btn btn-success ' id=btn_show_my_imprest><span class='fa fa-money fa-lg'></span>&nbsp; Time Line</button>

								</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
								<div class="clearfix"></div>
							</div>

						</div>

					</div>


					<?php if ($_SESSION[office_code] == $_SESSION[aru_code]) { ?>
						<div class='col-sm-3' id=div_show_expenditure_time_line style="">


							<div class='panel panel-yellow'>
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-info-circle fa-4x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge" style="font-size: 20px;">Cheque Details </div>
											<div></div>
										</div>
									</div>
								</div>

								<div class="panel-footer">
									<span class="pull-left">

										<input type=text class='form-control list_emp' id=txt_emp_name_exp>
										<span class='fa fa-money fa-lg'></span>&nbsp;ALL <input type=checkbox id=chk_all_emp class='list_emp'>

									</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
									<div class="clearfix"></div>
								</div>

							</div>

						</div>

					<?php } ?>
















				</div>









				<!-- <div class=row>
	
					<div class='col-sm-3' id=div_show_my_imprest_sheets style="">
		 			<div class='panel panel-red'>
					<div class="panel-heading">
                            			<div class="row"> 
                                			<div class="col-xs-3">
                                    			<i class="fa fa-info-circle fa-4x"></i>
                                			</div>
                                			<div class="col-xs-9 text-right">
                                    			<div class="huge" style="font-size: 20px;">My imprest Sheets</div>
                                    			<div></div>
                                			</div>
                            			</div>
                        			</div>
                        
                        			<div class="panel-footer">
                                			<span class="pull-left">
												<?php
												$qry = "select distinct(imprest_num)as ref from a_imprest_voucher /* where imp_holder='$_SESSION[user_name]'*/";
												//echo $qry;
												$db = new DBAccess;
												$row1 = $db->SelectData($qry);
												//$row=$row1[0];

												?>
											<select>
											<option value=0>Select</option>
											<?php
											foreach ($row1 as $row)

												echo "<option>$row[ref]</option>";

											?>
											</select>
								
								
								
			<span class='fa fa-money fa-lg'></span>&nbsp;ALL <input type=checkbox id=chk_all_emp class='list_emp' >
									
												</span>
                                			<span class="pull-right"><i class="fa fa-arrow-circle-right fa-lg"></i></span>
                                			<div class="clearfix"></div>
                            			</div>
                        
                        			</div>
	
				</div>
	
				</div>
	
				</div>
	
	
				</div>
	 			-->




				<?php

				break;





			case "btn_show_my_cheque":

				$qry = "select description,to_char(trans_date,'DD/MM/YYYY') as date1,-amount as amt  from a_imprest_voucher aiv inner join payment_trans  paytn on aiv.imp_voucher_id=paytn.bill_trans_id

	inner join t_master tm on tm.trans_id=paytn.trans_id
	
	 where aiv.type='r' and imp_holder='$_SESSION[user_name]' order by trans_date";

				//echo $qry;
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//print_r($row1);
				if ($row1[EOF] == 1) {

					imprestN::show_error("<span class='fa fa-lg fa-stop-circle'></span>&nbsp;No records");
					exit;
				} else {
					?>


					<ul class="list-group">

						<?php
						foreach ($row1 as $row) {
							echo "
<li class='list-group-item'>
		<span class='badge pull-left'>$row[date1]</span>
	<span class='text-success'>Cheque No</pan> <span class=text-primary>$row[description] </span>
	<span class='text-danger'>Amount</pan> <span class=text-primary>$row[amt] </span>
	</li>
";
						}
						?>


					</ul>


				<?php

			}


			break;



		case "txt_emp_name":


			//print_r($_POST);
			$empname = addslashes($_POST[empname]);
			//$empname=stripslashes($_POST[empname]);


			$qry = "select o.name from_office,b.name,o1.name,b1.name,ename,min()  from a_imprest_operations
 aio inner join offices o on aio.from_office=o.code
 inner join   offices o1 on aio.to_office=o1.code
left join  branch b on aio.from_branch::int=b.id
left join  branch b1 on aio.to_branch::int=b1.id
inner join dl_empl emp on split_part(aio.imprest_id_ref,'/',1)::int=emp.unique_code where ename like ('%$empname%')

and o.location_code='$_SESSION[location_code]'


 order by imprest_op_id;";


			$qry = "select imprest_id_ref,to_char(min(imp_opn_time),'DD Mon YYYY' ) as date1 ,ename,o.name as office  
 
 from a_imprest_operations inner join dl_empl 
  dl on dl.unique_code=split_part(imprest_id_ref,'/',1)::int
 inner join offices o on o.code=split_part(imprest_id_ref,'/',2) where ename like upper('%$empname%')



  group by imprest_id_ref ,ename,o.name,imprest_op_id order by imprest_op_id;";

			$qry = "select imprest_id_ref,to_char(min(imp_opn_time),'DD Mon YYYY' ) as date1 ,ename,o.name as office  
 
 from a_imprest_operations 
inner join dl_empl dl on dl.unique_code=split_part(imprest_id_ref,'/',1)::int 
inner join offices o on o.code=split_part(imprest_id_ref,'/',2) where ename like upper('%$empname%')

and o.aru_code='$_SESSION[aru_code]'
group by imprest_id_ref ,ename,o.name,split_part(imprest_id_ref,'/',5) order by to_char(min(imp_opn_time),'YYYYMMDD' ) desc, split_part(imprest_id_ref,'/',5)";

			//and o.location_code='$_SESSION[location_code]'  
			//echo $qry;

			$db = new DBAccess;
			$row1 = $db->SelectData($qry);
			//print_r($row1);
			if ($row1[EOF] == 1) {

				imprestN::show_error("<span class='fa fa-lg fa-stop-circle'></span>&nbsp;Searched words does not match with Any records");
				exit;
			}

			?>
				<div class="bs-callout bs-callout-success">

					<ul class="list-group">
						<li class=list-group-item>
							<span class='fa fa-user fa-lg text-warning text-center'></span>&nbsp;Matching imprest Files</li>
						<?php
						foreach ($row1 as $row) {
							echo "<li style='cursor: pointer;' id='$row[imprest_id_ref]' class=\"list-group-item list-group-item-info li_emp_name lead\">
	 Imprest of $row[ename] of $row[office] <br> <span class=text-danger>Date $row[date1]</span> 
	 <span class='fa fa-hand-pointer-o fa-lg'></span>
	 
	 </li>";
						}

						?>

					</ul>
				</div>

				<?php

				break;


			case "li_emp_name_exp":

				//print_r($_POST);
				$start_date_of_report = '2018-04-01';
				$end_date_of_report;
				$entity_id = $_POST[entity_id];


				$qry = " select bill_amount,name,net_acc_code,trans_date from payment_trans bt inner join  trans_master tm on bt.trans_id=tm.trans_id 

inner join entities e on e.id=tm.payee::int
where 
tm.trans_type_id=104 and 

tm.payee::int=$entity_id and 

tm.loc_code=$_SESSION[location_code] and
tm.trans_date>'$start_date_of_report' 

order by trans_date";
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//print_r($row1);

				//echo $qry;
				?>
				<div class="bs-callout bs-callout-success">

					<ul class="list-group">
						<li class=list-group-item>
							<span class='fa fa-clock-o fa-lg text-warning text-center'></span>&nbsp;&nbsp;Details of Cheques Issued</li>
						<?php
						foreach ($row1 as $row) {

							//if($row[from_branch]=="")$row[from_branch1]="Head of office";
							//if($row[to_branch]=="")$row[to_branch]="Head of office";

							$class = "list-group-item-success";


							//echo $row[action_pending];
							if ($row[action_pending] == 't') {
								$class = "list-group-item-danger";
								$pending = "<li style='background-color:red'>ACTION PENDING AT $row[to_branch] of $row[to_office] </li>";
							} else {
								$pending = "";
							}




							echo "<li id='$row[unique_code]' class=\"list-group-item $class \">
	 
	<span class='text-success fa fa-calendar fa-lg' >&nbsp;$row[tim]&nbsp;</span>
	<span class=text-danger>$row[trans_date]</span> 
	<span class=text-danger>$row[name]</span> 
	<span class=text-danger>$row[bill_amount]</span>  
	 </li>";

							//echo $pending;

						}

						?>

					</ul>
				</div>

				<?php


				break;





			case "txt_emp_expense_report":


				//print_r($_POST);
				$empname = addslashes($_POST[empname]);
				if ($empname == 'ALL') {
					$cond = "where  o.aru_code='$_SESSION[aru_code]' and eet.is_live and eet.entitytype_id=12";
				} else {
					$cond = "where ename like upper('%$empname%') and o.aru_code='$_SESSION[aru_code]' and eet.is_live and eet.entitytype_id=12";
				}


				$qry = "select distinct(ename),o.name as office,dl.unique_code,entity_id  
 
 from a_imprest_operations 
inner join dl_empl dl on dl.unique_code=split_part(imprest_id_ref,'/',1)::int 
inner join offices o on o.code=split_part(imprest_id_ref,'/',2)

inner join entity_entitytype eet on split_part(eet.unique_code,'-',2)=split_part(imprest_id_ref,'/',1)


 $cond


 order by ename";

				//and o.location_code='$_SESSION[location_code]'  
				//echo $qry;
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//print_r($row1);
				if ($row1[EOF] == 1) {

					imprestN::show_error("<span class='fa fa-lg fa-stop-circle'></span>&nbsp;Searched words does not match with Any records");
					exit;
				}

				?>
				<div class="bs-callout bs-callout-success">

					<ul class="list-group">
						<li class=list-group-item>
							<span class='fa fa-user fa-lg text-warning text-center'></span>&nbsp;List of Imprest Holders</li>
						<?php
						foreach ($row1 as $row) {
							echo "<li style='cursor: pointer;' id='$row[entity_id]' class=\"list-group-item list-group-item-warning li_emp_name_exp\">
	$row[ename] of $row[office] <br> <span class=text-danger></span> 
	 <span class='fa fa-hand-pointer-o fa-lg'></span>
	 
	 </li>";
						}

						?>

					</ul>
				</div>

				<?php

				break;


			case "show_send_voucher":


				break;



			case "btn_show_my_imprest":


				//print_r($_POST);
				$empname = addslashes($_POST[empname]);
				//$empname=stripslashes($_POST[empname]);




				$qry = "select imprest_id_ref,to_char(min(imp_opn_time),'DD Mon YYYY' ) as date1 ,ename,o.name as office  
 
 from a_imprest_operations 
inner join dl_empl dl on dl.unique_code=split_part(imprest_id_ref,'/',1)::int
inner join offices o on o.code=split_part(imprest_id_ref,'/',2) where split_part(imprest_id_ref,'/',1)=$_SESSION[user_name]::text

and dl.unique_code is not null and imprest_id_ref is not null
group by imprest_id_ref ,ename,o.name,split_part(imprest_id_ref,'/',5) order by date1,split_part(imprest_id_ref,'/',5)



";


				//echo $qry;
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//print_r($row1);
				if ($row1[EOF] == 1) {

					imprestN::show_error("<span class='fa fa-lg fa-stop-circle'></span>&nbsp;Searched words does not match with Any records");
					exit;
				}

				?>
				<div class="bs-callout bs-callout-success">

					<ul class="list-group">
						<li class="list-group-item lead">
							<span class='fa fa-clock-o fa-lg text-warning text-center '></span>&nbsp;List of Imprest Files</li>
						<?php
						foreach ($row1 as $row) {
							echo "<li style='cursor: pointer;' id='$row[imprest_id_ref]' class=\"list-group-item list-group-item-info li_emp_name lead\">Imprest of $row[ename] of $row[office] <br> <span class=text-danger>Date $row[date1]</span> </li>";
						}

						?>

					</ul>
				</div>

				<?php

				break;


			case "li_emp_name":

				$imp_ref_id = $_POST[imprest_id_ref];

				$qry = "select o.name as from_office,b.name as from_branch1,o1.name as to_office,b1.name to_branch,ename,action_pending,to_char(imp_opn_time,'DD Mon YYYY') as tim
,imprest_op_id
	from a_imprest_operations 
 aio inner join offices o on aio.from_office=o.code 
 inner join   offices o1 on aio.to_office=o1.code
left join  branch b on aio.from_branch::int=b.id
left join  branch b1 on aio.to_branch::int=b1.id
inner join dl_empl emp on split_part(aio.imprest_id_ref,'/',1)::int=emp.unique_code

where imprest_id_ref='$imp_ref_id'


 order by imprest_op_id;";
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//print_r($row1);

				//echo $qry;
				?>
				<div class="bs-callout bs-callout-success">

					<ul class="list-group">
						<li class="list-group-item lead">
							<span class='fa fa-clock-o fa-lg text-warning text-center'></span>&nbsp;Time Line of Imprest File NO<?php echo $imp_ref_id; ?> </li>
						<?php
						foreach ($row1 as $row) {

							//if($row[from_branch]=="")$row[from_branch1]="Head of office";
							//if($row[to_branch]=="")$row[to_branch]="Head of office";

							$class = "list-group-item-success lead";


							//echo $row[action_pending];
							if ($row[action_pending] == 't') {
								$class = "list-group-item-danger lead";
								$pending = "<li style='background-color:red'>ACTION PENDING AT $row[to_branch] of $row[to_office] </li>";
							} else {
								$pending = "";
							}




							echo "<li id='$row[imprest_id_ref]' class=\"list-group-item $class \">
	 
	<span class='text-success fa fa-calendar fa-lg' >&nbsp;$row[tim]&nbsp;</span>
	<span class=text-danger>$row[from_office]</span> 
	<span class=text-danger>$row[from_branch1]</span>  TO 
	<span class=text-danger>$row[to_office]</span> 
	<span class=text-danger>$row[to_branch]</span> 
	<span class=text-danger>$row[tim1]</span> 
	<span class=badge> $row[imprest_op_id] </span>
	 </li>";

							echo $pending;
						}

						?>

					</ul>
				</div>

				<?php



				break;





			case "btn_report_total_aru":

				$qry = "select sum(item_amount)  as total,item_acc_code,acc_head
	 from a_imprest_voucher_details 	aiv inner join trans_heads th on th.acc_code=aiv.item_acc_code

inner join data_master dm on dm.dm_id=th.dm_id where trans_type=104 and visible=true and dm.loc_code=$_SESSION[location_code] 	and officer_privillage='3'
 group by item_acc_code, acc_head order by total desc";


				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				?>

				<!--
			<div class=row>
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
	
	
				<h1 class=bg-warning>Abstract Report of ARU Expenses by Account Code</h1>
				-->


				<div class="col-sm-4 col-sm-offset-4"></div>
				<div id="piechart"></div>

				</div>
				<!-----

			chart js for charts below


			-->
				</script>

				<h1 class=bg-warning>Abstract Report of ARU Expenses by Account Code</h1>
				<div class="col-sm-4 col-sm-offset-4"></div>
				
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

					<div class='col-sm-6 col-sm-offset-2'>
						< <canvas id="myChart" style="width:250px;height:250px;"></canvas>
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
					echo "<tr class='bg-success lead'>";

					echo "<td colspan=2 >";

					echo "Total amount :";

					echo "</td>";
					echo "<td colspan=1>";

					echo "$tot";
					echo "</td>";
					echo "</tr>";
					echo "<input type=hidden name=txtamount value=$tot>";




					?>
				</table>

				<?php






				break;




			case "div_report_total_all":


				break;






			case "save_vouchers_in_saras":

			// echo $_SESSION[option];
			// echo $_POST[option];
				//print_r($_POST); 

if($_POST[option]==$_SESSION[option])
{
	unset($_SESSION["option"]);
				$post = $_POST;
				//exit;

				$imprest_id_refX = $_POST[imprest_ref_id];
				$empcode1X = split("/", $imprest_id_refX);
				$original_officeX = $empcode1X[1];
				$imp_holderX = $empcode1X[0];
				$typeX = $empcode1X[2];







				////////////////////


				include_once('../class/Imprest.class.php');
				include_once('functionlib.php');


				$impType = $_POST['cmbBilltype'];
				$CurrDt = $_POST['txtDate'];
				$ttype == ImprestPermanent;
				$payee = $_POST['txtpayee'];

				//$eid = GetEntityid($payee);



				//echo "entity id is $eid";

				$qry = "select * from vw_entities where ee_id=$_SESSION[location_code]$_POST[cmbpayee]";
				//echo $qry;

				//exit;

				$db = new DBAccess;
				$row1 = $db->SelectData($qry);

				//print_r($row1);
				$row = $row1[0];

				$eid = $row[entity_id];
				//$eid=3232910;

				$Acc = $_POST['txtnetAcc'];

				$amount = $_POST['txtamount'];
				$officeid = $_POST['cmboffice'];
				//$trid= $_POST['trid'];

				$Balance = $_POST['txtbalance'];
				$remitAmount = $_POST['txtremit'];



				$amounts = ($_POST['txtDrAmt']);
				$acccodes = $_POST['txtDrAcc'];
				$accname = $_POST['txtDrAccHead'];

				//for Debit amounts in case of adjustment and closure**********************************
				$amounts = ($_POST['txtDrAmt']);
				$acccodes = $_POST['txtDrAcc'];
				$accname = $_POST['txtDrAccHead'];

				$dRow = count($acccodes);
				$arTransDetails = array();
				$arDrDetails = array();
				$k = 1;   // counter to generate slno for trans_details

				//  Debit amounts
				$drAmt = 0;
				//$dRow = $_POST['dRow'];
				for ($i = 0; $i < $dRow; $i++) {
					$drAmount = $amounts[$i];

					$acccode = $acccodes[$i];
					$arDrDetails[] = array("acc" => $acccode,  "amt" => $drAmount);

					if ($drAmount > 0) {

						$drAmt = $drAmt + $drAmount;
						$arTransDetails[$k] = array("acc_code" => $acccode,  "amount" => $drAmount, "debit" => 1, "sl_no" => $k);
						$k = $k + 1;
					}
				}
				$arTransDetails[$k] = array("acc_code" => $Acc,  "amount" => $drAmt, "debit" => 0, "sl_no" => $k);

				$dr = serialize($arDrDetails);
				echo "<input type=HIDDEN name = arrDrDetails value=" . $dr . ">";
				echo '<input type="HIDDEN" name = "arrDr" value=' . $dr . '>';
				//for validation***********************************************************************
				$arrVal = array();

				if ($impType == 1001) {
					$arrVal = array("payee" => $payee, "billtype" => $impType, "office" => $_POST['cmboffice'], "descri" => $_POST['txtdesci'], "drAmount" => $amount, "crAmount" => $amount, "netAmount" => $amount, "to_branch" => $_POST['cmbsec']);
				} elseif ($impType == 1002) {
					//echo $impType;
					$arrVal = array("payee" => $payee, "billtype" => $impType, "office" => $_POST['cmboffice'], "descri" => $_POST['txtdesci'], "drAmount" => $drAmt, "crAmount" => $amount, "netAmount" => $amount, "impType" => $impType, "balance" => $Balance, "remit" => $remitAmount, "to_branch" => $_POST['cmbsec']);
				} elseif ($impType == 1003) {
					if ($ttype == ImprestTemporary) {

						if ($_POST['cmbimpcheque'] == "ps") {
							$chamt = 0;
							$chdt = 0;
							$chid = 0;
							//echo'CHEQUE ID'.$chid.'AAA<br>';
							$Balance = 0;
						} else {
							$ch = unserialize(stripslashes($_POST['cmbimpcheque']));

							$chamt = $ch['amount'];
							$chdt = $ch['dt'];
							$chid = $ch['cheque_id'];

							//echo'CHEQUE ID'.$chid.'AAA<br>';
							$Balance = $chamt;
							echo '<input type="HIDDEN" name = "impchequeid" value=' . $chid . '>';
							echo '<input type="HIDDEN" name = "cmbimpcheque" value=' . serialize($ch) . '>';
						}
					}
					/*		if($ttype==ImprestTemporary)
	{
		$ch=unserialize(stripslashes($_POST['cmbimpcheque']));
	
		$chamt=$ch['amount'];
		$chdt=$ch['dt'];
		$chid=$ch['cheque_id'];
		echo'CHEQUE ID'.$chid.'AAA<br>';
		$Balance=$chamt;
		echo'<input type="HIDDEN" name = "impchequeid" value='.$chid.'>';
	}*/
					//echo $_POST['txtpayee'];

					$arrVal = array("payee" => $payee, "billtype" => $impType, "office" => $_POST['cmboffice'], "descri" => $_POST['txtdesci'], "drAmount" => $drAmt, "crAmount" => $drAmt, "netAmount" => $drAmt, "impType" => $impType, "balance" => $Balance, "remit" => $remitAmount, "to_branch" => $_POST['cmbsec']);
				}


				//if(validate($arrVal)==false)
				$a = false;
				if ($a) {
					echo '<table width=90% align=center><tr><td width = 50% align = center>
	<input type="submit" name= sbmt value= Back></input></td></tr></table>';
					echo '</form>';
				} else {




					if ($impType == 1003) {

						$oImprest = new Imprest(false);
					} else {
						$oImprest = new Imprest(true);
						$oImprest->oBill->SetBillDate($CurrDt);
						$oImprest->SetPayee($eid);
						$oImprest->oBill->SetNetAccCode($Acc);
						//$oImprest->oBill->SetBillTypeId($impType);
						$oImprest->oBill->SetBillAmount($amount);
						//$oImprest->oBill->SetBillId($_POST['billid']);
					}


					$oImprest->SetpreStatus($_POST['status']);
					$oImprest->SetlocCode($loccode);
					$oImprest->SetTransTypeId($ttype);
					$oImprest->SetBranch($_POST['cmbsec']);
					$oImprest->SetTransDate($CurrDt);
					$oImprest->SetOfficeId($_POST['cmboffice']);
					$oImprest->SetDescription($_POST['txtdesci']);
					$oImprest->SetPayee($eid);
					$oImprest->SetImpAccCode($Acc);
					$oImprest->SetChequeId($chid);
					$oImprest->SetBillTypeId($impType);

					if ($impType > 1001) {
						if ($_POST['chkclose'] <> 1) {
							$oImprest->SetTransDetails($arTransDetails);
						}
					}
					$oImprest->SetRefundAmt($_POST['txtremit']);
					$oImprest->SetRptDate(0);
					$oImprest->SetChequeId($chid);
					$oImprest->SetRptNo($_POST['txtremitrpt']);
					$oImprest->SetImpAccCode($Acc);

					$errs = $oImprest->ImprestSave();


					if (count($errs) > 0) {

						////obtaining cug number
						$office_code = $_SESSION[office_code];
						$qry = "select * from a_cug where office_id=$office_code";
						//echo $qry;
						$dbp = new DBAccess;


						$row = $dbp->SelectData($qry);
						$rw = $row[0];
						//print_r($rw);

						// foreach ($row as $rw)

						// {


						// }


						$phone1 = $rw[cug];


						////////////////////////////////////



						show_error_messages($errs);


						$office_code_of_imperst_holder1 = split("/", $imprest_id_refX);
						$office_code_of_imperst_holder = $office_code_of_imperst_holder1[1];
						$type = $office_code_of_imperst_holder1[2];

						$office_name = imprestN::get_office_name($to_office);
						$branch_name = imprestN::getBranchNameFromBranchId($to_branch);

						$imperst_holder = $office_code_of_imperst_holder1[0];
						$name_of_employee = imprestN::getEmpNameFromEmpCode($imperst_holder);

						$desig = "";
						$msg = "ALERT\nERROR\n$imprest_id_refX,\n$name_of_employee,\n$_SESSION[office_name] \n $phone1";
						imprestN::execute_sms_personal(1064767, $desig, $msg);
						imprestN::execute_sms_personal(1048592, $desig, $msg);
					} else {
						$transid = $oImprest->GetTransId();
						$dbno = $oImprest->GetDbNo();
						if ($impType <> 1003) {
							$billid = $oImprest->oBill->GetBillId();
						}
						$Dt = c_Date_Ymd(date('Y/m/d', $CurrDt));
						$transmonth = $Dt; //date('Y/m/d', $CurrDt);
						echo '<table class="table table-bordered table-stripped">
	<tr><TH class="bg-primary text-center" colspan=4>
		Imprest Voucher Created</TH>
		<tr><td align = center>';
						$Detail = GetPaymentVoucherDetails($transmonth, $transid);
						echo '</td></tr></table>
		<input type="HIDDEN" name= trid value=' . $transid . '>
		<input type="HIDDEN" name= dbno value=' . $dbno . '>
		<input type="HIDDEN" name= billid value=' . $billid . '>';
						echo '<table width = 80%><tr><td width=80% align = center>';
						//<input type=submit name=impEdit value = EDIT>
						echo '</td></tr><?table>';


						// inserting into a_imprest_voucher
						$month = date('m/Y', $transmonth);
						$voucher_num = $Detail[bill_id] . ' of ' . $month;
						$amount = $Detail[bill_amount] * -1;

						$imprest_ref_id = $_POST[imprest_ref_id];
						$ref = explode("/", $imprest_ref_id);

						$paid_to = $ref[0];
						$imp_holder_office = $ref[1];
						$date_of_payment = date('Y-m-d');

						$date = date("Y-m-d");
						//$date=date("2019-03-31");
						$fy = imprestN::findFinancialYear($date);
						$purpose = $imprest_ref_id;
						$item_acc_code = $post[imp_op_id];
						$db = new DBAccess;
						$db->DBbeginTrans();

						$qry = "insert into a_imprest_voucher (imp_voucher_id,voucher_num,item_desc,amount,paid_to,type,date_of_payment,
	imp_holder,imp_holder_office,voucher_status,imp_fy,purpose,item_acc_code)
	values ($transid,'$voucher_num','KSEB',$amount,'$paid_to','r',
	'$date_of_payment','$paid_to','$imp_holder_office',1,'$fy','$purpose','$item_acc_code')";

						//echo $qry;



						$result = $db->UpdateData($qry);

						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();

							echo $qry;
							return $result;

							exit;
						}

						///updating tmaster and trans master to 41   ///new thing



						$qry = "update trans_master set status=41 where trans_id=$transid";

						$result = $db->UpdateData($qry);

						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							echo $qry;
							return $result;

							exit;
						}
						$qry = "update t_master set status=41 where trans_id=$transid";

						$result = $db->UpdateData($qry);

						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							echo $qry;
							return $result;

							exit;
						}

						///updating tmaster and trans master to 41   ///new thing



						///////////////////////////adding new code inside no errors block


						$imprest_ref_id = $_POST[imprest_ref_id];

						////////////////// updating passed vouchers as voucher_status=3



						if ($typeX == 'V' or $typeX == 'VC') {



							$qryx = "update a_imprest_voucher set voucher_status=3 where imprest_num='$imprest_ref_id'";
							
							$qryx = "update a_imprest_voucher set voucher_status=3,passed_date='now()' where imprest_num='$imprest_ref_id'";

							//$msg=" $qryy  ";
							;

							$resultx = $db->UpdateData($qryx);
							if ($resultx['EOF']) {
								imprestN::execute_sms_personal(1064767, $desig, $qryx);
								$resultx['adl_msg'] = "Insert into amnt. details failed";
								$db->DBrollBackTrans();
								echo $qryx;
								return $resultx;

								exit;
							}
						}

						/////////////////////////////////////////////////////////////////////////////






						/////////////////// for trans log entries////////////////////


						// delete trans log entries

						//////////////////////trans status of ee from 11 to 41


						$qry = "update trans_log set action_id=41 where trans_id=$transid";

						$result = $db->UpdateData($qry);

						if ($result1['EOF']) {
							$result['adl_msg'] = "updating trans log with 41 failed";
							$db->DBrollBackTrans();
							return $result;
							echo $qry;

							exit;
						}



						$imprest_transaction_type1 = split("/", $imprest_ref_id);
						$imprest_transaction_type = $imprest_transaction_type1[2];

						if ($imprest_transaction_type == 'P') {
							$op_ab = 111;
							$op_da = 113;
						} elseif ($imprest_transaction_type == 'V' or $imprest_transaction_type == 'VC') {
							$op_ab = 192;
							$op_da = 193;
						}




						/////////////////////////////ab1 log entry ////////////////////////////////////////////



						$qry = "select user_id,imp_opn_time as tim,from_branch,designation_id
 from a_imprest_operations  aio inner join vw_office_setup  vu on vu.user_name=aio.action_by::text where 
  from_office='$_SESSION[office_code]' and to_office='$_SESSION[office_code]' and imp_operation::int=$op_ab and imprest_id_ref='$imprest_ref_id'
  
  and office_code::int=$_SESSION[office_code]";





						$row1 = $db->SelectData($qry);


						$row = $row1[0];

						$user_id = $row[user_id];
						$log_time = $row[tim];
						$branch_id = $row[from_branch];
						$action_id = 11;
						$designation_id = $row[designation_id];


						$qry = "insert into trans_log (trans_id,user_id,action_id,log_time,branch_id,desig_id)

values($transid,$user_id,$action_id,'$log_time',$branch_id,$designation_id)
 ";


						$result = $db->UpdateData($qry);

						if ($result1['EOF']) {
							$result['adl_msg'] = "updating trans log with 11 failed";
							$db->DBrollBackTrans();
							return $result;
							echo $qry;

							exit;
						}

						/////////////////////////////////ab1 log entry ends //////////////////////////////////////////////////////////


						/////////////////////////////DA log entry ////////////////////////////////////////////


						$qry = "select user_id,imp_opn_time as tim,from_branch,designation_id
 from a_imprest_operations  aio left join 
 (select * from vw_office_setup where office_code::int=$_SESSION[office_code])  vu on vu.user_name=aio.action_by::text where 
  from_office='$_SESSION[office_code]' and to_office='$_SESSION[office_code]' and imp_operation::int=$op_da and 
  imprest_id_ref='$imprest_ref_id'
  
  ";


//echo $qry;

						$row1 = $db->SelectData($qry);

						//print_r($row1);
						$row = $row1[0];

					//	$user_id = $row[user_id];

						$user_id=(isset($row[user_id])?$row[user_id]:1);
					//	$log_time = $row[tim];
						$log_time=(isset($row[tim]))?$row[tim]: date("Y-m-d H:i:s");
						//$branch_id = $row[from_branch];
$branch_id=(isset($row[from_branch])?$row[from_branch]:1);

						$designation_id =(isset($row[designation_id])?$row[designation_id]:1) ;
						$action_id = 31;


						$qry = "insert into trans_log (trans_id,user_id,action_id,log_time,branch_id,desig_id)

values($transid,$user_id,$action_id,'$log_time',$branch_id,$designation_id)
 ";


						$result = $db->UpdateData($qry);

						if ($result1['EOF']) {
							$result['adl_msg'] = "updating trans log with 11 failed";
							$db->DBrollBackTrans();
							echo $qry;
							return $result;

							exit;
						}

						/////////////////////////////////da log entry ends //////////////////////////////////////////////////////////




						///// new imprest operations seperated from call back

						///setting currrent operation as false

						$qry = "update a_imprest_operations set action_pending=false where imprest_op_id=$post[imp_op_id]";
						$result1 = $db->UpdateData($qry);
						if ($result1['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							echo $qry;
							return $result;
						}

						$to_office = $post[to_office];
						$to_branch = $post[branch_id];
						$msg = $post[msg];
						//// inserting new imprest

						if ($typeX == 'V' or $typeX == 'VC') {
							$imp_operation = 200; /// setting for for copertion code for closing
						} elseif ($typeX == 'P') {

							$imp_operation = 300; /// setting for for copertion code for closing

						}

						$qry = "insert into a_imprest_operations (imp_operation,from_office,to_office,from_branch,to_branch,action_by,
imp_oprn_msg,imprest_id_ref,action_pending,imp_fy) values

('$imp_operation','$_SESSION[office_code]','$to_office','$_SESSION[branch_id]','$to_branch','$_SESSION[user_name]',
'$msg','$imprest_ref_id',false,'$fy'

) returning imprest_op_id ";

						$result1 = $db->UpdateDataAndReturn($qry);
						//$result1 = $db->UpdateData($qry);
						if ($result1['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							echo $qry;
							return $result;
						}

						///inserting to voucher movement

						$imprest_op_id = $result1['data'][0][imprest_op_id];  ///this is not working 
						//$imprest_op_id=$post[imp_op_id];


						$vouchers = $post[vouchers_json];

						$vouchers = str_replace('[', '{', $vouchers);
						$vouchers = str_replace(']', '}', $vouchers);

						$date = date("Y-m-d");
						//$date=date("2019-03-25");
						$fy = imprestN::findFinancialYear($date);

						if ($typeX == 'V' or $typeX == 'VC') {

							$qry = "insert into a_imprest_voucher_mvmt (imprest_op_id,vouchers,imp_fy) values ($imprest_op_id,'$vouchers','$fy')";
							$db->UpdateData($qry);

							//echo $qry;
							if ($result['EOF']) {
								$result['adl_msg'] = "Insert into amnt. details failed";
								echo $qry;
								$db->DBrollBackTrans();
								return $result;
							}
						}
						////////////////////////sms ///////////////////////////
						//$to_branch=$to_branch;

						$fy = '2018-2019';

						$date=date("Y-m-d");
		//$date=date("2019-03-25");
	
	
	$fy=imprestN::findFinancialYear($date);

						$to_office = $post[to_office];
						$to_branch = $post[branch_id];
						$imprest_ref_id = $_POST[imprest_ref_id];

						$office_code_of_imperst_holder1 = split("/", $imprest_ref_id);
						$office_code_of_imperst_holder = $office_code_of_imperst_holder1[1];
						$type = $office_code_of_imperst_holder1[2];

						$office_name = imprestN::get_office_name($to_office);
						$branch_name = imprestN::getBranchNameFromBranchId($to_branch);

						$imperst_holder = $office_code_of_imperst_holder1[0];
						$name_of_employee = imprestN::getEmpNameFromEmpCode($imperst_holder);

						$passed_amount = $Detail[bill_amount];
						if ($type == 'V') {
							$msg = "Dear $name_of_employee,\nYour imprest of Amount $passed_amount /- has been Passed with Voucher Number $voucher_num.\nCheque will be issued soon by $branch_name of  $office_name";
						} elseif ($type == 'VC') {

							$msg = "Dear $name_of_employee,\nYour imprest of $fy is closed";
						} elseif ($type == 'P') {
							$msg = "Dear $name_of_employee,\nYour imprest of Amount $passed_amount /- has been Passed with Voucher Number $voucher_num.\nCheque will be issued soon by $branch_name of  $office_name";
						}
						imprestN::execute_sms($office_code_of_imperst_holder, $desig, $msg);
						$empcode = $office_code_of_imperst_holder1[0];
						imprestN::execute_sms_personal($empcode, $desig, $msg);
						imprestN::execute_sms_personal(1064767, $desig, $msg . $empcode);











						$db->DBcommitTrans();
						imprestN::show_alert($msg, "alert alert-success");
					}
				}



















				$db->DBcommitTrans();







			}else{


				imprestN::alert_failed("Duplicate Operation<br> Action Aborted");
			}



				break;








			case "save_vouchers_in_saras_old":


				//print_r($_POST); 

				//exit;









				////////////////////


				include_once('../class/Imprest.class.php');
				include_once('functionlib.php');


				$impType = $_POST['cmbBilltype'];
				$CurrDt = $_POST['txtDate'];
				$ttype == ImprestPermanent;
				$payee = $_POST['txtpayee'];

				//$eid = GetEntityid($payee);



				//echo "entity id is $eid";

				$qry = "select* from vw_entities where ee_id=$_SESSION[location_code] $_POST[cmbpayee]";
				//echo $qry;

				//exit;

				$db = new DBAccess;
				$row1 = $db->SelectData($qry);

				//print_r($row1);
				$row = $row1[0];

				$eid = $row[entity_id];
				//$eid=3232910;

				$Acc = $_POST['txtnetAcc'];

				$amount = $_POST['txtamount'];
				$officeid = $_POST['cmboffice'];
				//$trid= $_POST['trid'];

				$Balance = $_POST['txtbalance'];
				$remitAmount = $_POST['txtremit'];



				$amounts = ($_POST['txtDrAmt']);
				$acccodes = $_POST['txtDrAcc'];
				$accname = $_POST['txtDrAccHead'];

				//for Debit amounts in case of adjustment and closure**********************************
				$amounts = ($_POST['txtDrAmt']);
				$acccodes = $_POST['txtDrAcc'];
				$accname = $_POST['txtDrAccHead'];

				$dRow = count($acccodes);
				$arTransDetails = array();
				$arDrDetails = array();
				$k = 1;   // counter to generate slno for trans_details

				//  Debit amounts
				$drAmt = 0;
				//$dRow = $_POST['dRow'];
				for ($i = 0; $i < $dRow; $i++) {
					$drAmount = $amounts[$i];

					$acccode = $acccodes[$i];
					$arDrDetails[] = array("acc" => $acccode,  "amt" => $drAmount);

					if ($drAmount > 0) {

						$drAmt = $drAmt + $drAmount;
						$arTransDetails[$k] = array("acc_code" => $acccode,  "amount" => $drAmount, "debit" => 1, "sl_no" => $k);
						$k = $k + 1;
					}
				}
				$arTransDetails[$k] = array("acc_code" => $Acc,  "amount" => $drAmt, "debit" => 0, "sl_no" => $k);

				$dr = serialize($arDrDetails);
				echo "<input type=HIDDEN name = arrDrDetails value=" . $dr . ">";
				echo '<input type="HIDDEN" name = "arrDr" value=' . $dr . '>';
				//for validation***********************************************************************
				$arrVal = array();

				if ($impType == 1001) {
					$arrVal = array("payee" => $payee, "billtype" => $impType, "office" => $_POST['cmboffice'], "descri" => $_POST['txtdesci'], "drAmount" => $amount, "crAmount" => $amount, "netAmount" => $amount, "to_branch" => $_POST['cmbsec']);
				} elseif ($impType == 1002) {
					//echo $impType;
					$arrVal = array("payee" => $payee, "billtype" => $impType, "office" => $_POST['cmboffice'], "descri" => $_POST['txtdesci'], "drAmount" => $drAmt, "crAmount" => $amount, "netAmount" => $amount, "impType" => $impType, "balance" => $Balance, "remit" => $remitAmount, "to_branch" => $_POST['cmbsec']);
				} elseif ($impType == 1003) {
					if ($ttype == ImprestTemporary) {

						if ($_POST['cmbimpcheque'] == "ps") {
							$chamt = 0;
							$chdt = 0;
							$chid = 0;
							//echo'CHEQUE ID'.$chid.'AAA<br>';
							$Balance = 0;
						} else {
							$ch = unserialize(stripslashes($_POST['cmbimpcheque']));

							$chamt = $ch['amount'];
							$chdt = $ch['dt'];
							$chid = $ch['cheque_id'];

							//echo'CHEQUE ID'.$chid.'AAA<br>';
							$Balance = $chamt;
							echo '<input type="HIDDEN" name = "impchequeid" value=' . $chid . '>';
							echo '<input type="HIDDEN" name = "cmbimpcheque" value=' . serialize($ch) . '>';
						}
					}
					/*		if($ttype==ImprestTemporary)
		{
			$ch=unserialize(stripslashes($_POST['cmbimpcheque']));
		
			$chamt=$ch['amount'];
			$chdt=$ch['dt'];
			$chid=$ch['cheque_id'];
			echo'CHEQUE ID'.$chid.'AAA<br>';
			$Balance=$chamt;
			echo'<input type="HIDDEN" name = "impchequeid" value='.$chid.'>';
		}*/
					//echo $_POST['txtpayee'];

					$arrVal = array("payee" => $payee, "billtype" => $impType, "office" => $_POST['cmboffice'], "descri" => $_POST['txtdesci'], "drAmount" => $drAmt, "crAmount" => $drAmt, "netAmount" => $drAmt, "impType" => $impType, "balance" => $Balance, "remit" => $remitAmount, "to_branch" => $_POST['cmbsec']);
				}


				//if(validate($arrVal)==false)
				$a = false;
				if ($a) {
					echo '<table width=90% align=center><tr><td width = 50% align = center>
		<input type="submit" name= sbmt value= Back></input></td></tr></table>';
					echo '</form>';
				} else {




					if ($impType == 1003) {

						$oImprest = new Imprest(false);
					} else {
						$oImprest = new Imprest(true);
						$oImprest->oBill->SetBillDate($CurrDt);
						$oImprest->SetPayee($eid);
						$oImprest->oBill->SetNetAccCode($Acc);
						//$oImprest->oBill->SetBillTypeId($impType);
						$oImprest->oBill->SetBillAmount($amount);
						//$oImprest->oBill->SetBillId($_POST['billid']);
					}


					$oImprest->SetpreStatus($_POST['status']);
					$oImprest->SetlocCode($loccode);
					$oImprest->SetTransTypeId($ttype);
					$oImprest->SetBranch($_POST['cmbsec']);
					$oImprest->SetTransDate($CurrDt);
					$oImprest->SetOfficeId($_POST['cmboffice']);
					$oImprest->SetDescription($_POST['txtdesci']);
					$oImprest->SetPayee($eid);
					$oImprest->SetImpAccCode($Acc);
					$oImprest->SetChequeId($chid);
					$oImprest->SetBillTypeId($impType);

					if ($impType > 1001) {
						if ($_POST['chkclose'] <> 1) {
							$oImprest->SetTransDetails($arTransDetails);
						}
					}
					$oImprest->SetRefundAmt($_POST['txtremit']);
					$oImprest->SetRptDate(0);
					$oImprest->SetChequeId($chid);
					$oImprest->SetRptNo($_POST['txtremitrpt']);
					$oImprest->SetImpAccCode($Acc);

					$errs = $oImprest->ImprestSave();


					if (count($errs) > 0) {
						show_error_messages($errs);
					} else {
						$transid = $oImprest->GetTransId();
						$dbno = $oImprest->GetDbNo();
						if ($impType <> 1003) {
							$billid = $oImprest->oBill->GetBillId();
						}
						$Dt = c_Date_Ymd(date('Y/m/d', $CurrDt));
						$transmonth = $Dt; //date('Y/m/d', $CurrDt);
						echo '<table class="table table-bordered table-stripped">
		<tr><TH class="bg-primary text-center" colspan=4>';

						if ($impType <> 1003) {
							echo "Imprest CLOSED";
						} else {
							echo "Imprest Voucher Created";
						}

						echo '
			
			
			</TH>
			<tr><td align = center>';
						$Detail = GetPaymentVoucherDetails($transmonth, $transid);
						echo '</td></tr></table>
			<input type="HIDDEN" name= trid value=' . $transid . '>
			<input type="HIDDEN" name= dbno value=' . $dbno . '>
			<input type="HIDDEN" name= billid value=' . $billid . '>';
						echo '<table width = 80%><tr><td width=80% align = center>';
						//<input type=submit name=impEdit value = EDIT>
						echo '</td></tr><?table>';


						// inserting into a_imprest_voucher
						$month = date('m/Y', $transmonth);
						$voucher_num = $Detail[bill_id] . ' of ' . $month;
						$amount = $Detail[bill_amount] * -1;

						$imprest_ref_id = $_POST[imprest_ref_id];
						$ref = explode("/", $imprest_ref_id);

						$paid_to = $ref[0];
						$imp_holder_office = $ref[1];
						$date_of_payment = date('Y-m-d');

						$date = date("Y-m-d");
						//$date=date("2019-03-31");
						$fy = imprestN::findFinancialYear($date);

						$qry = "insert into a_imprest_voucher (imp_voucher_id,voucher_num,item_desc,amount,paid_to,type,date_of_payment,
		imp_holder,imp_holder_office,voucher_status,imp_fy)
		values ($transid,'$voucher_num','KSEB',$amount,'$paid_to','r','$date_of_payment','$paid_to','$imp_holder_office',1,'$fy')";

						//echo $qry;

						$db = new DBAccess;
						$db->DBbeginTrans();

						$result = $db->UpdateData($qry);

						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							return $result;

							exit;
						}

						///updating tmaster and trans master to 41   ///new thing



						$qry = "update trans_master set status=41 where trans_id=$transid";

						$result = $db->UpdateData($qry);

						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							return $result;

							exit;
						}
						$qry = "update t_master set status=41 where trans_id=$transid";

						$result = $db->UpdateData($qry);

						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							return $result;

							exit;
						}

						///updating tmaster and trans master to 41   ///new thing


						$db->DBcommitTrans();
					}
				}



				$imprest_ref_id = $_POST[imprest_ref_id];

				////////////////// updating passed vouchers as voucher_status=3


				$qryx = "update a_imprest_voucher set voucher_status=3 where imprest_num='$imprest_ref_id'";
				$dbx = new DBAccess;
				$dbx->DBbeginTrans();

				$resultx = $dbx->UpdateData($qryx);
				if ($resultx['EOF']) {
					$resultx['adl_msg'] = "Insert into amnt. details failed";
					$dbx->DBrollBackTrans();
					return $resultx;

					exit;
				}

				$dbx->DBcommitTrans();

				/////////////////////////////////////////////////////////////////////////////






				/////////////////// for trans log entries////////////////////


				// delete trans log entries









				//////////////////////trans status of ee from 11 to 41
				$db->DBbeginTrans();

				$qry = "update trans_log set action_id=41 where trans_id=$transid";

				$result = $db->UpdateData($qry);

				if ($result1['EOF']) {
					$result['adl_msg'] = "updating trans log with 41 failed";
					$db->DBrollBackTrans();
					return $result;

					exit;
				}



				$imprest_transaction_type1 = split("/", $imprest_ref_id);
				$imprest_transaction_type = $imprest_transaction_type1[2];

				if ($imprest_transaction_type == 'P') {
					$op_ab = 111;
					$op_da = 113;
				} elseif ($imprest_transaction_type == 'V' or $imprest_transaction_type == 'VC') {
					$op_ab = 192;
					$op_da = 193;
				}




				/////////////////////////////ab1 log entry ////////////////////////////////////////////




				/*$qry="select user_id,imp_opn_time as tim,emp_name,from_branch,designation_id
		 from a_imprest_operations  aio inner join vw_office_setup  vu on vu.code=aio.action_by where 
		  from_office='$_SESSION[office_code]' and to_office='$_SESSION[office_code]' and 
		  imp_operation::int=$op_ab and imprest_id_ref='$imprest_ref_id'  and office_code::int=$_SESSION[office_code] ";  */

				$qry = "select user_id,imp_opn_time as tim,from_branch,designation_id
		 from a_imprest_operations  aio inner join vw_office_setup  vu on vu.user_name=aio.action_by::text where 
		  from_office='$_SESSION[office_code]' and to_office='$_SESSION[office_code]' and imp_operation::int=$op_ab and imprest_id_ref='$imprest_ref_id'
		  
		  and office_code::int=$_SESSION[office_code]";




				//echo $qry;
				$row1 = $db->SelectData($qry);

				//print_r($row1);
				$row = $row1[0];

				$user_id = $row[user_id];
				$log_time = $row[tim];
				$branch_id = $row[from_branch];
				$action_id = 11;
				$designation_id = $row[designation_id];


				$qry = "insert into trans_log (trans_id,user_id,action_id,log_time,branch_id,desig_id)
		
		values($transid,$user_id,$action_id,'$log_time',$branch_id,$designation_id)
		 ";


				$result = $db->UpdateData($qry);

				if ($result1['EOF']) {
					$result['adl_msg'] = "updating trans log with 11 failed";
					$db->DBrollBackTrans();
					return $result;

					exit;
				}

				/////////////////////////////////ab1 log entry ends //////////////////////////////////////////////////////////


				/////////////////////////////DA log entry ////////////////////////////////////////////


				$qry = "select user_id,imp_opn_time as tim,from_branch,designation_id
		 from a_imprest_operations  aio inner join vw_office_setup  vu on vu.user_name=aio.action_by::text where 
		  from_office='$_SESSION[office_code]' and to_office='$_SESSION[office_code]' and imp_operation::int=$op_da and imprest_id_ref='$imprest_ref_id'
		  
		  and office_code::int=$_SESSION[office_code]";




				$row1 = $db->SelectData($qry);

				//print_r($row1);
				$row = $row1[0];

				$user_id = $row[user_id];
				$log_time = $row[tim];
				$branch_id = $row[from_branch];
				$designation_id = $row[designation_id];
				$action_id = 31;


				$qry = "insert into trans_log (trans_id,user_id,action_id,log_time,branch_id,desig_id)
		
		values($transid,$user_id,$action_id,'$log_time',$branch_id,$designation_id)
		 ";


				$result = $db->UpdateData($qry);

				if ($result1['EOF']) {
					$result['adl_msg'] = "updating trans log with 11 failed";
					$db->DBrollBackTrans();
					return $result;

					exit;
				}

				/////////////////////////////////da log entry ends //////////////////////////////////////////////////////////




				$db->DBcommitTrans();






				break;

			case "add_supporting_documents":
				//print_r($_POST);
				//print_r($_FILES);



				$imp_file = $_POST[imp_file];
				
				$file = $_FILES;
				$post = $_POST;
				$imp_voucher_id = $post[imp_voucher_id];
				$imp_num = $post[imprest_num];
				
				ImprestN::transfer_sup_file_to_folder($file, $post, $imp_voucher_id, $imp_num)


				// $qry="update a_imprest_files set imp_file='$imp_file_new' where imp_file_id=$imp_file_id ";

				// $db = new DBAccess;
				// $db->DBbeginTrans();

				// $result = $db->UpdateData($qry);

				// if($result1['EOF'])
				// 		{	$result['adl_msg']="Insert into amnt. details failed";
				// 			$db->DBrollBackTrans();
				// 			return $result;

				// 			exit;
				// 		}

				// 		$db->DBcommitTrans();


				// move_uploaded_file($_FILES['new_voucher']['tmp_name'],$imp_file_new);

				?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success</strong>
				</div>
				<?php


				break;




			case "btn_del_voucher":

				$qry = "delete from a_imprest_voucher where imp_voucher_id=$_POST[voucher_id]";
				$db = new DBAccess;
				$db->DBbeginTrans();

				$result = $db->UpdateData($qry);

				if ($result1['EOF']) {
					$result['adl_msg'] = "Insert into amnt. details failed";
					$db->DBrollBackTrans();
					return $result;

					exit;
				}

				$db->DBcommitTrans();
				echo "Deleted Vouchers Successfully";

				break;


			case "view_voucher_del_button":

				//print_r($_POST);
				$qry = "select imp_file,imp_file_id from a_imprest_files where imp_voucher_id=$_POST[imp_voucher_id] and imp_file_category='V' ";
				//echo $qry;
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				$row = $row1[0];

				$imp_file = $row[imp_file];
				$imp_file_id = $row[imp_file_id];



				$qry = "select * from a_imprest_voucher where imp_voucher_id=$_POST[imp_voucher_id]";

				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				$row = $row1[0];

				$imprest_num = $row[imprest_num];


				//echo "why";

				//print_r($row1);

				$qry = "select count(*) from a_imprest_voucher_mvmt where $_POST[imp_voucher_id]=any(vouchers)";
				$db = new DBAccess;
				$rw = $db->SelectData($qry);
				$rw1 = $rw[0];

				$count = $rw1[count];

				//echo $count;		
				// if(($row[imp_holder]==$_SESSION[user_name]) and ($row[imp_holder_office]==$_SESSION[office_code]) and  $count==0)	old logic
				if ((($row[imp_holder] == $_SESSION[user_name]) and ($row[imp_holder_office] == $_SESSION[office_code])) or $_SESSION[aquired] == 1) {


					//print_r($row1);
					?>

					<!-- old
					<tr>
					
				<td colspan=4 class="bg-danger text-center"><button name='<?php echo $_POST[imp_voucher_id] ?>' class="btn btn-danger" id=btn_del_voucher>
				<span class="fa fa-trash fa-lg"></span>&nbsp;
				Delete</button></td>
					
	
									</tr>
	
	
				NEW BELOW 	-->

					<tr>


						<td colspan=2 class="bg-danger text-center"><button name='<?php echo $_POST[imp_voucher_id] ?>' class="btn btn-danger" id=btn_del_voucher>

								<span class="fa fa-trash fa-lg"></span>&nbsp;

								Delete</button></td>


						<td colspan=2 class="bg-success text-center"><button name='<?php echo $_POST[imp_voucher_id] ?>' class="btn btn-primary shadow" id=btn_edit_voucher>

								<span class="fa fa-pencil-square-o fa-lg"></span>&nbsp;

								Edit</button></td>

								




					</tr>

					<tr>
								<td colspan=4 class="bg-success block-center">
<button name='<?php echo $_POST[imp_voucher_id] ?>' class="btn btn-info shadow block-center" id=btn_strip_voucher>

<i class="fa fa-exclamation-triangle"></i>&nbsp;

Strip voucher from this lot </button></td>

</tr>

					<tr>
						<td colspan=4 id=td_change_voucher_out class='text-center'>

						</td>

					</tr>
					<tr>
						<td colspan=4 class='text-center'>
						
						
						
						<div class="alert alert-danger">
							
							<span class="badge">TO CHANGE VOUCHER IMAGE</span>
							
						<form id=frm_new_voucher>

<input type="file"  name="new_voucher" id="new_voucher">
<input type="hidden" name="imp_voucher_id" value='<?php echo $_POST[imp_voucher_id] ?>'>
<input type="hidden" name="option" value='change_voucher'>
<input type="hidden" name="imp_file" value='<?php echo $imp_file; ?>'>
<input type="hidden" name="imp_file_id" value='<?php echo $imp_file_id; ?>'>


<div class="alert alert-danger span_voucher_over_size" style="display:none">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Warning</strong> <span > Please Upload Vouchers below 300KB
</div>




<button class='btn btn-warning center-block' id="btn_change_voucher"  style="display:none"><span class='fa fa-clock fa-lg'></span> Change Voucher Image</button>

</form>
						</div>
						
						
							


						</td>
					</tr>

					<tr class="text-success lead ">
						<td colspan=4 class=text-center>
							<!-- <<button mat-button>text</button> -->
							<form id=frm_add_sup_doc>

							
								<div class="alert alert-danger " id=span_sup_doc_over_size style="display:none">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Warning</strong> <span > Please Upload Vouchers below 300KB
</div>
				

								<button id=btn_add_supporting_documents type="button" class="btn btn-info fa fa-crosshairs text-center"> Add Supporting Documents</button>

								<table class='table table-bordered table-stripped' style="border:1px solid red;">
								
								
									<tbody id=tbody_supporting_list>


									
									</tbody>
								</table>



								<input type="hidden" name="imp_voucher_id" value='<?php echo $_POST[imp_voucher_id]; ?>'>
								<input type="hidden" name="imprest_num" value='<?php echo $imprest_num; ?>'>
								<input type="hidden" name="option" value='add_supporting_documents'>


								<button id=btn_submit_supporting_doc style="display:none" class='btn btn-success'><span class='fa fa-clock fa-lg'></span>Submit Supporting documents</button>

							</form>





						</td>
					</tr>


				<?php

			}
			break;


		case "change_voucher":

			//print_r($_POST);

			$imp_file = $_POST[imp_file];
			$imp_file_id = $_POST[imp_file_id];
			

			$imp_file_new = $imp_file . ".new.jpg";
			//print_r($_FILES);
			// if(!is_dir($folder))
			// { mkdir($folder);		
			// }

			$qry = "update a_imprest_files set imp_file='$imp_file_new' where imp_file_id=$imp_file_id ";

			$db = new DBAccess;
			$db->DBbeginTrans();

			$result = $db->UpdateData($qry);
			echo $qry;

			if ($result1['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;

				exit;
			}

			$db->DBcommitTrans();


			move_uploaded_file($_FILES['new_voucher']['tmp_name'], $imp_file_new);

			?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success</strong>
				</div>
				<?php


				break;



			case "prepare_abstract":

				//print_r($_POST);
				imprestN::show_abstract_by_account_code($_POST[imp_ref_id], $_POST[class1]);
				break;




			case "div_adjustments_by_other_branch":


				if ($_SESSION[office_code] == $_SESSION[aru_code]) {  //action only at aru
					if (($_SESSION['previlege_id'] == 21 or $_SESSION['previlege_id'] == 22 or $_SESSION['previlege_id'] == 23) and !($_SESSION['previlege_id'] == 1)) {
						$privillage = 1;

						imprestN::getAdjustmentByOtherbranch($privillage, $_POST, "copy_this");
					}


					if ($_SESSION[previlege_id] == 3) {
						$privillage = 1;

						imprestN::getAdjustmentByOtherbranch($privillage, $_POST);

						$privillage = 2;

						imprestN::getAdjustmentByOtherbranch($privillage, $_POST, "copy_this");
					}
				}
				break;





			case "fill_audit_table_if_exists":

				/*

if($_SESSION[office_code]==$_SESSION[aru_code]){ 

			//print_r($_POST);
			 $row[imp_voucher_id]=$_POST[imp_voucher_id];
			$qry="select * from a_imprest_voucher_details where imp_voucher_id=$row[imp_voucher_id] and 
				officer_privillage='$_SESSION[previlege_id]'  ";
				
				//echo $qry;
			$db = new DBAccess;
			$row=$db->SelectData($qry);
			if($row[EOF]==1){
				
				//$row=[0];
				
				$row=array(0=>"");
				$row[0]=array("item_name"=>"","item_amount"=>"","item_acc_code"=>"","item_desc"=>"");
			}
			
			?>


	<table id=tbl_adjust class="table table-stripped table-bordered">
		<caption class="bg-primary text-center">ADJUSTMENT SHEET</caption>

		<tr>

			<th>Item Name</th>
			<th>item Amount</th>
			<!--<th>item Description</th> 
				
				
				<th>Item GST Amount</th>
				<th>Item GST Account Code</th>  -->
			<th>Item Account Code</th>
			<!--<th>Admissible</th> -->
			<th>Remarks</th>
			<th><button id=add_item class="btn btn-success"><span class="fa fa-plus fa-lg"></span>&nbsp;Add</button></th>

		</tr>
		<?php
				 foreach ($row as $rw1)
				 {
				?>
		<tr class=tr_template>

			<td><input type=text value="<?php echo $rw1[item_name];?>" class="item_name form-control"></td>
			<td><input type=text value="<?php echo $rw1[item_amount];?>" class="item_amount form-control"></td>

			<!-- <td><input type=text class=form-control id=item_desc></td>  
							
					<td><input type=text class=form-control id=item_amount></td>
							
					<td><input type=text class=form-control id=item_gst></td>
					
					-->
			<td>

				<?php
								include_once("./../class/transHeads.class.php");
								global $ttype;
								global $loccode;
								$qry="select  acc_head,acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 
			
			
								trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";
								
								//imprestN::select($qry,"acc_code","acc_head","item_acc_head","item_acc_head", $rw1[item_acc_code]);
								imprestN::select2key($qry,"acc_code","acc_head","acc_code","item_acc_head","item_acc_head", $rw1[item_acc_code],"disabled=disabled");
		
								//print_r($result);
								?>

			</td>











			<!--
					<td><label class="switch">
					<input type="checkbox">
					<span class="slider round"></span>
					</label></td>
					-->

			<td><textarea class="text_area_voucher_remark form-control"><?php echo $rw1[item_desc];?></textarea></td>
			<td>

				<button class='btn btn-danger del'>
					<span class="fa fa-minus fa-lg"></span>&nbsp;
					Delete


				</button></td>


			</td>

		</tr>


		<?php
				}
					
					?>

		<tr>
			<td></td>
		</tr>


		<tfoot>

			<tr>
				<td colspan=5 class="text-center"><button class="btn btn-success text-center audit_bill ">

						<span class="fa fa-floppy-o fa-lg"></span>&nbsp;
						Save</button></td>
			</tr>
		</tfoot>

	</table>


	<table class="table table-bordered table-stripped">


	</table>


	<?php	
}	
	
	

	

*/
				//  older version above


				if ($_SESSION[office_code] == $_SESSION[aru_code]) {

					//print_r($_POST);
					$row[imp_voucher_id] = $_POST[imp_voucher_id];
					$qry = "select * from a_imprest_voucher_details where imp_voucher_id=$row[imp_voucher_id] and 
				officer_privillage='$_SESSION[previlege_id]'  ";

					//echo $qry;
					$db = new DBAccess;
					$row = $db->SelectData($qry);
					if ($row[EOF] == 1) {

						if ($_SESSION[previlege_id] == 1) {


							//////////////// getting voucher details from AE's  entry ans prefilling to AB1 window'

							//$row=[0];

							$qry1 = "select * from a_imprest_voucher where imp_voucher_id=$_POST[imp_voucher_id]";


							//echo $qry1;
							$db1 = new DBAccess;
							$r2 = $db1->SelectData($qry1);
							$r1 = $r2[0];

							//echo "here";print_r($rw1);

							$row = array(0 => "");
							$row[0] = array("item_name" => $r1[voucher_num], "item_amount" => $r1[amount], "item_acc_code" => $r1[item_acc_code], "item_desc" => $r1[item_desc]);


							/// adding to voucher detail table



							$imp_voucher_id = $_POST[imp_voucher_id];


							$item_gst = 0;
							$item_gst_hsn_code = 0;
							$item_admisibility = 'TRUE';

							//$item_acc_code=;
							$modified_by = $_SESSION[user_name];
							$officer_privillage = $_SESSION[previlege_id];

							$modified_by = $_SESSION[user_name];
							$officer_privillage = $_SESSION[previlege_id];


							$qry1 = "delete   from a_imprest_voucher_details where imp_voucher_id=$imp_voucher_id and modified_by='$modified_by'
and 
officer_privillage='$officer_privillage'";
							$db = new DBAccess;
							$db->DBbeginTrans();

							$result = $db->UpdateData($qry1);

							if ($result1['EOF']) {
								$result['adl_msg'] = "Insert into amnt. details failed";
								$db->DBrollBackTrans();
								return $result;

								exit;
							}


							$row1 = $row[0];
							$item_serial = 1;
							$item_name = $row1[item_name];
							$item_amount = $row1[item_amount];
							$item_acc_code = $row[item_acc_code];
							$item_desc = $row[item_desc];


							$imp_voucher_detail_id = imprestN::getImpNumber();

							$date = date("Y-m-d");
							//$date=date("2019-03-25");
							$fy = imprestN::findFinancialYear($date);


							$qry = "
	
	
	
	
	insert into a_imprest_voucher_details
(
imp_voucher_detail_id,
imp_voucher_id,
item_serial,
item_name,
item_desc,
item_amount,
item_acc_code,
imprest_num,
item_gst,
item_gst_hsn_code,
item_admisibility,


officer_privillage,
modified_by,imp_fy,loc_code
) values
(
$imp_voucher_detail_id,
$imp_voucher_id,
$item_serial,
'$item_name',
'$item_desc',
$item_amount,
'$item_acc_code',
'$imp_num',
$item_gst,
$item_gst_hsn_code,
$item_admisibility,


'$officer_privillage',
'$modified_by','$fy',$_SESSION[location_code]




)
	
	";


							//echo $qry;	

							$result = $db->UpdateData($qry);
							if ($result1['EOF']) {
								$result['adl_msg'] = "Insert into amnt. details failed";
								$db->DBrollBackTrans();
								return $result;
							}
							$db->DBcommitTrans();
						}
					}




					?>


					<table id=tbl_adjust class="table table-stripped table-bordered">
						<caption class="bg-primary text-center">ADJUSTMENT SHEET</caption>

						<tr>

							<th>Item Name</th>
							<th>item Amount</th>
							<!--<th>item Description</th> 
				
				
								<th>Item GST Amount</th>
								<th>Item GST Account Code</th>  -->
							<th>Item Account Code</th>
							<!--<th>Admissible</th> -->
							<th>Remarks</th>
							<th><button id=add_item class="btn btn-success"><span class="fa fa-plus fa-lg"></span>&nbsp;Add</button></th>

						</tr>
						<?php
						foreach ($row as $rw1) {


							?>
							<tr class=tr_template>

								<td><input type=text value="<?php echo $rw1[item_name]; ?>" class="item_name form-control"></td>
								<td><input type=text value="<?php echo $rw1[item_amount]; ?>" class="item_amount form-control"></td>

								<!-- <td><input type=text class=form-control id=item_desc></td>  
							
										<td><input type=text class=form-control id=item_amount></td>
							
										<td><input type=text class=form-control id=item_gst></td>
					
										-->
								<td>

									<?php

									//echo "item acc code = $rw1[item_acc_code]";
									include_once("./../class/transHeads.class.php");
									global $ttype;
									global $loccode;
									$qry = "select  acc_head,acc_code from trans_heads th inner join data_master dm on dm.dm_id=th.dm_id where 
			
			
								trans_type=104 and visible=true and dm.loc_code=$loccode order by acc_code";

									///imprestN::select($qry,"acc_code","acc_head","item_acc_head","item_acc_head", $rw1[item_acc_code]);
									imprestN::select2key($qry, "acc_code", "acc_head", "acc_code", "item_acc_head", "item_acc_head", $rw1[item_acc_code]);

									//print_r($result);
									?>

								</td>











								<!--
										<td><label class="switch">
										<input type="checkbox">
										<span class="slider round"></span>
										</label></td>
										-->

								<td><textarea class="text_area_voucher_remark form-control"><?php echo $rw1[item_desc]; ?></textarea></td>
								<td><button class="btn btn-danger del">

										<span class="fa fa-minus fa-lg"></span>&nbsp;
										Delete


									</button></td>

							</tr>


						<?php
					}

					?>

						<tr>
							<td></td>
						</tr>


						<tfoot>


							<tr>
								<td colspan=5 class="text-center"><button class="btn btn-success text-center audit_bill ">

										<span class="fa fa-floppy-o fa-lg"></span>&nbsp;


										Save</button></td>
							</tr>
						</tfoot>

					</table>


					<table class="table table-bordered table-stripped">


					</table>


				<?php
			}








			break;


		case "btn_save_adjustments":
			//echo $_POST[vouchers_json];

			//echo "<h4 class=bg-primary>";
			//print_r($_POST);

			//echo "this";
			$imprest_num = $_POST[imprest_num];
			//echo $imprest_num;
			//echo "</h4>";
			$json = json_decode($_POST[vouchers_json], true);


			//print_r($json);





			//


			$item_gst = 0;
			$item_gst_hsn_code = 0;
			$item_admisibility = 'TRUE';

			//$item_acc_code=;
			$modified_by = $_SESSION[user_name];
			$officer_privillage = $_SESSION[previlege_id];



			$db = new DBAccess;
			$db->DBbeginTrans();


			$qry1 = "delete   from a_imprest_voucher_details where imprest_num='$imprest_num' and modified_by='$modified_by'
and 
officer_privillage='$officer_privillage'";


			$qry1 = "delete   from a_imprest_voucher_details where imprest_num='$imprest_num' 
and  officer_privillage='$officer_privillage'";
			//echo $qry1;
			$result = $db->UpdateData($qry1);

			if ($result['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;

				exit;
			}
			$error = 0;
			foreach ($json as $row) {

				foreach ($row as $out) {

					$imp_voucher_id = $out[voucher_id];
					$item_serial = $out[item_num];
					$item_name = $out[item_name];
					$item_amount = $out[item_amount];
					$item_acc_code = $out[item_acc_code];
					$item_desc = $out[item_acc_code];
					$imp_num = $out[imprest_num];


					$imp_voucher_detail_id = imprestN::getImpNumber();





					$qry1 = "delete   from a_imprest_voucher_details where  imp_voucher_id=$imp_voucher_id and

item_serial=$item_serial and  officer_privillage='$officer_privillage'";
					//echo $qry1;
					$result = $db->UpdateData($qry1);

					$qry1 = "select imp_voucher_id from a_imprest_voucher_details where imp_voucher_id=$imp_voucher_id and

item_serial=$item_serial and  officer_privillage='$officer_privillage'";

					$date = date("Y-m-d");
					//$date=date("2019-03-25");
					$fy = imprestN::findFinancialYear($date);

					//echo $qry1;
					//$db = new DBAccess;
					//$db->DBbeginTrans();


					//$result = $db->UpdateData($qry1);

					if (!imprestN::isDataInserted($qry1))
					//if(1)


					{




						$qry = "
	
	
	
	
	insert into a_imprest_voucher_details
(
imp_voucher_detail_id,
imp_voucher_id,
item_serial,
item_name,
item_desc,
item_amount,
item_acc_code,
imprest_num,
item_gst,
item_gst_hsn_code,
item_admisibility,


officer_privillage,
modified_by,imp_fy,loc_code
) values
(
$imp_voucher_detail_id,
$imp_voucher_id,
$item_serial,
'$item_name',
'$item_desc',
$item_amount,
'$item_acc_code',
'$imp_num',
$item_gst,
$item_gst_hsn_code,
$item_admisibility,


'$officer_privillage',
'$modified_by','$fy',$_SESSION[location_code]




)
returning imp_voucher_detail_id
	
	";


						//echo $qry;	

						//$result = $db->UpdateData($qry);
						$result = $db->UpdateDataAndReturn($qry);
						if ($result['EOF']) {
							$result['adl_msg'] = "Insert into amnt. details failed";
							$db->DBrollBackTrans();
							return $result;
						}

						$result1 = $result['data'];
						$imp_voucher_id1 = $result1[0];
						$imp_voucher_detail_id_from_table = $imp_voucher_id1[imp_voucher_detail_id];

						//echo "\n";

						//echo "$imp_voucher_detail_id_from_table";
						//echo "\n";
						//echo $imp_voucher_detail_id;

						if ($imp_voucher_detail_id != $imp_voucher_detail_id_from_table) {
							$error = $error + 1;
						}
						// 	}	
						// 		
						// 

					}
				}
			}
			$db->DBcommitTrans();


			if ($error > 0) {

				echo "ERROR*";
			} else {

				echo "NO_ERROR*";
			}

			

break;


		case "audit_bill":
			//
			echo "<h4 class=bg-primary>";
			//print_r($_SESSION);
			$imp_num = $_POST[imp_num];

			echo "</h4>";
			$json = json_decode($_POST[json], true);





			$imp_voucher_id = $_POST[voucher_id];


			$item_gst = 0;
			$item_gst_hsn_code = 0;
			$item_admisibility = 'TRUE';

			//$item_acc_code=;
			$modified_by = $_SESSION[user_name];
			$officer_privillage = $_SESSION[previlege_id];


			$qry1 = "delete   from a_imprest_voucher_details where imp_voucher_id=$imp_voucher_id and modified_by='$modified_by'
and 
officer_privillage='$officer_privillage'";
			$db = new DBAccess;
			$db->DBbeginTrans();

			$result = $db->UpdateData($qry1);

			if ($result1['EOF']) {
				$result['adl_msg'] = "Insert into amnt. details failed";
				$db->DBrollBackTrans();
				return $result;

				exit;
			}
			//$db->DBcommitTrans();

			foreach ($json as $row) {
				$item_serial = $row[0];
				$item_name = $row[1];
				$item_amount = $row[2];
				$item_acc_code = $row[3];
				$item_desc = $row[4];


				$imp_voucher_detail_id = imprestN::getImpNumber();

				//CHECK QRY


				$qry1 = "select imp_voucher_detail_id from a_imprest_voucher_details where imp_voucher_id=$imp_voucher_id and

item_serial=$item_serial";

				$date = date("Y-m-d");
				//$date=date("2019-03-25");
				$fy = imprestN::findFinancialYear($date);

				//echo $qry1;
				//$db = new DBAccess;
				//$db->DBbeginTrans();

				$result = $db->UpdateData($qry1);

				//if(!imprestN::isDataInserted($qry1))
				if (1) {




					$qry = "
	
	
	
	
	insert into a_imprest_voucher_details
(
imp_voucher_detail_id,
imp_voucher_id,
item_serial,
item_name,
item_desc,
item_amount,
item_acc_code,
imprest_num,
item_gst,
item_gst_hsn_code,
item_admisibility,


officer_privillage,
modified_by,imp_fy,loc_code
) values
(
$imp_voucher_detail_id,
$imp_voucher_id,
$item_serial,
'$item_name',
'$item_desc',
$item_amount,
'$item_acc_code',
'$imp_num',
$item_gst,
$item_gst_hsn_code,
$item_admisibility,


'$officer_privillage',
'$modified_by','$fy',$_SESSION[location_code]




)
	
	";


					//echo $qry;

					$result = $db->UpdateData($qry);
					if ($result1['EOF']) {
						$result['adl_msg'] = "Insert into amnt. details failed";
						$db->DBrollBackTrans();
						return $result;
					}
				}
				$db->DBcommitTrans();
			}



			break;


		case "save_remitance_details":
			//


			imprestN::add_remitance($_POST);



			break;
		case "save_remitance_details_and_convert":
			//


			imprestN::add_remitance_and_convert($_POST);



			break;



		case "deleteImprestOperation":

			imprestN::deleteImprestOperation($_POST);


			break;
		case "revokeVoucherAndDeleteImprestOperation":

			imprestN::revokeVoucherAndDeleteImprestOperation($_POST);


			break;

		case "showEditBox":


			//print_r($_POST);

			imprestN::showEditBox($_POST);



			break;

		case "btn_show_pending_action":

			$qry = "select ename,pending_days,imp_holder,office_name,branch,entity_name,from_date,designation  from
(select SPLIT_PART(imprest_id_ref,'/', 1) as imp_holder, to_office as pending_office,ename,date_part('day',age(now(),imp_opn_time)) as pending_days,

case
when to_branch::integer=1
then
v.branch_id 
else
to_branch::integer
end
as pending_branch
,to_char(imp_opn_time,'DD-MM-YYYY')as from_date from a_imprest_operations aio left join vw_office_setup v on aio.to_office= v.office_code
inner join dl_empl s on s.unique_code=SPLIT_PART(aio.imprest_id_ref,'/', 1)::integer

 where action_pending='t' and date_part('day',age(now(),imp_opn_time))>1 and  SPLIT_PART(imprest_id_ref,'/', 3)<>'VC' and v.is_head_of_office

)
 a inner join vw_office_setup v1 on v1.office_code=a.pending_office and a.pending_branch::text=v1.branch_id::text order by pending_days desc
";



			$qry = "select ename,pending_days,imp_holder,office_name,branch,entity_name,from_date,designation from 
(
    
    select SPLIT_PART(imprest_id_ref,'/', 1) as imp_holder, to_office as pending_office,ename,date_part('day',age(now(),imp_opn_time))
 as pending_days, case when to_branch='1' then v.branch_id::text else to_branch::text end as 
 pending_branch ,to_char(imp_opn_time,'DD-MM-YYYY')as from_date from a_imprest_operations aio left join 
 vw_office_setup v on aio.to_office= v.office_code inner join dl_empl s on s.unique_code::text=SPLIT_PART(aio.imprest_id_ref,'/', 1)
  where action_pending='t' and date_part('day',age(now(),imp_opn_time))>1 and SPLIT_PART(imprest_id_ref,'/', 3)<>'VC' and v.is_head_of_office
   )
   a inner join vw_office_setup v1 on v1.office_code=a.pending_office 
and a.pending_branch=v1.branch_id::text order by pending_days desc";

			//echo $qry;
			$db = new DBAccess;
			//echo $qry;
			$row1 = $db->SelectData($qry);




			echo "<table class=table border=1 style='border-left-color:rgb(255,130,255);border-style:solid; border-width:5px;'>";

			foreach ($row1 as $row) {


				echo "
<tr>
<td>$row[ename] </td>
<td>$row[pending_days] </td>
<td>$row[office_name] </td>
<td>$row[branch] </td>
<td>$row[entity_name] </td>
</tr>
";
			}

			echo "</table>";
			?>


				<?php


				break;




			case "alert_pending_sms":

				$qry = "select * from (select distinct user_name,entity_name,office_name,branch,to_office ,pending from (select to_office,
case
when to_branch='1'
then
v.branch_id::text
else
to_branch
end
,count(action_pending) as pending
from a_imprest_operations aio inner join vw_office_setup v on aio.to_office= v.office_code 


where action_pending='t' and v.is_head_of_office group by to_office,to_branch,v.branch_id

) a inner join vw_office_setup v1 on v1.office_code=a.to_office and a.to_branch::text=v1.branch_id::text

)b

 left join a_personal_contacts ap on ap.empcode::text=b.user_name 
 
 ";

				$db = new DBAccess;
				//echo $qry;
				$row1 = $db->SelectData($qry);

$p=0;
				foreach ($row1 as $row) {


					$phone = $row[phone];
					$employee = $row[entity_name];
					$pending = $row[pending];
					$branch = $row[branch];
					$office_name = $row[office_name];
					$office_code = $row[to_office];

					$msg = "Dear $employee,\nYou have $pending number items pending in your imprest inbox for further action at $branch of $office_name. \nRegards,\nRegional IT Unit Kozhikode";

					imprestN::send_sms($phone, $msg);
					//imprestN::send_sms(+919847599946,$msg.$phone);
					//imprestN::send_sms(+919847599946,$msg.$phone);
if($p==0)
{
	imprestN::send_sms(+919847599946,$msg.$phone);

}
$p++;					


imprestN::execute_sms($office_code, "", $msg);
					?>

					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Title!</strong><?php echo $msg . $phone; ?>
					</div>


				<?php

			}




			break;
		case "alert_pending_sms_to_feild":

			$qry = "select distinct imp_holder,office_name,branch,entity_name,from_date,designation,ename  from
(select SPLIT_PART(imprest_id_ref,'/', 1) as imp_holder, to_office,ename,

case
when to_branch='1'
then
v.branch_id::text
else
to_branch
end

,to_char(imp_opn_time,'DD-MM-YYYY')as from_date from a_imprest_operations aio left join vw_office_setup v on aio.to_office= v.office_code
inner join dl_empl s on s.unique_code=SPLIT_PART(aio.imprest_id_ref,'/', 1)::integer

 where action_pending='t' and date_part('day',age(now(),imp_opn_time))>2 and  SPLIT_PART(imprest_id_ref,'/', 3)<>'VC' and v.is_head_of_office

)
 a inner join vw_office_setup v1 on v1.office_code=a.to_office and a.to_branch=v1.branch_id::text

 
 ";

			$db = new DBAccess;
			//echo $qry;
			$row1 = $db->SelectData($qry);


			foreach ($row1 as $row) {


				$empcode = $row[imp_holder];
				$employee = $row[ename];
				//$pending=$row[pending];
				$branch = $row[branch];
				$office_name = $row[office_name];
				$from_date = $row[from_date];
				$with = $row[entity_name] . "," . $row[designation];
				//$office_code=$row[to_office];

				$msg = "Dear $employee,\nYour Imprest is with  $with at $branch of $office_name from $from_date.\nRegards,\nRegional IT Unit Kozhikode";

				//imprestN::send_sms($phone,$msg);
				//imprestN::send_sms(+919847599946,$msg.$phone);
				//imprestN::send_sms(+919847599946,$msg.$empcode);
				imprestN::execute_sms_personal($empcode, "", $msg);



				if($p==0)
{
	imprestN::send_sms(+919847599946,$msg.$phone);

}
$p++;					//imprestN::execute_sms($office_code, "", $msg);
		
				//


				
				//imprestN::execute_sms($office_code,"",$msg);
				?>

					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Title!</strong><?php echo $msg . $phone; ?>
					</div>


				<?php

			}




			break;





		case "get_supporting_documents":


			$qry = "select * from a_imprest_files where imp_voucher_id=$_POST[imp_voucher_id] and imp_file_category<>'V'";
			$db = new DBAccess;
			//echo $qry;
			$row1 = $db->SelectData($qry);
			if ($row1['EOF'] == "1") {

				echo json_encode(array("has_sup_doc" => "nil"));
			} else {
				//res=array("has_sup_doc"=>"notnil");

				//$supfiles=array();
				// foreach ($row1 as $row){


				// 	array_push($supfiles,"file_type"=>"$row[imp_file_type]","file_cat"=>"$row[imp_file_category]","file_link"=>"$row[imp_file]");

				// 		}


				$ar = array("supfiles" => $row1, "has_sup_doc" => "notnil");


				echo json_encode($ar);
			}



			break;



		case "btn_make_live":


			$imp_op_id = $_POST[imp_op_id];
			$qry = "update a_imprest_operations set action_pending='t' where imprest_op_id=$imp_op_id";
			$db = new DBAccess;

			$db->DBbeginTrans();
			echo $qry;
			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$db->DBrollBackTrans();
				return $result;
			}

			$db->DBcommitTrans();

			break;

		case "btn_make_sleep":


			$imp_op_id = $_POST[imp_op_id];
			$qry = "update a_imprest_operations set action_pending='f' where imprest_op_id=$imp_op_id";
			$db = new DBAccess;
			//echo $qry;
			$db->DBbeginTrans();

			$result = $db->UpdateData($qry);
			if ($result['EOF']) {
				$db->DBrollBackTrans();
				return $result;
			}

			$db->DBcommitTrans();

			break;





		case "btn_fwd_voucher":


			//print_r($_POST);

			//echo $_SESSION[option];
			//echo $_POST[option];
if( $_SESSION['option']=='btn_fwd_voucher'){
	unset($_SESSION["option"]);

	imprestN::fwd_vouchers($_POST);

}else{

	imprestN::alert_failed("Dupication");

}
			




			break;


		case "btn_submit_vouchers":


			///print_r($_POST);

			imprestN::submit_vouchers($_POST);



			break;


		case "btn_show_imprest_vouchers":
			?>


				<div class=row>
					<div class="col-sm-12 well">
						<div class=row>
							<div class="col-sm-11">
								<?php


								//qry for carosal
								$qry = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where aiv.imp_holder='$_SESSION[user_name]' and aiv.imp_holder_office='$_SESSION[office_code]' and voucher_status=1
and aif.imp_file_category='V'

order by  date_of_payment,upload_time desc

";

								imprestN::show_carosal("id_carosal", $qry); ?>

							</div>

						</div>

						<div class=row>
							<div class="col-sm-11">
								<?php 
								?>

							</div>

						</div>

						<div class=row>
							<div class="col-sm-8 col-sm-offset-4">
								<?php 
								?>

								<button id=btn_view_and_verify_cash_book class="btn btn-info">
									<span class="fa fa fa-eye fa-lg"></span>&nbsp;
									View and Verify cash book</button>

							</div>

						</div>





					</div>
				</div>






				<?php

				break;


			case "toggle_v_to_vc":


				$imprest_id_ref = $_POST[imprest_id_ref];
				$close = $_POST[close];

				if ($close == 1) {

					$old = "V/";
					$new = "VC/";
				} else if ($close == 0) {
					$old = "VC/";
					$new = "V/";
				}



				$db = new DBAccess;
				//$db->DBbeginTrans();


				$qry = "Update a_imprest_voucher set imprest_num=replace(imprest_num,'$old','$new') 

where imprest_num='$imprest_id_ref'";


				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into a_imprest failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}

				$qry = "Update a_imprest_operations set imprest_id_ref=replace(imprest_id_ref,'$old','$new') 

where imprest_id_ref='$imprest_id_ref'";

				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into a_imprest failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					return $result;
				}

				$qry = "Update a_imprest_operations set imprest_id_ref=replace(imprest_id_ref,'$old','$new') 

where imprest_id_ref='$imprest_id_ref'";


				//$db->DBcommitTrans();






				break;
			case "btn_convert_to_recoupment":
//print_r($_POST);

				$imprest_id_ref = $_POST[imprest_id_ref];
				$close = $_POST[close];

				if ($close == 1) {

					$old = "V/";
					$new = "VC/";
				} else if ($close == 0) {
					$old = "VC/";
					$new = "V/";
				}



				$old = "VC/";
				$new = "V/";

				$db = new DBAccess;
				$db->DBbeginTrans();

				echo "New $new ,$old $old";

				$qry = "delete from  a_imprest_voucher 
				
				
where type='remitance' and 
				
				imprest_num='$imprest_id_ref'";

				$result=$db->UpdateData($qry);
				 
				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into a_imprest failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					echo $qry;
					return $result;
				}



				$qry = "Update a_imprest_voucher set imprest_num=replace(imprest_num,'$old','$new') 

where imprest_num='$imprest_id_ref'";

$result=$db->UpdateData($qry);
				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into a_imprest failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					echo $qry;
					return $result;
				}

				$qry = "Update a_imprest_operations set imprest_id_ref=replace(imprest_id_ref,'$old','$new') 

where imprest_id_ref='$imprest_id_ref'";
$result=$db->UpdateData($qry);

				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into a_imprest failed";
					$result['err'] = $result['err'] + 1;
					echo $qry;
					$db->DBrollBackTrans();
					return $result;
				}
				
				

				$db->DBcommitTrans();






				break;

case "attach_vouchers":
$imprest_id_ref=$_POST[imprest_id_ref];
$empcode1=split("/",$imprest_id_ref);
			$original_office=$empcode1[1];
			$imp_holder=$empcode1[0];

$qry="update a_imprest_voucher set voucher_status=2, imprest_num='$imprest_id_ref' 
where imp_holder='$imp_holder' and imp_holder_office='$original_office' and voucher_status=1
 and coalesce(type,'0')<>'r'
 ";

echo $qry;
$db=new DBAccess;
		
		$db->DBbeginTrans();
		
		
		
		$result=$db->UpdateData($qry);

			
			if($result['EOF'])
		{	$result['adl_msg1']="Insert into a_imprest failed";
			$result['err']=$result['err']+1;
			$db->DBrollBackTrans();
			return $result;
		}

		$db->DBcommitTrans();

break;
case "strip_voucher":
$imprest_voucher_id=$_POST[imprest_voucher_id];
$imprest_id_ref="";
// $empcode1=split("/",$imprest_id_ref);
// 			$original_office=$empcode1[1];
// 			$imp_holder=$empcode1[0];

$qry="update a_imprest_voucher set voucher_status=1, imprest_num='$imprest_id_ref' 
where imp_voucher_id=$imprest_voucher_id
 ";

echo $qry;
$db=new DBAccess;
		
		$db->DBbeginTrans();
		
		
		
		//$result=$db->UpdateData($qry);

			
			if($result['EOF'])
		{	$result['adl_msg1']="Insert into a_imprest failed";
			$result['err']=$result['err']+1;
			$db->DBrollBackTrans();
			return $result;
		}

		$db->DBcommitTrans();

break;


			case "show_option_to_close_imprest":
				$post = $_POST;
				//imp_ref_id
				//print_r($post);



				$class = 'form-control';
				$btn_class = 'btn btn-info';
				$Button_text = "Save Remittance details";
				$style = "border:1px solid";
				$class1 = "form-control";

				$imprest_id_ref = $post[imp_ref_id];
				$empcode1 = split("/", $post[imp_ref_id]);
				$original_office = $empcode1[1];
				$imp_holder = $empcode1[0];
				$date=date("Y-m-d");
		//$date=date("2019-03-25");
	
	
	$fy=imprestN::findFinancialYear($date);
				$fy = '2018-2019';
				$qry = "select * from a_imprest_voucher where imp_holder='$imp_holder' 
				and imp_holder_office='$original_office' and imp_fy='$fy' and type='remitance'";
				$db = new DBAccess;
				$row1 = $db->SelectData($qry);
				//echo $qry;
				$row = $row1[0];

				//print_r($row);



				//if($original_office==$_SESSION[office_code] && $imp_holder==$_SESSION[user_name] )
				if ($_SESSION[aquired] == 1 or ($imp_holder == $_SESSION[user_name])) {
					?>




					<table id=tbl_remitance_details_final_closing style=<?php echo $style; ?> class="table table-bordered table stripped ">
						<tr>
							<td>Remitence Amount</td>
							<td> <input type=text class='<?php echo $class; ?>' <?php echo $disabled; ?> name=txtremit id=txt_txtremit value=<?php echo $row[amount]; ?>></td>



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
							<td colspan=4 class=text-center><button class='<?php echo $btn_class; ?>' data-imprest_id_ref='<?php echo $post[imp_ref_id]; ?>' id=save_remitance_details_and_convert>

									<span class="fa fa-money fa-lg"></span>&nbsp;

									<?php echo $Button_text; ?></button></td>
						</tr>

					</table>
					</td>

					</tr>
				</table>


			<?php

		}

		break;
			


	case "btn_show_imprest_cash_book":
		?>


			<div class=row>
				<div class="col-sm-12 well">
					<div class=row>
						<div class="col-sm-12">
							<?php


							//qry for carosal
							$qry = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where aiv.imp_holder='$_SESSION[user_name]' and aiv.imp_holder_office='$_SESSION[office_code]' and aif.imp_file_category='V'
order by date_of_payment,upload_time asc
";

							
							?>

						</div>

					</div>

					<div class=row>
						<div class="col-sm-12">
							<?php imprestN::show_imprest_cash_book(); ?>

						</div>

					</div>

					<?php
					imprestN::showRemitanceOption();
					?>

					<div class=row>
						<div class="col-sm-12">
							<span class='fa fa-thumbs-up fa-lg  text-center' style='color:blue'>ADD CERTIFICATE <input type=checkbox id=auto_certificate></span> <br>

							<span class='fa fa-sticky-note-o fa-lg  text-center' style='color:blue'>ADD COVERING LETTER <input type=checkbox id=auto_letter></span>

							<?php imprestN::show_noting_form(); ?>

						</div>

					</div>





				</div>
			</div>






			<?php
			break;


		case "keyup_amount_voucher":


			$newVoucher = $_POST[amount];
			$aru_balance = $_POST[cash_in_hand];
			imprestN::getImprestBalance($newVoucher, $aru_balance);

			break;

		case "tbody_imp_vouchers":




			//echo $_FILES[data_of_purchase][tmp_name];
			imprestN::add_voucher($_POST, $_FILES);

			//print_r($_POST);

			break;


		case "btn_fwd_imprest":
			//print_r($_POST);
			imprestN::fwd_imprest($_POST[to_office], $_POST[msg], $_POST[imprest_ref_id], $_POST[branch_id], $_POST[imp_op_id], $_POST[inReceiversInBox]);

			break;


		case "add_imprest_holder":

			include_once('../class/EntityVtwo.class.php');


			$arrValues['emp_code'] = $_POST[emp_code];

			//$arrValues['emp_code']=1064767;
			$arrValues['office_code'] = $_POST[office_code];


			$entity = new entityVtwo;
			$status = $entity->addAsEmployeeAndImprestHolder($arrValues);
			echo $status;





			break;



		case "tr_input_box":

			$empcode1 = split("/", $post[imp_ref_id]);
			$original_office = $empcode1[1];
			$imp_holder = $empcode1[0];

			// if aru head
			$post = $_POST;

			$empcode1 = split("/", $post[imp_ref_id]);
			$original_office = $empcode1[1];
			$imp_holder = $empcode1[0];
			//print_r($_POST);

			//echo $_POST[imp_operation];
			//print_r($_POST);
			?>

			<?php


			if ($_SESSION[aru_code] == $_SESSION[office_code]) $office_is_aru = 1;
			else $office_is_aru = 0;

			//Submitted Imprest Vocuhers to Higher office

			$aru_head = 0;

			if ($_POST[imp_operation] == "666") {

				imprestN::show_vouchers_action_at_aru_returned($_POST, $office_is_aru);
			} else if ($_POST[imp_operation] == "999" or $_POST[imp_operation] == "91" or $_POST[imp_operation] == "19" or $_POST[imp_operation] == "18" or  $_POST[imp_operation] == "193" or  $_POST[imp_operation] == "192" or  $_POST[imp_operation] == "191") {




				if ($office_is_aru == 0) {

					//echo "0 is aru $office_is_aru";
					imprestN::show_vouchers_submitted($_POST, $aru_head);
				} else  if ($office_is_aru == 1) {
					imprestN::show_vouchers_action_at_aru($_POST, $office_is_aru);
					//echo "1 is aru $office_is_aru";
				}
			} elseif ($_POST[imp_operation] == 11 or $_POST[imp_operation] == 1 or ($_POST[imp_operation] > 110 and $_POST[imp_operation] < 116))

				imprestN::show_in_box_details($_POST, $aru_head);


			//////////////////////////////convert to final closing

			$imprest_id_ref = $post[imp_ref_id];
			$empcode1 = split("/", $post[imp_ref_id]);
			$original_office = $empcode1[1];
			$imp_holder = $empcode1[0];
			$type = $empcode1[2];
		
			$date = date("Y-m-d");
						//$date=date("2019-03-31");
$fy = imprestN::findFinancialYear($date);
			
			$qry = "select * from a_imprest_voucher where imp_holder='$imp_holder' and imp_holder_office='$original_office'
			 and imp_fy='$fy' and type='remitance'";
			$db = new DBAccess;
			$row1 = $db->SelectData($qry);

			//print_r($row1);
			//echo $qry;
			if ($row1['EOF'] == 1) {

				if ($type == 'V') {

					$btn_text = "&nbspConvert To Final Closing";
					$btn_special_class = "btn-primary btn  btn-block  toggle_v_to_vc";
				} elseif($type == 'VC') {
					$btn_text = "Edit  Final Closing details";
					$btn_special_class = "btn-warning btn  btn-block  toggle_v_to_vc";
				}
			}
			 else {

				$btn_text = "Edit  Final Closing details";
				$btn_special_class = "btn-warning btn  btn-block  toggle_v_to_vc";
			}
		
			//if($_SESSION[office_code]==$_SESSION[aru_code] or ($imp_holder==$_SESSION[user_name]))
			if ($_SESSION[aquired] == 1 or ($imp_holder == $_SESSION[user_name])) {
				?>




				<div class="row">

					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
						<button type="button" data-imprest_id_ref='<?php echo  $post[imp_ref_id]; ?>'
						 data-close=1 id='btn_convert_to_closing' class="<?php echo "$btn_special_class"; ?>">
							<?php echo $btn_text; ?>


						</button>


					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
						<button type="button" data-imprest_id_ref='<?php echo  $post[imp_ref_id]; ?>'
						 data-close=1 id='btn_convert_to_recoupment' class="btn-success btn  btn-block">
							
						 Convert to Recoupment


						</button>


					</div>

				</div>

				<div id=div_show_option_to_close_imprest></div>


			<?php
		}






		break;

	case "btn_show_imprest_cash_book1":

		imprestN::show_imprest_cash_book1($_POST);
		break;



	case "tr_output_box":
		//print_r($_POST);


		imprestN::show_out_box_details($_POST);
		imprestN::show_vouchers_submitted($_POST);

		break;

	case "btn_show_out_box":
		imprestN::show_out_box();

		break;

	case "send_otp":
		$type = $_POST[type];
		$phone = '+91' . $_POST[phone];
		$otp = rand(2345, 9876);
		$message = "OTP to Validate your  Phone number by  KSEBL is $otp. Do not share with Anyone";
		imprestN::send_sms($phone, $message);
		$_SESSION[otp] = $otp;
		$_SESSION[phone] = $_POST[phone];

		//echo $message;

		if ($type == "cug") { ?><div class='col-sm-3 col-sm-offset-3' id=cug_otp_res>
					<label class=text-danger>Enter OTP CUG </label>
					<input type=text class='form-control' id=txt_otp_cug>
					<button class='btn btn-success submit_otp' id=btn_sbmt_cug_otp>Submit OTP</button>
				</div>

			<?php


		}

		if ($type == "noncug") { ?><div class='col-sm-3 col-sm-offset-3' id=per_otp_res>
					<label class=text-danger>Enter OTP Mobile </label>
					<input type=text class='form-control' id=txt_otp_mobile>
					<button class='btn btn-success submit_otp' id=btn_sbmt_per_otp>Submit OTP</button>
				</div>

			<?php


		}

		break;

	case "btn_save_personal":


		$phone = $_POST[phone];
		$office_code = $_SESSION[office_code];
		$desig_id = $_SESSION[designation_id];

		/// chek inserted

		$ph = "CUG";
		$db = new DBAccess;

		$qry1 = "select * from a_personal_contacts where empcode=$_SESSION[user_name] ";

		//echo $qry1;
		$row = $db->SelectData($qry1);
		if ($row[EOF] == 1) {
			$qry = "Insert into a_personal_contacts (empcode,phone) 
					values ($_SESSION[user_name],$phone)";
		} else {

			$qry = "update a_personal_contacts set phone=$phone where empcode=$_SESSION[user_name] ";
		}


		//echo $qry;			

		$db = new DBAccess;
		$db->DBbeginTrans();

		//$row=$db->SelectData($qry);

		$result = $db->UpdateData($qry);

		if ($result['EOF']) {
			$result['adl_msg1'] = "Insert into cug failed";
			$result['err'] = $result['err'] + 1;
			$db->DBrollBackTrans();
			$result = "notok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>$ph Mobile Number Updation failed", "alert alert-danger");

			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		} else {

			$result = "ok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>$ph Mobile Number updated Successfully", "alert alert-success");


			$html = $html;


			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		}

		$db->DBcommitTrans();

		break;



	case "btn_save_cug":
		$phone = $_POST[phone];
		$office_code = $_SESSION[office_code];
		$desig_id = $_SESSION[designation_id];

		/// chek inserted

		$ph = "CUG";
		$db = new DBAccess;

		$qry1 = "select * from a_cug where office_id=$office_code and desig_id=$desig_id ";


		$row = $db->SelectData($qry1);
		if ($row[EOF] == 1) {
			$qry = "Insert into a_cug (cug,office_id,desig_id) 
					values ($phone,$office_code,$desig_id)";
		} else {

			$qry = "update a_cug set cug=$phone where office_id=$office_code and desig_id=$desig_id ";
		}


		//echo $qry;			

		$db = new DBAccess;
		$db->DBbeginTrans();

		//$row=$db->SelectData($qry);

		$result = $db->UpdateData($qry);

		if ($result['EOF']) {
			$result['adl_msg1'] = "Insert into cug failed";
			$result['err'] = $result['err'] + 1;
			$db->DBrollBackTrans();
			$result = "notok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>$ph Mobile Number Updation failed", "alert alert-danger");

			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		} else {

			$result = "ok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>$ph Mobile Number updated Successfully", "alert alert-success");


			$html = $html;



			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		}

		$db->DBcommitTrans();

		break;





	case "validate_otp":

		//print_r($_POST);

		$response = array();
		$otp = $_POST[otp];
		$phone = $_SESSION[phone];
		$office_code = $_SESSION[office_code];
		$desig_id = $_SESSION[designation_id];
		$cugFlag = $_POST[cugFlag];



		////////////////validation////////////////

		if ($otp == $_SESSION[otp]) {
			//otp validated update database

			if ($cugFlag == 1) {

				/// chek inserted

				$ph = "CUG";
				$db = new DBAccess;

				$qry1 = "select * from a_cug where office_id=$office_code and desig_id=$desig_id ";

				//echo $qry1;
				$row = $db->SelectData($qry1);
				if ($row[EOF] == 1) {
					$qry = "Insert into a_cug (cug,office_id,desig_id) 
					values ($phone,$office_code,$desig_id)";
				} else {

					$qry = "update a_cug set cug=$phone where office_id=$office_code and desig_id=$desig_id ";
				}


				//echo $qry;			

				$db = new DBAccess;
				$db->DBbeginTrans();

				//$row=$db->SelectData($qry);

				$result = $db->UpdateData($qry);

				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into cug failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					$result = "notok";
					$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
					$html = imprestN::show_alert1("$i <br>$ph Mobile Number Updation failed", "alert alert-danger");

					$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
					echo json_encode($response);
				}

				$db->DBcommitTrans();

				unset($_SESSION[otp]);
				unset($_SESSION[phone]);
				//// showing  input for 





			} elseif ($cugFlag == 0) {
				$ph = "Your";
				/// chek insertedd
				$db = new DBAccess;

				$qry1 = "select * from a_personal_contacts where empcode=$_SESSION[user_name] ";

				//echo $qry1;
				$row = $db->SelectData($qry1);
				if ($row[EOF] == 1) {
					$qry = "Insert into a_personal_contacts (empcode,phone) 
					values ($_SESSION[user_name],$phone)";
				} else {

					$qry = "update a_personal_contacts set phone=$phone where empcode=$_SESSION[user_name] ";
				}


				//echo $qry;			

				$db = new DBAccess;
				$db->DBbeginTrans();

				//$row=$db->SelectData($qry);

				$result = $db->UpdateData($qry);

				if ($result['EOF']) {
					$result['adl_msg1'] = "Insert into cpers contact failed";
					$result['err'] = $result['err'] + 1;
					$db->DBrollBackTrans();
					$result = "notok";
					$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
					$html = imprestN::show_alert1("$i <br>$ph Mobile Number Updation failed", "alert alert-danger");

					$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
					echo json_encode($response);
				}

				$db->DBcommitTrans();

				unset($_SESSION[otp]);
				unset($_SESSION[phone]);
			}


			$result = "ok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>$ph Mobile Number updated Successfully", "alert alert-success");

			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		} else {

			$result = "notok";
			$i = "<i class=\"fa fa-check fa-3x\" style=\"color:green\" aria-hidden=\"true\">Success !!</i>";
			$html = imprestN::show_alert1("$i <br>$ph Mobile Number Updation failed", "alert alert-danger");

			$response = array("result" => "$result", "html" => "$html", "type" => "$ph");
			echo json_encode($response);
		}




		break;







	case "btn_show_inbox":

		//print_r($_SESSION);
		//$phone='+919847599946';
		//$message="In box viewd by $_SESSION[full_name] $_SESSION[office_name]";
		//imprestN::send_sms($phone,$message);

		if ($_SESSION[user_name] != '1064767' or  !isset($_SESSION[aquired])) {

			//imprestN::send_sms($phone,$message);
		}




		// $haspower=imprestN::isOfficerWithimprestHoldingPower();
		// if($haspower)
		// {

		imprestN::firstSetup();
		// exit;
		// }

		//print_r($_SESSION);
		//qry for carosal
		$qry = "select * from a_imprest_voucher aiv inner join a_imprest_files aif on aiv.imp_voucher_id=aif.imp_voucher_id 
where aiv.imp_holder='$_SESSION[user_name]' and aiv.imp_holder_office='$_SESSION[office_code]'
and aif.imp_file_category='V'
order by date_of_payment
";

		//imprestN::show_carosal("id_carosal",$qry); 

		$load_carosal = 0;



		imprestN::show_input_box();


		//echo "hi bro" ;








		break;


	case "btn_save_cash_in_hand":

		imprestN::save_cash_in_hand($_POST);
		break;




	case "btn_submit_perm_imp_req":

		imprestN::submit_imprest_request($_POST, $_FILES);



		break;





	case 1:

		$isOfficerWithImprestHoldingPower = imprestN::isOfficerWithImprestHoldingPower();


		if ($isOfficerWithImprestHoldingPower) {

			//imprestN::show_alert("Imprest request for FY 2019 will open on 4-04-2019");
			imprestN::select_imprest_type();
		} else {
			$msg = "<i class=\"fa fa-exclamation-triangle fa-3x text-center\" aria-hidden=\"true\"style=\"color:red\">  No Imprest Holding Power</i>";
			imprestN::show_error($msg);
		}


		break;

	case 2:


		$requestInProcess = false;
		$PermenentImprestExisting = false;

		$isOfficerWithImprestHoldingPower = imprestN::isOfficerWithImprestHoldingPower();

		if ($isOfficerWithImprestHoldingPower) {
			if ((!$PermenentImprestExisting &&  !$requestInProces)) {


				///imprestN::show_alert("Imprest request for FY 2019 will open on 24-04-2019");
				imprestN::show_permanant_imprest_form_new();


				//imprestN::show_permanant_imprest_form_old_version();
			} else {

				$msg = "Already an Unclosed Imprest is Existing.\n <p class=lead>Please Close the Existing Permanant Imprest</p>";
				imprestN::show_error($msg);
			}
		} else {
			$msg = "<p>No Imprest Holding Power</p>";
			imprestN::show_error($msg);
		}

		break;

	case 3:

		$temporaryImprestExisting = false;
		$requestInProcess = true;

		if (!$temporaryImprestExisting) {

			imprestN::show_temporary_imprest_form();
		} else {

			$msg = "Already a Unclosed Temporary Imprest is Existing.<p class=lead> Please Close the existing Temporary Imprest</p>";
			imprestN::show_error($msg);
		}




		break;





	case "btn_save_month_details":

		$i_month = $_POST[i_month];
		$i_year = $_POST[i_year];
		$imp_holder = $_SESSION[user_name];
		$imp_holder_office = $_SESSION[office_code];
		$status = 1; // first status =1

		$qry = "select * from a_imprest_details where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and status=1";

		$db = new DBAccess;
		$row = $db->SelectData($qry);
		if ($row[EOF] == 1) {

			$qry = "insert into a_imprest_details 
					(i_month,i_year,imp_holder,imp_holder_office,status)
					values
					('$i_month',$i_year,$imp_holder,$imp_holder_office,$status)


					";

			//echo $qry;
			$db->DBbeginTrans();
			//$row=$db->SelectData($qry);


			$result = $db->UpdateData($qry);

			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				$msg = "Failed to Update";
				imprestN::alert_failed($msg);
				return $result;
			} else {

				$msg = "successfully updated";
				imprestN::alert_success($msg);
				$db->DBcommitTrans();
			}
		} else {



			//update year and month

			$qry = "update a_imprest_details set i_month='$i_month',i_year=$i_year where
	 imp_holder=$imp_holder
	 and imp_holder_office=$imp_holder_office and status=$status
				


					";
			$db->DBbeginTrans();
			$row = $db->SelectData($qry);


			$result = $db->UpdateData($qry);

			if ($result['EOF']) {
				$result['adl_msg1'] = "Insert into a_imprest failed";
				$result['err'] = $result['err'] + 1;
				$db->DBrollBackTrans();
				$msg = "Failed to Update";
				imprestN::alert_success($msg);
				return $result;
			} else {

				$msg = "successfully updated";
				imprestN::alert_success($msg);
				$db->DBcommitTrans();
			}
		}

		break;


	case "call_recoupment_form":
		imprestN::landing_recoupment();

		break;

	case "check_any_voucher_uploaded":


		$imp_holder = $_SESSION[user_name];
		$imp_holder_office = $_SESSION[office_code];
		$status = 1; // first status =1
		$qry = "select count(*) from a_imprest_voucher where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]'  
and type<>'r' and type<>'cash_in_hand' and
voucher_status=1";


		//echo $qry;
		$db = new DBAccess;
		$row1 = $db->SelectData($qry);
		$row = $row1[0];
		//check initial settings done
		//$db=new DBAccess;

		if ($row['count'] == 0) {

			echo "ALLOW";
		} else {
			echo "DENY";
		}



		break;



	case "btn_show_initial_setup":

		imprestN::landing_recoupment();

		break;

		$isOfficerWithImprestHoldingPower = imprestN::isOfficerWithImprestHoldingPower();

		$mobile = $_POST[mobile];
		//echo "mobile is $mobile";

		if ($isOfficerWithImprestHoldingPower) {

			if ($mobile == 0) {
				//if($_SESSION[user_name]==1063735){
				if (1) {

					$imp_holder = $_SESSION[user_name];
					$imp_holder_office = $_SESSION[office_code];
					$status = 1; // first status =1
					$qry = "select * from a_imprest_details where imp_holder='$_SESSION[user_name]' and imp_holder_office='$_SESSION[office_code]' and status=1";


					echo $qry;
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


					//	if($_SESSION[user_name]==1064767)
					if (1) { } else {

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



		break;


	case 4:

		$isOfficerWithImprestHoldingPower = imprestN::isOfficerWithImprestHoldingPower();

		$mobile = $_POST[mobile];
		//echo "mobile is $mobile";

		if ($isOfficerWithImprestHoldingPower) {

			if ($mobile == 0) {
				//if($_SESSION[user_name]==1064767 or $_SESSION[user_name]==1063735 ){
				if (1) {


					imprestN::show_initial_set_up_for_month();

					//imprestN::show_recoupment_imprest_form_with_addition();

				} else {

					//imprestN::show_recoupment_imprest_form();
					//imprestN::show_recoupment_imprest_form_with_addition();


					//if($_SESSION[user_name]==1064767 or $_SESSION[user_name]==1063735){
					if (1) { } else {
						imprestN::show_initial_set_up_for_month();
						//imprestN::show_alert("Imprest request for FY 2019 will open on 24-04-2019");
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



		break;
}
} // if no session
else {
	include_once("imprest.class.php");
	$ar = array("Error" => $err, "html" => $html);

	$msg = "Your Session is Expired,Please Log in Again";
	imprestN::show_alert($msg, "alert alert-danger");
}
} else {

	//imprestN::show_alert("Imprest Software is under maintenance . Will be back shortly . whatsapp 9847599946 ");
	//imprestN::show_alert("Imprest Software is under maintenance . Will be back shortly . whatsapp 9847599946 ");

	echo "<h1 style='color:blue;background:yellow;'>Imprest Software is under maintenance . Will be back at 2 PM on 26/05/19. whatsapp 9847599946<h1>";
	//session_destroy();

}
?>