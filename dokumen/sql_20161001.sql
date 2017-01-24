select * from form_generator where tableName='trx_order_jual' order by sortNo

update form_generator set fieldname = 'total', titlename='Total' where tableName='trx_order_jual' and sortno=12;
update form_generator set fieldname = 'bayar', titlename='Uang Muka' where tableName='trx_order_jual' and sortno=13;
update form_generator set fieldname = 'sisa', titlename='Sisa' where tableName='trx_order_jual' and sortno=14;
select * from mst_config where kode=19

alter table trx_master add supir_code varchar(50)
alter table trx_master add no_mobil varchar(10)

insert into mst_config (kode, ket, int_value) values (19, 'Delivery Order', 0)

select * from trx_detail

update mst_config set string_value='SDO' where kode=19

se


