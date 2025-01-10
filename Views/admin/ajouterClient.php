<!DOCTYPE html>
   <html lang="fr">
   <head>
       <meta charset="UTF-8">
       <title>Ajouter un client</title>
   </head>
   <body>
       <form action="admin.php?action=ajouterClient" method="post">
           <label for="nom">Nom :</label>
           <input type="text" id="nom" name="nom" required>
           <br>
           <label for="prenom">Prénom :</label>
           <input type="text" id="prenom" name="prenom" required>
           <br>
           <label for="email">Email :</label>
           <input type="email" id="email" name="email" required>
           <br>
           <label for="mot_de_passe">Mot de passe :</label>
           <input type="password" id="mot_de_passe" name="mot_de_passe" required>
           <br>
           <label for="telephone">Téléphone :</label>
           <input type="text" id="telephone" name="telephone" required>
           <br>
           <label for="adresse">Adresse :</label>
           <input type="text" id="adresse" name="adresse" required>
           <br>
           <button type="submit">Ajouter le client</button>
       </form>
   </body>
   </html>