<?php
/**
 * Plugin Name: QR Code Generator
 * Plugin URI: https://tools.mbonisi.com/qr-code-generator
 * Description: The QR Code Generator lets you create custom QR codes with ease. Enter URLs or text, select the size, and download your QR codes instantly.
 * Version: 1.0.0
 * Author: Mbonisi
 * Author URI: https://www.mbonisi.com
 * License: GPL2
 * Text Domain: qr-code-generator
 * Domain Path: /languages
 */

// Shortcode to display the QR code generator
function qrcode_generator_shortcode() {
    ob_start();
    ?>
    <style>
        #qrCodeGeneratorContainer {
            background-color: #FFFFFF1A; /* Dark background */
            color: #fff; /* White text */
            padding: 20px;
            border-radius: 8px;
        }
        #qrCodeGeneratorContainer label {
            display: block;
            margin-bottom: 10px;
        }
        #qrCodeGeneratorContainer input,
        #qrCodeGeneratorContainer select,
        #qrCodeGeneratorContainer button {
            display: block;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #555;
        }
        #qrCodeGeneratorContainer button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
        }
        #qrCodeGeneratorContainer button:hover {
            background-color: #0056b3;
        }
        #qrCodeGeneratorContainer #qrCode {
            margin-top: 20px;
        }
    </style>

    <div id="qrCodeGeneratorContainer">
        <label for="qrData">Enter Text or URL:</label>
        <input type="text" id="qrData" placeholder="Enter text or URL">

        <label for="qrSize">Select Size:</label>
        <select id="qrSize">
            <option value="100">Small (100x100)</option>
            <option value="200">Medium (200x200)</option>
            <option value="300">Large (300x300)</option>
        </select>

        <button id="generateBtn">Generate QR Code</button>

        <div id="qrCode" style="display: none;"></div>

        <button id="downloadBtn" style="display: none;">Download QR Code</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        const generateBtn = document.getElementById('generateBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const qrCodeDiv = document.getElementById('qrCode');

        generateBtn.addEventListener('click', function() {
            const qrData = document.getElementById('qrData').value;
            const qrSize = document.getElementById('qrSize').value;

            if (!qrData) {
                alert('Please enter some data to generate the QR code.');
                return;
            }

            // Clear previous QR code
            qrCodeDiv.innerHTML = '';
            
            // Generate new QR code
            new QRCode(qrCodeDiv, {
                text: qrData,
                width: parseInt(qrSize),
                height: parseInt(qrSize),
            });

            qrCodeDiv.style.display = 'block';
            downloadBtn.style.display = 'block';
        });

        downloadBtn.addEventListener('click', function() {
            const qrCodeImg = qrCodeDiv.querySelector('img');
            const imgSrc = qrCodeImg.src;
            const link = document.createElement('a');
            link.href = imgSrc;
            link.download = 'qrcode.png';
            link.click(); 
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('qrcode_generator', 'qrcode_generator_shortcode');
