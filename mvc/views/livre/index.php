{{ include('layouts/header.php', {title: 'Livres'})}}

<header>
    <h1 class="quicksand">Librairie <strong class="pompiere">Voyages imaginaires</strong></h1>
</header>

<main class="grille">
    <header class="filtre">
        <a class="quicksand filtre__categorie">Voir tout</a>
        <a class="quicksand filtre__categorie">Auteur</a>
        <a class="quicksand filtre__categorie">Categorie</a>
        <a class="quicksand filtre__categorie">Prix</a>
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
                <input type="hidden" name="idClient" value="{{ idClient }}">
                <input type="hidden" name="idLivre" value="{{ livre.id }}">
                <button type="submit" class="btn btn-alerte">Voir plus</button>
            </form>
        </article>
        {% endfor %}
    </section>

    <div>
        <a class="btn btn-alerte" href="{{ base }}/client/show?id={{ client.id }}">Retourner</a>
    </div>
</main>

{{ include('layouts/footer.php') }}