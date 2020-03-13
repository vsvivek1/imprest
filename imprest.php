<?php
include_once('../class/ExpAccSystem.class.php');
echo'<form action=expAcc.php method=post>';

global $ttype;
echo'<input type ="HIDDEN" name = "id" value='.$ttype.'>';

	include_once('dbase.php');
	
	$transid=$_POST['trid'];

	$dbno=$_POST['dbno'];
	$billid=$_POST['billid'];
	$impType=$_POST['cmbBilltype'];
	
	
	if ($payee=="")
	{
		$po=$_POST['txtpayee'];
	}
	if($payee=="")
	{
		$po==$_POST['cmbpayee'];
	}

	$payee=TrimString($po,"-",0,1);
	$office=TrimString($po,"-",1,0);
//echo 'Aaa'. $_POST['cmboffice'];
	if($office=="")
	{
	
		$office=$_POST['office_id'];
	}
	$dt=GetCurrdate();
	if($transid>0)
	{
		$office=$_POST['cmboffice'];
		$p=$_POST['txtpayee'];
		$payee==TrimString($p,"-",0,1);
		$dt="";
	}
	if($payee=="")
	{
		$payee=$_POST['cmbpayee'];
	}
	$CurrDate =GetCurrDate();
	//echo'Payee'.$payee;
	$sessID =  Date('dmY').time(h,m,s);
	echo'<input type="HIDDEN" name= sid value='.$sessID.'>';
	echo'<input Type="HIDDEN" name=trid value='.$transid.'>';
	echo'<input Type="HIDDEN" name=dbno value='.$dbno.'>';
	echo'<input Type="HIDDEN" name=billid value='.$billid.'>';
	echo'<input Type="HIDDEN" name=cmbBilltype value='.$impType.'>';
	echo'<input type ="HIDDEN" name = "locid" value='.$loccode.'>';
		echo'<input type ="HIDDEN" name = "id" value='.$ttype.'>';
		echo'<input type="HIDDEN" name = "txtDate" value='.$CurrDate.'>';
	if($payee=="")
	{	
		echo'<table ><tr><td>';
		echo'You have not selected any payee</td>';
		//echo'<input type ="HIDDEN" name = "iid" value ='.$MenuID.'>';
		echo'<input type ="HIDDEN" name = "locid" value='.$loccode.'>';
		echo'<input type ="HIDDEN" name = "id" value='.$ttype.'>';
		echo'<input type="HIDDEN" name = "txtDate" value='.$CurrDate.'>';
		echo'<td width =40% align = right><input type= submit name=sbmt value="<< Back"></input></td></tr></table>';
	}
	else
	{
		echo'<table width=100% align= center>';
			echo'<tr>
				
				<td width=30% ><font color = "red"';
					GetinputDate();
				echo'</font></td>
			</tr>';
			echo'<tr>
				
				<td  >Payee  </td>';
		
					GetPayeeName($payee);
			echo'</tr>';
			echo'<tr>
				
				<td >Account Code</td>';
					GetSubNetCode($payee);
			echo'</tr>';
			echo'<tr>
				
				<td>Office</td>
				<td>';
				//echo'BBB'.$office;
					$off = GetOfficeName($office);
					echo $off;
				echo'</td>
			</tr>';
			
			
			if($impType>1001)
			{
				
				
				echo'<tr>
					<td>Balance</td>
					<td><font color=red>';
//					echo "ttype=".$ttype;
						if($ttype==ImprestTemporary)
						{
							
							$chid=GetImprestClosedChequeDetails($transid);

							GetImpChequeDetails($payee,$chid);
						}
						else
						{
							
							GetAccBalance($dt);
						}
						if($ttype==ImprestTemporary)
						{
						echo'</font><input type=submit name=sbmtimp value="Close_Cheque" text-align=left><font color=red><input type=submit name=sbmtimp value="Revoke_Closed_Cheques"></font></td>
						
					</tr>';
						}
				echo'<tr>
					<td>Expenses</td>
					<td>
						<table class=display style="border:1px solid #781351" width = 100%>
			
							<tr>';
								//<td width=100%>';
									//GetDebitHeads();
//----------------------------------------------------------------------------------------------------------------------------------------------
$ar=($_POST['cmbDrSubAccHead']);


				//echo'<tr>
				//	<td colspan=3 class=label "style=width:10%">Expenses</td>
				//</tr>
				//<tr>';	
								echo'<td colspan=2 class=datar "style=width:90%">';ShowDrTransHeadsAcc();echo'</td>
								<td colspan=1 class=label><input type=submit name= sbmtimp value="Select"></td>
							</tr>
							<tr>
					
								<td colspan=2 class=datar "style=width:30%">';
								if(ShowDrSubAcc($_POST['cmbDrAcc'])==true)
								{
									$drSub=True;
								}
						
								echo'</td>
				
								<td class=label><input type=submit name= sbmtimp  value="Add"></td>
							</tr>';
			
			$ar=($_POST['cmbDrSubAccHead']);
			if($_POST[sbmtimp]=="Select")
			
			{
				if($drSub==false)
				{
					echo'<td colspan=3>';AddDrTransheads($_POST['cmbDrAcc'],$ar[0]);echo'</td>';
				}
				else
				{
					echo'<td colspan=3>';ShowDrTransheads();echo'</td>';
				}	
			}
			elseif($_POST[sbmtimp]=="Add")
				{
					AddDrTransheads($_POST['cmbDrSubAcc'],$ar[0]);
				}
			elseif(($_POST['sbmt']=="Back")||($_POST['impEdit']=="EDIT")||($_POST['edit']=="EDIT"))		
			{
				echo'<td colspan=3>';ShowDrTransheads();echo'</td>';
			}
/*-------------------------------------------------------------------------------------------------------------------------------------------
echo'<table class=display>
				<tr>
					<td colspan=3 class=label "style=width:10%">Recoveries</td>
				</tr>
				<tr>
					<td td class=datar "style=width:90%">';ShowDrTransHeadsAcc();echo'</td>
					<td class=label><input type=submit name= sbmtimp value="Select"></td>
				</tr>
				<tr>
					<td class=datar "style=width:40%">';
					
						if(ShowDrSubAcc($_POST['cmbDrAcc'])==true)
						{
							$drSub=True;
						}
					echo'</td>
					<td class=label><input type=submit name=sbmtimp value="Add"></td>
				</tr>
			</table>';
 $ar=($_POST['cmbDrSubAccHead']);
	if($_POST[sbmtimp]=="Select")
				{
					if($drSub==false)
					{
						AddDrTransheads($_POST['cmbDrAcc'],$ar[0]);
					}
					else
					{
						ShowDrTransheads();
					}
				}
elseif($_POST[sbmtimp]=="Add")
					{
						AddDrTransheads($_POST['cmbDrSubAcc'],$ar[0]);
					}
//-----------------------------------------------------------------------------------------------------------------------------------------------*/
								//echo'</td>
							//</tr>
						//</table>
					//</td>
				echo'</tr>
				</table></td></tr>';
				if($impType==1003)
				{
					
					
					echo'<tr>
					
					<td width=30%>Remittance Details</td>
					<td>';
						GetImprestRemittance();
					echo'</td>
				</tr>';
				}
			}
			
			if($impType<>1003)
			{
				$amt =$_POST['txtamount'];
				echo'<tr>
					
					<td width=30%>Total</td>
					<td><input type=TEXT name=txtamount size=10 style="text-align:right" id =$id onkeypress = "return numbersonly(event,this.id)" value='.$amt.'></input></td>
				</tr>';
			}
			//echo $impType;
			echo'<tr>';
				echo'<td >Description</td>
				
				<td>';
					GetDescription();
				echo'</td>
			</tr>';
			echo'<tr>';
				echo'<td >Transfered to</td>
				
				<td>';
					ShowSections();
				echo'</td>
			</tr>';
			
			
			
			//if($impType==1)

			//{
				
			//}
		echo'</table>
		<br>
		<br>
		<br>';

		//$payeeid=$_POST['cmbpayee'];
		//echo'<input type ="HIDDEN" name = "iid" value ='.$MenuID.'>';
		echo'<input type ="HIDDEN" name = "locid" value='.$loccode.'>';
		echo'<input type ="HIDDEN" name = "id" value='.$ttype.'>';
		echo'<input type ="HIDDEN" name = "cmbBilltype" value='.$impType.'>';
		echo'<input type ="HIDDEN" name = "txtpayee" value='.$po.'>';
		echo'<input type="HIDDEN" name = "impchequeid" value='.$_POST['cmbimpcheque'].'>';
		echo'<table width=70%>
			<tr>
				<td width = 30%>&nbsp;&nbsp;</td>
				<td align= left><input type=submit name=sbmt value="CANCEL" ></input></td>
				<td align= left><input type=submit  name=sbmt value="SAVE" ></input></td>
				
				</tr>
		</table>';
	
	}
	
echo'</form>';
?>
