<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?/*
<form class="mob-form-element" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get">
	<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" />
	<?endforeach?>
	<div class="mob-form-content mob-form-content_complex js-custom-scroll">
		<div class="mob-form-container">
			<ul class="filter-list">
			<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
				{
					$key = $arItem["ENCODED_ID"];
					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;
						?>
						<li class="filter-list-item<?=($arItem["DISPLAY_EXPANDED"]=="Y") ? ' filter-list-item_active' : ''?> JS-Accordion bx-filter-parameters-box bx-active" data-accordion="{'classActive': 'filter-list-item_active'}">
							<span class="bx-filter-container-modef"></span>
							<div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)"><span><?=$arItem["NAME"]?> <i data-role="prop_angle" class="fa fa-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>"></i></span></div>
							<div class="bx-filter-block" data-role="bx_filter_block">
								<div class="row bx-filter-parameters-box-container">
									<div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
										<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
										<div class="bx-filter-input-container">
											<input
												class="min-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>
									<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
										<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
										<div class="bx-filter-input-container">
											<input
												class="max-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>

									<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
										<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
											<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
												<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
												<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?
						$arJsParams = array(
							"leftSlider" => 'left_slider_'.$key,
							"rightSlider" => 'right_slider_'.$key,
							"tracker" => "drag_tracker_".$key,
							"trackerWrap" => "drag_track_".$key,
							"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
							"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
							"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
							"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
							"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
							"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
							"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
							"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
							"precision" => $precision,
							"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
							"colorAvailableActive" => 'colorAvailableActive_'.$key,
							"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
						);
						?>
						<script type="text/javascript">
							BX.ready(function(){
								window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
							});
						</script>
					<?endif;
				}

				//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if(
						empty($arItem["VALUES"])
						|| isset($arItem["PRICE"])
					)
						continue;

					if (
						$arItem["DISPLAY_TYPE"] == "A"
						&& (
							$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
						)
					)
						continue;
					?>
					<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> bx-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
						<span class="bx-filter-container-modef"></span>
						<div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
							<span class="bx-filter-parameters-box-hint"><?=$arItem["NAME"]?>
								<?if ($arItem["FILTER_HINT"] <> ""):?>
									<i id="item_title_hint_<?echo $arItem["ID"]?>" class="fa fa-question-circle"></i>
									<script type="text/javascript">
										new top.BX.CHint({
											parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
											show_timeout: 10,
											hide_timeout: 200,
											dx: 2,
											preventHide: true,
											min_width: 250,
											hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
										});
									</script>
								<?endif?>
								<i data-role="prop_angle" class="fa fa-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>"></i>
							</span>
						</div>

						<div class="bx-filter-block" data-role="bx_filter_block">
							<div class="row bx-filter-parameters-box-container">
							<?
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"])
							{
								case "A"://NUMBERS_WITH_SLIDER
									?>
									<div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
										<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
										<div class="bx-filter-input-container">
											<input
												class="min-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>
									<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
										<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
										<div class="bx-filter-input-container">
											<input
												class="max-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
											/>
										</div>
									</div>

									<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
										<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
											<?
											$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
											$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
											$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
											$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
											$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
											$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
											$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
											?>
											<div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
											<div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
											<div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
											<div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
											<div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

											<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
												<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
												<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
											</div>
										</div>
									</div>
									<?
									$arJsParams = array(
										"leftSlider" => 'left_slider_'.$key,
										"rightSlider" => 'right_slider_'.$key,
										"tracker" => "drag_tracker_".$key,
										"trackerWrap" => "drag_track_".$key,
										"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
										"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
										"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
										"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
										"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
										"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
										"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
										"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
										"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
										"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
										"colorAvailableActive" => 'colorAvailableActive_'.$key,
										"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
									);
									?>
									<script type="text/javascript">
										BX.ready(function(){
											window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
										});
									</script>
									<?
									break;
								case "B"://NUMBERS
									?>
									<div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
										<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
										<div class="bx-filter-input-container">
											<input
												class="min-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
												/>
										</div>
									</div>
									<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
										<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
										<div class="bx-filter-input-container">
											<input
												class="max-price"
												type="text"
												name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
												id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
												value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
												size="5"
												onkeyup="smartFilter.keyup(this)"
												/>
										</div>
									</div>
									<?
									break;
								case "G"://CHECKBOXES_WITH_PICTURES
									?>
									<div class="col-xs-12">
										<div class="bx-filter-param-btn-inline">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="checkbox"
												name="<?=$ar["CONTROL_NAME"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE"]?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
											<?
											$class = "";
											if ($ar["CHECKED"])
												$class.= " bx-active";
											if ($ar["DISABLED"])
												$class.= " disabled";
											?>
											<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
													<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
												</span>
											</label>
										<?endforeach?>
										</div>
									</div>
									<?
									break;
								case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
									?>
									<div class="col-xs-12">
										<div class="bx-filter-param-btn-block">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="checkbox"
												name="<?=$ar["CONTROL_NAME"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE"]?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
											<?
											$class = "";
											if ($ar["CHECKED"])
												$class.= " bx-active";
											if ($ar["DISABLED"])
												$class.= " disabled";
											?>
											<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
												</span>
												<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
												if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
													?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
												endif;?></span>
											</label>
										<?endforeach?>
										</div>
									</div>
									<?
									break;
								case "P"://DROPDOWN
									$checkedItemExist = false;
									?>
									<div class="col-xs-12">
										<div class="bx-filter-select-container">
											<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
												<div class="bx-filter-select-text" data-role="currentOption">
													<?
													foreach ($arItem["VALUES"] as $val => $ar)
													{
														if ($ar["CHECKED"])
														{
															echo $ar["VALUE"];
															$checkedItemExist = true;
														}
													}
													if (!$checkedItemExist)
													{
														echo GetMessage("CT_BCSF_FILTER_ALL");
													}
													?>
												</div>
												<div class="bx-filter-select-arrow"></div>
												<input
													style="display: none"
													type="radio"
													name="<?=$arCur["CONTROL_NAME_ALT"]?>"
													id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
													value=""
												/>
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="radio"
														name="<?=$ar["CONTROL_NAME_ALT"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<? echo $ar["HTML_VALUE_ALT"] ?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
												<?endforeach?>
												<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
													<ul>
														<li>
															<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
															</label>
														</li>
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
														</li>
													<?endforeach?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<?
									break;
								case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
									?>
									<div class="col-xs-12">
										<div class="bx-filter-select-container">
											<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
												<div class="bx-filter-select-text fix" data-role="currentOption">
													<?
													$checkedItemExist = false;
													foreach ($arItem["VALUES"] as $val => $ar):
														if ($ar["CHECKED"])
														{
														?>
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
															<span class="bx-filter-param-text">
																<?=$ar["VALUE"]?>
															</span>
														<?
															$checkedItemExist = true;
														}
													endforeach;
													if (!$checkedItemExist)
													{
														?><span class="bx-filter-btn-color-icon all"></span> <?
														echo GetMessage("CT_BCSF_FILTER_ALL");
													}
													?>
												</div>
												<div class="bx-filter-select-arrow"></div>
												<input
													style="display: none"
													type="radio"
													name="<?=$arCur["CONTROL_NAME_ALT"]?>"
													id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
													value=""
												/>
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="radio"
														name="<?=$ar["CONTROL_NAME_ALT"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE_ALT"]?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
												<?endforeach?>
												<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
													<ul>
														<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
															<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<span class="bx-filter-btn-color-icon all"></span>
																<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
															</label>
														</li>
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="bx-filter-param-text">
																	<?=$ar["VALUE"]?>
																</span>
															</label>
														</li>
													<?endforeach?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<?
									break;
								case "K"://RADIO_BUTTONS
									?>
									<div class="col-xs-12">
										<div class="radio">
											<label class="bx-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
												<span class="bx-filter-input-checkbox">
													<input
														type="radio"
														value=""
														name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														onclick="smartFilter.click(this)"
													/>
													<span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
											</label>
										</div>
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<div class="radio">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
														<input
															type="radio"
															value="<? echo $ar["HTML_VALUE_ALT"] ?>"
															name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
															?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
														endif;?></span>
													</span>
												</label>
											</div>
										<?endforeach;?>
									</div>
									<?
									break;
								case "U"://CALENDAR
									?>
									<div class="col-xs-12">
										<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
												'bitrix:main.calendar',
												'',
												array(
													'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
													'SHOW_INPUT' => 'Y',
													'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
													'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
													'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
													'SHOW_TIME' => 'N',
													'HIDE_TIMEBAR' => 'Y',
												),
												null,
												array('HIDE_ICONS' => 'Y')
											);?>
										</div></div>
										<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
												'bitrix:main.calendar',
												'',
												array(
													'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
													'SHOW_INPUT' => 'Y',
													'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
													'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
													'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
													'SHOW_TIME' => 'N',
													'HIDE_TIMEBAR' => 'Y',
												),
												null,
												array('HIDE_ICONS' => 'Y')
											);?>
										</div></div>
									</div>
									<?
									break;
								default://CHECKBOXES
									?>
									<div class="col-xs-12">
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<div class="checkbox">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox">
														<input
															type="checkbox"
															value="<? echo $ar["HTML_VALUE"] ?>"
															name="<? echo $ar["CONTROL_NAME"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
															?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
														endif;?></span>
													</span>
												</label>
											</div>
										<?endforeach;?>
									</div>
							<?
							}
							?>
							</div>
							<div style="clear: both"></div>
						</div>
					</div>
				<?
				}
				?>
			</ul>
		</div>
	</div>
	<div class="mob-form-footer mob-form-container">
		<div class="bx-filter-popup-result" id="modef" style="<?=(!isset($arResult["ELEMENT_COUNT"])) ? 'display:none;' : 'display: inline-block;'?>">
			<?=GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'))?>
			<span class="arrow"></span>
			<a href="<?=$arResult["FILTER_URL"]?>" target="">
				<?=GetMessage("CT_BCSF_FILTER_SHOW")?>
			</a>
		</div>
		<input
								class="btn btn-themes"
								type="submit"
								id="set_filter"
								name="set_filter"
								value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
							/>
							<input
								class="btn btn-link"
								type="submit"
								id="del_filter"
								name="del_filter"
								value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
							/>
	</div>
</form>

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>

<?return*/?>

