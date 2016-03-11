
<?php if ( ! empty( $reviews ) ) {
    foreach ( $reviews as $key => $review ) { ?>
    <li class="review_block_<?php echo $review["review_id"] ?> panel panel-info">
        <div class="panel-heading"> 
           <p>
                <span>
                    Отзыв от <b><?php echo $review['review_author']; ?></b>
                </span> 
                <span>
                    оставлен <?php echo $review["review_date"]; ?>
                </span>
                к резюме 
                <span> 
                    <b><?php echo $review['resume_name']; ?></b>
                </span>
                
            </p>
        </div>

        <div class="panel-body">
            <p >
                <?php echo $review["review_text"]; ?>
            </p>
        </div> 
    </li>

    <?php }
} else { ?>
   <li class="panel panel-warning review-impty-block">
        <div class="panel-heading"> 
            <p>
                Пока нет ни одного отзыва.
            </p>
        </div>
   </li>
<?php } ?>
