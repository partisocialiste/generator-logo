"use strict";$(function(){function t(){var t=$.extend({},{text:"Votre texte",textWidth:530,textSize:34,textColor:"rgba(229, 0, 64, 1)",textBg:"rgba(0, 0, 0, 0)",gravity:"s",opacity:1,margin:47,outputWidth:"auto",outputHeight:"auto",outputType:"png",done:function(t){e.html('<img id="imageDemo" class="img-responsive" src="'+t+'">'),i.html('<a class="btn btn-dll" href="'+t+'"><i class="glyphicon glyphicon-floppy-disk"></i> Télécharger votre logo</a>')},fail:function(){e.html('<span style="color: red;">Une erreur s\'est produite. Vérifier le champs ci-contre.</span>')}},o);$("<img>",{src:"images/logo-ps-eco.png"}).watermark(t)}var e=$("#withWatermark"),i=$("#linkDownload"),o={};$("#watermarkConfig").on("submit",function(e){e.preventDefault(),o={},$.each($(this).serializeArray(),function(t,e){var i=e.value;/^(textWidth|textSize|opacity|margin|outputWidth|outputHeight)$/.test(e.name)&&"auto"!==i&&(i=parseFloat(i)),o[e.name]=i}),t()}).on("reset",function(){}),t()});