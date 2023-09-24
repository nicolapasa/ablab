analisi impatto cambio anno

Quando genero 
  -num referti
  -num fatture - fatturazione anteprima e definitiva
  -num scheda

  devo valutare se anno corrente impostato da client oppure no, 
  altrimenti è anno corrente da server


  Quando visualizzo:

  -richieste
  -fatture e fatturazione
  -statistiche
  -referti
  -accettazione referti - fixato da testare--   
                          fixato anche up e save_ref.php da testare --

Generazione files:
  -fatture pdf -nome file
  -referti pdf -nome file
  -xml 

  Nelle cartelle riscontro solo una problematica nel nome file perché non è previsto l'anno
  forse risolto semplicemente scaricando o dividere per archivio anno
  folder xml/2018 xml/2019


Valutare se nel db tutte le tabelle sono annuali. 

Fatturazione

aggiungere filtro anno ? forse non serve 
ho modificato solo l'intestazione 

scelgo anno fatturazione - se le schede sono di dicembre e gennaio gestisco in base alla data della scheda più vecchia, è in automatico non si gestisce

Fatture

-filtro per anno
-testare tutto 



Richieste

-verificare se necessario filtro oppure se si riparte dal primo gennaio
-elenco richieste->filtro anno
-rinominato elenco_fatture in elenco_richieste

XML 

-verificare se è necessario prevedere una cartella per anno con Riccardo
-modificato printxml aggiunto anno cartella
 aggiunto anche anno in force_download e force_multidownload
 -nella tabella filtrare per anno

Referti

-filtro anno //ok da testare 
-togliere filtro anno da accettazione 

-anno in referti_v va preso dalla tabella referti



Statistiche 
-filtro anno -applicare form seleziona anno


DATE

configurate due date in config 
ANNO_CORE
CURRENT_DATE 


STATISTICHE

-Andamento esami ok
-Andamento esami specifici ok
-Contatore esami - ok
-Andamento esami per utenza - ok
-Andamento fatturato per utenza - ok 
-Protocolli mancanti - ok

VISTE

sono tutte da ricreare 

esamitipo_v aggiunto group by anno

 esami3_v aggiunto group by anno

esamicli_v  aggiunto group by anno

 esamiclimese_v   aggiunto group by anno

 fatturecli_v   aggiunto group by anno
 fatturemesecli_v  aggiunto group by anno

GENERALE 

-ottimizzare filtri anno in modo che non si ripeta uno stesso anno->come in Fatture ok


Esami - mettere filtro old per escludere l'esame dalla prima pagina in nuova richiesta
il tasto elimina lo esclude dai filtri ma non dalla tabella
  problema su margini  
  in tabella esami_cat aggiunto campo eliminato