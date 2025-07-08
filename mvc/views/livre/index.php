{% if session.userId is defined %}
{{ include('layouts/header.php', {
        title: 'Livres',
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
        {% if session.userRole == 1 %}
        <a href="{{ base }}/livre/create" class="btn">Ajouter un livre</a>
        {% endif %}
        {% if session.userRole == 2 %}
        <a class="quicksand filtre__categorie">Voir tout</a>
        <a class="quicksand filtre__categorie">Auteur</a>
        <a class="quicksand filtre__categorie">Categorie</a>
        <a class="quicksand filtre__categorie">Prix</a>
        {% endif %}
    </header>

    <section class="container">
        {% for livre in livres %}
        <article class="carte">
            {% if livre.img_url is not empty %}
            <img src="{{ asset }}/{{ livre.img_url }}" alt="{{ livre.titre }}">
            {% endif %}
            <h3>{{ livre.titre }}</h3>
            <p>{{ livre.description }}</p>
            <small>{{ livre.prix }} $</small>

            <form class="donnee__form" action="book-detail.php" method="post">
                <input type="hidden" name="idClient" value="{{ session.userId }}">
                <input type="hidden" name="idLivre" value="{{ livre.id }}">
                <button type="submit" class="btn btn-alerte">Voir plus</button>
            </form>
        </article>
        {% endfor %}
    </section>
    {% if session.userId is defined %}
    <div>
        <a class="btn btn-alerte" href="{{ base }}/user/show?id={{ session.userId }}">Retourner</a>
    </div>
    {% endif %}
</main>

{{ include('layouts/footer.php') }}