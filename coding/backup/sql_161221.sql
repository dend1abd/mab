update mst_reff set reff = 'Cetak' where tipereff=28 and kodereff=1;
update mst_reff set reff = 'Kirim' where tipereff=28 and kodereff=2;
update mst_reff set reff = 'Tunda' where tipereff=28 and kodereff=3;

select * from mst_reff