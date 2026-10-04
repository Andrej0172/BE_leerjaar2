<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voorraad bijwerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('status'))
                        <div class="mb-4 rounded-md border border-green-300 bg-green-50 p-4 text-sm text-green-900" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="mb-4 text-sm text-gray-600">
                        {{ __('Pas het aantal aanwezig aan per product en sla de regel op. Alleen de Administrator mag dit scherm gebruiken.') }}
                    </p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Barcode') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Naam') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Verpakkingseenheid (kg)') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Aantal aanwezig') }}</th>
                                    <th scope="col" class="px-4 py-3 text-center font-semibold text-gray-700">{{ __('Actie') }}</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($magazijnregels as $regel)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-900">{{ $regel->product?->Barcode }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">{{ $regel->product?->Naam }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $regel->VerpakkingsEenheid }}</td>

                                        <form method="POST" action="{{ route('magazijn.voorraad.bijwerken', $regel) }}">
                                            @csrf
                                            @method('PUT')

                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <input type="number" min="0" name="AantalAanwezig"
                                                       value="{{ $regel->AantalAanwezig }}"
                                                       aria-label="{{ __('Aantal aanwezig voor') }} {{ $regel->product?->Naam }}"
                                                       class="w-28 rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <button type="submit"
                                                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500">
                                                    {{ __('Opslaan') }}
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Er zijn geen magazijnregels aanwezig.') }}
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
