{{ include('layouts/header.php', {
    title: 'Creer votre Compte',
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

    <form action="{{base}}/user/store" method="post" class="form">
        <header>
            <h2 class="quicksand">Creez votre compte</h2>
            <hr>
        </header>
        <div class="form__contenu">
            <lablel class="form__label">Nom :</lablel>
            <input class="form__input" type="text" name="nom" id="nom" value="{{user.nom}}" placeholder="Min 2 lettres, Max 25">
            {% if errors.nom is defined %}
            <span class="error">{{errors.nom}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Prenom :</lablel>
            <input class="form__input" type="text" name="prenom" id="prenom" value="{{user.prenom}}" placeholder="Min 2 lettres, Max 25">
            {% if errors.prenom is defined %}
            <span class="error">{{errors.prenom}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Adresse :</lablel>
            <input class="form__input" type="text" name="adresse" id="adresse" value="{{user.adresse}}" placeholder="Votre adresse complet">
            {% if errors.adresse is defined %}
            <span class="error">{{errors.adresse}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Ville :</lablel>
            <select name="idVille" id="idVille" class="form__options">
                <option value="">Choisissez la ville</option>
                {% for ville in villes %}
                <option value="{{ ville.id }}"
                    {% if ville.id == user.idVille %} selected {% endif %}>{{ ville.ville}}</option>
                {% endfor %}
            </select>
            {% if errors.idVille is defined %}
            <span class="error">{{errors.idVille}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Telephone :</lablel>
            <input class="form__input" type="text" name="telephone" id="telephone" value="{{user.telephone}}" placeholder="Format: 1234567890">
        </div>
        {% if errors.telephone is defined %}
        <span class="error">{{errors.telephone}}</span>
        {% endif %}
        <div class="form__contenu">
            <lablel class="form__label">Courriel :</lablel>
            <input class="form__input" type="text" name="courriel" id="courriel" value="{{user.courriel}}" placeholder="Format: courriel@courriel.com">
            {% if errors.courriel is defined %}
            <span class="error">{{errors.courriel}}</span>
            {% endif %}
            {% if message is defined %}
            <span class="error">{{message}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Mot de passe:</lablel>

            <input class="form__input" type="password" name="motPasse" id="motPasse"
                {% if user.motPasse is not defined %}
                value=""
                {% endif %}
                placeholder="Min 3, Max 8. Vous devez avoir des chiffres et lettres">

            {% if errors.motPasse is defined %}
            <span class="error">{{errors.motPasse}}</span>
            {% endif %}
        </div>
        <button type="submit" class="btn">Creer</button>
    </form>
</main>

{{ include('layouts/footer.php') }}