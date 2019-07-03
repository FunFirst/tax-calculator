<?php

namespace FunFirst\TaxCalculator\TaxCounters;

interface TaxCounterInterface
{
    /**
     *  Sets starting price for Counter
     * 
     *  @param double $price;
     *  @return TaxCounterInterface;
     */
    public function setPrice($price);

    /**
     *  Set Tax Rate
     *
     *  @param double $taxRate (in range 0-1)
     */
    public function setTaxRate($taxRate);

    /**
     *  Set Tax Included (in future determinates if $this->price has tax included)
     *
     *  @param boolean $taxIncluded;
     */
    public function setTaxIncluded($taxIncluded);

    /**
     *  Set coupon percent discount
     *
     *  @param double|null $discount
     */
    public function setPercentDiscount($discount);

    /**
     *  Set quantity
     *
     *  @param double $quantity
     */
    public function setQuantity($quantity);

    /**
     *  Set decimals
     *
     *  @param integer $decimals;
     */
    public function setDecimals($decimals);

    /**
     *  Return default price
     *
     *  @return double
     */
    public function getPrice();

    /**
     *  Return tax rate
     *
     *  @return double
     */
    public function getTaxRate();

    /**
     *  Returns coupon percent discount
     *
     *  @param bool|false $inPercents
     *  @return double|null
     */
    public function getPercentDiscount($inPercents = false);

    /**
     *  Returns decimals
     *
     *  @return double|null
     */
    public function getDecimals();

    /**
     *  Returns taxIncluded
     * 
     *  @return boolean
     */
    public function getTaxIncluded();

    /**
     *  Returns quantity
     * 
     *  @return double
     */
    public function getQuantity();

    /** 
     *  Count BasePrice for Price
     * 
     *  @return double
     */
    public function countBasePrice();

    /** 
     *  Count BasePriceTax for Price
     * 
     *  @return double
     */
    public function countBasePriceTax();

    /**
     *  Count BasePriceIncTax for Price
     * 
     *  @return double;
     */
    public function countBasePriceIncTax();

    /**
     *  Count Unit amount for Price
     * 
     *  @return double;
     */
    public function countUnitAmount();

    /**
     *  Count UnitAmountDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountDiscount();

    /**
     *  Count UnitAmountDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountWithoutDiscount();

    /**
     *  Count UnitAmountTax
     * 
     *  @return double;
     */
    public function countUnitAmountTax();

    /**
     *  Count UnitAmountTaxDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountTaxDiscount();

    /**
     *  Count UnitAmountTaxWithoutDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountTaxWithoutDiscount();

    /**
     *  Count Unit amount including taxes for Price
     * 
     *  @return double;
     */
    public function countUnitAmountIncTax();

    /**
     *  Count UnitAmountIncTaxDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountIncTaxDiscount();

    /**
     *  Count UnitAmountTaxWithoutDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountIncTaxWithoutDiscount();

    /**
     *  Count Amount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmount();

    /**
     *  Count AmountDiscount
     * 
     *  @return double;
     */
    public function countAmountDiscount();

    /**
     *  Count AmountWithoutDiscount
     * 
     *  @return double;
     */
    public function countAmountWithoutDiscount();

    /**
     *  Count AmountTax
     * 
     *  @return double;
     */
    public function countAmountTax();

    /**
     *  Count AmountTaxDiscount
     * 
     *  @return double;
     */
    public function countAmountTaxDiscount();

    /**
     *  Count AmountTaxWithoutDiscount
     * 
     *  @return double;
     */
    public function countAmountTaxWithoutDiscount();

    /**
     *  Count AmountIncTax
     * 
     *  @return double;
     */
    public function countAmountIncTax();

    /**
     *  Count AmountIncTaxDiscount
     * 
     *  @return double;
     */
    public function countAmountIncTaxDiscount();

    /**
     *  Count AmountIncTaxWithoutDiscount
     * 
     *  @return double;
     */
    public function countAmountIncTaxWithoutDiscount();
}