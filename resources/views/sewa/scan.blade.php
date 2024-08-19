@extends('layouts.dashboard-volt')
@section('css')
    <style>
        .button-container {
            display: flex;
            gap: 10px;
            /* Jarak antar tombol */
            margin-top: 1rem;
        }

        .btn-disabled {
            background-color: red !important;
            color: white !important;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sewa</h4>
                    </div>
                    <div class="card-body">

                        @if ($alert != 'booked')
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

                            @if (!empty($alert) && $alert == 'kembali')
                                <div style="color:white" class="alert alert-success show mb-2" role="alert">
                                    <b>Berhasil!</b> Terimakasih telah menggunakan
                                    E-Bike.
                                </div>
                            @elseif($alert == '')
                                <div class="alert alert-primary show mb-2" role="alert"><b>Info:</b>
                                    Silahkan arahkan kamera ke QR Code.</div>
                            @endif

                            @if (!empty($status) && $status == '1')
                                <div class="alert alert-danger show mb-2" role="alert"><b>Ups!</b>
                                    Unit sedang digunakan. Pakai unit yang lain ya.</div>
                            @elseif(!empty($status) && $status == '2')
                                <div class="alert alert-danger show mb-2" role="alert"><b>Ups!</b>
                                    Unit tidak ada.</div>
                            @endif

                            <div class="preview">
                                <div id="interactive" class="viewport">
                                    <!-- Tambahkan canvas untuk menampilkan gambar dari video -->
                                    <canvas id="canvas" style="display: none;"></canvas>
                                    <!-- Tambahkan video -->
                                    <video id="video" width="90%" autoplay playsinline class="video"></video>
                                </div>
                                <div id="output"></div>
                                </br>
                            </div>
                        @else
                            <div class="intro-y box">
                                <div>
                                    <h2 class="font-medium text-base mr-auto">Sedang di Sewa</h2>
                                </div>

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
                                @if ($status == 2)
                                    <div class="alert alert-danger show mb-2" role="alert">
                                        <b>Info!</b> Durasi telah habis. Segera kembalikan unit!
                                    </div>
                                @endif

                                <div class="preview">
                                    <center>
                                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                            <div
                                                class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                    <img id="gambarClick" onclick="{{ url('uploads/' . $foto) }}"
                                                        class="rounded-md" alt="Icewall Tailwind HTML Admin Template"
                                                        src="uploads/{{ $foto }}">
                                                </div>
                                            </div>
                                            </br>

                                            <a href="{{ route('lock', ['v_bike' => $id_bike, 'v_lock' => $lock_status]) }}"
                                                id="lockButton" style="color:white" class="btn btn-{{ $lock_color }}"><i
                                                    class='fas fa-lock'></i></a>
                                            <a href="{{ route('maps') }}" style="color:white; background-color:blue"
                                                class="btn "><i class='fas fa-map'></i></a>
                                        </div>
                                    </center>

                                    <form action="action.php" method="post" enctype="multipart/form-data">
                                        <input type="text" name="action" id="action" value="booking" hidden>

                                        <input type="text" name="id_bike" id="id_bike" value="{{ $id_bike }}"
                                            hidden>


                                        <div class="mt-3">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">Unit
                                                    E-Bike</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $merk }} | {{ $warna }}" readonly required>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">Mulai Sewa</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $booking->datetime }} WIB - {{ $booking->durasi }} menit"
                                                    readonly required>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">Sisa
                                                    Waktu</label>
                                                <div type="text" class="form-control" id="countdown">
                                                    <span id="hours"></span> jam <span id="minutes"></span> menit
                                                    <span id="seconds"></span> detik
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">Kecepatan</label>
                                                <input type="text" class="form-control" value="{{ $data->speed }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div>
                                                <label for="update-profile-form-1" class="form-label">Baterai</label>
                                                <input type="text" class="form-control" value="{{ $data->baterai }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="button-container">
                                            <a href="{{ route('kembali', $id_booking) }}" style="color:white"
                                                class="btn btn-primary w-20 mt-3">
                                                Kembalikan </a>
                                            <div id="sewa-lagi-container"></div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    @endif
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
    @if ($alert != 'booked')
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
                                        output.innerText = 'Hasil Scan: ' + code.data;

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
    @else
        <script>
            // Tentukan waktu target dalam jam, menit, dan detik
            var targetTime = new Date();
            targetTime.setHours({{ $jam2 }}); // Misalnya, jam 3 sore
            targetTime.setMinutes({{ $menit2 }}); // Misalnya, 30 menit
            targetTime.setSeconds({{ $detik2 }}); // Misalnya, detik ke-0

            function updateCountdown() {
                var currentTime = new Date();
                var timeDifference = targetTime - currentTime;

                // Hitung jam, menit, dan detik
                var hours = Math.floor(timeDifference / (1000 * 60 * 60));
                var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                // Menyusun string waktu
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                // Perbarui setiap 1 detik
                if (timeDifference > 0) {
                    setTimeout(updateCountdown, 1000);
                } else {
                    document.getElementById("countdown").innerHTML = "Waktu habis!";
                    // Menonaktifkan tombol dengan ID lockButton
                    document.getElementById("lockButton").classList.add('btn-disabled');
                    document.getElementById("lockButton").classList.add('disabled');
                    document.getElementById("lockButton").style.pointerEvents = 'none';

                    // Menggunakan AJAX untuk mengirim permintaan ke server
                    var idBooking = {{ $id_booking }};
                    var sewaLagiButton = document.createElement("a");
                    sewaLagiButton.href = "{{ route('booking_sewa_lagi', $id_bike) }}"; // Sesuaikan URL ini
                    sewaLagiButton.innerHTML = "Sewa Lagi";
                    sewaLagiButton.className = "btn btn-primary w-20 mt-3";
                    sewaLagiButton.style.color = "white";
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var container = document.getElementById("sewa-lagi-container");
                    container.appendChild(sewaLagiButton);

                    $.ajax({
                        url: '/lock',
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Menyertakan token CSRF sebagai header X-CSRF-TOKEN
                        },
                        success: function(response) {
                            console.log(response); // Menampilkan hasil dari server
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });

                    $.ajax({
                        url: '/booking_done',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Menyertakan token CSRF sebagai header X-CSRF-TOKEN
                        },
                        data: {
                            id_booking: {{ $id_booking }},
                            id_bike: {{ $id_bike }}
                        },
                        success: function(response) {
                            console.log(response); // Menampilkan hasil dari server
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

            }

            // Panggil fungsi untuk pertama kali
            updateCountdown();
        </script>
    @endif

@endpush
