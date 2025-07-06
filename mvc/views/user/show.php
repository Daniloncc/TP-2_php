{{ include('layouts/header.php', {
    title: 'Utilisateur',
    nav1: 'Galerie',
    nav2: 'Profil',
    nav3: 'Quitter',
    nav4: 'A propos',
    nav5: 'Contact',
    lien1: '/livres',
    lien2: '/user/edit',
    lien3: '/user/logout',

}) }}
<header>
    <h1 class="quicksand">Bonjour, <strong class="pompiere">{{ user.prenom }}</strong></h1>
</header>

<main class="main__form">
    <div class="donnee">
        <h2 class="quicksand">Votre Profil</h2>
        <hr>
        <p><strong>Nom: </strong>{{ user.nom }}</p>
        <p><strong>Prenom: </strong>{{ user.prenom }}</p>
        <p><strong>Addresse: </strong>{{ user.adresse }}</p>
        <p><strong>Telehone: </strong>{{ user.telephone }}</p>
        <p><strong>Courriel: </strong>{{ user.courriel }}</p>
        <p><strong>Ville: </strong>{{ ville }}</p>
        <hr>
        <form class="donnee__form" action="{{ base }}/user/delete" method="post">
            <input type="hidden" name="id" value="{{ user.id }}">
            {% if user.idRole == 1 %}
            <a href="{{ base }}/user/edit?id={{ user.id }}" class="btn">Liste Clients</a>
            <a href="{{ base }}/livres?id={{ user.id }}" class="btn">Galerie livres</a>
            {% endif %}
            {% if user.idRole == 2 %}
            <a href="{{ base }}/user/edit?id={{ user.id }}" class="btn">Edit profil</a>
            <a href="{{ base }}/livres?id={{ user.id }}" class="btn">Choisir livres</a>
            <a href="book-user.php?id={{ user.id }}" class="btn">Mes livres</a>
            {% endif %}
            <button type="submit" class="btn btn-alerte">Delete profil</button>
        </form>
    </div>
</main>

{{ include('layouts/footer.php') }}