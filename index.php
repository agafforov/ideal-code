<?php

interface CostCalculatorInterface
{
    public function getCost(): float;
}

trait CostCalculatorTrait
{
    private CostCalculatorInterface $previousCostCalculator;

    public function __construct(CostCalculatorInterface $previousCostCalculator)
    {
        $this->previousCostCalculator = $previousCostCalculator;
    }
}

class BasicInspectionCostCalculator implements CostCalculatorInterface
{
    public function getCost(): float
    {
        return 25;
    }
}

class TireReplacementCostCalculator implements CostCalculatorInterface
{
    use CostCalculatorTrait;

    public function getCost(): float
    {
        return 25 + $this->getCost();
    }
}

class PaintingCarCostCalculator implements CostCalculatorInterface
{
    use CostCalculatorTrait;

    public function getCost(): float
    {
        return 150 + $this->getCost();
    }
}

$totalCost = new PaintingCarCostCalculator(new TireReplacementCostCalculator(new BasicInspectionCostCalculator()));

