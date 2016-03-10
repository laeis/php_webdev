
<?php if ( ! empty( $reviews ) ) {
    foreach ( $reviews as $key => $review ) { ?>
    <li class="review_block_<?php echo $review["review_id"] ?> panel panel-info">
        <div class="panel-heading"> 
           <p>
                <span>
                    Отзыв от <?php echo $review['review_author']; ?>
                </span> 
                <span>
                    оставлен <?php echo $review["review_date"]; ?>
                </span>
                к резюме 
                <span> 
                    <?php echo $review['resume_name']; ?>
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
} ?>
