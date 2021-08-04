<?
use Bitrix\Main\Localization\Loc;
use	Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Bitrix\Highloadblock as HL;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);
$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);
Loader::includeModule($module_id);

Loader::includeModule('iblock');
Loader::includeModule('highloadblock');

$KAST_S4_RIGHT = $APPLICATION->GetGroupRight("expansio.generator");
if($KAST_S4_RIGHT <= "D") $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$RIGHT_R = $KAST_S4_RIGHT >= 'R';
$RIGHT_W = $KAST_S4_RIGHT >= 'W';

if ($RIGHT_R || $RIGHT_W):
    IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
    IncludeModuleLangFile(__FILE__);

    $rsHLBlocks = HL\HighloadBlockTable::getList();
    while ($arHLBlock = $rsHLBlocks->fetch()) {
        $arHLBlocks[$arHLBlock['ID']] = '['.$arHLBlock['ID'].'] '.$arHLBlock['NAME'];
    }

    $rsIBlocks = IblockTable::getList();
    while ($arIBlock = $rsIBlocks->fetch()) {
        $arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
    }

    $aTabs = array(
        array(
            "DIV" => "kast_s4_settings",
            "TAB" => Loc::getMessage('KAST_S4_OPTIONS_TAB_SETTINGS_TITLE'),
            "ICON" => "main_settings",
            "TITLE" => Loc::getMessage('KAST_S4_OPTIONS_TAB_SETTINGS_TITLE_COMMON')
        ),
        array(
            "DIV" => "kast_s4_rights",
            "TAB" => Loc::getMessage('KAST_S4_OPTIONS_TAB_RIGHTS_TITLE'),
            "ICON" => "main_settings",
            "TITLE" => Loc::getMessage('KAST_S4_OPTIONS_TAB_RIGHTS_TITLE_COMMON')
        ),
    );

    $arSettingsOptions = array(
        array(
            'ID' => 'policy_link',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_POLICY_LINK'),
            'TYPE' => 'text',
        ),
        array(
            'ID' => 'likes_hl',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_LIKES_HL'),
            'TYPE' => 'selectbox',
            'VALUES' => $arHLBlocks,
        ),
        array(
            'ID' => 'comments_iblock',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_COMMENTS_IBLOCK'),
            'TYPE' => 'selectbox',
            'VALUES' => $arIBlocks,
        ),

        array(
            'ID' => 'text',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_TEXT'),
            'TYPE' => 'text',
        ),
        array(
            'ID' => 'checkbox',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_CHECKBOX'),
            'TYPE' => 'checkbox',
        ),
        array(
            'ID' => 'textarea',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_TEXTAREA'),
            'TYPE' => 'textarea',
            'ROWS' => 10,
            'COLS' => 10,
        ),
        array(
            'ID' => 'selectbox',
            'NAME' => Loc::getMessage('KAST_S4_OPTIONS_SELECTTBOX'),
            'TYPE' => 'selectbox',
            'VALUES' => array(
                0 => 'one',
                1 => 'two',
                2 => 'three',
            ),
        ),
    );

    $tabControl = new CAdminTabControl("tabControl", $aTabs);

    if ($REQUEST_METHOD == "POST" && strlen($Update.$Apply.$RestoreDefaults) > 0 && $RIGHT_W && check_bitrix_sessid())
    {
        if(strlen($RestoreDefaults) > 0)
        {
            COption::RemoveOption($module_id);
        }
        else
        {
            foreach($arSettingsOptions as $arOption)
            {
                $val = trim($_REQUEST[$arOption['ID']], " \t\n\r");
                if($arOption['TYPE']=="checkbox" && $val!="Y") {
                    $val="N";
                }
                COption::SetOptionString($module_id, $arOption['ID'], $val, $arOption['NAME']);
            }
        }

        ob_start();
        $Update = $Update.$Apply;
        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");
        ob_end_clean();

        if(strlen($_REQUEST["back_url_settings"]) > 0)
        {
            if((strlen($Apply) > 0) || (strlen($RestoreDefaults) > 0))
                LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
            else
                LocalRedirect($_REQUEST["back_url_settings"]);
        }
        else
        {
            LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&".$tabControl->ActiveTabParam());
        }
    }

    ?>
    <form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($module_id)?>&amp;lang=<?=LANGUAGE_ID?>">
    <?
    $tabControl->Begin();
    $tabControl->BeginNextTab();

        foreach($arSettingsOptions as $arOption):
            $val = COption::GetOptionString($module_id, $arOption['ID']);
            //$type = $arOption['TYPE'];
        ?>
        <tr>
            <td width="40%" nowrap <?=($arOption['TYPE']=="textarea") ? 'class="adm-detail-valign-top"' : ''?>>
                <label for="<?=htmlspecialcharsbx($arOption['ID'])?>"><?=$arOption['NAME']?>:</label>
            <td width="60%">
                <?
                    switch ($arOption['TYPE']) {
                        case 'checkbox':
                            ?><input type="checkbox" name="<?=htmlspecialcharsbx($arOption['ID'])?>" id="<?=htmlspecialcharsbx($arOption['ID'])?>" value="Y"<?=($val=="Y") ? ' checked' : ''?>><?
                            break;

                        case 'text':
                            ?><input type="text" maxlength="255" name="<?=htmlspecialcharsbx($arOption['ID'])?>" id="<?=htmlspecialcharsbx($arOption['ID'])?>" value="<?=htmlspecialcharsbx($val)?>"><?
                            break;

                        case 'textarea':
                            ?><textarea rows="<?=$arOption['ROWS']?>" cols="<?=$arOption['COLS']?>" name="<?=htmlspecialcharsbx($arOption["ID"])?>" id="<?=htmlspecialcharsbx($arOption['ID'])?>"><?=htmlspecialcharsbx($val)?></textarea><?
                            break;

                        case 'selectbox':
                            ?><select name="<?=htmlspecialcharsbx($arOption['ID'])?>">
                            <?foreach ($arOption['VALUES'] as $key => $value):?>
                                <option value="<?=$key?>"<?=($val==$key) ? ' selected' : ''?>><?=htmlspecialcharsbx($value)?></option>
                            <?endforeach?>
                            </select><?
                            break;
                        
                        default:
                            break;
                    }
                ?>

                <?/*if($type[0]=="checkbox"):?>
                    <input type="checkbox" name="<?=htmlspecialcharsbx($arOption[0])?>" id="<?=htmlspecialcharsbx($arOption[0])?>" value="Y"<?=($val=="Y") ? ' checked' : ''?>>
                <?elseif($type[0]=="text"):?>
                    <input type="text" size="<?=$type[1]?>" maxlength="255" value="<?=htmlspecialcharsbx($val)?>" name="<?=htmlspecialcharsbx($arOption[0])?>" id="<?=htmlspecialcharsbx($arOption[0])?>">
                <?elseif($type[0]=="textarea"):?>
                    <textarea rows="<?=$type[1]?>" cols="<?=$type[2]?>" name="<?=htmlspecialcharsbx($arOption[0])?>" id="<?=htmlspecialcharsbx($arOption[0])?>"><?=htmlspecialcharsbx($val)?></textarea>
                <?elseif($type[0]=="selectbox"):
                    ?><select name="<?=htmlspecialcharsbx($arOption[0])?>"><?
                    foreach ($type[1] as $key => $value)
                    {
                        ?><option value="<?=$key?>"<?if($val==$key)echo" selected"?>><?=htmlspecialcharsbx($value)?></option><?
                    }
                    ?></select><?
                elseif($type[0]=="phone"):
                    ?>
                        phone
                        <?var_dump($type[1][])?>
                    <?
                endif*/?>
            </td>
        </tr>
        <?endforeach?>
    <?$tabControl->BeginNextTab();?>
        <?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
    <?$tabControl->Buttons();?>
        <input <?=(!$RIGHT_W) ? 'disabled' : ''?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
        <input <?=(!$RIGHT_W) ? 'disabled' : ''?> type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
        <?if(strlen($_REQUEST["back_url_settings"])>0):?>
            <input <?=(!$RIGHT_W) ? 'disabled' : ''?> type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?=htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
            <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
        <?endif?>
        <input <?=(!$RIGHT_W) ? 'disabled' : ''?> type="submit" name="RestoreDefaults" title="<?=GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" onclick="return confirm('<?=AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?=GetMessage("MAIN_RESTORE_DEFAULTS")?>">
        <?=bitrix_sessid_post();?>
    <?$tabControl->End();?>
    </form>
<?endif;?>
