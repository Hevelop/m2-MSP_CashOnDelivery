<?php
/**
 * IDEALIAGroup srl
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@idealiagroup.com so we can send you a copy immediately.
 *
 * @category   MSP
 * @package    MSP_CashOnDelivery
 * @copyright  Copyright (c) 2016 IDEALIAGroup srl (http://www.idealiagroup.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace MSP\CashOnDelivery\Model\Total\Invoice;

use Magento\Sales\Model\Order\Invoice;

class CashondeliveryTax extends AbstractTotal
{
    public function collect(Invoice $invoice)
    {
        $order = $invoice->getOrder();

        if ($order->getMspCodTaxAmount() > 0) {
            $invoice->setMspCodTaxAmount($order->getMspCodTaxAmount());
            $invoice->setBaseMspCodTaxAmount($order->getBaseMspCodTaxAmount());

            if (!$invoice->isLast()) {
                $invoice->setTaxAmount($invoice->getTaxAmount() + $invoice->getMspCodTaxAmount());
                $invoice->setBaseTaxAmount($invoice->getBaseTaxAmount() + $invoice->getBaseMspCodTaxAmount());
            }
        }

        return $this;
    }
}
