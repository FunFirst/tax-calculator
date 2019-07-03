<?php

namespace FunFirst\TaxCalculator\TaxCounters;

use FunFirst\TaxCalculator\TaxCounters\TaxCounter;
use FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;

class TaxCounterForPriceIncTax extends TaxCounter implements TaxCounterInterface
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
    public function setTaxIncluded($taxIncluded = true)
    {
        $this->taxIncluded = true;
        return $this;
    }

    /** 
     *  Count BasePrice for Price with Taxes
     * 
     *  @return double
     */
    public function countBasePrice()
    {
        $basePriceIncTax = $this->getPrice();
        $basePriceTax = $this->countBasePriceTax();

        $basePrice = $basePriceIncTax - $basePriceTax;
        $basePrice = $this->roundAmount($basePrice);
        return $basePrice;
    }

    /** 
     *  Count BasePriceTax for Price with Taxes
     * 
     *  @return double
     */
    public function countBasePriceTax()
    {
        $basePriceIncTax = $this->countBasePriceIncTax();

        $basePriceTax = $basePriceIncTax * ($this->getTaxRate() / (1 + $this->getTaxRate()));
        $basePriceTax = $this->roundAmount($basePriceTax);
        return $basePriceTax;
    }

    /**
     *  Count BasePriceIncTax for Price with Tax
     * 
     *  @return double;
     */
    public function countBasePriceIncTax()
    {
        $basePriceIncTax = $this->getPrice();
        return $basePriceIncTax;
    }

    /**
     *  Count UnitAmount for Price with Tax
     * 
     *  @return double;
     */
    public function countUnitAmount()
    {
        $unitAmountIncTax = $this->countUnitAmountIncTax();
        $unitAmountTax = $this->countUnitAmountTax();

        $unitAmount = $unitAmountIncTax - $unitAmountTax;
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
     *  Count UnitAmountTax for Price with Tax
     * 
     *  @return double;
     */
    public function countUnitAmountTax()
    {
        $unitAmountIncTax = $this->countUnitAmountIncTax();

        if ($this->percentDiscount !== null) {
            $unitAmountTax = $unitAmountIncTax * ($this->getTaxRate() / (1 + $this->getTaxRate()));
            $unitAmountTax = $this->roundAmount($unitAmountTax);
        } else {
            $basePriceAmountTax = $this->countBasePriceTax();
            $unitAmountTax = $basePriceAmountTax;
        }
       
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
     *  Count UnitAmountIncTax for Price with Tax
     * 
     *  @return double;
     */
    public function countUnitAmountIncTax()
    {
        $basePriceIncTax = $this->countBasePriceIncTax();

        if ($this->percentDiscount !== null) {
            $unitAmountIncTax = $basePriceIncTax * (1 - $this->percentDiscount);
            $unitAmountIncTax = $this->roundAmount($unitAmountIncTax);
        } else {
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
     *  Count Amount for Price Inc Tax
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
     *  Count AmountDiscount for Price Inc Tax
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
     *  Count AmountWithoutDiscount for Price Inc Tax
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
     *  Count Amount Tax for Price Inc Tax
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
     *  Count AmountTaxDiscount for Price Inc Tax
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
     *  Count AmountTaxWithoutDiscount for Price Inc Tax
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
     *  Count Amount Inc Tax for Price Inc Tax
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
     *  Count AmountIncTaxDiscount for Price Inc Tax
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
     *  Count AmountIncTaxWithoutDiscount for Price Inc Tax
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