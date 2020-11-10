SQL fila ligger i sql/kvitter_db.sql
Modellen til databasen min ligger under sql/kvitter-modell.mwb

Det er bare å teste alle mulige kombinasjoner av input i inputfields
for å kunne få se hvordan alle errormeldinger dukker opp.

I dette prosjektet har jeg sikret all data i både input og output fields med:
html_special_chars($variabel)
mysqli_real_escape_string($con, $variabel)
urlencode($variabel)

Dette or for å forhindre cross-site-scripting(XSS) i output fields og URL
og og forhindre SQL-injections i databasen.

Jeg er klar over at dette ikke pensum, men er over gjennomsnitt interresert
i informasjonssikkerhet, så det skader ikke å legge til ting.

Jeg har også satt meg godt inn i søkefunksjoner i MySQL og errorhandling o
hvordan man kan sende ulike variabler med errormeldinger.

Som sagt i about.php er absolutt all kode her skrevet i HTML, CSS, PHP og MySQL
og ingen av kodene har blitt kopiert fra andre sider. Jeg har brukt lang tid
på å lære som mye som mulig av stoffet og det er fint å få vist det jeg har
lært i et prosjekt