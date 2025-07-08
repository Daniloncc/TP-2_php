{{ include('layouts/header.php', {
    title: 'Bienvenue',
    nav1: 'Galerie',
    nav2: 'Creer votre compte',
    nav3: 'Conectez-vouz',
    nav4: 'A propos',
    nav5: 'Contact',
    lien1: '/livres',
    lien2: '/user/create',
    lien3: '/auth/index',

}) }}
<header>
    <h1 class="quicksand">Librairie <strong class="pompiere">Voyages imaginaires</strong></h1>
</header>

<main class="main__form">
    <div class="form">
        <h2>{{message}}</h2>
    </div>

</main>


{{ include('layouts/footer.php') }}