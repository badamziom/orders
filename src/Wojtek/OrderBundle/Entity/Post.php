<?php

namespace Wojtek\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Post {

    const TRANSFER_PAYMENT = 1;
    const PAYU_PAYMENT = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_login", type="string", length=255)
     */
    private $userLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255)
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\Column(name="payment_type", type="integer")
     */
    private $payment_type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_paid", type="boolean")
     */
    private $userPaid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_payment", type="date")
     */
    private $datePayment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_order", type="date")
     */
    private $dateOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer")
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="price_shipping", type="decimal", scale=2)
     */
    private $priceShipping;

    /**
     * @var string
     *
     * @ORM\Column(name="order_price", type="decimal", scale=2)
     */
    private $orderPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="tracking_number", type="integer")
     */
    private $trackingNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="other_data", type="text", nullable=true)
     */
    private $otherData;

    /**
     * @var string
     *
     * @ORM\Column(name="commission", type="decimal", scale=2)
     */
    private $commission;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set userLogin
     *
     * @param string $userLogin
     * @return Post
     */
    public function setUserLogin($userLogin) {
        $this->userLogin = $userLogin;

        return $this;
    }

    /**
     * Get userLogin
     *
     * @return string
     */
    public function getUserLogin() {
        return $this->userLogin;
    }

    /**
     * Set item
     *
     * @param string $item
     * @return Post
     */
    public function setItem($item) {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem() {
        return $this->item;
    }

    /**
     * Set userPaid
     *
     * @param boolean $userPaid
     * @return Post
     */
    public function setUserPaid($userPaid) {
        $this->userPaid = $userPaid;

        return $this;
    }

    /**
     * Get userPaid
     *
     * @return boolean
     */
    public function getUserPaid() {
        return $this->userPaid;
    }

    /**
     * Set datePayment
     *
     * @param \DateTime $datePayment
     * @return Post
     */
    public function setDatePayment($datePayment) {
        $this->datePayment = $datePayment;

        return $this;
    }

    /**
     * Get datePayment
     *
     * @return \DateTime
     */
    public function getDatePayment() {
        return $this->datePayment;
    }

    /**
     * Set dateOrder
     *
     * @param \DateTime $dateOrder
     * @return Post
     */
    public function setDateOrder($dateOrder) {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    /**
     * Get dateOrder
     *
     * @return \DateTime
     */
    public function getDateOrder() {
        return $this->dateOrder;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return Post
     */
    public function setOrderId($orderId) {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId() {
        return $this->orderId;
    }

    /**
     * Set priceShipping
     *
     * @param string $priceShipping
     * @return Post
     */
    public function setPriceShipping($priceShipping) {
        $this->priceShipping = $priceShipping;

        return $this;
    }

    /**
     * Get priceShipping
     *
     * @return string
     */
    public function getPriceShipping() {
        return $this->priceShipping;
    }

    /**
     * Set orderPrice
     *
     * @param string $orderPrice
     * @return Post
     */
    public function setOrderPrice($orderPrice) {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    /**
     * Get orderPrice
     *
     * @return string
     */
    public function getOrderPrice() {
        return $this->orderPrice;
    }

    /**
     * Set trackingNumber
     *
     * @param integer $trackingNumber
     * @return Post
     */
    public function setTrackingNumber($trackingNumber) {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * Get trackingNumber
     *
     * @return integer
     */
    public function getTrackingNumber() {
        return $this->trackingNumber;
    }

    /**
     * Set otherData
     *
     * @param string $otherData
     * @return Post
     */
    public function setOtherData($otherData) {
        $this->otherData = $otherData;

        return $this;
    }

    /**
     * Get otherData
     *
     * @return string
     */
    public function getOtherData() {
        return $this->otherData;
    }

    /**
     * Set commission
     *
     * @param string $commission
     * @return Post
     */
    public function setCommission($commission) {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return string
     */
    public function getCommission() {
        return $this->commission;
    }

    /**
     * Set payment_type
     *
     * @param integer $payment_type
     * @return Post
     */
    public function setPaymentType($payment_type) {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * Get payment_type
     *
     * @return integer
     */
    public function getPaymentType() {
        return $this->payment_type;
    }

}
