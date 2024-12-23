<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Users / Create
            </h2>
            {{-- <a href="{{ route('users.index') }}" class="px-5 py-4 text-sm text-white rounded-md bg-slate-700">Back</a> --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div>
                            <!-- Name Field -->
                            <label for="name" class="text-sm font-medium">Name</label>
                            <div class="my-3">
                                <input type="text" name="name" id="name"
                                    class="w-1/2 border-gray-300 rounded-lg shadow-sm" placeholder="Enter Name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="font-medium text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <label for="email" class="text-sm font-medium">Email</label>
                            <div class="my-3">
                                <input type="email" name="email" id="email"
                                    class="w-1/2 border-gray-300 rounded-lg shadow-sm" placeholder="Enter Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="font-medium text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <label for="password" class="text-sm font-medium">Password</label>
                            <div class="my-3">
                                <input type="password" name="password" id="password"
                                    class="w-1/2 border-gray-300 rounded-lg shadow-sm" placeholder="Enter Password">
                                @error('password')
                                    <p class="font-medium text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <label for="password_confirmation" class="text-sm font-medium">Confirm Password</label>
                            <div class="my-3">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-1/2 border-gray-300 rounded-lg shadow-sm" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <p class="font-medium text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Roles -->
                            <label for="roles" class="text-sm font-medium">Roles</label>
                            <div class="grid grid-cols-4 mb-3">
                                @foreach ($roles as $role)
                                    <div class="mt-3">
                                        <input type="checkbox" class="rounded" name="roles[]"
                                            id="role-{{ $role->id }}" value="{{ $role->id }}"
                                            {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Submit Button -->
                            <button class="px-5 py-4 text-sm text-white rounded-md bg-slate-600" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
