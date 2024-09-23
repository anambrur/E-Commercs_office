<div class="breadcrumb clearfix">

    <?php if(Route::current()->getName() != 'home'): ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-2">
                
                <?php
                    $link = url('/');
                ?>
                <a href="/">Home</a> >
                <?php $link = "" ?>
                <?php for($i = 1; $i <= count(Request::segments()); $i++): ?>
                    <?php if($i < count(Request::segments()) & $i > 0): ?>
                        <?php $link .= "/" . Request::segment($i); ?>
                        <a href="<?= $link ?>"><?php echo e(ucwords(str_replace('-',' ',Request::segment($i)))); ?></a> >
                    <?php else: ?> <?php echo e(ucwords(str_replace('-',' ',Request::segment($i)))); ?>

                    <?php endif; ?>
                <?php endfor; ?>
                
                    
                    
                        
                            
                                
                            
                                
                            
                        
                    
                
            </ol>
        </nav>
    <?php endif; ?>
</div>