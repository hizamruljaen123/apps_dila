# Bread Sales Classification Using Fuzzy Tsukamoto Method

This project demonstrates how to classify bread sales into categories like **Low, Medium, High** using the **Fuzzy Tsukamoto method**.

---

## Steps Overview

1. **Define Input Variables**  
   - `temperature` (°C)  
   - `day_of_week` (1–7)  
   - `promotion` (0–1)

2. **Define Output Variable**  
   - `sales` categorized as Low, Medium, High

3. **Fuzzification**  
   - Convert crisp input values to **membership values** using fuzzy sets.  
   - Example membership functions:
     - Temperature: Cold, Normal, Hot  
     - Promotion: None, Small, Large  

4. **Rule Base**  
   - Example rules:
     - IF temperature IS Hot AND promotion IS Large THEN sales IS High  
     - IF temperature IS Cold AND promotion IS None THEN sales IS Low

5. **Inference using Tsukamoto Method**  
   - Each rule produces an output fuzzy set with a monotonic membership function.  
   - Weighted average of outputs produces final crisp value (defuzzification).

6. **Defuzzification**  
   - Use **weighted average** of all rule outputs to get the final sales prediction.

---

## Python Example (Simplified)

```python
import numpy as np

# Membership functions
def cold_temp(x): return max(0, min(1, (20-x)/10))
def normal_temp(x): return max(0, min((x-15)/5, (25-x)/5))
def hot_temp(x): return max(0, min(1, (x-20)/10))

def low_promo(x): return max(0, min(1, (0.5-x)/0.5))
def high_promo(x): return max(0, min(1, (x-0.5)/0.5))

# Tsukamoto inference function
def tsukamoto_inference(temp, promo):
    # Rule 1: IF temp IS hot AND promo IS high THEN sales IS High
    alpha1 = min(hot_temp(temp), high_promo(promo))
    z1 = 100 - alpha1*(100-70)  # example mapping crisp output
    
    # Rule 2: IF temp IS cold AND promo IS low THEN sales IS Low
    alpha2 = min(cold_temp(temp), low_promo(promo))
    z2 = alpha2*30 + (1-alpha2)*50  # example mapping crisp output
    
    # Weighted average
    final_sales = (alpha1*z1 + alpha2*z2) / (alpha1 + alpha2 + 1e-6)
    return final_sales

# Example usage
temperature = 22  # °C
promotion = 0.7   # normalized 0-1
sales_prediction = tsukamoto_inference(temperature, promotion)
print(f"Predicted bread sales: {sales_prediction:.2f}")
