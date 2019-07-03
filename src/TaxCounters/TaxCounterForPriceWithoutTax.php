<?php

namespace FunFirst\TaxCalculator\TaxCounters;

use FunFirst\TaxCalculator\TaxCounters\TaxCounter;
use FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;

class TaxCounterForPriceWithoutTax extends TaxCounter implements TaxCounterInterface
{
    public function __construct($price = 0)
    {
        $this->setPrice($price);
        $this->setTaxIncluded();
    }

    /**
     *  As tax counter is used only for prices with tax, tax included is always set to true
     *
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     */
    public function setTaxIncluded($taxIncluded = false)
    {
        $this->taxIncluded = false;
        return $this;
    }

    /** 
     *  Count BasePrice for Price without Taxes
     * 
     *  @return double
     */
    public function countBasePrice()
    {
        $basePrice = $this->getPrice();
        $basePrice = $this->roundAmount($basePrice);
        return $basePrice;
    }

    /** 
     *  Count BasePriceTax for Price without Taxes
     * 
     *  @return double
     */
    public function countBasePriceTax()
    {
        $basePrice = $this->countBasePrice();
        $basePriceIncTax = $this->countBasePriceIncTax();

        $basePriceTax = $basePriceIncTax - $basePrice;
        $basePriceTax = $this->roundAmount($basePriceTax);
        return $basePriceTax;
    }

    /**
     *  Count BasePriceIncTax for Price without Tax
     * 
     *  @return double;
     */
    public function countBasePriceIncTax()
    {
        $basePrice = $this->getPrice();

        $basePriceIncTax = $basePrice * (1 + $this->getTaxRate());
        $basePriceIncTax = $this->roundAmount($basePriceIncTax);
        return $basePriceIncTax;
    }

    /**
     *  Count Unit amount for Price without Tax
     * 
     *  @return double;
     */
    public function countUnitAmount()
    {
        $basePrice = $this->countBasePrice();

        if ($this->percentDiscount !== null) {
            $unitAmount = $basePrice * (1 - $this->percentDiscount);
            $unitAmount = $this->roundAmount($unitAmount);
        } else {
            $unitAmount = $basePrice;
        }
        return $unitAmount;
    }

    /**
     *  Count UnitAmountDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountWithoutDiscount()
    {
        $basePrice = $this->countBasePrice();

        $unitAmountWithoutDiscount = $basePrice;
        return $unitAmountWithoutDiscount;
    }

    /**
     *  Count UnitAmountWithoutDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountDiscount()
    {
        $basePrice = $this->countBasePrice();
        $unitAmount = $this->countUnitAmount();

        $unitAmountDiscount = $basePrice - $unitAmount;
        return $unitAmountDiscount;
    }

    /**
     *  Count Unit amount tax for Price without Tax
     * 
     *  @return double;
     */
    public function countUnitAmountTax()
    {
        $unitAmount = $this->countUnitAmount();
        $unitAmountIncTax = $this->countUnitAmountIncTax();

        $unitAmountTax = $unitAmountIncTax - $unitAmount;
        return $unitAmountTax;
    }

    /**
     *  Count UnitAmountTaxDiscount for Price with Tax
     * 
     *  @return double;
     */
    public function countUnitAmountTaxDiscount()
    {
        $unitAmountTax = $this->countUnitAmountTax();
        $basePriceTax = $this->countBasePriceTax();
       
        $unitAmountTaxDiscount = $basePriceTax - $unitAmountTax;
        return $unitAmountTaxDiscount;
    }

    /**
     *  Count UnitAmountTaxWithoutDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountTaxWithoutDiscount()
    {
        $basePriceTax = $this->countBasePriceTax();
       
        $unitAmountTaxWithoutDiscount = $basePriceTax;
        return $unitAmountTaxWithoutDiscount;
    }

    /**
     *  Count Unit amount including taxes for Price without Tax
     * 
     *  @return double;
     */
    public function countUnitAmountIncTax()
    {
        $unitAmount = $this->countUnitAmount();
        
        if ($this->percentDiscount !== null) {
            $unitAmountIncTax = $unitAmount * (1 + $this->getTaxRate());
            $unitAmountIncTax = $this->roundAmount($unitAmountIncTax);
        } else {
            $basePriceIncTax = $this->countBasePriceIncTax();
            $unitAmountIncTax = $basePriceIncTax;
        }
        return $unitAmountIncTax;
    }

