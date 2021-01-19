<?php


namespace App\Service;


class BaseJob
{
    /**
     * @var string
     */
    protected $format;

    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lon;


    /**
     * {@inheritDoc}
     */
    public function toQuery()
    {
        return
            '?format=' . $this->getFormat() .
            '&lat=' . $this->getLat() .
            '&lon=' . $this->getLon()
        ;
    }

    /**
     * @return float
     */
    public function getLon(): float
    {
        return $this->lon;
    }

    /**
     * @param float $lon
     * @return BaseJob
     */
    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return BaseJob
     */
    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return BaseJob
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }


}
