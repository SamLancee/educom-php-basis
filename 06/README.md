Een stappenplan voor database zou kunnen zijn:

Stap 1: Losse tabellen maken voor elk user, item, order. User die alle gebruikers opslaat. 
Item die vervanging is van $item_array. En order die het huidige winkelmandje bewaart. 

Stap 2: Er moet een session check plaatsvinden. Deze vindt plaats wanneer de user op de site komt.
Indien de gebruiker niet is ingelogd dan wordt er naar een inlog gevraagd. Bij nieuwe user wordt deze toegevoegd aan user. 

Stap 3: Alle items worden getoond uit de database item. De user kan elk item selecteren. 

Stap 4: Zodra de user op een item klikt wordt deze toegevoegd aan order tabel. Deze wordt bewaard om functies als push mails te gebruiken. 
