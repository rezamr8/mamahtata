$(function(){

	var rupiah = {
             aSep: '.', 
             aDec: ',', 
             aSign: 'Rp ',
             mDec:0

            };
    //var harga = $('#harga').val();
    $('#fdisc,#fbiayasetting,#ftotalproduk,#ftotbiayasetting,#fgrandtotal,#fuangmuka').autoNumeric('init', rupiah);
    $('#fdisc').bind('blur focusout keypress keyup', function () {
        var disc = $('#fdisc').autoNumeric('get');
        $('#disc').val(disc);
        
    });
    $('#fbiayasetting').bind('blur focusout keypress keyup', function () {
        var jasa = $('#fbiayasetting').autoNumeric('get');
        $('#biayasetting').val(jasa);
        
    });

})