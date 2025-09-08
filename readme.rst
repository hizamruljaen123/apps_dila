# Bread Sales Classification Using Fuzzy Tsukamoto (PHP)

This example demonstrates how to classify **bread sales** into categories like **Low, Medium, High** using the **Fuzzy Tsukamoto** method in PHP.

---

## Steps Overview

1. **Define Input Variables**
   - Example inputs: `daily_customers`, `stock_level`
   - Each input has fuzzy sets:
     - `daily_customers`: Low, Medium, High  
     - `stock_level`: Low, Medium, High

2. **Fuzzification**
   - Convert crisp input values to **membership degrees** for each fuzzy set using linear membership functions.

3. **Rule Evaluation**
   - Example rules:
     - IF daily_customers is High AND stock_level is Low THEN sales_category is High  
     - IF daily_customers is Low AND stock_level is High THEN sales_category is Low  

4. **Defuzzification (Tsukamoto Method)**
   - Compute output using **weighted average** of rule outputs based on their membership values.

---

## PHP Example (Simplified)

```php
<?php

// Membership functions
function low($x, $a, $b) {
    if($x <= $a) return 1;
    elseif($x >= $b) return 0;
    else return ($b - $x) / ($b - $a);
}

function high($x, $a, $b) {
    if($x <= $a) return 0;
    elseif($x >= $b) return 1;
    else return ($x - $a) / ($b - $a);
}

// Example inputs
$daily_customers = 120;
$stock_level = 50;

// Fuzzification
$customers_low = low($daily_customers, 50, 100);
$customers_high = high($daily_customers, 100, 150);

$stock_low = low($stock_level, 20, 50);
$stock_high = high($stock_level, 50, 100);

// Rule evaluation (simplified)
$rule1 = min($customers_high, $stock_low); // High sales
$rule2 = min($customers_low, $stock_high); // Low sales

// Tsukamoto defuzzification
$sales_high = 150; // crisp output for High
$sales_low = 50;   // crisp output for Low

$numerator = ($rule1 * $sales_high) + ($rule2 * $sales_low);
$denominator = $rule1 + $rule2;

$sales_category = $numerator / $denominator;

echo "Predicted Sales: ".$sales_category;

?>
