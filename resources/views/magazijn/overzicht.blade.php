<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Magazijn Jamin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">
                        {{ __('Alle producten op barcode oplopend. Het vraagteken-icoon opent de leveringsinformatie,') }}
                        {{ __('het rode kruis-icoon de allergeneninformatie.') }}
                    </p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Barcode') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Naam') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Verpakkingseenheid (kg)') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Aantal aanwezig') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center font-semibold text-gray-700">
                                        {{ __('Leverantie Info') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center font-semibold text-gray-700">
                                        {{ __('Allergenen Info') }}
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($producten as $product)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-900">
                                            {{ $product->Barcode }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">
                                            {{ $product->Naam }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $product->magazijn?->VerpakkingsEenheid ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            @if ($product->magazijn?->heeftVoorraad())
                                                {{ $product->magazijn->AantalAanwezig }}
                                            @else
                                                <span class="text-gray-400">{{ __('Geen voorraad') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('magazijn.levering', $product) }}"
                                               title="{{ __('Levering Informatie bekijken') }}"
                                               aria-label="{{ __('Levering Informatie bekijken voor') }} {{ $product->Naam }}"
                                               class="inline-flex text-blue-600 hover:text-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.86v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('magazijn.allergenen', $product) }}"
                                               title="{{ __('Allergenen Info bekijken') }}"
                                               aria-label="{{ __('Allergenen Info bekijken voor') }} {{ $product->Naam }}"
                                               class="inline-flex text-red-600 hover:text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Er zijn geen producten aanwezig in het magazijn.') }}
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
