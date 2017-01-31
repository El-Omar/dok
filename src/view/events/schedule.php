<section class="schedule">
  <header class="schedule-header">
    <h2 class="schedule-title">Programma</h2>
  </header>

  <div class="months">
    <?php foreach ($months as $id => $month): ?>
    <form class="" method="GET" action="index.php?page=schedule">
      <div class="month">
        <input type="hidden" name="page" value="schedule" />
        <input type="hidden" name="month" value="<?php echo $id ?>" />
        <input type="submit" class="month-submit" name="" value="" />
        <?php
        $active = "";
        if (isset($_GET["month"]) && $_GET["month"] == $id) {
          $active = "active";
        }
        ?>
        <strong class="month-circle <?php echo $active; ?>">•</strong>
        <strong class="month-name <?php echo $active; ?>"><?php echo $month ?></strong>
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
      foreach ($event["tags"] as $tag):
      ?>
      <strong class="prog-tag">#<?php echo $tag["tag"] ?></strong>
      <?php endforeach; } ?>
    </div>

      <div class="prog-pic-wrap">
        <a href="?page=details&amp;id=<?php echo $event["id"] ?>">
        <img class="prog-pic" style="background:url(<?php echo $event["images"][0] ?>);background-position:center;background-size:cover;" alt="Event1" width="350" height="230" >
        <div class="prog-brushes">
          <strong class="event-date schedule-prog-date"><?php echo date('d/m', strtotime($event["start"])); ?></strong>
        </div>
        </a>
      </div>

  </article>

  <?php endforeach; ?>

  <aside class="filter closed">
    <button class="filter-toggle-button">Filter</button>
    <form class="filter-form hidden" method="GET" action="?page=schedule">
      <input type="hidden" name="page" value="schedule" />
      <?php foreach ($tags as $tag): ?>
      <div class="filter-tag">
        <input class="filter-tag-checkbox" name="tags[]" type="checkbox" value="<?php echo $tag["tag"] ?>" id="tag<?php echo $tag["id"]; ?>" />
        <label class="filter-tag-label" for="tag<?php echo $tag["id"]; ?>"><?php echo $tag["tag"] ?></label>
      </div>
      <?php endforeach; ?>

      <div class="filter-submit-wrap">
        <input class="filter-submit" type="submit" name="" value="Filteren">
      </div>
    </form>
  </aside>
</section>
