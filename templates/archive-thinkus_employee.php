<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Base_boilerplate
 */

get_header();
$header_title = get_option('header_title');
$header_description = get_option('header_description');
$header_image = get_option('Header_image');
$page_title = get_option('page_title');

$get_offers= get_posts( array(
	'post_type'  => 'thinkus_employee',
	'posts_per_page' =>-1,
 ) );
?>
		
		<?php 
		set_query_var('thinkus_header',['title'=>$header_title,'description'=>$header_description,'image'=>$header_image]);
		echo thinkus_employee_get_template_part('templates/templates-parts/thinkus','header'); ?>
	<main id="primary" class="vacant-achive-page">
<section class="offer-options">
<div class="offer-options-content">
	<h2 class="offer-title">
		<?php echo $page_title; ?>
	</h2>
	<h3 class="offer-count">
<?php printf('Tenemos  <b>%d ofertas </b> para ti',count($get_offers)); ?>
	</h3>
	<form action="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>" method="get">
	<?php
		//?thinkus_ubicacion=chile&thinkus_ciudad=&thinkus_perfil=&thinkus_modalidad=
		$get_ubicacion = $_GET['thinkus_ubicacion'];
		$get_ciudad = $_GET['thinkus_ciudad'];
		$get_perfil = $_GET['thinkus_perfil'];
		$get_modificacion = $_GET['thinkus_modalidad'];
	?>
		<div class="form-wrapper">
		<select name="thinkus_ubicacion" id="thinkus_ubicacion" class="query-offer">
			<option value="">País</option>
			<?php
			$options = get_terms( array(
								'taxonomy' => 'thinkus_ubicacion',
								'hide_empty' => false,
								'orderby'=> 'name',
    							'order' => 'ASC',
			 					) 
							);
				foreach($options as $option){
					
					if($option->slug== $get_ubicacion){
                        echo '<option selected value="'.$option->slug.'">'.$option->name.'</option>';
                    }else{

                        echo '<option value="'.$option->slug.'">'.$option->name.'</option>';
                    }
				} 
			?>
		</select>
		<select name="thinkus_ciudad" id="thinkus_ciudad" class="query-offer">
			<option value="">Ciudad</option>
			<?php
			$options = get_terms( array(
								'taxonomy' => 'thinkus_ciudad',
								'hide_empty' => false,
								'orderby'=> 'name',
    							'order' => 'ASC',
			 					) 
							);
				foreach($options as $option){
					
					if($option->slug == $get_ciudad ){
                        echo '<option selected value="'.$option->slug.'">'.$option->name.'</option>';
                    }else{

                        echo '<option value="'.$option->slug.'">'.$option->name.'</option>';
                    }
				} 
			?>
		</select>
		<select name="thinkus_perfil" id="thinkus_perfil" class="query-offer">
			<option value="">Perfil</option>
			<?php
			$options = get_terms( array(
								'taxonomy' => 'thinkus_perfil',
								'hide_empty' => false,
								'orderby'=> 'name',
    							'order' => 'ASC',
			 					) 
							);
				foreach($options as $option){
					
					if($option->slug == $get_perfil ){
                        echo '<option selected value="'.$option->slug.'">'.$option->name.'</option>';
                    }else{

                        echo '<option value="'.$option->slug.'">'.$option->name.'</option>';
                    }
				} 
			?>
		</select>
		<select name="thinkus_modalidad" id="thinkus_modalidad" class="query-offer">
			<option value="">Modalidad</option>
			<?php
			$options = get_terms( array(
								'taxonomy' => 'thinkus_modalidad',
								'hide_empty' => false,
								'orderby'=> 'name',
    							'order' => 'ASC',
			 					) 
							);
				foreach($options as $option){
					
					if($option->slug== $get_modificacion){
                        echo '<option selected value="'.$option->slug.'">'.$option->name.'</option>';
                    }else{

                        echo '<option value="'.$option->slug.'">'.$option->name.'</option>';
                    }
				} 
			?>
		</select>
		<button class="get-offers" type="submit">Buscar</button>
		</div>
	</form>
	
</div>
</section>
<section class="offers-section">
	<?php
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
		$queries=array(
			'relation' => 'AND',
		);
		if($get_ubicacion!=''){
			array_push($queries,[
				'taxonomy' => 'thinkus_ubicacion',
			'field'    => 'slug',
			'terms'    => $get_ubicacion,
			]);
		}
		if($get_ciudad!=''){
			array_push($queries,[
				'taxonomy' => 'thinkus_ciudad',
			'field'    => 'slug',
			'terms'    => $get_ciudad,
			]);
		}
		if($get_perfil !=''){
			array_push($queries,[
				'taxonomy' => 'thinkus_perfil',
			'field'    => 'slug',
			'terms'    => $get_perfil,
			]);
		}
		if($get_modificacion!=''){
			array_push($queries,[
				'taxonomy' => 'thinkus_modalidad',
			'field'    => 'slug',
			'terms'    => $get_modificacion,
			]);
		}

		$args = array(
			'post_type' => 'thinkus_employee',
			'posts_per_page' => 8,
			'paged' => $paged,
		   'post_status'=>'publish',
		   'tax_query' =>$queries,
		);
		
		$loop = new WP_Query($args);
	
	?>
			<?php
			if($loop->have_posts()):
				echo '<div class="offers-wrapper">';
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<div class="offer">
			<?php echo thinkus_employee_get_template_part('templates/templates-parts/thinkus','item'); ?>
			</div>
				<?php
				endwhile;
			else:
				echo '<div class="no-offers">';
				?>
				<h2 class="results">No ha resultados de la busqueda</h2>
				<?php
			endif;
			echo '</div>';
			?>
		</div>
</section>
<section class="offer-pagination">
			<ul class="offer-pagination-wrapper">
<?php

$big = 999999999;
$links = paginate_links( array(
	 'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
	 'format' => '?paged=%#%',
	 'current' => max( 1, get_query_var('paged') ),
	 'total' => $loop->max_num_pages,
	 'prev_text' => 'Anterior',
	 'next_text' => 'Siguiente',
	'type'=>'array'
   
) );
if(is_array($links)){
	foreach($links as $link){
	echo '<li>'.$link.'</li>';
}
}
?>
			</ul>
</section>
		

			

		

	</main><!-- #main -->

<?php
 wp_reset_postdata();
get_sidebar();
get_footer();
