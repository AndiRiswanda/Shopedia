<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Shopedia Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-900 font-inter antialiased">
    <div class="flex min-h-screen">
        <div class="flex-1 ml-72 p-6">
            @if (session('success'))
            <div class="container mx-auto px-6 py-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="container mx-auto px-6 py-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!-- Sidebar (same as before) -->
        <div class="w-72 bg-white shadow-xl border-r border-gray-100 fixed left-0 top-0 bottom-0 z-40">
            <div class="px-6 py-8">
                <div class="flex items-center justify-center mb-12">
                    <h1 class="text-3xl font-bold text-indigo-600 tracking-tight">Shopedia</h1>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->

            <h2 class="text-3xl font-semibold mb-4">Edit User</h2>

            <!-- Edit User Form -->
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <label for="name" class="text-sm font-semibold text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                class="px-4 py-2 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="flex flex-col">
                            <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                class="px-4 py-2 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="flex flex-col">
                            <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                            <input type="password" id="password" name="password"
                                class="px-4 py-2 border border-gray-300 rounded-lg mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <small class="text-gray-500">Leave blank to keep the current password.</small>
                        </div>



                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">Save
                                Changes</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('admin.user.destroy', ['id' => $user ->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700">Delete User</button>
            </form>
        </div>
    </div>
</body>

</html>
