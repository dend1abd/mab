
create table mst_runno
(
urutan int primary key,
prefiks varchar(10),
mab_urut int,
maf_urut int,
mat_urut int
)

delete from mst_runno;
insert into mst_runno values (5, 'SO',100,200,300);
-- select * from combo_data
-- select kodereff, reff from mst_reff where tipereff=23 order by reff