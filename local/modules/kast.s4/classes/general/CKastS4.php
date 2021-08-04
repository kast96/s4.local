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

	public static function GetLikes($arOrder = array('ID' => 'ASC'), $arFilter = array(), $arSelect = array('*')) {
		if (!count($arOrder)) {
			$arOrder = array('ID' => 'ASC');
		}

		if (!count($arSelect)) {
			$arSelect = array('*');
		}

		if (!in_array('ID', $arSelect)) {
			$arSelect[] = 'ID';
		}

		if (!$hlblock_id = self::GetOption('likes_hl')) {
			return false;
		}

		$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entityClass = $entity->getDataClass();

		$rsLikes = $entityClass::getList(array(
			'select' => $arSelect,
			'order' => $arOrder,
			'filter' => $arFilter,
		));

		while($arLike = $rsLikes->fetch()) {
			$arResult[$arLike['ID']] = $arLike;
		}

		return $arResult;
	}
	
	public static function GetLikesGroup($arFilter = array()) {
		global $USER;
		$userId = $USER->GetId();

		$arLikes = self::GetLikes(array('ID' => 'ASC'), $arFilter, array('UF_LIKE', 'UF_USER'));
		$arResult['LIKE']['COUNT'] = $arResult['DISLIKE']['COUNT'] = 0;

		foreach ($arLikes as $arLike) {
			if ($arLike['UF_LIKE'] == 1) {
				$arResult['LIKE']['COUNT']++;
			} else {
				$arResult['DISLIKE']['COUNT']++;
			}

			if ($userId && $arLike['UF_USER'] == $userId) {
				$arResult['USER_LIKE'] = ($arLike['UF_LIKE'] == 1) ? true : false;
			}
		}

		return $arResult;
	}

	public static function UpdateLike($id, $arFields) {
		if (!$hlblock_id = self::GetOption('likes_hl')) {
			return false;
		}

		$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entityClass = $entity->getDataClass();

		$result = $entityClass::update($id, $arFields);

		return $result;
	}

	public static function AddLike($object, $entity, $user, $like) {
		if (!$hlblock_id = self::GetOption('likes_hl')) {
			return false;
		}

		$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
		$hlentity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entityClass = $hlentity->getDataClass();

		$arFields = array(
			"UF_OBJECT" => $object,
			"UF_ENTITY" => $entity,
			"UF_USER" => $user,
			"UF_LIKE" => $like,
		);

		$result = $entityClass::add($arFields);

		return $result;
	}

	public static function DeleteLike($id) {
		if (!$hlblock_id = self::GetOption('likes_hl')) {
			return false;
		}

		$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entityClass = $entity->getDataClass();

		$result = $entityClass::delete($id);

		return $result;
	}
}