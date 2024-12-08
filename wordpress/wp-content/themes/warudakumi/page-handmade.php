<?php
/*
Template Name: Handmade
*/
?>
<?php get_header(); ?>
<main class="main">
	<!-------- page-view ----->
	<section class="page-view" data-midnight="black">
		<div class="inner">
			<?php
			$array = array(
				'post_type' => 'page-top',
				'p' => 329,
			);
			$section_top_view = new WP_Query($array);
			?>
			<?php if ($section_top_view->have_posts()) : ?>
				<?php while ($section_top_view->have_posts()) : $section_top_view->the_post(); ?>
					<div class="ttl-box">
						<div class="works-img">
							<img class="topview-handmade" src="<?php the_field('image'); ?>" alt="Handmade">
						</div>
						<div class="works-text">
							<h2>Handmade</h2>
							<p class="p-first">
								<?php the_content(); ?>
							</p>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<p>投稿が見つかりません。</p>
			<?php endif;
			wp_reset_postdata(); ?>
		</div>
	</section>
	<!------- handmade ---------->
	<div class="primary">
		<div class="inner">
			<div class="ttl-handmade">
				<div class="in-img">
					<div class="img-use01"></div>
				</div>
				<div class="in-text">
					<h5>mini巻きタバコケース</h5>
					<p>
						巻きタバコの「葉を直接入れるタイプ」のミニ巻きタバコケースです。コンパクトな手の平サイズでポケットにも収まりやすく、携帯にとても便利です。<br>
						シャグポケット内はビニール素材を使用しており葉の乾燥を防ぐ他、革の色や匂い移りも防ぎます。ビニール部分は張り替え修理が可能なので、定期的に修理メンテナンスに出していただくことでより長くご愛用いただけます。<br>
						その他部分もほぼ修理可能です。劣化や故障の際はメールやDMにてご連絡いただきましたら、お見積もりをご案内いたします。
					</p>
				</div>
			</div>
			<div class="use-handmade">
				<i class="fas fa-infinity"></i>
				<h5>種類</h5>
				<p>Type</p>
			</div>
			<div class="shag-type">
				<div class="shag-type-box">
					<div class="in-img">
						<div class="mini-leather"></div>
					</div>
					<div class="in-text">
						<h5>ALL 革</h5>
						<p>
							外側内側ともに革を使用している「ALL革」タイプは、丈夫で長持ちします。オイルや蜜蝋でケアできる革は、ご自身でお手入れしていただく事で、より長く使用していただけます。<br>
							またコーティングによりケアが必要ない革など、仕入れに応じて様々な革を使用しています。<br>
							※シャグポケット内はビニール素材を使用しています。
						</p>
					</div>
				</div>
				<div class="shag-type-box">
					<div class="in-img">
						<div class="mini-cloth"></div>
					</div>
					<div class="in-text">
						<h5>布 × 革</h5>
						<p>
							本体外側には、丈夫でしっかりとした厚みのある８号帆布を使用しています。色展開が多い生地なので、豊富なカラーバリエーションの中からお好みのケースを選んでいただけます。<br>
							摩擦による色褪せが気になる場合はポケットを避け、カラビナでぶら下げるなどの持ち方をオススメします。<br>
							※シャグポケット内はビニール素材を使用しています。
						</p>
					</div>
				</div>
			</div>
			<div class="use-handmade">
				<i class="fas fa-hamsa"></i>
				<h5>使い方</h5>
				<p>How to use</p>
			</div>
			<div class="shag-flow">
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use01"></div>
					</div>
					<div class="in-text">
						<h5>１ shag</h5>
						<p>
							シャグポケットに巻きタバコの葉を直接入れます。湿度調整剤は葉の乾燥を防ぐだけでなくビニールの劣化も防ぐので、一緒に入れることをオススメします。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use02"></div>
					</div>
					<div class="in-text">
						<h5>２ filter</h5>
						<p>
							ファスナーポケットにフィルターを入れます。長めのフィルターを縦に並べてちょうど良く収まる深さのポケットです。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use03"></div>
					</div>
					<div class="in-text">
						<h5>３ paper</h5>
						<p>
							ペーパーポケットにペーパーをセットします。左からスライドして挿入できます。幅1+1/4サイズまで収納可能です。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use05"></div>
					</div>
					<div class="in-text">
						<h5>４ rolling</h5>
						<p>
							内側のレザー部分を受け皿にして巻きタバコを巻きます。ペーパーもフィルターもタバコの葉も、全て取り出しやすい位置に揃っているので巻きやすい！Let's enjoy Rolling!!
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use06"></div>
					</div>
					<div class="in-text">
						<h5>５ complete</h5>
						<p>
							巻きタバコの完成です！葉が多少こぼれても大きめの受け皿がしっかり受けてくれて安心！素早く安定して巻きタバコを巻くことができます。
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="secondary">
		<div class="inner">
			<div class="ttl-handmade">
				<div class="in-img">
					<div class="img-use11"></div>
				</div>
				<div class="in-text">
					<h5>regular巻きタバコケース</h5>
					<p>
						巻きタバコを「パッケージのまま」収納する巻きたばこケースです。ペーパーホルダーやフィルターポケットも付いているので、道具一式を携帯できます。<br>
						内側のベルトを持ち手にすると、ケースを持ったままタバコを巻くことができとても便利です。<br>
						ケース内側にあるフタボタンで、パッケージのフタ部分を貫通して留めることにより、パッケージをケースにピッタリ固定することができます。<br>
						修理も可能なので、劣化や故障の際はメールやDMにてご連絡いただけましたら、お見積もりをご案内いたします。
					</p>
				</div>
			</div>
			<div class="use-handmade">
				<i class="fas fa-infinity"></i>
				<h5>種類</h5>
				<p>Type</p>
			</div>
			<div class="shag-type">
				<div class="shag-type-box">
					<div class="in-img">
						<div class="regular-short"></div>
					</div>
					<div class="in-text">
						<h5>short<span>（二つ折り）</span></h5>
						<p>
							コンパクトな二つ折りのshortタイプは、巻きタバコのパッケージのフタがケースより長くても、フタを切ったり折り込んだりすることで、全ての銘柄のパッケージが収納可能になります。
						</p>
					</div>
				</div>
				<div class="shag-type-box">
					<div class="in-img">
						<div class="regular-long"></div>
					</div>
					<div class="in-text">
						<h5>long<span>（三つ折り）</span></h5>
						<p>
							三つ折りlongタイプは、巻きタバコのパッケージを開いた時の全長が21cm以上のものがフィットします。主にRAW / AMSTERDAMER / MANITOU / pepe などのフタが長い銘柄が収納可能です。<br>
							全長が21cmに満たないフタが短い銘柄（Bali Shag / PUEBLO など）は、フィットしないのでご注意ください。
						</p>
					</div>
				</div>
			</div>
			<div class="use-handmade">
				<i class="fas fa-hamsa"></i>
				<h5>使い方</h5>
				<p>How to use</p>
			</div>
			<div class="shag-flow">
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use07"></div>
					</div>
					<div class="in-text">
						<h5>１ shag</h5>
						<p>
							巻きタバコをパッケージのままポケットに入れます。フタが長い場合は切ったり折り込んだりして、上ポケットに収納します。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use08"></div>
					</div>
					<div class="in-text">
						<h5>２ button</h5>
						<p>
							フタボタンを上から押してパッケージのフタを貫通させ、しっかりと固定します。ビニールパッケージも簡単に貫通します。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use09"></div>
					</div>
					<div class="in-text">
						<h5>３ filter&amp;paper</h5>
						<p>
							ファスナーポケットにフィルターを収納します。ペーパーはペーパーホルダーに左からスライド挿入します。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use10"></div>
					</div>
					<div class="in-text">
						<h5>４ belt</h5>
						<p>
							内側ベルトを持ち手にして、ケースを持ったまま巻きタバコが巻けます。パッケージはフタボタンでしっかり固定されているので、フタが飛び出る心配もありません。
						</p>
					</div>
				</div>
				<div class="shag-flow-box">
					<div class="in-img">
						<div class="img-use11"></div>
					</div>
					<div class="in-text">
						<h5>５ rolling</h5>
						<p>
							立ったままでも机にケースを置かなくても巻きタバコを巻くことができ、とても便利です！Let's enjoy Rolling!!
						</p>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
