var url = document.location.toString();
if(url.match('#')){
	$('.ptabsbg1 a[href="#' + url.split("#")[1] + '"]').tab('show');
}
$('.ptabsbg1 a').on('shown.bs.tab', function (e) {
	window.location.hash = e.target.hash;
})