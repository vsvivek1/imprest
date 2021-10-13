<?php 
session_start();
include_once("./../class/DBAccess.class.php");
include_once("imp_head.php");
include_once("common.class_imp.php");
?>


<script>function openImprestOpen() {  window.open('imprest_management.php?frombtn=1', 'f'); }</script>






<div style="text-align:right;">
			<!--<A style="display:block;text-align:right; cursor: 
			pointer;" href="./expAcc.php?id=1040007&frombtn=1&sid=<?php echo $sid;?>"> -->
			<!--	<img style="margin: 0 auto; text-align:right;" 
			src="../public/img/imprest.png" alt="Imprest module" />-->
	
								
								
								<div class="panel panel-primary">
									  <div class="panel-heading">
									 <span class='fa fa-ksebl fa-2x fa-pulsating pull-left'></span>
											<h3 class="panel-title ">Imprest Dash Board</h3>
									  </div>
									  <div class="panel-body">
									  <?php 
									  

									  $qry="select count(action_pending) ,

									  case when name is null
									  then  (select branch from vw_office_setup where office_code='$_SESSION[office_code]' 
									   and is_head_of_office='t')
|| ' Inward landing '
									  else
									  name
									  END 

									   from a_imprest_operations aio
									  
									  left join branch b on aio.to_branch=b.id::text
									   where action_pending='t' and to_office='$_SESSION[office_code]' group by name"; 
// echo $qry;
									   $db=new DBAccess;



//echo $qry;
$row=$db->SelectData($qry);

//print_r($row);
if($row[EOF]==1){

	$nop="";
}

else
{
	?>


		<!-- Table -->
		<table class="table">
			<thead>
				<tr>
					<th>Branch</th>
				
					
				
					<th class=pull-right>Pending</th>
				</tr>
			</thead>
			<tbody>



			<?php 
			
			foreach ($row as $rw)
			
			{

			echo "
				<tr>
					<td class='text-primary pull-left'>$rw[name]</td>
				
					
				
					<td class='text-danger '><span class=badge>$rw[count]</span></td>
				</tr>
";




			}?>
				
			</tbody>
		</table>
</div>


	<?php



}
									
									 
									 ?>
									  
<img style="margin: 0 auto; text-align:right;cursor:pointer" src="../public/img/imprest.png" alt="Imprest module" onclick="openImprestOpen();"/>
								
									  </div>
								</div>

		<?php
		if($_SESSION[user_name]=='1064767'){

			?>
			<div>
				<h2 class="bg-primary">Fastest Recoupments</h2>
			<table class="table table-bordered table-compact">
				<thead>
					<th>RANK</th>
					<th>TIME</th>
					<th>NAME</th>
					<th>OFFICE</th>
				</thead>
			<tbody>
			<?php


$qry="select age(b.imp_opn_time,a.imp_opn_time) as TIME_FOR_RECOUPMENT /*,a.imprest_id_ref*/,ename AS EMPLOYEENAME,o.name AS OFFICE from

(select imp_opn_time,imprest_id_ref,action_by,from_office from a_imprest_operations where imp_operation='18') a

inner join


(select imp_opn_time,imprest_id_ref from a_imprest_operations where imp_operation='200') b on a.imprest_id_ref=b.imprest_id_ref

inner join dl_empl d on a.action_by=d.unique_code::text

inner join offices o on o.code=a.from_office
and a.imp_opn_time between date_trunc('MONTH',now())::DATE and
 (date_trunc('month',now()) + interval '1 month' - interval '1 day')::date

 and age(b.imp_opn_time,a.imp_opn_time)<'3 days' order by TIME_FOR_RECOUPMENT asc ;


";
$db=new DBAccess;



// echo $qry;
$row1=$db->SelectData($qry);

// 
if($row1['EOF']==1){

	$nop="";
}

else
{
 $sl=1;
 echo "<tbody>";
	foreach($row1 as $row ){
		$dt=date('H',strtotime($row['time_for_recoupment']));
		echo "
	
		<tr>
							
		
		<td>$sl</td>
		<td>$dt</td>

		<td>$row[employeename]</td>
		<td>$row[office]</td>
									
										</tr>
		
		
		";
		$sl++;

	}
	



}

?>
	
								</tbody>

								</table>

								

<?php

		}
		?>
								

								
				
				
			<!--</A>-->
	</div>

	

