{% if session.userId is defined %}
{{ include('layouts/header.php', {
        title: 'Editer Profil',
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
    <!-- si je ne mets pas un action je reviens a la meme page -->
    <form method="post" class="form">
        <header>
            <h2 class="quicksand">Editez votre profil</h2>
            <hr>
        </header>
        <input class="form__input" type="hidden" name="id" id="id" value="{{ user.id }}">
        <div class="form__contenu">
            <lablel class="form__label">Nom :</lablel>
            <input class="form__input" type="text" name="nom" id="nom" value="{{ user.nom }}">
            {% if errors.nom is defined %}
            <span class="error">{{errors.nom}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Prenom :</lablel>
            <input class="form__input" type="text" name="prenom" id="prenom" value="{{ user.prenom }}">
            {% if errors.prenom is defined %}
            <span class="error">{{errors.prenom}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Adresse :</lablel>
            <input class="form__input" type="text" name="adresse" id="adresse" value="{{ user.adresse }}">
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
        <div class=" form__contenu">
            <lablel class="form__label">Telephone :</lablel>
            <input class="form__input" type="text" name="telephone" id="telephone" value="{{ user.telephone }}">
            {% if errors.telephone is defined %}
            <span class="error">{{errors.telephone}}</span>
            {% endif %}
        </div>
        <div class="form__contenu">
            <lablel class="form__label">Courriel :</lablel>
            <input class="form__input" type="text" name="courriel" id="courriel" value="{{ user.courriel }}">
            {% if errors.courriel is defined %}
            <span class="error">{{errors.courriel}}</span>
            {% endif %}
        </div>
        <!-- seulement le Admin peut changer le role -->
        {% if user.idRole == 1 %}
        <div class="form__contenu">
            <lablel class="form__label">Role :</lablel>
            <select name="idRole" id="idRole" class="form__options">
                <option value="">Choisissez le Role</option>
                {% for role in roles %}
                <option value="{{ roles.role }}"
                    {% if role.id == user.idRole %} selected {% endif %}>{{ role.role}}</option>
                {% endfor %}
            </select>
            <!-- {% if errors.idVille is defined %}
            <span class="error">{{errors.idVille}}</span>
            {% endif %} -->
        </div>
        {% endif %}
        <button type="submit" class="btn">Modifier</button>
        <div>
            <a class="btn btn-alerte" href="{{ base }}/user/show?id={{ user.id }}">Retourner</a>
        </div>
    </form>
</main>
{{ include('layouts/footer.php') }}