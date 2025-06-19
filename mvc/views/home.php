{{ include('layouts/header.php', {title: 'Client Edit'})}}

<header>
    <h1 class="quicksand">Librairie <strong class="pompiere">Voyages imaginaires</strong></h1>
</header>

<main class="main__form">
    <div class="form">
        <h2>Bienvenue a notre site</h2>
        <p>Nous sommes la pour vous ouffrir une experience unique des voyages au long du temps, des pays et generations, sans voir besoin de bouger de votre fouteuille prefere!</p>
        <div>
            <a href="{{ base }}/client/create">Creer votre compte</a>
            <a href="">Connectez-vous</a>
        </div>
    </div>

</main>


{{ include('layouts/footer.php') }}