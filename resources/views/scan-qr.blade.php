<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner votre code QR</title>
    <!-- DeskApp2 CSS -->
    <link rel="stylesheet" href="{{ asset('adminProvidence/vendors/styles/core.css') }}">
    <link rel="stylesheet" href="{{ asset('adminProvidence/vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminProvidence/vendors/styles/style.css') }}">
    <!-- Scanner QR Code library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.1.1/html5-qrcode.min.js"></script>
</head>
<body class="login-page">
    <div class="login-box">
        <div class="card box-shadow">
            <div class="card-header text-center">
                <h2>Scanner votre code QR</h2>
            </div>
            <div class="card-body">
                <p class="text-center">Cliquez sur le bouton ci-dessous pour scanner votre code QR</p>
                <div class="text-center">
                    <button id="start-scan" class="btn btn-primary">Scan</button>
                </div>
                <div id="reader" style="width:300px; height:300px; margin-top: 20px; display:none;"></div>
                <!-- Ajoutez cet élément pour afficher les messages -->
                <div id="message" class="text-center" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
    

    <!-- DeskApp2 JS -->
    <script src="{{ asset('deskapp/scripts/core.js') }}"></script>
    <script src="{{ asset('deskapp/scripts/script.min.js') }}"></script>
    <script src="{{ asset('deskapp/scripts/process.js') }}"></script>
    <script src="{{ asset('deskapp/scripts/layout-settings.js') }}"></script>
    
    <!-- QR Code Scanner Script -->
    <script>
        document.getElementById('start-scan').addEventListener('click', function() {
    let reader = document.getElementById('reader');
    reader.style.display = 'block';
    
    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: { width: 250, height: 250 }
        },
        qrCodeMessage => {
            console.log(`QR Code detected: ${qrCodeMessage}`);
            
            // Stop scanning once a QR code is detected
            html5QrCode.stop().then(() => {
                reader.style.display = 'none';
                
                // Send the QR code to the server to validate
                $.ajax({
                    url: '/scan-qr',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({ qrcode: qrCodeMessage }),
                    contentType: 'application/json',
                    success: function(data) {
                        let messageContainer = document.getElementById('message');
                        if (data.success) {

                            console.log("Hello");
                            // Display welcome message and buttons
                            // messageContainer.innerHTML = `
                            //     <p>Bonjour ${data.agent_name}, marquez votre heure d'Arrivée ou de Sortie</p>
                            //     <button id="arrivee" class="btn btn-success">Arrivée</button>
                            //     <button id="sortie" class="btn btn-danger">Sortie</button>
                            // `;
                            // document.getElementById('arrivee').addEventListener('click', function() {
                            //     alert('Heure d\'arrivée marquée');
                            // });
                            // document.getElementById('sortie').addEventListener('click', function() {
                            //     alert('Heure de sortie marquée');
                            // });
                        } else {
                            // Display error message
                            messageContainer.innerHTML = `<p style="color:red;">Code QR invalide</p>`;
                        }
                    },
                    error: function(err) {
                        console.error(`Erreur lors de la validation du code QR: ${err}`);
                    }
                });
            }).catch(err => {
                console.error(`Erreur lors de l'arrêt du scanner: ${err}`);
            });
        },
        errorMessage => {
            console.warn(`QR Code non détecté: ${errorMessage}`);
        }
    ).catch(err => {
        console.error(`Impossible de démarrer le scan: ${err}`);
    });
});

    </script>
</body>
</html>
