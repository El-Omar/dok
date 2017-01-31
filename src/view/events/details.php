<section class="details">
  <header class="details-header">
    <h2 class="details-title"><?php echo $event["title"] ?></h2>
    <strong class="details-date">
      <?php echo date('d/m/Y', strtotime($event["start"])) . " - " . date('d/m/Y', strtotime($event["end"])); ?>
    </strong>
    <strong class="details-time">
      <?php echo date('H:i', strtotime($event["start"])) . " - " . date('H:i', strtotime($event["end"])); ?>
    </strong>
  </header>

  <?php
  $desc = explode(' ', $event["description"]);
  $firstParagraph = "";
  $secondParagraph = "";

  for ($i = 0; $i < 60; $i++) {
    if (isset($desc[$i]))
    $firstParagraph .= $desc[$i]. " ";
  }

  for ($i = 60; $i < count($desc); $i++) {
    if (isset($desc[$i]))
    $secondParagraph .= $desc[$i]. " ";
  }
  ?>

  <div class="desc-wrap">
    <div class="first-row">
      <div class="details-pic-wrap">
        <div class="details-pic" style="background:url(<?php echo $event["images"][0] ?>);background-position:center;background-size:cover;"></div>
        <div class="details-brushes"></div>
      </div>
      <p class="details-desc first-desc">
        <?php
        echo $firstParagraph;
        ?>
      </p>
    </div>
    <p class="details-desc second-desc">
      <?php echo $secondParagraph; ?>
    </p>

    <?php if (isset($event["tags"])) foreach ($event["tags"] as $tag): ?>
    <strong class="prog-tag details-tag">#<?php echo $tag["tag"] ?></strong>
    <?php endforeach;

    if (isset($event["images"]) && count($event["images"]) > 1) {
    ?>
    <div class="details-other-pics">
      <?php
      for ($i = 1; $i < 3; $i++) {
        if (isset($event["images"][$i])) {
          ?>
          <div class="details-other-pics-<?php echo $i; ?>" style="background:url(<?php echo $event["images"][$i] ?>);background-position:center;background-size:cover;"></div>
          <?php
        }
      }
      ?>
    </div>
    <?php } ?>

    <div class="go-back">
      <a class="go-back-link" href="?page=schedule&amp;month=5">Ga terug</a>
    </div>

  </div>
</section>
