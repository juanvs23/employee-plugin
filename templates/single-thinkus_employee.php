<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Base_boilerplate
 */

get_header();
?>

	<main id="primary" class="single-offer">

		<?php
		while ( have_posts() ) :
			the_post();
			$header_images = get_the_post_thumbnail_url(get_the_ID(),'full')? get_the_post_thumbnail_url(get_the_ID(),'full'): THINKEMPLOYEE_PLUGIN_URL.'assets/images/default-single.svg';
			$requirements =  get_post_meta($post->ID, 'requirement', true)? json_decode(get_post_meta($post->ID, 'requirement', true)):[];
			$languages =  get_post_meta($post->ID, 'languages', true)? json_decode(get_post_meta($post->ID, 'languages', true)):[];
			$whitlists = get_post_meta($post->ID, 'whitlist', true)? json_decode(get_post_meta($post->ID, 'whitlist', true)):[];
			/**
			 * Infos
			 */
			$requirement_info =  get_post_meta($post->ID, 'requirement-info', true)? get_post_meta($post->ID, 'requirement-info', true):'';
			$languages_info =  get_post_meta($post->ID, 'languages-info', true)? get_post_meta($post->ID, 'languages-info', true):'';
			$whitlist_info = get_post_meta($post->ID, 'whitlist-info', true)? get_post_meta($post->ID, 'whitlist-info', true):'';
		   
			$workTime= get_post_meta(get_the_ID(), 'workTime', true)? json_decode(get_post_meta(get_the_ID(), 'workTime', true)):[];
    $expireTime= get_post_meta(get_the_ID(), 'expireTime', true)? get_post_meta(get_the_ID(), 'expireTime', true):'';
	//thinkus_ubicacion
	$ubications = get_the_terms(get_the_ID(),'thinkus_ubicacion');
	//thinkus_ciudad
    $cities = get_the_terms(get_the_ID(),'thinkus_ciudad');
	//thinkus_perfil
$skills = get_the_terms(get_the_ID(),'thinkus_perfil');
	//thinkus_modalidad
	$modalidades = get_the_terms(get_the_ID(),'thinkus_modalidad');
	$active_offer = get_post_meta($post->ID, 'active-offer', true)? true:false;
	

//var_dump($workTime);
?>

