
CREATE VIEW fatture_n AS
 SELECT  S.*,
         A.nome_ref,
         A.nome,
		 A.mod_pag,
         P.nome_proprietario,
         P.cognome_proprietario,
         A.attivo,
         E.id_cat
 FROM schede S 
left JOIN admin A ON A.id = S.id_struttura
left JOIN proprietari P ON P.id = S.id_proprietario
left join esami_cat E on E.id = S.tipo
 where S.completa='s' and A.attivo='v';








 CREATE VIEW accettazione AS
 SELECT  S.*,
         A.nome,
         A.nome_ref,
		 A.mod_pag,
         P.nome_proprietario,
         P.cognome_proprietario,
         A.attivo,
         E.id_cat,
		 RE.dataArrivo
 FROM schede S
left JOIN admin A ON A.id = S.id_struttura
left JOIN proprietari P ON P.id = S.id_proprietario
left join esami_cat E on E.id = S.tipo
left join referti RE on RE.id_scheda = S.id;




CREATE VIEW refertimancanti_v AS
 SELECT  R.*,
         F.id_struttura,
         F.id_proprietario,
         F.num,
         F.tipo,
		 FROM_UNIXTIME( R.timeArr,'%Y') as anno,
		 F.id_animale,
		 F.totale,
		 F.margini,
		 F.urgente,
		 F.seconda_refertazione,
		 F.allegati,
		 F.num_referto as ref_prec,
		 F.id_cat,
		 RF.descr_macro,
		 RF.descr_micro,
		 RF.diagn_morf,
		 RF.commento,
		 RF.esito_esame,
		 RF.commento2,
		 RF.esito_esame2,
		 F.cognome_proprietario,
		 F.nome,
         F.nome_ref
 FROM referti R
JOIN referti_data RF ON RF.id_tref = R.id
JOIN fatture_n F ON F.id = R.id_scheda
where R.arrivato ='s';


CREATE VIEW referti_v AS
 SELECT  R.*,
         F.id_struttura,
         F.id_proprietario,
         F.num,
         F.tipo,
		 FROM_UNIXTIME( R.timeArr,'%Y') as anno,
		 F.id_animale,
		 F.totale,
		 F.margini,
		 F.urgente,
		 F.seconda_refertazione,
		 F.allegati,
		 F.num_referto as ref_prec,
		 F.id_cat,
		 RF.descr_macro,
		 RF.descr_micro,
		 RF.diagn_morf,
		 RF.commento,
		 RF.esito_esame,
		 RF.commento2,
		 RF.esito_esame2,
		 F.cognome_proprietario,
		 F.nome,
     F.nome_ref,
     A.specie,
     A.razza
 FROM referti R
JOIN referti_data RF ON RF.id_tref = R.id
JOIN fatture_n F ON F.id = R.id_scheda
join animale A on F.id_animale =A.id
where R.arrivato ='s';


CREATE VIEW elencoreferti_v AS
 SELECT  R.*,
         F.id_struttura,
         F.id_proprietario,
         F.num,
         F.tipo,
		 FROM_UNIXTIME( R.timeArr,'%Y') as anno,
		 F.id_animale,
		 F.totale,
		 F.margini,
		 F.urgente,
		 F.seconda_refertazione,
		 F.allegati,
		 F.num_referto as ref_prec,
		 F.id_cat,
     F.tipo as id_esa,
		 RF.descr_macro,
		 RF.descr_micro,
		 RF.diagn_morf,
		 RF.commento,
		 RF.esito_esame,
		 RF.commento2,
		 RF.esito_esame2,
		 F.cognome_proprietario,
		 F.nome,
     F.nome_ref,
     A.specie,
     A.razza,
     A.nome as animale,
	 P.medico_ref,
	 RA.id_refertatore 
 FROM referti R
JOIN referti_data RF ON RF.id_tref = R.id
JOIN fatture_n F ON F.id = R.id_scheda
join animale A on F.id_animale =A.id
join proprietari P on P.id =F.id_proprietario
left join referti_assegnati RA on RA.id_referto = R.id
where R.arrivato ='s';









 CREATE VIEW fatturazione_v AS
 SELECT  F.*,
 A.dataArrivo,
 A.dataRefertazione,
  A.timeArr,
 A.timeRef,
 A.id as id_ref,
 A.id_referto as num_pro
 FROM  fatture_n F
 JOIN referti A ON A.id_scheda = F.id
 where F.arrivato='s'  and F.fatturato='';


CREATE VIEW fatturate_v AS
SELECT F.*, A.nome as nominativo, A.id as id_cli
from fatture as F
 JOIN admin as A ON A.id  = F.id_cliente
WHERE F.dest != 'p'
UNION
SELECT  F.*, CONCAT_WS(' ',    P.nome_proprietario,
         P.cognome_proprietario) as nominativo,
		 P.id_struttura as id_cli
		 from fatture as F
JOIN proprietari as P ON P.id  = F.id_cliente
WHERE F.dest = 'p';


CREATE VIEW fatturate2_v AS
SELECT F.*, A.nome as nominativo, A.id as id_cli
from fatture as F
 JOIN admin as A ON A.id  = F.id_cliente
