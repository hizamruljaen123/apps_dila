Fuzzy Tsukamoto for Bread Sales Classification
=============================================

Overview
--------
This project implements the **Fuzzy Tsukamoto algorithm** to classify bread sales levels
(Low, Medium, High) based on factors such as **demand**, **price**, and **production capacity**.
The implementation is done in **PHP** for integration with web-based applications.

Algorithm Steps
---------------
1. **Define Fuzzy Sets**:
   - Input variables: `Demand`, `Price`, `ProductionCapacity`
   - Each variable has membership functions (e.g., Low, Medium, High)

2. **Fuzzification**:
   - Convert crisp inputs into fuzzy values using membership functions.

3. **Rule Base**:
   - Define IF-THEN rules. Example:
     - IF Demand is High AND Price is Low THEN Sales is High
     - IF Demand is Low OR Price is High THEN Sales is Low

4. **Inference (Tsukamoto Method)**:
   - Use the **minimum operator** for AND rules and **maximum** for OR rules.
   - Each rule produces a **crisp output** proportional to its degree of membership.

5. **Defuzzification**:
   - Compute weighted average of all crisp outputs to get final classification.

PHP Implementation (Example)
----------------------------
.. code-block:: php

    <?php
    // Membership functions
    function low($x, $min, $max) {
        if ($x <= $min) return 1;
        if ($x >= $max) return 0;
        return ($max - $x)/($max - $min);
    }

    function high($x, $min, $max) {
        if ($x <= $min) return 0;
        if ($x >= $max) return 1;
        return ($x - $min)/($max - $min);
    }

    // Example input
    $demand = 80; // percentage
    $price = 20;  // dollars
    $capacity = 50; // units

    // Fuzzification
    $demandHigh = high($demand, 50, 100);
    $priceLow = low($price, 10, 30);
    $capacityHigh = high($capacity, 30, 70);

    // Rule evaluation (AND using min)
    $rule1 = min($demandHigh, $priceLow); // Sales High
    $rule2 = min(1 - $demandHigh, 1 - $capacityHigh); // Sales Low

    // Tsukamoto defuzzification
    $salesHigh = $rule1 * 90; // 90 units
    $salesLow = $rule2 * 30;  // 30 units

    $finalSales = ($salesHigh + $salesLow)/($rule1 + $rule2);
    echo "Predicted Sales: " . round($finalSales) . " units";
    ?>

Notes
-----
- The membership functions can be **triangular or trapezoidal**.  
- Tsukamoto method requires each rule to produce a **crisp output**.  
- PHP can be used to integrate this logic into web dashboards for **real-time bread sales prediction**.  
