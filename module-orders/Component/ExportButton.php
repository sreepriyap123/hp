<?php
declare(strict_types = 1);
/**
 *
 * Copyright © 2022 HP. All rights reserved.
 */
 
namespace HP\Orders\Component;

/**
 * Class ExportButton to remove XML format
 */
class ExportButton extends \Magento\Ui\Component\ExportButton
{
    /**
     * Remove XML format
     *
     * @return void
     */
    public function prepare()
    {
        $config = $this->getConfig();
        $options = $config['options'];
        if (!array_key_exists('xml', $options)) {
            parent::prepare();
            return;
        }
        unset($options['xml']);
        $config['options'] = $options;
        $this->setConfig($config);
        parent::prepare();
    }
}
