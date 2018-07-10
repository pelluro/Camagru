Camagru
-----------------------------------
TO DO LIST

- INSCRIPTION 
  - adresse mail.
  - nom user.
  - mot de passe. (sécurisé) 
  - mail de confirmation d'inscription. 

- CONNEXION
  - nom user. 
  - mot de passe.

- RESET MOT DE PASSE
  - mail pour modification de mot de passe.

- LOGOUT
  - possibilité de se deloguer depuis toute les pages. 

- MONTAGE
  - PARTIE ACCESSIBLE UNIQUEMENT AUX USERS LOG 
    - SECTION PRINCIPALE
        - apercu web cam. 
        - si pas de webcam possibilité de upload une image.
        - liste des images png supperposable. 
            - elles doivent etre selectionnable.
        - bouton pour prendre la photo.
            - clicable uniquement si un png est choisi.
            - le montage des photos doit se faire coté PHP et non Javascript.
        - bouton save faire en sorte qu'il ne soit clicable que si une photo est prise.

    - SECTION IMAGE 
        - affichage de toutes les photos prise precedement. 
        - possibilité de supprimer ses propres images pas les autres.

- GALERIE
  - doit afficher toutes les photos de tout les membres par date et etre paginé.
  - possibilité de liker les photos.
  - possibiliteé de commenter les photos. 
    - envoyer un mail au proprio quand une image recois un nouveau commentaire.

- BONUS
  - Apercu du rendu final en live sur la cam.
  - Ajaxifier les echanges avec le serveur.
  - Pagination infini sur la partie galerie.
  - Partager ses photos sur les reseau sociaux.
  - Pouvoir faire un gif.

- FICHIERS OBLIGATOIRES.
  - index.php a la racine. 
  -fichier config/database.php contenant la config BDD avec PDO. 
    $DB_DSN = ...; 
    $DB_USER = ...; 
    $DB_PASSWORD = ...; 
  - fichier config/setup.php pour creer ou recreer le shema de la base. (OK)# Camagru
