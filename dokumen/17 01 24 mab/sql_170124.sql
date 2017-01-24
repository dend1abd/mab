
-- select * from form_generator where tableName='trx_jual_non_order' order by sortNo
update form_generator set fieldinput='combocust' where tableName='trx_jual_non_order'  and fieldname='contact_code';
