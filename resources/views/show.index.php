
You sent
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    @vite('resources/css/app.css') <!-- Include Tailwind CSS -->
</head>
<body class="bg-red-900 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 text-center">
        <!-- Back to Products List Button -->
        <div class="mb-6">
            <a href="{{ route('product.index') }}" 
               class="bg-white text-black px-4 py-2 rounded-lg shadow-md font-bold hover:bg-gray-300">
                BACK TO PRODUCTS
            </a>
        </div>

        <!-- Product Details -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-3xl font-semibold mb-4">{{ $product->product_name }}</h2>

            <!-- Product Image -->
            <img src="{{ asset('storage/' . $product->pic) }}" alt="Product Image" 
                 class="rounded-lg w-full h-96 object-cover mb-4">

            <!-- Product Description -->
            <p class="font-semibold text-gray-700 mb-4">{{ $product->description }}</p>

            <!-- Product Price -->
            <p class="text-xl text-gray-800 mb-4">Price: ${{ number_format($product->price, 2) }}</p>

            <!-- Action Buttons -->
            <div class="flex justify-around">
                <!-- Edit Button -->
                <a href="{{ route('product.edit', $product->id) }}" 
                   class="bg-yellow-400 text-black px-4 py-2 rounded-lg shadow hover:bg-yellow-500 font-bold">
                    EDIT
                </a>

                <!-- Delete Button -->
                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 font-bold">
                        DELETE
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>