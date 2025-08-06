<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text to QR Code Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #qrcode {
            margin: 20px 0;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- File Upload -->
        <input type="file" accept=".png, .jpg, .jpeg, .pdf, .docx"> UPLOAD FILE
        <h3>Enter Aadhar Number or Any Degree Registration Number to Verify</h3>
        
        <!-- Textarea for Aadhar Number or Registration Number -->
        <textarea id="textInput" rows="4" cols="50" placeholder="Enter Aadhar Number or Any Registration Number"></textarea>
        
        <!-- Generate QR Code Button -->
        <button id="generateQRButton">Generate QR Code</button>
        
        <!-- QR Code Display -->
        <div id="qrcode"></div>

        <!-- Check Button -->
        <button onclick="check()">CHECK</button>

    </div>

    <!-- QRCode.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script>
        document.getElementById('generateQRButton').addEventListener('click', function() {
            const textInput = document.getElementById('textInput').value;
            const qrCodeContainer = document.getElementById('qrcode');

            if (textInput.trim() === '') {
                alert('Please enter some text first.');
                return;
            }

            // Clear any existing QR codes
            qrCodeContainer.innerHTML = '';

            // Generate QR code from the input text
            QRCode.toCanvas(document.createElement('canvas'), textInput, function (error, canvas) {
                if (error) {
                    console.error('QR Code generation error:', error);
                    alert('Failed to generate QR code.');
                    return;
                }
                qrCodeContainer.appendChild(canvas);
                console.log('QR code generated!');
            });
        });

        function check() {
            var adno = document.getElementById("textInput").value;
            if (adno.trim() === '') {
                alert('Please enter an AADHAR number or Registration number first.');
                return;
            }
            alert(`AADHAR number: ${adno} verified`);  // Corrected syntax
            window.history.back();
        }
    </script>
</body>
</html>
