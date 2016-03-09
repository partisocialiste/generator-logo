/* global $ */
/*jslint node: true */
'use strict';

//http://baivong.github.io/watermark/
$(function () {
			var //$path = $('#path'),
				//$text = $('#text'),
				//$textConfig = $('#textConfig'),
				//$imageDemo = $('#imageDemo'),
				$withWatermark = $('#withWatermark'),
				$withWatermarkLink = $('#linkDownload'),
				obj = {};
				// $text.on('input', function () {
				//     if ($.trim($text.val()) !== '') {
				//         $path.prop('disabled', true);
				//         $textConfig.slideDown();
				//     } else {
				//         $path.prop('disabled', false);
				//         $textConfig.slideUp();
				//     }
				// });
		function watermarkCreate() {
			var config = $.extend({}, {
				//path: 'images/logo-ps-eco.png',

				text: 'Votre texte',
				textWidth: 530,
				textSize: 34,
				textColor: 'rgba(229, 0, 64, 1)',
				textBg: 'rgba(0, 0, 0, 0)',

				gravity: 's', // nw | n | ne | w | e | sw | s | se
				opacity: 1,
				margin: 47,

				outputWidth: 'auto',
				outputHeight: 'auto',
				outputType: 'png', // jpeg | png | webm

				done: function (imgURL) {
					$withWatermark.html('<img id="imageDemo" class="img-responsive" src="' + imgURL + '">');
					$withWatermarkLink.html('<a class="btn btn-dll" href="' + imgURL + '"><i class="glyphicon glyphicon-floppy-disk "></i> Télécharger votre logo</a>');
				},
				fail: function () {
					//$withWatermark.html('<span style="color: red;">Une erreur s\'est produite : ' + imgURL + '</span>');
					$withWatermark.html('<span style="color: red;">Une erreur s\'est produite. Vérifier le champs ci-contre.</span>');
				}
			}, obj);
			$('<img>', {
				src: 'images/logo-ps-eco.png'
			}).watermark(config);
		}

		$('#watermarkConfig').on('submit', function (e) {
			e.preventDefault();
			obj = {};
			$.each($(this).serializeArray(), function (i, v) {
					var val = v.value;
					if (/^(textWidth|textSize|opacity|margin|outputWidth|outputHeight)$/.test(v.name) && val !== 'auto') {
						val = parseFloat(val);
					}
					obj[v.name] = val;
			});
			watermarkCreate();
		}).on('reset', function () {
		//$path.prop('disabled', false);
		//$textConfig.slideUp();
		});
		watermarkCreate();
});
