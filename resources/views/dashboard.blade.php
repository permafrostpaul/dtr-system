<x-app-layout>

    <body class="font-sans text-gray-900 antialiased bg-body-blue flex justify-center items-center min-h-screen">
        <!-- Main Container -->
        <div class="flex flex-col md:flex-row md: md:mt-[4rem] p-4">
            <!-- Left Box (First Blue Box) -->
            <div class="w-full md:w-[32rem] p-7 bg-custom-blue rounded-xl shadow-xl mb-4 md:mb-0">
                <div class="mt-1 p-9 border-4 border-blue-300 rounded-2xl min-h-full">
                    <div class="flex justify-center items-center mb-4">
                        <!-- Optional content -->
                    </div>
                    <div id="camera-container" class="hidden relative">
                        <video id="camera" autoplay class="w-full h-auto"></video>
                        <canvas id="photo-canvas" class="hidden absolute top-0 left-0"></canvas>
                    </div>

                    <button id="take-photo-btn" type="button" class="w-full bg-custom-orange text-white py-2 rounded-lg mb-2 mt-16 flex items-center justify-center">
                        Take Photo
                        <svg class="w-6 h-6 text-gray-800 dark:text-white ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 18V8a1 1 0 0 1 1-1h1.5l1.707-1.707A1 1 0 0 1 8.914 5h6.172a1 1 0 0 1 .707.293L17.5 7H19a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Z" />
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>

                    <button id="retry-btn" type="button" class="hidden w-full bg-blue-400 text-white py-2 rounded-lg flex items-center justify-center mt-2">
                        Retry
                        <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3" />
                        </svg>
                    </button>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const cameraContainer = document.getElementById('camera-container');
                            const camera = document.getElementById('camera');
                            const photoCanvas = document.getElementById('photo-canvas');
                            const takePhotoBtn = document.getElementById('take-photo-btn');
                            const retryBtn = document.getElementById('retry-btn');
                            let stream = null;
                            let isTakingPhoto = false;

                            async function startCamera() {
                                stream = await navigator.mediaDevices.getUserMedia({
                                    video: true
                                });
                                camera.srcObject = stream;
                                camera.play();
                            }

                            function stopCamera() {
                                if (stream) {
                                    stream.getTracks().forEach(track => track.stop());
                                }
                            }

                            function capturePhoto() {
                                const context = photoCanvas.getContext('2d');
                                photoCanvas.width = cameraContainer.clientWidth;
                                photoCanvas.height = cameraContainer.clientHeight;

                                const scale = Math.min(photoCanvas.width / camera.videoWidth, photoCanvas.height / camera.videoHeight);
                                const x = (photoCanvas.width / 2) - (camera.videoWidth / 2) * scale;
                                const y = (photoCanvas.height / 2) - (camera.videoHeight / 2) * scale;

                                context.drawImage(camera, x, y, camera.videoWidth * scale, camera.videoHeight * scale);
                                photoCanvas.classList.remove('hidden');
                                camera.classList.add('hidden');
                            }

                            takePhotoBtn.addEventListener('click', (event) => {
                                event.preventDefault();
                                if (!isTakingPhoto) {
                                    cameraContainer.classList.remove('hidden');
                                    photoCanvas.classList.add('hidden');
                                    camera.classList.remove('hidden');
                                    startCamera();
                                    isTakingPhoto = true;
                                    takePhotoBtn.textContent = 'Capture Photo';
                                } else {
                                    capturePhoto();
                                    stopCamera();
                                    retryBtn.classList.remove('hidden');
                                    takePhotoBtn.classList.add('hidden');
                                    isTakingPhoto = false;
                                }
                            });

                            retryBtn.addEventListener('click', (event) => {
                                event.preventDefault();
                                photoCanvas.classList.add('hidden');
                                camera.classList.remove('hidden');
                                cameraContainer.classList.remove('hidden');
                                takePhotoBtn.classList.remove('hidden');
                                takePhotoBtn.textContent = 'Take Photo';
                                retryBtn.classList.add('hidden');
                                startCamera();
                            });
                        });
                    </script>
                </div>
            </div>

            <!-- Right Box -->
            <div class="w-full md:w-[32rem] p-7 bg-custom-blue rounded-xl shadow-xl">
                <div class="mt-1 p-6 border-4 border-blue-300 rounded-2xl min-h-full">
                    <div class="text-center text-white mb-4">
                        <div>{{ \Carbon\Carbon::now()->timezone('Asia/Manila')->format('l, F j, Y') }}</div>
                        <div class="flex items-center justify-center mt-1">
                            <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="ml-2">{{ \Carbon\Carbon::now()->timezone('Asia/Manila')->format('h:i A') }}</span>
                        </div>
                        <div class="flex items-center justify-center mb-3 mt-3 p-2 border-2 border-white rounded-lg">
                            <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                            </svg>
                            <span class="ml-2">{{ $user->workstation }}</span>
                        </div>
                    </div>

                    <form action="{{ route('attendance.saveRemarks') }}" method="POST">
                        @csrf
                        <!-- Time In and Time Out Section -->
                    </form>
                    <div class="attendance-section">
                        <div class="flex flex-col gap-4 mt-10">
                            <form action="{{ route('attendance.timeIn') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-custom-orange text-white py-2 rounded-lg flex items-center justify-center">
                                    Time In
                                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M10 5a2 2 0 0 0-2 2v3h2.4A7.48 7.48 0 0 0 8 15.5a7.48 7.48 0 0 0 2.4 5.5H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1V7a4 4 0 1 1 8 0v1.15a7.446 7.446 0 0 0-1.943.685A.999.999 0 0 1 12 8.5V7a2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M10 15.5a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0Zm6.5-1.5a1 1 0 1 0-2 0v1.5a1 1 0 0 0 .293.707l1 1a1 1 0 0 0 1.414-1.414l-.707-.707V14Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('attendance.timeOut') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-blue-700 text-white py-2 rounded-lg flex items-center justify-center">
                                    Time Out
                                    <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M10 5a2 2 0 0 0-2 2v3h2.4A7.48 7.48 0 0 0 8 15.5a7.48 7.48 0 0 0 2.4 5.5H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1V7a4 4 0 1 1 8 0v1.15a7.446 7.446 0 0 0-1.943.685A.999.999 0 0 1 12 8.5V7a2 2 0 0 0-2-2Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M10 15.5a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0Zm6.5-1.5a1 1 0 1 0-2 0v1.5a1 1 0 0 0 .293.707l1 1a1 1 0 0 0 1.414-1.414l-.707-.707V14Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>