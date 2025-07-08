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
        <h2>Bienvenue a notre site</h2>
        <p>Nous sommes la pour vous ouffrir une experience unique des voyages au long du temps, des pays et generations, sans voir besoin de bouger de votre fouteuille prefere!</p>
        <div>
            <a href="{{ base }}/user/create">Creer votre compte</a>
            <a href="{{ base }}/auth/index">Connectez-vous</a>
        </div>
    </div>

</main>


{{ include('layouts/footer.php') }}