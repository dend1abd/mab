update form_generator set FieldInput='combocust' where tableName='trx_order_jual' and fieldname='contact_code';
update combo_data set query='SELECT contact_code, CONCAT(contact_name,'', '', left(ifnull(alamat,''''), 30)), sales_code, kode_wilayah FROM mst_contact where contact_tipe = 3 order by contact_name' where kode='rsCustomer';
update combo_data set query='SELECT contact_code, CONCAT(contact_name,'', '', left(ifnull(contact_code,''''), 30)) FROM mst_contact where contact_tipe = 4 order by contact_name' where kode='rsKaryawan';
 