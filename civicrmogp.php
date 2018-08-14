<?php

require_once 'civicrmogp.civix.php';
use CRM_Civicrmogp_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function civicrmogp_civicrm_config(&$config) {
  _civicrmogp_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function civicrmogp_civicrm_xmlMenu(&$files) {
  _civicrmogp_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function civicrmogp_civicrm_install() {
  _civicrmogp_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function civicrmogp_civicrm_postInstall() {
  _civicrmogp_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function civicrmogp_civicrm_uninstall() {
  _civicrmogp_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function civicrmogp_civicrm_enable() {
  _civicrmogp_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function civicrmogp_civicrm_disable() {
  _civicrmogp_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function civicrmogp_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civicrmogp_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function civicrmogp_civicrm_managed(&$entities) {
  _civicrmogp_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civicrmogp_civicrm_caseTypes(&$caseTypes) {
  _civicrmogp_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function civicrmogp_civicrm_angularModules(&$angularModules) {
  _civicrmogp_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function civicrmogp_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civicrmogp_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function civicrmogp_civicrm_entityTypes(&$entityTypes) {
  _civicrmogp_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function civicrmogp_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contribute_Form_Contribution_Main') {
    $id = $form->get('id');

    $frontend = FALSE;
    $config = CRM_Core_Config::singleton();
    if ($config->userFramework == 'WordPress') {
      add_filter( 'jetpack_enable_open_graph', '__return_false' );
      $frontend = TRUE;
    }

    // adds: <meta property="og:description" content="[...]" />
    $ogpDescription = htmlentities(strip_tags($form->_values['intro_text']), ENT_QUOTES);
    CRM_Utils_System::addHTMLHead("<meta property='og:description' content='$ogpDescription'/>");

    // adds: <meta property="og:title" content="[...]" />
    $ogpTitle = htmlentities($form->_values['title'], ENT_QUOTES);
    CRM_Utils_System::addHTMLHead("<meta property='og:title' content='$ogpTitle'/>");

    // adds: <meta property="og:type" content="website" />
    CRM_Utils_System::addHTMLHead("<meta property='og:type' content='website'/>");

    // adds: <meta property="og:url" content="[...]" />
    $ogpURLQuery = array('reset' => 1, 'id' => $id);
    $ogpURL = CRM_Utils_System::url('civicrm/contribute/transact',$ogpURLQuery, TRUE, NULL, TRUE, $frontend, FALSE);
    CRM_Utils_System::addHTMLHead("<meta property='og:url' content='$ogpURL'/>");
  }
}

/**
 * Implements hook_civicrm_pageRun().
 *
 * @param CRM_Core_Page $page
 */
function civicrmogp_civicrm_pageRun(&$page) {
  if (get_class($page) == 'CRM_PCP_Page_PCPInfo') {
    $id = $page->get('id');

    $dao = new CRM_PCP_DAO_PCP();
    $dao->id = $id;

    if ($dao->find(TRUE)) {

      $frontend = FALSE;
      $config = CRM_Core_Config::singleton();
      if ($config->userFramework == 'WordPress') {
        add_filter( 'jetpack_enable_open_graph', '__return_false' );
        $frontend = TRUE;
      }

      // adds: <meta property="og:description" content="[...]" />
      $ogpDescription = htmlentities(strip_tags($dao->intro_text), ENT_QUOTES);
      CRM_Utils_System::addHTMLHead("<meta property='og:description' content='$ogpDescription'/>");

      // Add the image
      if ($file_id = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_EntityFile', $id , 'file_id', 'entity_id') ) {
        // Using UF function adds language prefix and htmlencodes parameters.. breaks Facebook
        $ogpImage = CRM_Utils_System::url('civicrm/file', "reset=1&id=$file_id&eid={$id}", TRUE, NULL, FALSE);

        // adds: <meta property="og:image" content="http://[...]" />
        CRM_Utils_System::addHTMLHead("<meta property='og:image' content='$ogpImage'/>");
      }

      // adds: <meta property="og:title" content="[...]" />
      $ogpTitle = htmlentities($dao->title, ENT_QUOTES);
      CRM_Utils_System::addHTMLHead("<meta property='og:title' content='$ogpTitle'/>");

      // adds: <meta property="og:type" content="website" />
      CRM_Utils_System::addHTMLHead("<meta property='og:type' content='website'/>");

      // adds: <meta property="og:url" content="[...]" />
      $ogpURLQuery = array('reset' => 1, 'id' => $id);
      $ogpURL = CRM_Utils_System::url('civicrm/pcp/info',$ogpURLQuery, TRUE, NULL, TRUE, TRUE, FALSE);
      CRM_Utils_System::addHTMLHead("<meta property='og:url' content='$ogpURL'/>");
    }
  }
}
