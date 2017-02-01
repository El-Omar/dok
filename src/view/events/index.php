<section class="intro">
  <header class="intro-header">
    <h2 class="hidden">Intro</h2>
  </header>

  <article class="welcome">
    <header class="welcome-header">
      <h3 class="welcome-title">
        Werfplek voor verpozing &amp; <br />creatieve manoeuvres
      </h3>
      <strong class="welcome-button"><a href="#">Over Dok</a></strong>
    </header>
    <img src="assets/img/site/intro-picture.png" alt="Intro picture" width="617" height="406" />
  </article>

  <article class="what">
    <header class="what-header">
      <h3 class="what-title">Van Mei tot September</h3>
      <strong class="sub-title">Elk jaar</strong>
    </header>
    <ul class="what-list">
      <li><span class="hashtag">#</span> Opening op 1 mei</li>
      <li><span class="hashtag">#</span> DOK sluit altijd om 24u</li>
      <li><span class="hashtag">#</span> Slot van het seizoen is op 25/09</li>
    </ul>
    <div class="what-text">
      <p>
        Vanaf 1 mei 2017 tot 25 september 2017 opent
        DOK haar deuren iedere zondag én feestdagen
        van 11u tot 22u. Dit wordt de vaste afspraak.
      </p>
      <p>
        De DOKbewoners openen DOK ook op andere dagen.
        Voor meer info hierover raadpleeg je best de programma.
      </p>
      <strong class="what-text-button">
        <a href="?page=schedule&amp;month=5">Programma</a>
      </strong>
    </div>
  </article>
</section>

<section class="people">
  <header class="people-header">
    <h2 class="hidden">Bewoners</h2>
  </header>

  <article class="join">
    <header class="join-header">
      <h3 class="what-title">DOKBewoner</h3>
      <strong class="sub-title">Word een</strong>
    </header>
    <div class="what-text">
      <p>
        Wat er gebeurt op DOK wordt bepaald door de DOKbewoners.
        Voor het nieuwe seizoen is DOK op zoek naar nieuwe DOKbewoners,
        residents, die DOK 2017 mee vorm en kleur willen geven met
        creatieve manoeuvres.
      </p>
      <p>
        Heb je een project die je aan het publiek wil tonen?
        Neem contact nu met DOK!
      </p>
      <strong class="what-text-button join-button">
        <a href="#">Word een bewoner</a>
      </strong>
    </div>
    <img src="assets/img/site/bewoners.png" alt="Bewoners"
      width="720" height="607" srcset="assets/img/site/bewoners.png 1900w, assets/img/site/default.gif 800w" />
  </article>

  <article class="creative">
    <header class="creative-header">
      <h3 class="creative-title">Iedereen is creatief!</h3>
    </header>
    <strong class="creative-text">
      Sommigen hebben gewoon een duwtje nodig!
    </strong>
  </article>
</section>

<section class="events">
  <header class="events-header">
    <h2 class="events-title">Programma</h2>
    <strong class="events-sub-title">Bekijk het</strong>
  </header>

  <?php foreach ($events as $event) {?>
    <a href="?page=details&amp;id=<?php echo $event["id"] ?>">
  <article class="event">
    <header class="event-header">
      <h3 class="event-title"><?php echo $event["title"] ?></h3>
    </header>
    <div class="event-pic-wrap">
      <img class="home-event-pic" style="background:url(<?php echo $event["images"][0] ?>);background-position:center;background-size:cover;" alt="Event1" width="350" height="230" >
      <div class="event-brushes">
        <strong class="event-date"><?php echo date('d M', strtotime($event["start"])); ?></strong>
        <?php if (isset($event["tags"])) { ?>
        <strong class="event-tag"><?php echo $event["tags"][0]["tag"] ?></strong>
        <?php } ?>
      </div>
    </div>
  </article>
  </a>
  <?php } ?>

  <div class="button-wrap">
    <strong class="what-text-button">
      <a href="?page=schedule">Bekijk meer</a>
    </strong>
  </div>
</section>

<aside class="sponsors">
  <header class="sponsors-header">
    <h2 class="sponsors-title">Sponsors</h2>
  </header>
  <a target="_blank" href="http://www.vlaanderen.be/">
    <img src="assets/img/sponsors/pa-vlaamse-overheid.png"
      alt="Vlaamse overheid" width="90" height="60" />
  </a>
  <a target="_blank" href="https://stad.gent/">
    <img src="assets/img/sponsors/pa-gent.png"
      alt="Stad Gent" width="88" height="60" />
  </a>
  <a target="_blank" href="http://www.thuisindestad.be/">
    <img src="assets/img/sponsors/pa-thuis.png"
      alt="Thuis in de stad" width="77" height="60" />
  </a>
  <a target="_blank" href="http://sogent.be/">
    <img src="assets/img/sponsors/sogent_ok.png"
      alt="Sogent" width="60" height="60" />
  </a>
  <a target="_blank" href="https://www.cirq.be/">
    <img src="assets/img/sponsors/pa-cirq.png"
      alt="Cirq" width="58" height="60" />
  </a>
  <a target="_blank" href="http://democrazy.be/">
    <img src="assets/img/sponsors/pa-democrazy.png"
      alt="Democrazy" width="83" height="60" />
  </a>
  <a target="_blank" href="http://vedett.be/">
    <img src="assets/img/sponsors/pa-vedett.png"
      alt="Vedett" width="60" height="60" />
  </a>
  <a target="_blank" href="http://pepsi.be/">
    <img src="assets/img/sponsors/pepsi_ok.png"
      alt="Pepsi" width="60" height="60" />
  </a>
  <a target="_blank" href="http://www.bionade.de/">
    <img src="assets/img/sponsors/bionade_ok.png"
      alt="Bionade" width="60" height="60" />
  </a>
  <a target="_blank" href="http://www.biofresh.be/">
    <img src="assets/img/sponsors/biofresh_ok.png"
      alt="Biofresh" width="60" height="60" />
  </a>
  <a target="" href="#">
    <img src="assets/img/sponsors/eulala_ok.png"
      alt="Eulala" width="60" height="60" />
  </a>
</aside>
