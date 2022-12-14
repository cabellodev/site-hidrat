<?php

namespace Transbank\TransaccionCompleta\Responses;

use Transbank\Utils\Utils;

class MallTransactionCommitResponse
{
    public $buyOrder;
    public $cardDetail;
    public $accountingDate;
    public $transactionDate;
    public $details;

    public function __construct($json)
    {
        $buyOrder = Utils::returnValueIfExists($json, 'buy_order');
        $this->setBuyOrder($buyOrder);
        $cardDetail = Utils::returnValueIfExists($json, 'card_detail');
        $this->setCardDetail($cardDetail);
        $accountingDate = Utils::returnValueIfExists($json, 'accounting_date');
        $this->setAccountingDate($accountingDate);
        $details = Utils::returnValueIfExists($json, 'details');
        $this->setDetails($details);
    }

    /**
     * @return mixed
     */
    public function getBuyOrder()
    {
        return $this->buyOrder;
    }

    /**
     * @param mixed $buyOrder
     */
    public function setBuyOrder($buyOrder)
    {
        $this->buyOrder = $buyOrder;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardDetail()
    {
        return $this->cardDetail;
    }

    /**
     * @param mixed $cardDetail
     */
    public function setCardDetail($cardDetail)
    {
        $this->cardDetail = $cardDetail;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountingDate()
    {
        return $this->accountingDate;
    }

    /**
     * @param mixed $accountingDate
     */
    public function setAccountingDate($accountingDate)
    {
        $this->accountingDate = $accountingDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * @param mixed $transactionDate
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }
}
