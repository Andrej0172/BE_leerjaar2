<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikers en rollen') }}
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
                        {{ __('Kies per gebruiker de rol die bij zijn of haar toegang hoort. Alleen de Administrator mag dit scherm gebruiken.') }}
                    </p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Naam') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('E-mail') }}</th>
                                    <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">{{ __('Rol') }}</th>
                                    <th scope="col" class="px-4 py-3 text-center font-semibold text-gray-700">{{ __('Actie') }}</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($gebruikers as $gebruiker)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">{{ $gebruiker->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $gebruiker->email }}</td>

                                        <form method="POST" action="{{ route('gebruiker.rol', $gebruiker) }}">
                                            @csrf
                                            @method('PATCH')

                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <select name="rolenum"
                                                        aria-label="{{ __('Rol voor') }} {{ $gebruiker->name }}"
                                                        class="rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    @foreach ([App\Models\User::ROL_GEBRUIKER, App\Models\User::ROL_MAGAZIJNMEDEWERKER, App\Models\User::ROL_ADMINISTRATOR] as $rol)
                                                        <option value="{{ $rol }}" @selected($gebruiker->rolenum === $rol)>
                                                            {{ $rol }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                            {{ __('Er zijn nog geen gebruikers.') }}
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
