update mst_reff set reff = 'Siap Kirim' where tipereff=28 and kodereff=1;
update mst_reff set reff = 'Sudah Kirim' where tipereff=28 and kodereff=2;

update mst_reff set reff = 'Debet' where tipereff=1 and kodereff=1;
update mst_reff set reff = 'Kredit' where tipereff=1 and kodereff=2;

update combo_data set query='SELECT contact_code, CONCAT(contact_name,'', '', left(ifnull(alamat,''''), 30)) FROM mst_contact where contact_tipe = 3 order by contact_name' where kode='rsCustomer';
