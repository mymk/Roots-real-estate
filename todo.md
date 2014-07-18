-------------------
Root - immo

---------------------

location "post_type" 
ok	-Loyer (int)ttc*
ok	-Charges (int)*
ok	-Loyer + Charges* (int)ttc*
	-Honoraires d'agence  (int) 72% du loyer ttc
	-disponibilité (date)* date -> francais
ok	-Surface de la location (int)*
ok	-Surface du terrain (int)*
ok	-Type (studio,T1,T1B,T1D,T2,T2bis,T2D,T3,T3D,T4,F1,F1D,F2,F3,F4, maison, terrain,BAR, BUR, COM) select_box*
ok	-Etage select_box*
ok	-Chauffage (C/C,I/E,I/G)select_box
ok	-identifiant unique (int)

ok	-Consomation energetique Select_box A->G*
ok	-Emission de gaz à effet de serre Select_box A->G*
	
ok	-photo a la une 
	-slider si >= 2 photos
ok	-mise en avant checkbox
ok	nb de chambre 
ok	nb de salle de bain	
ok	function get number of images*
ok	-map + checkbox voir la map *
ok	secteur (limoges centre, landouge, couseix,....) (texte)*
	video -> url embed 


Vente "post_type"
	-Loyer (int)*
	-Charges (int)*
//	-Loyer + Charges* (int)
	-Honoraires d'agence  (int) pas de calcul
	-disponibilité (date)* date
	-Surface de la location (int)*
	-Surface du terrain (int)*
	-Type (studio,T1,T1B,T1D,T2,T2bis,T2D,T3,T3D,T4,F1,F1D,F2,F3,F4, maison, terrain,BAR, BUR, COM) select_box*
	-Etage* select_box

	-Consomation energetique Select_box A->G*
	-Emission de gaz à effet de serre Select_box A->G*
	
	-photo a la une 
	-slider si >= 2 photos
	-mise en avant checkbox*
//	function get number of images*
//	-map + checkbox voir la map *
//	secteur (limoges centre, landouge, couseix,....) (texte)


loop location 
	type postclass
	img max 280*165


-formulaire mail demande de visite de lieu
	-nom
	-email 
	-telephone
	-date 	(pikadate datepiker)
	->agence@begip.fr

listes de posts: 
-affichage des loyer charges comprises vs. requete ordonnée par loyer brut