<?
	if ($this->Paginator->numbers()) {
?>
<div class="pagination">
	Страницы: <?=$this->SitePaginator->numbers()?>
</div>
<?
	}
?>