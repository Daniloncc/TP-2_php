{{ include('layouts/header.php', {title: 'Livres'})}}

<header>
    <h1 class="quicksand">Librairie <strong class="pompiere">Voyages imaginaires</strong></h1>
</header>

<main class="main__form">

    <form action="{{base}}/client/store" method="post" class="form">
        <header>
            <h2 class="quicksand">Creez votre compte</h2>
            <hr>
        </header>
        <div class="form__contenu">
            <lablel class="form__label">Nom :</lablel>
            <input class="form__input" type="text" name="nom" id="nom" value="{{client.nom}}">
            {% if errors.nom is defined %}
            <span class="error">{{errors.nom}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Prenom :</lablel>
            <input class="form__input" type="text" name="prenom" id="prenom" value="{{client.prenom}}">
            {% if errors.prenom is defined %}
            <span class="error">{{errors.prenom}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Adresse :</lablel>
            <input class="form__input" type="text" name="adresse" id="adresse" value="{{client.adresse}}">
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
                    {% if ville.id == client.idVille %} selected {% endif %}>{{ ville.ville}}</option>
                {% endfor %}
            </select>
            {% if errors.idVille is defined %}
            <span class="error">{{errors.idVille}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Telephone :</lablel>
            <input class="form__input" type="text" name="telephone" id="telephone" value="{{client.telephone}}">
        </div>
        {% if errors.telephone is defined %}
        <span class="error">{{errors.telephone}}</span>
        {% endif %}
        <div class="form__contenu">
            <lablel class="form__label">Courriel :</lablel>
            <input class="form__input" type="text" name="courriel" id="courriel" value="{{client.courriel}}">
            {% if errors.courriel is defined %}
            <span class="error">{{errors.courriel}}</span>
            {% endif %}
        </div>
        <button type="submit" class="btn">Creer</button>
    </form>
</main>

{{ include('layouts/footer.php') }}