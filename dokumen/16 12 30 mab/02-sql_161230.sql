delete from mst_contact where contact_tipe=3;
insert into mst_contact (contact_tipe, flag_import, contact_code, contact_name, alamat, kota, telp, sales_name)
select 3, 1, kodecus,namacus, alamat, kota, telp,sales from cust_161230;
