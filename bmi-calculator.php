<?php
/*
Plugin Name: BMI Calculator
Plugin URI: https://github.com/kiloalnet/bmi-calculator
Description: Basit bir BMI (Vücut Kitle İndeksi) hesaplayıcı eklentisi.
Version: 1.0
Author: KiloAl.net
Author URI: https://kiloal.net
*/

// Shortcode ekleme
function bmi_calculator_shortcode() {
    ob_start(); // Çıktıyı buffer'a al
    ?>
    
    <div class="bmi-calculator">
        <h3>BMI Hesaplayıcı</h3>
        <form id="bmiForm">
            <label>Boy (cm):</label>
            <input type="number" id="height" step="0.1" required><br>
            
            <label>Kilo (kg):</label>
            <input type="number" id="weight" step="0.1" required><br>
            
            <button type="button" onclick="calculateBMI()">Hesapla</button>
        </form>
        <div id="bmiResult"></div>
    </div>

    <script>
        function calculateBMI() {
            let height = document.getElementById('height').value / 100; // Metreye çevir
            let weight = document.getElementById('weight').value;
            
            if (height > 0 && weight > 0) {
                let bmi = weight / (height * height);
                let resultText = "BMI Sonucunuz: " + bmi.toFixed(1) + " - ";
                
                if (bmi < 18.5) resultText += "Zayıf";
                else if (bmi < 24.9) resultText += "Normal";
                else if (bmi < 29.9) resultText += "Fazla Kilolu";
                else resultText += "Obez";
                
                document.getElementById('bmiResult').innerHTML = resultText;
            } else {
                document.getElementById('bmiResult').innerHTML = "Lütfen geçerli değerler girin!";
            }
        }
    </script>

    <style>
        .bmi-calculator {
            padding: 15px;
            border: 1px solid #ddd;
            max-width: 400px;
            margin: 20px auto;
        }
        #bmiForm input, button {
            margin: 5px 0;
            padding: 8px;
            width: 100%;
        }
        #bmiResult {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
    
    <?php
    return ob_get_clean(); // Buffer'daki içeriği döndür
}
add_shortcode('bmi_calculator', 'bmi_calculator_shortcode');