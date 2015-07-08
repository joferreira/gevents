<!-- CAROUSEL -->
<?php // echo print_r($objEventos); 
$arrMes = array('01'=>'Jan','02'=>'Fev','03'=>'Mar','04'=>'Abr','05'=>'Mai','06'=>'Jun','07'=>'Jul','08'=>'Ago','09'=>'Set','10'=>'Out','11'=>'Nov','12'=>'Dez');
?>
<!--  -->
<div class="row-event event-carousel">
	<div class="owl-carousel">
		<? foreach ($objEventosDestaques as $key => $evento) { 
			$arrData = explode('-', $evento['DAT_DATA_INICIO']);
			$arrHora = explode(':', $evento['TIM_HORA_INICIO']);
			?>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month"><?= $arrMes[$arrData[1]]; ?></span>
						<span class="day"><?= $arrData[2];?></span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

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
					<small><?= $arrMes[$arrData[1]].' '.$arrData[2].', '.$arrData[0].' - '. $arrHora[0].':'.$arrHora[1];?></small>
				</div>
			</div>
		</div>
		<? } ?>

		<!--div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Set</span>
						<span class="day">21</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Set 21, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Set</span>
						<span class="day">26</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Set 26, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Out</span>
						<span class="day">28</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Out 28, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Out</span>
						<span class="day">30</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Out 30, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Nov</span>
						<span class="day">23</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Nov 23, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Nov</span>
						<span class="day">25</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Nov 25, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Nov</span>
						<span class="day">27</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Nov 27, 2015 - 08:00 am</small>
				</div>
			</div>
		</div>
		<div class="row-event-media" >
			<div class="thumbnail no-border no-padding">
				<div class="media"style="height:170px">
					<div class="date-block">
						<span class="month">Nov</span>
						<span class="day">29</span>
					</div>
					<img src="hotevent/img/preview/img-slider-1.jpg" alt="">

					<div class="caption hovered">
						<div class="caption-wrapper div-table">
							<div class="caption-inner div-cell">
								<p class="caption-buttons"><a href="#" class="btn caption-link"><i
										class="fa fa-link"></i></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="caption">
					<h3 class="caption-title">Lorem ipsum dolor sit amet</h3>
					<small>103 Prince st. New York, NY 10012</small>
					<br/>
					<small>Nov 29, 2015 - 08:00 am</small>
				</div>
			</div>
		</div-->
		
	</div>
</div>
<!-- -->
<!-- /CAROUSEL -->
