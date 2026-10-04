<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht Allergenen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- US2 scenario 1: naam product en barcode boven de tabel. --}}
                    <div class="mb-4 flex flex-wrap items-baseline justify-between gap-2">
                        <div>
                            <span class="text-sm text-gray-500">{{ __('Naam Product') }}:</span>
                            <span class="font-medium text-gray-900">{{ $product->Naam }}</span>
                            <span class="mx-2 text-gray-300">|</span>
                            <span class="text-sm text-gray-500">{{ __('Barcode') }}:</span>
                            <span class="font-medium text-gray-900">{{ $product->Barcode }}</span>
                        </div>
                        <a href="{{ route('magazijn.index') }}"
                           class="text-sm text-blue-600 hover:text-blue-800 underline">
                            {{ __('Terug naar Overzicht Magazijn Jamin') }}
                        </a>
                    </div>

                    {{-- US2 scenario 2: geen allergenen => melding en na 4 seconden terug. --}}
                    @if ($allergenen->isEmpty())
                        <div class="mb-4 rounded-md border border-red-300 bg-red-50 p-4 text-sm text-red-900"
                             role="alert" id="geen-allergenen-melding">
                            {{ $geenAllergenenMelding }}
                            <span class="block mt-1 text-red-700">
                                {{ __('Je wordt over 4 seconden automatisch terug gestuurd naar het overzicht.') }}
                            </span>
                        </div>

                        <script>
                            setTimeout(function () {
                                window.location.href = @js(route('magazijn.index'));
                            }, 4000);
                        </script>
                    @endif

                    {{-- Alle allergenen eronder, op naam oplopend. --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Allergeen') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">
                                        {{ __('Omschrijving') }}
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($allergenen as $allergeen)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">
                                            {{ $allergeen->Naam }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-700">
                                            {{ $allergeen->Omschrijving }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Dit product bevat geen allergenen.') }}
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
