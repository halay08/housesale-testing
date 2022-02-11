@extends('layout')

@section('title', 'Houses sale')

@section('content')
    <section class="sec-city">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-center font-bold text-4xl md:text-5xl">Houses for Sale in {{ ucfirst($name) }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 city-list mx-auto">
                @if(isset($data->zipcode_list))
                    @foreach($data->zipcode_list as $datum)
                        @php
                            $agentFullName = (!empty($datum->agentLastName) && !empty($datum->agentFirstName)) ? $datum->agentLastName . ' ' . $datum->agentFirstName : '';

                            $address = [];
                            if (!empty($datum->agentOffice)) {
                                $address[] = $datum->agentOffice;
                            }
                            if (!empty($datum->agentAddress)) {
                                $address[] = $datum->agentAddress;
                            }
                            $strCity = !empty($datum->agentCity) ? $datum->agentCity . ', ' : '';
                            $strStateZipcode = ($datum->agentState ?? $datum->agentState) . ' ' . ($datum->agentZip ?? '');
                            if (!empty($strCity) && !empty($strStateZipcode)) {
                                $address[] = $strCity . $strStateZipcode;
                            }
                        @endphp

                        <div class="city-item px-6 py-6 mx-4 my-4 text-center">
                            <h2 class="font-semibold text-3xl sm:text-2xl">Houses for Sale in<br>{{ ucfirst($name) }} by {{ $datum->agentFirstName ?? '' }}</h2>
                            <div class="h-80 md:h-96 sm:h-48 my-6">
                                <img class="object-contain md:object-cover w-full h-full" src="{{ $datum->agentImage ?: asset('images/no-images.png') }}" alt="{{ $agentFullName }}">
                            </div>
                            <h3 class="mt-15 md:mt-20 sm:mt-10 mb-2 text-2xl"><a class="text-orange hover:underline" href="{{ $datum->agentLink ?? '#' }}">{{ $agentFullName }}</a></h3>
                            @if(!empty($address))
                            <p class="mb-2">
                                {!! implode(',<br>', $address) !!}
                            </p>
                            @endif

                            @if(!empty($datum->agentPhoneNo))
                            <p class="mb-1">
                                <a class="link text-blue mb-0 hover:underline" href="tel:+1{{ $datum->agentPhoneNo }}">{{ sprintf(
                                    "(%s) %s-%s",
                                    substr($datum->agentPhoneNo, 0, 3),
                                    substr($datum->agentPhoneNo, 3, 3),
                                    substr($datum->agentPhoneNo, 6)
                                ) }}</a>
                            </p>
                            @endif

                            @if(!empty($datum->agentEmail))
                            <p>
                                <a class="link text-blue hover:underline" href="mailto:{{ $datum->agentEmail }}">Click to Email</a>
                            </p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center text-sm">No houses found</h3>
                @endif
            </div>
        </div>
    </section>
@stop