WHERE F.dest != 'p'
UNION
SELECT  F.*, CONCAT_WS(' ',   P.cognome_proprietario, P.nome_proprietario
         ) as nominativo,
		 P.id_struttura as id_cli
		 from fatture as F
JOIN proprietari as P ON P.id  = F.id_cliente
WHERE F.dest = 'p';



/*modificata*/
CREATE VIEW esami_v AS
 SELECT distinct(R.id),
         R.id_referto,
		 R.timeArr,
		 R.anno,
		 F.id_cat
 FROM refertimancanti_v R
JOIN fatture_n  F ON  R.id_scheda = F.id;






CREATE VIEW esami2_v AS
 SELECT  distinct(R.id_referto),
         R.timeArr,
		 R.anno,
		 F.id_cat,
		 F.totale,
		 F.cognome_proprietario,
		 F.tipo,
		 F.urgente,
		 F.margini,
		 F.id,
		 FA.num
from fatture FA
JOIN fatture_n  F ON  F.num_fatt = FA.num
JOIN refertimancanti_v R ON R.id_scheda = F.id
order by id_referto asc;




CREATE VIEW esami_fatturati_v AS
 SELECT  R.*,
		 F.data,
		 F.fatturato
 FROM refertimancanti_v R
JOIN fatture_n F ON F.id = R.id_scheda
where R.arrivato ='s' and F.fatturato='s';


CREATE VIEW conta_esami_v AS
 SELECT  distinct R.id,
		 R.id_scheda,
         R.arrivato,
 		 F.id_struttura,
		 R.timeArr, 
		 FROM_UNIXTIME( R.timeArr,'%Y') as anno,
		 F.nome,
		 F.fatturato
 FROM referti R
JOIN fatture_n F ON F.id = R.id_scheda
where R.arrivato ='s' and F.fatturato='s';

CREATE VIEW esami3_v AS
 SELECT
		 FROM_UNIXTIME( R.timeArr,'%m') as mese,
		 R.anno,
		 F.tipo,
		 count(F.id) as num
from fatture_n  F
JOIN refertimancanti_v R ON R.id_scheda = F.id
group by R.tipo,anno,  mese;






CREATE VIEW esamitipo_v AS
 SELECT
		 R.anno,
		 F.tipo,
		 count(F.id) as num
from fatture_n  F
JOIN refertimancanti_v R ON R.id_scheda = F.id
group by  R.anno,F.tipo
order by anno;




CREATE VIEW andamentoesamicli_v AS
 SELECT
		 F.anno,
		 F.nome,
		 F.id_struttura,
		 count(F.id) as num
 FROM referti R
JOIN fatture_n  F ON R.id_scheda = F.id
where R.stato=3
group by F.anno, F.id_struttura;



CREATE VIEW andamentoesamiclimese_v AS
 SELECT
		 FROM_UNIXTIME( R.timeArr,'%m') as mese,
		 F.anno,
		 F.nome,
		 F.id_struttura,
		 count(F.id) as num
from  referti R
JOIN fatture_n F ON R.id_scheda = F.id
where R.stato=3
group by F.anno, F.id_struttura, mese;






CREATE VIEW fatturecli_v AS
 SELECT
		 R.anno,
		 F.nome as nominativo,
		 F.id_struttura as id_cli,
		 sum(F.totale) as tot
from fatture_n  F
JOIN refertimancanti_v R ON R.id_scheda = F.id
where F.fatturato='s'
group by R.anno, F.id_struttura;



CREATE VIEW fatturemesecli_v AS
 SELECT
         FROM_UNIXTIME( R.timeArr,'%m') as mese,
		 R.anno,
		 F.nome as nominativo,
		 F.id_struttura as id_cli,
		 sum(F.totale) as tot
from fatture_n  F
JOIN refertimancanti_v R ON R.id_scheda = F.id
where F.fatturato='s'
group by R.anno, F.id_struttura, mese;







CREATE VIEW cliniche_inattive_v AS
SELECT a.id, a.nome as nome_clinica, b.data, b.time
FROM  admin a, fatture_n b
WHERE a.id = b.id_struttura AND b.id =
(SELECT id
FROM fatture_n
WHERE id_struttura =  a.id and completa='s' order by id desc limit 1)
group by a.id;




create view esami_ordinati_v AS
SELECT
    E.*,
    O.ord
from esami_cat E
JOIN esami_ordine O ON O.id_esame = E.id;





CREATE VIEW  report_refertatori_v AS
 SELECT  
         R.id,
		 R.id_referto as num, 
		 A.id as id_admin,
		 A.nome_ref as nome,
		 A.email,
         RA.data_assegnazione,
         RA.data_completato,
		 R.dataRefertazione,
		 RA.completato,
		 FROM_UNIXTIME( R.timeArr,'%Y') as anno
 FROM referti_assegnati RA 
JOIN admin A ON A.id = RA.id_refertatore
JOIN referti R ON RA.id_referto = R.id;


DELIMITER $$
CREATE DEFINER=`BJ8XGaDpEV`@`185.205.43.149` FUNCTION `isnumeric`(val varchar(1024)) RETURNS tinyint(1)
    DETERMINISTIC
return val regexp '^(-|\\+)?([0-9]+\\.[0-9]*|[0-9]*\\.[0-9]+|[0-9]+)$'$$
DELIMITER ;