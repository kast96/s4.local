<?
use Bitrix\Main\Loader;
Loader::includeModule('iblock');

class CKastS4Cache {
	public static function _prepareCacheParams($functionName, $arCache) {
		$arCache['TAG'] = ($arCache['TAG']) ?: '_all';
		$arCache['PATH'] = ($arCache['PATH']) ?: '/'.__CLASS__.'/'.$functionName.'/'.$arCache['TAG'].'/';
		$arCache['TIME'] = (intVal($arCache['TIME'])) ?: 36000000;
		return $arCache;
	}

	public static function CIBlock_GetList($arCache = array('ID' => '', 'PATH' => '', 'TIME' => 36000000, 'TAG' => ''), $arOrder = array('SORT' => 'ASC'), $arFilter = array(), $bIncCnt = false) {
		$arCache['ID'] = ($arCache['ID']) ?: __FUNCTION__.'_'.md5(serialize(array_merge((array)$arOrder, (array)$arFilter, (array)$bIncCnt)));
		$arCache = self::_prepareCacheParams(__FUNCTION__, $arCache);

		$cache = Bitrix\Main\Data\Cache::createInstance();
		if ($cache->initCache($arCache['TIME'], $arCache['ID'], $arCache['PATH'])) {
			$arResult = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			$arResult = array();
			$dbRes = CIBlock::GetList($arOrder, $arFilter, $bIncCnt);
			while($item = $dbRes->Fetch()){
				$arResult[$item['ID']] = $item;
			}
			$cache->endDataCache($arResult);
		}
		return $arResult;
	}

	public static function CIBlockElement_GetList($arCache = array('ID' => '', 'PATH' => '', 'TIME' => 36000000, 'TAG' => ''), $arOrder = array('SORT' => 'ASC'), $arFilter = array(), $arGroupBy = false, $arNavStartParams = false, $arSelectFields = array()) {
		$arCache['ID'] = ($arCache['ID']) ?: __FUNCTION__.'_'.md5(serialize(array_merge((array)$arOrder, (array)$arFilter, (array)$arGroupBy, (array)$arNavStartParams, (array)$arSelectFields)));
		$arCache = self::_prepareCacheParams(__FUNCTION__, $arCache);

		if (!in_array('ID', $arSelectFields)) $arSelectFields[] = 'ID';
		$cache = Bitrix\Main\Data\Cache::createInstance();
		if ($cache->initCache($arCache['TIME'], $arCache['ID'], $arCache['PATH'])) {
			$arResult = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			$arResult = array();
			$dbRes = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
			while($item = $dbRes->GetNext()){
				$arResult[$item['ID']] = $item;
			}
			$cache->endDataCache($arResult);
		}
		return $arResult;
	}

	public static function CIBlockSection_GetList($arCache = array('ID' => '', 'PATH' => '', 'TIME' => 36000000, 'TAG' => ''), $arOrder = array('SORT' => 'ASC'), $arFilter = array(), $bIncCnt = false, $arSelect = array(), $arNavStartParams = false) {
		$arCache['ID'] = ($arCache['ID']) ?: __FUNCTION__.'_'.md5(serialize(array_merge((array)$arOrder, (array)$arFilter, (array)$bIncCnt, (array)$arSelect, (array)$arNavStartParams)));
		$arCache = self::_prepareCacheParams(__FUNCTION__, $arCache);

		if (!in_array('ID', $arSelect)) $arSelect[] = 'ID';
		$cache = Bitrix\Main\Data\Cache::createInstance();
		if ($cache->initCache($arCache['TIME'], $arCache['ID'], $arCache['PATH'])) {
			$arResult = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			$arResult = array();
			$dbRes = CIBlockSection::GetList($arOrder, $arFilter, $bIncCnt, $arSelect, $arNavStartParams);
			while($item = $dbRes->GetNext()){
				$arResult[$item['ID']] = $item;
			}
			$cache->endDataCache($arResult);
		}
		return $arResult;
	}

	public static function CUserTypeEntity_GetList($arCache = array('ID' => '', 'PATH' => '', 'TIME' => 36000000, 'TAG' => ''), $arOrder = array('SORT' => 'ASC'), $arFilter = array()) {
		$arCache['ID'] = ($arCache['ID']) ?: __FUNCTION__.'_'.md5(serialize(array_merge((array)$arOrder, (array)$arFilter)));
		$arCache = self::_prepareCacheParams(__FUNCTION__, $arCache);

		if (!in_array('ID', $arSelect)) $arSelect[] = 'ID';
		$cache = Bitrix\Main\Data\Cache::createInstance();
		if ($cache->initCache($arCache['TIME'], $arCache['ID'], $arCache['PATH'])) {
			$arResult = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			$arResult = array();
			$dbRes = CUserTypeEntity::GetList($arOrder, $arFilter);
			while($item = $dbRes->GetNext()){
				$arResult[$item['ID']] = $item;
			}
			$cache->endDataCache($arResult);
		}
		return $arResult;
	}

	public static function CUser_GetList($arCache = array('ID' => '', 'PATH' => '', 'TIME' => 36000000, 'TAG' => ''), &$by = 'timestamp_x', &$order = "desc", $arFilter = array(), $arParams = array()) {
		$arCache['ID'] = ($arCache['ID']) ?: __FUNCTION__.'_'.md5(serialize(array_merge((array)$by, (array)$order, (array)$arFilter, (array)$arParams)));
		$arCache = self::_prepareCacheParams(__FUNCTION__, $arCache);

		if (!in_array('ID', $arSelect)) $arSelect[] = 'ID';
		$cache = Bitrix\Main\Data\Cache::createInstance();
		if ($cache->initCache($arCache['TIME'], $arCache['ID'], $arCache['PATH'])) {
			$arResult = $cache->getVars();
		} elseif ($cache->startDataCache()) {
			$arResult = array();
			$dbRes = CUser::GetList($by, $order, $arFilter, $arParams);
			while($item = $dbRes->GetNext()){
				$arResult[$item['ID']] = $item;
			}
			$cache->endDataCache($arResult);
		}
		return $arResult;
	}
}