<div class="thinkus-item-wrapper">
    <article class="thinkus-item-container">
    <a href="<?php echo get_the_permalink();?>"> <h3 class="thinkus-title"><?php echo get_the_title(); ?></h3></a>
        <div class="skills-list">
            <?php 
            $count =0;
            $skills =  get_the_terms(get_the_ID(),'thinkus_perfil');
           
            if($skills){
            foreach($skills as $skill){
                $count++; 
                echo '<span class="skill-item"><a href="' . esc_url( get_term_link( $skill, 'thinkus_perfil' ) ) . '">' . esc_html( $skill->name ) . '</a></span>';
                if($count!=count($skills)){
                    echo ', ';
                }
            } 
        }
            ?>
        
        </div>
        <a href="<?php echo get_the_permalink();?>">
            <div class="thinkus-excerpt">
                <?php echo thinkus_employee_custom_excerpts(15); ?>
            </div>
        </a>
        <div class="ubication-list">
        <?php 
            $count =0;
            $cities =  get_the_terms(get_the_ID(),'thinkus_ciudad');
           if($cities){
            foreach($cities as $city){
                $count++; 
                echo '<span class="city-item"><a href="' . esc_url( get_term_link( $city, 'thinkus_ciudad' ) ) . '">' . esc_html( $city->name ) . '</a></span>';
                if($count!=count($cities)){
                    echo ', ';
                }
            } 
           }
            ?>
        </div>
    </article>
</div>