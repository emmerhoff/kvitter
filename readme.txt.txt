SQL fila ligger i sql/kvitter_db.sql
Modellen til databasen min ligger under sql/kvitter-modell.mwb

Det er bare � teste alle mulige kombinasjoner av input i inputfields
for � kunne f� se hvordan alle errormeldinger dukker opp.

I dette prosjektet har jeg sikret all data i b�de input og output fields med:
html_special_chars($variabel)
mysqli_real_escape_string($con, $variabel)
urlencode($variabel)

Dette or for � forhindre cross-site-scripting(XSS) i output fields og URL
og og forhindre SQL-injections i databasen.

Jeg er klar over at dette ikke pensum, men er over gjennomsnitt interresert
i informasjonssikkerhet, s� det skader ikke � legge til ting.

Jeg har ogs� satt meg godt inn i s�kefunksjoner i MySQL og errorhandling o
hvordan man kan sende ulike variabler med errormeldinger.

Som sagt i about.php er absolutt all kode her skrevet i HTML, CSS, PHP og MySQL
og ingen av kodene har blitt kopiert fra andre sider. Jeg har brukt lang tid
p� � l�re som mye som mulig av stoffet og det er fint � f� vist det jeg har
l�rt i et prosjekt