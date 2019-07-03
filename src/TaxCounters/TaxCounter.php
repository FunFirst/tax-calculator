<?php

namespace FunFirst\TaxCalculator\TaxCounters;

abstract class TaxCounter
{
    /** 
     *  Holds given price.
     */
    protected $price;

    /**
     *  Used to define Tax Rate that is used inside all calculations.
     */
    protected $taxRate = null;

    /**
     *  Defines if given price (stored in $this->price) is defautly with Tax or withtout taxes.
     */
    protected $taxIncluded = false;

    /**
     *  Defines percent discount that should be applied to prices.
     */
    protected $percentDiscount;

    /**
     *  Defines count of rounding decimals for all final amounts
     */
    protected $decimals = 2;

    /**
     *  Defines quantity that is used to count final amounts from unit amounts
     */
    protected $quantity = 1;

    public function __construct($price = 0)
    {
        $this->setPrice($price);
    }

    /**
     *  Set given price
     *
     *  @param integer $price
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     */
    public function setPrice($price)
    {
        if (!is_numeric($price)) {
            throw new \FunFirst\TaxCalculator\Exceptions\InvalidTypeException();
        }

        $this->price = $price;

        return $this;
    }

    /**
     *  Set Tax Rate
     *
     *  @param double $taxRate (in range 0-1)
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidTypeExceptio;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidPercentValueException;
     */
    public function setTaxRate($taxRate)
    {
        if ($taxRate !== null) {
            if (!is_numeric($taxRate)) {
                throw new \FunFirst\TaxCalculator\Exceptions\InvalidTypeException();
            }
            if ($taxRate > 1 || $taxRate < 0) {
                throw new \FunFirst\TaxCalculator\Exceptions\InvalidPercentValueException();
            }
            if (round($taxRate, 4) !== $taxRate) {
                $taxRate = round($taxRate, 4);
            }
        }

        $this->taxRate = $taxRate;
        return $this;
    }

    /**
     *  Set Tax Included (in future determinates if $this->price has tax included)
     *
     *  @param boolean $taxIncluded;
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidTypeException;
     */
    public function setTaxIncluded($taxIncluded)
    {
        if (!is_bool($taxIncluded)) {
            throw new \FunFirst\TaxCalculator\Exceptions\InvalidTypeException();
        }
        $this->taxIncluded = $taxIncluded;
        return $this;
    }

    /**
     *  Set coupon percent discount
     *
     *  @param double|null $discount
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidTypeException;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidPercentValueException;
     */
    public function setPercentDiscount($discount)
    {
        if ($discount !== null) {
            if (!is_numeric($discount)) {
                throw new \FunFirst\TaxCalculator\Exceptions\InvalidTypeException();
            }
            if ($discount > 1 || $discount < 0) {
                throw new \FunFirst\TaxCalculator\Exceptions\InvalidPercentValueException();
            }
        }

        $this->percentDiscount = $discount;
        return $this;
    }

    /**
     *  Set quantity
     *
     *  @param double $quantity
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidTypeException;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidValueException;
     */
    public function setQuantity($quantity)
    {
        if (!is_numeric($quantity)) {
            throw new \FunFirst\TaxCalculator\Exceptions\InvalidTypeException();
        }
        if ($quantity <= 0) {
            throw new \FunFirst\TaxCalculator\Exceptions\InvalidValueException();
        }

        $this->quantity = $quantity;
        return $this;
    }

    /**
     *  Set decimals
     *
     *  @param integer $decimals;
     *  @return \FunFirst\TaxCalculator\TaxCounters\TaxCounterInterface;
     *  @throws \FunFirst\TaxCalculator\Exceptions\InvalidTypeException;
     */
    public function setDecimals($decimals)
    {
        if (!is_numeric($decimals)) {
            throw new \FunFirst\TaxCalculator\Exceptions\InvalidTypeException();
        }
        $this->decimals = $decimals;
        return $this;
    }

    /**
     *  Rounds value on decimals based on property $decimals
     * 
     *  @param double $value;
     *  @param double|int
     */
    public function roundAmount($value)
    {
        return round($value, $this->decimals);
    }

    /**
     *  Return default price
     *
     *  @return double
     */
    public function getPrice()
    {
        return round($this->price, $this->decimals);
    }

    /**
     *  Return tax rate
     *
     *  @return double
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     *  Returns coupon percent discount
     *
     *  @param bool|false $inPercents
     *  @return double|null
     */
    public function getPercentDiscount($inPercents = false)
    {
        if ($this->percentDiscount === null) {
            return null;
        }

        if ($inPercents) {
            return $this->percentDiscount * 100;
        } else {
            return $this->percentDiscount;
        }
    }

    /**
     *  Returns decimals
     *
     *  @return double|null
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     *  Returns taxIncluded
     * 
     *  @return boolean
     */
    public function getTaxIncluded()
    {
        return $this->taxIncluded;
    }

    /**
     *  Returns quantity
     * 
     *  @return double
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}