<form class="mob-form-element" name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get">
	<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>" />
	<?endforeach?>
	<div class="mob-form-content mob-form-content_complex js-custom-scroll">
		<div class="mob-form-container">
			<ul class="filter-list">
				<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
				{
					$key = $arItem["ENCODED_ID"];
					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;
						?>
						<li class="bx-filter-parameters-box filter-list-item<?=($arItem["DISPLAY_EXPANDED"]=="Y") ? ' filter-list-item_active' : ''?> JS-Accordion" data-accordion="{'classActive': 'filter-list-item_active'}">
							<span class="bx-filter-container-modef"></span>
							<a class="filter-link JS-Accordion-Switcher" href="javascript:;">
								<span class="filter-name"><?=$arItem["NAME"]?></span>
								<span class="filter-switcher JS-Accordion-Switcher">
									<svg class="filter-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px" height="7px"
										viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
										<path
											d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
												L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
									</svg>
								</span>
							</a>
							<div class="filter-block JS-Accordion-Menu">
								<div class="slider-range js-slider-range" data-code="price">
									<div class="slider-range-panel">
										<input id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" type="text" class="slider-range-input input js-slider-range-min min-price" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" data-value="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" onkeyup="smartFilter.keyup(this)" />
										<span class="slider-range-label"><?=GetMessage("CT_BCSF_FILTER_TO")?></span>
										<input id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" type="text" class="slider-range-input input js-slider-range-max max-price" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-value="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" onkeyup="smartFilter.keyup(this)" />
									</div>
									<div class="slider-range-track js-slider-range-track"></div>
								</div>
							</div>
						</li>
					<?endif;
				}

				//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if(empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
						continue;

					if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
						continue;
					?>

					<li class="bx-filter-parameters-box filter-list-item<?=($arItem["DISPLAY_EXPANDED"]=="Y") ? ' filter-list-item_active' : ''?> JS-Accordion" data-accordion="{'classActive': 'filter-list-item_active'}">     
						<span class="bx-filter-container-modef"></span>
						<a class="filter-link JS-Accordion-Switcher" href="javascript:;">
							<span class="filter-name"><?=$arItem["NAME"]?></span>
							<span class="filter-switcher JS-Accordion-Switcher">
								<svg class="filter-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
									xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px" height="7px"
									viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;" xml:space="preserve">
									<path
										d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
											L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
								</svg>
							</span>
						</a>
						<div class="filter-block JS-Accordion-Menu">
							<?
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"])
							{
								case "A"://NUMBERS_WITH_SLIDER
									?>
									<div class="slider-range js-slider-range" data-code="property">
										<div class="slider-range-panel">
											<input id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" type="text" class="slider-range-input input js-slider-range-min min-price" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" data-value="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" onkeyup="smartFilter.keyup(this)" />
											<span class="slider-range-label"><?=GetMessage("CT_BCSF_FILTER_TO")?></span>
											<input id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" type="text" class="slider-range-input input js-slider-range-max max-price" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-value="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" onkeyup="smartFilter.keyup(this)" />
										</div>
										<div class="slider-range-track js-slider-range-track"></div>
									</div>
									<?
									break;
								
								case "B"://NUMBERS
									?>
									<div class="slider-range">
										<div class="slider-range-panel">
											<input id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" type="text" class="slider-range-input input js-slider-range-min min-price" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" data-value="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" onkeyup="smartFilter.keyup(this)" />
											<span class="slider-range-label"><?=GetMessage("CT_BCSF_FILTER_TO")?></span>
											<input id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" type="text" class="slider-range-input input js-slider-range-max max-price" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-value="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" onkeyup="smartFilter.keyup(this)" />
										</div>
									</div>
									<?
									break;

								case "G"://CHECKBOXES_WITH_PICTURES
									?>
									<div class="JS-ShowMore" data-showmore="{
										'classActive': 'show_active',
										'classSwitcherActive': 'show-switcher_active',
										'amount': 10,
										'classHide': 'filter-form-list-item_hide',
										'elementItem': '.filter-form-list-item'
									}">
										<ul class="filter-form-list filter-form-list-pictures">
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<li class="filter-form-list-item js-find-container JS-ShowMore-Item">
													<label class="filter-field checkbox-field<?=($ar["DISABLED"]) ? ' disabled' : ''?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar['CONTROL_ID'])?>'));">
														<span class="filter-checkbox checkbox">
															<input class="filter-checkbox-input checkbox-input" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" id="<?=$ar["CONTROL_ID"]?>" value="<?=$ar["HTML_VALUE"]?>"<?=($ar["CHECKED"]) ? ' checked="checked"' : ''?> <?=($ar["DISABLED"]) ? ' disabled' : ''?> />
															<span class="filter-color">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<img class="filter-color-img" src="<?=$ar["FILE"]["SRC"]?>" alt="" />
																<?endif?>
															</span>
														</span>
													</label>
												</li>
											<?endforeach?>
										</ul>

										<a class="show-switcher JS-ShowMore-Switcher" href="javascript:;">
											<span class="show-more show-more_show">
												<span class="filter-show-more show-more-label switcher">Показать все</span>
												<svg class="show-more-icon" version="1.1"
													xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
													x="0px" y="0px" width="7px" height="7px" viewBox="0 0 7 7"
													style="enable-background:new 0 0 7 7;" xml:space="preserve">
													<path
														d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
															L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
												</svg>
											</span>
											<span class="show-more show-more_hide">
												<span class="filter-show-more show-more-label switcher">Свернуть</span>
												<svg class="show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
													xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px"
													height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;"
													xml:space="preserve">
													<path
														d="M6.8,5L6.4,5.4c0,0-0.1,0.1-0.2,0.1c-0.1,0-0.1,0-0.2-0.1L3.5,2.8L0.9,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1
															L0.2,5c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l3.1-3.1c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2S6.8,5,6.8,5z" />
												</svg>
											</span>
										</a>
									</div>
									<?
									break;

								case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
									?>
									<div class="JS-ShowMore" data-showmore="{
										'classActive': 'show_active',
										'classSwitcherActive': 'show-switcher_active',
										'amount': 10,
										'classHide': 'filter-form-list-item_hide',
										'elementItem': '.filter-form-list-item'
									}">
										<ul class="filter-form-list">
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<li class="filter-form-list-item js-find-container JS-ShowMore-Item">
													<label class="filter-field checkbox-field<?=($ar["DISABLED"]) ? ' disabled' : ''?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar['CONTROL_ID'])?>'));">
														<span class="filter-checkbox checkbox">
															<input class="filter-checkbox-input checkbox-input" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" id="<?=$ar["CONTROL_ID"]?>" value="<?=$ar["HTML_VALUE"]?>"<?=($ar["CHECKED"]) ? ' checked="checked"' : ''?><?=($ar["DISABLED"]) ? ' disabled' : ''?> />
															<span class="filter-color">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<img class="filter-color-img" src="<?=$ar["FILE"]["SRC"]?>" alt="" />
																<?endif?>
															</span>
															<span class="filter-label checkbox-label js-find-value">
																<?=$ar["VALUE"]?>
																<?if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?>
																	<sup class="filter-amount" data-role="count_<?=$ar["CONTROL_ID"]?>"><?=$ar["ELEMENT_COUNT"]?></sup>
																<?endif?>
															</span>
														</span>
													</label>
												</li>
											<?endforeach?>
										</ul>
	
										<a class="show-switcher JS-ShowMore-Switcher" href="javascript:;">
											<span class="show-more show-more_show">
												<span class="filter-show-more show-more-label switcher">Показать все</span>
												<svg class="show-more-icon" version="1.1"
													xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
													x="0px" y="0px" width="7px" height="7px" viewBox="0 0 7 7"
													style="enable-background:new 0 0 7 7;" xml:space="preserve">
													<path
														d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
															L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
												</svg>
											</span>
											<span class="show-more show-more_hide">
												<span class="filter-show-more show-more-label switcher">Свернуть</span>
												<svg class="show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
													xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px"
													height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;"
													xml:space="preserve">
													<path
														d="M6.8,5L6.4,5.4c0,0-0.1,0.1-0.2,0.1c-0.1,0-0.1,0-0.2-0.1L3.5,2.8L0.9,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1
															L0.2,5c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l3.1-3.1c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2S6.8,5,6.8,5z" />
												</svg>
											</span>
										</a>
									</div>
									<?
									break;

								case "P"://DROPDOWN
								case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
									$checkedItemExist = false;
									foreach ($arItem["VALUES"] as $val => $ar) {
										if ($ar["CHECKED"])
											$checkedItemExist = true;
									}
									?>

									<select name="<?=$arCur["CONTROL_NAME_ALT"]?>" class="select js-select" onchange="smartFilter.keyup(this)">
										<option value="<?="all_".$arCur["HTML_VALUE_ALT"]?>"><?=GetMessage("CT_BCSF_FILTER_ALL")?></option>
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<option value="<?=$ar["HTML_VALUE_ALT"]?>"<?=($ar["CHECKED"]) ? ' selected="selected"' : ''?><?=($ar["DISABLED"]) ? ' disabled' : ''?>><?=$ar["VALUE"]?></option>
										<?endforeach?>
									</select>
									<?
									break;

								case "K"://RADIO_BUTTONS
									?>
									<ul class="filter-form-list">
										<li class="filter-form-list-item js-find-container JS-ShowMore-Item">
											<label class="filter-field radio-field">
												<span class="filter-checkbox radio">
													<input class="filter-checkbox-input radio-input" type="radio" value="" name="<?=$arCur["CONTROL_NAME_ALT"]?>" id="<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.click(this)" />
													<i class="radio-check" aria-hidden="true"></i>
													<span class="filter-label radio-label js-find-value">
														<?=GetMessage("CT_BCSF_FILTER_ALL")?>
														<?if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?>
															<sup class="filter-amount"><?=$ar["ELEMENT_COUNT"]?></sup>
														<?endif?>
													</span>
												</span>
											</label>
										</li>
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<li class="filter-form-list-item js-find-container JS-ShowMore-Item">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter-field radio-field">
													<span class="filter-checkbox radio<?=($ar["DISABLED"]) ? ' disabled' : ''?>">
														<input class="filter-checkbox-input radio-input" type="radio" value="<?=$ar["HTML_VALUE_ALT"]?>" name="<?=$ar["CONTROL_NAME_ALT"]?>" id="<?=$ar["CONTROL_ID"]?>"<?=($ar["CHECKED"]) ? ' checked="checked"' : ''?> onclick="smartFilter.click(this)" />
														<i class="radio-check"></i>
														<span class="filter-label radio-label js-find-value">
															<?=$ar["VALUE"]?>
															<?if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?>
																<sup class="filter-amount" data-role="count_<?=$ar["CONTROL_ID"]?>"><?=$ar["ELEMENT_COUNT"]?></sup>
															<?endif?>
														</span>
														<a href="javascript:;" class="price-tooltip tooltip js-tooltip" rel="nofollow" data-tooltip-class="tooltip-popup">
															<i class="tooltip-icon las la-question-circle"></i>
															<span class="tooltip-info js-tooltip-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.</span>
														</a>
													</span>
												</label>
											</li>
										<?endforeach?>
									</ul>
									<a class="show-switcher JS-ShowMore-Switcher" href="javascript:;">
										<span class="show-more show-more_show">
											<span class="filter-show-more show-more-label switcher">Показать
												все</span><svg class="show-more-icon" version="1.1"
												xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
												x="0px" y="0px" width="7px" height="7px" viewBox="0 0 7 7"
												style="enable-background:new 0 0 7 7;" xml:space="preserve">
												<path
													d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
														L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
											</svg>
										</span>
										<span class="show-more show-more_hide">
											<span class="filter-show-more show-more-label switcher">Свернуть</span><svg
												class="show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
												xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px"
												height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;"
												xml:space="preserve">
												<path
													d="M6.8,5L6.4,5.4c0,0-0.1,0.1-0.2,0.1c-0.1,0-0.1,0-0.2-0.1L3.5,2.8L0.9,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1
														L0.2,5c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l3.1-3.1c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2S6.8,5,6.8,5z" />
											</svg>
										</span>
									</a>
									<?
									break;
								
								case "U"//CALENDAR
									?>
									<div class="filter-parameters-box-container-block">
										<div class="filter-input-container filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
													'bitrix:main.calendar',
													'',
													array(
														'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
														'SHOW_INPUT' => 'Y',
														'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
														'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
														'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
														'SHOW_TIME' => 'N',
														'HIDE_TIMEBAR' => 'Y',
													),
													null,
													array('HIDE_ICONS' => 'Y')
												);?>
										</div>
									</div>
									<div class="filter-parameters-box-container-block">
										<div class="filter-input-container filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
													'bitrix:main.calendar',
													'',
													array(
														'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
														'SHOW_INPUT' => 'Y',
														'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
														'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
														'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
														'SHOW_TIME' => 'N',
														'HIDE_TIMEBAR' => 'Y',
													),
													null,
													array('HIDE_ICONS' => 'Y')
												);?>
										</div>
									</div>
									<?
									break;

								default://CHECKBOXES
									?>
									<ul class="filter-form-list">
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<li class="filter-form-list-item js-find-container JS-ShowMore-Item">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter-field checkbox-field<?=($ar["DISABLED"]) ? ' disabled' : ''?>">
													<span class="filter-checkbox checkbox" <?=($ar["DISABLED"]) ? 'disabled' : ''?>>
														<input class="filter-checkbox-input checkbox-input" type="checkbox" name="<?=$ar["CONTROL_NAME"]?>" id="<?=$ar["CONTROL_ID"]?>" value="<?=$ar["HTML_VALUE"]?>"<?=($ar["CHECKED"]) ? ' checked="checked"' : ''?><?=($ar["DISABLED"]) ? ' disabled' : ''?> onclick="smartFilter.click(this)" />
														<i class="checkbox-check fa fa-check" aria-hidden="true"></i>
														<span class="filter-label checkbox-label js-find-value">
															<?=$ar["VALUE"]?>
															<?if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?>
																<sup class="filter-amount" data-role="count_<?=$ar["CONTROL_ID"]?>"><?=$ar["ELEMENT_COUNT"]?></sup>
															<?endif?>
														</span>
														<a href="javascript:;" class="price-tooltip tooltip js-tooltip" rel="nofollow" data-tooltip-class="tooltip-popup">
															<i class="tooltip-icon las la-question-circle"></i>
															<span class="tooltip-info js-tooltip-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.</span>
														</a>
													</span>
												</label>
											</li>
										<?endforeach?>
									</ul>
									<a class="show-switcher JS-ShowMore-Switcher" href="javascript:;">
										<span class="show-more show-more_show">
											<span class="filter-show-more show-more-label switcher">Показать
												все</span><svg class="show-more-icon" version="1.1"
												xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
												x="0px" y="0px" width="7px" height="7px" viewBox="0 0 7 7"
												style="enable-background:new 0 0 7 7;" xml:space="preserve">
												<path
													d="M0.2,2l0.3-0.3c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1,0,0.2,0.1l2.6,2.6l2.6-2.6c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1
														L6.8,2c0,0,0.1,0.1,0.1,0.2s0,0.1-0.1,0.2L3.7,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1L0.2,2.3c0,0-0.1-0.1-0.1-0.2S0.2,2,0.2,2z" />
											</svg>
										</span>
										<span class="show-more show-more_hide">
											<span class="filter-show-more show-more-label switcher">Свернуть</span><svg
												class="show-more-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
												xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7px"
												height="7px" viewBox="0 0 7 7" style="enable-background:new 0 0 7 7;"
												xml:space="preserve">
												<path
													d="M6.8,5L6.4,5.4c0,0-0.1,0.1-0.2,0.1c-0.1,0-0.1,0-0.2-0.1L3.5,2.8L0.9,5.4c0,0-0.1,0.1-0.2,0.1s-0.1,0-0.2-0.1
														L0.2,5c0,0-0.1-0.1-0.1-0.2s0-0.1,0.1-0.2l3.1-3.1c0,0,0.1-0.1,0.2-0.1s0.1,0,0.2,0.1l3.1,3.1c0,0,0.1,0.1,0.1,0.2S6.8,5,6.8,5z" />
											</svg>
										</span>
									</a>
									<?
									break;
							}
							?>
						</div>
					</li>
				<?
				}
				?>
			</ul>
		</div>
	</div>
	<div class="mob-form-footer mob-form-container">
		<div class="bx-filter-popup-result" id="modef" style="<?=(!isset($arResult["ELEMENT_COUNT"])) ? 'display:none;' : 'display: inline-block;'?>">
			<?=GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'))?>
			<span class="arrow"></span>
			<a href="<?=$arResult["FILTER_URL"]?>" target="">
				<?=GetMessage("CT_BCSF_FILTER_SHOW")?>
			</a>
		</div>
		<button class="comment-form-button button button_dark" type="submit" id="set_filter" name="set_filter"><?=GetMessage("CT_BCSF_SET_FILTER")?></button>
		<button class="comment-form-button button button_simple" type="reset" id="del_filter" name="del_filter"><?=GetMessage("CT_BCSF_DEL_FILTER")?></button>
	</div>
</form>

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?=CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>