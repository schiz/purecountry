<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!function_exists("showFilePropertyField"))
{
	function showFilePropertyField($name, $property_fields, $values, $max_file_size_show=50000)
	{
		$res = "";

		if (!is_array($values) || empty($values))
			$values = array(
				"n0" => 0,
			);

		if ($property_fields["MULTIPLE"] == "N")
		{
			$res = "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
		}
		else
		{
			$res = '
			<script type="text/javascript">
				function addControl(item)
				{
					var current_name = item.id.split("[")[0],
						current_id = item.id.split("[")[1].replace("[", "").replace("]", ""),
						next_id = parseInt(current_id) + 1;

					var newInput = document.createElement("input");
					newInput.type = "file";
					newInput.name = current_name + "[" + next_id + "]";
					newInput.id = current_name + "[" + next_id + "]";
					newInput.onchange = function() { addControl(this); };

					var br = document.createElement("br");
					var br2 = document.createElement("br");

					BX(item.id).parentNode.appendChild(br);
					BX(item.id).parentNode.appendChild(br2);
					BX(item.id).parentNode.appendChild(newInput);
				}
			</script>
			';

			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
			$res .= "<br/><br/>";
			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[1]\" id=\"".$name."[1]\" onChange=\"javascript:addControl(this);\"></label>";
		}

		return $res;
	}
}

if (!function_exists("PrintPropsForm"))
{
	function PrintPropsForm($arSource = array(), $locationTemplate = ".default")
	{
		if (!empty($arSource))
		{
			?>
				<div>
					<?
					foreach($arSource as $arProperties)
					{
						if ($arProperties["TYPE"] == "CHECKBOX")
						{
							?>
							<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">

							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r1x3 pt8"><input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>></div>

							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXT")
						{
                        ?>
							    <div class="bx_block r1x3 pt8">
								    <?=$arProperties["NAME"]?>
								    <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									    <span class="bx_sof_req">*</span>
								    <?endif;?>
							    </div>

							    <div class="bx_block r3x1">
                                <?if($arProperties["CODE"]=='ADDRESS'):?>
                                <div id="kladr-address" class="kladr-address">
                                    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">    
                                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                                    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
                                    <input onchange="$('#<?=$arProperties["FIELD_NAME"]?>').val($(this).val())" 
                                        type="text" 
                                        maxlength="250" 
                                        size="<?=$arProperties["SIZE1"]?>" 
                                        value="<?=$arProperties["VALUE"]?>" 
                                        name="street" 
                                        class="ui-autocomplete-input" 
                                        autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                        <input 
                                        type="hidden" 
                                        value="<?=$arProperties["VALUE"]?>" 
                                        name="<?=$arProperties["FIELD_NAME"]?>" 
                                        id="<?=$arProperties["FIELD_NAME"]?>" 
                                        class="ui-autocomplete-input" 
                                        autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                    <script src="/local/components/primepix/kladr.address/templates/.default/jquery.primepix.kladr.min.js"></script>
                                    <script src="/local/components/primepix/kladr.address/templates/.default/controller.js"></script>
                                    <script>KladrApiControllerInit('52fbfa8131608f99120000c0', '253895d380e1769726ac8fa1aff8406f05f8e116 ');</script>
                                </div>   
                            <?elseif($arProperties["CODE"]=='info_about_status_email'):?>
								<input type="email" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" >
                            <?elseif($arProperties["CODE"]=='info_about_status_callme_new_phone'):?>
								<input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" jq-pattern="^\(?([0-9]{3})\)?([ \s.-]?)([0-9]{3})\2([0-9]{4})$" >
								<script>/*
								//ng-model='phone_num' ng-pattern="phoneNumberPattern" 
									function phone_num($scope){
									$scope.phoneNumberPattern = (function() {
										var regexp = /^\(?(\d{3})\)?[ .-]?(\d{3})[ .-]?(\d{4})$/;
										return {
											test: function(value) {
												if( $scope.requireTel === false ) return true;
												else return regexp.test(value);
											}
										};
									})();
									} */
									function validatePhone(val, filter) {
										//var a = document.getElementById(txtPhone).value;
										//var filter = /^[0-9-+]+$/;
										//var filter = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
										if (filter.test(val)) {
											return true;
										}
										else {
											return false;
										}
									}
									$('#<?=$arProperties["FIELD_NAME"]?>').blur(function(e) {
										pattern = $(this).attr('jq-pattern');
										console.log(pattern);
										pattern = new RegExp(pattern, 'i');
									   if ( validatePhone($(this).val(), pattern) ) {
											$(this).css('borderColor', 'green');
									   }
									   else {
											$(this).css('borderColor', 'red');
									   }
									});
								</script>
                            <?else:?>
                                <input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>">
							<?endif?>
                                </div><div style="clear: both;"></div><br/>
                            <?
						}
						elseif ($arProperties["TYPE"] == "SELECT")
						{
							?>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
                                    <option></option>
									<?
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
									<?
									endforeach;
									?>
								</select>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
									<?
									endforeach;
									?>
								</select>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXTAREA")
						{
							$rows = ($arProperties["SIZE2"] > 10) ? 4 : $arProperties["SIZE2"];
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<textarea rows="<?=$rows?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "LOCATION")
						{
							$value = 0;
							if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
							{
								foreach ($arProperties["VARIANTS"] as $arVariant)
								{
									if ($arVariant["SELECTED"] == "Y")
									{
										$value = $arVariant["ID"];
										break;
									}
								}
							}
							?>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<?
								$GLOBALS["APPLICATION"]->IncludeComponent(
									"bitrix:sale.ajax.locations",
									$locationTemplate,
									array(
										"AJAX_CALL" => "N",
										"COUNTRY_INPUT_NAME" => "COUNTRY",
										"REGION_INPUT_NAME" => "REGION",
										"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
										"CITY_OUT_LOCATION" => "Y",
										"LOCATION_VALUE" => $value,
										"ORDER_PROPS_ID" => $arProperties["ID"],
										"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
										"SIZE1" => $arProperties["SIZE1"],
									),
									null,
									array('HIDE_ICONS' => 'Y')
								);
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "RADIO")
						{
							?>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<?
								if (is_array($arProperties["VARIANTS"]))
								{
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<input
											type="radio"
											name="<?=$arProperties["FIELD_NAME"]?>"
											id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
											value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

										<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
									<?
									endforeach;
								}
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "FILE")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>
							</div>

							<div style="clear: both;"></div><br/>
							<?
						}
					}
					?>
				</div>
			<?
		}
	}
}
?>