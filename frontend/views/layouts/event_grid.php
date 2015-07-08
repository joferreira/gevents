<!-- EVENT GRID -->
<?php // echo print_r($objEventos); 
$arrMes = array('01'=>'Jan','02'=>'Fev','03'=>'Mar','04'=>'Abr','05'=>'Mai','06'=>'Jun','07'=>'Jul','08'=>'Ago','09'=>'Set','10'=>'Out','11'=>'Nov','12'=>'Dez');
?>
<div class="row row-event row-event-grid">
	<? foreach ($objEventos as $key => $evento) { 
		$arrData = explode('-', $evento['DAT_DATA_INICIO']);
		$arrHora = explode(':', $evento['TIM_HORA_INICIO']);
	?>
	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month"><?= $arrMes[ $arrData[1] ]; ?></span>
					<span class="day"><?= $arrData[2]; ?></span>
				</div>
				<img src="img/preview/latest-1.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title"><?= $evento['STR_NOME']; ?></h3>
				<small><?= $evento['STR_ENDERECO'].', '.$evento['STR_NUMERO'].' - '.$evento['STR_BAIRRO'].' - '.$evento['STR_SIGLA_UNIDADE_FEDERAL'] ?></small>
				<br/>
				<small><?= $arrMes[$arrData[1]].' '.$arrData[2].', '.$arrData[0].' - '. $arrHora[0].':'.$arrHora[1];?></small><br/>
			</div>
		</div>
	</div>
	<? } ?>

	<!--div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-2.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-3.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-4.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-5.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-6.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-7.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-8.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-5.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-6.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-7.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 row-event-media">
		<div class="thumbnail no-border no-padding">
			<div class="media">
				<div class="date-block">
					<span class="month">Nov</span>
					<span class="day">29</span>
				</div>
				<img src="img/preview/latest-8.jpg" alt="">
				<div class="caption hovered">
					<div class="caption-wrapper div-table">
						<div class="caption-inner div-cell">
							<p class="caption-buttons"><a href="#" class="btn caption-link"><i class="fa fa-link"></i></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="caption">
				<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
				<small>103 Prince st. New York, NY 10012</small><br/>
				<small>Nov 29, 2014 - 08:00 am</small><br/>
			</div>
		</div>
	</div-->			

</div>

<!-- Pagination -->
<div class="pagination-wrapper">
	<ul class="pagination">
		<li class="disabled"><a href="#">«</a></li>
		<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">»</a></li>
	</ul>
</div>
<!-- /Pagination -->
<!-- /EVENT GRID -->