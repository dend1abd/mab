-- select * from combo_data
-- select kodereff, reff from mst_reff where tipereff=27 order by reff
-- select * from form_generator where tableName='customer' order by sortNo 

ALTER TABLE  mst_reff MODIFY  COLUMN Reff varchar(100)
update combo_data set query='select kodereff, concat(kodereff, '' - '', reff) as reff from mst_reff where tipereff=27 order by kodereff' where kode = 'rsWilayah'