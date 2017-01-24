select * from trx_order_jual_detail 
select * from trx_detail
select * from form_generator where tableName='trx_retur_jual_detail' order by sortNo;

update form_generator set sortno = sortno+1 where sortno > 3 and tableName='trx_order_jual_detail';
update form_generator set sortno = sortno+1 where sortno > 3 and tableName='trx_jual_by_order_detail';
update form_generator set sortno = sortno+1 where sortno > 3 and tableName='trx_jual_non_order_detail';
update form_generator set sortno = sortno+1 where sortno > 3 and tableName='trx_retur_jual_detail';

insert into form_generator (formno, tablename, sortno,titlename,fieldname,fieldtype,fieldlen,fieldinput,disableEdit)
values(18, 'trx_order_jual_detail',4,'Satuan', 'satuan', 'varchar', 7,'textbox', 1);
insert into form_generator (formno, tablename, sortno,titlename,fieldname,fieldtype,fieldlen,fieldinput,disableEdit)
values(20, 'trx_jual_by_order_detail',4,'Satuan', 'satuan', 'varchar', 7,'textbox', 1);
insert into form_generator (formno, tablename, sortno,titlename,fieldname,fieldtype,fieldlen,fieldinput,disableEdit)
values(22, 'trx_jual_non_order_detail',4,'Satuan', 'satuan', 'varchar', 7,'textbox', 1);
insert into form_generator (formno, tablename, sortno,titlename,fieldname,fieldtype,fieldlen,fieldinput,disableEdit)
values(24, 'trx_retur_jual_detail',4,'Satuan', 'satuan', 'varchar', 7,'textbox', 1);
