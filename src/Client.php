<?php

namespace FunFirst\TaxCalculator;

class Client
{
    /**
     *  Hold selected TaxCounter that is used to perform counting
     */
    protected $taxCounter;

    public function __construct(\FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface $taxCounter = null)
    {
        if ($taxCounter === null) {
            $this->taxCounter = new \FunFirst\TaxCalculator\TaxCounters\TaxCounterForPriceIncTax();
        } else {
            $this->taxCounter = $taxCounter;
        }
    }

    /**
     *  Returns class name of current TaxCounter that is used for all calculations
     * 
     *  @return string;
     */
    public function getTaxCounterClass()
    {
        return get_class($this->taxCounter);
    }

    /**
     *  Change tax Counter
     * 
     *  @param \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface $taxCounter;
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function changeTaxCounter(\FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface $taxCounter, $useOldValues = true) 
    {
        if ($useOldValues) {
            $taxCounter->setPrice($this->taxCounter->countPrice());
            $taxCounter->setTaxIncluded($this->taxCounter->countTaxIncluded());
            $taxCounter->setTaxRate($this->taxCounter->getTaxRate());
            $taxCounter->setQuantity($this->taxCounter->countQuantity());
            $taxCounter->setDecimals($this->taxCounter->getDecimals());
            $taxCounter->setPercentDiscount($this->taxCounter->countPercentDiscount());
        }
        
        $this->taxCounter = $taxCounter;
        return $this;
    }

    /**
     *  Return default price
     *
     *  @return double
     */
    public function getPrice()
    {
        return $this->taxCounter->countPrice();
    }

    /**
     *  Return tax rate
     *
     *  @return double
     */
    public function getTaxRate()
    {
        return $this->taxCounter->getTaxRate();
    }

    /**
     *  Returns coupon percent discount
     *
     *  @param bool|false $inPercents
     *  @return double|null
     */
    public function getPercentDiscount($inPercents = false)
    {
        return $this->taxCounter->getPercentDiscount($inPercents);
    }

    /**
     *  Returns decimals
     *
     *  @return double|null
     */
    public function getDecimals()
    {
        return $this->taxCounter->getDecimals();
    }

    /**
     *  Returns taxIncluded
     * 
     *  @return boolean
     */
    public function getTaxIncluded()
    {
        return $this->taxCounter->getTaxIncluded();
    }

    /**
     *  Returns quantity
     * 
     *  @return double
     */
    public function getQuantity()
    {
        return $this->taxCounter->getQuantity();
    }

    /**
     *  Set TaxCounter used to perform counting
     * 
     *  @param \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface $taxCounter;
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function setTaxCounter(\FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface $taxCounter)
    {
        $this->taxCounter = $taxCounter;   
        return $this;
    }

    /**
     *  Set given price
     *
     *  @param integer $price
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function setPrice($price)
    {
        $this->taxCounter->setPrice($price);
        return $this;
    }

    /**
     *  Set Tax Rate
     *
     *  @param double $taxRate (in range 0-1)
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function setTaxRate($taxRate)
    {
        $this->taxCounter->setTaxRate($taxRate);
        return $this;
    }

    /**
     *  Set coupon percent discount
     *
     *  @param double|null $discount
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function setPercentDiscount($discount)
    {
        $this->taxCounter->setPercentDiscount($discount);
        return $this;
    }

    /**
     *  Set quantity
     *
     *  @param double $quantity
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function setQuantity($quantity)
    {
        $this->taxCounter->setQuantity($quantity);
        return $this;
    }

    /**
     *  Set decimals
     *
     *  @param integer $decimals;
     *  @return \FunFirst\TaxCalculator\Client;
     */
    public function setDecimals($decimals)
    {
        $this->taxCounter->setDecimals($decimals);
        return $this;
    }

    /**
     *  Returns base price based on $this->price, $this->taxRate and $this->taxIncluded
     *
     *  @return double
     */
    public function getBasePrice()
    {
        return $this->taxCounter->countBasePrice();
    }

    /**
     *  Returns base price tax based on $this->price, $this->taxRate and $this->taxIncluded
     *
     *  @return double|null
     */
    public function getBasePriceTax()
    {
        return $this->taxCounter->countBasePriceTax();
    }

