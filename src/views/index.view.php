<ul>
<?php foreach ($products as $product):
extract($product) ?>
    <li><a href="/product?productCode=<?= $productCode ?>"><?= $productName ?></a></li>
<?php endforeach; ?>
</ul>