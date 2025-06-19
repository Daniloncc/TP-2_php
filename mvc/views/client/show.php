{{ include('layouts/header.php', {title: 'Client client.nom'})}}

<header>
    <h1 class="quicksand">Bonjour, <strong class="pompiere">{{ client.prenom }}</strong></h1>
</header>

<main class="main__form">
    <div class="donnee">
        <h2 class="quicksand">Votre Profil</h2>
        <hr>
        <p><strong>Nom: </strong>{{ client.nom }}</p>
        <p><strong>Prenom: </strong>{{ client.prenom }}</p>
        <p><strong>Addresse: </strong>{{ client.adresse }}</p>
        <p><strong>Telehone: </strong>{{ client.telephone }}</p>
        <p><strong>Courriel: </strong>{{ client.courriel }}</p>
        <p><strong>Ville: </strong>{{ ville }}</p>
        <hr>
        <form class="donnee__form" action="{{ base }}/client/delete" method="post">
            <input type="hidden" name="id" value="{{ client.id }}">
            <a href="{{ base }}/client/edit?id={{ client.id }}" class="btn">Edit profil</a>
            <a href="{{ base }}/livres?id={{ client.id }}" class="btn">Choisir livres</a>
            <a href="book-client.php?id={{ client.id }}" class="btn">Mes livres</a>
            <button type="submit" class="btn btn-alerte">Delete profil</button>
        </form>
    </div>
</main>

{{ include('layouts/footer.php') }}