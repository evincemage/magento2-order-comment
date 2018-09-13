<?php
/**
 * @copyright Copyright (c) 2018 www.evincemage.com
 */
namespace Evincemage\OrderComment\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Quote\Setup\QuoteSetupFactory;

class InstallData implements InstallDataInterface
{

    /**
     * @var SalesSetupFactory
     */
    protected $_salesSetupFactory;

    /**
     * @var QuoteSetupFactory
     */
    protected $_quoteSetupFactory;

    /**
     * InstallData constructor.
     * @param SalesSetupFactory $salesSetupFactory
     * @param QuoteSetupFactory $quoteSetupFactory
     */
    public function __construct(
    SalesSetupFactory $salesSetupFactory, QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->_salesSetupFactory = $salesSetupFactory;
        $this->_quoteSetupFactory = $quoteSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();

        /** @var \Magento\Quote\Setup\QuoteSetup $quoteInstaller */
        $quoteInstaller = $this->_quoteSetupFactory->create(['resourceName' => 'quote_setup',
            'setup' => $setup]);

        /** @var \Magento\Sales\Setup\SalesSetup $salesInstaller */
        $salesInstaller = $this->_salesSetupFactory->create(['resourceName' => 'sales_setup',
            'setup' => $setup]);

        $quoteInstaller->addAttribute(
                'quote', 'em_order_comment', [
            'type' => Table::TYPE_TEXT,
            'length' => '64k', 'nullable' => true
                ]
        );

        $salesInstaller->addAttribute(
                'order', 'em_order_comment', [
            'type' => Table::TYPE_TEXT,
            'length' => '64k', 'nullable' => true,
            'grid' => true
                ]
        );

        $setup->endSetup();
    }

}
