<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

Class kast_s4 extends CModule
{
	var $MODULE_ID = "kast.s4";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

	function kast_s4()
	{
		$arModuleVersion = array();
		$path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path . "/version.php");
        
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
            $this->MODULE_NAME = Loc::getMessage("KAST_S4_NAME");
			$this->MODULE_DESCRIPTION = Loc::getMessage("KAST_S4_DESCRIPTION");
			$this->PARTNER_NAME = Loc::getMessage("KAST_S4_PARTNER_NAME");
            $this->PARTNER_URI = Loc::getMessage("KAST_S4_PARTNER_URI");
        } else {
            $this->MODULE_VERSION = 0;
            $this->MODULE_VERSION_DATE = 0;
            $this->MODULE_NAME = 0;
            $this->MODULE_DESCRIPTION = 0;
            $this->PARTNER_NAME = 0;
            $this->PARTNER_URI = 0;
        }
	}

	public function DoInstall() {
		global $APPLICATION;
		if (CheckVersion(ModuleManager::getVersion("main"), "14.00.00")) {
			$this->InstallFiles();
			ModuleManager::registerModule($this->MODULE_ID);
			$this->InstallDB();
			$this->InstallEvents();
		} else {
			$APPLICATION->ThrowException(Loc::getMessage("KAST_S4_INSTALL_ERROR_VERSION"));
		}
		$APPLICATION->IncludeAdminFile(Loc::getMessage("KAST_S4_INSTALL_TITLE")." \"".Loc::getMessage("KAST_S4_NAME")."\"", __DIR__."/step.php");
		
		return false;
	}
	
	public function InstallFiles() {
		return true;
	}
	
	public function InstallDB(){
		return true;
	}
	
	public function InstallEvents(){
		return true;
	}
	
	public function DoUninstall(){
		global $APPLICATION;
		$this->UnInstallFiles();
		$this->UnInstallDB();
		$this->UnInstallEvents();
		ModuleManager::unRegisterModule($this->MODULE_ID);
		$APPLICATION->IncludeAdminFile(Loc::getMessage("KAST_S4_UNINSTALL_TITLE")." \"".Loc::getMessage("KAST_S4_NAME")."\"", __DIR__."/unstep.php");
		
		return true;
	}
	
	public function UnInstallFiles(){
		return true;
	}
	
	public function UnInstallDB(){
        return true;
	}
	
	public function UnInstallEvents(){
		return true;
	}
}
?>