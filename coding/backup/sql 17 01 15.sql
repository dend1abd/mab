update combo_data set query='SELECT contact_code, CONCAT(contact_name,'', '', left(ifnull(contact_code,''''), 30)) FROM mst_contact where contact_tipe = 4 order by contact_name' where kode='rsKaryawan'