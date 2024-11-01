$(document).delegate('.VolnorezOnline_GenreID','change',function(){
	if($(this).val() != 'All')
	{
		$('.VolnorezOnline_CheckboxGenreList').removeAttr('checked');
		$('.VolnorezOnline_CheckboxGenreList').attr('disabled','disabled');
	}
	else
	{
		$('.VolnorezOnline_CheckboxGenreList').attr('checked','checked');
		$('.VolnorezOnline_CheckboxGenreList').removeAttr('disabled');
	}
});
