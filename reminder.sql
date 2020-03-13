

select * from (

select sum(amount) as balance ,imp_holder,name as oname,ap.phone,ename

 from a_imprest_voucher aiv left join a_personal_contacts ap
  on ap.empcode::text=aiv.imp_holder 
  inner join offices o on o.code=aiv.imp_holder_office
left join dl_empl d 
 on aiv.imp_holder=d.unique_code::text
  
 where imp_fy='2019-2020'   group by imp_holder,oname,ap.phone,ename


) a 
  where a.balance<0 and a.balance>-15001 order by 5,3,1






