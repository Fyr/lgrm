<?
	$this->Html->css(array('/Table/css/grid', 'jquery.fancybox'), array('inline' => false));
	$this->Html->script(array('vendor/jquery/jquery.fancybox.pack'), array('inline' => false));
	
	$title = $this->ObjectType->getTitle('view', $objectType);
	echo $this->element('bread_crumbs', array('aBreadCrumbs' => array(
		__('Home') => '/',
		__('Products') => array('action' => 'index', 'objectType' => 'Product'),
		$article['Category']['title'] => SiteRouter::url(array('CategoryProduct' => $article['Category'])),
		$this->ObjectType->getTitle('view', $objectType) => ''
	)));
	echo $this->element('title', array('pageTitle' => __('Logotype %s', $article[$objectType]['title'])));
?>

<div class="block">
<?
	if (isset($aMedia['image'])) {
?>
	<div style="float: left; width: <?=ceil(count($aMedia['image']) / 3) * 110?>px; margin: 0 10px 10px 0;">
<?
		foreach($aMedia['image'] as $media) {
			$src = $this->Media->imageUrl($media, 'noresize');
			$thumb = $this->Media->imageUrl($media, '100x100');
?>
		<a class="pull-left" href="javascript:void(0)" rel="logo" onclick="onSelectLogo('<?=$src?>')">
			<img class="media-object thumb" src="<?=$thumb?>" alt="<?=__('View logotype %s in original size', $article[$objectType]['title'])?>" />
		</a>
<?
		}
?>
	</div>
	<div style="float: left; width: 40%; margin: 0 10px 10px 0;">
		<img id="sampleLogo" src="/img/sample-logo.png" alt="" style="width: 100%; border: 1px solid #ddd; margin-bottom: 10px;" />
	</div>
	
<?
	echo $this->Form->create('Params');
	echo $this->Form->input('size', array(
		'label' => array('text' => __('Adjust size')),
		'class' => 'input-small'
	));
	echo $this->Form->input('format', array(
		// 'class' => 'input-small', 
		'label' => array('text' => __('Select format')),
		'options' => array('GIF', 'PNG', 'JPG')
	));
?>
		<button type="button" class="btn"><i class="icon icon-arrow-down"></i> <?=__('Download logo')?></button>
		<button type="button" class="btn"><i class="icon icon-arrow-down"></i> <?=__('Download all as ZIP')?></button>
<?
	echo $this->Form->end();
?>

	<div class="clearfix"></div>
	<hr />
<?
	}
	if (isset($aMedia['bin_file'])) {
?>
<h3><?=__('Logo %s in vector', $article[$objectType]['title'])?></h3>
	<table align="left" width="100%" class="grid table-bordered shadow" border="0" cellpadding="0" cellspacing="0">
		<thead>
		<tr class="first table-gradient">
			<th>
				<a class="grid-unsortable" href="javascript:void(0)"><?=__('Preview')?></a>
			</th>
			<th>
				<a class="grid-unsortable" href="javascript:void(0)"><?=__('Format')?></a>
			</th>
			<th>
				<a class="grid-unsortable" href="javascript:void(0)"><?=__('File size')?></a>
			</th>
			<th>
				<a class="grid-unsortable" href="javascript:void(0)"><?=__('Uploaded')?></a>
			</th>
			<th>
				<a class="grid-unsortable" href="javascript:void(0)"><?=__('Downloaded, times')?></a>
			</th>
			<th>
				<a class="grid-unsortable" href="javascript:void(0)"><?=__('Link')?></a>
			</th>
		</tr>
		</thead>
		<tbody>
<?
		foreach($aMedia['bin_file'] as $media) {
			$format = strtoupper(str_replace('.', '', $media['Media']['ext']));
?>
		<tr class="grid-row">
			<td align="center">
<?
			list($fname) = explode('.', $media['Media']['orig_fname']);
			if (isset($aThumbs[$fname])) {
				$thumb = $aThumbs[$fname];
				
				$src = $this->Media->imageUrl($thumb, 'noresize');
				$thumb = $this->Media->imageUrl($thumb, '50x');
?>
				<a class="fancybox" href="<?=$src?>" rel="logo">
					<img src="<?=$thumb?>" alt="<?=__('View logotype %s in %s format', $article[$objectType]['title'], $format)?>" />
				</a>
<?
			}
?>
			</td>
			<td align="center"><?=$format?></td>
			<td align="right"><?=$this->PHMedia->MediaPath->filesizeFormat($media['Media']['orig_fsize'])?></td>
			<td align="center"><?=$this->PHTime->niceShort($media['Media']['created'])?></td>
			<td align="center"><?=($media['Media']['downloaded']) ? $media['Media']['downloaded'] : '-'?></td>
			<td align="center"><?=$this->Html->link(__('Download'), $media['Media']['url_download'])?></td>
		</tr>
<?
	}
?>
		</tbody>
	</table>
	<div class="clearfix"></div>
	<hr />
<?
	}
?>
	<?=$this->ArticleVars->body($article)?>
</div>
<script type="text/javascript">
function onSelectLogo(src) {
	$('#sampleLogo').attr('src', src);
}

$(document).ready(function(){
	$('.fancybox').fancybox({
		padding: 5
	});
});
</script>
