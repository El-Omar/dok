<section class="schedule">

  <header class="schedule-header">
    <h2 class="schedule-title">Programma</h2>
  </header>

  <div class="months">
    <?php foreach ($months as $id => $month): ?>
    <form class="" method="GET" action="index.php?page=schedule">
      <div class="month">
        <input type="hidden" name="month" value="<?php echo $month ?>" />
        <input type="submit" class="month-submit" name="page" value="schedule" />
        <strong class="month-circle">•</strong>
        <strong class="month-name"><?php echo $month ?></strong>
      </div>
    </form>
    <?php endforeach; ?>
  </div>

  <?php foreach ($events as $event): ?>
  <article class="prog">
    <div class="prog-wrap">
      <header class="prog-header">
        <h3 class="prog-title"><?php echo $event["title"] ?></h3>
      </header>
      <p class="prog-desc">
        BLANCO  is de noemer waaronder de Gentse atelierorganisatie NUCLEO haar
        platformfunctie uitbouwt. BLANCO biedt een venster op het werk van de bij NUCLEO...
      </p>
      <?php if (isset($event["tags"])) {
        foreach ($event["tags"] as $tag) {
          ?>
          <strong class="prog-tag">#<?php echo $tag["tag"] ?></strong>
          <?php
        }
      ?>
      <?php } ?>
    </div>
    <div class="prog-pic-wrap">
      <img class="prog-pic" src="assets/img/site/event-placeholder.jpg" alt="Event1" width="350" height="230" >
      <div class="prog-brushes">
        <strong class="event-date schedule-prog-date"><?php echo date('d/m', strtotime($event["start"])); ?></strong>
      </div>
    </div>
  </article>
  <?php endforeach; ?>

  <aside class="filter">
    <button class="filter-toggle-button">Zoek</button>
    <form class="filter-form" method="GET" action="?page=schedule">
      <div class="filter-tag">
        <input class="filter-tag-checkbox" type="checkbox" value="1" id="circus" />
        <label class="filter-tag-label" for="circus">Cozy Cosy (5)</label>
      </div>

      <div class="filter-tag">
        <input class="filter-tag-checkbox" type="checkbox" value="1" id="circus" />
        <label class="filter-tag-label" for="circus">Circus (21)</label>
      </div>

      <div class="filter-tag">
        <input class="filter-tag-checkbox" type="checkbox" value="1" id="circus" />
        <label class="filter-tag-label" for="circus">DJ (1)</label>
      </div>
      <div class="filter-tag">
        <input class="filter-tag-checkbox" type="checkbox" value="1" id="circus" />
        <label class="filter-tag-label" for="circus">Festival (20)</label>
      </div>
      <div class="filter-tag">
        <input class="filter-tag-checkbox" type="checkbox" value="1" id="circus" />
        <label class="filter-tag-label" for="circus">Expo (1)</label>
      </div>
      <div class="filter-tag">
        <input class="filter-tag-checkbox" type="checkbox" value="1" id="circus" />
        <label class="filter-tag-label" for="circus">Moestijn (1)</label>
      </div>

      <div class="filter-submit-wrap">
        <input class="filter-submit" type="submit" name="filter_submit" value="ZOEKEN">
      </div>
    </form>
  </aside>
</section>
