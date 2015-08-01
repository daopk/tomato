<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TOMATO PHP</title>
    <?php $this->RenderStyle() ?>
</head>
<body>
    <nav class="orange darken-4" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo">Tomato</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Navbar Link</a></li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="#">Navbar Link</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div class="container row section">
        <?php $this->RenderBody() ?>
    </div>

    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                © 2014-2015 Materialize, All rights reserved.
            </div>
        </div>
    </footer>
    <?php $this->RenderScript() ?>
</body>
</html>