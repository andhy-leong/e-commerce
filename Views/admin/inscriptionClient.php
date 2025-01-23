<form action="admin.php?action=ajouterClient" method="post">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="telephone">Téléphone:</label>
    <input type="text" id="telephone" name="telephone" required>

    <label for="adresse">Adresse:</label>
    <textarea id="adresse" name="adresse" required></textarea>

    <button type="submit">Inscrire</button>
</form> 