<header class="header-vacante">
<img src="<?php echo $header_images; ?>" alt="<?php echo get_the_title();?>" class="header-image">
<div class="header-content">
	<div class="header-wrpper">
	<div class="text-section">
		<h1 class="offer-title"><?php echo get_the_title();?></h1>
		<div class="info-meta">
			<?php 
			if ( ! empty($skills ) ) {
				if ( ! is_wp_error($skills ) ) {
			?>
			<div class="profile meta-components">
				<div class="meta-icon">
				<i class="fa-solid fa-address-card"></i>
				</div>
				<div class="meta-info">
					<?php
					
							echo '<ul>';
								foreach( $skills as $skill ) {
									echo '<li><a href="' . esc_url( get_term_link( $skill, 'thinkus_perfil' ) ) . '">' . esc_html( $skill->name ) . '</a></li>'; 
								}
							echo '</ul>';
					?>
				</div>
			</div>
			<?php
				}
			}
			?>
			<?php 
			if ( ! empty($ubications ) ) {
				if ( ! is_wp_error($ubications ) ) {
			?>
			<div class="location meta-components">
				<div class="meta-icon">
				<i class="fa-solid fa-location-dot"></i>
				</div>
				<div class="meta-info">
					<?php
					
					echo '<ul>';
					foreach( $ubications as $ubication ) {
						echo '<li><a href="' . esc_url( get_term_link( $ubication, 'thinkus_ubicacion' ) ) . '">' . esc_html( $ubication->name ) . '</a></li>'; 
					}
				echo '</ul>';
					?>
					
				</div>
			</div>
			<?php
				}
			}
			?>
			<?php 
			if ( ! empty($modalidades ) ) {
				if ( ! is_wp_error($modalidades ) ) {
			?>
			<div class="modality meta-components">
				<div class="meta-icon">
				<i class="fa-solid fa-briefcase"></i>
				</div>
				<div class="meta-info">

				<?php
					
					echo '<ul>';
					foreach( $modalidades as $modalidad ) {
						echo '<li><a href="' . esc_url( get_term_link( $modalidad, 'thinkus_modalidad' ) ) . '">' . esc_html( $modalidad->name ) . '</a></li>'; 
					}
				echo '</ul>';
					?>
				</div>
			</div>
			<?php
				}
			}
			?>
				<?php 
			if ( ! empty($workTime ) ) {
				if ( ! is_wp_error($workTime ) ) {
			?>
			<div class="location meta-components">
				<div class="meta-icon">
				<i class="fa-solid fa-clock"></i>
				</div>
				<div class="meta-info">
					<?php
					
					echo '<ul>';
					if( $workTime ) {
						/*
							<option value='1'>Jornada completa</option>
					<option value='2'>Media jornada</option>
					<option value='3'>Por hora</option>
					<option value='4'>Freelance</option>
						
						*/
						switch ($workTime->jornal) {
							case '1':
								echo '<li>Jornada completa</li>';
								break;
							case '2':
								echo '<li>Media jornada</li>';
								break;
							case '3':
								echo '<li>Por hora</li>';
								break;
							default:
							echo '<li>Freelance</li>';
								break;
						}

						 
					}
				echo '</ul>';
					?>
					
				</div>
			</div>
			<?php
				}
			}
			?>
			
			<div class="Expired-data meta-components">
				<div class="meta-icon">
				<i class="fa-solid fa-calendar-days"></i>
				</div>
				<div class="meta-info">
				<?php 
				if($active_offer):
			if ( ! empty( $expireTime ) ) {
				if ( ! is_wp_error( $expireTime ) ) {
			
					$date_time = explode('-',$expireTime);
					
					$months =['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
					$current_month = $months[intval($date_time[1]) - 1 ];
					$year = intval($date_time[0]);
					$day = $date_time[2];
					
					echo "{$day} de {$current_month} de {$year}, fecha limite de postulación";
				}
			}else{
				echo 'Permanente';
			}
			else:
				echo 'Completado';
			endif;
					?>
				</div>
			</div>
			</div>
		
	</div>
	<div class="button-area">
		<button  <?php echo $active_offer?'':'disabled'; ?> class="<?php echo $active_offer?'':'disabled'; ?> activer-offert">Postúlate aquí</button>
	</div>
	</div>
</div>
</header>
<section class="offer-content">
	<div class="offer-container-wrapper">
	<div id="getInformation" class="offer-information active">
	<article class="offer-descrition">
		<h2 class="offer-subtitle">
		Descripción
		</h2>
		<div class="text-description">
			<?php the_content();?>
		</div>
	</article>
	<?php if($requirements || $requirement_info!=''):?>
	<article class="offer-requirement">
		<h2 class="offer-subtitle">
		Requisitos mínimos
		</h2>
		<div class="text-description">
			<div class="text-info">
                 <?php echo $requirement_info;?>
			</div>
			<ul class="requirement-list">
			<?php if($requirements):?>
			<?php foreach($requirements as $requirement):?>
				<li class="requirement-item"><?php echo $requirement->text; ?></li>
				
			<?php endforeach; endif; ?>
			</ul>
		</div>
	</article>
	<?php endif; ?>
	<?php if($whitlists || $whitlist_info!=''):?>
	<article class="offer-whistlist">
		<h2 class="offer-subtitle">
		Requisitos deseables
		</h2>
		<div class="text-description">
		<div class="text-info">
		<?php echo $whitlist_info;?>
				</div>
		<ul class="requirement-list">

		<?php if($whitlists):?>
			<?php foreach($whitlists as $whitlist):?>
				<li class="requirement-item"><?php echo $whitlist->text; ?></li>
				
			<?php endforeach; endif; ?>
			</ul>
		</div>
	</article>
	<?php endif; ?>
	<?php if($languages  || $languages_info!=''):?>
	<article class="offer-additional">
		<h2 class="offer-subtitle">
		Idiomas
		</h2>
		<div class="text-description">
		<div class="text-info">
				<?php echo $languages_info;?>
				</div>
				<ul class="requirement-list">
				<?php if($languages):?>
			<?php foreach($languages as $language):?>
				<li class="requirement-item"><?php echo $language->text; ?></li>
				
			<?php endforeach; endif; ?>
			</ul>
		</div>
		<?php endif; ?>
		
	</article>
	<article class="offer-button">
		
		<button <?php echo $active_offer?'':'disabled'; ?> class=" <?php echo $active_offer?'':'disabled'; ?> activer-offert">Postúlate aquí</button>
	</article>
	</div>
	<div id="getFormulary" class="offer-submit">
<div class="postation-form">
	<div class="postulation-header">
	<h2 class="postation-title">
	Postúlate aquí
	</h2>
	<p class="postulation-text">
	Si tienes interés en enviarnos tu currículum, inscríbete aquí y nos llegará de inmediato
	</p>
	</div>
<div class="postulation-content">
<?php 
echo do_shortcode('[thinkus_registration offer_id="'.get_the_ID().'" ]');
?>
</div>

</div>
	</div>
	</div>
	
</section>

<section class="similars-offers">
	<div class="similar-content">

		<?php
		$term_list = [];
		if($skills){
			foreach ( $skills as $skill){
				array_push($term_list, $skill->slug);
			}
		}

$args = array(
    'post_type' => 'thinkus_employee',
    'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'thinkus_perfil',
			'field'    => 'slug',
			'terms'    => $term_list,
		),
	)
);
		$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<h2 class="offer-subtitle">
	Ofertas similares
		</h2>
		<div  id="offer-list">
		<div class="swiper-wrapper">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="swiper-slide">
				<?php echo thinkus_employee_get_template_part('templates/templates-parts/thinkus','item'); ?>
			</div>
				<?php endwhile; ?>

		</div>
		</div>

<?php wp_reset_postdata(); ?>

<?php endif; ?>
	</div>
</section>
<?php
	
	endwhile; //
	
?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();