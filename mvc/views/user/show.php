{% if session.userId is defined %}
{{ include('layouts/header.php', {
        title: 'Utilisateur: ' ~ session.userPrenom,
        nav1: 'Galerie',
        nav2: 'Mon compte',
        nav3: 'Déconnexion',
        nav4: 'A propos',
        nav5: 'Contact',
        lien1: '/livres',
        lien2: '/user/show?id=' ~ session.userId,
        lien3: '/auth/logout',
    }) }}
{% else %}
{{ include('layouts/header.php', {
        title: 'Livres',
        nav1: 'Galerie',
        nav2: 'Créer votre compte',
        nav3: 'Connectez-vous',
        nav4: 'A propos',
        nav5: 'Contact',
        lien1: '/livres',
        lien2: '/user/create',
        lien3: '/auth/index',
    }) }}
{% endif %}
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
            {% if session.userRole == 1 %}
            <a href="{{ base }}/user/liste-clients?id={{ user.id }}" class="btn">Liste Clients</a>
            <a href="{{ base }}/livres?id={{ user.id }}" class="btn">Galerie livres</a>
            {% endif %}
            <a href="{{ base }}/user/edit?id={{ user.id }}" class="btn">Edit profil</a>
            {% if session.userRole == 2 %}
            <a href="{{ base }}/livres?id={{ user.id }}" class="btn">Choisir livres</a>
            <a href="book-user.php?id={{ user.id }}" class="btn">Mes livres</a>
            {% endif %}
            <button type="submit" class="btn btn-alerte">Delete profil</button>
        </form>
    </div>
</main>

{{ include('layouts/footer.php') }}