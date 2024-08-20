<?php

/**
 * @author Iván Corral https://github.com/ivancorral-2000
 */

class Stock
{
    protected $prices;

    public function __construct($prices)
    {
        $this->prices = $prices;
    }

    public function price($date)
    {
        return isset($this->prices[$date]) ? $this->prices[$date] : null;
    }
}

class Portfolio
{
    protected $stocks = [];

    public function new_stock($stock)
    {
        $this->stocks[] = $stock;
    }

    public function profit($date_one, $date_two)
    {
        $profit = 0;

        foreach ($this->stocks as $stock) {
            $profit += $this->calculate_profit($stock, $date_one, $date_two);
        }

        return $profit;
    }

    protected function calculate_profit($stock, $date_one, $date_two)
    {
        $price_one = $stock->get_price($date_one);
        $price_two = $stock->get_price($date_two);

        if (!$price_one || !$price_two) {
            return 0;
        }

        return $price_two - $price_one;
    }
}


$stock1 = new Stock(["01/01/2021" => 100, "01/01/2024" => 1000]);
$stock2 = new Stock(["01/01/2021" => 600, "01/01/2024" => 480]);
$stock3 = new Stock(["01/01/2021" => 100, "01/01/2024" => 101]);

$portfolio = new Portfolio();
$portfolio->new_stock($stock1);
$portfolio->new_stock($stock2);
$portfolio->new_stock($stock3);

echo $portfolio->profit("01/01/2021", "01/01/2024");