    /**
     *  Count UnitAmountIncTaxDiscount for Price with Tax
     * 
     *  @return double;
     */
    public function countUnitAmountIncTaxDiscount()
    {
        $unitAmountIncTax = $this->countUnitAmountIncTax();
        $basePriceIncTax = $this->countBasePriceIncTax();
       
        $unitAmountIncTaxDiscount = $basePriceIncTax - $unitAmountIncTax;
        return $unitAmountIncTaxDiscount;
    }

    /**
     *  Count UnitAmountIncTaxWithoutDiscount
     * 
     *  @return double;
     */
    public function countUnitAmountIncTaxWithoutDiscount()
    {
        $basePriceIncTax = $this->countBasePriceIncTax();
       
        $unitAmountIncTaxWithoutDiscount = $basePriceIncTax;
        return $unitAmountIncTaxWithoutDiscount;
    }

    /**
     *  Count Amount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmount()
    {
        $unitAmount = $this->countUnitAmount();

        $amount = $unitAmount * $this->quantity;
        $amount = $this->roundAmount($amount);
        return $amount;
    }

    /**
     *  Count AmountDiscount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountDiscount()
    {
        $unitAmountDiscount = $this->countUnitAmountDiscount();

        $amountDiscount = $unitAmountDiscount * $this->quantity;
        $amountDiscount = $this->roundAmount($amountDiscount);
        return $amountDiscount;
    }

    /**
     *  Count AmountWithoutDiscount for Price without Tax
     * 
     *  @return double;
     */
    public function countAmountWithoutDiscount()
    {
        $unitAmountWithoutDiscount = $this->countUnitAmountWithoutDiscount();

        $amountWithoutDiscount = $unitAmountWithoutDiscount * $this->quantity;
        $amountWithoutDiscount = $this->roundAmount($amountWithoutDiscount);
        return $amountWithoutDiscount;
    }

    /**
     *  Count Amount Tax for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountTax()
    {
        $unitAmountTax = $this->countUnitAmountTax();

        $amountTax = $unitAmountTax * $this->quantity;
        $amountTax = $this->roundAmount($amountTax);
        return $amountTax;
    }

    /**
     *  Count AmountTaxDiscount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountTaxDiscount()
    {
        $unitAmountTaxDiscount = $this->countUnitAmountTaxDiscount();

        $amountTaxDiscount = $unitAmountTaxDiscount * $this->quantity;
        $amountTaxDiscount = $this->roundAmount($amountTaxDiscount);
        return $amountTaxDiscount;
    }

    /**
     *  Count AmountTaxWithoutDiscount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountTaxWithoutDiscount()
    {
        $unitAmountTaxWithoutDiscount = $this->countUnitAmountTaxWithoutDiscount();

        $amountTaxWithoutDiscount = $unitAmountTaxWithoutDiscount * $this->quantity;
        $amountTaxWithoutDiscount = $this->roundAmount($amountTaxWithoutDiscount);
        return $amountTaxWithoutDiscount;
    }

    /**
     *  Count Amount Inc Tax for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountIncTax()
    {
        $unitAmountIncTax = $this->countUnitAmountIncTax();

        $amountIncTax = $unitAmountIncTax * $this->quantity;
        $amountIncTax = $this->roundAmount($amountIncTax);
        return $amountIncTax;
    }

    /**
     *  Count AmountIncTaxDiscount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountIncTaxDiscount()
    {
        $unitAmountIncTaxDiscount = $this->countUnitAmountIncTaxDiscount();

        $amountIncTaxDiscount = $unitAmountIncTaxDiscount * $this->quantity;
        $amountIncTaxDiscount = $this->roundAmount($amountIncTaxDiscount);
        return $amountIncTaxDiscount;
    }

    /**
     *  Count AmountIncTaxWithoutDiscount for Price Without Tax
     * 
     *  @return double;
     */
    public function countAmountIncTaxWithoutDiscount()
    {
        $unitAmountIncTaxWithoutDiscount = $this->countUnitAmountIncTaxWithoutDiscount();

        $amountIncTaxWithoutDiscount = $unitAmountIncTaxWithoutDiscount * $this->quantity;
        $amountIncTaxWithoutDiscount = $this->roundAmount($amountIncTaxWithoutDiscount);
        return $amountIncTaxWithoutDiscount;
    }
}