<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>DOKGent</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="author" content="Elomar Sami" />
  <meta name="description" content="Dit is de site van DOKGent" />
  <script>
    WebFontConfig = {
      custom: {
        families: [
          'Script',
          'Muli',
          'Playfair',
          'PlayfairItalic',
          'PlayfairBold'],
        urls: ['assets/fonts/fonts.css']
      }
    };

    (function() {
  		var wf = document.createElement('script');
  		wf.src = 'js/webfontloader.js';
  		wf.type = 'text/javascript';
  		var s = document.getElementsByTagName('script')[0];
  		s.parentNode.insertBefore(wf, s);
  	})();
  </script>
  <?php echo $css;?>
</head>
<body>

  <header class="page-header">
    <a href="?page=home">
      <h1 class="page-title"><span class="hidden">DOK</span></h1>
    </a>
    <nav class="header-nav">
      <ul class="nav-list">
        <li class="nav-item"><a href="#">DOK2017</a></li>
        <li class="nav-item"><a href="?page=schedule">Programma</a></li>
        <li class="nav-item"><a href="#">Blogs</a></li>
        <li class="nav-item"><a href="#">Praktisch</a></li>
      </ul>
    </nav>
  </header>

  <div class="container">
    <?php if(!empty($_SESSION['info'])): ?><div class="alert alert-success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
    <?php if(!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?php echo $_SESSION['error'];?></div><?php endif; ?>

    <?php echo $content; ?>
  </div>

  <footer class="page-footer">
    <article class="news">
      <header class="news-header">
        <h2 class="news-title">Nieuwsbrief</h2>
      </header>
      <strong class="news-text">Schrijf je in voor het nieuwsbrief om op de hoogte te blijven.</strong>
      <form class="news-form" method="POST" action="">
        <input class="email" type="email" name="email" value="" placeholder="E-mailadres" />
        <input class="form-button" type="submit" name="" value="Inschrijven">
      </form>
    </article>
    <ul class="footer-list">
      <li class="footer-list-item"><a href="#">Home</a></li>
      <li class="footer-list-item"><a href="#">DOK2017</a></li>
      <li class="footer-list-item"><a href="#">Programma</a></li>
      <li class="footer-list-item"><a href="#">Blogs</a></li>
      <li class="footer-list-item"><a href="#">Praktisch</a></li>
    </ul>
    <div class="social-media">
      <a target="_blank" href="https://www.facebook.com/pages/DOK/155427904513736">
        <strong class="fb">
          <span class="hidden">Facebook</span>
        </strong>
      </a>
      <a target="_blank" href="https://twitter.com/dokgent">
        <strong class="twitter">
          <span class="hidden">Twitter</span>
        </strong>
      </a>
    </div>
  </footer>

  <?php echo $js;?>
</body>
</html>
