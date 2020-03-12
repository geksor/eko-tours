<? if ($rooms) { ?>

    <? foreach ($rooms as $startDate => $rowStart) { ?>
        <? foreach ($rowStart as $endDate => $rowEnd) { ?>
            <? foreach ($rowEnd as $accomKey => $rowAccom) { ?>
        <div class="tour_in tour_know">
          <h2 class="h4">Стоимость тура при размещении в «<?= $rowAccom["title"] ?>» с <?= date('d.m.Y', strtotime($startDate)) ?> по <?= date('d.m.Y',
                  strtotime($endDate)) ?></h2>
          <ul class="price_tour">
              <? if ($rowAccom["items"]) { ?>
                  <? foreach ($rowAccom["items"] as $item) { ?>
                  <li style="background-image:url('/<?= $item["image"] ?>')">
                    <a href="/tours/<?= $category->alias ?>/<?= $model->alias ?>/<?= $item["id"] ?>_<?= $item["period_id"] ?>_<?= $startDate ?>_<?= $endDate ?>" data-room_id="<?= $item["id"] ?>" data-title="<?= htmlspecialchars($item["title"]) ?>" data-date_from="<?= $startDate ?>" data-date_to="<?= $endDate ?>" target="_blank">
                    <p><?= $item["title"] ?></p>
                      <? if ($item["price"]) { ?>
                        &nbsp;- <strong><?= $item["price"] ?> руб.</strong>
                      <? } else { ?>
                        Подробности по телефону
                      <? } ?>
                    </a>
                  </li>
                  <? } ?>
              <? } ?>
          </ul>
        </div>
            <? } ?>
        <? } ?>
    <? } ?>
<? } ?>