<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Levering Informatie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4 flex flex-wrap items-baseline justify-between gap-2">
                        <div>
                            <span class="text-sm text-gray-500">{{ __('Barcode') }}:</span>
                            <span class="font-medium text-gray-900">{{ $product->Barcode }}</span>
                            <span class="mx-2 text-gray-300">|</span>
                            <span class="font-medium text-gray-900">{{ $product->Naam }}</span>
                        </div>
                        <a href="{{ route('magazijn.index') }}"
                           class="text-sm text-blue-600 hover:text-blue-800 underline">
                            {{ __('Terug naar Overzicht Magazijn Jamin') }}
                        </a>
                    </div>

                    {{-- US1 scenario 2: geen voorraad => melding en na 4 seconden terug. --}}
                    @unless ($heeftVoorraad)
                        <div class="mb-4 rounded-md border border-amber-300 bg-amber-50 p-4 text-sm text-amber-900"
                             role="alert" id="geen-voorraad-melding">
                            {{ $geenVoorraadMelding }}
                            <span class="block mt-1 text-amber-700">
                                {{ __('Je wordt over 4 seconden automatisch terug gestuurd naar het overzicht.') }}
                            </span>
                        </div>

                        <script>
                            setTimeout(function () {
                                window.location.href = @js(route('magazijn.index'));
                            }, 4000);
                        </script>
                    @endunless

                    {{-- US1 scenario 1: leveranciersgegevens boven de tabel. --}}
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">{{ __('Leveranciersgegevens') }}</h3>

                    <div class="overflow-x-auto mb-8">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Leverancier') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Contactpersoon') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Leveranciersnummer') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Mobiel') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($leveranciers as $leverancier)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">{{ $leverancier->Naam }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $leverancier->ContactPersoon }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $leverancier->LeverancierNummer }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $leverancier->Mobiel }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Voor dit product is geen leverancier bekend.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Alle leverdata eronder, oplopend op datum. --}}
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">{{ __('Alle leveringen') }}</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Datum levering') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Aantal') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Leverancier') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Eerstvolgende levering') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($leveringen as $levering)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-900">{{ $levering->DatumLevering->format('d-m-Y') }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $levering->Aantal }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $levering->leverancier?->Naam ?? '-' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $levering->DatumEerstVolgendeLevering?->format('d-m-Y') ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Voor dit product zijn nog geen leveringen geregistreerd.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
