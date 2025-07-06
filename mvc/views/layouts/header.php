<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Actor&family=Allura&family=Amatic+SC:wght@400;700&family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&family=Belleza&family=Cinzel:wght@400..900&family=Kings&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lexend+Giga:wght@100..900&family=Lexend+Mega:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pompiere&family=Quicksand:wght@300..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- LINK FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- LINK CSS -->
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
    <title>{{ title }}</title>
</head>

<body class="fond-img">
    <nav class="navigation">
        <picture class="logo">
            <a href="{{ base }}/user/create"><img src="{{ asset }}/img/logo_librairie.png" alt="logo"></a>
        </picture>
        <ul class="navigation__menu">
            <li><a href="{{ base }}{{ lien1 }}">{{ nav1 }}</a></li>
            <li><a href="{{ base }}{{ lien2 }}">{{ nav2 }}</a></li>
            <li><a href="{{ base }}{{ lien3 }}">{{ nav3 }}</a></li>
            <li><a href="">A propos</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>