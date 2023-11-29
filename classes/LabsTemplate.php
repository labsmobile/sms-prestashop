<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

class LabsTemplate extends \ObjectModel
{
    public $id_template;
    public $type;
    public $name;
    public $limit;
    public $active;
    public $template;

    public static $definition = array(
        'table'     => 'lm_templates',
        'primary'   => 'id_template',
        'multilang' => true,
        'fields'    => array(
            'type'       => array(
                'type'     => self::TYPE_STRING,
                'required' => false,
                'size'     => 20,
            ),
            'name'       => array(
                'type'     => self::TYPE_STRING,
                'required' => false,
                'size'     => 80,
            ),
            'limit'       => array(
                'type'     => self::TYPE_INT,
                'required' => false,
            ),
            'active'     => array(
                'type'     => self::TYPE_BOOL,
                'validate' => 'isBool',
                'required' => false,
            ),
            'template'    => array(
                'type'     => self::TYPE_STRING,
                'lang'     => true,
                'required' => false,
            ),
        ),
    );

    public static function getAllLm($type)
    {
        $dbQuery = new \DbQueryCore;
        $dbQuery->select('*');
        $dbQuery->from('lm_templates');
        $dbQuery->where("`type` = '" . pSQL($type) . "'");
        $result = \Db::getInstance(_PS_USE_SQL_SLAVE_)
            ->executeS($dbQuery);

        $smsList = array();
        foreach ($result as $template) {
            $tmp = new LabsTemplate((int) $template['id_template']);
            foreach ($tmp->template as $key_template => $item_template) {
                $tmp->template[$key_template] = utf8_decode($item_template);
            }
            $smsList[$template['name']] = $tmp;
        }

        return $smsList;
    }

    public static function getByNameLm($type, $name)
    {
        $dbQuery = new \DbQueryCore;
        $dbQuery->select('*');
        $dbQuery->from('lm_templates');
        $dbQuery->where("`name` = '" . pSQL($name) . "'");
        $dbQuery->where("`type` = '" . pSQL($type) . "'");

        $result = \Db::getInstance(_PS_USE_SQL_SLAVE_)
            ->getRow($dbQuery);
  
        $tmp = new LabsTemplate((int) $result['id_template']);
        foreach ($tmp->template as $key_template => $item_template) {
            $tmp->template[$key_template] = utf8_decode($item_template);
        }

        return $tmp;
    }
}