    /**
     *  Returns base price including tax based on $this->price, $this->taxRate and $this->taxIncluded
     *
     *  @return double
     */
    public function getBasePriceIncTax()
    {
        return $this->taxCounter->countBasePriceIncTax();
    }

    /**
     *  Returns unit amount
     *
     *  @return double
     */
    public function getUnitAmount()
    {
        return $this->taxCounter->countUnitAmount();
    }

    /**
     *  Returns unit amount discount
     *
     *  @return double|null
     */
    public function getUnitAmountDiscount()
    {
        return $this->taxCounter->countUnitAmountDiscount();
    }

    /**
     *  Returns unit amount without discount
     *
     *  @return double
     */
    public function getUnitAmountWithoutDiscount()
    {
        return $this->taxCounter->countUnitAmountWithoutDiscount();
    }

    /**
     *  Returns unit amount tax
     *
     *  @return double|null
     */
    public function getUnitAmountTax()
    {
        if ($this->taxCounter->getTaxRate() === null) {
            return null;
        }

        return $this->taxCounter->countUnitAmountTax();
    }

    /**
     *  Returns unit amount tax discount
     *
     *  @return double|null
     */
    public function getUnitAmountTaxDiscount()
    {
        if ($this->taxCounter->getPercentDiscount() === null) {
            return null;
        }
        return $this->taxCounter->countUnitAmountTaxDiscount();
    }

    /**
     *  Returns unit amount tax without discount
     *
     *  @return double
     */
    public function getUnitAmountTaxWithoutDiscount()
    {
        return $this->taxCounter->countBasePriceTax();
    }

    /**
     *  Returns unit amount including tax
     *
     *  @return double|null
     */
    public function getUnitAmountIncTax()
    {
        return $this->taxCounter->countUnitAmountIncTax();
    }

    /**
     *  Returns unit amount including tax discount
     *
     *  @return double|null
     */
    public function getUnitAmountIncTaxDiscount()
    {
        if ($this->taxCounter->getPercentDiscount() === null) {
            return null;
        }
        return $this->taxCounter->countUnitAmountIncTaxDiscount();
    }

    /**
     *  Returns unit amount including tax without discount
     *
     *  @return double
     */
    public function getUnitAmountIncTaxWithoutDiscount()
    {
        return $this->taxCounter->countUnitAmountIncTaxWithoutDiscount();
    }

    /**
     *  Returns amount
     *
     *  @return double
     */
    public function getAmount()
    {
        return $this->taxCounter->countAmount();
    }

    /**
     *  Returns amount
     *
     *  @return double
     */
    public function getAmountDiscount()
    {
        if ($this->taxCounter->getPercentDiscount() === null) {
            return null;
        }

        return $this->taxCounter->countAmountDiscount();
    }

    /**
     *  Returns amount
     *
     *  @return double
     */
    public function getAmountWithoutDiscount()
    {
        return $this->taxCounter->countAmountWithoutDiscount();
    }

    /**
     *  Returns amount tax including taxes
     *
     *  @return double
     */
    public function getAmountTax()
    {
        if ($this->taxCounter->getTaxRate() === null) {
            return null;
        }

        return $this->taxCounter->countAmountTax();
    }

    /**
     *  Returns amount including taxes without applied discount
     *
     *  @return double
     */
    public function getAmountTaxWithoutDiscount()
    {
        return $this->taxCounter->countAmountTaxWithoutDiscount();
    }

    /**
     *  Returns amount including taxes discount
     *
     *  @return double
     */
    public function getAmountTaxDiscount()
    {
        if ($this->taxCounter->getPercentDiscount() === null) {
            return null;
        }

        return $this->taxCounter->countAmountTaxDiscount();
    }

    /**
     *  Returns amount including taxes
     *
     *  @return double
     */
    public function getAmountIncTax()
    {
        return $this->taxCounter->countAmountIncTax();
    }

    /**
     *  Returns amount including taxes without applied discount
     *
     *  @return double
     */
    public function getAmountIncTaxWithoutDiscount()
    {
        return $this->taxCounter->countAmountIncTaxWithoutDiscount();
    }

    /**
     *  Returns amount including taxes discount
     *
     *  @return double
     */
    public function getAmountIncTaxDiscount()
    {
        if ($this->taxCounter->getPercentDiscount() === null) {
            return null;
        }

        return $this->taxCounter->countAmountIncTaxDiscount();
    }
}
