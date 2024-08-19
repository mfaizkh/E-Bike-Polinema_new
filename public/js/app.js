
function startScan() {
    const video = document.getElementById('video');
    const output = document.getElementById('result');

    // Create canvas
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');

    // Access the camera
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(stream => {
            video.srcObject = stream;

            // Add delay before starting scan (adjust as needed)
            setTimeout(() => {
                // Video dimensions
                const width = video.videoWidth;
                const height = video.videoHeight;

             

                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext('2d');
                // Scan loop
                function scanLoop() {
                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        // Draw video frame on canvas
                        ctx.drawImage(video, 0, 0, width, height);
                        const imageData = ctx.getImageData(0, 0, width, height);

                        // Scan for QR code
                        const code = jsQR(imageData.data, imageData.width, imageData.height);

                        // If QR code found, display the result
                        if (code) {
                            output.textContent = 'Result: ' + code.data;
                            // Stop the scanning process
                            stream.getTracks().forEach(track => track.stop());
                        }
                    }

                    // Request next animation frame
                    requestAnimationFrame(scanLoop);
                }

                // Start the scanning loop
                scanLoop();
            }, 2000); // Delay for 2 seconds before starting scan
        })
        .catch(err => {
            console.error('Tidak dapat mengakses kamera:', err);
        });
}

// Call startScan function to begin QR code scanning
startScan();
