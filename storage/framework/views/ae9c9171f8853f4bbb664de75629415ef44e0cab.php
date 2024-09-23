<?php $__env->startPush('style'); ?>

    <style>
        fieldset, label {
            margin: 0;
            padding: 0;
        }

        /*body {*/
        /*margin: 20px;*/
        /*}*/

        /*h1 {*/
        /*font-size: 1.5em;*/
        /*margin: 10px;*/
        /*}*/

        /****** Style Star Rating Widget *****/

        .rating {
            border: none;
            float: left;
        }

        .rating > input {
            display: none;
        }

        .rating > label:before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating > .half:before {
            content: "\f089";
            position: absolute;
        }

        .rating > label {
            color: #ddd;
            float: right;
        }

        /***** CSS Magic to Highlight Stars on Hover *****/

        .rating > input:checked ~ label, /* show gold star when clicked */
        .rating:not(:checked) > label:hover, /* hover current star */
        .rating:not(:checked) > label:hover ~ label {
            color: #ff9900;
        }

        /* hover previous stars in list */

        .rating > input:checked + label:hover, /* hover current star when changing rating */
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating > input:checked ~ label:hover ~ label {
            color: #ff9900;
        }
    </style>
<?php $__env->stopPush(); ?>

<div id="reviews" class="tab-panel">
    <div class="product-comments-block-tab">
        <div class="row">
            
            <form class="ajaxReviewForm">
                <div class="col-md-6">
                    <?php echo Form::hidden('product_id', $product->id, ['class' => 'form-control product_id']); ?>

                    <div class="form-group">
                        <label for="description">Your review</label>
                        <?php echo Form::textarea('description', null, ['class' => 'form-control description', 'required', 'id'=>'product_review', 'height'=>'20px', 'placeholder'=> 'Description']); ?>

                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label><br>
                        <fieldset class="rating">
                            <input type="radio" class="product_rating" id="star5" name="rating" value="5"/>
                            <label class="full" for="star5" title="Awesome - 5 stars"></label>
                            
                            
                            <input type="radio" class="product_rating" id="star4" name="rating" value="4"/>
                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                            
                            
                            <input type="radio" class="product_rating" id="star3" name="rating" value="3"/>
                            <label class="full" for="star3" title="Meh - 3 stars"></label>
                            
                            
                            <input type="radio" class="product_rating" id="star2" name="rating" value="2"/>
                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                            
                            
                            <input type="radio" class="product_rating" id="star1" name="rating" value="1"/>
                            <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                            
                            
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <button class="button btn-comment ajaxReviewSubmit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <?php $__currentLoopData = $product->reviews->where('status', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="comment row">
                <div class="col-sm-3 author">
                    <div class="info-author">
                        <span><strong><?php echo e($review->user->username); ?></strong></span>
                        <em><?php echo e(SM::showDateTime($review->created_at)); ?></em>
                    </div>
                    <div class="grade">
                        <span><?php echo e($review->title); ?></span>
                        <span class="reviewRating">
                            <?php for($i = 0; $i < 5; ++$i): ?>
                                <i class="fa fa-star<?php echo e($review->rating<=$i?'-o':''); ?>" aria-hidden="true"></i>
                            <?php endfor; ?>
                           </span>
                    </div>
                </div>
                <div class="col-sm-9 commnet-dettail">
                    <?php echo e($review->description); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php if(Auth::check()): ?>
<?php else: ?>
    <?php $__env->startPush('script'); ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#product_review").click(function () {
                    $('.loginModal').modal('show');
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
 