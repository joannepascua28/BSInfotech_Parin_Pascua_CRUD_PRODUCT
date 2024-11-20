<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#ff69b4] flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-7 text-center">



        <!-- Inner Container (Form Wrapper) with Inside Border DONE-->
        <div class="bg-[#ffb8d8] border-4 border-[#ff69b4] border-dashed shadow-lg box-border ml-40 rounded-none p-8 w-full max-w-4xl">

            <!-- Title DONE-->
            <h2 class="font-extrabold text-[#da1884] text-3xl mb-3 " style="font-family: 'Lora', serif;">EDIT FORM</h2>
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="product_name" class="block text-left text-lg font-semibold text-gray-500">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" 
                    class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-left text-lg font-semibold text-gray-500">Description</label>
                    <textarea id="description" name="description" 
                    class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300" rows="5" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-left text-lg font-semibold text-gray-500">Price</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" 
                    class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300">
                </div>

                <!-- Product Image (Optional) -->
                <div class="mb-4">
                    <label for="pic" class="block text-left text-lg font-semibold text-gray-500">Product Image (Optional)</label>
                    <input type="file" id="pic" name="pic" 
                           class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300">
                    <div class="flex justify-center items-center mt-4">
                        <img src="{{ asset($product->pic) }}" alt="Product Image" class="max-h-68 w-auto object-cover border-4 border-pink-500 rounded-lg p-2">
                    </div>
                </div>

                <!-- Existing Image Display -->
                @if($product->pic)
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Current Image</p>
                    </div>
                @endif
                

                <!-- Submit Button -->
                <div class="mb-4">
                    <div class="mb-4 grid">
                        <button type="submit" class="bg-[#da1884] font-semibold shadow-md text-white text-xl font-mono hover:scale-95 hover:translate-y-2 transition-all duration-300 ease-in-out justify-self-end mt-2 rounded-none px-7 py-2">
                            DONE
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>