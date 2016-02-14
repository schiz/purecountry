<?
$PREV_DEPTH_LEVEL = $arResult[0]["DEPTH_LEVEL"];
foreach($arResult as $k => $arItem) {
	if($arItem["PERMISSION"] <= "D") {
		unset($arResult[$k]);
	} else {
		if($arItem["SELECTED"] == 1) { $arResult[$k]["CLASS"] = "selected"; }
		if($arItem["DEPTH_LEVEL"] > $PREV_DEPTH_LEVEL) {
			$arResult[$k]["SUBMENU"] = "OPEN";
			if(!empty($arResult[$prev_k]["CLASS"])) {
				$arResult[$prev_k]["CLASS"] .=" expand";
			} else {
				$arResult[$prev_k]["CLASS"] = "expand";
			}
		} else if($arItem["DEPTH_LEVEL"] < $PREV_DEPTH_LEVEL) {
			$arResult[$k]["SUBMENU"] = "CLOSE";
		}
		$PREV_DEPTH_LEVEL = $arItem["DEPTH_LEVEL"];
	}
	$prev_k = $k;
}
$arResult[0]["LAST_DEPTH_LEVEL"] = $arResult[count($arResult)-1]["DEPTH_LEVEL"] - $arResult[0]["DEPTH_LEVEL"];
?>