-- select * from mst_tipe_reff
-- select * from mst_reff
-- select * from form_generator where tableName='trx_order_jual' order by sortNo
-- select * from mst_runno
-- select prefiks, mab_urut + 1 from mst_runno where urutan = 19
-- select * from combo_data
-- select kodereff, reff from mst_reff where tipereff=23 order by reff

insert into mst_tipe_reff (tipe_reff, tipe_reff_desc) values (29, 'Status Kirim');
insert into mst_reff (tipereff, kodereff, reff) values (29, '1', 'Siap Kirim');
insert into mst_reff (tipereff, kodereff, reff) values (29, '2', 'Terkirim');
insert into mst_reff (tipereff, kodereff, reff) values (29, '3', 'Batal Kirim');

alter table trx_master add stKirim int;
