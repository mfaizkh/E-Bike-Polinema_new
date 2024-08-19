@extends('layouts.dashboard-volt')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sewa</div>
                    <div class="card-body">

                      
                            <h2 class="font-medium text-base mr-auto">Scan QR E-Bike</h2>

                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif


                            <div class="preview">
                                <div id="interactive" class="viewport">
                                    <!-- Tambahkan canvas untuk menampilkan gambar dari video -->
                                    <canvas id="canvas" style="display: none;"></canvas>
                                    <!-- Tambahkan video -->
                                    <video id="video" autoplay playsinline class="video"></video>
                                </div>
                                <div id="output"></div>
                                </br>
                            </div>
                        
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
    
        <script>
            function startScan() {
                const video = document.getElementById('video');
                const output = document.getElementById('output');

                // Create canvas
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Access the camera
                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "environment"
                        }
                    })
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
                                        console.log('Result: ' + code.data);
                                        var kode = code.data; // Simpan nilai 'kode' dalam variabel
                                        window.location.href = "/sewa/create?kode=" + encodeURIComponent(
                                        kode); // Arahkan ke URL dengan parameter 'kode'


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
        </script>
    
@endpush
