-- select * from form_generator where tableName='trx_jual_by_order' order by sortNo
-- select * from mst_tipe_reff
-- select * from mst_reff where tipereff=28

update form_generator set disableEdit=0 where id in (188, 384);
update mst_reff set reff = 'Siap Kirim' where tipereff=1 and kodereff=1;
update mst_reff set reff = 'Sudah Kirim' where tipereff=1 and kodereff=2;

