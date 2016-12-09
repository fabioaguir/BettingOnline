/**
 * Created by Fabio Aguiar on 11/07/2016.
 */
$(document).ready(function(){

    //Touchspin
    $("input.touchspin1").TouchSpin({
        min: 0,
        max: 99999999999999999999999999,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%'
    });
    $("input.touchspin2").TouchSpin({
        min: 0,
        max: 99999999999999999999999999,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '$'
    });
    $("input.touchspin3").TouchSpin({
        verticalbuttons: true
    });
    $("input.touchspin4").TouchSpin({
        verticalbuttons: true,
        verticalupclass: 'fa fa-fw fa-plus',
        verticaldownclass: 'fa fa-fw fa-minus'
    });

});