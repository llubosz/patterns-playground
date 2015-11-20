<?php

interface Offer
{
    public function getPrice();
}

final class BaseOffer implements Offer
{

    public function getPrice()
    {
        return 40;
    }
}

final class SportDecorator implements Offer
{
    private $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getPrice()
    {
        return $this->offer->getPrice() + 20;
    }
}

final class EducationDecorator implements Offer
{
    private $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getPrice()
    {
        return $this->offer->getPrice() + 10;
    }
}

final class CinemaDecorator implements Offer
{
    private $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function getPrice()
    {
        return $this->offer->getPrice() + 30;
    }
}

$baseOffer = new BaseOffer();
$offerWithSport = new SportDecorator($baseOffer);
$offerWithSportAndEdication = new CinemaDecorator(new SportDecorator($baseOffer));
$fullOffer = new EducationDecorator(new CinemaDecorator(new SportDecorator($baseOffer)));

echo $baseOffer->getPrice() . PHP_EOL; // 40
echo $offerWithSport->getPrice() . PHP_EOL; // 60
echo $offerWithSportAndEdication->getPrice() . PHP_EOL; // 90
echo $fullOffer->getPrice() . PHP_EOL; // 100