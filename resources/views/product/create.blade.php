<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#ff69b4] flex flex-col min-h-screen"> <!-- Flexbox layout with full screen height -->
    
    <div class="container mx-auto p-10 text-center ml-30">

        <!-- Inner Container (Form Wrapper) with Inside Border -->
        <div class="bg-[#ffb8d8] font-semibold border-4 border-[#ff69b4] border-dashed shadow-lg box-border rounded-lg ml-40 p-8 w-full max-w-4xl">
            <!-- Title -->
            <h2 class="font-extrabold text-[#da1884] text-3xl mb-3" style="font-family: 'Lora', serif;">ADD FORM</h2>

            <!-- Product Form -->
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="product_name" class="block text-left font-semibold text-lg text-gray-500">Product Name</label>
                    <input type="text" id="product_name" name="product_name" 
                           class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-left font-semibold text-lg text-gray-500">Description</label>
                    <textarea id="description" name="description" 
                              class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300" rows="5" required></textarea>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-left font-semibold text-lg text-gray-500">Price (₱)</label>
                    <input type="number" id="price" name="price" 
                    class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300" required>
                </div>

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="pic" class="block text-left font-semibold text-lg text-gray-500">Product Image</label>
                    <input type="file" id="pic" name="pic" 
                    class="w-full px-2 py-1 rounded-md border-4 border-black-500 shadow-lg focus:outline-none focus:ring-2 focus:ring-black-300" required>

                <!-- Button Container (Flexbox to Align Buttons Side by Side) -->
                <div class="flex space-x-4 mb-6 mt-6">
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="bg-[#da1884] font-semibold shadow-md text-white text-sm font-mono hover:bg-[#ff007f] transition ml-50 rounded-lg px-10 py-2">
                            Add
                        </button>
                    </div>

                    <!-- Clear Button -->   
                    <div>
                        <button type="reset" class="bg-[#ff007f] font-semibold shadow-md text-white text-sm font-mono hover:bg-[#da1884] transition rounded-lg  px-10 py-2">
                            Clear
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>

        <!-- Ask if the user wants to view products -->
        <div class="text-center mt-4">
            <p class="text-lg">
                Want to view products? 
                <a href="{{ route('product.index') }}" class="text-white hover:underline">Click here</a>
            </p>
        </div>
    </div>
</body>
</html>
