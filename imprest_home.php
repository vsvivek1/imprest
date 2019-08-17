<?php 
session_start();
include_once("./../class/DBAccess.class.php");
include_once("imp_head.php");
include_once("common.class_imp.php");
?>


<script>function openImprestOpen() {  window.open('imprest_management.php?frombtn=1', 'f'); }</script>






<div style="text-align:right;">
			<!--<A style="display:block;text-align:right; cursor: pointer;" href="./expAcc.php?id=1040007&frombtn=1&sid=<?php echo $sid;?>"> -->
			<!--	<img style="margin: 0 auto; text-align:right;" src="../public/img/imprest.png" alt="Imprest module" />-->
	
								
								
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
//echo $qry;
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
								

								
				
				
			<!--</A>-->
	</div>