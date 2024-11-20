<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#ff69b4] flex flex-col min-h-screen">

    <!-- Header Section -->
    <header class="bg-[#ff007f] p-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between">

            <!-- Logo -->
            <div class="text-white text-4xl font-extrabold">
                <a href="/" class="">PINK <span class="text-black"> PARADISE </span></a>
            </div>

            <!-- Add New Product Button -->
            <div class="mb-12">
                <a href="{{ route('product.create') }}"
                   class="bg-[#ff69b4] text-white px-4 py-2 shadow-lg font-semibold text-sm hover:bg-[#ff007f] rounded-full relative top-5">
                    CREATE NEW
                </a>
            </div>
        </div>
    </header>

    <!-- Pop Up Message -->
    <div class="inset-0 flex items-center justify-center z-50">
        @if (session('success'))
        <div id="success-message" class="mb-5 mt-7 bg-green-500 font-semibold border-4 border-white text-xl text-white py-2 px-4 rounded-none shadow-md">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const successMessage = document.getElementById('success-message');

            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.opacity = '0'; // Start fading out
                }, 2000);

                setTimeout(() => {
                    successMessage.style.display = 'none'; // Hide after fade-out
                }, 2000);
            }
        });
    </script>

    <!-- Product Creation Form -->
    <form action="/products" method="POST" class="space-y-6">

        <!-- Product Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 w-full max-w-screen-xl mx-auto">

            @foreach($product as $product)
            <div class="bg-[#ffcff1] rounded-md shadow-lg p-3 transition-all duration-300 hover:shadow-[0px_0px_5px_5px_#e5e6e4] max-w-sm mx-auto">

                <!-- Product Name -->
                <p class="font-extrabold text-[#ff007f] text-2xl mb-3 text-center" style="font-family: 'Roboto', sans-serif;">
                    {{ $product->product_name }}
                </p>

                <!-- Product Image -->
                <div class="w-full h-72 overflow-hidden rounded-lg mb-4">
                    <img src="{{ asset($product->pic) }}" alt="Product Image" class="w-full h-full object-cover border-4 border-[#ff007f] rounded-lg p-1">
                </div>

                <!-- Description and Price -->
                <div class="text-gray-600 mb-4">
                    <p class="font-bold text-sm text-center mt-1" style="font-family: 'Roboto', sans-serif;">
                        {{ $product->description }}
                    </p>
                    <p class="font-bold text-[#ff007f] text-2xl text-center mt-3">Price: ₱{{ number_format($product->price, 2) }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-around mt-4">
                    <!-- Edit Button -->
                    <a href="{{ route('product.edit', $product->id) }}"
                       class="bg-[#ff69b4] text-white text-sm font-mono px-6 py-3 rounded-full shadow hover:bg-green-500 mt-4 font-semibold"
                       style="font-family: 'Lora', serif;">
                        <i class="fas fa-edit"></i> EDIT
                    </a>

                    <!-- Delete Button -->
                    <button type="button"
                            class="bg-[#ff007f] text-white text-sm font-mono px-6 py-3 rounded-full shadow hover:bg-red-500 mt-4 font-semibold"
                            onclick="showDeleteModal({{ $product->id }})">
                        <i class="fas fa-trash-alt"></i> DELETE
                    </button>

                    <!-- Delete Form (hidden) -->
                    <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
            @endforeach

        </div>
    </form>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
        <div class="bg-white p-6 rounded-lg w-96 text-center">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Are you sure you want to delete this item?</h3>
            <div class="flex justify-around">
                <button id="confirm-delete" class="bg-[#ff007f] text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 font-semibold">
                    YES, DELETE
                </button>
                <button onclick="closeDeleteModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow hover:bg-gray-400 font-semibold">
                    CANCEL
                </button>
            </div>
        </div>
    </div>

    <script>
        // Global variable to store the product ID for deletion
        let productIdToDelete = null;

        // Show the delete confirmation modal
        function showDeleteModal(productId) {
            productIdToDelete = productId; // Store the product ID to delete
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        // Close the delete confirmation modal
        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }

        // Confirm deletion and submit the form
        document.getElementById('confirm-delete').addEventListener('click', function () {
            if (productIdToDelete !== null) {
                const form = document.getElementById('delete-form-' + productIdToDelete);
                if (form) {
                    form.submit(); // Submit the form
                }
            }
            closeDeleteModal(); // Close the modal after confirming
        });
    </script>

</body>
</html>
