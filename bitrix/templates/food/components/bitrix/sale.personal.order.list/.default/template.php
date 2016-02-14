<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="profile col-md-6 col-md-offset-3 text-center">
	<h2>История заказов</h2>
<table class="table table-hover">
	<thead>
		<tr>
			<th>№</th>
			<th>Дата заказа</th>
			<th>Стоимость</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?foreach($arResult["ORDERS"] as $val):?>
		<tr>
			<td>
				<!-- <a title="<?=GetMessage("SPOL_T_DETAIL_DESCR")?>" href="<?=$val["ORDER"]["URL_TO_DETAIL"]?>"> -->
				<?=$val["ORDER"]["ACCOUNT_NUMBER"]?>
				<!-- </a> -->
			</td>
			<td><?=$val["ORDER"]["DATE_ORDER"]?></td>
			<td><?=$val["ORDER"]["FORMATED_PRICE"]?></td>
			<td class="delete">
<?if($val["ORDER"]["CAN_CANCEL"] == "Y"):?>
					<a title="<?=GetMessage("SPOL_T_DELETE_DESCR")?>" href="<?=$val["ORDER"]["URL_TO_CANCEL"]?>"><?=GetMessage("SPOL_T_DELETE")?></a>
				<?endif;?>				
			</td>
		</tr>
<?endforeach?>
	</tbody>
</table>
<?if(strlen($arResult["NAV_STRING"]) > 0):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
</div>
