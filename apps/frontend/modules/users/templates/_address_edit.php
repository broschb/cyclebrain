<?php use_helper('Javascript') ?>
<?=$form["country_id"]->render(array(
	'onchange'	=> '$(this.form).request({
						parameters: {refresh: "Y" },
						onComplete: function (r) { $("address").update(r.responseText) }
					});'
)) ?>
<?=$form["state_id"]->render(array(
	'onchange'	=> '$(this.form).request({
						parameters: {refresh: "Y" },
						onComplete: function (r) { $("address").update(r.responseText) }
					});'
)) ?>
<?=$form["city_id"]->render()?>