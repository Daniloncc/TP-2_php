{% if session.userId is defined %}
{{ include('layouts/header.php', {
        title: 'Liste Clients',
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
    <h1 class="quicksand">Librairie <strong class="pompiere">Voyages imaginaires</strong></h1>
</header>

<main class="grille">
    <header class="filtre">
        <h1> Liste de Clients</h1>
    </header>

    <section class="container">
        {% for client in clients %}
        <article class="carte">
            <h3>Prenom: <i>{{ client.prenom }}</i></h3>
            <p>Nom: <strong><i>{{ client.nom }}</i></strong></p>
            <p>Telephone: <strong><i>{{ client.telephone }}</i></strong></p>
            <p>Courriel: <strong><i>{{ client.courriel }}</i></strong></p>
            <p>Adresse: <strong><i>{{ client.adresse }}</i></strong></p>
            <!--  -->
            {% for role in roles %}
            {% if role.id == client.idRole %}
            <p>Role: <strong><i>{{ role.role }}</i></strong></p>
            {% endif %}
            {% endfor %}
            <!--  -->
            {% for ville in villes %}
            {% if ville.id == client.idVille %}
            <p>Ville: <strong><i>{{ ville.ville }}</i></strong></p>
            {% endif %}
            {% endfor %}
            <form class="donnee__form" action="book-detail.php" method="post">
                <input type="hidden" name="idClient" value="{{ idClient }}">
                <button type="submit" class="btn btn-alerte">Editer</button>
            </form>
        </article>
        {% endfor %}
    </section>

    <div>
        <a class="btn btn-alerte" href="{{ base }}/user/show?id={{ session.userId }}">Retourner</a>
    </div>
</main>

{{ include('layouts/footer.php') }}