<section id="about" class="py-16 px-4 sm:px-6 lg:px-8 bg-white scroll-mt-20">
    <div class="app-container">
        <div class="mx-auto max-w-7xl grid grid-cols-1 md:grid-cols-12 items-center gap-8 md:gap-12">

            <div class="md:col-span-5">
                <img src="{{ asset('storage/' . $about->image) }}" alt="About Us"
                    class="w-full max-w-md mx-auto h-auto object-contain rounded">
            </div>

            <div class="md:col-span-7">
                <h3 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                    {{ $about->title ?? 'Welcome to Our Restaurant' }}
                </h3>

                <p class="text-base md:text-lg text-primary mb-4">
                    {!! nl2br(e($about->description ?? '')) !!}
                </p>

                <div class="text-base md:text-lg text-primary mb-4">
                    <p class="font-semibold mb-2"> Our services: </p>

                    <ul class="list-disc list-inside space-y-1">
                        @foreach (json_decode($about->services ?? '[]', true) as $service)
                            <li>
                                <strong>{{ $service['name'] }}:</strong>
                                {{ $service['description'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-base md:text-lg text-primary mb-4 space-y-2">
                    <p> {!! nl2br(e($about->extra_text ?? '')) !!} </p>

                    @if ($about->address)
                        <p><strong>Address:</strong> {{ $about->address }}</p>
                    @endif

                    @if ($about->contact)
                        <p><strong>Order & Info:</strong> {{ $about->contact }}</p>
                    @endif

                    @if ($about->website)
                        <p><strong>Website:</strong> {{ $about->website }}</p>
                    @endif


                </div>

            </div>
        </div>
    </div>
</section>
