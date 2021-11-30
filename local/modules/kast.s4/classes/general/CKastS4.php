<?
if(!defined('KAST_S4_MODULE_ID')){
	define('KAST_S4_MODULE_ID', 'kast.s4');
}

use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

Loader::includeModule('iblock');
Loader::includeModule('highloadblock');

class CKastS4 {
    const partnerName = "kast";
    const solutionName = "s4";
	const moduleID = KAST_S4_MODULE_ID;
    const wizardID = "kast:s4";
    const devMode = false;

	public static function GetOption($option){
		return COption::GetOptionString(self::moduleID, $option);
	}

    public static function GetChilds($arItems, &$start = 0, $level = 0){
		$childs = array();

		if(!$level){
			$lastDepthLevel = 1;
			if(is_array($arItems)){
				foreach($arItems as $i => $arItem){
					if($arItem["DEPTH_LEVEL"] > $lastDepthLevel){
						if($i > 0){
							$arItems[$i - 1]["IS_PARENT"] = 1;
						}
					}
					$lastDepthLevel = $arItem["DEPTH_LEVEL"];
				}
			}
		}

		for($i = $start, $count = count($arItems); $i < $count; ++$i){
			$item = $arItems[$i];
			if($level > $item['DEPTH_LEVEL'] - 1){
				break;
			}
			elseif(!empty($item['IS_PARENT'])){
				++$i;
				$item['CHILD'] = self::getChilds($arItems, $i, $level + 1);
				--$i;
			}
			$childs[] = $item;
		}

		$start = $i;

		return $childs;
	}

	public function GetPhonesArray() {
		$phones = unserialize(self::GetOption('phones'));
		foreach ($phones as &$phone) {
			$phone = self::GetPhoneArray($phone);
		}
		unset($phone);

		return $phones;
	}

	public function GetPhoneArray($phone) {
		return array(
			'PHONE' => $phone,
			'TEL' => preg_replace('/[^0-9]/', '', $phone),
		);
	}

	public function GetEmail() {
		return self::GetOption('email');
	}

	public function GetAddress() {
		return self::GetOption('address');
	}
}