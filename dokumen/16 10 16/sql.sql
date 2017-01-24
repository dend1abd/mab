-- select * from form_generator where tableName='trx_retur_jual' order by sortNo
-- select * from form_generator where tableName='trx_order_jual' order by sortNo
-- select * from form_generator where fieldName='trx_jual_by_order'

alter table trx_master add kode_divisi varchar(10);
update trx_master set kode_divisi = kel_beli;

update form_generator set fieldName='kode_divisi' where fieldName='kel_beli';
insert into form_generator (formno, tablename, sortno, titlename, fieldname, fieldtype, fieldlen, fieldinput, combodata,section,kolom) values
(19,'trx_delivery_order', 3, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', 1, 1);
update form_generator set disableEdit=1 where tablename='trx_delivery_order' and fieldname='kode_divisi';

--select * from mst_menu
update mst_menu set menuname='Faktur Penjualan' where menukode='0303000000';
update mst_menu set menuname='Penjualan Lainnya' where menukode='0304000000';

update form_generator set sortno=sortno+1 where tablename='trx_jual_by_order' and sortno>=3;
insert into form_generator (formno, tablename, sortno, titlename, fieldname, fieldtype, fieldlen, fieldinput, combodata,disableEdit, section,kolom) values
(19,'trx_jual_by_order', 3, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', 1, 1, 1);

update form_generator set sortno=sortno+1 where tablename='trx_jual_non_order' and sortno>=3;
insert into form_generator (formno, tablename, sortno, titlename, fieldname, fieldtype, fieldlen, fieldinput, combodata,disableEdit, section,kolom) values
(21,'trx_jual_non_order', 3, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', 1, 1, 1)

update form_generator set kolom=2 where tablename='trx_jual_non_order' and fieldname='contact_code';

update form_generator set sortno=sortno+1 where tablename='trx_retur_jual' and sortno>=5;
insert into form_generator (formno, tablename, sortno, titlename, fieldname, fieldtype, fieldlen, fieldinput, combodata,disableEdit, section,kolom) values
(23,'trx_retur_jual', 5, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', 1, 1, 2);
update form_generator set titleName='Hutang' where tablename='trx_retur_jual' and fieldname='sisa';

-- SELECT * FROM trx_master a WHERE a.transaksi_kode ='SRT16100001'
-- select * from mst_menu where menukode='8102050000'
insert into mst_menu(menukode, menuparent,menuname,menulink) values
('8102060000','8102000000','Pengiriman Barang','delivery_order_report.php');