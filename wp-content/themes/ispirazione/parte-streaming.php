<?php
$time = time()-(21600); //La hora Unix - 6
$tituloRepro = get_field('titulo_reproductor');
$DescripSt = get_field('descripcion_stream');

$iframe = get_field ('url_streaming');
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];
$params = array('rel'=> 0, 'controls'=> 1,'hd' => 1,'autohide' => 1);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
?>

<?php if ( get_field('url_streaming') ): ?>
<div class="wrapdestreaming">
    <div class="head-transmicion">
        <div class="contTstream">
            <div class="Xclose"></div>
            <div class="tStreaming">
             <?php
             echo "Transmisión en directo - "; 
             echo $tituloRepro .' - ';
             echo ' <span id="clock"></span>';
             ?>
            </div>
        </div>
    </div>
    <div class="embed-container"  style="display:none;"><?php echo $iframe; ?></div>
    
    <div class="wrapDescripcionStreaming" style="display:none;">
      <div class="boxDescripSt">
        <div class="subTitlestreaming"><h1><?php echo $tituloRepro; ?></h1></div>
        <p><?php echo $DescripSt; ?></p>
        <a href="<?php echo $src; ?>" title="<?php echo $tituloRepro; ?>" target="_blank">Ver en youtube</a>
      </div>
    </div>
    
</div>
<?php endif; ?>