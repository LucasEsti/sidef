<div class="w-100 logo-accroche">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-md-6 col-12 carous-logo owl-carousel owl-theme">
                <?php
                $logos = get_field('logos', 'option');
                foreach ($logos as $logo): ?>
                <img class="img-fluid item " src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/>
            <?php endforeach;  ?>
            </div>
        </div>
    </div>
</div>
