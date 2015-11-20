<?php

interface Discount {
    public function calculateDiscount($price);
}

// receive $10 discount if total price is greater than $19
class DiscountCoupon implements Discount {

    public function calculateDiscount($price)
    {
        if ($price > 19) {
            return $price - 10;
        }
        else {
            return 0;
        }
    }
}

// whoa! lucky you, black friday today, all prices 30% off
class BlackFriday implements Discount {

    public function calculateDiscount($price)
    {
        return $price*0.3;
    }
}

// buy more, gain higher discount
class ProgressDiscount implements Discount {

    public function calculateDiscount($price)
    {
        if ($price > 50)
        {
            return $price*0.20;
        }
        elseif ($price > 10 && $price <= 50)
        {
            return $price*0.1;
        }
        else
        {
            return $price*0.05;
        }
    }
}

class Checkout {

    private $price;
    private $discountStrategy;

    public function __construct($price, $discountType)
    {
        $this->price = $price;

        switch ($discountType)
        {
            case 'coupon':
                $this->discountStrategy = new DiscountCoupon();
                break;
            case 'black_friday':
                $this->discountStrategy = new BlackFriday();
                break;
            case 'progress':
                $this->discountStrategy = new ProgressDiscount();
                break;
        }
    }

    public function getTotalPrice() {

        if (isset($this->discountStrategy)) {
            return $this->price - $this->discountStrategy->calculateDiscount($this->price);
        }
        else {
            return $this->price;
        }
    }
}

$checkout = new Checkout('30', 'progress');
echo $checkout->getTotalPrice() . PHP_EOL;